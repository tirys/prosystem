<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");

//Consultando os usuarios
$conexao = new classeConexao();
$usuarios = $conexao::fetch("SELECT * FROM tb_usuarios");
?>
<div class="clearfix"> </div>
<div class="page-container">
    <?php include("menulateral.php"); ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <span>Usuários > Ver usuários</span>
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
                                <i class="icon-users font-dark"></i>
                                <span class="caption-subject bold uppercase">Usuários</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" href="cadastrar/usuario" class="btn sbold green"> Novo Usuário
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
                                    <th> Email </th>
                                    <th> Login </th>
                                    <th> Tipo </th>
                                    <th> Ações </th>
                                </tr>
                                </thead>
                                <tbody>

                                <!-- START CONTEUDO TABELA -->
                                <?php foreach ($usuarios as $usuario) { ?>
                                    <tr class="odd gradeX">
                                        <td> <?=$usuario['id']?> </td>

                                        <td><?=htmlspecialchars_decode($usuario['tb_usuarios_nome'])?></td>

                                        <td class="center">
                                            <a href="mailto:<?=$usuario['tb_usuarios_email']?>"> <?=$usuario['tb_usuarios_email']?> </a>
                                        </td>

                                        <td class="center">
                                           <?=$usuario['tb_usuario_login']?>
                                        </td>

                                        <?php if ($usuario['tb_usuarios_tipo']==0) {?>
                                            <td><span class="label label-sm label-success"> Administrador </span></td>
                                        <?php } else if ($usuario['tb_usuarios_tipo']==1) {?>
                                            <td><span class="label label-sm label-warning"> Funcionário </span></td>
                                        <?php } else { ?>
                                            <td><span class="label label-sm label-info"> Cliente </span></td>
                                        <?php } ?>

                                        <td>
                                            <a href="editar/usuario/<?=$usuario['id']?>" class="btn btn-xs btn-warning" title="Editar"> <i class="fa fa-edit"></i>
                                            </a>


                                            <?php if ($usuario['tb_usuarios_status']==0) {?>
                                                <a id="reativar" data-role="<?=$usuario['id']?>" class="btn btn-xs btn-success" alt="Reativar" title="Reativar"> <i class="fa fa-arrow-up"></i>
                                                </a>
                                            <?php } else {?>
                                                <a id="desativar" data-role="<?=$usuario['id']?>" class="btn btn-xs btn-danger" title="Desativar"> <i class="fa fa-times"></i>
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


    $('#desativar').on('click',function(){
        var idempresa = $(this).attr('data-role'); //pegando o id da empresa

        $.ajax({
            url: 'model/ws/ativacaoUsuario.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'desativar',
                id: idempresa
            },
            error: function() {
                $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
            },
            dataType: 'json',
            success: function(result) {
                if(result.status) {
                    location.reload();
                }
            }
        });
    });

    $('#reativar').on('click',function(){
        var idempresa = $(this).attr('data-role'); //pegando o id da empresa

        $.ajax({
            url: 'model/ws/ativacaoUsuario.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'reativar',
                id: idempresa
            },
            error: function() {
                $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
            },
            dataType: 'json',
            success: function(result) {
                if(result.status) {
                    location.reload();
                }
            }
        });
    });
</script>
