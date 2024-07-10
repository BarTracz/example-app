<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'App\Http\Controllers\test@index');

Route::get('/test1', 'App\Http\Controllers\test1@index');

Route::get('/test2', 'App\Http\Controllers\test2@index');
