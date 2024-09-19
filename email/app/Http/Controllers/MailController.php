<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class MailController extends Controller
{
    function sendmail(){
       $to="amarthpatel.ap@gmail.com";
       $msg="dummy mail by amarth";
       $subject="laravel mail";
       Mail::to($to)->send(new WelcomeEmail($msg,$subject)); 
    }
}
