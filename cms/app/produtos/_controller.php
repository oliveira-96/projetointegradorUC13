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
			$descricao = $post['descricao'];
			$post = array_map('strip_tags', $post);
			$post['descricao'] = $descricao;
			foreach ($post as $key => $value) {
				$post[$key] = mysqli_real_escape_string($db, $value);
			}

			$_SESSION['erro'] = '';

			// Valida preenchimento.
			if (empty($post['nome'])) {
				$_SESSION['erro'] .= "<br>- Preencha o nome.";
			}

			if (empty($post['detalhes'])) {
				$_SESSION['erro'] .= "<br>- Preencha os detalhes.";
			}

			if (empty($post['referencia'])) {
				$_SESSION['erro'] .= "<br>- Preencha a referência.";
			}

			if (empty($post['departamento_id'])) {
				$_SESSION['erro'] .= "<br>- Selecione o departamento.";
			}

			if (isset($post['status']) && !in_array($post['status'], [0, 1])) {
				$_SESSION['erro'] .= "<br>- Situação inválida.";
			}

			if (!empty($post['estoque'])) {
				$post['estoque'] = str_replace('.', '', $post['estoque']); // Remove pontos.
			} else {
				$post['estoque'] = 0;
			}

			if (!empty($post['vezes'])) {
				$post['vezes'] = str_replace('.', '', $post['vezes']); // Remove pontos.
			} else {
				$post['vezes'] = 0;
			}
			if (!empty($post['tamanho'])) {
				$post['tamanho'] = str_replace('.', '', $post['tamanho']); // Remove pontos.
			} else {
				$post['tamanho'] = "";
			}

			//if (!empty($post['preco_custo'])) {
			//	$post['preco_custo'] = $util->formatMoedaDecimal($post['preco_custo']); // Formata para gravação.
			//} else {
			//	$post['preco_custo'] = 0;
		//	}

			if (!empty($post['preco_venda'])) {
				$post['preco_venda'] = $util->formatMoedaDecimal($post['preco_venda']); // Formata para gravação.
			} else {
				$post['preco_venda'] = 0;
			}

			// Valida imagem
			if ($arquivos->validaArquivo('imagem', 'jpeg;jpg;png;gif', 3)) {
				// Define nome do arquivo com timestamp atual.
				$post['imagem'] = time() . '.' . $arquivos->tipoArquivo('imagem');
				// Salva imagem.
				if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], DIR_FILES . '/' . $post['imagem'])) {
					$_SESSION['alerta'] = 'A imagem não foi salva. Verifique as permissões de pastas.';
				}
			} else {
				if (!empty($arquivos->nomeArquivo('imagem'))) {
					$_SESSION['alerta'] = 'A imagem não passou na validação e não foi salva. Verifique o tamanho e o formato de arquivos permitidos.';
				}
			}

			// Executa inserção.
			if (empty($_SESSION['erro'])) {
				$query = mysqli_query($db, "INSERT INTO produtos (nome, referencia, codigo_barras, departamento_id, tamanho, estoque, vezes, preco_venda, imagem, descricao, detalhes ,status ) VALUES ('{$post['nome']}', '{$post['referencia']}', '{$post['codigo_barras']}', {$post['departamento_id']}, '{$post['tamanho']}', {$post['estoque']}, '{$post['vezes']}', '{$post['preco_venda']}', '{$post['imagem']}', '{$post['descricao']}', '{$post['detalhes']}', {$post['status']})");
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
			$descricao = $post['descricao'];
			$post = array_map('strip_tags', $post);
			$post['descricao'] = $descricao;
			foreach ($post as $key => $value) {
				$post[$key] = mysqli_real_escape_string($db, $value);
			}

			$_SESSION['erro'] = '';

			// Valida preenchimento.
			if (empty($post['nome'])) {
				$_SESSION['erro'] .= "<br>- Preencha o título.";
			}

			if (empty($post['detalhes'])) {
				$_SESSION['erro'] .= "<br>- Preencha os detalhes.";
			}

			if (empty($post['referencia'])) {
				$_SESSION['erro'] .= "<br>- Preencha a referência.";
			}

			if (empty($post['departamento_id'])) {
				$_SESSION['erro'] .= "<br>- Selecione o departamento.";
			}

			if (isset($post['status']) && !in_array($post['status'], [0, 1])) {
				$_SESSION['erro'] .= "<br>- Situação inválida.";
			}

			if (!empty($post['tamanho'])) {
				$post['tamanho'] = str_replace('.', '', $post['tamanho']); // Remove pontos.
			} else {
				$post['tamanho'] = "";
			}

			if (!empty($post['estoque'])) {
				$post['estoque'] = str_replace('.', '', $post['estoque']); // Remove pontos.
			} else {
				$post['estoque'] = 0;
			}

			if (!empty($post['vezes'])) {
				$post['vezes'] = $util->formatMoedaDecimal($post['vezes']); // Formata para gravação.
			} else {
				$post['vezes'] = 0;
			}

			if (!empty($post['preco_venda'])) {
				$post['preco_venda'] = $util->formatMoedaDecimal($post['preco_venda']); // Formata para gravação.
			} else {
				$post['preco_venda'] = 0;
			}

			// Valida imagem
			if ($arquivos->validaArquivo('imagem', 'jpeg;jpg;png;gif', 3)) {
				// Define nome do arquivo com timestamp atual.
				$post['imagem'] = time() . '.' . $arquivos->tipoArquivo('imagem');
				// Salva imagem.
				if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], DIR_FILES . '/' . $post['imagem'])) {
					$_SESSION['alerta'] = 'A imagem não foi salva. Verifique as permissões de pastas.';
				}
			} else {
				if (!empty($arquivos->nomeArquivo('imagem'))) {
					$_SESSION['alerta'] = 'A imagem não passou na validação e não foi salva. Verifique o tamanho e o formato de arquivos permitidos.';
				}
			}

			// Executa edição.
			if (empty($_SESSION['erro'])) {
				if (!empty($post['imagem'])) {
					$query = mysqli_query($db, "UPDATE produtos set nome = '{$post['nome']}', referencia = '{$post['referencia']}', codigo_barras = '{$post['codigo_barras']}', departamento_id = {$post['departamento_id']}, tamanho = {$post['tamanho']}, imagem = '{$post['imagem']}', descricao = '{$post['descricao']}', detalhes = '{$post['detalhes']}', preco_custo = '{$post['preco_custo']}', preco_venda = '{$post['preco_venda']}', status = {$post['status']} WHERE id = {$post['id']}");
				} else {
					$query = mysqli_query($db, "UPDATE produtos set nome = '{$post['nome']}', referencia = '{$post['referencia']}', codigo_barras = '{$post['codigo_barras']}', departamento_id = {$post['departamento_id']}, tamanho = {$post['tamanho']}, descricao = '{$post['descricao']}', detalhes = '{$post['detalhes']}', vezes = '{$post['vezes']}', preco_venda = '{$post['preco_venda']}', status = {$post['status']} WHERE id = {$post['id']}");	
				}
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
			$query = mysqli_query($db, "DELETE FROM produtos WHERE id = {$id}");
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

	case 'list': // Carrega arquivo.
		include 'list.php';
		break;

	default: // Carrega lista, exibindo mensagem de erro.
		$_SESSION['erro'] = 'Você não possui autorização para acessar o módulo ou registro especificado.';
		include 'list.php';
		break;
	}
?>