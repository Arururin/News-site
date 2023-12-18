<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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


Route::get('/news', [NewsController::class, 'show']);

Route::get('/news_by_author/{id}', [NewsController::class, 'showByAuthorId']);

Route::get('/news_by_category/{id}', [NewsController::class, 'showByCategoryId']);

// Route::get('/news', [NewsController::class, 'post']);

// Route::get('/news', [NewsController::class, 'delete']);