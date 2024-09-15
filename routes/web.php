<?php

use Illuminate\Support\Facades\Route;

Route::get('/offline', function () {
    return view('offlinedetection::offline');
})->name('offline');