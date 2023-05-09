<?php

namespace App\Models\Coaches;

use Illuminate\Database\Eloquent\Model;

class CoachCategory extends Model
{
    protected $table = 'coach_categories';

    protected $fillable = [
        'name', 'slug'
    ];

    public function coaches()
    {
        return $this->hasMany(Coach::class, 'coach_category_id', 'id');
    }
}
