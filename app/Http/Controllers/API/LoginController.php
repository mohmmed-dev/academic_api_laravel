<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $requst) {
        $data = $requst->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email' ,$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password) ) {
            return response()->json(['message' => "This Not Invalid User"],401);
        }
        $token = $user->createToken('auth_token')->accessToken;
        return response()->json(['uesr'=> new UserResource($user),'Accss_token' => $token]);
    }
}
