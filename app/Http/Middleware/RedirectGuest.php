<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectGuest
{
    public function handle($request, Closure $next)
    {
        if (Auth::id() == 12) {
            // Log out the currently authenticated user
            Auth::logout();

            // Redirect to the login page
            return redirect()->route('customers.login')->with('error', 'You must log in to proceed.');
        }

        return $next($request);
    }
}