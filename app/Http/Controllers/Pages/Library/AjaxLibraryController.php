<?php

namespace App\Http\Controllers\Pages\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library\Book;

class AjaxLibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function previewBookType(Request $request)
    {
        $book_type = $request->input('data')['book_type'];
        $book_id = isset($request->input('data')['book_id']) ? $request->input('data')['book_id'] : null;

        switch ($book_type) 
        {
            case 'pdf':
                return view('pages.library.choose-book-type.pdf')->with('book_id', $book_id);
            break;

            case 'drive':
                return view('pages.library.choose-book-type.google-drive')->with('book_id', $book_id);
            break;
        }
    }
    
    public function create(Request $request)
    {
        $book_name = $request->input('book_name');
        $page_number = $request->input('page_number');
        $short_description = "test description";
        $summary = $request->input('summary');
        $bookCover = $request->file('book_cover');
        $bookBackground = '#eee';
        $book_type = $request->input('choose_book_type');
        $download_avaliable = $request->input('download_avaliable') != null && $request->input('download_avaliable') == 'on' ? 1 : 0;
        $slug = $this->slugify($book_name);

        // check if book cover image is valid
        if($book_type == 'pdf' && !$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $bookCover->getClientOriginalExtension()))
        {
            echo $this->errorMsg("The book cover image extenstion is not allowed");
            die();
        }

        // check if book cover image is valid
        // if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $bookBackground->getClientOriginalExtension()))
        // {
        //     echo $this->errorMsg("The book background image extenstion is not allowed");
        //     die();
        // }

        // check if book is a pdf
        if($request->hasFile('book') && !$this->isFileExtAllowed(['pdf'], $request->file('book')->getClientOriginalExtension()))
        {
            echo $this->errorMsg("The book must be a PDF format");
            die();
        }

        if($request->hasFile('book')){
            
            $book = 'book.'.$request->file('book')->getClientOriginalExtension();

        }else{

            $book = $request->input('book');
        }

        $data = [
            'book_name' => $book_name,
            'page_number' => $page_number,
            'short_description' => $short_description,
            'summary' => $summary,
            'book_cover' => 'cover.'.$bookCover->getClientOriginalExtension(),
            'book_background' => $bookBackground,
            'book' => $book,
            'download_avaliable' => $download_avaliable,
            'slug' => $slug,
        ];

        $Book = Book::firstOrCreate(['book_name' => $book_name], $data);

        if($Book)
        {
            $book_cover_path = $this->getUniversalPath('public/public/uploads/books/'.$Book->id.'/cover');
            $book_background_path = $this->getUniversalPath('public/public/uploads/books/'.$Book->id.'/background');
            $book_path = $this->getUniversalPath('public/public/uploads/books/'.$Book->id.'/book');
            
            $request->file('book_cover')->move($book_cover_path, 'cover.'.$bookCover->getClientOriginalExtension());
            // $request->file('book_background')->move($book_background_path, 'background.'.$bookBackground->getClientOriginalExtension());
            
            if($book_type == 'pdf'){
                $request->file('book')->move($book_path, 'book.'.$request->file('book')->getClientOriginalExtension());
            }

            echo $this->successMsg("Book : ".$book_name." has been created");
            $this->redierctTo('library/book/show/'.$slug);
        }
    }

    public function update(Request $request)
    {
        $book_id = $request->input('book_id');

        $book = Book::where('id', $book_id)->first();

        $book_name = $request->input('book_name');
        $page_number = $request->input('page_number');
        $short_description = $request->input('short_description');
        $summary = $request->input('summary');
        $bookCover = $request->hasFile('book_cover') ? 'cover.'.$request->file('book_cover')->getClientOriginalExtension() : $book->book_cover;
        $bookBackground = $request->hasFile('book_background') ? 'background.'.$request->file('book_background')->getClientOriginalExtension() : $book->book_background;
        $book_type = $request->input('choose_book_type');
        $download_avaliable = $request->input('download_avaliable') != null && $request->input('download_avaliable') == 'on' ? 1 : 0;
        $slug = $this->slugify($book_name);

        if($request->hasFile('book_cover'))
        {
            // check if book cover image is valid
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('book_cover')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("The book cover image extenstion is not allowed");
                die();
            }
            
            $book_cover_path = $this->getUniversalPath('public/images/books/'.$book->id.'/cover');
            $request->file('book_cover')->move($book_cover_path, 'cover.'.$request->file('book_cover')->getClientOriginalExtension());
        }

        if($request->hasFile('book_background'))
        {
            // check if book cover image is valid
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('book_background')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("The book background image extenstion is not allowed");
                die();
            }

            $book_background_path = $this->getUniversalPath('public/images/books/'.$book->id.'/background');
            $request->file('book_background')->move($book_background_path, 'background.'.$request->file('book_background')->getClientOriginalExtension());
        }

        if($book_type == 'pdf' && $request->hasFile('book'))
        {
            // check if book is a pdf
            if(!$this->isFileExtAllowed(['pdf'], $request->file('book')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("The book must be a PDF format");
                die();
            }

            $book_path = $this->getUniversalPath('public/images/books/'.$book->id.'/book');

            $request->file('book')->move($book_path, 'book.'.$request->file('book')->getClientOriginalExtension());
            $book_pdf = 'book.'.$request->file('book')->getClientOriginalExtension();

        }elseif($book_type == 'drive' && $request->input('book') != null){

            $book_pdf = $request->input('book');

        }else{
            
            $book_pdf = $book->book;
        }

        Book::where('id', $book_id)->update([
            'book_name' => $book_name,
            'page_number' => $page_number,
            'short_description' => $short_description,
            'summary' => $summary,
            'book_cover' => $bookCover,
            'book_background' => $bookBackground,
            'book_type' => $book_type,
            'book' => $book_pdf,
            'download_avaliable' => $download_avaliable,
            'slug' => $slug,
        ]);

        echo $this->successMsg("Book : ".$book_name." info has been updated");
        $this->redierctTo('library/book/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $book_id = $request->input('book_id');

        if(Book::where('id', $book_id)->delete())
        {
            $book_path = $this->getUniversalPath('public/public/uploads/books/'.$book_id);

            $this->deleteDir($book_path);

            echo $this->successMsg("This book has been removed from our database");
            $this->redierctTo('library');
        }
    }
}
