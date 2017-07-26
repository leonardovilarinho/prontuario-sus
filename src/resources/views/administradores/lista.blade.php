@extends('layouts.app')

@section('titulo', 'Gerenciamento de administradores')

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

    {{ Form::open(['url' => 'administradores', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome, email ou CPF']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar qualquer administrador registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>
    <a class="btn verde" href="{{ url('administradores/novo') }}">Cadastrar novo administrador</a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Nascimento</td>
            <td>CPF</td>
        </tr>

        @foreach($administradores as $administrador)
            <tr>
                <td>
                    @if($administrador->usuario->id != 1 and auth()->user()->administrador->usuario_id == 1)
                        <a href="{{ url('administradores/gerenciar/' . $administrador->usuario->id) }}" class="btn azul">Gerenciar</a>
	                @else
	                	<span class="texto-vermelho">Indisponível</span>
	                @endif
                </td>
                <td>{{ $administrador->usuario->nome }}</td>
                <td>{{ $administrador->usuario->email }}</td>
                <td>{{ date('d/m/Y', strtotime($administrador->usuario->nascimento)) }}</td>
                <td>{{ $administrador->usuario->cpf }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $administradores->links() }}
    </section>
@endsection