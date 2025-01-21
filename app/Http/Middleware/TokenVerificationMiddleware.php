<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\JWTTocken;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $result = JWTTocken::VerifyToken($token);
        if($result == "unauthorized"){
            return response()->json(['message' => 'unauthorized'], 401);
        }
        else{
            $request->headers->set('email', $result->userEmail);
            $request->headers->set('userID', $result->userID);
            return $next($request);

        }
    }
}
