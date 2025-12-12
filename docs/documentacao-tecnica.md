# Documentação Técnica

## 1. Visão Geral
O projeto foi desenvolvido segundo o padrão que foi pedido, sem uso de frameworks, utilizando PHP 8 puro e manipulação no banco de dados com PDO para ter a melhor experiência possível.

**Tecnologias:**
- **Backend:** PHP 8.2
- **Banco de Dados:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript (jQuery)
- **Controle de Versão:** Git

---

## 2. Estrutura do Banco de Dados

O banco de dados tem duas tabelas relacionais ('usuarios' e 'tarefas'), com sua referencia garantida (foreign key).

### Tabela: 'usuarios'
Armazena as credenciais de acesso.
- 'id' (INT, PK, AUTO_INCREMENT): Identificador de usuário.
- 'nome' (VARCHAR): Nome do usuário.
- 'email' (VARCHAR, UNIQUE): Login do usuário.
- 'senha' (VARCHAR): Senha hash de segurança ('password_hash').

### Tabela: 'tarefas'
Armazena as atividades do usuário.
- 'id' (INT, PK, AUTO_INCREMENT): Identificador de tarefa.
- 'usuario_id' (INT, FK): Dono da tarefa. (ON DELETE CASCADE).
- 'titulo' (VARCHAR): Título da tarefa.
- 'descricao' (TEXT): Descrição da tarefa (opcional).
- 'status' (ENUM): 'pendente' ou 'concluida'.
- 'data_limite' (DATE): Prazo final.
- 'data_criacao': Timestamp automático.

------------

## 3. Detalhes do Projeto (PHP)

### Conexão e Segurança ('conexao.php')
- Uso da classe **PDO** para conexão com o banco.
- **Prevenção de SQL Injection:** Todas as queries utilizam *Prepared Statements* (':parametro').

### Autenticação ('login.php' / 'cadastro.php')
- As senhas são criptografadas utilizando 'password_hash()' no cadastro e 'password_verify()' no login.
- O acesso é controlado através de **Sessões PHP** ('$_SESSION'). As páginas restritas são protegidas por um controle: 'isset($_SESSION['usuario_id'])' no topo do arquivo.

### AJAX e Interatividade
Para a tela interativa ser mais eficiente e rápida, usei jQuery nas ações de **Concluir** e **Excluir** tarefas.

**Fluxo do AJAX:**

1. O usuário clica no botão de concluir ou excluir.
2. O evento 'e.preventDefault()' bloqueia o reload.
3. O ID da tarefa é requisitado pelo 'data-id'.
4. Uma requisição '$.post' é enviada para o PHP utilizado: concluir_ajax.php ou excluir_ajax.php.
5. O PHP recebe a mudança no banco e retorna um JSON '{ "sucesso": true }'.
6. O JavaScript recebe esse retorno e altera o DOM (remove o botão ou a linha da tabela) na hora.

-------------

## 4. Decisões Técnicas
- **Input Hidden:** Usado para distinguir ações de formulário e passar os IDs de forma segura.
- **Bootstrap 5:** A melhor e mais prática, deixa a parte do frontend mais dinâmica, objetiva e bonita, com a vantagem de ser mais prática, sem necessidade de CSS customizado.
- **Estrutura das Pastas:** Os arquivos se encontram na raíz da pasta 'desafio_wb' para simplificar a execução em ambientes locais como o XAMPP, facilitando e agilizando a parte de abrir e avaliar os arquivos, com exceção do manual funcional e documentação técnica que se encontra dentro da pasta 'docs', que fica na raíz do arquivo.

-------------

## 5. Configuração Local
Para rodar o projeto, importe o script .sql no seu sistema que gerencia o banco de dados, configure as credenciais em conexao.php com o padrão root, sem senha. E por fim, confira se a extensão pdo_mysql está habilidada no php.ini.
