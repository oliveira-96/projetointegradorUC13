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
                            <input name="nome" maxlength="255" type="text" class="form-control" value="<?= (!empty($item['nome']) ? $item['nome'] : ''); ?>" required="required" autofocus />
                        </div>
                    </div>
				</div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="imagem">
                                Imagem:<br>
                                <span class="comentario">Formatos: JPG, PNG e GIF com até 3mb.</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <? 
                                if ($acao == 'edit' && !empty($item['imagem'])) {
                                    echo $imagens->exibeImagem(DIR_FILES . '/' . $item['imagem'], './cdn/imgs/indisponivel.png');
                                }
                            ?>
                            <input name="imagem" type="file" title="Selecione o arquivo" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="descricao">
                                Descrição:<br>
                                <span class="comentario">Descrição completa, pode utilizar tags HTML.</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <textarea name="descricao" class="form-control" rows="10"><?= (!empty($item['descricao']) ? $item['descricao'] : ''); ?></textarea>
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
                            <input name="email" maxlength="100" type="email" class="form-control" value="<?= (!empty($item['email']) ? $item['email'] : ''); ?>" />
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
                            <input name="telefone" maxlength="50" type="tel" data-type="telefone" class="form-control" value="<?= (!empty($item['telefone']) ? $item['telefone'] : ''); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="status">
                                <span class="required">*</span> Situação:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <select name="status" class="form-control" required="">
                                <option value="">Selecione</option>
                                <option value="0" <?= ($acao == 'edit' && empty($item['status']) ? 'selected' : ''); ?>>Despublicado</option>
                                <option value="1" <?= ($acao == 'new' || !empty($item['status']) ? 'selected' : ''); ?>>Publicado</option>
                            </select>
                        </div>
                    </div>
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