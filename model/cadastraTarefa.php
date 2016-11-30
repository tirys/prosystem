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
$qtdAnexo = isset($_POST['numero-anexos']) ? $_POST['numero-anexos'] : '';
$tempoGasto = isset($_POST['tempoGasto']) ? $_POST['tempoGasto'] : '';
$legendaTarefa = isset($_POST['legendaTarefa']) ? $_POST['legendaTarefa'] : '';
$tarefaStatus = isset($_POST['tarefaStatus']) ? $_POST['tarefaStatus'] : '';

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
    $insert = $conexao::exec("INSERT INTO tb_tarefas values (null,'{$nomedaTarefa}','{$descricaoTarefa}','{$dataTarefa}',null,NOW(),{$tempoEstimado},{$tempoGasto},{$tarefaStatus},{$oculto},{$criador},{$prioridade},{$projetoID},{$funcionarioID},0,'{$legendaTarefa}',0)");
    $ultimoID = $conexao::fetchuniq("SELECT max(id) as ultimo FROM tb_tarefas");

    $data = date("Y-m-d H:i:s");
    //Inserindo no log

    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$criador},'criou a tarefa','{$data}','tarefa',{$ultimoID['ultimo']})");


    for($i=1;$i<=$qtdAnexo;$i++) {
        $descricao = '';

        if($_FILES['anexo'.$i]['name']!='') {
            $descricao = isset($_POST['descricaoAnexo'.$i]) ? $_POST['descricaoAnexo'.$i] : ''; //pegando descricao

            // Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../view/images/uploads/anexos/';
            // Tamanho máximo do arquivo (em Bytes)
            $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
            // Renomeia o arquivo?
            $_UP['renomeia'] = false;

            // Faz a verificação do tamanho do arquivo
            if ($_UP['tamanho'] < $_FILES['anexo' . $i]['size']) {
                echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
                exit;
            }
            $extensao = strtolower(end(explode('.', $_FILES['anexo' . $i]['name'])));

            // Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) {
                // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = time() . '_' . rand(1, 100) . '.' . $extensao;
            } else {
                // Mantém o nome original do arquivo
                $nome_final = $_FILES['anexo' . $i]['name'];
            }

            // Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['anexo' . $i]['tmp_name'], $_UP['pasta'] . $nome_final)) {

            } else {
                echo "Não foi possível enviar o arquivo, tente novamente";
            }

            $inserirAnexo = $conexao::exec("INSERT INTO tb_arquivos values (null,{$ultimoID['ultimo']},'anexos','{$nome_final}','{$extensao}','{$descricao}',0)");
        }
        else if($_POST['descricaoAnexo'.$i]!='') {
            $descricao = isset($_POST['descricaoAnexo'.$i]) ? $_POST['descricaoAnexo'.$i] : ''; //pegando descricao
            $inserirAnexo = $conexao::exec("INSERT INTO tb_arquivos values (null,{$ultimoID['ultimo']},'anexos','sem-anexo.jpg','jpg','{$descricao}',0)");
        }
    }

    if ($insert) {
        header('location:../listar/tarefas');
    }
}
else if ($acao == 2) {

    $conexao = new classeConexao();
    $update = $conexao::exec("UPDATE tb_tarefas SET tb_tarefas_nome = '{$nomedaTarefa}', tb_tarefas_descricao = '{$descricaoTarefa}', tb_tarefas_data_termino = '{$dataTarefa}', tb_tarefas_horas = {$tempoEstimado}, tb_tarefas_horas_gastas = {$tempoGasto}, tb_tarefas_oculto = {$oculto}, tb_tarefas_prioridade = {$prioridade}, tb_tarefas_projeto = {$projetoID}, tb_tarefas_funcionario = {$funcionarioID}, tb_tarefas_legenda = '{$legendaTarefa}', tb_tarefas_status = {$tarefaStatus} WHERE id = {$idTarefa}");

    $data = date("Y-m-d H:i:s");
    //Inserindo no log
    $inserirLog = $conexao::exec("INSERT INTO tb_logs VALUES (null,{$criador},'atualizou a tarefa','{$data}','tarefa',{$idTarefa})");

    $qtdAnexoEditado = $_POST['qtdAnexoEditado']; //pegando a quantidade de anexos anteriores

    for($i=1;$i<=$qtdAnexoEditado;$i++) {

        $anexoEditadoId = $_POST['anexoEditadoId'.($i-1)]; //pegando o id do anexo a ser editado

        $anexoEditadoDados = $conexao::fetchuniq("SELECT * FROM tb_arquivos WHERE id=".$anexoEditadoId);

        if($anexoEditadoDados['tb_arquivos_nome']!='sem-anexo.jpg' && $anexoEditadoDados['tb_arquivos_nome']!='') { //só exclui se não for a imagem de sem anexo
            unlink('..\..\view\images\uploads\anexos/'.$anexoEditadoDados['tb_arquivos_nome']);
        }
        echo $_FILES['anexoEditado'.$anexoEditadoId]['name'];
        if($_FILES['anexoEditado'.$anexoEditadoId]['name']!=null) {
            //$descricao = isset($_POST['descricaoAnexo'.$i]) ? $_POST['descricaoAnexo'.$i] : ''; //pegando descricao

            // Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../view/images/uploads/anexos/';
            // Tamanho máximo do arquivo (em Bytes)
            $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
            // Renomeia o arquivo?
            $_UP['renomeia'] = false;

            // Faz a verificação do tamanho do arquivo
            if ($_UP['tamanho'] < $_FILES['anexoEditado'.$anexoEditadoId]['size']) {
                echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
                exit;
            }
            $extensao = strtolower(end(explode('.',$_FILES['anexoEditado'.$anexoEditadoId]['name'])));

            // Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) {
                // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = time() . '_' . rand(1, 100) . '.' . $extensao;
            } else {
                // Mantém o nome original do arquivo
                $nome_final = $_FILES['anexoEditado'.$anexoEditadoId]['name'];
            }

            // Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['anexoEditado'.$anexoEditadoId]['tmp_name'], $_UP['pasta'] . $nome_final)) {

            } else {
                echo "Não foi possível enviar o arquivo, tente novamente";
            }

            $inserirAnexo = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_nome='{$nome_final}' WHERE id=".$anexoEditadoId);
        }

        $descricaoNova = $_POST['editarAnexoTexto'.$anexoEditadoId];
        $inserirAnexo = $conexao::exec("UPDATE tb_arquivos SET tb_arquivos_descricao='{$descricaoNova}' WHERE id=".$anexoEditadoId);
    }

    for($i=1;$i<=$qtdAnexo;$i++) {

        $descricao = '';

        if($_FILES['anexo'.$i]['name']!='') {
            $descricao = isset($_POST['descricaoAnexo'.$i]) ? $_POST['descricaoAnexo'.$i] : ''; //pegando descricao

            // Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../view/images/uploads/anexos/';
            // Tamanho máximo do arquivo (em Bytes)
            $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
            // Renomeia o arquivo?
            $_UP['renomeia'] = false;

            // Faz a verificação do tamanho do arquivo
            if ($_UP['tamanho'] < $_FILES['anexo' . $i]['size']) {
                echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
                exit;
            }
            $extensao = strtolower(end(explode('.', $_FILES['anexo' . $i]['name'])));

            // Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) {
                // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = time() . '_' . rand(1, 100) . '.' . $extensao;
            } else {
                // Mantém o nome original do arquivo
                $nome_final = $_FILES['anexo' . $i]['name'];
            }

            // Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['anexo' . $i]['tmp_name'], $_UP['pasta'] . $nome_final)) {

            } else {
                echo "Não foi possível enviar o arquivo, tente novamente";
            }

            $inserirAnexo = $conexao::exec("INSERT INTO tb_arquivos values (null,{$idTarefa},'anexos','{$nome_final}','{$extensao}','{$descricao}',0)");
        }
        else if($_POST['descricaoAnexo'.$i]!='') {
            $descricao = isset($_POST['descricaoAnexo'.$i]) ? $_POST['descricaoAnexo'.$i] : ''; //pegando descricao
            $inserirAnexo = $conexao::exec("INSERT INTO tb_arquivos values (null,{$idTarefa['ultimo']},'anexos','sem-anexo.jpg','jpg','{$descricao}',0)");
        }
    }


    if ($update) {
        //Trocar aqui por página do projeto ou da tarefa depois
        header('location:../listar/tarefas');
    }
}


