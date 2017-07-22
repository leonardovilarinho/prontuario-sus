<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{Administrador, Usuario};
use App\Http\Requests\UsuarioRequest;

class AdministradorController extends Controller
{
    public function primeiro()
    {
        if(Administrador::all()->count() > 0)
            return redirect('');

        return view('administradores.primeiro');
    }

    public function cadastrarPrimeiro(UsuarioRequest $requisicao)
    {
        if(Administrador::all()->count() > 0)
            return redirect('');

        $usuario = Usuario::create(
            $requisicao->except('senha') +
            ['senha' => bcrypt( $requisicao->senha )]
        );

        Administrador::create([
            'usuario_id' => $usuario->id
        ]);

        auth()->login($usuario);
        return redirect('painel');
    }
}
