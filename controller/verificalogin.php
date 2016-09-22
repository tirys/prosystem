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
            setcookie( 'auth', json_encode( $cookieToken ), $expire, '/', URL_INSTALACAO, isset( $_SERVER["HTTPS"] ), true );

            $conexao::exec("INSERT INTO tb_sessao values (null,{$resultado['id']},'{$token}',null,null,null)");

            return true;
        }
        else {
            return false;
        }
    }

    public function setUsuario($usuario,$senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }
}

