<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware('guest')->group(function () {
    Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
});
