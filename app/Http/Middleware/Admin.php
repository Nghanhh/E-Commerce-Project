<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next đây là một instance của lớp Closure trong PHP.
     */
    public function handle(Request $request, Closure $next): Response //type hinting cho kiểu trả về (return type hinting).
    {
        if(Auth::check() && Auth::user()->level ==1){
            return $next($request);
        }else{
            Auth::logout();
            return redirect('admin/login');
        }
        
    }
}
