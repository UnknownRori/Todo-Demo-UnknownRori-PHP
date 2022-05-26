<?php

use Core\Http\Route;

// Default UnknownRori-PHP Route
Route::get('/', function () {
    return view("welcome");
})->name('home');


Route::prefix('/auth')->group(function () {
    Route::get('/login', [UserController::class, 'login']);
    Route::post('/login', [UserController::class, 'auth']);
});

Route::middlewares('auth')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'logout']);
    Route::resource('/todo', TodoController::class);
});