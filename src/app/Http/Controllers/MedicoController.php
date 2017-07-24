<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MedicoRequest;
use App\Model\{Medico, Usuario};

class MedicoController extends Controller
{
    public function lista()
    {
        if(!isset($_GET['q']))
            $medicos = Medico::paginate( config('prontuario.paginacao') );
        else {
            $medicos = Medico::whereHas('usuario', function($query) {
                $query->where('nome', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
            })->paginate( config('prontuario.paginacao') );
        }

        return view('medicos.lista', compact('medicos'));
    }

    public function criar()
    {
        $medico = new Medico;
        $medico->usuario = new Usuario;
        return view('medicos.manipular', compact('medico'));
    }

    public function salvar(MedicoRequest $requisicao)
    {
        $usuario = Usuario::create(
            $requisicao->all() +
            ['senha' => bcrypt($requisicao->cpf)]
        );
        Medico::create(
            [ 'usuario_id' => $usuario->id ] +
            $requisicao->all()
        );

        return redirect('medicos')->withMsg($usuario->nome . ' foi cadastrada(o)!');
    }

    public function edicao($id)
    {
        $medico = Medico::find($id);
        return view('medicos.manipular', compact('medico'));
    }

    public function editar(MedicoRequest $requisicao, $id)
    {
        $medico = Medico::find($id);
        $medico->usuario->fill($requisicao->all());
        $medico->usuario->save();

        $medico->fill($requisicao->all());
        $medico->save();

        return redirect('medicos')->withMsg($medico->usuario->nome . ' foi editada(o)!');
    }

    public function ferias()
    {
        return view('medicos.ferias');
    }

    public function Salvarferias(Request $requisicao)
    {
        auth()->user()->medico->ferias = $requisicao->ferias;
        auth()->user()->medico->save();

        return redirect('medicos/ferias')->withMsg('Férias foram salvas!');
    }
}
