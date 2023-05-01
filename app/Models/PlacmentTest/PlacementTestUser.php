<?php

namespace App\Models\PlacmentTest;

use Illuminate\Database\Eloquent\Model;

class PlacementTestUser extends Model
{
    protected $table = 'placement_test_users';

    protected $fillable = [
        'name', 'email', 'whatsapp_number_or_phone_number', 'hasFinished', 'slug'
    ];

    public function test()
    {
        return $this->hasOne(PlacementTest::class, 'placement_test_user_id', 'id');
    }
}
