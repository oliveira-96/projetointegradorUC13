<?php
    // Carrega alertas.
    include 'alerts.php';
?>

<?php
    // Executa busca de totalizadores.
    $query = mysqli_query($db, "SELECT (SELECT count(*) FROM contatos) AS total_contatos, (SELECT count(*) FROM usuarios) AS total_usuarios, (SELECT count(*) FROM categorias) AS total_categorias, (SELECT count(*) FROM artigos) AS total_artigos");
    if (mysqli_num_rows($query)) {
        $totais = mysqli_fetch_assoc($query);
    } else {
        $totais = array(
            'total_contatos' => 0,
            'total_usuarios' => 0,
            'total_categorias' => 0,
            'total_artigos' => 0
        );
    }
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Dashboard</h3>
    </div>
</div>

<div class="row">
	<div class="col-md-3" style="margin-bottom:18px;">
		<button class="btn btn-primary btn-lg btn-block" disabled="disabled">
			<h2>
	            <span class="fa fa-comment fa-fw"></span>
                <?= $totais['total_contatos']; ?>
            </h2>
        	Contatos
        </button>
	</div>
	<div class="col-md-3" style="margin-bottom:18px;">
		<button class="btn btn-danger btn-lg btn-block" disabled="disabled">
			<h2>
	            <span class="fa fa-users fa-fw"></span>
                <?= $totais['total_usuarios']; ?>
            </h2>
        	Usuários
        </button>
	</div>
	<div class="col-md-3" style="margin-bottom:18px;">
		<button class="btn btn-warning btn-lg btn-block" disabled="disabled">
			<h2>
	            <span class="fa fa-tags fa-fw"></span>
                <?= $totais['total_categorias']; ?>
            </h2>
        	Categorias
        </button>
	</div>
	<div class="col-md-3" style="margin-bottom:18px;">
		<button class="btn btn-success btn-lg btn-block" disabled="disabled">
			<h2>
	            <span class="fa fa-newspaper-o fa-fw"></span>
                <?= $totais['total_artigos']; ?>
            </h2>
        	Artigos
        </button>
	</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            	<i class="fa fa-comment fa-fw"></i>
                <strong>Contatos recentes</strong>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Recebido em</th>
                                <th>Assunto</th>
								<th>Nome</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Monta e executa query.
                            $query = mysqli_query($db, "SELECT * FROM contatos" . (!empty($busca) ? " WHERE ({$search})" : '') . " ORDER BY id DESC LIMIT 5");

                            if (mysqli_num_rows($query)) {
                                while ($item = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td style="text-align:right; width: 20%;">
                                            <?= (!empty($item['criado_em']) ? date('d/m/Y H:i\h', strtotime($item['criado_em'])) : ''); ?>
                                        </td>
                                        <td>
                                            <?= (!empty($item['assunto']) ? $item['assunto'] : ''); ?>
                                        </td>
                                        <td>
                                            <a href="?m=contatos&a=edit&id=<?= $item['id'] ;?>">
                                                <?= (!empty($item['nome']) ? $item['nome'] : ''); ?>
                                            </a>
                                        </td>
                                        <td style="width: 20%;"><?= (!empty($item['telefone']) ? $item['telefone'] : ''); ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;">Nenhum registro encontrado.</td>
                                </tr>
                            <?php
                            }
                        ?>
                        </tbody>
                    </table>
				</div>
                <a href="?m=contatos" class="btn btn-lg btn-primary btn-block">Todos os contatos</a>
            </div>
        </div>
	</div>
</div>