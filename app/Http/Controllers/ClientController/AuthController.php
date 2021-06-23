<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
//        return $request;
        $fields = $request->validate([
            'user_name' => 'bail|required|string|unique:users|min:6|max:16',
            'email' => 'bail|required|string|unique:users,email',
            'password' => 'bail|required|string|min:6|max:16|confirmed'
        ]);
        $user = User::create([
            'user_name' => $fields['user_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'display_name' => $fields['user_name'],
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
//        return $request;
        $fields = $request->validate([
            'user_name' => 'bail|required|string|min:6|max:16',
            'password' => 'bail|required|string|min:6|max:16'
        ]);

        $user = User::where('user_name', $fields['user_name'])->first();

        if(!$user or !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logOut(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }

    public function users(){
        return User::all();
    }
}
