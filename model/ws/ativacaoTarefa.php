<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

include('../../config/conexao.php');

//Ativando as tarefas
if($acao=='reativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 1 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}


//Desativando as tarefas
if($acao=='desativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 0 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}

//Pausando as tarefas
if($acao=='pausar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 3 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}
