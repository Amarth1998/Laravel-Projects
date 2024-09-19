<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // Import Validator
class UserAuthController extends Controller
{
    public function login(Request $req)
    {
        // Validate request
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }

        // Find user by email
        $user = User::where('email', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401); // 401 Unauthorized
        }

        // Generate token
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ], 200); // 200 OK
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
