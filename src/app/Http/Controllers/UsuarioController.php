<?php

namespace App\Http\Controllers;

use App\Model\Usuario;
use App\Http\Requests\UsuarioRequest;

class UsuarioController extends Controller
{
    public function bloquear($id)
    {
    	$usuario = Usuario::find($id);
    	$usuario->valido = 0;
    	$usuario->save();
    	return redirect($_SERVER['HTTP_REFERER'])->withMsg($usuario->nome . ' foi bloqueada(o)!');
    }

    public function desbloquear($id)
    {
    	$usuario = Usuario::find($id);
    	$usuario->valido = 1;
    	$usuario->save();

    	return redirect($_SERVER['HTTP_REFERER'])->withMsg($usuario->nome . ' foi desbloqueada(o)!');
    }

    public function apagar($id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();

        return redirect($_SERVER['HTTP_REFERER'])->withMsg($usuario->nome . ' foi apagada(o)!');
    }

    public function redefinir($id)
    {
        $usuario = Usuario::find($id);
        $usuario->senha = bcrypt($usuario->cpf);

        return redirect($_SERVER['HTTP_REFERER'])->withMsg($usuario->nome . ' teve a senha redefinida!');
    }

    public function perfil()
    {
        return view('perfil');
    }

    public function salvarPerfil(UsuarioRequest $requisicao)
    {
        if($requisicao->senha != null)
            $requisicao->merge(['senha' => bcrypt($requisicao->senha)]);

        auth()->user()->fill($requisicao->all());
        auth()->user()->save();

        if(auth()->user()->medico) {
            auth()->user()->medico->fill($requisicao->all());
            auth()->user()->medico->save();
        }
        else  if(auth()->user()->secretario) {
            auth()->user()->secretario->fill($requisicao->all());
            auth()->user()->secretario->save();
        }


        return redirect('perfil')->withMsg('Perfil atualizado!');
    }
}
