<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Correct namespace for the controller
use App\Http\Controllers\ProductController; // Correct namespace for the controller

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('addproduct', [ProductController::class, 'addproduct']);
Route::get('list', [ProductController::class, 'list']);

Route::delete('delete/{id}', [ProductController::class, 'delete']);

Route::get('getSingleproduct/{id}', [ProductController::class, 'getSingleproduct']);

Route::get('search/{key}', [ProductController::class, 'search']); 
Route::post('update/{id}', [ProductController::class, 'update']);






