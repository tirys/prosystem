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
            setcookie( 'auth', json_encode( $cookieToken ), $expire, '/', 'agenciaprospecta.com.br', isset( $_SERVER["HTTPS"] ), false );

            $useragent = $_SERVER['HTTP_USER_AGENT'];

            if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
                $browser_version=$matched[1];
                $browser = 'IE';
            } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
                $browser_version=$matched[1];
                $browser = 'Opera';
            } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
                $browser_version=$matched[1];
                $browser = 'Firefox';
            } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
                $browser_version=$matched[1];
                $browser = 'Chrome';
            } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
                $browser_version=$matched[1];
                $browser = 'Safari';
            } else {
                $browser_version = 0;
                $browser= 'Outro';
            }

            $browser = $browser." v".$browser_version;

            $conexao::exec("INSERT INTO tb_sessao values (null,{$resultado['id']},'{$token}','{$browser}',null,null)");

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

