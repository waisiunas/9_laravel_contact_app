<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login_view')->name('login');
    Route::post('/', 'login');
    Route::get('/register', 'register_view')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile/show', 'show')->name('profile.show');
    Route::patch('/profile/details', 'details')->name('profile.details');
    Route::patch('/profile/password', 'password')->name('profile.password');
    Route::patch('/profile/picture', 'picture')->name('profile.picture');
});
