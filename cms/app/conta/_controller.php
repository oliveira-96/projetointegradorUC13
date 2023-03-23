<?php
	// Define a ação.
	$acao = filter_input(INPUT_GET, 'a', FILTER_DEFAULT);
	if (empty($acao)) $acao = 'edit';

	// Executa a ação.
	switch ($acao) {
	case 'edit': // Edita registro.
		// Verifica se estão sendo enviados dados.
		if (!empty($_POST['submit'])) {

			// Sanitiza e valida dados do post.
			$post = $_POST;
			$post = array_map('strip_tags', $post);
			foreach ($post as $key => $value) {
				$post[$key] = mysqli_real_escape_string($db, $value);
			}

			$_SESSION['erro'] = '';

			// Valida preenchimento.
			if (empty($post['nome'])) {
				$_SESSION['erro'] .= "<br>- Preencha o nome.";
			}

			// Valida preenchimento.
			if (empty($post['email'])) {
				$_SESSION['erro'] .= "<br>- Preencha o e-mail.";
			} else {
				if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
					$_SESSION['erro'] .= "<br>- E-mail inválido.";
				}
			}

			// Valida preenchimento senhas.
			if (!empty($post['senha']) || !empty($post['confirmar'])) {
				if ($post['senha'] != $post['confirmar']) {
					$_SESSION['erro'] .= "<br>- Senhas incorretas.";
				}
			}

			// Executa inserção.
			if (empty($_SESSION['erro'])) {
				if (!empty($post['senha'])) {
					$query = mysqli_query($db, "UPDATE usuarios set nome = '{$post['nome']}', celular = '{$post['celular']}', email = '{$post['email']}', senha = MD5('{$post['senha']}') WHERE id = {$user['id']}");
				} else {
					$query = mysqli_query($db, "UPDATE usuarios set nome = '{$post['nome']}', celular = '{$post['celular']}', email = '{$post['email']}' WHERE id = {$user['id']}");
				}

				if ($query) {
					$_SESSION['sucesso'] = "Registro editado com sucesso.";

					// Atualizar dados em sessão.
					$_SESSION['user']['nome'] = $post['nome'];
					$_SESSION['user']['email'] = $post['email'];
					$_SESSION['user']['celular'] = $post['celular'];
				} else {
					$_SESSION['erro'] = "Falha ao salvar o registro. Erro: " . mysqli_errno($db);
				}
			} else {
				$_SESSION['erro'] = "Falha ao salvar o registro:<br>" . $_SESSION['erro'];
			}

			// Verifica qual arquivo incluir.
			if (!empty($_SESSION['erro'])) {
			?>
				<script>
					window.history.back();
				</script>
			<?php
			} else {
			?>
				<script>
					window.location = "./?m=<?= $modulo; ?>";
				</script>
			<?php
			}
		} else {
			include 'edit.php';
		}

		break;

	default: // Carrega lista, exibindo mensagem de erro.
		$_SESSION['erro'] = 'Você não possui autorização para acessar o módulo ou registro especificado.';
		include 'edit.php';
		break;
	}
?>