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
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::check()){
                if(Auth::user()->role_as == '1'){
                    return $next($request);
                                  

                }else if(Auth::user()->role_as == '0'){
                    return $next($request);

                }else{
                    return redirect('/home')->with('message','Access Denied ! You Are Not Admin');
                }   
            }
    
        }else{
            return redirect('login')->with('message','Please Logged in First!!');
        }
        return $next($request);
      
    }
}
