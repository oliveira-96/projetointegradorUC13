<?php
	// Importa configurações.
	require_once './config.php';

	// Verifica módulo.
	$modulo = filter_input(INPUT_GET, 'm', FILTER_DEFAULT);
	if (empty($modulo)) $modulo = 'dashboard';

	// Verifica sessão do usuário.
	session_start();
	if (!empty($_SESSION['user'])) {
		$user = $_SESSION['user'];
	} else {
		if ($modulo != 'dashboard') {
			$_SESSION['erro'] = 'Efetue login para continuar.'; // Define mensagem.

			// Redireciona acesso.
			header('Location: ./');
			exit;
		}
	}

	// Verifica logout.
	if ($modulo == 'logout') {
		$_SESSION['sucesso'] = 'Sessão encerrada.'; // Define mensagem.
		unset($_SESSION['user'], $user); // Destroi a sessão.

		// Redireciona acesso.
		header('Location: ./');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="<?= CMS_AUTOR; ?>">

    <title><?= CMS_NOME; ?></title>
	<link href="./cdn/imgs/favicon.png" type="image/png" rel="icon" />

    <!-- CSS - Padrão template -->
    <link href="./cdn/css/bootstrap.min.css" rel="stylesheet">
    <link href="./cdn/css/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="./cdn/css/sb-admin.css" rel="stylesheet">

	<!-- CSS - Customizações -->
	<link href="./cdn/css/custom.css" rel="stylesheet">
</head>

<body>
	<?php if (!empty($user)) { ?>
	    <div id="wrapper">
	        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
	                    <span class="sr-only">Navegação</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="javascript:void(0);" style="margin-left: 20px;">
	                    <h3><?= CMS_NOME; ?></h3>
	                </a>
	            </div>
	            <!-- /.navbar-header -->

		        <?php
		        	// Carrega menu navbar.
		        	include './inc/navbar.php';

		        	// Carrega menu sidebar.
			    	include './inc/sidebar.php';
			    ?>
	        </nav>

	        <div id="page-wrapper">
				<?php
					// Verifica existência do arquivo.
					if (file_exists('./app/' . $modulo . '/_controller.php')) {
						$file = './app/' . $modulo . '/_controller.php';
					} else {
						if ($modulo != 'dashboard') {
							// Define mensagem de erro.
							$_SESSION['erro'] = 'Você não possui autorização para acessar o módulo ou registro especificado.';
							$modulo = 'dashboard';
						}
						$file = './inc/dashboard.php';
					}

					// Carrega arquivo definido.
					include $file;
				?>
	        </div>
	        <!-- /#page-wrapper -->
	    </div>
	    <!-- /#wrapper -->
	<?php } else { ?>
		<?php include './inc/login.php'; ?>
	<?php } ?>

	<div class='modal fade' id='suporte' tabindex="-1" role="dialog" aria-labelledby="suporte" aria-hidden="true">
		<div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h3>Suporte técnico</h3>
	            </div>
	            <div class="modal-body">
	            	<p style="text-align:justify">
	                    <strong>Desenvolvedor: </strong> <?= CMS_AUTOR; ?>
	                </p>
	                <p style="text-align:justify">
	                    <strong>Via e-mail: </strong> <?= CMS_EMAIL; ?>
	                </p>
	                <p style="text-align:justify">
	                    <strong>Via whatsapp: </strong> <?= CMS_WHATSAPP; ?>
	                </p>
	            </div>
	            <div class="modal-footer">
	                <a class="btn btn-default" href="javascript:void(0);" data-dismiss="modal"><span class="fa fa-times"></span> Fechar</a>
	            </div>
			</div>
		</div>
	</div>

    <!-- Scripts - Padrão template -->
    <script src="./cdn/js/jquery.js"></script>
    <script src="./cdn/js/bootstrap.min.js"></script>
    <script src="./cdn/js/jquery.metisMenu.js"></script>
    <script src="./cdn/js/sb-admin.js"></script>

    <!-- Scripts - Padrão projeto -->
    <script src="./cdn/js/validacoes.js"></script>
	<script src="./cdn/js/jquery.maskedinput.js"></script>
    <script src="./cdn/js/jquery.price_format.1.3.js"></script>
    <script src="./cdn/js/custom.js"></script>

	<?php
		// Importa javascript do módulo.
		if (file_exists('./app/' . $modulo . '/scripts.js')) {
		?>
			<script src="<?= './app/' . $modulo . '/scripts.js'; ?>"></script>
		<?php
		}
	?>
</body>
</html>