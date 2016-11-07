<?php
/*
 * Arquivo para funções gerais utilizadas no sistema
 * Funções úteis
 */


//Converte Data timestamp mysql para padrão BR
function DataBrasil($Data)
{
    $D = explode("-",$Data);
    $Data = $D[2].'/'.$D[1].'/'.$D[0];
    return $Data;
}

//Converte Data timestamp mysql para padrão BR sem as horas
function DataBrasilSemHoras($Data)
{
    $Shoras = explode(" ",$Data);
    $D = explode("-",$Shoras[0]);
    $Data = $D[2].'/'.$D[1].'/'.$D[0];
    return $Data;
}

//retira acentos de uma string e a retorna
function RetiraAcentos($texto)
{
    $array1 = array(   "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
    , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
    $array2 = array(   "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
    , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
    return str_replace( $array1, $array2, $texto );
}

//retorna apenas a primeira palavra
function PrimeiraPalavra($param)
{
    $output = '';
    $sigh = explode(' ', $param);
    foreach ($sigh as $i => $single_word) {
        if ($i == 0) {
            $output .= $single_word;
        } else {
            break;
        }
    }
    echo $output;

}

//retorna a quantidade de projetos realizados
function ProjetosRealizados() {

    $count = 0;
    $conexao = new classeConexao();

    //selecionando id dos projetos
    $projetos = $conexao::fetch("SELECT id FROM tb_projetos");

    foreach ($projetos as $projeto) {

        //Qtd tarefas a fazer
        $tarefasFazer = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=0 AND tb_tarefas_projeto = ".$projeto['id']);

        //Qtd tarefas feitas
        $tarefasFeitas = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=1 AND tb_tarefas_projeto = ".$projeto['id']);

        //Porcentagem
        if(($tarefasFeitas['qtd'] + $tarefasFazer['qtd']) == 0){
            $qtd1 = 1;
        }else{
            $qtd1 = ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);
        }

        $porcentagem = ($tarefasFeitas['qtd'] * 100) / ($qtd1);

        if($porcentagem==100) {
            $count++;
        }
    }

    return $count;
}

//retorna a quantidade de projetos realizados do cliente atual
function ProjetosRealizadosCliente($empresa = null) {

    $count = 0;
    $conexao = new classeConexao();

    //selecionando id dos projetos
    $projetos = $conexao::fetch("SELECT id FROM tb_projetos WHERE id_projetos_empresas_id = {$empresa}");

    foreach ($projetos as $projeto) {

        //Qtd tarefas a fazer
        $tarefasFazer = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=0 AND tb_tarefas_projeto = ".$projeto['id']);

        //Qtd tarefas feitas
        $tarefasFeitas = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=1 AND tb_tarefas_projeto = ".$projeto['id']);

        //Porcentagem
        if(($tarefasFeitas['qtd'] + $tarefasFazer['qtd']) == 0){
            $qtd2 = 1;
        }else{
            $qtd2 = ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);
        }
        $porcentagem = ($tarefasFeitas['qtd'] * 100) / ($qtd2);

        if($porcentagem==100) {
            $count++;
        }
    }

    return $count;
}

//retorna a quantidade de projetos pendentes
function ProjetosPendentes() {

    $count = 0;
    $conexao = new classeConexao();

    //selecionando id dos projetos
    $projetos = $conexao::fetch("SELECT id FROM tb_projetos");

    foreach ($projetos as $projeto) {

        //Qtd tarefas a fazer
        $tarefasFazer = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=0 AND tb_tarefas_projeto = ".$projeto['id']);

        //Qtd tarefas feitas
        $tarefasFeitas = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=1 AND tb_tarefas_projeto = ".$projeto['id']);

        //Porcentagem
        if(($tarefasFeitas['qtd'] + $tarefasFazer['qtd']) == 0){
            $qtd3 = 1;
        }else{
            $qtd3 = ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);
        }
        $porcentagem = ($tarefasFeitas['qtd'] * 100) / ($qtd3);

        if($porcentagem!=100) {
            $count++;
        }
    }

    return $count;
}

//retorna a quantidade de projetos pendentes de um cliente específico
function ProjetosPendentesCliente($empresa = null) {

    $count = 0;
    $conexao = new classeConexao();

    //selecionando id dos projetos
    $projetos = $conexao::fetch("SELECT id FROM tb_projetos WHERE id_projetos_empresas_id = {$empresa}");

    foreach ($projetos as $projeto) {

        //Qtd tarefas a fazer
        $tarefasFazer = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=0 AND tb_tarefas_projeto = ".$projeto['id']);

        //Qtd tarefas feitas
        $tarefasFeitas = $conexao::fetchuniq("SELECT COUNT(id) as qtd FROM tb_tarefas WHERE tb_tarefas_status=1 AND tb_tarefas_projeto = ".$projeto['id']);

        //Porcentagem
        if(($tarefasFeitas['qtd'] + $tarefasFazer['qtd']) == 0){
            $qtd4 = 1;
        }else{
            $qtd4 = ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);
        }
        $porcentagem = ($tarefasFeitas['qtd'] * 100) / ($qtd4);

        if($porcentagem!=100) {
            $count++;
        }
    }

    return $count;
}

//retorna os logs de acordo com o seu tipo
function AtividadesRecentesGeral($logs_descricao = "", $logs_id_referencia = 0,$usuarios_nome = "", $logs_data = ""){

    $conexao = new classeConexao();

    if($logs_descricao=='atualizou a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-edit';
        $label = 'label-warning';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='completou a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-check';
        $label = 'label-success';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='reativou a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-arrow-up';
        $label = 'label-danger';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='pausou a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-pause';
        $label = 'label-primary';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='aprovou a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-check';
        $label = 'label-success';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='reprovou a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-times';
        $label = 'label-danger';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='enviou para aprovação a tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-mail-forward';
        $label = 'label-info';
        $url = 'editar/tarefa/';
    }
    else if ($logs_descricao=='cancelou a aprovação da tarefa') {
        $tarefa = $conexao::fetchuniq("SELECT tb_tarefas_nome FROM tb_tarefas WHERE id = ".$logs_id_referencia);
        $item = $tarefa['tb_tarefas_nome'];
        $img = 'fa-times';
        $label = 'label-warning';
        $url = 'editar/tarefa/';
    }

    //$exibeHTML = '<li><div class="col1" style="width:98%;"><div class="cont"><div class="cont-col1"><div class="label label-sm '.$label.'"><i class="fa '.$imagem.'"></i></div></div><div class="cont-col2">';
    //$exibeHTML .= '<div class="desc">O usuário <a href="">'.$usuarios_nome.'</a> '.$logs_descricao.' <a href="'.$url.$logs_id_referencia.'">'.$item.'</a></div></div></div></div><div class="col2">'.'<div class="date">'.DataBrasilSemHoras($logs_data).'</div></div></li>';

    //return $exibeHTML;

    echo '<li>';
    echo '<div class="col1" style="width:98%;">';
    echo '<div class="cont">';
    echo '<div class="cont-col1">';
    echo '<div class="label label-sm '.$label.'">';
    echo '<i class="fa '.$img.'"></i>';
    echo '</div>';
    echo '</div>';
    echo '<div class="cont-col2">';



    echo '<div class="desc">O usuário <a href="">'.$usuarios_nome.'</a> '.$logs_descricao.' <a href="'.$url.$logs_id_referencia.'">'.$item.'</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col2">';
    echo '<div class="date">'.DataBrasilSemHoras($logs_data).'</div>';
    echo '</div>';
    echo '</li>';
    
}
