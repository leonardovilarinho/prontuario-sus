<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Equipamento;
use App\Http\Requests\EquipamentoRequest;

class EquipamentoController extends Controller
{
    public function lista()
    {
    	$equipamentos = Equipamento::orderBy('id', 'desc')->paginate( config('prontuario.paginacao') );

    	return view('hospital.equipamentos.lista', compact('equipamentos'));
    }

    public function salvar(EquipamentoRequest $requisicao)
    {
    	Equipamento::create($requisicao->all());

    	return redirect('hospital/equipamentos')->withMsg('Equipamento salvo!');
    }

    public function apagar($id)
    {
    	Equipamento::destroy($id);

    	return redirect('hospital/equipamentos')->withMsg('Equipamento apagado!');
    }
}
