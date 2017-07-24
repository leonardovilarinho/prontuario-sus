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

    public function lista()
    {
        $administradores = Administrador::paginate( config('prontuario.paginacao') );
        return view('administradores.lista', compact('administradores'));
    }

    public function criar()
    {
        $administrador = new Administrador;
        $administrador->usuario = new Usuario;
        return view('administradores.manipular', compact('administrador'));
    }

    public function salvar(UsuarioRequest $requisicao)
    {
        $usuario = Usuario::create(
            $requisicao->all() +
            ['senha' => bcrypt($requisicao->cpf)]
        );

        Administrador::create(
            [ 'usuario_id' => $usuario->id ] +
            $requisicao->all()
        );

        return redirect('administradores')->withMsg($usuario->nome . ' foi cadastrada(o)!');
    }

    public function edicao($id)
    {
        $administrador = Usuario::find($id);
        return view('administradores.manipular', compact('administrador'));
    }

    public function editar(UsuarioRequest $requisicao, $id)
    {
        $administrador = Usuario::find($id);

        $administrador->fill($requisicao->all());
        $administrador->save();

        return redirect('administradores')->withMsg($administrador->nome . ' foi editada(o)!');
    }
}
