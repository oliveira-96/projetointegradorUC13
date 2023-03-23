<?php
// Dados fixos.
define('BLOG_NOME', 'Projeto X');
define('BLOG_AUTOR', 'André Oliveira');
define('BLOG_SOBRE', 'André é um programador que ensina seus alunos a desenvolver sites!');

//  Definições de constantes de conexão com o banco de dados.
define('DB_HOST', 'localhost'); // Host de conexão.
define('DB_PORT', '3306'); // Porta de conexão. (Padrão 3306).
define('DB_USER', 'root'); // Usuário de conexão.
define('DB_PASS', ''); // Senha de conexão.
define('DB_SCHEMA', 'projetox'); // Nome do banco de dados.

// Efetua a conexão com o banco de dados.
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_SCHEMA, DB_PORT);

// Caso haja algum erro de conexão, emite aviso e encerra a aplicação.
if (mysqli_connect_errno()) {
    echo 'Falha na conexão com o banco de dados. Erro: ' . mysqli_connect_error();
    exit;
} else {
    mysqli_set_charset($db, "utf8"); // Seta padrão UTF-8.
}
?>