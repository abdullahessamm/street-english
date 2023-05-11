<?php

namespace App\Models\Coaches\Blogs;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CoachPostComment extends Model
{
    protected $table = 'coach_post_comments';

    protected $fillable = [
        'coach_post_id', 'user_id',
    ];

    public function belongsToCoachPost()
    {
        return $this->belongsTo(CoachPost::class, 'coach_id', 'id');
    }

    public function belongsToUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
