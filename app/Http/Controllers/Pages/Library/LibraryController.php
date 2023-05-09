<?php

namespace App\Http\Controllers\Pages\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library\Book;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $books = Book::get();

        return view('pages.library.index')->with('books', $books);
    }

    public function create()
    {
        return view('pages.library.create');
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        if($book == null)
        {
            abort(404);
        }

        return view('pages.library.show')->with('book', $book);
    }
}
