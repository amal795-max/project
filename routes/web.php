<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserName;
Route::get('/s', function () {
    return view('welcome');
});

Route::get('/userName',[UserName::class,'showList']);
Route::get('/user',[UserName::class,'isCorrect']);
