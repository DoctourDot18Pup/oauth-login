<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);