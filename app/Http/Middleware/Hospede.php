<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Hospede
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
        if (Auth::user()->temFuncao('Funcionario Casa de Apoio') || Auth::user()->temFuncao('Master')) {
            return $next($request);
        }

        return redirect('home');
    }
}