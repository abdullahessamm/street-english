<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index')
->name('zoomCourseStudents.index');

Route::get('{id}', 'show')
->where('id', '^[0-9]+$')
->name('zoomCourseStudents.show');

Route::put('', 'store')
->name('zoomCourseStudents.store');


Route::patch('{id}', 'update')
->where('id', '^[0-9]+$')
->name('zoomCourseStudents.update');

Route::delete('{id}', 'destroy')
->where('id', '^[0-9]+$')
->name('zoomCourseStudents.destroy');

Route::post('{id}/media/profile-pic', 'updateProfilePic')
->where('id', '^[0-9]+$')
->name('zoomCourseStudents.updatePic');
