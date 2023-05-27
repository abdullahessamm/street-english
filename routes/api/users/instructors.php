<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index')
->name('instructors.index');

Route::get('{id}', 'show')
->where('id', '^[0-9]+$')
->name('instructors.show');

Route::put('', 'store')
->name('instructors.store');

Route::patch('{id}', 'update')
->where('id', '^[0-9]+$')
->name('instructors.update');

Route::delete('{id}', 'destroy')
->where('id', '^[0-9]+$')
->name('instructors.destroy');

Route::post('{id}/media/profile-pic', 'updateProfilePic')
->where('id', '^[0-9]+$')
->name('instructors.updateProfilePic');

Route::post('{id}/media/bio-video', 'updateBioVideo')
->where('id', '^[0-9]+$')
->name('instructors.updateBioVideo');