<?php
require_once 'config.php';

// Obtém os dados do formulário
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Insere os dados no banco de dados
$sql = "INSERT INTO contatos (assunto, mensagem, nome, email, telefone)
        VALUES ('$assunto', '$mensagem', '$nome', '$email', '$telefone')";

if (mysqli_query($db, $sql)) {

    // Define uma variável de sessão para exibir a mensagem de sucesso
    session_start();
    $_SESSION['contato_enviado'] = true;

    // Redireciona de volta para a página de contato
    header('Location: index.php?m=contato');
    exit;

} else {
    echo "Erro ao salvar mensagem: " . mysqli_error($db);
}

?>