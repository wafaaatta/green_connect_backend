<?php

use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('article-categories')->group(function () {
    Route::get('/', [ArticleCategoryController::class, 'index']);
    Route::post('/', [ArticleCategoryController::class, 'store']);
    Route::get('/{id}', [ArticleCategoryController::class, 'show']);
    Route::put('/{id}', [ArticleCategoryController::class, 'update']);
    Route::delete('/{id}', [ArticleCategoryController::class, 'destroy']);
});

Route::prefix('managers')->group(function () {
    Route::post('/', [ManagerController::class, 'store']);
    Route::post('/login', [ManagerController::class, 'login']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/', [ArticleController::class, 'store']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::delete('/{id}', [ArticleController::class, 'destroy']);
    Route::put('/{id}', [ArticleController::class, 'update']);
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::post('/', [EventController::class, 'store']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::delete('/{id}', [EventController::class, 'destroy']);
    Route::put('/{id}', [EventController::class, 'update']);
});

Route::prefix('announces')->group(function () {
    Route::get('/', [AnnounceController::class, 'index']);
    Route::post('/', [AnnounceController::class, 'store']);
    Route::get('/{id}', [AnnounceController::class, 'show']);
    Route::delete('/{id}', [AnnounceController::class, 'destroy']);
    Route::put('/{id}', [AnnounceController::class, 'update']);

    Route::post('/{id}/accept', [AnnounceController::class, 'acceptAnnounce']);
    Route::post('/{id}/decline', [AnnounceController::class, 'declineAnnounce']);
});

Route::prefix('conversations')->group(function () {
    Route::get('/', [ConversationController::class, 'index']);
    Route::post('/', [ConversationController::class, 'store']);
    Route::get('/{id}', [ConversationController::class, 'show']);
    Route::delete('/{id}', [ConversationController::class, 'destroy']);
    Route::put('/{id}', [ConversationController::class, 'update']);
});
