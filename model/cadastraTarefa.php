<?php
$nomedaTarefa = isset($_POST['nomedaTarefa']) ? $_POST['nomedaTarefa'] : '';
$empresaId = isset($_POST['empresaId']) ? $_POST['empresaId'] : '';
$projetoID = isset($_POST['projetoID']) ? $_POST['projetoID'] : '';
$funcionarioID = isset($_POST['funcionarioID']) ? $_POST['funcionarioID'] : '';
$dataTarefa = isset($_POST['dataTarefa']) ? $_POST['dataTarefa'] : '';
$tempoEstimado = isset($_POST['tempoEstimado']) ? $_POST['tempoEstimado'] : '';
$prioridade = isset($_POST['prioridade']) ? $_POST['prioridade'] : '';
$oculto = isset($_POST['oculto']) ? $_POST['oculto'] : '';
$descricaoTarefa = isset($_POST['descricaoTarefa']) ? $_POST['descricaoTarefa'] : '';
$criador = isset($_POST['criador']) ? $_POST['criador'] : '';
$idTarefa = isset($_POST['idTarefa']) ? $_POST['idTarefa'] : '';

if($oculto=='') {
    $oculto = 0;
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

include('../config/conexao.php');


$conexao = new classeConexao();

//Convertendo dados para versão mysql
$nomedaTarefa = mysqli_real_escape_string($conexao->obj(),$nomedaTarefa);
$descricaoTarefa = mysqli_real_escape_string($conexao->obj(),$descricaoTarefa);


if ($acao == 1) {

    $conexao = new classeConexao();
    $insert = $conexao::exec("INSERT INTO tb_tarefas values (null,'{$nomedaTarefa}','{$descricaoTarefa}','{$dataTarefa}',null,NOW(),{$tempoEstimado},null,0,{$oculto},{$criador},{$prioridade},{$projetoID},{$funcionarioID})");

    if ($insert) {
        header('location:../listar/tarefas');
    }
}
else if ($acao == 2) {

    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../view/images/uploads/anexos/';
// Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
// Array com as extensões permitidas
    $_UP['extensoes'] = array('jpg', 'png', 'gif');
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = false;
// Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['anexo1']['error'] != 0) {
        die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['anexo1']['error']]);
        exit; // Para a execução do script
    }
// Faz a verificação do tamanho do arquivo
    if ($_UP['tamanho'] < $_FILES['anexo1']['size']) {
        echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
        exit;
    }
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
// Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia'] == true) {
        // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
        $nome_final = md5(time()).'.jpg';
    } else {
        // Mantém o nome original do arquivo
        $nome_final = $_FILES['anexo1']['name'];
    }

// Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['anexo1']['tmp_name'], $_UP['pasta'] . $nome_final)) {
        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
        //echo "Upload efetuado com sucesso!";
        //echo '<a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';

    } else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
    }


    $conexao = new classeConexao();
    $update = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_nome = '{$nomedaTarefa}', tb_tarefas_descricao = '{$descricaoTarefa}', tb_tarefas_data_termino = '{$dataTarefa}', tb_tarefas_horas = {$tempoEstimado}, tb_tarefas_oculto = {$oculto}, tb_tarefas_prioridade = {$prioridade}, tb_tarefas_projeto = {$projetoID}, tb_tarefas_funcionario = {$funcionarioID} WHERE id = {$idTarefa}");

    if ($update) {
        //Trocar aqui por página do projeto depois
        header('location:../listar/tarefas');
    }
}


