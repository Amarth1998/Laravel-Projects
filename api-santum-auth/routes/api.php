<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Route to get the authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Public routes for signup and login
Route::post('signup', [UserAuthController::class, 'signup']);
Route::post('login', [UserAuthController::class, 'login']);



 
// Grouped routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::post('addStudent', [StudentController::class, 'addStudent']);
    Route::get('list', [StudentController::class, 'list']);
    Route::put('updateStudent', [StudentController::class, 'updateStudent']);
    Route::delete('deleteStudent', [StudentController::class, 'deleteStudent']);
});

