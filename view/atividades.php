<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");


//Consultando as tarefas
$conexao = new classeConexao();


//Se é minhas tarefas

$usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");
$usuario_id = $usuario['id'];

$tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_funcionario = {$usuario['id']} AND tt.tb_tarefas_status != 1");

//Separar o bloco abaixo em métodos em outra classe depois (fiz assim para ser mais rápido)
//Se é cliente
if($usuario_tipo == 2) {
    $atividadesRecentes = $conexao::fetch("SELECT tl.*,tu.tb_usuarios_nome FROM tb_logs tl, tb_usuarios tu, tb_tarefas ta, tb_projetos tp, tb_clientes tc, tb_empresas te WHERE tl.tb_logs_usuario_id = tu.id and tl.tb_logs_id_referencia in (select tt.id from tb_tarefas tt, tb_projetos tp, tb_clientes tc WHERE (tt.tb_tarefas_oculto <> 1) AND tt.tb_tarefas_projeto = tp.id AND tp.id_projetos_empresas_id = tc.tb_clientes_empresas_id AND tc.tb_clientes_usuario_id = {$usuario['id']}) group by 4 order by tl.id desc limit 30");

}
else {
    $atividadesRecentes = $conexao::fetch("SELECT tl.*,tu.tb_usuarios_nome FROM tb_logs tl, tb_usuarios tu WHERE tu.id=tl.tb_logs_usuario_id ORDER BY tl.id DESC LIMIT 30");
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
                        <span>Atividades Recentes</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="pull-right tooltips btn btn-sm">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
                    </div>
                </div>
            </div>
            <h1 class="page-title"> Atividades Recentes
            </h1>
            <div class="row">
                    <div class="col-lg-12 col-xs-12 col-sm-12">
                        <div class="portlet light bordered">
                            <div class="portlet-body">
                                <div class="scroller" style="min-height: 900px;" data-always-visible="1" data-rail-visible="0">
                                    <ul class="feeds">
                                        <?php
                                        foreach ($atividadesRecentes as $atividade) {

                                            $item = '';
                                            $img = 'fa-check';
                                            $label = 'label-info';
                                            $url = 'editar/tarefa/';

                                            AtividadesRecentesGeral($atividade['tb_logs_descricao'],$atividade['tb_logs_id_referencia'],$atividade['tb_usuarios_nome'],$atividade['tb_logs_data']);

                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
                <script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                <script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
                <?=include("rodape.php")?>