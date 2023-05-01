<?php

namespace App\Models\Bundles;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    protected $table = 'bundles';

    protected $fillable = [ 
        'name', 'price', 'thumbnail', 'banner', 'slug'
    ];

    public function bundleCourses()
    {
        return $this->hasMany(BundleCourse::class, 'bundle_id', 'id');
    }

    public function bundleUsers()
    {
        return $this->hasMany(BundleUser::class, 'bundle_id', 'id');
    }
}
