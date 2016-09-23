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
            if($_GET['idMenu'] == 3){
                echo('<li class="nav-item start active open"><a href="projetos" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="projetos" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
                    <i class="icon-folder"></i>
                    <span class="title">Projetos</span>
                    <span class="arrow"></span>
                </a>
            </li>


            <?php
            if($_GET['idMenu'] == 4){
                echo('<li class="nav-item start active open"><a href="tarefas" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="tarefas" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
                    <i class="fa fa-tasks"></i>
                    <span class="title">Tarefas</span>
                    <span class="arrow"></span>
                </a>
            </li>


            <!--START Configurações-->
            <li class="heading">
                <h3 class="uppercase">Configurações</h3>
            </li>
            <?php
            if($_GET['idMenu'] == 5 || $_GET['idMenu'] == 6){
                echo('<li class="nav-item start active open"><a href="javascript:;" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
                    <i class="icon-user"></i>
                    <span class="title">Usuários</span>
                </a>
                <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->
                    <?php echo ($_GET['idMenu'] == 5 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                        <a href="cadastrar/usuario" class="nav-link nav-toggle">
                            <span class="title">Novo usuário</span>
                        </a>
                    </li>
                    <?php echo ($_GET['idMenu'] == 6 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                        <a href="layout_ajax_page.html" class="nav-link ">
                            <span class="title">Ver usuários</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            if($_GET['idMenu'] == 7 || $_GET['idMenu'] == 8){
                echo('<li class="nav-item start active open"><a href="javascript:;" class="nav-link nav-toggle"><span class="selected"></span><span class="arrow open"></span>');
            }else{
                echo('<li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"></span><span class="arrow"></span>');
            }
            ?>
                    <i class="icon-user"></i>
                    <span class="title">Empresas</span>
                </a>
                <ul class="sub-menu " > <!-- style="display: block;" para manter aberto-->
                    <?php echo ($_GET['idMenu'] == 7 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                        <a href="cadastrar/empresa" class="nav-link ">
                            <span class="title">Nova empresa</span>
                        </a>
                    </li>
                    <?php echo ($_GET['idMenu'] == 8 ? '<li class="nav-item active">' : '<li class="nav-item">');?>
                        <a href="layout_ajax_page.html" class="nav-link ">
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