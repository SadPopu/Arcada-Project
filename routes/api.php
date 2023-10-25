<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;

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

Route::get('authors', [AuthorController::class, 'index']);
Route::post('authors', [AuthorController::class, 'store']);
Route::get('authors/{id}', [AuthorController::class, 'show']);
Route::get('authors/{id}/edit', [AuthorController::class, 'edit']);
Route::put('authors/{id}/edit', [AuthorController::class, 'update']);
Route::delete('authors/{id}/delete', [AuthorController::class, 'destroy']);


Route::get('books', [BookController::class, 'index']);
Route::post('books', [BookController::class, 'store']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::get('books/{id}/edit', [BookController::class, 'edit']);
Route::put('books/{id}/edit', [BookController::class, 'update']);
Route::delete('books/{id}/delete', [BookController::class, 'destroy']);