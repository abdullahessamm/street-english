<?php

namespace App\Http\Controllers\Web\Pages\Ebooks;

use App\Http\Controllers\Web\Controller;
use App\Models\Library\Book;

class EbookController extends Controller
{
    public function index()
    {
        $books = Book::get();

        return view('web.pages.ebooks.index')->with('books', $books);
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        return view('web.pages.ebooks.show')->with('book', $book);
    }
}
