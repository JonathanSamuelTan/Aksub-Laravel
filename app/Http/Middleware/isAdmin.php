<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get the user role from database ("user" or "admin")
        $user = User::where('id', auth()->user()->id)->first();
        //check if user is logged in and user role = "admin"
        if (!auth()->check()) {
            return redirect()->route('welcome');
        }elseif($user->role == 'user'){
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
