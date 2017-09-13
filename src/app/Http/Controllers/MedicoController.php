<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MedicoRequest;
use App\Model\Medico;
use App\Model\Usuario;
use App\Model\Consulta;
use App\Model\CargaHoraria;
use App\Model\Cabecalho;
use App\Model\PermissaoPosto;
use App\Model\Dia;

class MedicoController extends Controller
{
    public function lista()
    {
        if(!isset($_GET['q']))
            $medicos = Medico::paginate( config('prontuario.paginacao') );
        else {
            $medicos = Medico::whereHas('usuario', function($query) {
                $query->where('nome', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('email', 'like', '%'.$_GET['q'].'%')
                    ->orWhere('cpf', 'like', '%'.$_GET['q'].'%');
            })->paginate( config('prontuario.paginacao') );
        }

        return view('medicos.lista', compact('medicos'));
    }

    public function gerenciar($id)
    {
        $medico = Medico::find($id);

        if(!$medico)
            return redirect('medicos');

        return view('medicos.gerenciar', compact('medico'));
    }

    public function criar()
    {
        $medico = new Medico;
        $medico->usuario = new Usuario;
        return view('medicos.manipular', compact('medico'));
    }

    public function salvar(MedicoRequest $requisicao)
    {
        $usuario = Usuario::create(
            $requisicao->all() +
            ['senha' => bcrypt($requisicao->cpf)]
        );
        Medico::create(
            [ 'usuario_id' => $usuario->id ] +
            $requisicao->all()
        );

        return redirect('medicos')->withMsg($usuario->nome . ' foi cadastrada(o)!');
    }

    public function edicao($id)
    {
        $medico = Medico::find($id);
        return view('medicos.manipular', compact('medico'));
    }

    public function editar(MedicoRequest $requisicao, $id)
    {
        $medico = Medico::find($id);
        $medico->usuario->fill($requisicao->all());
        $medico->usuario->save();

        $medico->fill($requisicao->all());
        $medico->save();

        return redirect('medicos/gerenciar/'.$id)->withMsg($medico->usuario->nome . ' foi editada(o)!');
    }

    public function config()
    {
        $carga = new CargaHoraria;
        $usuario = auth()->user()->nao_medico;
        if(auth()->user()->medico)
            $usuario = auth()->user()->medico;

        if($usuario->carga_horaria)
            $carga = $usuario->carga_horaria;

        if(!$usuario->dia)
            $usuario->dia = new Dia;


        return view('medicos.config', compact('carga', 'usuario'));
    }

    public function salvarFerias(Request $requisicao)
    {
        $usuario = auth()->user()->nao_medico;
        if(auth()->user()->medico)
            $usuario = auth()->user()->medico;

        $usuario->ferias = $requisicao->ferias;
        $usuario->save();

        return redirect('medicos/config')->withMsg('Férias foram salvas!');
    }

    public function doDia()
    {
        $medico = (auth()->user()->medico) ? auth()->user()->medico : auth()->user()->nao_medico;
        if(!$medico->carga_horaria)
            return redirect('medicos/config')->withMsg('Por favor, configure seus horários');

        $postos_ = Cabecalho::where('atendida', 1)->get();
        $postos = [];

        foreach ($postos_ as $k => $value) {
            $verificar = PermissaoPosto::where('cabecalho_id', $value->id)
                ->where('usuario_id', $medico->usuario_id)
            ->first();
            if(!$verificar)
                unset($postos_[$k]);
        }

        foreach ($postos_ as $value)
            $postos[$value->id] = $value->nome .' | ' . $value->local;

        if(!isset($_GET['data']))
            $_GET['data'] = date('Y-m-d');

        $_GET['data'] = $_GET['data'];

        $n_atendidas = Consulta::where('usuario_id', auth()->user()->id)
            ->where('atendida', 0)
            ->where('horario', 'like', $_GET['data'].'%')
            ->orderBy('horario', 'asc')
        ->get();

        $atendidas = Consulta::where('usuario_id', auth()->user()->id)
            ->where('atendida', 1)
            ->where('horario', 'like', $_GET['data'].'%')
        ->get();

        return view('medicos.dia', compact('atendidas', 'n_atendidas', 'postos', 'medico'));
    }

    public function financas()
    {
        if(!isset($_GET['data']))
            $_GET['data'] = date('Y-m-d');

        $_GET['data'] = $_GET['data'];

        if(isset($_GET['valor'])) {
            $consulta = Consulta::find($_GET['id']);
            $consulta->valor = $_GET['valor'];
            $consulta->save();
            return redirect('medicos/financas?data='.$_GET['data']);
        }

        $n_atendidas = Consulta::where('usuario_id', auth()->user()->id)
            ->where('atendida', 0)
            ->where('horario', 'like', $_GET['data'].'%')
            ->orderBy('horario', 'asc')
        ->get();

        $atendidas = Consulta::where('usuario_id', auth()->user()->id)
            ->where('atendida', 1)
            ->where('horario', 'like', $_GET['data'].'%')
        ->get();

        $preco = 0;
        foreach ($n_atendidas as $value)
            $preco += $value->valor;
        foreach ($atendidas as $value)
            $preco += $value->valor;

        return view('medicos.financas', compact('atendidas', 'n_atendidas', 'postos', 'preco'));
    }

    public function lugar(Request $requisicao)
    {
        $posto = Cabecalho::find($requisicao->posto);

        if(!$posto)
            return redirect('medicos/dia')->withErro('Posto inválido!');

        $medico = (auth()->user()->medico) ? auth()->user()->medico : auth()->user()->nao_medico;
        $medico->cabecalho_id = $posto->id;
        $medico->save();

        return redirect('medicos/dia')->withMsg('Posto alterado!');
    }
}
