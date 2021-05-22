<?php

use App\Http\Controllers\Api\PostsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
});

Route::post('/posts', [PostsApiController::class, 'store'])->name('api.posts.store');

Route::get('/posts/{number}', [PostsApiController::class, 'index'])->name('api.posts.index');
