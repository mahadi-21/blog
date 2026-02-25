<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriberController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;



// Public routes
Route::get('/', function () {
    $categories = Category::withCount([
        'posts' => function ($query) {
            $query->where('status', 'published');
        }
    ])->get();
    

    return view('blog.home', compact('categories'));
})->name('blog.home');

Route::get('/articles', [BlogController::class, 'index'])->name('blog.articles');

Route::get('/article/{slug}', function ($slug) {
    return view('blog.post', ['post' => (object) ['title' => 'Sample Post', 'slug' => $slug]]);
})->name('blog.post');

Route::get('/categories', [BlogController::class, 'categories'])->name('blog.categories');
Route::get('/categories/{id}', [BlogController::class, 'categoryshow'])->name('blog.categoryshow');

Route::get('/about', [BlogController::class, 'about'])->name('blog.about');

Route::get('/contact', [BlogController::class, 'contact'])->name('blog.contact');

Route::post('/contact', [BlogController::class, 'submitContact'])->name('blog.contact.submit');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/clear-cache', [SettingsController::class, 'clearCache']);

Route::post('/subscribe',[SubscriberController::class,'subscribe'])->name('subscribe');



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/author.php';
