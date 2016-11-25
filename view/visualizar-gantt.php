<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

require("libs/dhtmlxgantt/connector/grid_connector.php"); //connector do gantt

?>


<?php
include("topo.php");
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
                <h1 class="page-title"> Gantt Geral
                    <small>gantt contendo todas as tarefas abertas</small>
                </h1>

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

<link rel="stylesheet" href="view/libs/dhtmlxgantt/dhtmlxgantt.css" type="text/css" media="screen" title="no title" charset="utf-8">


<script type="text/javascript">
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();


    var holidays = [//inserção dos feriados
        new Date(2016, 10, 30),
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

    gantt.config.start_date = new Date(2016, 1, 1);
    gantt.config.end_date = new Date(2017, 11, 30);

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


    var tasks =  {
        data:[
            {id:1, text:"Project #2", start_date:""+dd+"-"+mm+"-"+yyyy+"", duration:18,order:10,
                progress:0, open: true},
            {id:2, text:"Task #1", 	  start_date:""+dd+"-"+mm+"-"+yyyy+"", duration:8, order:10,
                progress:0, parent:1},
            {id:3, text:"Task #2",    start_date:""+dd+"-"+mm+"-"+yyyy+"", duration:8, order:20,
                progress:0, parent:1}
        ],
        links:[
            { id:1, source:1, target:2, type:"1"},
            { id:2, source:2, target:3, type:"0"},
            { id:3, source:3, target:4, type:"0"},
            { id:4, source:2, target:5, type:"2"},
        ]
    };

//    gantt.attachEvent("onAfterTaskDrag", function(id, mode){
//        alert("Você clicou 2 vezes na tarefa="+id);
//    });
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
        console.log(item);
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


        //se clicar na tarefa
//    gantt.attachEvent("onTaskDblClick", function(id, e) {
//        alert("Você clicou 2 vezes na tarefa="+id);
//    });

//    gantt.attachEvent("onTaskClick", function(id, e) {
//        alert("Você clicou na tarefa="+id);
//    });


    gantt.init("gantt_here");


    gantt.parse(tasks);

</script>
