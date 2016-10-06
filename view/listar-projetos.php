<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");

//Consultando os projetos
$conexao = new classeConexao();
if($usuario_tipo == 2){
    $cliente = $conexao::fetchuniq("SELECT te.id FROM tb_empresas te, tb_clientes tc WHERE te.id = tc.tb_clientes_empresas_id and tc.tb_clientes_usuario_id = ".$usuario['id']);
    $projetos = $conexao::fetch("SELECT tp.*, te.tb_empresas_nome FROM tb_projetos tp, tb_empresas te WHERE tp.id_projetos_empresas_id = te.id and te.id = ".$cliente['id']);

}else{
    $projetos = $conexao::fetch("SELECT tp.*, te.tb_empresas_nome FROM tb_projetos tp, tb_empresas te WHERE tp.id_projetos_empresas_id = te.id");
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
                        <span>Projetos > Ver projetos</span>
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
                                <i class="icon-folder font-dark"></i>
                                <span class="caption-subject bold uppercase">Projetos</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" href="cadastrar/projetos" class="btn sbold green"> Novo Projeto
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
                                    <th> Data Término </th>
                                    <th> Status </th>
                                    <th> Ações </th>
                                </tr>
                                </thead>
                                <tbody>

                                <!-- START CONTEUDO TABELA -->
                                <?php foreach ($projetos as $projeto) { ?>
                                    <tr class="odd gradeX">
                                        <td> <?=$projeto['id']?> </td>

                                        <td><a href="projeto/<?=$projeto['id']?>"><?=$projeto['tb_projetos_nome']?></a></td>

                                        <td><a href="empresa/<?=$projeto['id_projetos_empresas_id']?>"><?=$projeto['tb_empresas_nome']?></a></td>

                                        <td><?=DataBrasil($projeto['tb_projetos_data_termino'])?></td>

                                        <?php if ($projeto['tb_projetos_status']==0) {?>
                                            <td><span class="label label-sm label-danger"> Desativado </span></td>
                                        <?php } else {?>
                                            <td><span class="label label-sm label-success"> Ativo </span></td>
                                        <?php } ?>

                                        <td>
                                            <a href="editar/projeto/<?=$projeto['id']?>" class="btn btn-xs btn-warning" title="Editar"> <i class="fa fa-edit"></i>
                                            </a>


                                            <?php if ($projeto['tb_projetos_status']==0) {?>
                                                <a id="<?=$projeto['id']?>" data-role="<?=$projeto['id']?>" class="btn btn-xs btn-success reativar" title="Reativar"> <i class="fa fa-arrow-up"></i>
                                                </a>
                                            <?php } else {?>
                                                <a id="<?=$projeto['id']?>" data-role="<?=$projeto['id']?>" class="btn btn-xs btn-danger desativar" title="Desativar"> <i class="fa fa-times"></i>
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
            url: 'model/ws/ativacaoProjeto.php',
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
            url: 'model/ws/ativacaoProjeto.php',
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
