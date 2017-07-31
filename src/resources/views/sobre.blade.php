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
		Ajude a manter o sistema ativo, doe algum capital ao clicar no botão abaixo, só assim poderemos trabalhar no projeto, lançando atualizações e corrigindo problemas.
	</p>
    <section class="container">
    	<form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" target="_blank" method="post" style="width: 200px; ">
			<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
			<input type="hidden" name="currency" value="BRL" />
			<input type="hidden" name="receiverEmail" value="leonardo-i@outlook.com" />
			<input type="hidden" name="iot" value="button" />
			<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/209x48-doar-roxo-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
		</form>
    </section>
@endsection