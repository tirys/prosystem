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