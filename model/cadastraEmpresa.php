<?php
$nomeEmpresa = isset($_POST['nomedaEmpresa']) ? $_POST['nomedaEmpresa'] : '';
$enderecoEmpresa = isset($_POST['enderecoEmpresa']) ? $_POST['enderecoEmpresa'] : '';
$site = isset($_POST['sitedaEmpresa']) ? $_POST['sitedaEmpresa'] : '';
$email = isset($_POST['emaildaEmpresa']) ? $_POST['emaildaEmpresa'] : '';
$anotacao = isset($_POST['anotacaoEmpresa']) ? $_POST['anotacaoEmpresa'] : '';

$idEmpresa = isset($_POST['idEmpresa']) ? $_POST['idEmpresa'] : '';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');

$address = $enderecoEmpresa; // Google HQ
$prepAddr = str_replace(' ','+',$address);
$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;

echo $latitude;

if ($acao == 1) {
    $conexao = new classeConexao();

    $nomeEmpresa = mysqli_real_escape_string($conexao->obj(),$nomeEmpresa);
    $enderecoEmpresa = mysqli_real_escape_string($conexao->obj(),$enderecoEmpresa);
    $site = mysqli_real_escape_string($conexao->obj(),$site);
    $anotacao = mysqli_real_escape_string($conexao->obj(),$anotacao);

    $insert = $conexao::exec("INSERT INTO tb_empresas (id,tb_empresas_nome,tb_empresas_endereco,tb_empresas_email,tb_empresas_site,tb_empresas_status,tb_empresas_anotacao,tb_empresas_latitude,tb_empresas_longitude) values (null,'{$nomeEmpresa}','{$enderecoEmpresa}','{$email}','{$site}',1,'{$anotacao}','{$latitude}','{$longitude}')");


    if ($insert) {
        header('location:../listar/empresas');
    }
}

if ($acao == 2) {
    $conexao = new classeConexao();

    $nomeEmpresa = mysqli_real_escape_string($conexao->obj(),$nomeEmpresa);
    $enderecoEmpresa = mysqli_real_escape_string($conexao->obj(),$enderecoEmpresa);
    $site = mysqli_real_escape_string($conexao->obj(),$site);
    $anotacao = mysqli_real_escape_string($conexao->obj(),$anotacao);

    $insert = $conexao::exec("UPDATE tb_empresas SET tb_empresas_nome = '{$nomeEmpresa}',tb_empresas_endereco = '{$enderecoEmpresa}',tb_empresas_email = '{$email}',tb_empresas_site = '{$site}',tb_empresas_anotacao = '{$anotacao}', tb_empresas_latitude = '{$latitude}', tb_empresas_longitude = '{$longitude}' WHERE id = '{$idEmpresa}'");


    if ($insert) {
        header('location:../listar/empresas');
    }
}


