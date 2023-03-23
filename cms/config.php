<?php
	// Força a exibição dos erros, deve ser removido/comentado em produção.
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	// Definição de informações do projeto.
	define('CMS_NOME', 'CMS - Projeto X'); // Nome do projeto.
	define('CMS_AUTOR', 'Nome do autor'); // Autor do projeto.
	define('CMS_EMAIL', 'email@email.com'); // E-mail do autor do projeto.
	define('CMS_WHATSAPP', '54 99999-9999'); // Whatsapp do autor do projeto.
	define('CMS_VERSAO', '1.0'); // Versão do projeto.

	// Definição de constantes de conexão com o banco de dados.
	define('DB_HOST', 'localhost'); // Host de conexão.
	define('DB_PORT', '3306'); // Porta de conexão. (Padrão 3306).
	define('DB_USER', 'root'); // Usuário de conexão.
	define('DB_PASS', ''); // Senha de conexão.
	define('DB_SCHEMA', 'projetox'); // Nome do banco de dados.

	// Outras definições.
	define('DIR_FILES', 'uploads');

	// Efetua a conexão com o banco de dados.
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_SCHEMA, DB_PORT);

	// Caso haja algum erro de conexão, emite aviso e encerra a aplicação.
	if (mysqli_connect_errno()) {
		echo 'Falha na conexão com o banco de dados. Erro: ' . mysqli_connect_error();
		exit;
	} else {
		mysqli_set_charset($db, "utf8"); // Seta padrão UTF-8.
	}

	// Classe para paginação de dados.
	require_once './core/paginacao.class.php';
	$paginacao = new Paginacao;

	// Classe para manipulação de imagens.
	require_once './core/imagens.class.php';
	$imagens = new Imagens;

	// Classe para manipulação de arquivos.
	require_once './core/arquivos.class.php';
	$arquivos = new Arquivos;

	// Classe para manipulações diversas.
	require_once './core/util.class.php';
	$util = new Util;
?>