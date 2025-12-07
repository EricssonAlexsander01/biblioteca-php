📚 Biblioteca PHP — Sistema Completo Full-Stack

Aplicação web full-stack desenvolvida com PHP,
HTML, CSS,
JavaScript, e MySQL.

Este projeto demonstra a capacidade de integrar front-end + back-end + banco de dados, atendendo aos requisitos da avaliação somativa: autenticação completa, CRUD 100% funcional, relacionamento 1xN e interface navegável.

🚀 Funcionalidades Principais
🔐 Autenticação

Cadastro de usuário

Login com validação

Senhas criptografadas (password_hash)

Verificação segura (password_verify)

Logout

Bloqueio total de páginas internas sem login

📘 CRUD de Livros

Inserir novos livros

Editar registros

Excluir com segurança

Listagem dinâmica

📄 CRUD de Empréstimos

Relacionado a usuários e livros

Seleção de registros existentes

Edição + exclusão

Relacionamento 1:N no banco

🎨 Interface

Layout simples, funcional e organizado

Formulários padronizados

Navegação clara

HTML + CSS + JS

🗄 Banco de Dados

Estrutura com tabelas:

usuarios

livros

emprestimos

Inclui relacionamento formal e inserts iniciais.
Arquivo SQL está na pasta:

/mysql/biblioteca.sql

🏗 Tecnologias Utilizadas
Camada	Tecnologia
Front-end	HTML, CSS, JavaScript
Back-end	PHP
Banco de dados	MySQL
Servidor local	XAMPP, WAMP ou Laragon
📂 Estrutura do Projeto (como realmente está)
/pages
    emprestimos.php
    emprestimos_editar.php
    emprestimos_excluir.php
    livros.php
    livros_editar.php
    livros_excluir.php
    painel.php
/mysql
    biblioteca.sql
conexao.php
index.html
login.php
logout.php
verificar_login.php


O projeto foi entregue exatamente no formato original, conforme permitido na atividade.

⚙️ Como Executar Localmente

Instale um servidor local
(XAMPP, WAMP ou Laragon)

Coloque a pasta do projeto em:

htdocs (XAMPP)

www (WAMP / Laragon)

Inicie Apache + MySQL

Vá ao phpMyAdmin e importe:

mysql/biblioteca.sql


Ajuste conexao.php com suas credenciais

Acesse no navegador:

http://localhost/NOME_DA_PASTA

🎥 Vídeo de Apresentação do Sistema

▶️ YouTube (Não Listado):
https://www.youtube.com/watch?v=QOsp2OsijjU

O vídeo segue fielmente o roteiro solicitado na avaliação.

🧪 Checklist da Avaliação (100% atendido)

✔ Login funcional
✔ Logout funcional
✔ Senhas criptografadas
✔ Bloqueio de páginas sem sessão
✔ CRUD completo (livros + empréstimos)
✔ Banco de dados com relacionamento 1:N
✔ Interface clara
✔ Arquivo SQL incluso
✔ Vídeo de demonstração
✔ Aplicação funcional via localhost

👨‍💻 Autor

Ericsson Alexsander
Estudante de Análise e Desenvolvimento de Sistemas – PUC-PR EAD

📜 Licença

Projeto desenvolvido para fins acadêmicos.
Modificações e reutilização são permitidas.
