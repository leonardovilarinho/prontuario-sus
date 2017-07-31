@extends('layouts.app')

@section('titulo', 'Gerenciamento de médicos')

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

    {{ Form::open(['url' => 'medicos', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome, email ou CPF']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}


    <p>
        Aqui você pode gerenciar qualquer médico registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>

    @if(auth()->user()->administrador)
        <a class="btn verde" href="{{ url('medicos/novo') }}">Cadastrar novo médico</a>
    @endif

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Especialidade</td>
            <td>Cargo</td>
            <td>Conselho</td>
            <td>Nascimento</td>
        </tr>

        @foreach($medicos as $medico)
            <tr>
                <td>
                    <a href="{{ url('medicos/gerenciar/' . $medico->id) }}" class="btn azul">Gerenciar</a>
                </td>
                <td>{{ $medico->usuario->nome }}</td>
                <td>{{ $medico->usuario->email }}</td>
                <td>{{ $medico->especialidade }}</td>
                <td>{{ $medico->cargo }}</td>
                <td>{{ $medico->conselho }}</td>
                <td>{{ date('d/m/Y', strtotime($medico->usuario->nascimento)) }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $medicos->links() }}
    </section>
@endsection

