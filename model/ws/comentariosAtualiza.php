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

        $hoje = date("Y-m-d"); //pegando o dia de hoje
        $diaComentario = explode(" ",$comentario['tb_comentarios_data']); //separando dia da hora

        if($diaComentario[0]==$hoje) { //se o comentario foi hoje
            $diaComentario = explode(":",$diaComentario[1]); //cortar em horas, minutos e segundos

            $horario = "<span style='color:#9c9c9c'>hoje às " .$diaComentario[0].":".$diaComentario[1]."</span>"; //mostrar só a hora:minutos
        }
        else {
            $diaComentario = explode("-",$diaComentario[0]);

            $horario = "<span style='color:#9c9c9c'>em ".$diaComentario[2] . "/" . $diaComentario[1] . "/" . $diaComentario[0]."</span>"; //mostrar só o dia/mês/ano

        }

        $html .= '<span class="datetime"> '.$horario.'</span>';
        $html .= '<span class="body">';

        $html .= $comentario['tb_comentarios_texto'];
        $html .= '</span>';
        $html .= '</div>';
        $html .= '</li>';
    }

    echo json_encode(array("status" => $html));
}


