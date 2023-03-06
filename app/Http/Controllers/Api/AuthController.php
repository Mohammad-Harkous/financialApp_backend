<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'is_admin' => 'required'
        ]);

        $user = Users::create([
            'full_name' => $fields['full_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'is_admin' => $fields['is_admin']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = Users::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}










//     public function signup(SignupRequest $request){

//         $data = $request->validated();
        
//         $user = new Users;

//         $user = Users::create([
//             'full_name' => $data['full_name'],
//             'email' => $data['email'],
//             'password' => bcrypt($data['password']),
//             'is_admin' => $data['is_admin']
//         ]);

//         $token = $user->createToken('token')->plainTextToken;

//         return response(compact('user', 'token'));
//     }

//     public function login(LoginRequest $request ){
        
//         $credentials = $request->validated();

//         if (!Auth::attempt($credentials)) {
            
//             return response([
//                 'message' => 'Provided email address or password is incorrect'
//             ]);

//             $user = new Users;
//             $user = Auth::user();
//             $token = $user->createToken('token')->plainTextToken;
//             return response(compact('user', 'token'));

//         }
//     }

//     public function logout(Request $request){

//         $user = new Users;

//         $user =  $request->user();
//         $user->currentAccessToken()->delete();
//         return response('', 204);
//     }
