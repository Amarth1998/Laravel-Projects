<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;


// Home page route (view)
Route::view("/", "home");

// Route to add a new user (POST)
Route::post("/add", [UserController::class, "add"]);

// Route to list all users (GET)
Route::get("/list", [UserController::class, "list"]);

// Route to delete a user by id (GET)
Route::get("/delete/{id}", [UserController::class, "delete"]);

// Route to edit a user (display the edit form) by id (GET)
Route::get("/edit/{id}", [UserController::class, "edit"]);

// Route to update a user by id (PUT)
Route::put("/update/{id}", [UserController::class, "update"]);

Route::get("/search", [UserController::class, "search"]);

Route::post("delete-multi", [UserController::class, "deleteMultiple"]);




//multiple image routes
// Route::view("/","upload");
// Route::post("/upload",[ImageController::class,'upload']);
// Route::get("/list",[ImageController::class,'list']);
