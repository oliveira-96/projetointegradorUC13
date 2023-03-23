<?php
	// Valida acesso.
	if (!empty($_POST['submit'])) {

		// Sanitiza e valida dados do post.
        $post = array_map('strip_tags', $_POST);
        foreach ($post as $key => $value) {
            $post[$key] = mysqli_real_escape_string($db, $value);
        }

        // Efetua busca.
        $query = mysqli_query($db, "SELECT id, nome, celular, email FROM usuarios WHERE email = '{$post['usuario']}' AND senha = MD5('{$post['senha']}') AND status = 1 LIMIT 1");
        if (mysqli_num_rows($query)) {
            // Cria a sessão.
            $_SESSION['user'] = mysqli_fetch_assoc($query);
            $_SESSION['sucesso'] = "Olá {$_SESSION['user']['nome']}, seja bem-vindo(a)!";
            ?>
                <script>
                    window.location.reload();
                </script>
            <?php
            exit; // Interrompe a execução
        } else {
            $_SESSION['erro'] = "Usuário e senha incorretos.";
        }
	}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <!-- Logo -->
            <div id="logo-login">
            	<h3><?= CMS_NOME; ?></h3>
            </div>

            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Autenticação</h3>
                </div>
                <div class="panel-body">
				    <?php
				        // Exibe notificações.
				        if (!empty($_SESSION['erro'])) {
				        ?>
				            <div class="alert alert-danger"><a class="close" data-dismiss="alert" href="javascript:void(0);">&times;</a><strong><?= $_SESSION['erro']; ?></strong></div>
				        <?php
				        }

				        if (!empty($_SESSION['sucesso'])) {
				        ?>
				            <div class="alert alert-success"><a class="close" data-dismiss="alert" href="javascript:void(0);">&times;</a><strong><?= $_SESSION['sucesso']; ?></strong></div>
				        <?php
				        }

                        if (!empty($_SESSION['alerta'])) {
                        ?>
                            <div class="alert alert-warning"><a class="close" data-dismiss="alert" href="javascript:void(0);">&times;</a><strong><?= $_SESSION['alerta']; ?></strong></div>
                        <?php
                        }

				        unset($_SESSION['erro'], $_SESSION['sucesso'], $_SESSION['alerta']);
				    ?>
                    <form role="form" accept-charset="UTF-8" action="" name="form" id="form" method="post">
                        <fieldset>
                            <input type="hidden" name="submit" value="1"/>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Usuário" name="usuario" maxlength="100" value="<?= (!empty($post['usuario']) ? $post['usuario'] : ''); ?>" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Senha" name="senha" type="password" maxlength="20" value="">
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block">
                            	Acessar
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="login-footer">
    <p style="color: #767676; padding-top: 25px; text-align:center;">
        &copy;<?= date('Y') . ' Direitos reservados. ' . CMS_NOME . ' v.' . CMS_VERSAO; ?>
    </p>
    <p style="text-align:center;">
        <a href="#suporte" data-toggle="modal" data-target="#suporte">Suporte técnico</a>
    </p>
</div>