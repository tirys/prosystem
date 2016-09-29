<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$idTarefa = isset($_GET['idTarefa']) ? $_GET['idTarefa'] : '';

include("topo.php");

$conexao = new classeConexao();
$tarefa = $conexao::fetchuniq("SELECT tt.* FROM tb_tarefas tt WHERE tt.id = '{$idTarefa}'");
?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Tarefas > <a href="listar/tarefas">Ver Tarefas </a> <?=$tarefa['tb_tarefas_nome']?></span>
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
                <h1 class="page-title"> <?=$tarefa['tb_tarefas_nome']?>
                    <small>detalhes sobre a tarefa</small>
                </h1>

            </div>
        </div>
    </div>
<?=include("rodape.php")?>