<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$id = isset($_GET['idProjeto']) ? $_GET['idProjeto'] : '';


include("topo.php");


//Consultando o projeto
$conexao = new classeConexao();
$projeto = $conexao::fetchuniq("SELECT * FROM tb_projetos WHERE id = '{$id}'");

$empresa = $conexao::fetchuniq("SELECT * FROM tb_empresas WHERE id = '{$projeto['id_projetos_empresas_id']}'")

//Realizar os cálculos de status

//Obter os participantes do projeto através das tarefas
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="view/assets/pages/css/about.min.css" rel="stylesheet" type="text/css" />
<link href="view/assets/pages/css/contact.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
    <div class="clearfix"> </div>
    <div class="page-container page-container-bg-solid">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <span>Projetos > <a href="listar/projetos">Ver Projetos</a> > <?=$projeto['tb_projetos_nome']?> </span>
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

                <!-- START CABEÇALHO -->
                <div class="row margin-bottom-40 about-header" style="height: 310px;">
                    <div class="col-md-12">
                        <h1 style="margin-top:70px;"><?=$projeto['tb_projetos_nome']?></h1>
                        <h2>Life is either a great adventure or nothing</h2>
                        <button type="button" class="btn btn-success">NOVA TAREFA <i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <!-- END CABEÇALHO -->

                <!-- START CARDS -->
                <div class="row margin-bottom-20">
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="card-icon">
                                <i class="icon-user-follow font-red-sunglo theme-font"></i>
                            </div>
                            <div class="card-title">
                                <span> Status </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="card-icon">
                                <i class="icon-trophy font-green-haze theme-font"></i>
                            </div>
                            <div class="card-title">
                                <span> Status </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="card-icon">
                                <i class="icon-basket font-purple-wisteria theme-font"></i>
                            </div>
                            <div class="card-title">
                                <span> Status </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="card-icon">
                                <i class="icon-layers font-blue theme-font"></i>
                            </div>
                            <div class="card-title">
                                <span> Status </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARDS -->

                <!-- START TAREFAS - CLIENTE -->
                <div class="row">
                    <div class="">

                        <!-- START TAREFAS -->
                        <div class="col-md-9">
                            <div class="portlet light">
<!--                            <div class="row margin-bottom-40 stories-header" data-auto-height="true">-->
<!--                                    <h1>Tarefas</h1>-->
<!--                            </div>-->

                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Nome </th>
                                        <th> Atribuído </th>
                                        <th> Data Término </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!-- START CONTEUDO TABELA -->
                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                        </tr>

                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                        </tr>

                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                        </tr>

                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                        </tr>

                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                            <td>Teste</td>
                                        </tr>
                                    <!-- END CONTEUDO TABELA -->

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- END TAREFAS -->

                        <!-- START EMPRESA -->

                        <div class="col-md-3">
                            <div class="portlet light" style="min-height:356px;">
                                <div class="c-body">
                                    <div class="c-section">
                                        <h3><?= $empresa['tb_empresas_nome'] ?></h3>
                                        <br/>
                                    </div>
                                    <div class="c-section">
                                        <h5><i class="fa fa-map-pin fa-lg font-green" style="min-width:25px;"></i>
                                        <?=$empresa['tb_empresas_endereco'] ?></h5>
                                        <br/>

                                    </div>
                                    <div class="c-section">
                                        <h5><i class="fa fa-envelope fa-lg font-green" style="min-width:25px;"></i>
                                        <?= $empresa['tb_empresas_email'] ?></h5>
                                        <br/>
                                    </div>
                                    <div class="c-section">
                                        <h5><i class="fa fa-globe fa-lg font-green" style="min-width:25px;"></i>

                                        <a href="www.<?= $empresa['tb_empresas_site'] ?>">
                                            www.<?= $empresa['tb_empresas_site'] ?>
                                        </a>
                                        </h5>
                                        <br/>
                                    </div>
                                    <div class="c-section">
                                        <h5><i class="fa fa-pencil fa-lg font-green" style="min-width:25px;"></i>
                                        <?= $empresa['tb_empresas_anotacao'] ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END EMPRESA -->

                    </div>
                </div>
                <!-- END TAREFAS - CLIENTE -->

                <!-- START PARTICIPANTES -->
                <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                    <div class="col-md-12">
                        <h1>Participando deste Projeto</h1>
                        <h2>Equipe que está participando ativamente deste projeto</h2>
                    </div>
                </div>
                <div class="row margin-bottom-20 stories-cont">
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="photo">
                                <img src="view/assets/pages/media/users/teambg1.jpg" alt="" class="img-responsive" /> </div>
                            <div class="title">
                                <span> Mark Wahlberg </span>
                            </div>
                            <div class="desc">
                                <span> We are at our very best, and we are happiest, when we are fully engaged in work we enjoy on the journey toward the goal we've established for ourselves. </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="photo">
                                <img src="view/assets/pages/media/users/teambg2.jpg" alt="" class="img-responsive" /> </div>
                            <div class="title">
                                <span> Lindsay Lohan </span>
                            </div>
                            <div class="desc">
                                <span> Do what you love to do and give it your very best. Whether it's business or baseball, or the theater, or any field. If you don't love what you're doing and you can't give it your best, get out of it. </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="photo">
                                <img src="view/assets/pages/media/users/teambg5.jpg" alt="" class="img-responsive" /> </div>
                            <div class="title">
                                <span> John Travolta </span>
                            </div>
                            <div class="desc">
                                <span> To be nobody but yourself in a world which is doing its best, to make you everybody else means to fight the hardest battle which any human being can fight; and never stop fighting. </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="photo">
                                <img src="view/assets/pages/media/users/teambg8.jpg" alt="" class="img-responsive" /> </div>
                            <div class="title">
                                <span> Tom Brady </span>
                            </div>
                            <div class="desc">
                                <span> You have to accept whatever comes and the only important thing is that you meet it with courage and with the best that you have to give. Never give up, never surrender. Go all out or gain nothing. </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END PARTICIPANTES-->

            </div>
        </div>
    </div>
<?=include("rodape.php")?>


<!-- DEPENDENCIAS LOCAIS -->
<script src="view/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="view/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
