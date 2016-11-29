<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$tarefas = isset($_GET['tarefas']) ? $_GET['tarefas'] : '';


$tarefas = json_decode($tarefas);



