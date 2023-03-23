<?php
	$arquivo = filter_input(INPUT_GET, 'arquivo', FILTER_DEFAULT);
	if (!empty($arquivo)) {
		if (file_exists($arquivo)) {
			unlink($arquivo);
			echo true;
		} else {
			echo '{"erro":2, "notificacao":"Não foi possível remover o arquivo."}';
		}
	}
?>