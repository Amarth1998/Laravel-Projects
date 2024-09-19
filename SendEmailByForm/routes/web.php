<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

use Illuminate\Support\Str;

Route::view('/','mail');
Route::post('sendmail',[MailController::class,'sendmail']);
