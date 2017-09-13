@extends('layouts.app')

@section('titulo', 'Gerenciamento de férias')

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

    <p>
        Aqui você pode gerenciar seus períodos de férias:
    </p>
    <br>

    {{ Form::open(['url' => 'medicos/folga', 'method' => 'post']) }}
        <section>
            <div>
            	{{ Form::label('data', 'Data') }}
                {{ Form::date('data', '', ['placeholder' => 'Data de início', 'required' => '']) }}

                {{ Form::label('dias', 'Dias') }}
                {{ Form::number('dias', '', ['placeholder' => 'Quantidade de dias', 'required' => '']) }}

                {{ Form::submit('Criar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

	<ul class="lista-comum">
        @foreach ($ferias as $feria)
        	<li>
        		<span>
        			{{ date('d/m/Y', strtotime($feria->data)) }} por {{ $feria->dias }} dias
        		</span>

        		<div class="direita">
	                <a href="{{ url('medicos/folga/'.$feria->id.'/apagar') }}"
	                	class="btn vermelho">
	                	Apagar
	                </a>
	            </div>
        	</li>
        @endforeach
    </ul>

    <section style="text-align:center">
        {{ $ferias->links() }}
    </section>
@endsection