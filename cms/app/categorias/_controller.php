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
			if (empty($post['categoria'])) {
				$_SESSION['erro'] .= "<br>- Preencha a categoria.";
			}

			if (isset($post['status']) && !in_array($post['status'], [0, 1])) {
				$_SESSION['erro'] .= "<br>- Situação inválida.";
			}

			// Executa inserção.
			if (empty($_SESSION['erro'])) {
				$query = mysqli_query($db, "INSERT INTO categorias (categoria, status) VALUES ('{$post['categoria']}', {$post['status']})");
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
			<?
			} else {
			?>
				<script>
					window.location = "./?m=<?= $modulo; ?>";
				</script>
			<?
			}
		} else {
			include  'new.php';
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
			if (empty($post['categoria'])) {
				$_SESSION['erro'] .= "<br>- Preencha a categoria.";
			}

			if (isset($post['status']) && !in_array($post['status'], [0, 1])) {
				$_SESSION['erro'] .= "<br>- Situação inválida.";
			}

			// Executa inserção.
			if (empty($_SESSION['erro'])) {
				$query = mysqli_query($db, "UPDATE categorias set categoria = '{$post['categoria']}', status = {$post['status']} WHERE id = {$post['id']}");
				if ($query) {
					$_SESSION['sucesso'] = "Registro editado com sucesso.";
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
			<?
			} else {
			?>
				<script>
					window.location = "./?m=<?= $modulo; ?>";
				</script>
			<?
			}
		} else {
			include 'edit.php';
		}

		break;

	case 'delete': // Deleta registro.
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		if (!empty($id)) {
			$query = mysqli_query($db, "DELETE FROM categorias WHERE id = {$id}");
			if ($query) {
				$_SESSION['sucesso'] = "Registro excluído com sucesso.";
			} else {
				$_SESSION['erro'] = "Falha ao excluir o registro. Erro: " . mysqli_errno($db);
			}
		} else {
			$_SESSION['erro'] = "Falha ao excluir o registro.";
		}

		?>
			<script>
				window.history.back();
			</script>
		<?
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