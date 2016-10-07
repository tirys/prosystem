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
function DataBrasilSemHoras($Data)
{
    $Shoras = explode(" ",$Data);
    $D = explode("-",$Shoras[0]);
    $Data = $D[2].'/'.$D[1].'/'.$D[0];
    return $Data;
}

function RetiraAcentos($texto)
{
    $array1 = array(   "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
    , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
    $array2 = array(   "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
    , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
    return str_replace( $array1, $array2, $texto );
}


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
        $porcentagem = ($tarefasFeitas['qtd'] * 100) / ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);

        if($porcentagem==100) {
            $count++;
        }
    }

    return $count;
}


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
        $porcentagem = ($tarefasFeitas['qtd'] * 100) / ($tarefasFeitas['qtd'] + $tarefasFazer['qtd']);

        if($porcentagem!=100) {
            $count++;
        }
    }

    return $count;
}