<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

include('../../config/conexao.php');

//Ativando as empresas
if($acao=='reativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_usuarios SET tb_usuarios_status = 1 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}


//Desativando as empresas
if($acao=='desativar') {
    $conexao = new classeConexao();
    $empresas = $conexao::exec("UPDATE tb_usuarios SET tb_usuarios_status = 0 WHERE id = {$id}");
    echo json_encode(array("status" => true));
}

