<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Requests\RegisterInfoRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function login(LoginRequest $request) {
    
        // Get The User Data
        $user = User::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();
        
        // Check If The User Exist
        if (!$user) {
            return response()->json(["status" => false], 404);
        }

        // Check If The Password Is Correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["status" => false], 401);
        }

        // Generate The Token
        $token = JWTAuth::fromUser($user);
       
        // Response With The Token And User Data
       return response()->json([
            "status" => true,
            "token" => $token,
            "user" => $user->only(['email', 'phone_number', 'id']),
        ], 200);
    }

    public function register(RegisterInfoRequest $request) {
        try {
            // Create New User
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "phone_number" => $request->phone_number,
                "gender" => $request->gender,
                "password" => Hash::make($request->password),
            ]);

            // Generate token for the newly registered user
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(["status" => false, "message" => "Could not create token for user"], 500);
            }

            // Response With The Token And The User Data
            return response()->json([
                "status" => true,
                "token" => $token,
                "user" => $user,
            ], 201);

        } catch (JWTException $e) {
            return response()->json(["status" => false, "message" => "Token creation failed"], 500);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => "User registration failed"], 400);
        }
    }
    

    
}