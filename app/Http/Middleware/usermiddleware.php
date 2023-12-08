<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\facades\auth;
use Symfony\Component\HttpFoundation\Response;

class usermiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth::check()){
            if (auth::user()->role === 'user'){
                return $next($request);
            }
            return redirect()->back()->with('eror',"anda tidak memiliki akses ke halaman ini");
        }
       return redirect ('/')->with('eror',"anda harus login terlwbih dahulu");
    }
}
