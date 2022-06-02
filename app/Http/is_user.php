<?php

namespace App\Http;

use Closure;
use Illuminate\Http\Request;

class is_user
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
        if(!auth()->check()|| auth()->user()->is_admin){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
