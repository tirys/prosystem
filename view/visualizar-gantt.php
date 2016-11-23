<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");
?>
    <script src="view/libs/dhtmlxgantt/dhtmlxgantt.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="view/libs/dhtmlxgantt/dhtmlxgantt.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript" src="view/libs/dhtmlxgantt/common/testdata.js"></script>

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


<script type="text/javascript">
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();

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

    gantt.init("gantt_here");


    gantt.parse(tasks);

</script>
