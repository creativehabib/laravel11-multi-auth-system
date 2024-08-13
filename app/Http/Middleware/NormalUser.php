<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NormalUser
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is not logged in
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $userType = Auth::user()->user_type;

        // Super Admin
        if($userType == 1){
            return redirect()->route('super-admin.dashboard');
        }
        // Admin
        elseif ($userType == 2){
            return redirect()->route('admin.dashboard');
        }
        // Normal User
        return $next($request);
    }
}
