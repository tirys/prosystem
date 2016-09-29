<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

include('../../config/conexao.php');

$conexao = new classeConexao();
$projetos = $conexao::fetch("SELECT id, tb_projetos_nome FROM tb_projetos WHERE id_projetos_empresas_id = {$id}");

$html = '';

foreach ($projetos as $key => $projeto){

$html .= '<option value="'.$projeto['id'].'">'.$projeto['tb_projetos_nome'].'</option>';

}

echo json_encode(array("status" => $html));