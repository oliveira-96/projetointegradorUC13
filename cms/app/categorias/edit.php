<?php
	// Verifica id do registro
	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	if (!empty($id)) {
		// Executa a busca.
		$query = mysqli_query($db, "SELECT * FROM categorias WHERE id = {$id}");
		if (mysqli_num_rows($query)) {
			$item = mysqli_fetch_assoc($query);
		} else {
			$_SESSION['erro'] = 'Você não possui autorização para acessar o módulo ou registro especificado.';
			?>
				<script>
					window.location = "./?m=<?= $modulo; ?>";
				</script>
			<?
			exit;
		}
	}
?>

<?php
    // Carrega alertas.
    include './inc/alerts.php';
?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
        	Categorias - Editar
        </h3>
    </div>
</div>

<?php
	// Carrega formulário.
	include '_form.php';
?>