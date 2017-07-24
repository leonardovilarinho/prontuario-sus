<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CargaHoraria;
use App\Http\Requests\CargaHorariaRequest;

class CargaHorariaController extends Controller
{
    public function manipular()
    {
    	$carga = new CargaHoraria;

    	if(auth()->user()->medico->carga_horaria)
    		$carga = auth()->user()->medico->carga_horaria;
    	
    	return view('carga_horaria.manipular', compact('carga'));
    }

    public function salvar(CargaHorariaRequest $requisicao)
    {
    	if(!auth()->user()->medico->carga_horaria)
    		auth()->user()->medico->carga_horaria = new CargaHoraria;

        auth()->user()->medico->carga_horaria->fill( $requisicao->all() );
    	auth()->user()->medico->carga_horaria->save();
    	
    	return redirect('carga')->withMsg('Carga horária foi salva!');
    }
}
