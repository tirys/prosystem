<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie,true);


$idTarefa = isset($_GET['idTarefa']) ? $_GET['idTarefa'] : '';
$idProjeto = isset($_GET['idProjeto']) ? $_GET['idProjeto'] : '';

include("topo.php");

$conexao = new classeConexao();
$dadosTarefa = $conexao::fetchuniq("SELECT tt.*,tp.id_projetos_empresas_id FROM tb_tarefas tt, tb_projetos tp WHERE tt.tb_tarefas_projeto = tp.id  AND tt.id = '".$idTarefa."'");
$usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");

$usuario_id = $usuario['id'];

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
                    <div class="pull-right tooltips btn btn-sm">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
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
                                <?php if (isset($dadosTarefa['id'])) {?>
                                    <span class="caption-subject font-green sbold uppercase"><?=$dadosTarefa['tb_tarefas_nome']?></span>
                                <?php } else { ?>
                                    <span class="caption-subject font-green sbold uppercase">Nova Tarefa</span>
                                <?php } ?>
                            </div>
                            <?php if(isset($dadosTarefa['id'])) { ?>
                                <?php if($usuario_tipo!=2) { ?>
                                <div class="actions">
                                    <div class="btn-group">
                                        <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Ações
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a class="deletarTarefa">
                                                    <i class="fa fa-trash-o"></i> Deletar </a>
                                            </li>

                                            <?php if ($dadosTarefa['tb_tarefas_aprovacao'] != 1) { ?>
                                            <li class="botaoAprovacao">
                                                <a class="enviarAprovacao">
                                                    <i class="fa fa-mail-forward"></i> Enviar para Aprovação </a>
                                            </li>
                                            <?php } else { ?>
                                                <li class="botaoAprovacao">
                                                    <a class="enviarAprovacao">
                                                        <i class="fa fa-times"></i> Cancelar Aprovação
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php } else if ($dadosTarefa['tb_tarefas_aprovacao'] != 0) {?>
                                    <div class="pull-right">
                                        <a class="btn btn-success">
                                            <i class="fa fa-check aprovarTarefa"></i> Aprovar
                                        </a>
                                        <a class="btn btn-danger">
                                            <i class="fa fa-times reprovarTarefa"></i> Não Aprovar
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                        <div class="portlet-body">
                            <!-- START FORM-->
                            <?php if (isset($dadosTarefa['id'])) {?>
                            <form action="model/cadastraTarefa.php?acao=2" method="post" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="idTarefa" id="idTarefa" value="<?=$dadosTarefa['id']?>"/>
                                <?php } else { ?>
                                <form action="model/cadastraTarefa.php?acao=1" method="post" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
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
                                                    $primeiraEmpresa = $empresas[0]['id'];

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
                                                    if($dadosTarefa['id_projetos_empresas_id']) {
                                                        $projetos = $conexao::fetch("SELECT id, tb_projetos_nome FROM tb_projetos WHERE id_projetos_empresas_id = {$dadosTarefa['id_projetos_empresas_id']}");

                                                    }
                                                    else {
                                                        $projetos = $conexao::fetch("SELECT id, tb_projetos_nome FROM tb_projetos WHERE id_projetos_empresas_id = {$primeiraEmpresa[0]['id']}");
                                                    }

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
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                    <input type="date" class="form-control" name="dataTarefa" placeholder="dd/mm/yyyy" value="<?=$dadosTarefa['tb_tarefas_data_termino']?>" required>
                                                </div>
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tempo Estimado
                                            </label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-clock-o"></i>
                                                            </span>
                                                    <input type="number" class="form-control" min="0" name="tempoEstimado" placeholder="Tempo Estimado" value="<?=$dadosTarefa['tb_tarefas_horas']?>" required>
                                                </div>
                                            </div>

                                            <label class="control-label col-md-1">Tempo Gasto
                                            </label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-clock-o"></i>
                                                            </span>
                                                    <input type="number" class="form-control" min="0" name="tempoGasto" placeholder="Tempo Gasto" value="<?=$dadosTarefa['tb_tarefas_horas_gastas']?>" required>
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

                                        <?php if($usuario_tipo != 2){?>
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
                                        <?php }?>

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

                                        <div class="form-group">
                                            <div class="col-md-7 col-md-offset-3">
                                        <?php  if($dadosTarefa['id'] > 0) { ?>
                                            <?php
                                                $arquivos = $conexao::fetch("SELECT * FROM tb_arquivos WHERE tb_arquivos_tarefas_id = {$dadosTarefa['id']}");

                                                foreach ($arquivos as $key => $arquivo){

                                                    echo '<div id="'.$arquivo['id'].'">';
                                                    echo '<br/>';
                                                    echo '<a target="_blank" href="view/images/uploads/anexos/'.$arquivo['tb_arquivos_nome'].'" download>';
                                                    echo '<input style="border:1px solid #cccccc;padding:7px;vertical-align:bottom;" type="text" id="arquivo'.$arquivo['id'].'" value="'.$arquivo['tb_arquivos_nome'].'" readonly/>';
                                                    echo '</a>';
                                                    echo '<a class="btn-danger btn excluir-anexo" data-role="'.$arquivo['id'].'" style="height:35px;"><i class="fa fa-times"></i></a>';
                                                    echo '<span class="span'.$arquivo['id'].'" style="display:none;"><i style="font-size:17px;margin-left:11px;" class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></span>';
                                                    echo '<br/>';
                                                    echo '</div>';
                                                }
                                            ?>
                                        <?php  } ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Insira um anexo:
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-paperclip"></i>
                                                            </span>
                                                    <input type="file" name="anexo1" id="anexo1" class="anexos form-control"/>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="numero-anexos" name="numero-anexos" value="1"/>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            </label>
                                            <div class="col-md-7">
                                                <a class="btn btn-primary adicionar-arquivos"><i class="fa fa-plus"></i> Adicionar mais arquivos</a>
                                            </div>
                                        </div>

                                        <div class="form-group comentarios" id="comentarios" style="display:none;">
                                            <label class="control-label col-md-3">
                                            </label>
                                            <div class="col-md-7">
                                                <?php include("comentarios-tarefa.php");?>
                                            </div>
                                        </div>

                                        <?php if (isset($dadosTarefa['id'])) { ?>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Comentários
                                                </label>
                                                <div class="col-md-7">
                                                    <a class="btn btn-primary adicionar-comentario">Ver/Adicionar Comentários</a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <?php if( isset($dadosTarefa['id'])){?>
                                                        <?php if($usuario_tipo == 2){?>
                                                            <button type="submit" class="btn green" disabled>Salvar</button>
                                                        <?php }else{?>
                                                            <button type="submit" class="btn green">Salvar</button>
                                                        <?php }?>
                                                    <?php }else{ ?>
                                                        <button type="submit" class="btn green">Cadastrar</button>
                                                    <?php } ?>

                                                    <a href="listar/tarefas" class="btn grey-salsa btn-outline" name="btnCancelar" id="btnCancelar">Cancelar</a>

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

<!--ISSO AQUI EMBAIXO BUGAVA O JS-->
<!--<script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
<!--<script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>-->
<!--<script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>-->
<!--<script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>-->
<!--<script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="view/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>

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

    var statusAprovacao = '<?=$dadosTarefa['tb_tarefas_aprovacao']?>';

    if(statusAprovacao!=1) {
        var aprovacao = 'enviarAprovacao';
    }
    else {
        var aprovacao = 'cancelarAprovacao';
    }

    //Fazer cadastro de comentario também quando teclar enter no input
    document.getElementById('enviarComentario').onkeypress = function(e){
        if (!e) e = window.event;
        if (e.keyCode == '13'){
            var comentario = jq('.comentarioTexto').val();

            $.ajax({
                url: 'model/ws/comentariosTarefa.php',
                type: 'GET',
                data: {
                    format: 'json',
                    acao: 'inserir',
                    comentario: comentario,
                    idUsuario: '<?=$usuario_id?>',
                    idTarefa: '<?=$dadosTarefa['id']?>'
                },
                beforeSend: function () {

                },
                error: function () {

                },
                dataType: 'json',
                success: function (result) {

                }
            });
        }
    }

    //grava o comentario
    jq('.enviarComentario').on('click', function () {
        var comentario = jq('.comentarioTexto').val();

        $.ajax({
            url: 'model/ws/comentariosTarefa.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'inserir',
                comentario: comentario,
                idUsuario: '<?=$usuario_id?>',
                idTarefa: '<?=$dadosTarefa['id']?>'
            },
            beforeSend: function () {

            },
            error: function () {

            },
            dataType: 'json',
            success: function (result) {

            }
        });
    });


    // Função responsável por atualizar os comentarios
    function atualizar()
    {
        //Só atualiza se os comentários estiverem visíveis
        if(jq('.comentarios:visible').length != 0) {
            // Fazendo requisição AJAX
            $.ajax({
                url: 'model/ws/comentariosAtualiza.php',
                type: 'GET',
                data: {
                    format: 'json',
                    acao: 'listar',
                    idTarefa: '<?=$dadosTarefa['id']?>'
                },
                beforeSend: function () {

                },
                error: function () {

                },
                dataType: 'json',
                success: function (result) {
                    jq('.chats').html(result.status);
                }
            });
        }

    }


    // Definindo intervalo que a função será chamada - Aumentar se ficar muito rapido e ruim assim
    setInterval("atualizar()", 1000);



    jq('.enviarAprovacao').on('click',function () {
        $.ajax({
            url: 'model/ws/ativacaoTarefa.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: aprovacao,
                id: '<?=$dadosTarefa['id']?>'
            },
            beforeSend: function () {

            },
            error: function () {

            },
            dataType: 'json',
            success: function (result) {
                if(aprovacao=='enviarAprovacao') {
                    $('.enviarAprovacao').html('<i class="fa fa-times"></i> Cancelar Aprovação ');
                    aprovacao = 'cancelarAprovacao';
                }
                else {
                    $('.enviarAprovacao').html('<i class="fa fa-mail-forward"></i> Enviar para Aprovação ');
                    aprovacao = 'enviarAprovacao';
                }

            }
        });

    });

    jq('.deletarTarefa').on('click',function () {
        var resposta = confirm("Deseja realmente DELETAR essa tarefa?");

        if (resposta == true) {
            $.ajax({
                url: 'model/ws/ativacaoTarefa.php',
                type: 'GET',
                data: {
                    format: 'json',
                    acao: 'excluir',
                    id: '<?=$dadosTarefa['id']?>'
                },
                beforeSend: function () {

                },
                error: function () {
                    $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
                },
                dataType: 'json',
                success: function (result) {
                    window.location.href = "../prosystem/listar/tarefas";
                }
            });
        }
    });

    jq('.excluir-anexo').on('click',function () {
        var arquivo = jq(this).attr('data-role');
        var nome = jq('#arquivo'+arquivo).val();

        $.ajax({
            url: 'model/ws/processaArquivos.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'excluir',
                id: arquivo,
                nome:nome
            },
            beforeSend: function () {
                jq('.span'+arquivo).attr('style','');
            },
            error: function () {
                $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
            },
            dataType: 'json',
            success: function (result) {
                //success
                jq('#'+arquivo).attr('style','display:none;');
            }
        });
    });

    jq('.adicionar-arquivos').on('click', function(){
        var numero = jq('#numero-anexos').val();
        numero++;

        var conteudo =   '<label class="control-label col-md-3">Insira um anexo: </label>'
                         + '<div class="col-md-7"><div class="input-group"><span class="input-group-addon"><i class="fa fa-paperclip"></i></span>'
                         + '<input type="file" name="anexo'+numero+'" id="anexo'+numero+'" class="anexos form-control"/>'
                         + '</div></div><br><br><br>';

        jq('#numero-anexos').val(numero);
        jq(this).parent().parent().prepend(conteudo);
    });

    //adicionar comentários
    jq('.adicionar-comentario').on('click', function(){
        if($('.comentarios:visible').length == 0)
        {
            $(".adicionar-comentario").html('Ocultar Comentários');
            $(".comentarios").attr("style","");
        }
        else {
            $(".adicionar-comentario").html('Ver/Adicionar Comentários');
            $(".comentarios").attr("style",'display:none;');
        }

    });


    //Jquery para mudar projetos
    jq('#empresaId').on('change', function() {
        var idempresa = jq('#empresaId').val();

        $.ajax({
            url: 'model/ws/processaProjetos.php',
            type: 'GET',
            data: {
                format: 'json',
                acao: 'empresa-projetos',
                id: idempresa
            },
            error: function () {
                $('#info').html('<p>Um erro foi encontrado, por favor, tente novamente</p>');
            },
            dataType: 'json',
            success: function (result) {
                if (result.status) {
                   jq('#projetoID').html(result.status);
                }
                else {
                    jq('#projetoID').html('<option>Não há projetos nesta empresa</option>');
                }
            }
        });
    });

    jq('#btnCancelar').on('click', function() {
        if(jq('#idTarefa').val() != undefined){
            window.location.href = "../prosystem/listar/tarefas";
        }else{
            window.location.href = "../prosystem/dashboard";
        }
    });

</script>
<?= include("rodape.php") ?>



