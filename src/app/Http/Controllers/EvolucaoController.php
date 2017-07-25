<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EvolucaoRequest;
use App\Model\{Evolucao, Paciente};

class EvolucaoController extends Controller
{
    public function lista($id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');


        if(!isset($_GET['q'])) {
            if(auth()->user()->medico) {
                $paciente->evolucoes = Evolucao::where('paciente_id', $id)
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
                
            else {
                $paciente->evolucoes = Evolucao::where('paciente_id', $id)
                    ->where('autor_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
        } 
        else {

            if(auth()->user()->medico) {
                $paciente->evolucoes = Evolucao::where('paciente_id', $id)
                    ->where('created_at', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('evolucao', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('cid', 'like', '%'.$_GET['q'].'%')
                    ->orWhereHas('autor', function($query) {
                        $query->where('nome', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
                    })
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
            else {
                $paciente->evolucoes = Evolucao::where('paciente_id', $id)
                    ->where('autor_id', auth()->user()->id)
                    ->where('created_at', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('evolucao', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('cid', 'like', '%'.$_GET['q'].'%')
                    ->orWhereHas('autor', function($query) {
                        $query->where('nome', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
                    })
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
        }


    	return view('pacientes.evolucao.lista', compact('paciente'));
    }

    public function nova($id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	return view('pacientes.evolucao.criar', compact('paciente'));
    }

    public function salvar(EvolucaoRequest $requisicao, $id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	Evolucao::create($requisicao->all());

    	return redirect('pacientes/'.$id.'/evolucoes')->withMsg('Evolução foi cadastrada!');
    }
}
