<?php

use App\Http\Controllers\BulletinCommentController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowUserNews;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\NewpaperController;
use App\Http\Controllers\PostCommentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Common user routes
Route::middleware(['role:common_user'])->group(function () {
    Route::resource('newspaper', NewpaperController::class);

    Route::get('/user/news', ShowUserNews::class)->name('user.news');

    Route::resource('posts', PostController::class);
    Route::resource('posts.comments', PostCommentController::class)
        ->only('store', 'destroy')
        ->scoped();
    Route::get('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::get('post/{post}/unlike', [PostController::class, 'unlike'])->name('posts.unlike');

    Route::resource('bulletins', BulletinController::class);

    Route::resource('bulletins.comments', BulletinCommentController::class)
        ->only('store', 'destroy')
        ->scoped();
});

require __DIR__ . '/admin.php';
