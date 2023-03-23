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
                            <label class="control-label" for="referencia">
                                <span class="required">*</span> Referência:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="referencia" maxlength="30" type="text" class="form-control" value="<?= (!empty($item['referencia']) ? $item['referencia'] : ''); ?>" required="required" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="codigo_barras">
                                Código de barras:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="codigo_barras" maxlength="13" type="text" class="form-control" value="<?= (!empty($item['codigo_barras']) ? $item['codigo_barras'] : ''); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="departamento_id">
                                <span class="required">*</span> Departamento:
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <select name="departamento_id" class="form-control" required="">
                                <option value="">Selecione</option>
                                <?php
                                    $query = mysqli_query($db, "SELECT id, departamento FROM departamentos WHERE status = 1 ORDER BY departamento ASC");
                                    if (mysqli_num_rows($query)) {
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <option value="<?= $row['id']; ?>" <?= (!empty($item['departamento_id']) && $item['departamento_id'] == $row['id'] ? 'selected' : ''); ?>><?= $row['departamento']; ?></option>
                                        <?php
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
                            <label class="control-label" for="imagem">
                                Imagem:<br>
                                <span class="comentario">Formatos: JPG, PNG e GIF com até 3mb.</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <?php 
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
                            <label class="control-label" for="detalhes">
                                Detalhes:<br>
                                <span class="comentario">Detalhação completa, pode utilizar tags HTML.</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <textarea name="detalhes" class="form-control" rows="10"><?= (!empty($item['detalhes']) ? $item['detalhes'] : ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="tamanho">
                            tamanho: <br>
                            <span class="comentario">separe os tamanhos por ","</span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input name="tamanho" maxlength="255" type="text" class="form-control" value="<?= (!empty($item['tamanho']) ? $item['tamanho'] : ''); ?>"  />
                        </div>
                    </div>
				</div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="estoque">
                                Estoque:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="estoque" data-type="inteiro" type="text" class="form-control" value="<?= (!empty($item['estoque']) ? $item['estoque'] : 0); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="vezes">
                                Até quantas vezes:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="vezes" data-type="inteiro" type="text" class="form-control" value="<?= (!empty($item['vezes']) ? $item['vezes'] : 0); ?>" />
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-4 lbl">
                            <label class="control-label" for="preco_venda">
                                Preço de venda:
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <input name="preco_venda" data-type="moeda" type="text" class="form-control" value="<?= (!empty($item['preco_venda']) ? $item['preco_venda'] : 0); ?>" />
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
                                <option value="0" <?= ($acao == 'edit' && empty($item['status']) ? 'selected' : ''); ?>>Indisponível</option>
                                <option value="1" <?= ($acao == 'new' || !empty($item['status']) ? 'selected' : ''); ?>>Disponível</option>
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