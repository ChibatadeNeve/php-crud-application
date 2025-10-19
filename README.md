📋 Descrição do Projeto
Sistema web completo para cadastro de clientes desenvolvido em PHP, MySQL, HTML e CSS. A aplicação permite realizar operações básicas de CRUD (Create, Read, Update, Delete) para gerenciar informações de clientes de forma eficiente.

✨ Funcionalidades
✅ Cadastrar novos clientes

📝 Editar informações de clientes existentes

👁️ Visualizar lista completa de clientes

🗑️ Excluir clientes do sistema

🔍 Validação de dados nos formulários

🎨 Interface responsiva e intuitiva

🛠️ Tecnologias Utilizadas
PHP - Linguagem de programação backend

MySQL - Banco de dados

HTML5 - Estrutura da página

CSS3 - Estilização e design

XAMPP - Ambiente de desenvolvimento

phpMyAdmin - Gerenciamento do banco de dados

📁 Estrutura do Projeto
text
pasta-do-projeto/
│
├── IMG/
│   └── IMG Config.png          # Ícone do site (favicon)
├── conexao.php                 # Arquivo de conexão com o banco
├── crud.php                    # Arquivo principal da aplicação
├── funcoes.php                 # Funções de validação
├── crud.sql                    # Script do banco de dados
└── teste.php                   # Arquivo não utilizado (pode ser removido)
⚙️ Requisitos do Sistema
XAMPP instalado (Apache e MySQL)

Navegador web moderno

PHP 7.4 ou superior

MySQL 5.7 ou superior

🚀 Instalação e Configuração
1. Preparação do Ambiente
Instale o XAMPP (caso não tenha)

Inicie os serviços Apache e MySQL pelo painel do XAMPP

2. Configuração do Projeto
Extraia os arquivos do projeto (WinRAR ou similar)

Copie todos os arquivos da pasta extraída

Cole os arquivos em: C:\xampp\htdocs\nome-da-sua-pasta\

Substitua "nome-da-sua-pasta" por um nome de sua preferência

3. Configuração do Banco de Dados
Acesse phpMyAdmin: http://localhost/phpmyadmin

Crie um banco de dados chamado crud

Importe o arquivo crud.sql para criar a estrutura necessária

4. Acesso à Aplicação
Abra seu navegador

Acesse: http://localhost/nome-da-sua-pasta/crud.php

🗃️ Estrutura do Banco de Dados
Tabela: usuarios
Campo	Tipo	Descrição
id	INT	Chave primária (auto)
nome	VARCHAR(100)	Nome do cliente
email	VARCHAR(100)	E-mail do cliente
telefone	VARCHAR(20)	Telefone do cliente
📝 Como Usar
Cadastrar Cliente
Preencha o formulário com: Nome, E-mail e Telefone

Clique em "Salvar"

Editar Cliente
Clique no botão "Editar" na linha do cliente desejado

Modifique os dados no formulário

Clique em "Atualizar"

Excluir Cliente
Clique no botão "Excluir" na linha do cliente desejado

Confirme a exclusão no pop-up

🔒 Validações Implementadas
Nome: Entre 2-100 caracteres, apenas letras e espaços

E-mail: Formato válido de e-mail

Telefone: Entre 10-13 dígitos numéricos

👨‍💻 Desenvolvedor
Pietro Miguel
Sistema desenvolvido como projeto de CRUD completo.

📞 Suporte
Em caso de problemas:

Verifique se os serviços do XAMPP estão rodando

Confirme se o banco de dados foi criado corretamente

Certifique-se de que os arquivos estão na pasta correta do htdocs

⭐ Se este projeto foi útil, deixe uma estrela no repositório!
