<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReturnBookController;
use App\Http\Controllers\CheckoutBookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/books',[BooksController::class, 'store']);
Route::patch('/books/{book}',[BooksController::class, 'update']);
Route::delete('/books/{book}',[BooksController::class, 'destroy']);

Route::post('/authors', [AuthorsController::class, 'store']);

Route::post('/checkout/{book}', [CheckoutBookController::class, 'store']);
Route::post('/return/{book}', [ReturnBookController::class, 'store']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
