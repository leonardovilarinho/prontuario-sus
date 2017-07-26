<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{Administrador, Usuario};
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function entrar()
    {
        if(Administrador::all()->count() == 0)
            return redirect('administradores/primeiro');

        if(!auth()->guest())
            return redirect('painel');
        
        return view('login');
    }

    public function logar(LoginRequest $requisicao)
    {
    	$senha = $requisicao->senha;

    	$usuario = Usuario::where('email', $requisicao->email )->first();

    	if(!$usuario)
    		return redirect('')->withErro('Usuário não encontrado');

    	if(!password_verify($senha, $usuario->senha))
    		return redirect('')->withErro('Senha está errada');

    	if($usuario->valido == 0)
    		return redirect('')->withErro('Você foi bloqueado do sistema');

    	auth()->login($usuario);
    	return redirect('painel');
    }

    public function sair()
    {
        auth()->logout();

        return redirect('');
    }
}
