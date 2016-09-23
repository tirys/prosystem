<?php
$nomeUsuario = isset($_POST['nomeUsuario']) ? $_POST['nomeUsuario'] : '';
$emailUsuario = isset($_POST['emailUsuario']) ? $_POST['emailUsuario'] : '';
$loginUsuario = isset($_POST['loginUsuario']) ? $_POST['loginUsuario'] : '';
$senhaUsuario = isset($_POST['senhaUsuario']) ? $_POST['senhaUsuario'] : '';
$cargaHoraria = isset($_POST['cargaHoraria']) ? $_POST['cargaHoraria'] : '';
$tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] : '';
$empresaUsuario = isset($_POST['empresaUsuario']) ? $_POST['empresaUsuario'] : '';
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');

if ($acao == 1) {
    $conexao = new classeConexao();
    $insert = $conexao::exec("INSERT INTO tb_usuarios (id,tb_usuarios_nome,tb_usuarios_email,tb_usuario_login,tb_usuario_senha,tb_usuarios_foto) values (null,'{$nomeUsuario}','{$emailUsuario}','{$loginUsuario}','{$senhaUsuario}',null)");

    if ($insert) {
        if($tipoUsuario == "cli" || $tipoUsuario == "fun"){
            $idUsuario = $conexao::fetchuniq("SELECT MAX(id) as id FROM tb_usuarios");
            if($tipoUsuario == "fun"){
                $insert = $conexao::exec("INSERT INTO tb_funcionarios (tb_funcioanios_usuario_id,tb_funcionarios_carga_horaria) values ('{$idUsuario[id]}','{$cargaHoraria}')");
                //echo("INSERT INTO tb_funcionarios (tb_funcionarios_usuario_id,tb_funcionarios_carga_horaria) values ('{$idUsuario[id]}','{$cargaHoraria}')");
            }elseif($tipoUsuario == "cli"){
                $insert = $conexao::exec("INSERT INTO tb_clientes (tb_clientes_usuario_id,tb_clientes_empresas_id) values ('{$idUsuario[id]}','{$empresaUsuario}')");
                //echo("INSERT INTO tb_clientes (tb_clientes_usuario_id,tb_clientes_empresas_id) values ('{$idUsuario[id]}','{$empresaUsuario}')");
            }

        }
        header('location:../listar/usuarios');
    }
}