<?php

class Index
{
    private $nome = '';

    function __construct()
    {
        $this->nome = 'Sem nome';
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }
}

