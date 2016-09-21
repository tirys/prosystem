<?php
//Dependencias
require ('../lib/smarty/libs/Smarty.class.php');
include('../config.php');
require ('../controller/verificalogin.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$verificalogin = new VerificaLogin($usuario,$senha);


$resultado = $verificalogin->verificaLogin($usuario,$senha);

if($resultado==1) {
    //Smarty configs
    $smarty = new Smarty;
    $smarty->caching = true;
    $smarty->cache_lifetime = 120;

    $smarty->assign("url",URL_INSTALACAO);
    $smarty->display('../view/dashboard.tpl');
}
