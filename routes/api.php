<?php

use App\Events\ArticleCreated;
use App\Events\ConversationCreated;
use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Mail\ContactReply;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
    Route::get('/', [ManagerController::class, 'index']);
    Route::post('/', [ManagerController::class, 'store']);
    Route::post('/login', [ManagerController::class, 'login']);
    Route::put('/{id}', [ManagerController::class, 'update']);
    Route::delete('/{id}', [ManagerController::class, 'destroy']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);     // List all articles
    Route::post('/', [ArticleController::class, 'store']);    // Create a new article
    Route::get('/{id}', [ArticleController::class, 'show']);  // Show a specific article
    Route::put('/{id}', [ArticleController::class, 'update']); // Update a specific article
    Route::delete('/{id}', [ArticleController::class, 'destroy']); // Delete a specific article
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::post('/', [EventController::class, 'store']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::delete('/{id}', [EventController::class, 'destroy']);
    Route::put('/{id}', [EventController::class, 'update']);
});

Route::get('announces/accepted', [AnnounceController::class, 'getAcceptedAnnounces']);


Route::prefix('announces')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AnnounceController::class, 'index']);
    Route::post('/', [AnnounceController::class, 'store']);
    Route::get('/{id}', [AnnounceController::class, 'show']);
    Route::delete('/{id}', [AnnounceController::class, 'destroy']);
    Route::put('/{id}', [AnnounceController::class, 'update']);

    Route::post('/{id}/accept', [AnnounceController::class, 'acceptAnnounce']);
    Route::post('/{id}/reject', [AnnounceController::class, 'declineAnnounce']);
});

Route::prefix('conversations')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ConversationController::class, 'index']);
    Route::post('/', [ConversationController::class, 'store']);
    Route::get('/{id}', [ConversationController::class, 'show']);
    Route::delete('/{id}', [ConversationController::class, 'destroy']);
    Route::put('/{id}', [ConversationController::class, 'update']);

    Route::get('/{id}/messages', [MessageController::class, 'getConversationMessages']);

});


Route::prefix('messages')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [MessageController::class, 'store']);
    Route::delete('/{id}', [MessageController::class, 'destroy']);
    Route::put('/{id}', [MessageController::class, 'update']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);

    Route::post('/login', [UserController::class, 'loginUser']);

    Route::put('/{id}', [UserController::class, 'update']);
});

Route::prefix('contact-submissions')->group(function () {
    Route::get('/', [ContactSubmissionController::class, 'index']);
    Route::post('/', [ContactSubmissionController::class, 'store']);
    Route::delete('/{id}', [ContactSubmissionController::class, 'destroy']);
});
Route::get('/user/announces', [AnnounceController::class, 'getUserAnnounces'])->middleware('auth:sanctum');
Route::get('/user/conversations', [ConversationController::class, 'getConversationsByUserId'])->middleware('auth:sanctum');


Route::get('/pusher/test', function () {
    event(new ConversationCreated(
        Conversation::first()
    ));

    return 'done';
});
Route::get('/mailer/test', function () {
    $contactName = 'John Doe';
    $messageBody = 'This is a test message sent from the contact form.';

    // Send the email
    Mail::to('wafaaatta04@gmail.com')->send(new ContactReply($contactName, $messageBody));

    // Return a response to the user (for example, a success message)
    return response()->json([
        'message' => 'Email sent successfully',
    ]);
});

Route::get('/statistics', [StatisticsController::class, 'getSystemStatistics']);

Route::middleware('auth:sanctum')->get('/validate-token', [AuthController::class, 'validateToken']);