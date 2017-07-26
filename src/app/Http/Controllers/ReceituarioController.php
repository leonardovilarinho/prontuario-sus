<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReceituarioRequest;
use App\Model\{Receituario, Paciente};

class ReceituarioController extends Controller
{
    public function lista($id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');


        if(!isset($_GET['q'])) {
            if(auth()->user()->medico or (auth()->user()->nao_medico and auth()->user()->nao_medico->historico)) {
                $paciente->receituarios = Receituario::where('paciente_id', $id)
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
                
            else {
                $paciente->receituarios = Receituario::where('paciente_id', $id)
                    ->where('autor_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
        } 
        else {

            if(auth()->user()->medico or (auth()->user()->nao_medico and auth()->user()->nao_medico->historico)) {
                $paciente->receituarios = Receituario::where('paciente_id', $id)
                    ->where('created_at', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('conteudo', 'like', '%'.$_GET['q'].'%')
                    ->orWhereHas('autor', function($query) {
                        $query->where('nome', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
                    })
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
            else {
                $paciente->receituarios = Receituario::where('paciente_id', $id)
                    ->where('autor_id', auth()->user()->id)
                    ->where('created_at', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('conteudo', 'like', '%'.$_GET['q'].'%')
                    ->orWhereHas('autor', function($query) {
                        $query->where('nome', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
                    })
                    ->orderBy('created_at', 'desc')
                ->paginate( config('prontuario.paginacao') );
            }
        }


    	return view('pacientes.receituario.lista', compact('paciente'));
    }

    public function detalhes($id, $rec)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $receita = Receituario::find($rec);

        if(!$receita)
            return redirect('pacientes/'.$id.'/receituarios')->withErro('Receituário não encontrado');

        return view('pacientes.receituario.detalhes', compact('paciente', 'receita'));
    }

    public function novo($id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	return view('pacientes.receituario.criar', compact('paciente'));
    }

    public function salvar(ReceituarioRequest $requisicao, $id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	Receituario::create($requisicao->all());

    	return redirect('pacientes/'.$id.'/receituarios')->withMsg('Receituário foi cadastrada!');
    }
}
