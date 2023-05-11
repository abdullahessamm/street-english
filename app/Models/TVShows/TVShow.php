<?php

namespace App\Models\TVShows;

use Illuminate\Database\Eloquent\Model;

class TVShow extends Model
{
    protected $table = 'tv_shows';

    protected $fillable = [
        'tv_show_category_id', 'name', 'short_description', 'banner', 'thumbnail', 'slug',
    ];

    public function belongsToTVShowCategory()
    {
        return $this->belongsTo(TVShowCategory::class, 'tv_show_category_id', 'id');
    }

    public function episodes()
    {
        return $this->hasMany(TVShowEpisode::class, 'tv_show_id', 'id');
    }
}
