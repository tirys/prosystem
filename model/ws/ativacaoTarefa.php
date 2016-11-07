<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : '';

include('../../config/conexao.php');


//Ativando as tarefas
if($acao=='reativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 1 WHERE id = {$id}");

    //Inserindo no log
    $data = date("Y-m-d H:i:s");
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'completou a tarefa','{$data}','tarefa',{$id})");

    echo json_encode(array("status" => true));
}


//Desativando as tarefas
if($acao=='desativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 0 WHERE id = {$id}");

    //Inserindo no log
    $data = date("Y-m-d H:i:s");
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'reativou a tarefa','{$data}','tarefa',{$id})");


    echo json_encode(array("status" => true));
}

//Pausando as tarefas
if($acao=='pausar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_status = 3 WHERE id = {$id}");

    //Inserindo no log
    $data = date("Y-m-d H:i:s");
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'pausou a tarefa','{$data}','tarefa',{$id})");


    echo json_encode(array("status" => true));
}

if($acao=='voltarCriador') {
    $idCriador = isset($_GET['idCriador']) ? $_GET['idCriador'] : '';

    $conexao = new classeConexao();

    //voltando a tarefa para o criador
    $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_funcionario = {$idCriador} WHERE id = {$id}");

    //enviar email para o criador aqui

    echo json_encode(array("status" => true));
}

//Enviando para aprovação

//  se 0, não é tarefa aprovação
//	se 1, foi enviada para aprovação
//	se 2, foi aprovada pelo cliente
//	se 3, não foi aprovada pelo cliente

if($acao=='enviarAprovacao') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 1 WHERE id = {$id}");
    echo json_encode(array("status" => true));

    $data = date("Y-m-d H:i:s");
    //Inserindo no log
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'enviou para aprovação a tarefa','{$data}','aprovacao',{$id})");

    $alterarAnexos = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_aprovado = 0 WHERE tb_arquivos_tarefas_id = {$id}");

}

if($acao=='cancelarAprovacao') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 0 WHERE id = {$id}");
    echo json_encode(array("status" => true));

    $data = date("Y-m-d H:i:s");
    //Inserindo no log
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$idUsuario},'cancelou a aprovação da tarefa','{$data}','aprovacao',{$id})");
}

//Excluindo as tarefas
if($acao=='excluir') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("DELETE FROM tb_tarefas WHERE id = {$id}");

    //Deletando também todos os anexos referentes a esta tarefa
    $arquivos = $conexao::fetch("SELECT * FROM tb_arquivos WHERE tb_arquivos_tarefas_id = {$id}");

    //deletar os arquivos também da pasta
    foreach ($arquivos as $arquivo) {
        if($arquivos['tb_arquivos_nome']!='sem-anexo.jpg') { //só exclui se não for a imagem de sem anexo
            unlink('..\..\view\images\uploads\anexos/'.$arquivos['tb_arquivos_nome']);
        }
    }
    
//    $empresas = $conexao::exec("DELETE FROM tb_arquivos WHERE tb_arquivos_tarefas_id = {$id}");

    //Deletando também todos os anexos referentes a esta tarefa
    $empresas = $conexao::exec("DELETE FROM tb_logs WHERE tb_logs_tipo = 'tarefas' AND  tb_logs_id_referencia = {$id}");

    echo json_encode(array("status" => true));
}


if($acao == 'emailAtribuido') {

    $usuarioAtual =  isset($_GET['usuarioAtual']) ? $_GET['usuarioAtual'] : '';
    $funcionarioNovo =  isset($_GET['funcionarioNovo']) ? $_GET['funcionarioNovo'] : '';

    include("../../config/Mail.php");
    $email = new Email();
    $email->enviarEmailAtibuido($funcionarioNovo ,$usuarioAtual,$id);

}