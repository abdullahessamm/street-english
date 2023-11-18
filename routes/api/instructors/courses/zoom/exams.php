<?php

use Illuminate\Support\Facades\Route;

Route::prefix('{id}')->where([
    'id' => '^[0-9]+$'
])->group(function () {
    Route::get('init-correction', 'initCorrection');
    Route::patch('correct', 'correct');
});
