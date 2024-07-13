<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SoldController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Routes for managing books
Route::get('/book-details', [BookController::class, 'create'])->name('book.details');
Route::post('/book-details', [BookController::class, 'store']);
Route::get('/books/{book_number}', [BookController::class, 'fetchBookDetails'])->name('books.fetch');

Route::get('/books', [BookController::class, 'index'])->name('book.list');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.destroy');

// Routes for managing sold details
Route::get('/sold-details', [SoldController::class, 'create'])->name('sold.details');
Route::get('/sold', [SoldController::class, 'index'])->name('sold.index');
Route::post('/sold-details', [SoldController::class, 'store']);
Route::get('/sold/create', [SoldController::class, 'create'])->name('sold.create');
Route::get('/sold-list', [SoldController::class, 'index'])->name('sold.list');
Route::get('/sold/{id}/edit', [SoldController::class, 'edit'])->name('sold.edit');
Route::put('/sold/{id}', [SoldController::class, 'update'])->name('sold.update');
Route::delete('/sold/{id}', [SoldController::class, 'destroy'])->name('sold.destroy');

