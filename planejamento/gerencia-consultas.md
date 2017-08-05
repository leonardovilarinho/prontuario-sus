# Gerenciamento de consultas

Após pesquisar um médico, é possível pesquisar por data, onde podemos manipular o resultado, tendo as opções:

* Criar consulta nessa data
* Desmarcar consulta resultada


## Ao criar uma nova consulta

Após a seleção de médico e busca por dia, ao clicar em criar uma nova consulta, teremos que preencher os dados:

* Médico (automático)
* Paciente
* Data (automático)
* Horário (seleção pega de acordo com o preenchido no gerenciamento de hórario do médico)
* Observação (opcional)
* Status (automático)

**Obs:** No momento do cadastro, deve ser apresentada o horário da última consulta marcada, assim teremos o controle para não se ter horários iguais e gerenciamento de intervalos simplista.

**Obs:** O status diz se é a "primeira consulta" do paciente, "retorno" caso a última consulta tenha sido em menos de 30 dias atrás e "nova consulta" caso o paciente já tenha uma consulta anterior além dos 30 dias.

## Lista de consultas

O usuário poderá ver as consultas cadastradas por si mesmo e apagar aquelas que ainda não foram atendidas.

## Implementação

Ao gerenciar médicos, temos um novo motão para marcar a consulta, como na imagem:

![Tela](./img/seleciona-medico.jpeg?raw=true)

Após a seleção, é exibida a imagem abaixo, com objetivo de informar a data da consulta:

![Tela](./img/seleciona-data.jpeg?raw=true)

Com a data e o médico, temos que ver os horários dispóníveis naquele dia para o médico, para isso temos a tela a seguir:

![Tela](./img/seleciona-hora.jpeg?raw=true)

Para terminar os processos de seleção, temos que definir um paciente para a consulta, para isso temos a listagem dos mesmos, com um botão de seleção:

![Tela](./img/seleciona-paciente.jpeg?raw=true)

Por fim, é possível terminar preenchendo os campos de status e observação, como é mostrado abaixo:

![Tela](./img/finaliza-consulta.jpeg?raw=true)


É possível ver as consultas marcadas para um médico, como na tela:

![Tela](./img/lista-consulta-med.jpeg?raw=true)

Ou então listar as consultas de cada paciente, na tela:

![Tela](./img/lista-consulta-pac.jpeg?raw=true)

[Voltar](../README.md)