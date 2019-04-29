<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Fallback router for not found pages, error 404.
 */
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found...'], 404);
});

/**
 * Resource routes for task controller API.
 */
Route::resource('tasks', 'API\TaskController');
