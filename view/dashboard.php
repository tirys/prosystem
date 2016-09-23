<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");
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
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Atividades Recentes</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group">
                                        <a class="btn btn-sm blue btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filtrar por
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" /> Completo
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" checked="" /> Novo
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" /> Realocado
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" checked="" /> Atribuído
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                    <ul class="feeds">
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> You have 4 pending tasks.
                                                            <span class="label label-sm label-warning "> Take action
                                                                        <i class="fa fa-share"></i>
                                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> Just now </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bar-chart-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Finance Report for year 2013 has been released. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 20 mins </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 24 mins </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> New order received with
                                                            <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 30 mins </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 24 mins </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> Web server hardware needs to be upgraded.
                                                            <span class="label label-sm label-default "> Overdue </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 2 hours </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-briefcase"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> IPO Report for year 2013 has been released. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 20 mins </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> You have 4 pending tasks.
                                                            <span class="label label-sm label-warning "> Take action
                                                                        <i class="fa fa-share"></i>
                                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> Just now </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-bar-chart-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Finance Report for year 2013 has been released. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 20 mins </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 24 mins </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> New order received with
                                                            <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 30 mins </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 24 mins </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> Web server hardware needs to be upgraded.
                                                            <span class="label label-sm label-default "> Overdue </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 2 hours </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-briefcase"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> IPO Report for year 2013 has been released. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 20 mins </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="scroller-footer">
                                    <div class="btn-arrow-link pull-right">
                                        <a href="javascript:;">See All Records</a>
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
                                    <span class="caption-subject font-dark bold uppercase">Tarefas</span>
                                    <span class="caption-helper"></span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group">
                                        <a class="btn blue-oleo btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filtrar
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;"> Todas </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"> Minhas </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> A Fazer </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> Completas </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"> Minhas Pendentes
                                                    <span class="badge badge-danger"> 4 </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="task-content">
                                    <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
                                        <!-- START TASK LIST -->
                                        <ul class="task-list">
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Present 2013 Year IPO Statistics at Board Meeting </span>
                                                    <span class="label label-sm label-success">Completa</span>
                                                    <span class="task-bell">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Completar </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Editar </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancelar </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Hold An Interview for Marketing Manager Position </span>
                                                    <span class="label label-sm label-danger">A Fazer</span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Completar </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Editar </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancelar </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> AirAsia Intranet System Project Internal Meeting </span>
                                                    <span class="label label-sm label-success">Completa</span>
                                                    <span class="task-bell">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Completar </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Editar </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancelar </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Technical Management Meeting </span>
                                                    <span class="label label-sm label-warning">A Fazer</span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Kick-off Company CRM Mobile App Development </span>
                                                    <span class="label label-sm label-info">Internal Products</span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Prepare Commercial Offer For SmartVision Website Rewamp </span>
                                                    <span class="label label-sm label-danger">SmartVision</span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Sign-Off The Comercial Agreement With AutoSmart </span>
                                                    <span class="label label-sm label-default">AutoSmart</span>
                                                    <span class="task-bell">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group dropup">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> Company Staff Meeting </span>
                                                    <span class="label label-sm label-success">Cruise</span>
                                                    <span class="task-bell">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group dropup">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="last-line">
                                                <div class="task-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp"> KeenThemes Investment Discussion </span>
                                                    <span class="label label-sm label-warning">KeenThemes </span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group dropup">
                                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- END START TASK LIST -->
                                    </div>
                                </div>
                                <div class="task-footer">
                                    <div class="btn-arrow-link pull-right">
                                        <a href="javascript:;">See All Records</a>
                                        <i class="icon-arrow-right"></i>
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
<?=include("rodape.php")?>