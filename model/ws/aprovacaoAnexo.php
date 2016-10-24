<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : '';
$descricao = isset($_GET['descricao']) ? $_GET['descricao'] : '';
$data = date("Y-m-d H:i:s");

include('../../config/conexao.php');

if ($acao == 'aprovar') {

    $conexao = new classeConexao();
    $resultado = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_aprovado = 1 WHERE id = {$id}"); //1 para aprovado

    //inserir no log

    echo json_encode(array("status" => true));
}

if ($acao == 'rejeitar') {

    $conexao = new classeConexao();
    $resultado = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_aprovado = 2 WHERE id = {$id}"); //2 para reprovado


    //inserir no log

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