<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $perm)
    {
        if(stripos($perm, '|') !== false)
            $permissoes = explode('|', $perm);
        else
            $permissoes = [$perm];

        foreach ($permissoes as $permissao) {
            switch ($permissao) {
                case 'adm':
                    if(auth()->user()->administrador)
                        return $next($request);
                break;
                case 'med':
                    if(auth()->user()->medico)
                        return $next($request);
                break;
                case 'nme':
                    if(auth()->user()->nao_medico)
                        return $next($request);
                break;
                case 'sec':
                    if(auth()->user()->secretario)
                        return $next($request);
                break;
            }
        }

        return redirect('/painel');
    }
}
