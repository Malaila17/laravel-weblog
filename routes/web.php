<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::post('/comments/{article}', [CommentController::class, 'store'])->name('comments.store');


Route::redirect('/', '/articles');