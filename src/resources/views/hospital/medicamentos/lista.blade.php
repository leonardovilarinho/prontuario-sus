@extends('layouts.app')

@section('titulo', 'Gerenciamento de medicamentos')

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

        @if($errors->first())
            <span class="texto-vermelho">
                {{ $errors->first() }}
            </span>
        @endif
    </p>

    {{ Form::open(['url' => 'pacientes', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar os medicamentos padrões do hospital, os médicos poderão inseri-los nas prescrições:
    </p>
    <br>

    {{ Form::open(['url' => 'hospital/medicamentos/novo', 'method' => 'post']) }}
        <section>
            <div>
            	{{ Form::label('nome', 'Nome') }}
                {{ Form::text('nome', '', ['placeholder' => 'Nome do medicamento', 'required' => '']) }}
                {{ Form::submit('Criar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

	<ul class="lista-comum">
        @foreach ($medicamentos as $medicamento)
        	<li>
        		<span>
        			{{ $medicamento->nome }}
        		</span>

        		<div class="direita">
	                <a href="{{ url('hospital/medicamentos/'.$medicamento->id.'/apagar') }}"
	                	class="btn vermelho">
	                	Apagar
	                </a>
	            </div>
        	</li>
        @endforeach
    </ul>

    <section style="text-align:center">
        {{ $medicamentos->links() }}
    </section>
@endsection