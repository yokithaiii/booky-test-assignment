<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// open routes
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');

// close routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
});