<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$id = isset($_GET['idEmpresa']) ? $_GET['idEmpresa'] : '';


include("topo.php");


//Consultando a empresa
$conexao = new classeConexao();
$empresa = $conexao::fetchuniq("SELECT * FROM tb_empresas WHERE id = '{$id}'");



?>
<link href="view/assets/pages/css/about.min.css" rel="stylesheet" type="text/css" />
<link href="view/assets/pages/css/contact.min.css" rel="stylesheet" type="text/css" />

<link href="view/assets/pages/css/contact.min.css" rel="stylesheet" type="text/css" />
    <div class="clearfix"> </div>
    <div class="page-container page-container-bg-solid">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Empresas > <a href="listar/empresas">Ver empresas</a> > <?=$empresa['tb_empresas_nome']?></span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="pull-right tooltips btn btn-sm">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
                        </div>
                    </div>
                </div>
                <h1 class="page-title"> <?=$empresa['tb_empresas_nome']?>
                    <small>visualização dos dados da empresa</small>
                </h1>


                <div class="c-content-contact-1 c-opt-1">
                    <div class="row" data-auto-height=".c-height">
                        <div id="mapa" class="col-lg-8 col-md-6 "></div>
                        <div class="col-lg-4 col-md-6">
                            <div class="c-body">
                                <div class="c-section">
                                    <h3><?=$empresa['tb_empresas_nome']?></h3>
                                </div>
                                <div class="c-section">
                                    <div class="c-content-label uppercase bg-blue">Endereço</div>
                                    <p><?=$empresa['tb_empresas_endereco']?></p>
                                </div>
                                <div class="c-section">
                                    <div class="c-content-label uppercase bg-blue">Contatos</div>
                                    <p>
                                        <?=$empresa['tb_empresas_email']?>
                                     </p>
                                </div>
                                <div class="c-section">
                                    <div class="c-content-label uppercase bg-blue">Sites</div>
                                    <br/>
                                    <ul class="c-content-iconlist-1 ">
                                        <li>
                                            <a href="http://<?=$empresa['tb_empresas_site']?>">
                                                <i class="fa fa-globe"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="c-section">
                                    <div class="c-content-label uppercase bg-blue">Anotações</div>
                                    <p>
                                        <?=$empresa['tb_empresas_anotacao']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="gmapbg" class="c-content-contact-1-gmap" style="height: 615px;"></div>
                </div>

                <!-- START PARTICIPANTES -->
                <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                    <div class="col-md-12">
                        <h1>Clientes</h1>
                        <h2>Usuários cadastrador nesta empresa</h2>
                    </div>
                </div>
                <div class="row margin-bottom-20 stories-cont">

                    <?php
                    $usuarios = $conexao::fetch("SELECT tu.* FROM tb_usuarios tu, tb_clientes tc WHERE tu.tb_usuarios_tipo = 2 AND tu.id=tc.tb_clientes_usuario_id");

                    foreach ($usuarios as $usuario) {


                        echo '<div class="col-lg-3 col-md-6"><div class="portlet light"><div class="photo">';
                        echo "<img src='view/images/{$usuario['tb_usuarios_foto']}' alt='' class='img-responsive'/></div>";
                        echo '<div class="title">';
                        echo "<span>{$usuario['tb_usuarios_nome']}</span>";
                        echo '<div class="desc">';

                        if($usuario['tb_usuarios_tipo'] == 1) {
                            //Obter dados se for funcionario
                            $funcionarios = $conexao::fetchuniq("SELECT * FROM tb_funcionarios WHERE tb_funcioanios_usuario_id = {$usuario['id']}");
                            echo "<span>{$funcionarios['tb_funcionarios_funcao']}</span>";
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
<!-- BEGIN CORE PLUGINS -->

<script src="view/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
<script src="view/assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="view/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script>
    var Contact=function(){
        return{init:function(){var n;$(document).ready(function(){n=new GMaps({div:"#gmapbg",lat:<?=$empresa['tb_empresas_latitude']?>,lng:<?=$empresa['tb_empresas_longitude']?>});var t=n.addMarker({lat:<?=$empresa['tb_empresas_latitude']?>,lng:<?=$empresa['tb_empresas_longitude']?>,title:"Loop, Inc.",infoWindow:{content:"<b><?=$empresa['tb_empresas_nome']?></b> <?=$empresa['tb_empresas_endereco']?>"}});t.infoWindow.open(n,t)})}}}();jQuery(document).ready(function(){Contact.init()});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="view/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="view/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="view/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="view/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- Google Code for Universal Analytics -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1ULS0scKPvY9pUPdKte5A97sTwqVtzO8&libraries=places"></script>
