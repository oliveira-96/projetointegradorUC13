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
                            <label class="control-label" for="titulo">
                                <span class="required">*</span> Título:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input name="titulo" maxlength="255" type="text" class="form-control" value="<?= (!empty($item['titulo']) ? $item['titulo'] : ''); ?>" required="required" autofocus />
                        </div>
                    </div>
				</div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="categoria_id">
                                <span class="required">*</span> Categoria:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <select name="categoria_id" class="form-control" required="">
                                <option value="">Selecione</option>
                                <?php
                                    $query = mysqli_query($db, "SELECT id, categoria FROM categorias WHERE status = 1 ORDER BY categoria ASC");
                                    if (mysqli_num_rows($query)) {
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <option value="<?= $row['id']; ?>" <?= (!empty($item['categoria_id']) && $item['categoria_id'] == $row['id'] ? 'selected' : ''); ?>><?= $row['categoria']; ?></option>
                                        <?
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="resumo">
                                Resumo:<br>
                                <span class="comentario">Artigo resumido para chamada no site, NÃO pode utilizar tags HTML.</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <textarea name="resumo" class="form-control" rows="3"><?= (!empty($item['resumo']) ? $item['resumo'] : ''); ?></textarea>
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
                            <label class="control-label" for="conteudo">
                                Conteúdo:<br>
                                <span class="comentario">Artigo completo, pode utilizar tags HTML.</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <textarea name="conteudo" class="form-control" rows="10"><?= (!empty($item['conteudo']) ? $item['conteudo'] : ''); ?></textarea>
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