@extends('layouts.app')

@section('titulo', 'Gerenciamento de não-médicos')

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

    {{ Form::open(['url' => 'nao-medicos', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome, email ou CPF']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar qualquer não-médico registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>
    <a class="btn verde" href="{{ url('nao-medicos/novo') }}">Cadastrar novo não-médico</a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Especialidade</td>
            <td>Cargo</td>
            <td>Conselho</td>
        </tr>

        @foreach($nmedicos as $nmedico)
            <tr>
                <td>
                    <a href="{{ url('nao-medicos/gerenciar/' . $nmedico->id) }}" class="btn azul">Gerenciar</a>
                </td>
                <td>{{ $nmedico->usuario->nome }}</td>
                <td>{{ $nmedico->usuario->email }}</td>
                <td>{{ $nmedico->especialidade }}</td>
                <td>{{ $nmedico->cargo }}</td>
                <td>{{ $nmedico->conselho }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $nmedicos->links() }}
    </section>
@endsection