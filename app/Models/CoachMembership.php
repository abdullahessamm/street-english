<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachMembership extends Model
{
    protected $table = 'coaching_memberships';

    protected $fillable = [
        'firstname', 'lastname', 'mobile', 'email', 'linkedIn', 'facebook', 'company', 'topic', 'cv', 'slug',
    ];
}
