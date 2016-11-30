<?php
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
$tarefas = isset($_POST['tarefas']) ? $_POST['tarefas'] : '';

include('../../config/conexao.php');

$tarefas = str_replace('$', '', $tarefas);
$tarefas = json_decode($tarefas);

//var_dump($tarefas);
$dataFim = date();
$dataInicio = date();

$conexao = new classeConexao();

foreach ($tarefas as $tarefa) {
    $dataFim = $tarefa->end_date;
    $timestamp = strtotime($dataFim);

    //formato mysql
    $dataFim = date('Y-m-d', $timestamp);

    $dataInicio = $tarefa->start_date;
    $timestamp = strtotime($dataInicio);

    //formato mysql
    $dataInicio = date('Y-m-d', $timestamp);

    $duracao = $tarefa->duration * 8;
    $id = $tarefa->id;
    var_dump($tarefa);
    $ordem = $tarefa->index;

    $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_data_inicio = '{$dataInicio}', tb_tarefas_data_termino = '{$dataFim}', tb_tarefas_horas = {$duracao}, tb_tarefas_ordem = {$ordem} WHERE id = {$id}");
}

