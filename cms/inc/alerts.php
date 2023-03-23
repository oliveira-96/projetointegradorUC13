<div class="row">
    <div class="col-lg-12">
    <?php
        // Exibe notificações.
        if (!empty($_SESSION['erro'])) {
        ?>
            <div class="alert alert-danger" style="margin: 40px 0 20px;"><a class="close" data-dismiss="alert" href="javascript:void(0);">&times;</a><strong><?= $_SESSION['erro']; ?></strong></div>
        <?php
        }

        if (!empty($_SESSION['sucesso'])) {
        ?>
            <div class="alert alert-success" style="margin: 40px 0 20px;"><a class="close" data-dismiss="alert" href="javascript:void(0);">&times;</a><strong><?= $_SESSION['sucesso']; ?></strong></div>
        <?php
        }

        if (!empty($_SESSION['alerta'])) {
        ?>
            <div class="alert alert-warning" style="margin: 40px 0 20px;"><a class="close" data-dismiss="alert" href="javascript:void(0);">&times;</a><strong><?= $_SESSION['alerta']; ?></strong></div>
        <?php
        }

        unset($_SESSION['erro'], $_SESSION['sucesso'], $_SESSION['alerta']);
    ?>
    </div>
</div>