<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'post_category_id', 'title', 'short_description', 'content', 'background_cover', 'media_type', 'image', 'video', 'category_id', 'posted_at', 'slug'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'post_category_id', 'id');
    }
}
