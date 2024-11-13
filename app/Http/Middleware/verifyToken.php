<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;

class verifyToken
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json(["status" => false, "message" => "Authorization token not found"], 401);
            }

            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(["status" => false, "message" => "User not found"], 401);
            }
        } catch (TokenInvalidException $e) {
            return response()->json(["status" => false, "message" => "Invalid token"], 401);
        } catch (TokenExpiredException $e) {
            return response()->json(["status" => false, "message" => "Token has expired"], 401);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => "Authorization token error"], 401);
        }

        return $next($request);
    }
}


