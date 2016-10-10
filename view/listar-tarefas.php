<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$minhasTarefas = isset($_GET['usuario']) ? $_GET['usuario'] : '';

include("topo.php");

//Consultando as tarefas
$conexao = new classeConexao();

//Se é minhas tarefas
if($minhasTarefas=='1') {
    $usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");
    $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome, tp.tb_projetos_nome, tp.id as projetos_id FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_funcionario = {$usuario['id']} AND tt.tb_tarefas_status != 1");
}
else {

    if($usuario_tipo == 2){
        $cliente = $conexao::fetchuniq("SELECT te.id FROM tb_empresas te, tb_clientes tc WHERE te.id = tc.tb_clientes_empresas_id and tc.tb_clientes_usuario_id = ".$usuario['id']);
        $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome, tp.tb_projetos_nome, tp.id as projetos_id FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto and te.id = ". $cliente['id']);
    }else{
        $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome, tp.tb_projetos_nome, tp.id as projetos_id FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto");
    }
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
                        <span>Tarefas > Minhas tarefas</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="pull-right tooltips btn btn-sm">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
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
                                                        <i class="fa fa-print"></i> Imprimir </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-pdf-o"></i> Salvar como PDF </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-excel-o"></i> Exportar para Excel </a>
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
                                    <th> Projeto </th>
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

                                        <?php if($tarefa['tb_tarefas_aprovacao']==1) { ?>
                                            <td><a href="tarefa/<?=$tarefa['id']?>"><?=$tarefa['tb_tarefas_nome']?></a> <i class="fa fa-clock-o widget-title-color-blue" title="Tarefa ENVIADA para aprovação"></i></td>
                                        <?php } else if ($tarefa['tb_tarefas_aprovacao']==2) { ?>
                                            <td><a href="tarefa/<?=$tarefa['id']?>"><?=$tarefa['tb_tarefas_nome']?></a> <i class="fa fa-check-circle-o widget-title-color-green" title="Tarefa APROVADA pelo cliente"></i></td>
                                        <?php } else if ($tarefa['tb_tarefas_aprovacao']==3) { ?>
                                            <td><a href="tarefa/<?=$tarefa['id']?>"><?=$tarefa['tb_tarefas_nome']?></a> <i class="fa fa-times-circle-o widget-title-color-red" title="Tarefa NÃO APROVADA pelo cliente"></i></td>
                                        <?php } else { ?>
                                            <td><a href="tarefa/<?=$tarefa['id']?>"><?=$tarefa['tb_tarefas_nome']?></a></td>
                                        <?php } ?>

                                        <td><a href="empresa/<?=$tarefa['id_projetos_empresas_id']?>"><?=$tarefa['tb_empresas_nome']?></a></td>

                                        <td><a href="projeto/<?=$tarefa['projetos_id']?>"><?=$tarefa['tb_projetos_nome']?></a></td>

                                        <td><?=DataBrasil($tarefa['tb_tarefas_data_termino'])?></td>

                                        <td><?=$tarefa['tb_tarefas_horas']?></td>

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
                                        <?php } else if ($tarefa['tb_tarefas_status']==3) {?>
                                            <td><span class="label label-sm label-default"> Pausada </span></td>
                                        <?php } ?>

                                        <td>
                                            <a href="editar/tarefa/<?=$tarefa['id']?>" class="btn btn-xs btn-warning" title="Editar"> <i class="fa fa-edit"></i>
                                            </a>


                                            <?php if ($tarefa['tb_tarefas_status']==2 || $tarefa['tb_tarefas_status']==0 || $tarefa['tb_tarefas_status']==3) {?>
                                                <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-success reativar" title="Concluir"> <i class="fa fa-check"></i>
                                                </a>
                                            <?php } else if ($tarefa['tb_tarefas_status']==1) {?>
                                                <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-danger desativar" title="Abrir"> <i class="fa fa-arrow-up" style="width:12px;"></i>
                                                </a>
                                            <?php } ?>

                                            <?php if ($tarefa['tb_tarefas_status']==1 || $tarefa['tb_tarefas_status']==2 || $tarefa['tb_tarefas_status']==0) {?>
                                                <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-info pausar" title="Pausar"> <i class="fa fa-pause"></i>
                                            <?php } else { ?>
                                                <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-danger desativar" title="Abrir"> <i class="fa fa-arrow-up" style="width:12px;"></i>
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

    $('.pausar').on('click', function () {
        var idempresa = $(this).attr('data-role'); //pegando o id da empresa

        $.ajax({
            url: 'model/ws/ativacaoTarefa.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'pausar',
                idUsuario: '<?=$usuario['id']?>',
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

    $('.desativar').on('click', function () {
        var idempresa = $(this).attr('data-role'); //pegando o id da empresa

        $.ajax({
            url: 'model/ws/ativacaoTarefa.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'desativar',
                idUsuario: '<?=$usuario['id']?>',
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
                idUsuario: '<?=$usuario['id']?>',
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
