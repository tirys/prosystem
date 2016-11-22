<?php
    $id = $_GET['idMenu'];
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper" style="display: none;">
                <form class="sidebar-search  " action="http://keenthemes.com/preview/metronic/theme/admin_1/page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar...">
                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                    </div>
                </form>
            </li>
            <?php
                if($_GET['idMenu'] == 1){
                    echo('<li class="nav-item start active open"><a href="dashboard" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
                }else{
                    echo('<li class="nav-item"><a href="dashboard" class="nav-link nav-toggle"></span><span class="arrow"></span>');
                }
            ?>
                    <i class="icon-home"></i>
                    <span class="title">Início</span>
                </a>
            </li>


            <li class="heading">
                <h3 class="uppercase">Projetos</h3>
            </li>

            <?php if($usuario_tipo != 0 && $usuario_tipo != 1 && $usuario_tipo != 2){?>

                <?php
                if($_GET['idMenu'] == 2){
                    echo('<li class="nav-item start active open"><a href="clientes" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
                }else{
                    echo('<li class="nav-item"><a href="clientes" class="nav-link nav-toggle"></span><span class="arrow"></span>');
                }
                ?>
                        <i class="icon-users"></i>
                        <span class="title">Clientes</span>
                        <span class="arrow"></span>
                    </a>
                 </li>
            <?php }?>


            <?php
            if($_GET['idMenu'] == 31 || $_GET['idMenu'] == 32){
                echo('<li class="nav-item start active open"><a href="javascript:;" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
                    <i class="icon-folder"></i>
                    <span class="title">Projetos</span>
                </a>
                <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->

                    <?php if($usuario_tipo != 2){?>
                        <?php echo ($_GET['idMenu'] == 31 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                        <a href="cadastrar/projetos" class="nav-link nav-toggle">
                            <span class="title">Novo Projeto</span>
                        </a>
                        </li>
                    <?php }?>

                    <?php echo ($_GET['idMenu'] == 32 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/projetos" class="nav-link nav-toggle">
                        <span class="title">Ver Projetos</span>
                    </a>
                    </li>
                </ul>
            </li>


            <?php
            if($_GET['idMenu'] == 41 || $_GET['idMenu'] == 42 || $_GET['idMenu'] == 43 || $_GET['idMenu'] == 44 || $_GET['idMenu'] == 45 || $_GET['usuario'] != ''){
                echo('<li class="nav-item start active open"><a href="tarefas" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="tarefas" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
            <i class="fa fa-tasks"></i>
            <span class="title">Tarefas</span>
            </a>
                <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->
                    <?php if($usuario_tipo != 2){?>
                        <?php echo ($_GET['idMenu'] == 41 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                        <a href="cadastrar/tarefas" class="nav-link nav-toggle">
                            <span class="title">Nova Tarefa</span>
                        </a>
                        </li>
                    <?php }?>

                    <?php echo ($_GET['idMenu'] == 42 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/tarefas" class="nav-link nav-toggle">
                        <span class="title">Tarefas Abertas</span>
                    </a>

                    <?php echo ($_GET['idMenu'] == 44 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/fechadas" class="nav-link nav-toggle">
                        <span class="title">Tarefas Fechadas</span>
                    </a>

                    <?php echo ($_GET['idMenu'] == 43 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/minhas-tarefas" class="nav-link nav-toggle">
                        <span class="title">Minhas Tarefas Abertas</span>
                    </a>

                    <?php echo ($_GET['idMenu'] == 45 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/minhas-fechadas" class="nav-link nav-toggle">
                        <span class="title">Minhas Tarefas Fechadas</span>
                    </a>

                    <?php if($usuario_tipo != 2){?>
                    <hr style="border:#454d58 solid 0.2px;width:85%;margin-left:10px;"></hr>

                    <?php
                        $conexao = new classeConexao();

                        $usuarios = $conexao::fetch("SELECT * FROM tb_usuarios WHERE tb_usuarios_tipo IN(0,1) ORDER BY tb_usuarios_nome");

                        foreach ($usuarios as $usuario) {
                            $num = '45'.$usuario['id'];
                            $num2 = '445'.$usuario['id'];
                    ?>
                            <?php if($usuario['tb_usuarios_menu_abertas']=='sim') {?>
                                <?php echo ($_GET['idMenu'] == $num ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                                <a href="listar-tarefas/usuario/<?=$usuario['id']?>" class="nav-link nav-toggle">
                                    <span class="title"><?=$usuario['tb_usuarios_nome']?> - Abertas</span>
                                </a>
                            <?php } ?>

                            <?php if($usuario['tb_usuarios_menu_fechadas']=='sim') {?>
                                <?php echo ($_GET['idMenu'] == $num2 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                                <a href="listar-fechadas/usuario/<?=$usuario['id']?>" class="nav-link nav-toggle">
                                    <span class="title"><?=$usuario['tb_usuarios_nome']?> - Fechadas</span>
                                </a>
                            <?php } ?>
                    <?php
                        }
                    ?>

                    <?php }?>
                    </li>
                </ul>
            </li>

            <?php
            //menu de aprovações
            if($_GET['idMenu'] == 71){
                echo('<li class="nav-item start active open"><a href="aprovacoes" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="aprovacoes" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
            <i class="fa fa-check-square-o"></i>
            <span class="title">Aprovações</span>
            <span class="arrow"></span>
            </a>
            </li>


            <?php if($usuario_tipo != 2){?>
                <!--START Configurações-->
                <li class="heading">
                    <h3 class="uppercase">Configurações</h3>
                </li>

                <?php
                if($_GET['idMenu'] == 51 || $_GET['idMenu'] == 52 || $_GET['idMenu'] == 53){
                    echo('<li class="nav-item start active open"><a href="javascript:;" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
                }else{
                    echo('<li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"></span><span class="arrow"></span>');
                }
                ?>
                        <i class="icon-user"></i>
                        <span class="title">Usuários</span>
                    </a>
                    <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->
                        <?php echo ($_GET['idMenu'] == 51 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                            <a href="cadastrar/usuario" class="nav-link nav-toggle">
                                <span class="title">Novo usuário</span>
                            </a>
                        </li>
                        <?php echo ($_GET['idMenu'] == 52||$_GET['idMenu'] == 53 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                            <a href="listar/usuario" class="nav-link ">
                                <span class="title">Ver usuários</span>
                            </a>
                        </li>
                      </ul>
                </li>

                <?php
                if($_GET['idMenu'] == 61 || $_GET['idMenu'] == 62){
                    echo('<li class="nav-item start active open"><a href="javascript:;" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
                }else{
                    echo('<li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"></span><span class="arrow"></span>');
                }
                ?>
                        <i class="icon-briefcase"></i>
                        <span class="title">Empresas</span>
                    </a>
                    <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->
                        <?php echo ($_GET['idMenu'] == 61 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                            <a href="cadastrar/empresa" class="nav-link ">
                                <span class="title">Nova empresa</span>
                            </a>
                        </li>
                        <?php echo ($_GET['idMenu'] == 62 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                            <a href="listar/empresas" class="nav-link ">
                                <span class="title">Ver empresas</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php }?>
        </ul>
    </div>
</div>
