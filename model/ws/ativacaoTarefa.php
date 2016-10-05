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

//Enviando para aprovação
//  se 0, não é tarefa aprovação
//	se 1, foi enviada para aprovação
//	se 2, foi aprovada pelo cliente
//	se 3, não foi aprovada pelo cliente
//	se 4, retorno de aprovação

if($acao=='enviarAprovacao') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 1 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}

if($acao=='cancelarAprovacao') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 0 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}

//Excluindo as tarefas
if($acao=='excluir') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("DELETE FROM tb_tarefas WHERE id = {$id}");

    //Deletando também todos os anexos referentes a esta tarefa
    $empresas = $conexao::exec("DELETE FROM tb_arquivos WHERE tb_arquivos_tarefas_id = {$id}");

    echo json_encode(array("status" => true));
}