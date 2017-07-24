<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SecretarioRequest;
use App\Model\{Secretario, Usuario};


class SecretarioController extends Controller
{
    public function lista()
    {
        if(!isset($_GET['q']))
            $secretarios = Secretario::paginate( config('prontuario.paginacao') );
        else {
            $secretarios = Secretario::whereHas('usuario', function($query) {
                $query->where('nome', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
            })->paginate( config('prontuario.paginacao') );
        }

        return view('secretarios.lista', compact('secretarios'));
    }

    public function criar()
    {
        $secretario = new Secretario;
        $secretario->usuario = new Usuario;
        return view('secretarios.manipular', compact('secretario'));
    }

    public function salvar(SecretarioRequest $requisicao)
    {
        $usuario = Usuario::create(
            $requisicao->all() +
            ['senha' => bcrypt($requisicao->cpf)]
        );
        Secretario::create(
            [ 'usuario_id' => $usuario->id ] +
            $requisicao->all()
        );

        return redirect('secretarios')->withMsg($usuario->nome . ' foi cadastrada(o)!');
    }

    public function edicao($id)
    {
        $secretario = Secretario::find($id);
        return view('secretarios.manipular', compact('secretario'));
    }

    public function editar(SecretarioRequest $requisicao, $id)
    {
        $secretario = Secretario::find($id);
        $secretario->usuario->fill($requisicao->all());
        $secretario->usuario->save();

        $secretario->fill($requisicao->all());
        $secretario->save();

        return redirect('secretarios')->withMsg($secretario->usuario->nome . ' foi editada(o)!');
    }
}
