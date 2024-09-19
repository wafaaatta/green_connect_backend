<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('article-categories')->group(function () {
    Route::get('/', [ArticleCategoryController::class, 'index']);
    Route::post('/', [ArticleCategoryController::class, 'store']);
});