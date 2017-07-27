<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{Administrador, Medico, NaoMedico, Secretario, Paciente, Consulta, Evolucao, Prescricao, Receituario, Equipamento, Medicamento};

class PainelController extends Controller
{
    public function inicial()
    {

    	if(auth()->user()->medico)
    		return redirect('medicos/dia');


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
}
