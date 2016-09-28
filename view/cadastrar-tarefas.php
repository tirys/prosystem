<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

$idTarefa = isset($_GET['idTarefa']) ? $_GET['idTarefa'] : '';

include("topo.php");

$conexao = new classeConexao();
$dadosTarefa = $conexao::fetchuniq("SELECT * FROM tb_projetos WHERE id = '".$idTarefa."'");
?>
<div class="clearfix"></div>
<div class="page-container">
    <?php include("menulateral.php"); ?>
    <link href="view/assets/prospecta.css" rel="stylesheet" type="text/css" />
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <span>Tarefas > Cadastrar</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
                        <i class="icon-calendar"></i>
                        <span class="thin uppercase hidden-xs"></span>
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div>
            </div>
            <h1 class="page-title">
            </h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-tasks font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Nova Tarefa</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <?php if (isset($dadosTarefa['id'])) {?>
                            <form action="model/cadastraTarefa.php?acao=2" method="post" id="form_sample_1" class="form-horizontal">
                                <input type="hidden" name="idTarefa" value="<?=$dadosTarefa['id']?>"/>
                                <?php } else { ?>
                                <form action="model/cadastraTarefa.php?acao=1" method="post" id="form_sample_1" class="form-horizontal">
                                    <?php } ?>

                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Por favor, preencha os dados corretamente.
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nome
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-tasks"></i>
                                                            </span>
                                                    <input type="text" name="nomedaTarefa" placeholder="Nome da Tarefa" data-required="1" class="form-control" value="<?=$dadosTarefa['tb_tarefas_nome']?>" required/></div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="empresaU">
                                            <label class="control-label col-md-3">Cliente
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" name="empresaId" id="empresaId">
                                                    <?php
                                                    $conexao = new classeConexao();
                                                    $empresas = $conexao::fetch("SELECT id, tb_empresas_nome FROM tb_empresas");

                                                    foreach ($empresas as $key => $empresa){

                                                        if($dadosTarefa['id_projetos_empresas_id'] == $empresa['id']){
                                                            echo '<option value="'.$empresa['id'].'" selected>'.$empresa['tb_empresas_nome'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$empresa['id'].'">'.$empresa['tb_empresas_nome'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="empresaU">
                                            <label class="control-label col-md-3">Projeto
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" name="projetoID" id="projetoID">
                                                    <?php
                                                    $conexao = new classeConexao();
                                                    $empresas = $conexao::fetch("SELECT id, tb_empresas_nome FROM tb_empresas");

                                                    foreach ($empresas as $key => $empresa){

                                                        if($dadosTarefa['id_projetos_empresas_id'] == $empresa['id']){
                                                            echo '<option value="'.$empresa['id'].'" selected>'.$empresa['tb_empresas_nome'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$empresa['id'].'">'.$empresa['tb_empresas_nome'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Atribuir a
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                <select class="form-control" name="empresaId" id="empresaId">
                                                    <?php
                                                    $conexao = new classeConexao();
                                                    $empresas = $conexao::fetch("SELECT id, tb_empresas_nome FROM tb_empresas");

                                                    foreach ($empresas as $key => $empresa){

                                                        if($dadosTarefa['id_projetos_empresas_id'] == $empresa['id']){
                                                            echo '<option value="'.$empresa['id'].'" selected>'.$empresa['tb_empresas_nome'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$empresa['id'].'">'.$empresa['tb_empresas_nome'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Data de Término
                                            </label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                    <input type="date" class="form-control" name="dataTarefa" placeholder="dd/mm/yyyy" value="<?=$dadosTarefa['tb_projetos_data_termino']?>" required>
                                                </div>
                                            </div>
                                            <label class="control-label col-md-1">Tempo Est.
                                            </label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-clock-o"></i>
                                                            </span>
                                                    <input type="number" class="form-control" min="0" name="dataTarefa" placeholder="Tempo Estimado" value="<?=$dadosTarefa['tb_projetos_data_termino']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Descrição
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-pencil"></i>
                                                            </span>
                                                    <textarea name="descricaoTarefa" placeholder="Descrição sobre a Tarefa" data-required="1" class="form-control autosizeme textarea-pro" style="height: 200px !important;"><?=$dadosTarefa['tb_projetos_descricao']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Cadastrar</button>
                                                    <button type="button" class="btn grey-salsa btn-outline">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                                <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>

        </div>

    </div>
</div>
<!-- BEGIN CORE PLUGINS -->
<script src="view/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="view/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"
        type="text/javascript"></script>

<script src="view/assets/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="view/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="view/assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="view/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="view/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="view/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="view/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="view/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->


<script>
    var jq = jQuery.noConflict();

    //Jquery para ativar campos extras
    jq('#tipoUsuario').on('change', function () {
        if( jq(this).val() == 'clientes') {
            jq('#empresaU').attr('style','');
            jq('#cargahorariaU').attr('style','display:none;');
        }
        else if (jq(this).val() == 'funcionarios') {
            jq('#cargahorariaU').attr('style','');
            jq('#empresaU').attr('style','display:none;');
        }
        else {
            jq('#empresaU').attr('style','display:none;');
            jq('#cargahorariaU').attr('style','display:none;');
        }
    });
</script>
<?= include("rodape.php") ?>



