<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','verified','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::get('/users', [AdminController::class,'users'])->name('users');

    Route::get('/settings',[SettingsController::class,'index'])->name('settings');

    Route::post('/clear-cache', [SettingsController::class, 'clearCache'])->name('settings.clear-cache');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');    

    

    Route::get('/articles/approve', [ArticleController::class,'index'])->name('articles.approve');
    Route::post('/article/aprrove',[ArticleController::class,'approve'])->name('article.aprrove');
    Route::post('/article/delete',[ArticleController::class,'destroy'])->name('article.delete');
    Route::post('/article/view',[ArticleController::class,'show'])->name('article.view');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories'); 
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk.delete');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

    Route::get('/users/messages', [AdminController::class,'message'])->name('messages');

    Route::post('/settings/test-email', [SettingsController::class, 'testEmail'])->name('settings.test-email');

    


});