@extends('layouts.app')

@section('titulo', 'Sobre o sistema')

@section('lateral')

@if(auth()->guest())
	<li><a href="{{ url('') }}">Entrar</a></li>
@endif
@endsection

@section('conteudo')

	<p>
		O projeto tem como intuito fornecer um sistema simples e personalizado para o Sistema Único de Saúde, pois atualmente, os softwares usados não se enquadram na realidade brasileira, além de serem pesados e lentos.
	</p>

	<hr>
	<p>
		<strong>Idealizado por:</strong> <a href="mailto:leanog@gmail.com">Leandro Nogueira</a>
	</p>

	<p>
		<strong>Desenvolvido por:</strong> <a href="mailto:leonardo-i@outlook.com">Leonardo Vilarinho</a>
	</p>

	<p>
		<strong>GitHub:</strong> <a href="https://github.com/leonardovilarinho/prontuario-sus" target="_blank">https://github.com/leonardovilarinho/prontuario-sus</a>
	</p>
	<hr>

	<p>
		Ajude a manter o sistema ativo, doe para a conta corrente abaixo, só assim poderemos trabalhar no projeto, lançando atualizações e corrigindo problemas.
	</p>
	<ul>
	    <li><strong>Banco:</strong> Itaú</li>
	    <li><strong>Agência:</strong> 0106</li>
	    <li><strong>Conta:</strong> 07249-9</li>
	    <li><strong>CPF:</strong> 134.716.616-54</li>
	</ul>
@endsection