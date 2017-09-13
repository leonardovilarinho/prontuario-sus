<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CargaHoraria;
use App\Model\Dia;
use App\Http\Requests\CargaHorariaRequest;

class CargaHorariaController extends Controller
{
    public function salvar(CargaHorariaRequest $requisicao)
    {
    	$usuario = auth()->user()->nao_medico;
    	if(auth()->user()->medico)
    		$usuario = auth()->user()->medico;

    	if(!$usuario->carga_horaria)
            $usuario->carga_horaria = new CargaHoraria;

        if(!$usuario->dia)
    		$usuario->dia = new Dia;

        $usuario->carga_horaria->fill( $requisicao->all() );
    	$usuario->carga_horaria->save();

        $usuario->dia->fill( [
            'segunda' => $requisicao->has('segunda')      ? 1 : 0,
            'terca' => $requisicao->has('terca')      ? 1 : 0,
            'quarta' => $requisicao->has('quarta')      ? 1 : 0,
            'quinta' => $requisicao->has('quinta')      ? 1 : 0,
            'sexta' => $requisicao->has('sexta')      ? 1 : 0,
            'sabado' => $requisicao->has('sabado')      ? 1 : 0,
            'domingo' => $requisicao->has('domingo')      ? 1 : 0,
            'medico_id' => $requisicao->medico_id,
        ] );
        $usuario->dia->save();

    	return redirect('medicos/config')->withMsg('Carga horária foi salva!');
    }
}
