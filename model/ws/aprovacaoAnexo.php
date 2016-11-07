<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : '';
$usuarioAtual = isset($_GET['usuarioAtual']) ? $_GET['usuarioAtual'] : '';
$descricao = isset($_GET['descricao']) ? $_GET['descricao'] : '';
$data = date("Y-m-d H:i:s");

include('../../config/conexao.php');

if ($acao == 'aprovar') {

    $conexao = new classeConexao();
    $resultado = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_aprovado = 1 WHERE id = {$id}"); //1 para aprovado
    $resultado = $conexao::exec("INSERT INTO tb_observacoes VALUES (null,{$id},'{$descricao}',1)");

    $idTarefa = $conexao::fetchuniq("SELECT tb_arquivos_tarefas_id FROM tb_arquivos WHERE id = {$id}");


    $contagem = $conexao::fetchuniq("SELECT count(*) as qtd FROM tb_arquivos WHERE tb_arquivos_aprovado != 1 and tb_arquivos_tarefas_id = {$idTarefa['tb_arquivos_tarefas_id']}");


    if($contagem['qtd']==0 || $contagem['qtd']=="0") {

        $resultado = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_aprovacao = 3 WHERE id = {$idTarefa['tb_arquivos_tarefas_id']}");
    }

    include("../../config/Mail.php");
    $email = new Email();
    $email->enviarEmailAprovadoAnexo($usuarioAtual,$idTarefa['tb_arquivos_tarefas_id'],$id);

    //inserir no log a aprovação da tarefa

    echo json_encode(array("status" => true));
}

if ($acao == 'rejeitar') {

    $conexao = new classeConexao();
    $resultado = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_aprovado = 2 WHERE id = {$id}"); //2 para reprovado
    $resultado = $conexao::exec("INSERT INTO tb_observacoes VALUES (null,{$id},'{$descricao}',2)");


    //inserir no log a não aprovação da tarefa

    echo json_encode(array("status" => true));

}

if($acao == 'comentar') {

    $conexao = new classeConexao();

    //vendo se o arquivo acabou de ser aprovado ou não
    $aprovado = $conexao::fetchuniq("SELECT tb_arquivos_aprovado FROM tb_arquivos WHERE id = {$id}");

    if($aprovado==1) {
        $resultado = $conexao::exec("INSERT INTO tb_observacoes VALUES (null,{$id},'{$descricao}',1)");
    }
    else {
        $resultado = $conexao::exec("INSERT INTO tb_observacoes VALUES (null,{$id},'{$descricao}',2)");
    }

    echo json_encode(array("status" => true));
}