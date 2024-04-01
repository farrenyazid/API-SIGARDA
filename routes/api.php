<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UpvoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ForumRecommendationController;






/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('pemilik-postingan');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('pemilik-postingan');

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware('pemilik-komentar');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('pemilik-komentar');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::post('/login', [AuthenticationController::class, 'login']);

//UPVOTE ROUTE
Route::post('/api/posts/{id}/upvote', [UpvoteController::class, 'upvote']);
   
//COMMENT LIKE ROUTE

Route::post('/api/comments/{id}/like', [CommentLikeController::class, 'like']);
Route::delete('/api/comments/{id}/like', [CommentLikeController::class, 'unlike']);

//FORUM RECOMMENDATION ROUTE
Route::get('/api/forum-recommendations', [ForumRecommendationController::class, 'getRecommendations']);

//COMMENTS ROUTE
// Retrieve comments for a specific post
Route::get('/api/posts/{post}/comments', [CommentController::class, 'index']);
// Create a new comment
Route::post('/api/comments', [CommentController::class, 'store']);
// Update an existing comment
Route::put('/api/comments/{id}', [CommentController::class, 'update']);
// Delete a comment
Route::delete('/api/comments/{id}', [CommentController::class, 'destroy']);
