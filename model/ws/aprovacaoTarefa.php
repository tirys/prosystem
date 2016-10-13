<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : '';
$data = date("Y-m-d H:i:s");

include('../../config/conexao.php');

if ($acao == 'aprovar') {

    $conexao = new classeConexao();
    $resultado = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 3 WHERE id = {$id}");

    //Inserindo no log
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'aprovou a tarefa','{$data}','aprovacao',{$id})");

    echo json_encode(array("status" => true));
}

if ($acao == 'rejeitar') {

    $conexao = new classeConexao();
    $resultado = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 2 WHERE id = {$id}");

    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'reprovou a tarefa','{$data}','aprovacao',{$id})");

    echo json_encode(array("status" => true));

}