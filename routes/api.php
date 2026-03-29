<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookController as AdminBookController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index')->name('book.index');
    Route::get('/books/{book}', 'show')->name('book.show');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/reservation-create', [ReservationController::class, 'create'])->name('reservation.create');

    Route::middleware(['admin'])->group(function () {
        Route::controller(AdminBookController::class)->group(function () {
            Route::post('/books', 'store')->name('book.store');
            Route::patch('/books/{book}', 'update')->name('book.update');
            Route::delete('/books/{book}', 'destroy')->name('book.destroy');
        });

        Route::get('/users', [UserController::class, 'index'])->name('user.index');

        Route::patch('/reservation-update', [ReservationController::class, 'update'])->name('reservation.update');
    });
});
