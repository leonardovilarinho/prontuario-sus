<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MedicoRequest;
use App\Model\{Medico, Usuario, Consulta};

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

    public function ferias()
    {
        return view('medicos.ferias');
    }

    public function salvarFerias(Request $requisicao)
    {
        auth()->user()->medico->ferias = $requisicao->ferias;
        auth()->user()->medico->save();

        return redirect('medicos/ferias')->withMsg('Férias foram salvas!');
    }

    public function doDia()
    {
        $carga = auth()->user()->medico->carga_horaria;

        $agora = strtotime('now');
        $depois =  strtotime('+'.$carga->intervalo.' minutes');

        $inicio = new \DateTime(date('Y-m-d') . ' ' . $carga->inicio);
        $fim = new \DateTime(date('Y-m-d') . ' ' . $carga->fim);

        if($inicio > $fim)
            $fim->add( new \DateInterval('P1D') );

        $intervalo = new \DateInterval('PT'.$carga->intervalo.'M');
        $periodo = new \DatePeriod($inicio, $intervalo ,$fim);
        $ini = $agora;

        foreach($periodo as $data) {
            if($agora <= $data->format('U')) {
                $depois = $data->format('U');
                $ini = $depois - ($carga->intervalo * 60);
                break;
            }
        }


        $futuras = Consulta::where('medico_id', auth()->user()->id)
            ->where('horario', '>=', date('Y-m-d H:i', $depois))
            ->where('horario', 'like', date('Y-m-d', $depois) . '%')
        ->get();

        $passadas = Consulta::where('medico_id', auth()->user()->id)
            ->where('horario', '<', date('Y-m-d H:i', $ini))
            ->where('horario', 'like', date('Y-m-d', $agora) . '%')
        ->get();

        $andamento = Consulta::where('medico_id', auth()->user()->id)
            ->where('horario', '<=', date('Y-m-d H:i', $depois))
            ->where('horario', '>=', date('Y-m-d H:i', $ini))
            ->where('horario', 'like', date('Y-m-d', $agora) . '%')
        ->get();

        return view('medicos.dia', compact('futuras', 'passadas', 'andamento'));
    }
}
