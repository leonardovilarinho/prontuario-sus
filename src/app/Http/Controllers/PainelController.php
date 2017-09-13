<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Administrador;
use App\Model\Medico;
use App\Model\NaoMedico;
use App\Model\Secretario;
use App\Model\Paciente;
use App\Model\Consulta;
use App\Model\Evolucao;
use App\Model\Prescricao;
use App\Model\Receituario;
use App\Model\Equipamento;
use App\Model\Medicamento;

class PainelController extends Controller
{
    public function inicial()
    {

    	if(auth()->user()->medico or auth()->user()->nao_medico)
    		return redirect('medicos/dia');

    	if(auth()->user()->secretario)
    		return redirect('pacientes');

		$medicos = Medico::count();
		$nao_medicos = NaoMedico::count();
		$secretarios = Secretario::count();
		$administradores = Administrador::count();
		$consultas = Consulta::count();
		$equipamentos = Equipamento::count();
		$medicamentos = Medicamento::count();
		$pacientes = Paciente::count();
		$evolucoes = Evolucao::count();
		$prescricoes = Prescricao::count();
		$receituarios = Receituario::count();

		return view('administradores.painel', compact(
			'medicos', 'nao_medicos', 'secretarios',
			'administradores', 'consultas', 'equipamentos',
			'medicamentos', 'pacientes', 'evolucoes',
			'prescricoes', 'receituarios'
		));
    }

    public function sobre()
    {
    	return view('sobre');
    }
}
