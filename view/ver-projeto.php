<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);
$id = isset($_GET['idProjeto']) ? $_GET['idProjeto'] : '';


include("topo.php");


//Consultando o projeto
$conexao = new classeConexao();
$projeto = $conexao::fetchuniq("SELECT * FROM tb_projetos WHERE id = '{$id}'");

$empresa = $conexao::fetchuniq("SELECT * FROM tb_empresas WHERE id = '{$projeto['id_projetos_empresas_id']}'");

if($usuario_tipo == 2) { //se é o cliente que está acessando
    $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tt.tb_tarefas_oculto != 1 AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_projeto = {$id}");
}
else {
    $tarefas = $conexao::fetch("SELECT tt.*, te.tb_empresas_nome FROM tb_tarefas tt, tb_empresas te, tb_projetos tp WHERE tp.id_projetos_empresas_id = te.id AND tp.id = tt.tb_tarefas_projeto AND tt.tb_tarefas_projeto = {$id}");
}

//Obter os participantes do projeto através das tarefas
$usuarios = $conexao::fetch("SELECT DISTINCT tu.* FROM tb_usuarios tu, tb_tarefas tt WHERE tt.tb_tarefas_projeto = {$id} AND tt.tb_tarefas_funcionario = tu.id");

//Qtd tarefas a fazer
$tarefasFazer = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=0 AND tb_tarefas_projeto = ".$id);

//Qtd tarefas feitas
$tarefasFeitas = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=1 AND tb_tarefas_projeto = ".$id);

//Somatória das horas
$horas = $conexao::fetchuniq("SELECT SUM(tb_tarefas_horas) as horasPrevistas, SUM(tb_tarefas_horas_gastas) as horasGastas FROM tb_tarefas WHERE tb_tarefas_projeto = ".$id);

//Porcentagem
$porcentagem = ($tarefasFeitas['qtd'] * 100) / ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);
?>

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="view/assets/pages/css/about.min.css" rel="stylesheet" type="text/css" />
<link href="view/assets/pages/css/contact.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
    <div class="clearfix"> </div>
    <div class="page-container page-container-bg-solid">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <span>Projetos > <a href="listar/projetos">Ver Projetos</a> > <?=$projeto['tb_projetos_nome']?> </span>
                            </li>
                        </ul>
                    <div class="page-toolbar">
                        <div class="pull-right tooltips btn btn-sm">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
                        </div>
                    </div>
                </div>

                <!-- START CABEÇALHO -->
                <div class="row margin-bottom-40 about-header" style="height: 310px;">
                    <div class="col-md-12">
                        <h1 style="margin-top:70px;"><?=$projeto['tb_projetos_nome']?></h1>
                        <h2><?=round($porcentagem)?>%</h2>
                        <a href="cadastrar/tarefa-projeto/<?=$projeto['id']?>" class="btn btn-success">NOVA TAREFA <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <!-- END CABEÇALHO -->

                <!-- START CARDS -->
                <div class="row margin-bottom-20">
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="card-icon">

                                    <div id="tarefas-concluidas" style="height:170px;"></div>

                            </div>
                            <div class="card-title">
                                <span> Tarefas </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet light">
                            <div class="card-icon">

                                <div id="horas-restantes" style="height:170px;"></div>

                            </div>
                            <div class="card-title">
                                <span> Horas </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="portlet light"  style="height:222px;">
                                    <h3><?= $empresa['tb_empresas_nome'] ?></h3>
                                    <br/>

                                    <h5><i class="fa fa-map-pin fa-lg font-green" style="min-width:25px;"></i>
                                        <?=$empresa['tb_empresas_endereco'] ?></h5>

                                    <h5><i class="fa fa-envelope fa-lg font-green" style="min-width:25px;"></i>
                                        <?= $empresa['tb_empresas_email'] ?></h5>

                                    <h5><i class="fa fa-globe fa-lg font-green" style="min-width:25px;"></i>

                                        <a href="www.<?= $empresa['tb_empresas_site'] ?>">
                                            www.<?= $empresa['tb_empresas_site'] ?>
                                        </a>
                                    </h5>

                                    <h5><i class="fa fa-pencil fa-lg font-green" style="min-width:25px;"></i>
                                        <?= $empresa['tb_empresas_anotacao'] ?>
                                    </h5>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="fa fa-tasks font-dark"></i>
                                        <span class="caption-subject bold uppercase">Tarefas</span>
                                    </div>
                                </div>
                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Nome </th>
                                            <th> Data Término </th>
                                            <th> Horas Est. </th>
                                            <th> Prioridade </th>
                                            <th> Status </th>
                                            <th> Ações </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- START CONTEUDO TABELA -->
                                        <?php foreach ($tarefas as $tarefa) { ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$tarefa['id']?> </td>

                                                <td><a href="editar/tarefa/<?=$tarefa['id']?>"><?=$tarefa['tb_tarefas_nome']?></a></td>

                                                <td><?=DataBrasil($tarefa['tb_tarefas_data_termino'])?></td>

                                                <td><?=$tarefa['tb_tarefas_horas']?> horas</td>

                                                <?php if ($tarefa['tb_tarefas_prioridade']==0) {?>
                                                    <td><span class="label label-sm label-default"> Normal </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==1) {?>
                                                    <td><span class="label label-sm label-warning"> Alta </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==2) {?>
                                                    <td><span class="label label-sm label-danger"> Urgente </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==-1) {?>
                                                    <td><span class="label label-sm label-info"> Baixa </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_prioridade']==-2) {?>
                                                    <td><span class="label label-sm label-success"> Muito Baixa </span></td>
                                                <?php } ?>

                                                <?php if ($tarefa['tb_tarefas_status']==0) {?>
                                                    <td><span class="label label-sm label-warning"> Aberto </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_status']==1) {?>
                                                    <td><span class="label label-sm label-success"> Concluída </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_status']==2) {?>
                                                    <td><span class="label label-sm label-default"> Fechada </span></td>
                                                <?php } else if ($tarefa['tb_tarefas_status']==3) {?>
                                                    <td><span class="label label-sm label-primary"> Pausada </span></td>
                                                <?php } ?>
                                                <td>
                                                    <a href="editar/tarefa/<?=$tarefa['id']?>" class="btn btn-xs btn-warning" title="Editar"> <i class="fa fa-edit"></i>
                                                    </a>


                                                    <?php if ($tarefa['tb_tarefas_status']==2 || $tarefa['tb_tarefas_status']==0) {?>
                                                        <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-success reativar" title="Concluir"> <i class="fa fa-check"></i>
                                                        </a>
                                                    <?php } else {?>
                                                        <a id="<?=$tarefa['id']?>" data-role="<?=$tarefa['id']?>" class="btn btn-xs btn-danger desativar" title="Abrir"> <i class="fa fa-times"></i>
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
                        </div>
                    </div>
                </div>

                <!-- START PARTICIPANTES -->
                <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                    <div class="col-md-12">
                        <h1>Participando deste Projeto</h1>
                        <h2>Equipe que está participando ativamente deste projeto</h2>
                    </div>
                </div>
                <div class="row margin-bottom-20 stories-cont">

                    <?php
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
<?=include("rodape.php")?>


<!-- DEPENDENCIAS LOCAIS -->
<script src="view/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="view/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>

<script>

    var horasPrevistas = '<?=$horas['horasPrevistas']?>';
    var horasGastas = '<?=$horas['horasGastas']?>';

    //Caso ainda não tenha sido gasto nada:
    if(horasGastas=='') {
        horasGastas = 0;
    }
    var horasRestantes = horasPrevistas - horasGastas;


    new Morris.Donut({
        // ID of the element in which to draw the chart.
        element: 'tarefas-concluidas',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { label: 'A Fazer', value: <?=$tarefasFazer['qtd']?> },
            { label: 'Concluídas', value: <?=$tarefasFeitas['qtd']?> }
        ],
        colors: [
            '#cb3c3c','#3ccbcb'
        ]
    });

    new Morris.Donut({
        // ID of the element in which to draw the chart.
        element: 'horas-restantes',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { label: 'Restantes', value: horasRestantes },
            { label: 'Utilizadas', value: horasGastas }
        ],
        colors: [
            '#cccccc','#3ccbcb'
        ]
    });



</script>