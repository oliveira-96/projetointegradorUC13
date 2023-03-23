<div class="row">
	<div class="col-lg-12">
        <form accept-charset="UTF-8" action="" name="form" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="assunto">
                                Assunto:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input name="assunto" type="text" class="form-control" value="<?= (!empty($item['assunto']) ? $item['assunto'] : ''); ?>" readonly="" autofocus />
                        </div>
                    </div>
				</div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="nome">
                                Nome:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input name="nome" type="text" class="form-control" value="<?= (!empty($item['nome']) ? $item['nome'] : ''); ?>" readonly="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="telefone">
                                Telefone:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="telefone" type="text" class="form-control" value="<?= (!empty($item['telefone']) ? $item['telefone'] : ''); ?>" readonly="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="email">
                                E-mail:
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <input name="email" type="text" class="form-control" value="<?= (!empty($item['email']) ? $item['email'] : ''); ?>" readonly="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="mensagem">
                                Mensagem:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <textarea name="mensagem" class="form-control" rows="5" readonly=""><?= (!empty($item['mensagem']) ? $item['mensagem'] : ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row well">
                <div class="col-lg-12" style="text-align: center;">
                    <a class="btn btn-default" href="?m=<?= $modulo; ?>" title="Cancelar">
                        <i class="fa fa-times fa-fw"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
	</div>
</div>