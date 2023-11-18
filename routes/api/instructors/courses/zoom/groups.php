<?php

use Illuminate\Support\Facades\Route;

Route::patch('{id}', 'updateSessionsInfo')->where('id', '^[0-9]+$');