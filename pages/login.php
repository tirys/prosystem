<?php
//Dependencias
include('../config/config.php');
require ('../controller/verificalogin.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$verificalogin = new VerificaLogin();
$resultado = $verificalogin->verificaLogin($usuario,$senha);

if($resultado==1) {
  header('location:../dashboard');
}
else {
    header('location:../errologin');
}
