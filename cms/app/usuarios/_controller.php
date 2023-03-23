<?php
	// Define a ação.
	$acao = filter_input(INPUT_GET, 'a', FILTER_DEFAULT);
	if (empty($acao)) $acao = 'list';

	// Executa a ação.
	switch ($acao) {
	case 'new': // Adiciona registro.
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
			if (empty($post['senha'])) {
				$_SESSION['erro'] .= "<br>- Preencha a senha.";
			} else {
				if (!empty($post['senha']) || !empty($post['confirmar'])) {
					if ($post['senha'] != $post['confirmar']) {
						$_SESSION['erro'] .= "<br>- Senhas incorretas.";
					}
				}
			}

			// Valida preenchimento.
			if (isset($post['status']) && !in_array($post['status'], [0, 1])) {
				$_SESSION['erro'] .= "<br>- Situação inválida.";
			}

			// Executa inserção.
			if (empty($_SESSION['erro'])) {
				$query = mysqli_query($db, "INSERT INTO usuarios (nome, email, senha, celular, status) VALUES ('{$post['nome']}', '{$post['email']}', MD5('{$post['senha']}'), '{$post['celular']}', {$post['status']})");
				if ($query) {
					$_SESSION['sucesso'] = "Registro adicionado com sucesso.";
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
			include 'new.php';
		}
		break;

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

			// Valida preenchimento.
			if ($post['id'] != $user['id']) {
				if (isset($post['status']) && !in_array($post['status'], [0, 1])) {
					$_SESSION['erro'] .= "<br>- Situação inválida.";
				}
			} else {
				$post['status'] = 1;
			}

			// Executa edição.
			if (empty($_SESSION['erro'])) {
				if (!empty($post['senha'])) {
					$query = mysqli_query($db, "UPDATE usuarios set nome = '{$post['nome']}', celular = '{$post['celular']}', email = '{$post['email']}', senha = MD5('{$post['senha']}'), status = '{$post['status']}' WHERE id = {$post['id']}");
				} else {
					$query = mysqli_query($db, "UPDATE usuarios set nome = '{$post['nome']}', celular = '{$post['celular']}', email = '{$post['email']}', status = '{$post['status']}' WHERE id = {$post['id']}");
				}

				if ($query) {
					$_SESSION['sucesso'] = "Registro editado com sucesso.";
					if ($post['id'] == $user['id']) {
						// Atualizar dados em sessão.
						$_SESSION['user']['nome'] = $post['nome'];
						$_SESSION['user']['email'] = $post['email'];
						$_SESSION['user']['celular'] = $post['celular'];
					}
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

	case 'delete': // Deleta registro.
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		if (!empty($id)) {
			if ($id == $user['id']) {
				$_SESSION['erro'] = "Você não pode excluir sua própria conta.";
			} else {
				$query = mysqli_query($db, "DELETE FROM usuarios WHERE id = {$id}");
				if ($query) {
					$_SESSION['sucesso'] = "Registro excluído com sucesso.";
				} else {
					$_SESSION['erro'] = "Falha ao excluir o registro. Erro: " . mysqli_errno($db);
				}
			}
		} else {
			$_SESSION['erro'] = "Falha ao excluir o registro.";
		}
		?>
			<script>
				window.history.back();
			</script>
		<?php
		break;

	case 'list': // Carrega arquivo.
		include 'list.php';
		break;

	default: // Carrega lista, exibindo mensagem de erro.
		$_SESSION['erro'] = 'Você não possui autorização para acessar o módulo ou registro especificado.';
		include 'list.php';
		break;
	}
?>