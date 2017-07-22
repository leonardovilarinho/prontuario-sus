@extends('layouts.app')

@section('titulo', 'Inicial')

@section('lateral')
    {{-- @parent --}}
    <li><a href="#">Item person</a></li>
@endsection

@section('conteudo')
    <p>
        Ea consectetur incididunt sint do ex est velit consectetur cillum ad cillum. Lorem pariatur deserunt reprehenderit dolor. Dolore esse nulla et tempor occaecat sint nostrud magna esse cupidatat veniam reprehenderit est est
    </p>
    <h2>Título secundário da página</h2>
    <p>
        <button class="btn verde">Verde</button>
        <button class="btn azul">Azul</button>
        <a class="btn amarelo" href="#">Amarelo</a>
        <input class="btn vermelho" type="submit" value="Vermelho">
    </p>

    <h3>Título terciário da página</h3>
    <p>Painel simples:</p>
    <section class="cartao">
        <header>
            Titulo
        </header>
        <article>
            Conteudo
        </article>
        <footer>
            <button class="btn verde">Verde</button>
            <button class="btn azul">Azul</button>
        </footer>
    </section>

    <p>Lista simples:</p>
    <ul class="lista-comum">
        <li>Meu 1º item da lista</li>
    </ul>

    <ul class="lista-vermelha">
        <li>Meu 1º item da lista</li>
        <li>Meu 2º item da lista</li>

    </ul>

    <ul class="lista-amarela">
        <li>Meu 1º item da lista</li>
        <li>Meu 2º item da lista</li>
        <li>Meu 3º item da lista</li>
    </ul>

    <ul class="lista-azul">
        <li>Meu 1º item da lista</li>
        <li>Meu 2º item da lista</li>
        <li>Meu 3º item da lista</li>
        <li>Meu 4º item da lista</li>
    </ul>

    <ul class="lista-verde">
        <li>Meu 1º item da lista</li>
        <li>Meu 2º item da lista</li>
        <li>Meu 3º item da lista</li>
        <li>Meu 4º item da lista</li>
        <li>
            <span>Meu 5º item da lista</span>
            <div class="direita">
                <button class="btn amarelo">Editar</button>
                <button class="btn vermelho">Apagar</button>
            </div>
        </li>
    </ul>

    <form action="#">
        <header>
            Meu formulário:
        </header>

        <section>
            <div>
                <label>Nome</label>
                <input type="text" name="nome">

                <label>Sexo</label>
                <select>
                    <option>Feminino</option>
                    <option>Maculino</option>
                    <option>não definido</option>
                </select>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email">

                <label>Telefone de contato</label>
                <input type="tel" name="telefone">
            </div>

            <div>
                <label>CEP</label>
                <input type="text" required name="email">

                <label>Nascimento</label>
                <input type="date" name="telefone">

                <label>Idade</label>
                <input type="number" name="telefone">
            </div>

            <div>
                <label>Cliente novo</label>
                <div class="selecao">
                    <input type="radio" id="sim" name="switch" value="yes" checked/>
                    <label for="sim">Sim</label>

                    <input type="radio" id="nao" name="switch" value="no" />
                    <label for="nao">Não</label>
                </div>

                <label>Selecionar</label>
                <div class="marcador">
                    <input type="checkbox" id="switch" />
                    <label for="switch">Toggle</label>
                </div>

                <label>Selecionar</label>
                <div class="marcador">
                    <input type="checkbox" id="switch2" />
                    <label for="switch2">Toggle</label>
                </div>
            </div>
        </section>

        <footer>
            <span class="texto-verde">status do formulário</span>
            <section>
                <input type="submit" value="Salvar" class="btn verde">
            </section>
        </footer>
    </form>

    <table class="opcoes">
        <tr>
            <td>Ações</td>
            <td>Nome Completo</td>
            <td>Email</td>
            <td>Perfil</td>
        </tr>

        <tr>
            <td><a href="" class="btn vermelho">Apagar</a><a href="" class="btn amarelo">Editar</a></td>
            <td>Fulano 1º da Silva</td>
            <td>fulano1email.com</td>
            <td>Administrador</td>
        </tr>
        <tr>
            <td><a href="" class="btn vermelho">Apagar</a><a href="" class="btn amarelo">Editar</a></td>
            <td>Fulano 2º da Silva</td>
            <td>fulano2email.com</td>
            <td>Administrador</td>
        </tr>
        <tr>
            <td><a href="" class="btn vermelho">Apagar</a><a href="" class="btn amarelo">Editar</a></td>
            <td>Fulano 3º da Silva</td>
            <td>fulano3email.com</td>
            <td>Administrador</td>
        </tr>
        <tr>
            <td><a href="" class="btn vermelho">Apagar</a><a href="" class="btn amarelo">Editar</a></td>
            <td>Fulano 4º da Silva</td>
            <td>fulano4email.com</td>
            <td>Administrador</td>
        </tr>
        
    </table>
@endsection