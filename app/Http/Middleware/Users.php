<?php

namespace App\Http\Middleware;

use Closure;

class Users
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
        if( $request->user()->isConfirmed() ){
            return $next($request);
        } else {
            return redirect('/home')->withErrors("Servicio valido solo para usuarios verificados.");
        }

    }
}
