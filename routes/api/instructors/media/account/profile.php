<?php

use Illuminate\Support\Facades\Route;

Route::post('picture', 'updateProfilePic');
Route::get('bio-video', 'downloadBioVideo');
Route::post('bio-video', 'updateBioVideo');
