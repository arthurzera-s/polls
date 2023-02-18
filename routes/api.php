<?php

use App\Http\Controllers\PollController;
use App\Models\Poll;
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

Route::get('poll', [PollController::class, 'index']);
Route::get('poll/{id}', [PollController::class, 'show']);
Route::get('poll/{id}/stats', [PollController::class, 'stats']);
Route::put('poll/{id}', [PollController::class, 'update']);
Route::post('poll', [PollController::class, 'store']);
Route::post('poll/{id}/vote', [PollController::class, 'vote']);
Route::delete('poll/{id}', [PollController::class, 'destroy']);
