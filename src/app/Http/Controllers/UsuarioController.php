<?php

namespace App\Http\Controllers;


use App\Model\Usuario;

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
}
