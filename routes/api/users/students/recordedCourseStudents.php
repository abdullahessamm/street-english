<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index')
->name('recordedCourseStudents.index');

Route::get('{id}', 'show')
->where('id', '^[0-9]+$')
->name('recordedCourseStudents.show');

Route::put('', 'store')
->name('recordedCourseStudents.store');


Route::patch('{id}', 'update')
->where('id', '^[0-9]+$')
->name('recordedCourseStudents.update');

Route::delete('{id}', 'destroy')
->where('id', '^[0-9]+$')
->name('recordedCourseStudents.destroy');

Route::post('{id}/media/profile-pic', 'updateProfilePic')
->where('id', '^[0-9]+$')
->name('recordedCourseStudents.updatePic');
