<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{

    public function show(ProfileRequest $request) {

        // Get User Data
        $user = auth()->user();

        // Check If User Exist
        if (!$user) {
            return response()->json(["status" => false, "message" => "User Not Found"], 404);
        }

        return response()->json([
            "status" => true,
            "user" => $user->only(['name', 'email', 'phone_number', 'gender','id']),
        ]);
    }

    public function update( ProfileRequest $request) {
  
        // Get User Data
        $user = auth()->user();

        // Check If User Exist
        if (!$user) {
            return response()->json(["status" => false, "message" => "User Not Found"], 404);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('phone_number')) {
            $user->phone_number = $request->phone_number;
        }
        if ($request->has('gender')) {
            $user->gender = $request->gender;
        }
        $user->save();

        return response()->json([
            "status" => true,
            "user" => $user->only(['name', 'email', 'phone_number', 'gender', 'id'], 200),
        ]);
    }
}
