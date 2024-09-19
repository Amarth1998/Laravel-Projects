<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class MailController extends Controller
{
    function sendmail(Request $req){
       $to=$req->to;
       $subject=$req->subject;
       $msg=$req->message; 
       Mail::to($to)->send(new WelcomeEmail($msg,$subject)); 
       return "Email Send";
    }
}
