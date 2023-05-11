<?php

namespace App\Models\Coaches\Blogs;

use Illuminate\Database\Eloquent\Model;

class CoachPost extends Model
{
    protected $table = 'coach_posts';

    protected $fillable = [
        'coach_id', 'title', 'short_description', 'content', 'banner', 'media_type', 'image', 'video', 'posted_at', 'slug'
    ];

    public function belongsToCoach()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(CoachPostComment::class, 'coach_post_id', 'id');
    }
}
