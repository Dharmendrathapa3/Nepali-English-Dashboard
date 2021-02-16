<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->delete_status=='1') {
            $user = Auth::user();
            Auth::logout();
            return redirect()->route('login')
                ->withError($user->name . ' , your account was blocked');
        }
     

        return $next($request);
    }
}
