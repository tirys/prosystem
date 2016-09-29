<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$id = isset($_GET['idProjeto']) ? $_GET['idProjeto'] : '';


include("topo.php");


//Consultando o projeto
$conexao = new classeConexao();
$projeto = $conexao::fetchuniq("SELECT * FROM tb_projetos WHERE id = '{$id}'");

$empresa = $conexao::fetchuniq("SELECT * FROM tb_empresas WHERE id = '{$projeto['id_projetos_empresas_id']}'");

$tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_projeto = {$id}");

//Realizar os cálculos de status

//Obter os participantes do projeto através das tarefas
$usuarios = $conexao::fetch("SELECT tu.* FROM tb_usuarios tu, tb_tarefas tt WHERE tt.tb_tarefas_projeto = {$id} AND tt.tb_tarefas_funcionario = tu.id");

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
                        <a href="cadastrar/tarefa-projeto/<?=$projeto['id']?>" class="btn btn-success">NOVA TAREFA <i class="fa fa-plus"></i></a>
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
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="fa fa-tasks font-dark"></i>
                                        <span class="caption-subject bold uppercase">Tarefas</span>
                                    </div>
                                </div>
                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Nome </th>
                                            <th> Cliente </th>
                                            <th> Data Término </th>
                                            <th> Horas Est. </th>
                                            <th> Prioridade </th>
                                            <th> Status </th>
                                            <th> Ações </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <!-- START CONTEUDO TABELA -->
                                        <?php foreach ($tarefas as $tarefa) { ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$tarefa['id']?> </td>

                                                <td><a href="tarefa/<?=$tarefa['id']?>"><?=$tarefa['tb_tarefas_nome']?></a></td>

                                                <td><a href="empresa/<?=$tarefa['id_projetos_empresas_id']?>"><?=$tarefa['tb_empresas_nome']?></a></td>

                                                <td><?=DataBrasil($tarefa['tb_tarefas_data_termino'])?></td>

                                                <td><?=$tarefa['tb_tarefas_horas']?> horas</td>

                                                <!--                                        -2 => Muito Baixa -> verde-->
                                                <!--                                        -1 => Baixa -> azul-->
                                                <!--                                        0 => Normal -> cinza-->
                                                <!--                                        1 => Alta -> amarelo-->
                                                <!--                                        2 => Urgente -> vermelho-->

                                                <?php if ($tarefa['tb_tarefas_prioridade']==0) {?>
                                                    <td><span class="label label-sm label-default"> Normal </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==1) {?>
                                                    <td><span class="label label-sm label-warning"> Alta </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==2) {?>
                                                    <td><span class="label label-sm label-danger"> Urgente </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==-1) {?>
                                                    <td><span class="label label-sm label-info"> Baixa </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==-2) {?>
                                                    <td><span class="label label-sm label-success"> Muito Baixa </span></td>
                                                <?php } ?>

                                                <!--                                        STATUS-->
                                                <?php if ($tarefa['tb_tarefas_status']==0) {?>
                                                    <td><span class="label label-sm label-warning"> Aberto </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_status']==1) {?>
                                                    <td><span class="label label-sm label-success"> Concluída </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_status']==2) {?>
                                                    <td><span class="label label-sm label-default"> Fechada </span></td>
                                                <?php } ?>

                                                <td>
                                                    <a href="editar/tarefa/<?=$tarefa['id']?>" class="btn btn-xs btn-warning" title="Editar"> <i class="fa fa-edit"></i>
                                                    </a>


                                                    <?php if ($tarefa['tb_tarefas_status']==2 || $tarefa['tb_tarefas_status']==0) {?>
                                                        <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-success reativar" title="Concluir"> <i class="fa fa-check"></i>
                                                        </a>
                                                    <?php } else {?>
                                                        <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-danger desativar" title="Abrir"> <i class="fa fa-times"></i>
                                                        </a>
                                                    <?php } ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <!-- END CONTEUDO TABELA -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->

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

                    <?php
                        foreach ($usuarios as $usuario) {


                            echo '<div class="col-lg-3 col-md-6"><div class="portlet light"><div class="photo">';
                            echo "<img src='view/images/{$usuario['tb_usuarios_foto']}' alt='' class='img-responsive'/></div>";
                            echo '<div class="title">';
                            echo "<span>{$usuario['tb_usuarios_nome']}</span>";
                            echo '<div class="desc">';

                            if($usuario['tb_usuarios_tipo'] == 1) {
                                //Obter dados se for funcionario
                                $funcionarios = $conexao::fetch("SELECT * FROM tb_funcionarios WHERE tb_funcionarios_usuario_id = {$usuario['id']}");
                                echo "<span>{$usuario['tb_funcionarios_funcao']}</span>";
                            }
                            else if ($usuario['tb_usuarios_tipo'] == 2) {
                                echo "<span>Cliente</span>";
                            }
                            else {
                                echo "<span>Administrador do Sistema</span>";
                            }

                            echo "<span>{$usuario['tb_usuario_funcao']}</span>";


                            echo '</div>';
                            echo '</div></div></div>';
                        }
                    ?>
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
