<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Paciente;
use App\Model\Prescricao;
use App\Model\Medicamento;
use App\Model\Equipamento;
use App\Model\PescricaoMedicacao;
use App\Model\PescricaoEquipamento;

use App\Http\Requests\PrescricaoRequest;
use App\Http\Requests\PescricaoMedicacaoRequest;
use App\Http\Requests\PescricaoEquipamentoRequest;

class PrescricaoController extends Controller
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
                $paciente->prescricoes = Prescricao::where('paciente_id', $id)
                    ->orderBy('created_at', 'desc')
                ->paginate(config('prontuario.paginacao'));
            }
            else {
                $paciente->prescricoes = Prescricao::where('paciente_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->where('autor_id', auth()->user()->id)
                ->paginate(config('prontuario.paginacao'));
            }
        } 
        else {

            if($usu_val) {

                $paciente->prescricoes = Prescricao::where('paciente_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->where('created_at', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('nome', 'like', '%'.$_GET['q'].'%')
                    ->orWhereHas('autor', function($query) {
                        $query->where('nome', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
                    })
                ->paginate(config('prontuario.paginacao'));
            }
            else {

                $paciente->prescricoes = Prescricao::where('paciente_id', $id)
                    ->where('autor_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->where('created_at', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('nome', 'like', '%'.$_GET['q'].'%')
                    ->orWhereHas('autor', function($query) {
                        $query->where('nome', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                            ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
                    })
                ->paginate(config('prontuario.paginacao'));
            }
        }

    	return view('pacientes.prescricao.lista', compact('prescricoes', 'paciente'));
    }

    public function nova($id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

    	return view('pacientes.prescricao.iniciar', compact('paciente'));
    }

    public function salvar(PrescricaoRequest $requisicao, $id)
    {
    	$paciente = Paciente::find($id);

    	if(!$paciente)
    		return redirect('pacientes')->withErro('Paciente não encontrado');

        $user = (auth()->user()->medico) ? auth()->user()->medico : auth()->user()->nao_medico;

        if(!$user->cabecalho)
            return redirect('pacientes')->withErro('Você não está em um posto');

    	Prescricao::create($requisicao->all() + ['cabecalho_id' => $user->cabecalho_id]);

    	return redirect('pacientes/'.$id.'/prescricoes')->withMsg('Prescrição cadastrada!');
    }

    public function gerenciar($id, $prescricao)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        return view('pacientes.prescricao.gerenciar', compact('prescricao', 'paciente'));
    }

    public function addmed($id, $prescricao)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        if(!isset($_GET['q'])) {
            $medicamentos = Medicamento::paginate( config('prontuario.paginacao') );
        } 
        else {
            $medicamentos = Medicamento::where('nome', 'like', '%'.$_GET['q'].'%')
            ->paginate( config('prontuario.paginacao') );
        }

        return view('pacientes.prescricao.addmed', compact('prescricao', 'paciente', 'medicamentos'));
    }

    public function addmedSal(PescricaoMedicacaoRequest $requisicao, $id, $prescricao)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        PescricaoMedicacao::create($requisicao->all());
        

        return redirect('pacientes/'.$id.'/prescricoes/'.$prescricao->id.'/gerenciar')->withMsg('Medicação adicionada!');
    }

    public function remmed($id, $prescricao, $med)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        $remedio = PescricaoMedicacao::find($med);

        if(!$remedio)
            return redirect('pacientes/'.$id.'/prescricoes/'.$prescricao->id.'/gerenciar')->withErro('Medicação não encontrada');
        
        $remedio->delete();

        return redirect('pacientes/'.$id.'/prescricoes/'.$prescricao->id.'/gerenciar')->withMsg('Medicação apagada!');
    }

    public function addequ($id, $prescricao)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        if(!isset($_GET['q'])) {
            $equipamentos = Equipamento::paginate( config('prontuario.paginacao') );
        } 
        else {
            $equipamentos = Equipamento::where('nome', 'like', '%'.$_GET['q'].'%')
            ->paginate( config('prontuario.paginacao') );
        }

        return view('pacientes.prescricao.addequ', compact('prescricao', 'paciente', 'equipamentos'));
    }

    public function addequSal(PescricaoEquipamentoRequest $requisicao, $id, $prescricao)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        PescricaoEquipamento::create($requisicao->all());
        

        return redirect('pacientes/'.$id.'/prescricoes/'.$prescricao->id.'/gerenciar')->withMsg('Equipamento adicionado!');
    }

    public function remequ($id, $prescricao, $equ)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return redirect('pacientes')->withErro('Paciente não encontrado');

        $prescricao = Prescricao::find($prescricao);

        if(!$prescricao)
            return redirect('pacientes/'.$id.'/prescricoes')->withErro('Prescrição não encontrada');

        $equipamento = PescricaoEquipamento::find($equ);

        if(!$equipamento)
            return redirect('pacientes/'.$id.'/prescricoes/'.$prescricao->id.'/gerenciar')->withErro('Equipamento não encontrado');
        
        $equipamento->delete();

        return redirect('pacientes/'.$id.'/prescricoes/'.$prescricao->id.'/gerenciar')->withMsg('Equipamento apagado!');
    }

    public function apagar($id)
    {

        $rec = Prescricao::find($id);
        $rec->delete();

        return redirect('pacientes/'.$rec->paciente_id.'/prescricoes')->withMsg('Prescrição foi apagada!');
    }
}
