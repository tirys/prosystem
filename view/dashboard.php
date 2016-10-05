<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");


//Consultando as tarefas
$conexao = new classeConexao();

//Se é minhas tarefas

$usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");
$tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_funcionario = {$usuario['id']} AND tt.tb_tarefas_status != 1");

?>
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <div class="page-container">
     <?php include("menulateral.php"); ?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Início</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"></span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title"> Início
                    <small>estatísticas, gráficos, eventos recentes e tarefas</small>
                </h1>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN DASHBOARD STATS 1-->
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="1349">0</span>
                                </div>
                                <div class="desc"> New Feedbacks </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                                <div class="desc"> Total Profit </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="549">0</span>
                                </div>
                                <div class="desc"> New Orders </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                            <div class="visual">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="details">
                                <div class="number"> +
                                    <span data-counter="counterup" data-value="89"></span>% </div>
                                <div class="desc"> Brand Popularity </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->

                <?php
                $atividadesRecentes = $conexao::fetch("SELECT tl.*,tu.tb_usuarios_nome FROM tb_logs tl, tb_usuarios tu WHERE tu.id=tl.tb_logs_usuario_id ORDER BY tl.id DESC LIMIT 15");
                ?>
                <div class="row">
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Atividades Recentes</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                    <ul class="feeds">
                                        <?php foreach ($atividadesRecentes as $atividade) {
                                            $item = '';
                                            $img = 'fa-check';
                                            $label = 'label-info';
                                            $url = 'editar/tarefa/';

                                            if($atividade['tb_logs_descricao']=='atualizou a tarefa') {
                                                $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$atividade['tb_logs_id_referencia']);
                                                $item = $tarefa['tb_tarefas_nome'];
                                                $img = 'fa-edit';
                                                $label = 'label-warning';
                                                $url = 'editar/tarefa/';
                                            }

                                            echo '<li>';
                                            echo '<div class="col1" style="width:98%;">';
                                            echo '<div class="cont">';
                                            echo '<div class="cont-col1">';
                                            echo '<div class="label label-sm '.$label.'">';
                                            echo '<i class="fa '.$img.'"></i>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="cont-col2">';



                                            echo '<div class="desc">O usuário <a href="">'.$atividade['tb_usuarios_nome'].'</a> '.$atividade['tb_logs_descricao'].' <a href="'.$url.$atividade['tb_logs_id_referencia'].'">'.$item.'</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col2">';
                                            echo '<div class="date">'.DataBrasilSemHoras($atividade['tb_logs_data']).'</div>';
                                            echo '</div>';
                                            echo '</li>';
                                        } ?>
                                    </ul>
                                </div>
                                <div class="scroller-footer">
                                    <div class="btn-arrow-link pull-right">
                                        <a href="javascript:;">Ver todas</a>
                                        <i class="icon-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="portlet light tasks-widget bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Minhas Tarefas</span>
                                    <span class="caption-helper"></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="task-content">
                                    <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
                                        <!-- START TASK LIST -->
                                        <ul class="task-list">

                                            <?php
                                            foreach ($tarefas as $tarefa) {
                                                //fazer concluir a tarefa qnd clicar no check
                                                echo ' <li><div class="task-checkbox"><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                                                echo '<input type="checkbox" class="checkboxes" value="1" />';
                                                echo '<span></span></label></div><div class="task-title">';
                                                echo "<span class='task-title-sp'>{$tarefa['tb_tarefas_nome']}</span>";

                                                if ($tarefa['tb_tarefas_status']==0) {
                                                    echo '<span class="label label-sm label-warning">Aberto</span></div>';
                                                } else if ($tarefa['tb_tarefas_status']==1) {
                                                    echo '<span class="label label-sm label-success">Completa</span></div>';
                                                } else if ($tarefa['tb_tarefas_status']==2) {
                                                    echo '<span class="label label-sm label-default">Fechada</span></div>';
                                                }

                                                echo '
                                                        <div class="task-config">
                                                            <div class="task-config-btn btn-group">
                                                                <a class="btn btn-sm default" href="editar/tarefa/'.$tarefa['id'].'" >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                </div>
                                                        </div></li>';
                                            }
                                            ?>
                                        </ul>
                                        <!-- END START TASK LIST -->
                                    </div>
                                </div>
                                <div class="task-footer">
                                    <div class="btn-arrow-link pull-right">
                                        <a href="listar/minhas-tarefas">Ver todas as minhas tarefas </a>
                                        <i class="icon-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row ui-sortable" id="sortable_portlets">
                    <div class="col-lg-6 col-xs-12 col-sm-12 column sortable">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="icon-bubbles font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Comentários</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_comments_1">
                                        <!-- BEGIN: Comments -->
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-img">
                                                    <img src="view/assets/pages/media/users/avatar1.jpg" /> </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author">Michael Baker</span>
                                                        <span class="mt-comment-date">26 Feb, 10:30AM</span>
                                                    </div>
                                                    <div class="mt-comment-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>
                                                    <div class="mt-comment-details">
                                                        <span class="mt-comment-status mt-comment-status-pending">Nome Tarefa</span>
                                                        <ul class="mt-comment-actions">
                                                            <li>
                                                                <a href="#">Editar</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Ver</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Deletar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-comment">
                                                <div class="mt-comment-img">
                                                    <img src="view/assets/pages/media/users/avatar6.jpg" /> </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author">Larisa Maskalyova</span>
                                                        <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                                    </div>
                                                    <div class="mt-comment-text"> It is a long established fact that a reader will be distracted. </div>
                                                    <div class="mt-comment-details">
                                                        <span class="mt-comment-status mt-comment-status-rejected">Nome Tarefa</span>
                                                        <ul class="mt-comment-actions">
                                                            <li>
                                                                <a href="#">Editar</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Ver</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Deletar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-comment">
                                                <div class="mt-comment-img">
                                                    <img src="view/assets/pages/media/users/avatar8.jpg" /> </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author">Natasha Kim</span>
                                                        <span class="mt-comment-date">19 Dec,09:50 AM</span>
                                                    </div>
                                                    <div class="mt-comment-text"> The generated Lorem or non-characteristic Ipsum is therefore or non-characteristic. </div>
                                                    <div class="mt-comment-details">
                                                        <span class="mt-comment-status mt-comment-status-pending">Nome Tarefa</span>
                                                        <ul class="mt-comment-actions">
                                                            <li>
                                                                <a href="#">Editar</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Ver</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Deletar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-comment">
                                                <div class="mt-comment-img">
                                                    <img src="view/assets/pages/media/users/avatar4.jpg" /> </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author">Sebastian Davidson</span>
                                                        <span class="mt-comment-date">10 Dec, 09:20 AM</span>
                                                    </div>
                                                    <div class="mt-comment-text"> The standard chunk of Lorem or non-characteristic Ipsum used since the 1500s or non-characteristic. </div>
                                                    <div class="mt-comment-details">
                                                        <span class="mt-comment-status mt-comment-status-rejected">Nome Tarefa</span>
                                                        <ul class="mt-comment-actions">
                                                            <li>
                                                                <a href="#">Editar</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Ver</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Deletar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Comments -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12 col-sm-12 column sortable">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class=" icon-social-twitter font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Aprovações</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_actions_pending" data-toggle="tab"> Aprovados </a>
                                    </li>
                                    <li>
                                        <a href="#tab_actions_completed" data-toggle="tab"> Rejeitados </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_actions_pending">
                                        <!-- BEGIN: Actions -->
                                        <div class="mt-actions">
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar10.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-magnet"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Natasha Kim</span>
                                                                <p class="mt-action-desc">Dummy text of the printing</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar3.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class=" icon-bubbles"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Gavin Bond</span>
                                                                <p class="mt-action-desc">pending for approval</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-red"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar2.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-call-in"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Diana Berri</span>
                                                                <p class="mt-action-desc">Lorem Ipsum is simply dummy text</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar7.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class=" icon-bell"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">John Clark</span>
                                                                <p class="mt-action-desc">Text of the printing and typesetting industry</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-red"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar8.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-magnet"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Donna Clarkson </span>
                                                                <p class="mt-action-desc">Simply dummy text of the printing</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar9.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-magnet"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Tom Larson</span>
                                                                <p class="mt-action-desc">Lorem Ipsum is simply dummy text</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Actions -->
                                    </div>
                                    <div class="tab-pane" id="tab_actions_completed">
                                        <!-- BEGIN:Completed-->
                                        <div class="mt-actions">
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar1.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-action-redo"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Frank Cameron</span>
                                                                <p class="mt-action-desc">Lorem Ipsum is simply dummy</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-red"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar8.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-cup"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Ella Davidson </span>
                                                                <p class="mt-action-desc">Text of the printing and typesetting industry</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar5.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class=" icon-graduation"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Jason Dickens </span>
                                                                <p class="mt-action-desc">Dummy text of the printing and typesetting industry</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-red"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-action">
                                                <div class="mt-action-img">
                                                    <img src="view/assets/pages/media/users/avatar2.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
                                                            <div class="mt-action-icon ">
                                                                <i class="icon-badge"></i>
                                                            </div>
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">Jan Kim</span>
                                                                <p class="mt-action-desc">Lorem Ipsum is simply dummy</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <span class="mt-action-date">3 jun</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">9:30-13:00</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm">Aprovar</button>
                                                                <button type="button" class="btn btn-outline red btn-sm">Rejeitar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END: Completed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light calendar bordered">
                            <div class="portlet-title ">
                                <div class="caption">
                                    <i class="icon-calendar font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Feeds</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="calendar"> </div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN CORE PLUGINS -->
<!--    <script src="view/assets/global/plugins/jquery.min.js" type="text/javascript"></script>-->
    <script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
<?=include("rodape.php")?>