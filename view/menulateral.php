<!-- BEGIN SIDEBAR -->
<?php
    $id = $_GET['idMenu'];
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

            <!--BEGIN BOTAO MENU-->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!--END BOTAO MENU-->

            <!--BEGIN BUSCA-->
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search  " action="http://keenthemes.com/preview/metronic/theme/admin_1/page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                    </div>
                </form>
            </li>
            <!--END BUSCA-->

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
                    <?php echo ($_GET['idMenu'] == 31 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="cadastrar/projetos" class="nav-link nav-toggle">
                        <span class="title">Novo Projeto</span>
                    </a>
                    </li>

                    <?php echo ($_GET['idMenu'] == 32 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/projetos" class="nav-link nav-toggle">
                        <span class="title">Ver Projetos</span>
                    </a>
                    </li>
                </ul>
            </li>


            <?php
            if($_GET['idMenu'] == 41 || $_GET['idMenu'] == 42 || $_GET['idMenu'] == 43){
                echo('<li class="nav-item start active open"><a href="tarefas" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="tarefas" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
            <i class="fa fa-tasks"></i>
            <span class="title">Tarefas</span>
            </a>
                <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->
                    <?php echo ($_GET['idMenu'] == 41 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="cadastrar/tarefas" class="nav-link nav-toggle">
                        <span class="title">Nova Tarefa</span>
                    </a>
                    </li>

                    <?php echo ($_GET['idMenu'] == 42 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/tarefas" class="nav-link nav-toggle">
                        <span class="title">Ver Tarefas</span>
                    </a>

                    <?php echo ($_GET['idMenu'] == 43 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                    <a href="listar/minhas-tarefas" class="nav-link nav-toggle">
                        <span class="title">Minhas Tarefas</span>
                    </a>
                    </li>
                </ul>
            </li>


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
                    <?php echo ($_GET['idMenu'] == 52 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
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
            <!--END Configurações-->

            <li class="heading">
                <h3 class="uppercase">Pages</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-basket"></i>
                    <span class="title">eCommerce - Exemplo</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="ecommerce_index.html" class="nav-link ">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="ecommerce_orders.html" class="nav-link ">
                            <i class="icon-basket"></i>
                            <span class="title">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="ecommerce_orders_view.html" class="nav-link ">
                            <i class="icon-tag"></i>
                            <span class="title">Order View</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="ecommerce_products.html" class="nav-link ">
                            <i class="icon-graph"></i>
                            <span class="title">Products</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="ecommerce_products_edit.html" class="nav-link ">
                            <i class="icon-graph"></i>
                            <span class="title">Product Edit</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->