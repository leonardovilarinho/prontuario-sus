<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('titulo') - {{ config('prontuario.nome') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.mob.css') }}" rel="stylesheet" media="(max-width: 992px)">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    </head>

    <body class="pagina">

        <header class="superior">
            <section class="logo">
                <span>
                    {{  config('prontuario.nome')  }}
                </span>
            </section>

            <nav class="links">
                @if(!Auth::guest())
                    <ul>
                        <li><a href="{{ url('perfil') }}">Perfil</a></li>
                        <li><a href="{{ url('sair') }}">Sair</a></li>
                    </ul>
                @endif
            </nav>
        </header>

        <main>
            <div id="topo"></div>

            <aside class="lateral">
                <section class="titulo">
                    @if(Auth::guest())
                        <p>{!! Saudacoes::gerar() !!}</p>
                    @else
                        <p>Olá, {{ explode(' ', auth()->user()->nome)[0] }}</p>
                        <small>{{ date('d/m/Y H:i') }}</small>
                        <small>{{ auth()->user()->tipo() }}</small>
                    @endif
                </section>

                <nav class="menu">
                    <ul>
                        <li class="fixo"><span>Ações a fazer:</span></li>
                        @if(!auth()->guest())
                            <li><a href="{{ url('painel') }}">Inicial</a></li>
                            @if(auth()->user()->administrador)
                                <li><a href="{{ url('postos') }}">Postos</a></li>
                                <li><a href="{{ url('administradores') }}">Administradores</a></li>
                                <li><a href="{{ url('medicos') }}">Médicos</a></li>
                                <li><a href="{{ url('nao-medicos') }}">Profissionais</a></li>
                                <li><a href="{{ url('secretarios') }}">Secretários</a></li>
                                <li><a href="{{ url('pacientes') }}">Pacientes</a></li>
                                <li><a href="{{ url('hospital/medicamentos') }}">Medicamentos</a></li>
                                <li><a href="{{ url('hospital/equipamentos') }}">Equipamentos</a></li>
                                <li><a href="{{ url('hospital/config') }}">Configurações</a></li>

                            @elseif(auth()->user()->medico)
                                <li><a href="{{ url('pacientes') }}">Pacientes</a></li>
                                <li><a href="{{ url('medicos/financas') }}">Finanças</a></li>
                                <li><a href="{{ url('medicos/config') }}">Configurações</a></li>

                            @elseif(auth()->user()->secretario)
                                <li><a href="{{ url('pacientes') }}">Pacientes</a></li>
                                <li><a href="{{ url('medicos') }}">Médicos</a></li>
                                <li><a href="{{ url('secretarios') }}">Secretários</a></li>

                            @elseif(auth()->user()->nao_medico)
                                <li><a href="{{ url('pacientes') }}">Pacientes</a></li>
                            @endif
                        @endif
                        <li><a href="{{ url('sobre') }}">Sobre</a></li>
                        @section('lateral')
                        @show
                    </ul>
                </nav>
            </aside>

            <article class="conteudo">
                <span class="caminho">
                    @if(count(Request::segments()) > 0)
                        @for($i = 0; $i <= count(Request::segments()); $i++)
                            @if(Request::segment($i) != '')
                                <a href="#">{{ Request::segment($i) }}</a>
                            @endif
                        @endfor
                    @else
                        <a href="{{ url('/') }}">Login</a>
                    @endif

                </span>

                <h1>@yield('titulo')</h1>

                @yield('conteudo')
            </article>
        </main>

        <footer class="rodape">
            <span>&copy; Desenvolvido com licença GPL v3 - {{ date('Y') }}</span>
            <a href="#topo">Topo</a>
        </footer>

        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript">
            function printDiv(divName) {
                 var printContents = document.getElementById(divName).innerHTML;
                 var originalContents = document.body.innerHTML;

                 document.body.innerHTML = printContents;

                 window.print();

                 document.body.innerHTML = originalContents;
            }
        </script>
    </body>
</html>
