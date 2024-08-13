<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
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

        // Admin
        if ($userType == 2){
            return redirect()->route('admin.dashboard');
        }
        // Normal User
        elseif ($userType == 3){
            return redirect()->route('dashboard');
        }
        // Super Admin
        return $next($request);
    }
}
