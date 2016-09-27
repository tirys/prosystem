<?php
$nomedoProjeto = isset($_POST['nomedoProjeto']) ? $_POST['nomedoProjeto'] : '';
$dataProjeto = isset($_POST['dataProjeto']) ? $_POST['dataProjeto'] : '';
$descricaoProjeto = isset($_POST['descricaoProjeto']) ? $_POST['descricaoProjeto'] : '';
$empresaId = isset($_POST['empresaId']) ? $_POST['empresaId'] : '';
$idProjeto = isset($_POST['idProjeto']) ? $_POST['idProjeto'] : '';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');


$conexao = new classeConexao();
//Convertendo dados para versão mysql
$nomedoProjeto = mysqli_real_escape_string($conexao->obj(),$nomedoProjeto);
$descricaoProjeto = mysqli_real_escape_string($conexao->obj(),$descricaoProjeto);


if ($acao == 1) {

    $conexao = new classeConexao();
    $insert = $conexao::exec("INSERT INTO tb_projetos values (null,{$empresaId},'{$nomedoProjeto}','{$dataProjeto}',null,'{$descricaoProjeto}',1)");

    if ($insert) {
        header('location:../listar/projetos');
    }
}
else if ($acao == 2) {
    $conexao = new classeConexao();
   $update = $conexao::exec("UPDATE tb_projetos SET tb_projetos_nome = '{$nomedoProjeto}', tb_projetos_data_termino = '{$dataProjeto}', tb_projetos_descricao = '{$descricaoProjeto}' WHERE id = {$idProjeto}");

    if ($update) {
        //Trocar aqui por página do projeto depois
        header('location:../listar/projetos');
    }
}


