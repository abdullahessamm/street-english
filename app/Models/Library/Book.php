<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'book_name', 'page_number', 'short_description', 'summary', 'book_cover', 'book_background', 'book_type', 'book', 'download_avaliable', 'slug'
    ];
}
