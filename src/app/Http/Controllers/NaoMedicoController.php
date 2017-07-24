<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NaoMedicoRequest;
use App\Model\{NaoMedico, Usuario};

class NaoMedicoController extends Controller
{
    public function lista()
    {
        $nmedicos = NaoMedico::paginate( config('prontuario.paginacao') );
        return view('nao-medicos.lista', compact('nmedicos'));
    }

    public function criar()
    {
        $nmedico = new NaoMedico;
        $nmedico->usuario = new Usuario;
        return view('nao-medicos.manipular', compact('nmedico'));
    }

    public function salvar(NaoMedicoRequest $requisicao)
    {
        $usuario = Usuario::create(
            $requisicao->all() +
            ['senha' => bcrypt($requisicao->cpf)]
        );
        NaoMedico::create(
            [ 'usuario_id' => $usuario->id ] +
            $requisicao->all()
        );

        return redirect('nao-medicos')->withMsg($usuario->nome . ' foi cadastrada(o)!');
    }

    public function edicao($id)
    {
        $nmedico = NaoMedico::find($id);
        return view('nao-medicos.manipular', compact('nmedico'));
    }

    public function editar(NaoMedicoRequest $requisicao, $id)
    {
        $nmedico = NaoMedico::find($id);
        $nmedico->usuario->fill($requisicao->all());
        $nmedico->usuario->save();

        $nmedico->fill($requisicao->all());
        $nmedico->save();

        return redirect('nao-medicos')->withMsg($nmedico->usuario->nome . ' foi editada(o)!');
    }
}
