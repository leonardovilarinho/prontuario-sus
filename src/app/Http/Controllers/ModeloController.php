<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Usuario;
use App\Model\Modelo;

class ModeloController extends Controller
{
    public function lista() {
    	$usuario = Usuario::find(auth()->user()->id);
        $medico = ($usuario->medico) ? $usuario->medico : $usuario->nao_medico;

        $select = [];

       	foreach ($medico->modelos as $mol) {
       		$select[$mol->id] = $mol->titulo;
       	}

       	$modelo = new Modelo;

       	if(isset($_GET['modelo'])) {
       		$m = Modelo::find($_GET['modelo']);

       		if($m) {
       			if($m->medico_id == $usuario->id) {
       				$modelo = $m;
       			}
       		}
       	}

        return view('modelos.lista', compact('medico', 'select', 'modelo'));
    }

    public function novo(Request $r) {
    	$usuario = Usuario::find(auth()->user()->id);
      $medico = ($usuario->medico) ? $usuario->medico : $usuario->nao_medico;

      if($r->tipo == 'novo') {
        Modelo::create($r->all() + [ 'medico_id' => $medico->usuario_id ]);

        return redirect('modelos')->withMsg('Modelo foi criado!');
      }

      $m = Modelo::find($r->modelo);
      $m->fill($r->all());
      $m->save();

      return redirect('modelos')->withMsg('Modelo foi editado!');
      
    }

    public function manipular(Request $r) {
    	$usuario = Usuario::find(auth()->user()->id);
        $medico = ($usuario->medico) ? $usuario->medico : $usuario->nao_medico;

        if($r->acao == 'Apagar') {
        	Modelo::destroy($r->modelo);
        	return redirect('modelos')->withMsg('Modelo foi apagado!');
        }

        return redirect('modelos?modelo='.$r->modelo);
    }
}
