<?php
//Dependencias
require ('../lib/smarty/libs/Smarty.class.php');
include('../config.php');
require ('../controller/verificalogin.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$verificalogin = new VerificaLogin($usuario,$senha);


$resultado = $verificalogin->verificaLogin($usuario,$senha);

if($resultado==true) {
    echo 'Login efetuado';
    //chamar dashboard
}
