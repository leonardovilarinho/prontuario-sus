<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PacienteRequest;
use App\Model\Paciente;

class PacienteController extends Controller
{
    public function lista()
    {
        $pacientes = Paciente::paginate( config('prontuario.paginacao') );
        return view('pacientes.lista', compact('pacientes'));
    }

    public function criar()
    {
        $paciente = new Paciente;
        $paciente->prontuario = time();
        return view('pacientes.manipular', compact('paciente'));
    }

    public function salvar(PacienteRequest $requisicao)
    {
        $paciente = Paciente::create($requisicao->all());

        if($requisicao->foto != null)
            $requisicao->foto->storeAs('public/pacientes', $paciente->id.'.jpg');

        return redirect('pacientes')->withMsg($requisicao->nome . ' foi cadastrada(o)!');
    }

    public function apagar($id)
    {
        $paciente = Paciente::find($id);
        $paciente->delete();

        return redirect($_SERVER['HTTP_REFERER'])->withMsg($paciente->nome . ' foi apagada(o)!');
    }

    public function edicao($id)
    {
        $paciente = Paciente::find($id);
        return view('pacientes.manipular', compact('paciente'));
    }

    public function editar(PacienteRequest $requisicao, $id)
    {
        $paciente = Paciente::find($id);
        $paciente->fill($requisicao->all());
        $paciente->save();

        return redirect('pacientes')->withMsg($paciente->nome . ' foi editada(o)!');
    }
}
