<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLogin;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = UserLogin::where('email', $request->email)->first();
    
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message'=>'Unauthorized'],401);
        }
    
        $token = $user->createToken('api-token')->plainTextToken;
    
        return response()->json([
            'token'=>$token,
            'user'=>$user
        ]);
    }
}
