<?php
	$arquivo = filter_input(INPUT_GET, 'arquivo', FILTER_DEFAULT);
	if (!empty($arquivo) && is_file($arquivo)) {
		header ("Content-Disposition: attachment; filename=".basename($arquivo));
		header ("Content-Type: application/octet-stream");
		header ("Content-Length: ".filesize($arquivo));
		readfile($arquivo);
	} else {
		echo 'erro';
	}
?>