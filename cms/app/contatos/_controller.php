<?php
	// Define a ação.
	$acao = filter_input(INPUT_GET, 'a', FILTER_DEFAULT);
	if (empty($acao)) $acao = 'list';

	// Executa a ação.
	switch ($acao) {
	case 'edit': // Edita registro.
		include 'edit.php';
		break;

	case 'delete': // Deleta registro.
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		if (!empty($id)) {
			$query = mysqli_query($db, "DELETE FROM contatos WHERE id = {$id}");
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
		<?php
		break;

	case 'list':
		include 'list.php';
		break;

	default: // Carrega lista, exibindo mensagem de erro.
		$_SESSION['erro'] = 'Você não possui autorização para acessar o módulo ou registro especificado.';
		include 'list.php';
		break;
	}
?>