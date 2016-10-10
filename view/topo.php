<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require ('../controller/verificalogin.php');
require ('../config/funcoes.php');
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie,true);

$conexao = new classeConexao();

$usuario = "";

if(count($cookie)>0) {
    $verificalogin = new VerificaLogin();
    $resultado = $verificalogin->verificaToken($cookie['t']);

    $usuario = $conexao::fetchuniq("SELECT tu.id, tu.tb_usuarios_nome, tu.tb_usuarios_foto, tu.tb_usuarios_tipo FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token = '".$cookie['t']."'");
    $usuario_tipo = $usuario['tb_usuarios_tipo'];

    if($resultado==0) {
        header('location:sessaoexpirada');
    }
}


?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <base href="<?=BASE_URL?>"/>
    <meta charset="utf-8" />
    <title>Prospecta - Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="view/libs/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="view/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="view/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="view/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="view/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="view/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="index-2.html">
                    <img src="view/assets/pages/img/login/logo.png" alt="logo" class="logo-default" width="150" style="margin-top:5px !important;"/> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- NOTIFICACOES -->
                    <!--NÃO USA POR ENQUANTO-->
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar" style="display:none;">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> 3 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">3 novas</span> notificações</h3>
                                <a href="page_user_profile_1.html">ver todas</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">Agora</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> Novo usuário registrado </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 mins</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">10 mins</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICACAO ->

                    <!-- MENSAGENS -->
                    <!--NÃO USA POR ENQUANTO-->
                    <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar" style="display:none;">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-default"> 2 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">2 Novas</span> Mensagens</h3>
                                <a href="app_inbox.html">ver todas</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="view/assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">Agora </span>
                                                    </span>
                                            <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="view/assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN TAREFAS -->
                    <?php
                    $tarefas = $conexao::fetchuniq("SELECT count(*) as qtd FROM tb_tarefas WHERE tb_tarefas_funcionario = {$usuario['id']} AND tb_tarefas_status != 1");
                    $tarefasLista = $conexao::fetch("SELECT * FROM tb_tarefas WHERE tb_tarefas_funcionario = {$usuario['id']} AND tb_tarefas_status != 1 ORDER BY tb_tarefas_data_termino ASC");
                    ?>
                    <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-calendar"></i>
                            <span class="badge badge-default"> <?=$tarefas['qtd']?> </span>
                        </a>
                        <ul class="dropdown-menu extended tasks">
                            <li class="external">
                                <h3>
                                    <span class="bold"><?=$tarefas['qtd']?> tarefas</span> pendentes</h3>
                                <a href="listar/minhas-tarefas">ver todas</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">

                                    <?php
                                    //Listagem das minhas tarefas pendentes no topo



                                    foreach ($tarefasLista as $tarefa) {

                                        $estilo = '';
                                        $atual = strtotime(date("Y-m-d"));
                                        $data    = strtotime($tarefa['tb_tarefas_data_termino']);

                                        $datediff = $data - $atual;
                                        $diferenca = floor($datediff/(60*60*24));
                                        if($diferenca<3)
                                        {
                                            $estilo = 'color:#E7505A';
                                        }

                                        echo '<li>';
                                        echo '<a href="editar/tarefa/'.$tarefa['id'].'">';
                                        echo '<span class="task">';
                                        echo '<span class="desc">'.$tarefa['tb_tarefas_nome'].'</span>';
                                        echo '<span class="percent" style="'.$estilo.'">'.DataBrasil($tarefa['tb_tarefas_data_termino']).'</span>';
                                        echo '</span>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END TAREFAS -->
                    <!-- BEGIN USUARIO -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="view/images/<?php echo $usuario['tb_usuarios_foto'];?>" />
                            <span class="username username-hide-on-mobile"> <?php echo PrimeiraPalavra($usuario['tb_usuarios_nome']);?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="editar/usuario/<?=$usuario['id']?>">
                                    <i class="icon-user"></i> Meu Perfil</a>
                            </li>
                            <li>
                                <a href="app_calendar.html">
                                    <i class="icon-calendar"></i> Meu Calendário </a>
                            </li>
                            
                            <li style="display: none;">
                                <a href="app_inbox.html">
                                    <i class="icon-envelope-open"></i> Mensagens
                                    <span class="badge badge-danger"> 2 </span>
                                </a>
                            </li>

                            <li>
                                <a href="listar/minhas-tarefas">
                                    <i class="icon-rocket"></i> Minhas Tarefas
                                    <span class="badge badge-success"> <?=$tarefas['qtd']?> </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="pages/logout.php">
                                    <i class="icon-key"></i> Sair </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="pages/logout.php" class="dropdown-toggle" alt="Sair" title="Sair">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <!-- END USUARIO -->
                </ul>
            </div>
            <!-- END MENU -->
        </div>
    </div>
    <!-- END HEADER -->