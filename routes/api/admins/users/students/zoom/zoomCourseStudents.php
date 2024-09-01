<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index')
->name('zoomCourseStudents.index');

Route::put('', 'store')
->name('zoomCourseStudents.store');


Route::prefix('{id}')
->where(['id' => '^[0-9]+$'])
->group(function () {
    Route::get('', 'show')
    ->name('zoomCourseStudents.show');
    
    Route::patch('', 'update')
    ->name('zoomCourseStudents.update');

    Route::delete('', 'destroy')
    ->name('zoomCourseStudents.destroy');

    Route::post('media/profile-pic', 'updateProfilePic')
    ->name('zoomCourseStudents.updatePic');
});
