<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ruleOne
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->rule!=1){

            return redirect()->route("drive.error");


    }
         return $next($request);
    }
}
