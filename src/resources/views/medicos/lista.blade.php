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
        </tr>

        @foreach($medicos as $medico)
            <tr>
                <td>
                    @if(auth()->user()->administrador)
                        <a href="{{ url('usuarios/apagar/' . $medico->usuario->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                        <a href="{{ url('medicos/editar/' . $medico->id) }}" class="btn amarelo">Editar</a>

                        @if($medico->usuario->valido)
                            <a href="{{ url('usuarios/bloquear/' . $medico->usuario->id) }}" class="btn azul">Bloquear</a>
                        @else
                            <a href="{{ url('usuarios/desbloquear/' . $medico->usuario->id) }}" class="btn verde">Desbloquear</a>
                        @endif
                    @else
                        <a href="{{ url('medicos/editar/' . $medico->id) }}" class="btn amarelo">Editar</a>
                    @endif
                </td>
                <td>{{ $medico->usuario->nome }}</td>
                <td>{{ $medico->usuario->email }}</td>
                <td>{{ $medico->especialidade }}</td>
                <td>{{ $medico->cargo }}</td>
                <td>{{ $medico->conselho }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $medicos->links() }}
    </section>
@endsection