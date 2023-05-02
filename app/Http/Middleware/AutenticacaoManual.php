<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;

class AutenticacaoManual extends Middleware
{


    public function handle($request, Closure $next, ...$guards)
    {
        if (session('email') != '') {
            return $next($request);
        } else {
           return redirect()->back()->withErrors(['msg' => 'Não autenticado! Realize o login...']);
        }
    }

}
