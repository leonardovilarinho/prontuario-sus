<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReceituarioRequest;
use App\Model\Receituario;
use App\Model\Paciente;
use App\Model\Modelo;
use App\Model\Usuario;

class ReceituarioController extends Controller
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

            if($usu_val) {
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

    public function historico($id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	return view('pacientes.receituario.historico', compact('paciente'));
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

    public function detalhes2($id, $rec)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $receita = Receituario::find($rec);

        if(!$receita)
            return redirect('pacientes/'.$id.'/receituarios')->withErro('Receituário não encontrado');

        return view('pacientes.receituario.detalhes2', compact('paciente', 'receita'));
    }

    public function novo($id)
    {
    	$paciente = Paciente::find($id);
        $usuario = Usuario::find(auth()->user()->id);
        $medico = ($usuario->medico) ? $usuario->medico : $usuario->nao_medico;
        $modelos = $medico->selectModelos();

        $valor = '';
        if(isset($_GET['modelo']))
            $valor = Modelo::find($_GET['modelo'])->conteudo;

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	return view('pacientes.receituario.criar', compact('paciente', 'modelos', 'valor'));
    }

    public function salvar(ReceituarioRequest $requisicao, $id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

        $user = (auth()->user()->medico) ? auth()->user()->medico : auth()->user()->nao_medico;

        if(!$user->cabecalho)
            return redirect('pacientes')->withErro('Você não está em um posto');

    	$rec = Receituario::create($requisicao->all() + ['cabecalho_id' => $user->cabecalho_id]);

        if($requisicao->has('controle'))
            return redirect('pacientes/'.$id.'/receituarios/'.$rec->id.'/detalhes2')->withMsg('Receituário foi cadastrada!');

    	return redirect('pacientes/'.$id.'/receituarios/'.$rec->id.'/detalhes')->withMsg('Receituário foi cadastrada!');
    }

    public function apagar($id)
    {

        $rec = Receituario::find($id);
        $rec->delete();

        return redirect('pacientes/'.$rec->paciente_id.'/receituarios')->withMsg('Receituário foi apagado!');
    }
}
