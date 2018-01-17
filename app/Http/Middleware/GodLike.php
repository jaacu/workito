<?php

namespace App\Http\Middleware;

use Closure;

class GodLike
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        /**
        * Roles:
        * 0: Admin
        * 1: Developer
        * 2: Cliente
        *
        *Alternativos: 
        * 4: Admin y Developer
        */
        
        if( $role == 4){
            if( $request->user()->role == 0 or $request->user()->role == 1){//Si es developer o admin
                return $next($request);
            }            
        }

        if( $request->user()->role == $role ){
            return $next($request);    
        } 
        abort(403);
        // return redirect('/home')->withErrors("NO TIENES LOS PERMISOS NECESARIOS PARA REALIZAR ESA ACCION.");


    }
}
