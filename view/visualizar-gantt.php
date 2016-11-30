<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");

//Selecionando todas as tarefas
$conexao = new classeConexao();

$tarefas = $conexao::fetch('SELECT id,tb_tarefas_nome,tb_tarefas_data_termino,tb_tarefas_data_inicio,tb_tarefas_horas, tb_tarefas_ordem FROM tb_tarefas WHERE tb_tarefas_status != 1 ORDER BY tb_tarefas_ordem');

$dataInicial = $conexao::fetchuniq('SELECT min(tb_tarefas_data_inicio) as data from tb_tarefas WHERE tb_tarefas_status != 1');
$dataFinal = $conexao::fetchuniq('SELECT max(tb_tarefas_data_termino) as data from tb_tarefas WHERE tb_tarefas_status != 1');

$timestampBanco = strtotime($dataInicial['data']);

$dataAtual = date();
$timestampAtual = strtotime($dataAtual);

if($timestampAtual<$timestampBanco) {
    $dataInicial = date("d-m-Y");
}

$timestampBanco2 = strtotime($dataFinal['data']);

if($timestampAtual<$timestampBanco2) {
    $dataFinal = date("d-m-Y");
}

$diferenca = $timestampBanco2 - $timestampBanco;

$diasSomados = (int)floor( $diferenca / (60 * 60 * 24));

$tarefaString = '';

foreach ($tarefas as $key => $tarefa) {
    $duracao =  $tarefa['tb_tarefas_horas'];

    $duracao = round($duracao/8);

    if($tarefa['tb_tarefas_data_inicio']!='') {
        $datanova = explode('-', $tarefa['tb_tarefas_data_inicio']);
        $datanova = $datanova[2] . '-' . $datanova[1] . '-' . $datanova[0];
    }
    else {
        $datanova = date("d-m-Y");
    }

    if($tarefas[$key+1]['tb_tarefas_nome']!='') {
        $tarefaString .=  '{"id":'.$tarefa['id'].', "text":"'.$tarefa['tb_tarefas_nome'].'","start_date":"'.$datanova.'","type": "task", "duration":'.$duracao.', "order":'.$tarefa['tb_tarefas_ordem'].',"progress":0, "parent":1},';
    }
    else {
        $tarefaString .=  '{"id":'.$tarefa['id'].', "text":"'.$tarefa['tb_tarefas_nome'].'","start_date":"'.$datanova.'","type": "task", "duration":'.$duracao.', "order":'.$tarefa['tb_tarefas_ordem'].',"progress":0, "parent":1}';
    }
}

$tarefaString = '{"data":[{"id":1, "text":"Tarefas","start_date":"'.$dataInicial.'", "duration":'.$diasSomados.', "order":0,"progress":0, "open":true, "parent":0},'.$tarefaString.']}';


?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Início > Gantt</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="pull-right tooltips btn btn-sm">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
                        </div>
                    </div>
                </div>
                <div class="row flex-center">
                    <div class="col-md-11">
                        <h1 class="page-title"> Gantt Geral
                            <small>gantt contendo todas as tarefas abertas</small>
                        </h1>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-success salvar-gantt">
                            <i class="fa fa-check"></i> Salvar</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 col-sm-8 gantt-opcoes" style="margin-left:2px;">
                        <input type="radio" id="scale1" name="scale" value="1" checked /><label for="scale1">Dias </label>
                        <input type="radio" id="scale2" name="scale" value="2" /><label for="scale2">Semanas </label>
                        <input type="radio" id="scale3" name="scale" value="3" /><label for="scale3">Meses </label>
                        <input type="radio" id="scale4" name="scale" value="4" /><label for="scale4">Ano </label>
                    </div>
                    <div class="pull-right col-md-2 col-sm-1" style="text-align:right;">
                        <a class="btn btn-xs btn-default" onclick="exportGantt(&quot;pdf&quot;)"><i class="fa fa-file-pdf-o"></i> Exportar PDF</a>
                        <a class="btn btn-xs btn-default" onclick="exportGantt(&quot;png&quot;)"><i class="fa fa-image"></i> Exportar PNG</a>
                    </div>
                </div>

                <div id="gantt_here" style='width:100%; height:100%;'></div>
            </div>
        </div>
    </div>
<?=include("rodape.php")?>
<script src="view/libs/dhtmlxgantt/dhtmlxgantt.js" type="text/javascript" charset="utf-8"></script>
<script src="view/libs/dhtmlxgantt/locale/locale_pt.js" type="text/javascript" charset="utf-8"></script>
<!--<script src="view/libs/dhtmlxgantt/common/dhtmlxSuite/dhtmlx.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="view/libs/dhtmlxgantt/sources/dhtmlxgantt.jss" type="text/javascript" charset="utf-8"></script>-->
<script type="text/javascript" src="view/libs/dhtmlxgantt/common/testdata.js"></script>
<script src="http://export.dhtmlx.com/gantt/api.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="view/libs/dhtmlxgantt/dhtmlxgantt.css" type="text/css" media="screen" title="no title" charset="utf-8">


<script type="text/javascript">
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
    var text = '<?=$tarefaString?>';

    //array com as tarefas atualizadas
    var tarefasAtt = [];


    var holidays = [//inserção dos feriados
        new Date(2016, 12, 08),
        new Date(2014, 0, 20),
        new Date(2014, 1, 17),
        new Date(2014, 3, 16),
        new Date(2014, 4, 26),
        new Date(2014, 6, 4),
        new Date(2014, 8, 1),
        new Date(2014, 9, 13),
        new Date(2014, 10, 11),
        new Date(2014, 10, 27),
        new Date(2014, 11, 25)
    ];

    for(var i=0; i < holidays.length; i++){
        gantt.setWorkTime({
            date:holidays[i],
            hours:false
        });
    }


    gantt.config.work_time = true;

    gantt.config.start_date = new Date(2016, 09, 1);
    gantt.config.end_date = new Date(2017, 09, 30);

    gantt.config.order_branch = true; //trocar de ordem
    gantt.config.order_branch_free = true; //trocar de ordem

    gantt.config.auto_scheduling = true;
    gantt.config.auto_scheduling_strict = true;
    gantt.config.auto_scheduling_initial = true;

    gantt.config.scale_unit = "day";
    gantt.config.date_scale = "%D, %d";
    gantt.config.min_column_width = 60;
    gantt.config.duration_unit = "day";
    gantt.config.scale_height = 20*3;
    gantt.config.row_height = 30;



    var weekScaleTemplate = function(date){
        var dateToStr = gantt.date.date_to_str("%d %M");
        var weekNum = gantt.date.date_to_str("(week %W)");
        var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
        return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
    };

    gantt.config.subscales = [
        {unit:"month", step:1, date:"%F, %Y"},
        {unit:"week", step:1, template:weekScaleTemplate}

    ];

    gantt.templates.task_cell_class = function(task, date){
        if(!gantt.isWorkTime(date))
            return "week_end";
        return "";
    };


    var tasks = JSON.parse(text);

    gantt.attachEvent("onBeforeTaskChanged", function(id, mode, old_event){
        var task = gantt.getTask(id);
        if(mode == gantt.config.drag_mode.progress){
            if(task.progress < old_event.progress){
                gantt.message(task.text + " progress can't be undone!");
                return false;
            }
        }
        return true;
    });

    gantt.attachEvent("onAfterTaskUpdate", function(id,item){
        tarefasAtt.push(item);
        console.log(item);
    });

    gantt.attachEvent("onBeforeRowDragEnd", function(id, parent, tindex){
        var task = gantt.getTask(id);
        if(task.parent != parent)
            return false;
        tarefasAtt.push(task); //colocando no array de modificações
        return true;
    });

    //após atualizar a tarefa
    gantt.attachEvent("onAfterTaskDrag", function(id, mode){
        var task = gantt.getTask(id);
        var message = task.text + " ";

        if(mode == gantt.config.drag_mode.progress){
            message += "progress is being updated";
        }else{
            message += "foi ";
            if(mode == gantt.config.drag_mode.move)
                message += "alterada";
            else if(mode == gantt.config.drag_mode.resize)
                message += "alterada";
        }
        gantt.message(message);
        return true;
    });


    gantt.init("gantt_here");


    gantt.parse(tasks);


    function setScaleConfig(value){
        switch (value) {
            case "1":
                gantt.config.scale_unit = "day";
                gantt.config.step = 1;
                gantt.config.date_scale = "%d %M";
                gantt.config.subscales = [];
                gantt.config.scale_height = 27;
                gantt.templates.date_scale = null;
                break;
            case "2":
                var weekScaleTemplate = function(date){
                    var dateToStr = gantt.date.date_to_str("%d %M");
                    var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
                    return dateToStr(date) + " - " + dateToStr(endDate);
                };

                gantt.config.scale_unit = "week";
                gantt.config.step = 1;
                gantt.templates.date_scale = weekScaleTemplate;
                gantt.config.subscales = [
                    {unit:"day", step:1, date:"%D" }
                ];
                gantt.config.scale_height = 50;
                break;
            case "3":
                gantt.config.scale_unit = "month";
                gantt.config.date_scale = "%F, %Y";
                gantt.config.subscales = [
                    {unit:"day", step:1, date:"%j, %D" }
                ];
                gantt.config.scale_height = 50;
                gantt.templates.date_scale = null;
                break;
            case "4":
                gantt.config.scale_unit = "year";
                gantt.config.step = 1;
                gantt.config.date_scale = "%Y";
                gantt.config.min_column_width = 50;

                gantt.config.scale_height = 90;
                gantt.templates.date_scale = null;


                gantt.config.subscales = [
                    {unit:"month", step:1, date:"%M" }
                ];
                break;
        }
    }

    setScaleConfig('4');

    var func = function(e) {
        e = e || window.event;
        var el = e.target || e.srcElement;
        var value = el.value;
        setScaleConfig(value);
        gantt.render();
    };

    var els = document.getElementsByName("scale");
    for (var i = 0; i < els.length; i++) {
        els[i].onclick = func;
    }

    function exportGantt(mode){
        if (mode == "png")
            gantt.exportToPNG({
                header:'<link rel="stylesheet" href="http://docs.dhtmlx.com/gantt/samples/common/customstyles.css" type="text/css">'
            });
        else if (mode == "pdf")
            gantt.exportToPDF({
                header:'<link rel="stylesheet" href="http://docs.dhtmlx.com/gantt/samples/common/customstyles.css" type="text/css">'
            });
    }
    
    
    $('.salvar-gantt').on('click', function () {

        var tarefasAtualizar = JSON.stringify(tarefasAtt);

        $.ajax({
            url: 'model/ws/atualizaGantt.php',
            type: 'POST',
            data: {
                format: 'json',
                acao: 'atualizarDados',
                tarefas: tarefasAtualizar
            },
            error: function () {

            },
            dataType: 'json',
            success: function () {
                alert('ok');
            }
        });

    })
</script>
