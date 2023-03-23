<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
            <i class="fa fa-user fa-fw"></i> <?= (!empty($user['nome']) ? $user['nome'] : ''); ?> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="?m=conta"><i class="fa fa-edit fa-fw"></i> Minha conta</a></li>
            <li><a href="?m=usuarios"><i class="fa fa-users fa-fw"></i> Usuários</a></li>
            <li class="divider"></li>
            <li><a href="#suporte" data-toggle="modal" data-target="#suporte"><i class="fa fa-support fa-fw"></i> Suporte</a></li>
            <li class="divider"></li>
            <li><a href="?m=logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->