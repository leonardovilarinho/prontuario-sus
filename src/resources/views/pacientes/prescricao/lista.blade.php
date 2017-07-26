@extends('layouts.app')

@section('titulo', 'Prescrições de de ' . $paciente->nome)

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

    <a href="{{ url('pacientes/gerenciar/'.$paciente->id) }}" class="btn secundaria">Voltar</a>

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/prescricoes', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por autor, horário, ou nome']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar as prescrições do paciente <span class="texto-verde">{{ $paciente->nome }}</span>:
    </p>
    <br>
    
    <a class="btn verde" href="{{ url('pacientes/'.$paciente->id.'/prescricoes/nova') }}">
    	Cadastrar nova prescrição
    </a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Autor</td>
            <td>Horário</td>
            <td>Nome</td>
        </tr>

        @foreach($paciente->prescricoes as $prescricao)
            <tr>
                <td>
                    @if(auth()->user()->administrador)
                        <a href="{{ url('pacientes/apagar/' . $paciente->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                    @else
                        <a href="{{ url('pacientes/' . $paciente->id .'/prescricoes/'.$prescricao->id.'/gerenciar') }}"
                        	class="btn azul"
                        >
                            Gerenciar
                        </a>
                    @endif
                </td>
                <td>{{ $prescricao->autor->nome }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($prescricao->created_at)) }}</td>
                <td>{{ $prescricao->nome }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $paciente->prescricoes->links() }}
    </section>
@endsection