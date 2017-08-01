@extends('layouts.app')

@section('titulo', '')

@section('lateral')
    {{-- @parent --}}
    <li><a href="#">Entrar</a></li>
@endsection

@section('conteudo')
    <section class="container">
    	{!! Form::open(['url' => '/', 'method' => 'post', 'autocomplete' => 'off']) !!}
	        <header>
	            Entre no sistema
	        </header>

	        <section>
	            <div>
	                {!! Form::label('email', 'Email') !!}
	                {!! Form::email('email', '', ['required' => '', 'minlength' => 3, 'autocomplete' => 'off']) !!}
	            </div>

	            <div>
	                {!! Form::label('senha', 'Senha') !!}
	                {!! Form::password('senha', ['required' => '', 'minlength' => 6, 'autocomplete' => 'off']) !!}
	            </div>
	        </section>

	        <footer>
	            <span class="texto-vermelho">{{ $errors->first() }}</span>

	            @if(session('erro'))
	            	<span class="texto-vermelho">{!! session('erro') !!}</span>
	            @endif

	            @if(session('msg'))
	            	<span class="texto-verde">{!! session('msg') !!}</span>
	            @endif

	            <section>
	                <input type="submit" value="Entrar" class="btn verde">
	            </section>
	        </footer>
	    {!! Form::close() !!}
    </section>
@endsection