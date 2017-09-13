<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feria;
use App\Model\Usuario;

class FeriaController extends Controller
{
    public function lista()
    {
    	$usuario = auth()->user();
        $medico = ($usuario->medico) ? $usuario->medico : $usuario->nao_medico;

        $ferias = Feria::where('medico_id', $usuario->id)->orderBy('data', 'desc')->paginate( config('prontuario.paginacao') );

    	return view('medicos.feria', compact('usuario', 'medico', 'ferias'));
    }

    public function salvar(Request $requisicao)
    {
    	Feria::create($requisicao->all() + [ 'medico_id' => auth()->user()->id ]);

    	return redirect('medicos/folga')->withMsg('Férias salvs!');
    }

    public function apagar($id)
    {
    	Feria::destroy($id);

    	return redirect('medicos/folga')->withMsg('Férias apagada!');
    }
}
