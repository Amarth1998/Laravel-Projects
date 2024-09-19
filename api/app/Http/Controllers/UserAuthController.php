<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model

class UserAuthController extends Controller
{
    // Login function (not yet implemented)
    function login(Request $req){
        return "loginin";
    }

    // Signup function
    function signup(Request $req){
        
        $input = $req->all(); // Get all input data from the request

        
        $input['password'] = bcrypt($input['password']);// Hash the password using bcrypt

        
        $user = User::create($input); // Create a new user with the input data
        $success['token']= $user->createToken('MyApp')->plainTextToken; // Generate a new token for the user
         
        $user['name']=$user->name;
       return['success'=>true,'result'=>$success,'msg'=>'user register'];
        
    
    }
}
