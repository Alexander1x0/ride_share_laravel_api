<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ResetPasswordRequest;
use Str;
use Mail;
use App\Models\User;
use App\Mail\EmailVerification;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CodeVerifyRequest;
use App\Http\Requests\RegisterInfoRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\EmailVerificationSentRequest;

class AuthController extends Controller
{

    public function login(LoginRequest $request) {
    
        // Get The User Data
        $user = User::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();
        
        // Check If The User Exist
        if (!$user) {
            return response()->json(["status" => false, "message" => "User Not Found"], 404);
        }

        // Check If The Password Is Correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["status" => false, "message" => "This Is Not The Correct Password"], 401);
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
    
    public function emailVerificationSent(EmailVerificationSentRequest $request) {

        // Get The User Data
        $user = User::where('email', $request->email)->first();

        // Check If The User Exist
        if (!$user) {
            return response()->json(['status' => false, "message" => "Enter Email That Match With Account"], 404);
        }

        // Check If Email Already Verified
        if ($user->email_verified_at) {
            return response()->json(["status" => true, "message" => "Email Is Already Verified"], 200);
        }

        // Generate Random Code
        $email_verification_code = Str::random(6);
        $user->email_verification_code = $email_verification_code;
        $user->save();

        // Send The Code To The User Email
        Mail::to($user->email)->send(new EmailVerification($email_verification_code));
        return response()->json(["status" => true, "message" => "Code Has Been Sent Successfully"], 200);

    }

    public function verifyEmail(CodeVerifyRequest $request) {

        // Get The User Data
        $user = User::where('email', $request->email)->where('email_verification_code', $request->email_verification_code)->first();
        
        // Check If Invalid Verification Code
        if (!$user) {
            return response()->json(["status" => false, "message" => "Invalid Verification code"], 400);
        }

        // Set Thagt User Email Is Verified Now
        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->save();
        
        return response()->json(["status" => true, "message" => "Email Verified Successfully"], 200);
    
    }

    public function resetPassword(ResetPasswordRequest $request) {
        // Get User Data
        $user = User::where('email', $request->email)->first();
        // Check If The User Exist
        if (!$user) {
            return response()->json(["status" => false, "message" => "User Not Found"], 404);
        }

        // Update The Password
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(["status" => true, "message" => "Password Updated Successfully"], 200);
    }

    
}