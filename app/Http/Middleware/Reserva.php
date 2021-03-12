<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Reserva
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
        if (Auth::user()->temFuncao('Assistente Social Santa Casa') ||
            Auth::user()->temFuncao('Master') ||
            Auth::user()->temFuncao('Funcionario Casa de Apoio')) {
            return $next($request);
        }

        return redirect('home');
    }
}
