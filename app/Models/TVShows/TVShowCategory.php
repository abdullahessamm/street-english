<?php

namespace App\Models\TVShows;

use Illuminate\Database\Eloquent\Model;

class TVShowCategory extends Model
{
    protected $table = 'tv_show_categories';

    protected $fillable = [
        'name', 'slug',
    ];

    public function tvShows()
    {
        return $this->hasMany(TVShow::class, 'tv_show_category_id', 'id');
    }
}
