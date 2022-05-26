<?php

use Core\Http\Route;

// Default UnknownRori-PHP Route
Route::get('/', function () {
    return view("welcome");
})->name('home');


Route::prefix('/auth')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'auth'])->name('auth');
});

Route::middlewares('auth')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('/todo', TodoController::class);
});