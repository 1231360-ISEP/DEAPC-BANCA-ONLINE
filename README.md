# DEAPC Banca Online

## Objetivos da sua Aplicação

- Informar o saldo disponivel na conta do cliente
- Informar o cliente e registar o histórico das suas transações bancárias
- Informar o cliente e registar sobre os seus pagamentos
- Informar sobre as dividas do cliente perante emprestimos e outros

## Diferentes tipos de utilizadores da Aplicação

- Clientes Particulares e Empresas
- Administradores

## Funcionalidades diponibilizadas aos vários utilizadores

- Clientes Particulares e Empresas:
    - Informar o saldo da conta
    - Transações da conta
    - Apresentar todos os movimentos da conta realizados

- Administradores:
    - Apagar e criar contas
    - Analisar o estado financeiro de todas as contas bancárias ativas

## User Stories

Níveis de prioridade:

- Alta
- Média
- Baixa

### Ator: Cliente

| Código | Nome                                                          | Descrição                                                                                           | Prioridade |
| ------ | ------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | ---------- |
| CLI01  | Obter o saldo da conta                                        | Como Cliente quero poder visualizar o saldo que tenho disponível na conta                           | Alta       |
| CLI02  | Efetuar uma transação                                         | Como Cliente quero criar uma nova transação                                                         | Alta       |
| CLI03  | Obter todos os movimentos da conta                            | Como Cliente quero poder visualizar todos os movimentos da conta                                    | Alta       |
| CLI04  | Obter todos os movimentos da conta dado um intervalo de tempo | Como Cliente quero poder visualizar todos os movimentos da conta num intervalo de tempo introduzido | Média      |
| CLI05  | Obted todos os movimentos da conta dada uma entidade          | Como Cliente quero poder visualizar todos os movimentos da conta relacionados a uma entidade        | Baixa      |

### Ator: Administrador

| Código | Nome                                | Descrição                                                                         | Prioridade |
| ------ | ----------------------------------- | --------------------------------------------------------------------------------- | ---------- |
| ADM01  | Criar uma conta                     | Como Administrador quero poder criar uma nova conta                               | Alta       |
| ADM02  | Visualizar todas as contas          | Como Administrador quero poder visualizar todoas as contas e os saldos respetivos | Alta       |
| ADM03  | Apagar uma conta                    | Como Administrador quero poder apagar uma certa conta                             | Alta       |
| ADM04  | Procurar contas por nome de Cliente | Como Administrador quero poder porcurar contas por nome de um Cliente             | Média      |
| ADM05  | Desativar uma conta                 | Como Administrador quero poder desativar uma certa conta                          | Baixa      |
