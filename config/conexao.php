<?php
include('config.php');

class classeConexao
{

    protected $user = USER_DB; // Usuário do banco de dados
    protected $senha = PASS_DB; // Senha do banco de dados
    protected $bd = NAME_DB; // Nome do Banco de dados MySQL
    protected $server = HOST_DB; // Host – servidor
    protected $con;


    //Construtor
    public function __construct()
    {
        $this->con = mysqli_connect($this->server, $this->user, $this->senha, $this->bd) or die('Falha ao conectar com o banco de dados');
    }

    //Retorna o objeto da conexão
    public function obj()
    {
        return $this->con;
    }

    //Encerra a conexão
    public function desconectar()
    {
        mysqli_close($this->con);
    }

    public function ultimo_id()
    {
        return mysqli_insert_id($this->con);
    }

    //Executa query sql e retorna consulta
    public function consulta($sql)
    {
        $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if (!$res) {
            return false;
        } else {
            if (substr($sql, 0, 6) == 'INSERT' && mysqli_insert_id($this->con)) {
                return mysqli_insert_id($this->con);
            } else {
                return $res;
            }
        }
        mysqli_free_result($res);
    }

    //Número de resultados que atendem a uma dada consulta
    public function conta($res)
    {
        if ($res) {
            return mysqli_num_rows($res);
        } else {
            return false;
        }
    }

    //Retorna Array (object) com resultado do select
    public function busca($res)
    {
        if ($res) {
            return mysqli_fetch_array($res, MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    //Realiza uma consulta
    public static function query($query_str)
    {
        $conexao = new classeConexao();
        if ($consulta = $conexao->consulta($query_str)) {
            return true;
        }

        return false;
    }

    public static function object()
    {
        $conexao = new classeConexao();
        return $conexao->obj();
    }

    //Executa uma query mysql (insert,update,etc)
    public static function exec($query_str)
    {
        $conexao = new classeConexao();
        if ($consulta = $conexao->consulta($query_str)) {
            return true;
        }

        return false;

    }

    //Conta a quantidade de uma query
    public static function count($query_str)
    {
        $conexao = new classeConexao();
        $consulta = $conexao->consulta($query_str);
        $count = $conexao->conta($consulta);
        $conexao->desconectar();
        if ($count) {
            return $count;
        }
        return false;
    }

    //Retorna um array comum com os resultados
    public static function fetch($query_str)
    {
        $results = array();
        $conexao = new classeConexao();
        $consulta = $conexao->consulta($query_str);
        while ($dados = $conexao->busca($consulta)) {
            array_push($results, $dados);
        }
        $conexao->desconectar();
        return $results;
    }

    //Retorna apenas 1 linha de resultado
    public static function fetchuniq($query_str)
    {
        $results = array();
        $conexao = new classeConexao();
        $consulta = $conexao->consulta($query_str);
        while ($dados = $conexao->busca($consulta)) {
            array_push($results, $dados);

        }
        $conexao->desconectar();
        return array_shift($results);
    }


}

?>
