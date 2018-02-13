<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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

        if(Auth::check()&& Auth::user()->admin === 1) {
            return $next($request);
        }else{
            return redirect('/')->with(['message'=>'لا يمكنك تسجيل الدخول الا من خلال المدير ']);
        }


      // if(Auth::check()){

           // dd(Auth::user()->admin);

           // if(Auth::user()->admin != 1){
             //   return view('welcome');
           // }
        //}


    }
}
