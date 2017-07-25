@extends('layouts.app')

@section('titulo', 'Evoluções de ' . $paciente->nome)

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

    <p style="text-align:center">
        @if(session('msg'))
            <span class="texto-verde">
                {{ session('msg') }}
            </span>
        @endif

         @if(session('erro'))
            <span class="texto-vermelho">
                {{ session('erro') }}
            </span>
        @endif
    </p>

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/evolucoes', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por autor, horário, cid ou resumo']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar as evoluções do paciente <span class="texto-verde">{{ $paciente->nome }}</span>:
    </p>
    <br>
    
    <a class="btn verde" href="{{ url('pacientes/'.$paciente->id.'/evolucoes/nova') }}">
    	Cadastrar nova evolução
    </a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Autor</td>
            <td>Horário</td>
            <td>Resumo</td>
            <td>CID</td>
        </tr>

        @foreach($paciente->evolucoes as $evolucao)
            <tr>
                <td>
                    @if(auth()->user()->administrador)
                        <a href="{{ url('pacientes/apagar/' . $paciente->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                    @else
                        <a href="{{ url('pacientes/' . $paciente->id .'/evolucoes/'.$evolucao->id.'/detalhes') }}"
                        	class="btn verde"
                        >
                            Detalhes
                        </a>
                    @endif
                </td>
                <td>{{ $evolucao->autor->nome }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($evolucao->created_at)) }}</td>
                <td>{{ strlen($evolucao->evolucao) > 80 ? substr($evolucao->evolucao, 0, 78) .'..' : $evolucao->evolucao }}</td>
                <td>{{ ($evolucao->cid  != null) ? $evolucao->cid : 'n/d' }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $paciente->evolucoes->links() }}
    </section>
@endsection