<?php
    // Verifica e define paginação de dados.
    $pagina = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);
    if (empty($pagina)) $pagina = 1;
    $limite = 10; // Itens por página.
    $inicio = ($pagina * $limite) - $limite; // Calcula início.

    // Verifica e monta busca.
    $busca = filter_input(INPUT_GET, 'b', FILTER_DEFAULT);
    if (!empty($busca)) {
        // Sanitiza busca.
        $search = mysqli_real_escape_string($db, trim($busca));

        // Define campos de busca.
        $campos = array();
        $campos[] = "assunto LIKE '%{$search}%'";
        $campos[] = "nome LIKE '%{$search}%'";
        $campos[] = "email LIKE '%{$search}%'";
        $campos[] = "telefone LIKE '%{$search}%'";
        $campos[] = "mensagem LIKE '%{$search}%'";
        
        // Mescla string de busca.
        $search = join(' or ', $campos);
    }

    // Monta e executa query.
    $query = mysqli_query($db, "SELECT * FROM contatos" . (!empty($busca) ? " WHERE ({$search})" : '') . " ORDER BY id DESC LIMIT {$inicio}, {$limite}");
?>

<?php
    // Carrega alertas.
    include './inc/alerts.php';
?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Contatos</h3>
    </div>
</div>

<div class="row">
    <div class="form-group col-lg-6">
        &nbsp;
    </div>

    <div class="col-lg-offset-3 col-lg-3">
        <form action="" accept-charset="UTF-8" method="get" role="form">
            <input type="hidden" name="m" value="<?= $modulo; ?>" />
            <div class="form-group input-group" style="text-align:right;">
                <input class="form-control" type="text" name="b" value="<?= (!empty($busca) ? $busca : ''); ?>" placeholder="Buscar" />
                <span class="input-group-btn">
                    <?php if (!empty($busca)) { ?>
                        <a class="btn btn-danger" href="?m=<?= $modulo; ?>" title="Limpar">
                            <i class="fa fa-times fa-fw"></i>
                        </a>
                    <?php } else { ?>
                        <button class="btn btn-default" type="submit" title="Buscar">
                            <i class="fa fa-search fa-fw"></i>
                        </button>
                    <?php } ?>
                </span>
            </div>
        </form>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
	                    <th>Recebido em</th>
                        <th>Assunto</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                <?
                    if (mysqli_num_rows($query)) {
                        while ($item = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td style="width: 20%;">
                                    <?= (!empty($item['criado_em']) ? date('d/m/Y H:i\h', strtotime($item['criado_em'])) : ''); ?>
                                </td>
                                <td>
                                    <?= (!empty($item['assunto']) ? $item['assunto'] : ''); ?>
                                </td>
                                <td>
                                    <?= (!empty($item['nome']) ? $item['nome'] : ''); ?>
                                </td>
                                <td style="width: 20%;">
                                    <?= (!empty($item['telefone']) ? $item['telefone'] : ''); ?>
                                </td>
                                <td style="text-align: center; width: 20%;">
                                    <a href="?m=<?= $modulo; ?>&a=edit&id=<?= $item['id']; ?>" class="btn btn-default" title="Visualizar">
                                        <i class="fa fa-eye fa-fw"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger" onClick="deletaRegistro(<?= $item['id']; ?>, '<?= $modulo; ?>');" title="Excluir">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                    </a>
                                </td>
                            </tr>
                        <?
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">
                                Nenhum registro encontrado.
                            </td>
                        </tr>
                    <?
                    }
                ?>
                </tbody>
            </table>
		</div>

        <?php
            // Conta o total de registros para a paginação de dados.
            $query = mysqli_query($db, "SELECT count(*) AS cont FROM contatos" . (!empty($busca) ? " WHERE ({$search})" : ''));
            if ($query) {
                $item = mysqli_fetch_array($query);

                // Exibe a paginação de dados.
                echo $paginacao->getPaginacao($pagina, $item['cont'], $limite, 1, "./", "?m=" . $modulo . (!empty($busca) ? "&b={$busca}" : '') . "&p=");
            }
        ?>
	</div>
</div>