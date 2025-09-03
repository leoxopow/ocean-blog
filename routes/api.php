<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;

Route::apiResource('categories', CategoriesController::class)->only(['index', 'show']);
Route::apiResource('categories.posts', PostsController::class)->only(['index']);
Route::apiResource('posts', PostsController::class)->only(['index', 'show']);
Route::apiResource('posts.comments', CommentsController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoriesController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('posts', PostsController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('comments', CommentsController::class)->only(['store', 'update', 'destroy']);
});
Route::post('/login',[AuthController::class,'login']);
Route::get('/users',[UsersController::class,'index']);
