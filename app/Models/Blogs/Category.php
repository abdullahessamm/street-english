<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'post_categories';

    protected $fillable = ['name', 'slug'];
    
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_category_id', 'id');
    }
}
