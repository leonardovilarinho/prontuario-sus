<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Usuario;
use App\Model\Cabecalho;
use App\Model\PermissaoPosto;
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

    public function ativar($id)
    {
    	$p = Cabecalho::find($id);
        $p->atendida = 1;
    	$p->save();

        return redirect('postos')->withMsg($p->nome . ' foi ativado!');
    }

    public function desativar($id)
    {
        $p = Cabecalho::find($id);
        $p->atendida = 0;
        $p->save();

        return redirect('postos')->withMsg($p->nome . ' foi desativado!');
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

    public function usuarios($id)
    {
        $posto = Cabecalho::find($id);
        $usuarios = Usuario::all();
        foreach ($usuarios as $ch => $usuario) {
            if(!$usuario->medico and !$usuario->nao_medico)
                unset($usuarios[$ch]);
        }

        $uposto = [];
        foreach ($posto->usuarios as $usuario) {
            $uposto[] = $usuario->usuario_id;
        }

        return view('postos.usuarios', compact('posto', 'usuarios', 'uposto'));
    }

    public function trocarUsuarios(Request $request, $id)
    {
        $usuarios = PermissaoPosto::where('cabecalho_id', $id)->get();
        foreach ($usuarios as $user) {
            $user->delete();
        }

        if($request->has('usuarios')) {
            foreach ($request->usuarios as $user) {
                PermissaoPosto::create([
                    'cabecalho_id' => $id,
                    'usuario_id' => $user
                ]);
            }
        }


        return redirect('postos/usuarios/'.$id)->withMsg('Usuários salvos!');
    }
}
