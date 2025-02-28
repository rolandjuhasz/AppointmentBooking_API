<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// A sikeres email megerősítést tartalmazó oldal route-ja
Route::get('/email/verification/success', function() {
    return view('verification.success');
})->name('verification.success');

