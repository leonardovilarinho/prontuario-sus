<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cabecalho;
use App\Http\Requests\CabecalhoRequest;
use Illuminate\Support\Facades\Storage;

class CabecalhoController extends Controller
{
    public function lista()
    {
        if(!isset($_GET['q']))
            $postos = Cabecalho::paginate( config('prontuario.paginacao') );
        else {
            $postos = Cabecalho::where('nome', 'like', '%'.$_GET['q'].'%')
                ->orWhere('local', 'like', '%'.$_GET['q'].'%')
            ->paginate( config('prontuario.paginacao') );
        }

        return view('postos.lista', compact('postos'));
    }

    public function gerenciar($id)
    {
        $posto = Cabecalho::find($id);

        if(!$posto)
            return redirect('postos');

        return view('postos.gerenciar', compact('posto'));
    }

    public function criar()
    {
        $posto = new Cabecalho;
        return view('postos.manipular', compact('posto'));
    }

    public function salvar(CabecalhoRequest $requisicao)
    {
        $p = Cabecalho::create(
            $requisicao->all()
        );

        if($requisicao->logo != null)
            $requisicao->logo->storeAs('public/postos/', $p->id.'.jpg');

        return redirect('postos')->withMsg($p->nome . ' foi cadastrado!');
    }

    public function apagar($id)
    {
    	$p = Cabecalho::find($id);
    	$p->delete();

		Storage::delete('postos/'.$id.'.jpg');

        return redirect('postos')->withMsg($p->nome . ' foi apagado!');
    }

    public function edicao($id)
    {
        $posto = Cabecalho::find($id);
        return view('postos.manipular', compact('posto'));
    }

    public function editar(CabecalhoRequest $requisicao, $id)
    {
    	if($requisicao->logo != null)
            $requisicao->logo->storeAs('public/postos/', $id.'.jpg');


        $posto = Cabecalho::find($id);
        $posto->fill($requisicao->all());
        $posto->save();

        return redirect('postos/gerenciar/'.$id)->withMsg($posto->nome . ' foi editado!');
    }
}
