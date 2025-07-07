<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if Authorization header exists
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'success' => false,
                'message' => 'Token not provided',
                'error' => 'Token not provided'
            ], 401);
        }

        try {
            // Parse and authenticate the token
            $user = JWTAuth::parseToken()->authenticate();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                    'error' => 'User not found'
                ], 401);
            }
            
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token expired',
                'error' => 'Token expired'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token is invalid',
                'error' => 'Token is invalid'
            ], 401);
        } catch (TokenBlacklistedException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token has been blacklisted',
                'error' => 'Token has been blacklisted'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not parse token',
                'error' => 'Could not parse token'
            ], 401);
        }

        return $next($request);
    }
}
