<?php
$nomeEmpresa = isset($_POST['nomedaEmpresa']) ? $_POST['nomedaEmpresa'] : '';
$enderecoEmpresa = isset($_POST['enderecoEmpresa']) ? $_POST['enderecoEmpresa'] : '';
$site = isset($_POST['sitedaEmpresa']) ? $_POST['sitedaEmpresa'] : '';
$email = isset($_POST['emaildaEmpresa']) ? $_POST['emaildaEmpresa'] : '';
$anotacao = isset($_POST['anotacaoEmpresa']) ? $_POST['anotacaoEmpresa'] : '';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');

if ($acao == 1) {
    $conexao = new classeConexao();

    $nomeEmpresa = mysqli_real_escape_string($conexao->obj(),$nomeEmpresa);
    $enderecoEmpresa = mysqli_real_escape_string($conexao->obj(),$enderecoEmpresa);
    $site = mysqli_real_escape_string($conexao->obj(),$site);
    $anotacao = mysqli_real_escape_string($conexao->obj(),$anotacao);

    $insert = $conexao::exec("INSERT INTO tb_empresas (id,tb_empresas_nome,tb_empresas_endereco,tb_empresas_email,tb_empresas_site,tb_empresas_status,tb_empresas_anotacao) values (null,'{$nomeEmpresa}','{$enderecoEmpresa}','{$email}','{$site}',1,'{$anotacao}')");


    if ($insert) {
        header('location:../listar/empresas');
    }
}


