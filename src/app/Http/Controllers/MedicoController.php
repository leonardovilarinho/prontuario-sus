<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MedicoRequest;
use App\Model\{Medico, Usuario, Consulta, CargaHoraria, Cabecalho};

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

        if(auth()->user()->medico->carga_horaria)
            $carga = auth()->user()->medico->carga_horaria;

        return view('medicos.config', compact('carga'));
    }

    public function salvarFerias(Request $requisicao)
    {
        auth()->user()->medico->ferias = $requisicao->ferias;
        auth()->user()->medico->save();

        return redirect('medicos/config')->withMsg('Férias foram salvas!');
    }

    public function doDia()
    {
        if(!auth()->user()->medico->carga_horaria)
            return redirect('medicos/config')->withMsg('Por favor, configure seus horários');

        $carga = auth()->user()->medico->carga_horaria;

        $agora = strtotime('now');
        
        $postos_ = Cabecalho::all();

        $postos = [];

        foreach ($postos_ as $value) {
            $postos[$value->id] = $value->nome .' | ' . $value->local;
        }

        $depois =  strtotime('+'.$carga->intervalo.' minutes');

        $inicio = new \DateTime(date('Y-m-d') . ' ' . $carga->inicio);
        $fim = new \DateTime(date('Y-m-d') . ' ' . $carga->fim);

        if(isset($_GET['dias'])) {
            $_GET['dias'] = (int)$_GET['dias'];
            $fim->add( new \DateInterval('P' . ($_GET['dias'] - 1) . 'D') );
        }

        if($inicio > $fim) {
            $inicio->sub( new \DateInterval('P1D') );
        }

        

        $intervalo = new \DateInterval('PT'.$carga->intervalo.'M');
        $periodo = new \DatePeriod($inicio, $intervalo ,$fim);

        foreach($periodo as $data) {
            if($agora <= $data->format('U')) {
                $depois = $data->format('U');
                break;
            }
        }


        $futuras = Consulta::where('medico_id', auth()->user()->id)
            ->where('horario', '>=', $inicio->format('Y-m-d H:i'))
            ->where('horario', '<=', $fim->format('Y-m-d H:i'))
            ->where('atendida', 0)
            ->orderBy('horario', 'asc')
        ->get();

        $passadas = Consulta::where('medico_id', auth()->user()->id)
            ->where('horario', '>=', $inicio->format('Y-m-d H:i'))
            ->where('horario', '<=', $fim->format('Y-m-d H:i'))
            ->where('atendida', 1)
            ->orderBy('horario', 'asc')
        ->get();


        return view('medicos.dia', compact('futuras', 'passadas', 'inicio', 'fim', 'postos'));
    }

    public function lugar(Request $requisicao)
    {
        $posto = Cabecalho::find($requisicao->posto);

        if(!$posto)
            return redirect('medicos/dia')->withErro('Posto inválido!');


        auth()->user()->medico->cabecalho_id = $posto->id;
        auth()->user()->medico->save();

        return redirect('medicos/dia')->withMsg('Posto alterado!');
    }
}
