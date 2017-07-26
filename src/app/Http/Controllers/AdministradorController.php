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
        if(!isset($_GET['q']))
            $administradores = Administrador::paginate( config('prontuario.paginacao') );
        else {
            $administradores = Administrador::whereHas('usuario', function($query) {
                $query->where('nome', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
            })->paginate( config('prontuario.paginacao') );
        }
        
        return view('administradores.lista', compact('administradores'));
    }

    public function gerenciar($id)
    {
        $administrador = Administrador::find($id);

        if(!$administrador)
            return redirect('administradores');

        return view('administradores.gerenciar', compact('administrador'));
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

        return redirect('administradores/gerenciar/'.$id)->withMsg($administrador->nome . ' foi editada(o)!');
    }
}
