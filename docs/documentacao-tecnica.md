# 🛠️ Documentação Técnica - Gerenciador de Tarefas

## 1. Visão Geral da Arquitetura
O projeto foi desenvolvido seguindo o padrão MVC simplificado, sem uso de frameworks, focando em PHP 8 puro e manipulação direta do banco de dados via PDO para garantir performance e segurança.

**Tecnologias:**
- **Backend:** PHP 8.2
- **Banco de Dados:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3 (Bootstrap 5), JavaScript (jQuery)
- **Controle de Versão:** Git

---

## 2. Estrutura do Banco de Dados

O banco de dados consiste em duas tabelas relacionais (`usuarios` e `tarefas`), com integridade referencial garantida (Foreign Key).

### Tabela: `usuarios`
Armazena as credenciais de acesso.
- `id` (INT, PK, AUTO_INCREMENT): Identificador único.
- `nome` (VARCHAR): Nome de exibição.
- `email` (VARCHAR, UNIQUE): Login do usuário.
- `senha` (VARCHAR): Hash de segurança (gerado via `password_hash`).

### Tabela: `tarefas`
Armazena as atividades de cada usuário.
- `id` (INT, PK, AUTO_INCREMENT): Identificador da tarefa.
- `usuario_id` (INT, FK): Referência ao dono da tarefa (ON DELETE CASCADE).
- `titulo` (VARCHAR): Título da atividade.
- `descricao` (TEXT): Detalhes opcionais.
- `status` (ENUM): 'pendente' ou 'concluida'.
- `data_limite` (DATE): Prazo final.
- `data_criacao`: Timestamp automático.

---

## 3. Detalhes de Implementação (PHP)

### Conexão e Segurança (`conexao.php`)
- Uso da classe **PDO** para conexão com o banco.
- Tratamento de exceções com `try/catch`.
- **Prevenção de SQL Injection:** Todas as queries utilizam *Prepared Statements* (`:parametro`).

### Autenticação (`login.php` / `cadastro.php`)
- As senhas nunca são salvas em texto puro. Utilizamos `password_hash()` no cadastro e `password_verify()` no login (Algoritmo Bcrypt padrão do PHP).
- Controle de acesso via **Sessões PHP** (`$_SESSION`). Páginas restritas verificam `isset($_SESSION['usuario_id'])` no topo do arquivo.

### AJAX e Interatividade
Para cumprir o requisito de interatividade sem recarregamento (SPA feel), implementamos jQuery nas ações de **Concluir** e **Excluir** tarefas.

**Fluxo do AJAX:**
1. O usuário clica no botão (ex: `.btn-concluir`).
2. O evento `e.preventDefault()` bloqueia o reload.
3. O ID da tarefa é capturado via atributo `data-id`.
4. Uma requisição `$.post` é enviada para o script PHP correspondente (ex: `concluir_ajax.php`).
5. O PHP processa a alteração no banco e retorna um JSON `{ "sucesso": true }`.
6. O JavaScript recebe o retorno e manipula o DOM (remove o botão ou a linha da tabela) instantaneamente.

---

## 4. Decisões Técnicas
- **Input Hidden:** Utilizado para diferenciar ações de formulário e passar IDs de forma segura.
- **Bootstrap 5:** Escolhido para garantir responsividade total (Mobile-First) sem necessidade de CSS customizado complexo.
- **Estrutura de Pastas:** Mantivemos a estrutura plana (arquivos na raiz) para simplicidade de execução em ambientes locais como XAMPP, facilitando a avaliação.

---

## 5. Configuração Local
Para rodar este projeto:
1. Importe o script `.sql` no seu SGBD.
2. Configure as credenciais em `conexao.php` (padrão: `root`, sem senha).
3. Certifique-se de que a extensão `pdo_mysql` está habilitada no `php.ini`.
