<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Author routes (protected)
Route::middleware(['auth','verified','role:author'])->prefix('author')->name('author.')->group(function () {
    Route::get('/dashboard', [AuthorController::class,'index'])->name('dashboard');
    
    Route::get('/post/create', [AuthorController::class,'create'])->name('post.create');
    Route::post('/post/store', [AuthorController::class,'store'])->name('post.store');
    Route::post('/post/show', [AuthorController::class,'show'])->name('post.show');
    Route::post('/post/delete', [AuthorController::class,'delete'])->name('post.delete');
    Route::post('/post/update', [AuthorController::class,'update'])->name('post.update');
});