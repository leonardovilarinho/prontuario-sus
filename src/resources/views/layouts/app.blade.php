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
                        <li><a href="#">Perfil</a></li>
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
                        <small>{{ auth()->user()->tipo() }}</small>
                    @endif
                </section>

                <nav class="menu">
                    <ul>
                        <li class="fixo"><span>Ações a fazer:</span></li>
                        @if(!auth()->guest())
                            @if(auth()->user()->administrador)
                                <li><a href="{{ url('hospital') }}">Hospital</a></li>
                                <li><a href="{{ url('administradores') }}">Administradores</a></li>
                                <li><a href="{{ url('medicos') }}">Médicos</a></li>
                                <li><a href="{{ url('nao-medicos') }}">Não-Médicos</a></li>
                                <li><a href="{{ url('secretarios') }}">Secretários</a></li>
                            @endif
                        @endif
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
                                <a href="{{ url( implode('/', array_slice(Request::segments(), 0, $i) ) ) }}">{{ Request::segment($i) }}</a>
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
    </body>
</html>
