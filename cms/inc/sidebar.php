<div class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="?m=dashboard"><i class="fa fa-bar-chart-o fa-fw"></i> Dashboard</a>
            </li>
            <li class="<?= (in_array($modulo, ['categorias', 'artigos']) ? 'active' : ''); ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-newspaper-o fa-fw"></i> Blog<span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="?m=categorias">
                            <i class="fa fa-tag fa-fw"></i> Categorias
                        </a>
                    </li>
                    <li>
                        <a href="?m=artigos">
                            <i class="fa fa-file-text-o fa-fw"></i> Artigos
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?= (in_array($modulo, ['departamentos', 'produtos', 'anuncios']) ? 'active' : ''); ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-shopping-cart fa-fw"></i> Loja<span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="?m=departamentos">
                            <i class="fa fa-list fa-fw"></i> Departamentos
                        </a>
                    </li>
                    <li>
                        <a href="?m=produtos">
                            <i class="fa fa-barcode fa-fw"></i> Produtos
                        </a>
                    </li>
                    <li>
                        <a href="?m=anuncios">
                            <i class="fa fa-bullhorn fa-fw"></i> Anúncios
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?= (in_array($modulo, ['contatos']) ? 'active' : ''); ?>">
                <a href="javascript:void(0);"><i class="fa fa-comments fa-fw"></i> Fale conosco<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="?m=contatos"><i class="fa fa-comment fa-fw"></i> Contatos</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>