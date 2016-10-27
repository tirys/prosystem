<?php

include('../config/conexao.php');

class VerificaLogin
{
    private $usuario = '';
    private $senha = '';

    public function __construct()
    {

    }

    public function verificaLogin($usuario,$senha)
    {
        //Ver se da pra fazer pela model
        $conexao = new classeConexao();
        $resultado = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE tb_usuarios_email = '{$usuario}' and tb_usuario_senha = '{$senha}'");

        //Se o resultado é maior que 0, ou seja, encontrou o usuario:
        if(count($resultado)>0) {
            $token = sha1( uniqid( mt_rand() + time(), true ) );
            $idSessao = md5( uniqid( mt_rand(), true ) );

            //Criação do Cookie de login
            $expire = ( time() + ( 30 * 24 * 3600 ) ); // O cookie não deve ser eterno.
            $cookieToken = array(
                'i' => $idSessao,
                't' => $token
            );
            setcookie( 'auth', json_encode( $cookieToken ), $expire, '/', 'localhost', isset( $_SERVER["HTTPS"] ), false );

            $conexao::exec("INSERT INTO tb_sessao values (null,{$resultado['id']},'{$token}',null,null,null)");

            return true;
        }
        else {
            return false;
        }
    }

    public  function verificaToken($token) {
        //Ver se da pra fazer pela model
        $conexao = new classeConexao();
        $resultado = $conexao::fetchuniq("SELECT * FROM tb_sessao WHERE tb_sessao_token = '{$token}'");

        if(count($resultado)>0) {

            $idSessao = md5( uniqid( mt_rand(), true ) );
            $expire = ( time() + ( 30 * 24 * 3600 ) ); // O cookie não deve ser eterno.
            $cookieToken = array(
                'i' => $idSessao,
                't' => $token
            );
            return true;
        }
        else {
            unset($_COOKIE['auth']);
            return false;
        }
    }

    public function mataSessao($token) {
        //Ver se da pra fazer pela model
        $conexao = new classeConexao();
        $resultado = $conexao::exec("DELETE FROM tb_sessao WHERE tb_sessao_token = '{$token}'");

        unset($_COOKIE['auth']);
        return true;
    }

    public function setUsuario($usuario,$senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }
}

