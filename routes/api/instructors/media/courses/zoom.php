<?php

use Illuminate\Support\Facades\Route;

Route::get('exam-sections/{id}', 'ExamSectionHeaderMedia')->where('id', '^[0-9]+$');
Route::get('session-materials/{id}', 'sessionMaterial')->where('id', '^[0-9]+$');
