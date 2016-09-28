<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';

include("topo.php");

//Consultando as tarefas
$conexao = new classeConexao();

//Se é minhas tarefas
if($usuario=='true') {
    $usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");
    $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_funcionario = {$usuario['id']} AND tt.tb_tarefas_status != 1");
}
else {
    $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto");
}
?>
<div class="clearfix"> </div>
<div class="page-container">
    <?php include("menulateral.php"); ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <span>Tarefas > Ver tarefas</span>
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
            <br/>

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa fa-tasks font-dark"></i>
                                <span class="caption-subject bold uppercase">Tarefas</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" href="cadastrar/tarefas" class="btn sbold green"> Nova Tarefa
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Ações
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-print"></i> Print </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            </div>


        </div>
    </div>
</div>



<?=include("rodape.php")?>

<!-- DEPENDENCIAS LOCAIS -->
<script src="view/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="view/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>


<script>

    $('.desativar').on('click', function () {
        var idempresa = $(this).attr('data-role'); //pegando o id da empresa

        $.ajax({
            url: 'model/ws/ativacaoTarefa.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'desativar',
                id: idempresa
            },
            error: function () {
                $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
            },
            dataType: 'json',
            success: function (result) {
                if (result.status) {
                    location.reload();
                }
            }
        });
    });

    $('.reativar').on('click', function () {
        var idempresa = $(this).attr('data-role'); //pegando o id da empresa

        $.ajax({
            url: 'model/ws/ativacaoTarefa.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'reativar',
                id: idempresa
            },
            error: function () {
                $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
            },
            dataType: 'json',
            success: function (result) {
                if (result.status) {
                    location.reload();
                }
            }
        });
    });

</script>
