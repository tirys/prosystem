<?php
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$idTarefa = isset($_GET['idTarefa']) ? $_GET['idTarefa'] : '';


include('../../config/conexao.php');

//Ativando as empresas
if($acao=='listar') {
    $conexao = new classeConexao();

    $comentariosTarefa = $conexao::fetch("SELECT tc.*, tu.* FROM tb_comentarios tc, tb_usuarios tu WHERE tc.tb_comentarios_usuario_id = tu.id AND tc.tb_comntarios_tarefas_id = {$idTarefa}");

    $ultimoComentario = 0;
    $ultimoLado = 'out';
    $html = '';

    foreach ($comentariosTarefa as $key => $comentario) {

        if ($ultimoComentario == $comentario['id']) {
            $html .= '<li class="' . $ultimoLado . '">';
        }
        else {
            if($ultimoLado=='out') {
                $ultimoLado = 'in';
            }
            else {
                $ultimoLado = 'out';
            }

            $html .= '<li class="' . $ultimoLado . '">';
        }

        $ultimoComentario = $comentario['id'];

        $html .= '<img class="avatar" alt="" src="view/images/'.$comentario['tb_usuarios_foto'].'" />';
        $html .= '<div class="message">';
        $html .= '<span class="arrow"> </span>';
        $html .= '<a href="javascript:;" class="name">'.$comentario['tb_usuarios_nome'].'</a>';
        $html .= '<span class="datetime"> at 20:11 </span>';
        $html .= '<span class="body">';

        $html .= $comentario['tb_comentarios_texto'];
        $html .= '</span>';
        $html .= '</div>';
        $html .= '</li>';
    }

    echo json_encode(array("status" => $html));
}


