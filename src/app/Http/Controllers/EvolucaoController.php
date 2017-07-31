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

        $ehHistorico = (auth()->user()->nao_medico and auth()->user()->nao_medico->historico);
        $usu_val = (auth()->user()->medico or $ehHistorico or auth()->user()->administrador);

        if(!isset($_GET['q'])) {
            if($usu_val) {
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

            if($usu_val) {
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

    public function detalhes($id, $evo)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $evolucao = Evolucao::find($evo);

        if(!$evolucao)
            return redirect('pacientes/'.$id.'/evolucoes')->withErro('Evolução não encontrada');

        return view('pacientes.evolucao.detalhes', compact('paciente', 'evolucao'));
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

        $user = (auth()->user()->medico) ? auth()->user()->medico : auth()->user()->nao_medico;

        if(!$user->cabecalho)
            return redirect('pacientes')->withErro('Você não está em um posto');

    	Evolucao::create($requisicao->all() + ['cabecalho_id' => $user->cabecalho_id]);

    	return redirect('pacientes/gerenciar/'.$id)->withMsg('Evolução foi cadastrada!');
    }

    public function apagar($id)
    {

        $rec = Evolucao::find($id);
        $rec->delete();

        return redirect('pacientes/'.$rec->paciente_id.'/evolucoes')->withMsg('Evolução foi apagada!');
    }
}
