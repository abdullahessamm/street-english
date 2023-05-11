<?php

namespace App\Models\TVShows;

use Illuminate\Database\Eloquent\Model;

class TVShowEpisode extends Model
{
    protected $table = 'tv_show_episodes';

    protected $fillable = [
        'tv_show_id', 'title', 'banner', 'thumbnail', 'short_description', 'video_type', 'video_url', 'parsed_video_url', 'content', 'slug',
    ];

    public function belongsToTvShow()
    {
        return $this->belongsTo(TVShow::class, 'tv_show_id', 'id');
    }

    public function viewers()
    {
        return $this->hasMany(TVShowEpisodeViewer::class, 'tv_show_episode_id', 'id');
    }
}
