<?php

class VerificaLogin
{
    private $usuario = '';
    private $senha = '';

    public function verificaLogin($usuario,$senha)
    {
        //fazer o select aqui (pela model)

        //valores exemplos
//        $usuario = "jessica";
//        $senha = "jessica";

        //trocar por -> se encontrou no banco
        if($usuario=="jessica" && $senha=="jessica") {
            //Gravar em cookie e em sessão as informações do usuario para mantê-lo logado
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

