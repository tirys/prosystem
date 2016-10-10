<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : '';
$idTarefa = isset($_GET['idTarefa']) ? $_GET['idTarefa'] : '';
$comentario = isset($_GET['comentario']) ? $_GET['comentario'] : '';
$data = date("Y-m-d H:i:s");

include('../../config/conexao.php');

//Ativando as empresas
if($acao=='inserir') {
    $conexao = new classeConexao();

    $empresas = $conexao::exec("INSERT INTO tb_comentarios VALUES (null, {$idUsuario}, {$idTarefa}, '{$data}', '{$comentario}')");
    echo json_encode(array("status" => true));
}


