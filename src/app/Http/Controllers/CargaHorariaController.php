<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CargaHoraria;
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

        $usuario->carga_horaria->fill( $requisicao->all() );
    	$usuario->carga_horaria->save();

    	return redirect('medicos/config')->withMsg('Carga horária foi salva!');
    }
}
