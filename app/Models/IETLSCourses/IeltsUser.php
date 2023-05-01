<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IeltsUser extends Model
{
    protected $table = 'ielts_users';

    protected $fillable = [
        'name', 'email', 'password',
    ];
}
