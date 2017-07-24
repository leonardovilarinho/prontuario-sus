# Gerenciamento de administradores

Gerenciar outros administradores do sistema, podendo:

* Listar administradores registrados, com paginação de 10 em 10.
* Criar um novo administrador com os dados: nome, email, cpf, nascimento e senha.


## Exceções

O primeiro administrador registrado no sistema será considerado o super administrador, nenhum outro administrador poderá apaga-lo ou bloquea-lo do sistema, e apenas ele poderá bloquear e apagar demais administradores.

## Implementação

Em um item do menu lateral existe o atalho apra o gerenciamento de administradores, ao clicar no mesmo, é exibida uma tela com a listagem dos administradores registrados, o resultado de qualquer ação é exibido na mesma tela, como no exemplo abaixo, onde houve a edição do administrador 'José Antonio Silveira':

![Tela de login](./img/lista-adm.jpeg?raw=true)


Note também a existência das opções de edição, remoção e bloqueio/desbloqueio de um administrador, além disso é possível clicar em criar um novo, onde teremos acesso a seguinte página com o formulário validando cada dado:

![Painel inicial](./img/cadastro-adm.jpeg?raw=true)

[Voltar](../README.md)