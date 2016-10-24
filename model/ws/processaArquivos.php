<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';

include('../../config/conexao.php');

$conexao = new classeConexao();

$projetos = $conexao::exec("DELETE FROM tb_arquivos WHERE id={$id}");

if($nome!='sem-anexo.jpg') { //só exclui se não for a imagem de sem anexo
    unlink('..\..\view\images\uploads\anexos/'.$nome);
}

echo json_encode(array("status" => 'true'));