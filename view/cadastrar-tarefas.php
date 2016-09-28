<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie,true);


$idTarefa = isset($_GET['idTarefa']) ? $_GET['idTarefa'] : '';
$idProjeto = isset($_GET['idProjeto']) ? $_GET['idProjeto'] : '';

include("topo.php");

$conexao = new classeConexao();
$dadosTarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = '".$idTarefa."'");
$usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");

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
                                    <input type="hidden" name="criador" value="<?=$usuario['id']?>"/>
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
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-briefcase"></i>
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
                                        <div class="form-group" id="empresaU">
                                            <label class="control-label col-md-3">Projeto
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-folder"></i>
                                                            </span>
                                                <select class="form-control" name="projetoID" id="projetoID">
                                                    <?php
                                                    $conexao = new classeConexao();
                                                    $projetos = $conexao::fetch("SELECT id, tb_projetos_nome FROM tb_projetos");

                                                    foreach ($projetos as $key => $projeto){

                                                        if($idProjeto == $projeto['id'] || $dadosTarefa['tb_tarefas_projeto'] == $projeto['id']){
                                                            echo '<option value="'.$projeto['id'].'" selected>'.$projeto['tb_projetos_nome'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$projeto['id'].'">'.$projeto['tb_projetos_nome'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                </div>
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
                                                <select class="form-control" name="funcionarioID" id="funcionarioID">
                                                    <?php
                                                    echo '<option value="0" selected>Ninguém</option>';
                                                    $conexao = new classeConexao();
                                                    $usuarios = $conexao::fetch("SELECT id, tb_usuarios_nome FROM tb_usuarios");

                                                    foreach ($usuarios as $key => $usuario){

                                                        if($dadosTarefa['tb_tarefas_funcionario'] == $usuario['id']){
                                                            echo '<option value="'.$usuario['id'].'" selected>'.$usuario['tb_usuarios_nome'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$usuario['id'].'">'.$usuario['tb_usuarios_nome'].'</option>';
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
                                                    <input type="date" class="form-control" name="dataTarefa" placeholder="dd/mm/yyyy" value="<?=$dadosTarefa['tb_tarefas_data_termino']?>" required>
                                                </div>
                                            </div>
                                            <label class="control-label col-md-1">Tempo Est.
                                            </label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-clock-o"></i>
                                                            </span>
                                                    <input type="number" class="form-control" min="0" name="tempoEstimado" placeholder="Tempo Estimado" value="<?=$dadosTarefa['tb_tarefas_horas']?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Prioridade
                                            </label>
                                            <div class="col-md-7">
                                                <div class="mt-radio-inline">
                                                    <?php  if($dadosTarefa['tb_tarefas_prioridade'] == -2) { ?>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="prioridade" id="optionsRadios25" value="-2" checked="checked"> Muito Baixa
                                                        <span></span>
                                                    </label>
                                                    <?php } else { ?>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="prioridade" id="optionsRadios25" value="-2" checked=""> Muito Baixa
                                                            <span></span>
                                                        </label>
                                                    <?php } ?>
                                                    <?php  if($dadosTarefa['tb_tarefas_prioridade'] == -1) { ?>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="prioridade" id="optionsRadios26" value="-1" checked="checked"> Baixa
                                                        <span></span>
                                                    </label>
                                                    <?php } else { ?>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="prioridade" id="optionsRadios26" value="-1" checked=""> Baixa
                                                            <span></span>
                                                        </label>
                                                    <?php } ?>
                                                    <?php  if($dadosTarefa['tb_tarefas_prioridade'] == 0 || !$dadosTarefa['tb_tarefas_prioridade']) { ?>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="prioridade" id="optionsRadios27" value="0" checked="checked"> Normal
                                                        <span></span>
                                                    </label>
                                                    <?php } else { ?>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="prioridade" id="optionsRadios27" value="0"> Normal
                                                            <span></span>
                                                        </label>
                                                    <?php } ?>
                                                    <?php  if($dadosTarefa['tb_tarefas_prioridade'] == 1) { ?>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="prioridade" id="optionsRadios28" value="1" checked="checked"> Alta
                                                        <span></span>
                                                    </label>
                                                    <?php } else { ?>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="prioridade" id="optionsRadios28" value="1"> Alta
                                                            <span></span>
                                                        </label>
                                                    <?php } ?>
                                                    <?php  if($dadosTarefa['tb_tarefas_prioridade'] == 2) { ?>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="prioridade" id="optionsRadios29" value="2" checked="checked"> Muito Alta
                                                        <span></span>
                                                    </label>
                                                    <?php } else { ?>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="prioridade" id="optionsRadios29" value="2"> Muito Alta
                                                            <span></span>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Oculto ao Cliente?
                                            </label>
                                            <div class="col-md-7">
                                                <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <?php  if($dadosTarefa['tb_tarefas_oculto'] == 1) { ?>
                                                         <input type="checkbox" name="oculto" id="inlineCheckbox21" value="1" checked="checked"> Sim
                                                        <?php } else { ?>
                                                            <input type="checkbox" name="oculto" id="inlineCheckbox21" value="1"> Sim
                                                        <?php } ?>
                                                        <span></span>
                                                    </label>
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
                                                    <textarea name="descricaoTarefa" placeholder="Descrição sobre a Tarefa" data-required="1" class="form-control autosizeme textarea-pro" style="height: 200px !important;"><?=$dadosTarefa['tb_tarefas_descricao']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Cadastrar</button>
                                                    <a href="listar/tarefas" class="btn grey-salsa btn-outline">Cancelar</a>
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



