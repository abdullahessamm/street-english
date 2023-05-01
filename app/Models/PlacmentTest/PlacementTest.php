<?php

namespace App\Models\PlacmentTest;

use Illuminate\Database\Eloquent\Model;

class PlacementTest extends Model
{
    protected $table = 'placement_tests';

    protected $fillable = [
        'placement_test_user_id', 'question_id', 'answer_id', 'correct_answer_id', 'score'
    ];

    public function belongsToPlacementTestUser()
    {
        return $this->belongsTo(PlacementTestUser::class, 'placement_test_user_id', 'id');
    }
}
