<?php
require('config.php');
// Pega o id da url.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!empty($id)) {
    // Busca produto.
    $query = mysqli_query($db, "SELECT *  FROM produtos WHERE status = 1 AND id = {$id}");
    if (mysqli_num_rows($query)) {
        $item = mysqli_fetch_assoc($query);

        // Verifica e ajusta caminho da imagem.
        if (empty($item['imagem'])) {
            // Define a imagem default.
            $item['imagem'] = 'assets/sem-imagem.jpg';
        } else {
            // Verifica a existência do arquivo físico.
            if (!file_exists('cms/uploads/' . $item['imagem'])) {
                // Define a imagem default.
                $item['imagem'] = 'assets/sem-imagem.jpg';
            } else {
                // Ajusta caminho da imagem.
                $item['imagem'] = 'cms/uploads/' . $item['imagem'];
            }
        }
    } else {
        ?>
        <script>window.location = '?m=404';</script>
        <?php
    }
} else {
    // Erro 404.
    ?>
    <script>window.location = '?m=404';</script>
    <?php
}
?>
<div class="content">
    <div class="imgdetalhes">
        <img class="my-listdetalhes" src="<?= $item['imagem']; ?>" alt="<?= $item['imagem']; ?>" />
    </div>
    <div class="lojadetalhes texto-destaque">

        <h1>
            <?= $item['nome']; ?>
        </h1><br>

        <h2>
            <?php if ($item['vezes'] == 0) {
                $item['vezes'] = 1;
                echo 'R$ ' . $item['preco_venda'];
            } else {
                $precoParcelado = $item['preco_venda'] / $item['vezes'];
                $precoParceladoFormatado = number_format($precoParcelado, 2, ',', '.');
                ?>
                R$
                <?= $item['preco_venda']; ?> ou
                <?= $item['vezes']; ?>x de
                R$
                <?= $precoParceladoFormatado ?>
            <?php }
            ?>
        </h2><br>
        <h3>Tamanhos</h3>
        <p>
            <?= $item['tamanho']; ?>
        </p>
        <h3>Descrição</h3>
        <p>
            <?= $item['descricao']; ?>
        </p>
        <h3>Detalhes</h3>
        <p>
            <?= $item['detalhes']; ?>

        </p>
        <a href="?m=loja" class="btn btn-info">Voltar</a>
        <?php
        //configurações para whatsapp
        
        // Número do WhatsApp para o qual a mensagem será enviada
        $whatsapp_number = '54997096135';

        // Detalhes da roupa
        $produto = $item['nome'];
        $tamanhos = $item['tamanho'];
        $numero = $item['id'];
        $link = 'http://localhost:8080/projetoxint/?m=lojadetalhes&id=' . $numero;

        // Constrói a mensagem em forma de lista
        $mensagem = "*Gostaria desses Produtos*\n";
        $mensagem .= "- Produto: $produto\n";
        $mensagem .= "- Tamanhos disponíveis: $tamanhos\n";
        $mensagem .= "- Número do produto: $numero\n";
        $mensagem .= "- Link do produto: $link\n";

        // URL para enviar a mensagem através da API do WhatsApp
        $url = 'https://wa.me/' . $whatsapp_number . '?text=' . urlencode($mensagem);


        ?>
        <a href="<?php echo $url ?>" class="btn btn-success">Whatsapp</a>

    </div>
</div>