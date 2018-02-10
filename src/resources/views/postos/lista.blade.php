@extends('layouts.app')

@section('titulo', 'Gerenciamento de postos')

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

    {{ Form::open(['url' => 'postos', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome ou local']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}


    <p>
        Aqui você pode gerenciar qualquer posto registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>
    <a class="btn verde" href="{{ url('postos/novo') }}">Cadastrar novo posto</a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Cidade</td>
            <td>Endereço</td>
            <td>Telefone</td>
            <td>Status</td>
        </tr>

        @foreach($postos as $posto)
            <tr>
                <td>
                    <a href="{{ url('postos/gerenciar/' . $posto->id) }}" class="btn azul">Gerenciar</a>
                </td>
                <td>{{ $posto->nome }}</td>
                <td>{{ $posto->local }}</td>
                <td>{{ $posto->endereco }}</td>
                <td>{{ $posto->telefone }}</td>
                <td>
                    @if($posto->atendida)
                        <button class="btn verde">Ativado</button>
                    @else
                        <button class="btn vermelho">Destivado</button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $postos->links() }}
    </section>
@endsection