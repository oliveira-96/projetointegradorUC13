<?php
require('config.php');
// Definir quantos itens serão exibidos por página
$itens_por_pagina = 8;

// Obter o número da página atual a partir da URL
$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);

if (!$pagina_atual) {
    $pagina_atual = 1; // Página padrão é a primeira
}

// Calcular o offset (deslocamento) para a consulta SQL
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Consultar o banco de dados com LIMIT e OFFSET
$query = mysqli_query($db, "SELECT * FROM produtos ORDER BY id DESC LIMIT $itens_por_pagina OFFSET $offset");

if (mysqli_num_rows($query)) {
    while ($item = mysqli_fetch_assoc($query)) {
        if (empty($item['imagem'])) {
            $item['imagem'] = 'assets/sem-imagem.jpg';
        } else {
            if (!file_exists('cms/uploads/' . $item['imagem'])) {
                $item['imagem'] = 'assets/sem-imagem.jpg';
            } else {
                $item['imagem'] = 'cms/uploads/' . $item['imagem'];
            }
        }
        ?>
        <div class="">
            <div class="content">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="my-list">
                        <img style="height: 300px; width: 250px" src="<?= $item['imagem']; ?>" alt="<?= $item['imagem']; ?>" />
                        <h3>
                            <?= $item['nome']; ?>
                        </h3>
                        <span>
                            <?php if ($item['vezes'] == 0) {
                                echo 'somente a vista';

                            } else {
                                ?>
                                Até
                                <?= $item['vezes']; ?>x no cartão
                            <?php }
                            ?>
                        </span>
                        <span class="pull-right">R$
                            <?= $item['preco_venda']; ?>
                        </span>
                        <div class="offer">20% de desconto no mês de outubro</div>
                        <div class="detail">
                            <p>
                                <?= $item['nome']; ?>
                            </p>
                            <img src="<?= $item['imagem']; ?>" alt="<?= $item['imagem']; ?>" />
                            <a href="?m=lojadetalhes&id=<?= $item['id']; ?>" class="btn btn-info">Detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <p>Nenhum conteúdo por aqui</p>
    <?php
}
?>
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <?php
        // Exibir links de navegação para as outras páginas
        $query_total = mysqli_query($db, "SELECT COUNT(*) as total FROM produtos");
        $total_itens = mysqli_fetch_assoc($query_total)['total'];
        $total_paginas = ceil($total_itens / $itens_por_pagina);

        echo '<nav aria-label="Navegação de página">';
        echo '<ul class="pagination">';
        ?>
        <?php
        for ($i = 1; $i <= $total_paginas; $i++) {
            $active = ($i == $pagina_atual) ? 'active' : '';
            echo '<li class="page-item ' . $active . '">';
            echo '<a class="page-link" href="?m=loja&pagina=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }
        ?>
        </ul>
        </nav>
    </div>
</div>