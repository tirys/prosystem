<?php

    require("../view/libs/dhtmlxgantt/connector/grid_connector.php"); //connector do gantt
    $res=mysql_connect("mysql.agenciaprospecta.com.br","agenciaprospec52","cUGvufreF3");// db connection

    // defines that the UTF-8 character encoding is used
    mysql_query("SET NAMES UTF8");
    mysql_select_db("agenciaprospec52"); // db connection

    // connector object; parameters: db connection and the type of the used db
    $gridConn = new GridConnector($res,"MySQL");
    $gridConn->render_table("tb_tarefas","id","tb_tarefas_nome,tb_tarefas_data_termino");// data configuration

?>