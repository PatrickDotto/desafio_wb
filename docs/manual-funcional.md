## Manual Funcional

Seja bem-vindo ao manual funcional do nosso sistema **Gerenciador de Tarefas**. Este manual contém a explicação de como o sistema funciona, explica as telas e como instalá-lo.

------------------

## 1. Descrição Geral

O Gerenciador de tarefas é um sistema web que ajuda o usuário a organizar as suas tarefas do dia a dia, permitindo ele a criar uma conta, criar uma tarefa, edita-la, por um prazo, adicionar uma descrição, filtrar e buscar cada tarefa que você guarda no gerenciador.

## Telas do Sistema:

* **Tela de Cadastro:**
    * Aqui você cria sua conta, preenchendo com seu nome email e senha, sua senha é criptografada para melhor segurança.

* **Tela de Login:**
    * Após criar sua conta, você insere suas informações de email e senha e entre no sistema.

* **Dashboard (Tela Principal):**
    * A tela principal é a tela mais importante, nela você cria sua tarefa, vizualiza todas as tarefas, filtra, busca de acordo com seu interesse e vê o status. Você consegue editar o status da tarefa através dos botões concluir, editar e excluir.

* **Tela de Edição:**
    *Aparece todas as informações da tarefa para editar detalhes, como título, descrição e prazo.

------------------

## 2. Passo a Passo Utilização

### 1. Criar nova conta

1. Após acessar o sistema, deve-se clicar em "Cadastrar-se caso não tenha uma conta.
2. Preencher com seu nome, email e senha.
3. Após isso, volte a tela de login para preencher com seu email e senha e acesse ao sistema.

### 2. Criar nova Tarefa

1. No começo da tela inicial, há um painel escrito "Nova Tarefa".
2. Preencha com título e selecione a data limite, a descrição é opcional.
3. Após clicar em "Adicionar", sua tarefa aparecerá no final da tela inicial.

### 3. Concluir e Excluir Tarefa (AJAX)

1. Na sua lista de tarefas existe os botões concluir, editar e exlcuir.
2. Clicando nos botões de concluir ou excluir o sistema atualizará automaticamente sem recarregar a página, o botão concluir ficará cinza e o de excluir sumirá lentamente.

### 4. Editar Tarefa

1. Clique em editar para alterar os dados da tarefa.

### 5. Buscar e Filtrar

1. Insira o nome da tarefa no campo de texto para buscar uma tarefa.
2. Use o campo de status para escolher o status da tarefa.
3. Clique em filtrar para ver o resultado da pesquisa.
4. Clique em limpar para apagar todos os filtros e ver as tarefas normalmente.

------------------

## 3. Instalação e Execução do Sistema

Passo a passo para rodar o sistema no seu computador local usando o **XAMPP**.

### 1. Preparação

Instale o **XAMPP** (servidor local) e logo em seguida inicie os serviços Apache e MySQL no painel do XAMPP.

### 2. Configurar Banco de Dados

Acesse no navegador 'http://localhost/phpmyadmin', crie um banco de dados chamado 'banco_desafiowb' (se o arquivo .sql tiver com outro nome ponha o nome do arquivo). Após criar seu banco, clique na aba **Importar** e selecione o arquivo .sql que está dentro do da pasta do projeto e clique em executar.

## 3. Configurações dos Arquivos

Copie a pasta do projeto e cole dentro da pasta 'htdocs' do XAMPP. (Caminho: C:\xampp\htdocs). Após colar dentro da pasta, abra o arquivo conexao.php e certifique se as configurações de usuário e senha do banco estão corretas. Normalmente sendo: Usuario 'root' e sem senha.

## 4. Rodar o Sistema

Abra seu navegador, digite o endereço: http://localhost/desafio_wb (ou o nome da pasta), e o sistema abrirá inicialmente na tela de login.
