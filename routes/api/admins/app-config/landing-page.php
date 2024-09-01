<?php

use Illuminate\Support\Facades\Route;

Route::patch('', 'updateLandingPageConfigData');

Route::prefix('media')->group(function () {
    Route::post('cover-video', 'uploadCoverVideo');
    Route::post('testimonials-images', 'uploadTestimonialStudentImage');
});
