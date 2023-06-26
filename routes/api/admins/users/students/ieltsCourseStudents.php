<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index')
->name('ieltsCourseStudents.index');

Route::get('{id}', 'show')
->where('id', '^[0-9]+$')
->name('ieltsCourseStudents.show');

Route::put('', 'store')
->name('ieltsCourseStudents.store');


Route::patch('{id}', 'update')
->where('id', '^[0-9]+$')
->name('ieltsCourseStudents.update');

Route::delete('{id}', 'destroy')
->where('id', '^[0-9]+$')
->name('ieltsCourseStudents.destroy');

Route::post('{id}/media/profile-pic', 'updateProfilePic')
->where('id', '^[0-9]+$')
->name('ieltsCourseStudents.updatePic');
