<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //super admin role = 0
        //admin role = 1
        //user role = 1
        if (Auth::check()) {
            if (Auth::user()->role == '0') {
                //return super admin
                return $next($request);
            if (Auth::user()->role == '1') {
                return $next($request);
            }
            }else{
                return redirect('/home')->with('message','Access Denied!, Your are not an admin');
            }
        }else{
            return redirect('/login')->with('message','Login to access');
        }

        return $next($request);
    }
}
