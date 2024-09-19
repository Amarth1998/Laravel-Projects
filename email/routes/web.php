<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('sendmail',[MailController::class,'sendmail']);
