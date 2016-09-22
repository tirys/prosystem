<?php
//Dependencias
include('../config/config.php');
require ('../controller/verificalogin.php');


$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie,true);


$verificalogin = new VerificaLogin();
$resultado = $verificalogin->mataSessao($cookie['t']);

header('location:../logout');