# Pesquisa de pacientes

Tela com filtros de busca para pacientes, poderá ser buscado pacientes por:

* Nome
* CPF
* Data de nascimento
* Número de prontuário (a ver)

**Obs:** A busca usará clausulas OR, logo serão encontrados por exemplo, pacientes com nome 'José' OU CPF '12345678901', assim pacientes sem CPF poderão ser encontrados também.


## Retorno de busca

Após realizar uma busca, será mostrada uma tabela com os principais dados dos pacientes, além dos botões de ações, como editar, evolução e prescrição.

## Implementação

Na listagem de pacientes foi inserido um formulário simples de busca, onde ao buscar por um campo, a mesma tela é apresentada com o resultado, além de ter o gerenciamento de paciente, como no exemplo:

![Tela de busca](./img/busca-paciente.jpeg?raw=true)

[Voltar](../README.md) 