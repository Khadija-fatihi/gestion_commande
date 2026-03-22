<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('login', [Controller::class, 'showLoginForm'])->name('login');
    Route::post('login', [Controller::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

