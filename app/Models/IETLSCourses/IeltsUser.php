<?php

namespace App\Models\IETLSCourses;

use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

class IeltsUser extends Model
{
    use NameHandler;

    protected $table = 'ielts_users';

    protected $fillable = [
        'name',
        'gender',
        'email',
        'phone',
        'password',
    ];
}
