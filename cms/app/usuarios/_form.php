<div class="row">
	<div class="col-lg-12">
        <form accept-charset="UTF-8" action="" name="form" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
            <fieldset>
            <input type="hidden" name="submit" value="1" />
            <input type="hidden" name="id" value="<?= (!empty($item['id']) ? $item['id'] : ''); ?>" />

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="nome">
                                <span class="required">*</span> Nome:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input name="nome" maxlength="100" type="text" class="form-control" value="<?= (!empty($item['nome']) ? $item['nome'] : ''); ?>" required="required" autofocus />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="email">
                                <span class="required">*</span> E-mail:
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <input name="email" maxlength="100" type="email" class="form-control" value="<?= (!empty($item['email']) ? $item['email'] : ''); ?>" required="required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="celular">
                                Celular:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="celular" maxlength="50" type="tel" data-type="telefone" class="form-control" value="<?= (!empty($item['celular']) ? $item['celular'] : ''); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="senha">
                                <?= ($acao == 'new' ? '<span class="required">*</span> ' : ''); ?>Senha:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="senha" maxlength="20" type="password" class="form-control" <?= ($acao == 'new' ? 'required' : ''); ?> />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="confirmar">
                                <?= ($acao == 'new' ? '<span class="required">*</span> ' : ''); ?>Confirmar senha:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="confirmar" maxlength="20" type="password" class="form-control" <?= ($acao == 'new' ? 'required' : ''); ?> />
                        </div>
                    </div>

                    <?php if ($item['id'] != $user['id']) { ?>
                        <div class="form-group">
                            <div class="col-lg-4 lbl">
                                <label class="control-label" for="status">
                                    <span class="required">*</span> Situação:
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <select name="status" class="form-control" required="">
                                    <option value="">Selecione</option>
                                    <option value="0" <?= ($acao == 'edit' && empty($item['status']) ? 'selected' : ''); ?>>Desabilitado</option>
                                    <option value="1" <?= ($acao == 'new' || !empty($item['status']) ? 'selected' : ''); ?>>Habilitado</option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4">
                    <?php if ($acao == 'edit') { ?>
                        <div class="alert alert-warning">
                            <strong>Atenção:</strong> Preencha os campos "Senha" e "Confirmar senha" somente se desejar alterá-la.
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row well">
                <div class="col-lg-12" style="text-align: center;">
                    <a class="btn btn-default" href="?m=<?= $modulo; ?>" title="Cancelar">
                        <i class="fa fa-times fa-fw"></i> Cancelar
                    </a>
                    <button class="btn btn-primary" type="submit" title="Salvar">
                        <i class="fa fa-check fa-fw"></i> Salvar
                    </button>
                </div>
            </div>
        </form>
	</div>
</div>