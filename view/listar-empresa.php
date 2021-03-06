<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");

//Consultando as empresas
$conexao = new classeConexao();
$empresas = $conexao::fetch("SELECT * FROM tb_empresas");
?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Empresas > Ver empresas</span>
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
                                    <i class="icon-briefcase font-dark"></i>
                                    <span class="caption-subject bold uppercase">Empresas</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a id="sample_editable_1_new" href="cadastrar/empresa" class="btn sbold green"> Nova Empresa
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
<!--                                        <th>-->
<!--                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">-->
<!--                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />-->
<!--                                                <span></span>-->
<!--                                            </label>-->
<!--                                        </th>-->
                                        <th> ID </th>
                                        <th> Nome </th>
                                        <th> Site </th>
                                        <th> Email </th>
<!--                                        <th> Endereço </th>-->
                                        <th> Status </th>
                                        <th> Ações </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!-- START CONTEUDO TABELA -->
                                    <?php foreach ($empresas as $empresa) { ?>
                                        <tr class="odd gradeX">
<!--                                            <td>-->
<!--                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">-->
<!--                                                    <input type="checkbox" id="sel--><?//=$empresa['id']?><!--" name="sel--><?//=$empresa['id']?><!--" class="checkboxes" value="1" />-->
<!--                                                    <span></span>-->
<!--                                                </label>-->
<!--                                            </td>-->
                                            <td> <?=$empresa['id']?> </td>

                                            <td><a href="empresa/<?=$empresa['id']?>"><?=$empresa['tb_empresas_nome']?></a></td>


                                            <td><a href="http://<?=$empresa['tb_empresas_site']?>"><?=$empresa['tb_empresas_site']?></a></td>

                                            <td class="center">
                                                <a href="mailto:<?=$empresa['tb_empresas_email']?>"> <?=$empresa['tb_empresas_email']?> </a>
                                            </td>

                                            <?php if ($empresa['tb_empresas_status']==0) {?>
                                                <td><span class="label label-sm label-danger"> Desativada </span></td>
                                            <?php } else {?>
                                                <td><span class="label label-sm label-success"> Ativa </span></td>
                                            <?php } ?>

                                            <td>
                                                <a href="editar/empresa/<?=$empresa['id']?>" class="btn btn-xs btn-warning" title="Editar"> <i class="fa fa-edit"></i>
                                                </a>


                                                <?php if ($empresa['tb_empresas_status']==0) {?>
                                                    <a id="<?=$empresa['id']?>" data-role="<?=$empresa['id']?>" class="btn btn-xs btn-success reativar" alt="Reativar" title="Reativar"> <i class="fa fa-arrow-up"></i>
                                                    </a>
                                                <?php } else {?>
                                                    <a id="<?=$empresa['id']?>" data-role="<?=$empresa['id']?>" class="btn btn-xs btn-danger desativar" title="Desativar"> <i class="fa fa-times"></i>
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
             url: 'model/ws/ativacaoEmpresa.php',
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
             url: 'model/ws/ativacaoEmpresa.php',
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
