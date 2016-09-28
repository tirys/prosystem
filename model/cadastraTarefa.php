<?php
$nomedaTarefa = isset($_POST['nomedaTarefa']) ? $_POST['nomedaTarefa'] : '';
$empresaId = isset($_POST['empresaId']) ? $_POST['empresaId'] : '';
$projetoID = isset($_POST['projetoID']) ? $_POST['projetoID'] : '';
$funcionarioID = isset($_POST['funcionarioID']) ? $_POST['funcionarioID'] : '';
$dataTarefa = isset($_POST['dataTarefa']) ? $_POST['dataTarefa'] : '';
$tempoEstimado = isset($_POST['tempoEstimado']) ? $_POST['tempoEstimado'] : '';
$prioridade = isset($_POST['prioridade']) ? $_POST['prioridade'] : '';
$oculto = isset($_POST['oculto']) ? $_POST['oculto'] : '';
$descricaoTarefa = isset($_POST['descricaoTarefa']) ? $_POST['descricaoTarefa'] : '';
$criador = isset($_POST['criador']) ? $_POST['criador'] : '';
$idTarefa = isset($_POST['idTarefa']) ? $_POST['idTarefa'] : '';

if($oculto=='') {
    $oculto = 0;
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');


$conexao = new classeConexao();

//Convertendo dados para versão mysql
$nomedaTarefa = mysqli_real_escape_string($conexao->obj(),$nomedaTarefa);
$descricaoTarefa = mysqli_real_escape_string($conexao->obj(),$descricaoTarefa);


if ($acao == 1) {
    $conexao = new classeConexao();
    echo "INSERT INTO tb_tarefas values (null,'{$nomedaTarefa}','{$descricaoTarefa}','{$dataTarefa}',null,NOW(),{$tempoEstimado},null,1,{$oculto},{$criador},{$prioridade},{$projetoID},{$funcionarioID})";
    $insert = $conexao::exec("INSERT INTO tb_tarefas values (null,'{$nomedaTarefa}','{$descricaoTarefa}','{$dataTarefa}',null,NOW(),{$tempoEstimado},null,1,{$oculto},{$criador},{$prioridade},{$projetoID},{$funcionarioID})");

    if ($insert) {
        header('location:../listar/tarefas');
    }
}
else if ($acao == 2) {
    $conexao = new classeConexao();
    $update = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_nome = '{$nomedaTarefa}', tb_tarefas_descricao = '{$descricaoTarefa}', tb_tarefas_data_termino = '{$dataTarefa}', tb_tarefas_horas = {$tempoEstimado}, tb_tarefas_oculto = {$oculto}, tb_tarefas_prioridade = {$prioridade}, tb_tarefas_projeto = {$projetoID}, tb_tarefas_funcionario = {$funcionarioID} WHERE id = {$idTarefa}");

    if ($update) {
        //Trocar aqui por página do projeto depois
        header('location:../listar/projetos');
    }
}


