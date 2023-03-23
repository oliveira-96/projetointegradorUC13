<div class="row">
	<div class="col-lg-12">
        <form accept-charset="UTF-8" action="" name="form" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
            <fieldset>
            <input type="hidden" name="submit" value="1" />

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
                                Senha:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="senha" maxlength="20" type="password" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="confirmar">
                                Confirmar senha:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="confirmar" maxlength="20" type="password" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-warning">
                        <strong>Atenção:</strong> Preencha os campos "Senha" e "Confirmar senha" somente se desejar alterá-la.
                    </div>
                </div>
            </div>

            <div class="row well">
                <div class="col-lg-12" style="text-align: center;">
                    <a class="btn btn-default" href="?m=dashboard" title="Cancelar">
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