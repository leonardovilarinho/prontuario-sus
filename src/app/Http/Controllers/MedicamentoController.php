<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Medicamento;
use App\Http\Requests\MedicamentoRequest;

class MedicamentoController extends Controller
{
    public function lista()
    {
    	$medicamentos = Medicamento::orderBy('id', 'desc')->paginate( config('prontuario.paginacao') );

    	return view('hospital.medicamentos.lista', compact('medicamentos'));
    }

    public function salvar(MedicamentoRequest $requisicao)
    {
    	Medicamento::create($requisicao->all());

    	return redirect('hospital/medicamentos')->withMsg('Medicamento salvo!');
    }

    public function apagar($id)
    {
    	Medicamento::destroy($id);

    	return redirect('hospital/medicamentos')->withMsg('Medicamento apagado!');
    }
}
