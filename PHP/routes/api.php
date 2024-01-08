<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/news', [NewsController::class, 'show']);

Route::get('/news_by_author/{id}', [NewsController::class, 'showByAuthorId']);

Route::get('/news_by_category/{id}', [NewsController::class, 'showByCategoryId']);

Route::post('/user/login', [UserController::class, 'register']);