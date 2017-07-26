# Gerenciamento de administradores

Gerenciar outros administradores do sistema, podendo:

* Listar administradores registrados, com paginação de 10 em 10.
* Criar um novo administrador com os dados: nome, email, cpf, nascimento e senha.


## Exceções

O primeiro administrador registrado no sistema será considerado o super administrador, nenhum outro administrador poderá apaga-lo ou bloquea-lo do sistema, e apenas ele poderá bloquear e apagar demais administradores.

## Implementação

Em um item do menu lateral existe o atalho apra o gerenciamento de administradores, ao clicar no mesmo, é exibida uma tela com a listagem dos administradores registrados:

![Tela de login](./img/lista-adm.jpeg?raw=true)


Além da opção de busca por diversos atributos, podemos criar um novo administrado, com o seguinte formulário:

![Painel inicial](./img/cadastro-adm.jpeg?raw=true)

Por fim, possuímos um botão 'gerenciar', onde é exibido todos os dados do administrador, além das opções de gerenciamento, como remoção, edição, bloqueio e impressão:

![Tela de login](./img/gerencia-adm.jpeg?raw=true)


[Voltar](../README.md)