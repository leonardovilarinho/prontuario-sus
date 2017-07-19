# Gerenciamento de consultas

Após selecionar um médico, é possível pesquisar por data, onde podemos manipular o resultado, tendo as opções:

* Criar consulta nessa data
* Desmarcar consulta resultada


## Ao criar uma nova consulta

Após a seleção de médico e busca por dia, ao clicar em criar uma nova consulta, teremos que preencher os dados:

* Médico (automático)
* Data (automático)
* Horário (seleção pega de acordo com o preenchido no gerenciamento de hórario do médico)
* Observação (opcional)
* Status (automático)

**Obs:** No momento do cadastro, deve ser apresentada o horário da última consulta marcada, assim teremos o controle para não se ter horários iguais e gerenciamento de intervalos simplista.

**Obs:** O status diz se é a "primeira consulta" do paciente, "retorno" caso a última consulta tenha sido em menos de 30 dias atrás e "nova consulta" caso o paciente já tenha uma consulta anterior além dos 30 dias.

## Lista de consultas

O usuário poderá ver as consultas cadastradas por si mesmo e editar aquelas que ainda não foram atendidas.

[Voltar](../README.md)