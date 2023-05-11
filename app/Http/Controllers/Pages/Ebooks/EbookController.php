<?php

namespace App\Http\Controllers\Pages\Ebooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library\Book;

class EbookController extends Controller
{
    public function index()
    {
        $books = Book::get();

        return view('pages.ebooks.index')->with('books', $books);
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        return view('pages.ebooks.show')->with('book', $book);
    }
}
