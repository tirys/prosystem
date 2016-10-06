<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

//echo $_GET['id'];
$idUser = "";
$edicao = 0;
$idUser = $_GET["idUser"];

include("topo.php");
$conexao = new classeConexao();

if($idUser != ""){
    $user = "";
    $idEmpresa = "";
    $cargaHoraria="";
    $funcao="";
    $tipoUser="adm";
    $user = $conexao::fetchuniq("SELECT tb_usuarios_email, tb_usuarios_nome, tb_usuario_login, tb_usuario_senha, tb_usuarios_foto FROM tb_usuarios WHERE id = '".$idUser."'");

    $buscaTipo = $conexao::fetchuniq("SELECT tb_funcionarios_carga_horaria, tb_funcionarios_funcao FROM tb_funcionarios WHERE tb_funcioanios_usuario_id = '".$idUser."'");
    if($buscaTipo != ""){ $tipoUser = "fun"; $cargaHoraria = $buscaTipo['tb_funcionarios_carga_horaria'];$funcao = $buscaTipo['tb_funcionarios_funcao'];}

    $buscaTipo = $conexao::fetchuniq("SELECT tb_clientes_empresas_id FROM tb_clientes WHERE tb_clientes_usuario_id = '".$idUser."'");
    if($buscaTipo != ""){ $tipoUser = "cli"; $idEmpresa = $buscaTipo['tb_clientes_empresas_id'];}


    if($user!= ""){
        $edicao = 1;
    }
}

?>
    <div class="clearfix"></div>
    <div class="page-container">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Usuários > <?php if ($idUser != "") {echo "Editar";}else{echo "Cadastrar";}?></span>
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
                                    <i class="icon-user font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase"><?php if ($idUser != "") {echo "Editar usuário";}else{echo "Novo usuário";}?></span></span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->

                                <?php if ($idUser != "") {?>
                                <form action="model/cadastraUsuario.php?acao=2" method="post" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="idUser" id="idUser" value="<?=$idUser?>"/>
                                    <input type="hidden" name="fotoExistente" value="<?=$user['tb_usuarios_foto']?>"/>
                                    <?php } else { ?>
                                    <form action="model/cadastraUsuario.php?acao=1" method="post" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                                        <?php } ?>


                                <form method="post" id="form_sample_1" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Por favor, preencha os dados corretamente.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Your form validation is successful!
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nome
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                <?php if($edicao == 1){
                                                    echo '<input type="text" name="nomeUsuario" placeholder="Nome do usuário" data-required="1" class="form-control" value="'.$user['tb_usuarios_nome'].'" required/></div>';
                                                }else{
                                                    echo '<input type="text" name="nomeUsuario" placeholder="Nome do usuário" data-required="1" class="form-control" required/></div>';
                                                } ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                    <?php if($edicao == 1){
                                                        echo '<input type="text" class="form-control" name="emailUsuario" value="'.$user['tb_usuarios_email'].'" placeholder="Email do usuário" required></div>';
                                                    }else{
                                                        echo '<input type="text" class="form-control" name="emailUsuario" placeholder="Email do usuário" required></div>';
                                                    } ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Foto:</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <span class="btn green btn-file">
                                                                <span class="fileinput-new"> Escolha um arquivo </span>
                                                                <span class="fileinput-exists"> Mudar arquivo </span>
                                                                <input type="hidden" value="" name="..."><input type="file" name="fotoUser"> </span>
                                                    <span class="fileinput-filename"></span> &nbsp;
                                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Login
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                    <?php if($edicao == 1){
                                                        echo '<input name="loginUsuario" type="text" placeholder="Login do usuário" value="'.$user['tb_usuario_login'].'" class="form-control" required disabled/></div>';
                                                    }else{
                                                        echo '<input name="loginUsuario" type="text" placeholder="Login do usuário" class="form-control" required/></div>';
                                                    } ?>

                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Senha
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-lock"></i>
                                                            </span>
                                                    <?php if($edicao == 1){
                                                        echo '<input name="senhaUsuario" type="password" value="'.$user['tb_usuario_senha'].'" placeholder="******" class="form-control" required/></div>';
                                                    }else{
                                                        echo '<input name="senhaUsuario" type="password" placeholder="******" class="form-control" required/></div>';
                                                    } ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tipo de Usuário
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php if($edicao == 1){
                                                    echo ' <select class="form-control" name="tipoUsuario" id="tipoUsuario" >';
                                                }else{
                                                    echo '<select class="form-control" name="tipoUsuario" id="tipoUsuario">';
                                                }?>
                                                    <?php echo($tipoUser == "cli" ? '<option value="cli" selected>Cliente</option>' : '<option value="cli">Cliente</option>');?>
                                                    <?php echo($tipoUser == "fun" ? '<option value="fun" selected>Funcionário</option>' : '<option value="fun">Funcionário</option>');?>
                                                    <?php echo($tipoUser == "adm" ? '<option value="adm" selected>Administrador</option>' : '<option value="adm">Administrador</option>');?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="empresaU">
                                            <label class="control-label col-md-3">Empresa
                                            </label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="empresaUsuario" id="empresaUsuario">
                                                    <?php
                                                    //$conexao = new classeConexao();
                                                    $empresas = $conexao::fetch("SELECT id, tb_empresas_nome as nome FROM tb_empresas");

                                                    foreach ($empresas as $emp){
                                                        if($idEmpresa == $emp['id']){
                                                            $html .= '<option value="'.$emp['id'].'" selected>'.$emp['nome'].'</option>';
                                                        }else{
                                                            $html .= '<option value="'.$emp['id'].'">'.$emp['nome'].'</option>';
                                                        }
                                                    }
                                                    echo $html;

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Apenas funcionarios-->
                                        <div class="form-group"  id="cargahorariaU" style="display: none;">
                                            <label class="control-label col-md-3">Carga Horária
                                            </label>
                                            <div class="col-md-4">
                                                <?php if($tipoUser == "fun"){
                                                    echo '<input name="cargaHoraria" type="text" placeholder="Carga horária" value="'.$cargaHoraria.'" class="form-control"/></div>';
                                                }else{
                                                    echo '<input name="cargaHoraria" type="text" placeholder="Carga horária" class="form-control"/></div>';
                                                } ?>
                                        </div>

                                        <div class="form-group"  id="funcaoU" style="display: none;">
                                            <label class="control-label col-md-3">Função
                                            </label>
                                            <div class="col-md-4">
                                                <?php if($tipoUser == "fun"){
                                                    echo '<input name="funcao" type="text" placeholder="Função" value="'.$funcao.'" class="form-control"/></div>';
                                                }else{
                                                    echo '<input name="funcao" type="text" placeholder="Função" class="form-control"/></div>';
                                                } ?>
                                            </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <?php if($usuario_tipo == 0){?>
                                                    <button type="submit" class="btn green">Enviar</button>
                                                <?php }else{ ?>
                                                    <button type="submit" class="btn green" disabled>Enviar</button>
                                                <?php } ?>
                                                <button type="button" class="btn grey-salsa btn-outline" name="btnCancelar" id="btnCancelar">Cancelar</button>
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

<!--ISSO AQUI BUGAVA OS JS-->
<!--    <script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
<!--    <script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>-->
<!--    <script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>-->
<!--    <script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>-->
<!--    <script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
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
        if( jq(this).val() == 'cli') {
            jq('#empresaU').attr('style','');
            jq('#cargahorariaU').attr('style','display:none;');
            jq('#funcaoU').attr('style','display:none;');
        }
        else if (jq(this).val() == 'fun') {
            jq('#cargahorariaU').attr('style','');
            jq('#funcaoU').attr('style','');
            jq('#empresaU').attr('style','display:none;');
        }
        else {
            jq('#empresaU').attr('style','display:none;');
            jq('#cargahorariaU').attr('style','display:none;');
            jq('#funcaoU').attr('style','display:none;');
        }
    });


    if( jq('#tipoUsuario').val() == 'cli') {
        jq('#empresaU').attr('style','');
        jq('#cargahorariaU').attr('style','display:none;');
        jq('#funcaoU').attr('style','display:none;');
    }
    else if (jq('#tipoUsuario').val() == 'fun') {
        jq('#cargahorariaU').attr('style','');
        jq('#funcaoU').attr('style','');
        jq('#empresaU').attr('style','display:none;');
    }
    else {
        jq('#empresaU').attr('style','display:none;');
        jq('#cargahorariaU').attr('style','display:none;');
        jq('#funcaoU').attr('style','display:none;');
    }

    jq('#btnCancelar').on('click', function() {
        if(jq('#idUser').val() != undefined){
            window.location.href = "../prosystem/listar/usuario";
        }else{
            window.location.href = "../prosystem/dashboard";
        }
    });

</script>
<?= include("rodape.php") ?>



