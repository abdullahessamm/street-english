<?php

namespace App\Models\TVShows;

use Illuminate\Database\Eloquent\Model;

class TVShowEpisodeViewer extends Model
{
    protected $table = 'tv_show_episode_viewers';

    protected $fillable = [
        'tv_show_episode_id', 'agent_ip', 'isRegistered', 'user_id', 'agent_device', 'agent_platform', 'agent_browser', 'isDesktop', 'isPhone', 'isRobot', 'agent_robot',
    ];

    public function belongsToTVShowEpisode()
    {
        return $this->belongsTo(TVShowEpisode::class, 'tv_show_episode_id', 'id');
    }
}
