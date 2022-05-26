<?php

use Core\Http\Route;

Route::names('auth')->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::get('/signup', [UserController::class, 'create'])->name('create');
    Route::post('/signup', [UserController::class, 'store'])->name('store');
    Route::post('/', [UserController::class, 'auth'])->name('auth');
});

Route::middlewares('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');

    Route::names('todo')->group(function () {
        Route::get('/todo', [TodoController::class, 'index'])->name('index');
        Route::get('/todo/edit', [TodoController::class, 'edit'])->name('edit');
        Route::post('/todo/edit', [TodoController::class, 'update'])->name('update');
        Route::get('/todo/create', [TodoController::class, 'create'])->name('create');
        Route::post('/todo/create', [TodoController::class, 'store'])->name('store');
        Route::post('/todo/destroy', [TodoController::class, 'destroy'])->name('destroy');
    });

    Route::names('todo')->group(function () {
        Route::post('/todo/complete', [TodoController::class, 'complete'])->name('complete');
        Route::post('/todo/incomplete', [TodoController::class, 'incomplete'])->name('incomplete');
    });
});