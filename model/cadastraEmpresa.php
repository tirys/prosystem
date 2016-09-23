<?php
$nomeEmpresa = isset($_POST['nomedaEmpresa']) ? $_POST['nomedaEmpresa'] : '';
$enderecoEmpresa = isset($_POST['enderecoEmpresa']) ? $_POST['enderecoEmpresa'] : '';
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');

if ($acao == 1) {
    $conexao = new classeConexao();
    $insert = $conexao::exec("INSERT INTO tb_empresas (id,tb_empresas_nome,tb_empresas_endereco) values (null,'{$nomeEmpresa}','{$enderecoEmpresa}')");


    if ($insert) {
        header('location:../dashboard');
    }
}


