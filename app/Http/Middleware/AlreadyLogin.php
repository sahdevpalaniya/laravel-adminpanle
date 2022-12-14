<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if(session()->has('userid') && (url('/') == $request->url('')) or (url('/forgot_password') == $request->url('forgot_password'))){
            return back();
        }
        elseif(session()->has('userid') && (url('/register') == $request->url('register'))){
            return back();
        }
        return $next($request);
    }
}
