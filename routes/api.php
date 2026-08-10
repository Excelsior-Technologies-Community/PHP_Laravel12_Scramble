<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

Route::get('posts/statistics', [PostController::class, 'statistics']);

Route::apiResource('posts', PostController::class);

Route::apiResource('categories', CategoryController::class);