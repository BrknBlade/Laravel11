<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminPostsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminNewpaperController;
use App\Http\Controllers\Admin\AdminBulletinsController;
use App\Http\Controllers\Admin\AdminPostCommentController;

Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('newspaper', AdminNewpaperController::class);
        Route::resource('users', AdminUsersController::class);
        Route::resource('posts', AdminPostsController::class);
        Route::resource('posts.comments', AdminPostCommentController::class)
            ->only(['store', 'destroy'])
            ->scoped();
        Route::resource('bulletins', AdminBulletinsController::class);
        Route::get('bulletins.status', [AdminBulletinsController::class, 'status'])->name('bulletins.status');
    });
