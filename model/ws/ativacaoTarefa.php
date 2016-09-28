<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

include('../../config/conexao.php');

//Ativando os projetos
if($acao=='reativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 1 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}


//Desativando os projetos
if($acao=='desativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 0 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}

