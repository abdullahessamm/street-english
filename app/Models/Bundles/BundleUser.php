<?php

namespace App\Models\Bundles;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class BundleUser extends Model
{
    protected $table = 'bundle_users';

    protected $fillable = [ 
        'bundle_id', 'user_id', 'slug',
    ];

    public function belongsToBundle()
    {
        return $this->belongsTo(Bundle::class, 'bundle_id', 'id');
    }

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }
}
