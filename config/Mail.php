<?php
    require_once ('pacoteClasses.php');
    require_once ('funcoes.php');


 class Email {

    public function criarEstrutura() {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->SMTPDebug  = 0;
        $email->setLanguage("br","proton/tools/phpmailer_v51/language/");
        $email->SMTPAuth   = true;
        $email->SMTPAutoTLS = false;
        $email->Host       = "smtp.agenciaprospecta.com.br";
        $email->Port       = 587;
        $email->Username   = "send@agenciaprospecta.com.br";
        $email->Password   = "prospecta14";
        $email->addReplyTo($email,'Reply');
        $email->setFrom('send@agenciaprospecta.com.br', 'Prospecta');

        return $email;
    }

     public function enviarEmailAtibuido($quemAtribuido, $quemAtribuiu, $tarefaId) {
         $conexao = new classeConexao();
         $email = new PHPMailer();
         $email = $this->criarEstrutura();



         $atribuido = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemAtribuido}");

         $atribuiu = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemAtribuiu}");

         $tarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = {$tarefaId}");

         $email->addAddress("{$atribuido['tb_usuarios_email']}", "{$atribuido['tb_usuarios_nome']}");
         $email->Subject = "[".utf8_decode(' SISTEMA PROSPECTA ')."] - Tarefa: ".utf8_decode($tarefa['tb_tarefas_nome'])."";

         $mensagem = '<style type="text/css"> body {margin-bottom:0; margin:0} </style>';
         $mensagem .= '<div style="width:100%;text-align:center;height: 100%;background: #f1f1f1;padding-top: 15px;">';
         $mensagem .= '<div style="width:80%;margin-left:10%;margin-right:10%;text-align:left;padding: 20px;background: #ffffff;">';
         $mensagem .= '<div style="height:50px;margin-bottom:27px;">';
         $mensagem .= '<img src="http://www.agenciaprospecta.com.br/images/logo-verm.png" style="height: 100%">';
         $mensagem .= '</div>';
         $mensagem .= '<hr></hr>';
         $mensagem .= "<h2>Olá, {$atribuido['tb_usuarios_nome']}</h2>";
         $mensagem .= "O usuário {$atribuiu['tb_usuarios_nome']} atribuiu você como responsável pela tarefa: <a href='http://www.agenciaprospecta.com.br/sistema/editar/tarefa/{$tarefaId}'> {$tarefa['tb_tarefas_nome']} </a>";

         $mensagem .= '<div style="margin-left:10%;margin-right: 10%;margin-top:50px;padding: 19px;border: solid 1px #9a9a9a;line-height: 25px;"><table>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Título:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_nome'].'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Data Término:</b></td><td style="padding-left:10px;">'.DataBrasil($tarefa['tb_tarefas_data_termino']).'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Descrição:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_descricao'].'</td>';
         $mensagem .= '</tr>';

         if($tarefa['tb_tarefas_legenda']!='' && $tarefa['tb_tarefas_legenda']!=null){
             $mensagem .= '<tr>';
             $mensagem .= '<td><b>Legenda:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_legenda'].'</td>';
             $mensagem .= '</tr>';
         }


         $mensagem .= '</div>';
         $mensagem .= '</div>';




         $email->msgHTML(nl2br(utf8_decode($mensagem)));
         $email->send();
     }

     public function enviarEmailCompleto($quemCompletou, $tarefaId) {
         $conexao = new classeConexao();
         $email = new PHPMailer();
         $email = $this->criarEstrutura();


         $completou = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemCompletou}");
         $tarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = {$tarefaId}");

         $atribuido = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_funcionario']}");
         $criador = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_criador']}");

         $email->addAddress("{$completou['tb_usuarios_email']}", "{$completou['tb_usuarios_nome']}");
         $email->addCC("{$atribuido['tb_usuarios_email']}", "{$atribuido['tb_usuarios_nome']}");
         $email->addCC("{$criador['tb_usuarios_email']}", "{$criador['tb_usuarios_nome']}");


         $email->Subject = "[".utf8_decode(' SISTEMA PROSPECTA ')."] - Tarefa: ".utf8_decode($tarefa['tb_tarefas_nome'])."";

         $mensagem = '<style type="text/css"> body {margin-bottom:0; margin:0} </style>';
         $mensagem .= '<div style="width:100%;text-align:center;height: 100%;background: #f1f1f1;padding-top: 15px;">';
         $mensagem .= '<div style="width:80%;margin-left:10%;margin-right:10%;text-align:left;padding: 20px;background: #ffffff;">';
         $mensagem .= '<div style="height:50px;margin-bottom:27px;">';
         $mensagem .= '<img src="http://www.agenciaprospecta.com.br/images/logo-verm.png" style="height: 100%">';
         $mensagem .= '</div>';
         $mensagem .= '<hr></hr>';

         $mensagem .= "O usuário {$completou['tb_usuarios_nome']} completou a tarefa: <a href='http://www.agenciaprospecta.com.br/sistema/editar/tarefa/{$tarefaId}'> {$tarefa['tb_tarefas_nome']} </a>";

         $mensagem .= '<div style="margin-left:10%;margin-right: 10%;margin-top:50px;padding: 19px;border: solid 1px #9a9a9a;line-height: 25px;"><table>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Título:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_nome'].'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Data Término:</b></td><td style="padding-left:10px;">'.DataBrasil($tarefa['tb_tarefas_data_termino']).'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Descrição:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_descricao'].'</td>';
         $mensagem .= '</tr>';

         if($tarefa['tb_tarefas_legenda']!='' && $tarefa['tb_tarefas_legenda']!=null){
             $mensagem .= '<tr>';
             $mensagem .= '<td><b>Legenda:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_legenda'].'</td>';
             $mensagem .= '</tr>';
         }

         $mensagem .= '</table></div>';
         $mensagem .= '</div>';
         $mensagem .= '</div>';




         $email->msgHTML(nl2br(utf8_decode($mensagem)));
         $email->send();
     }

     public function enviarEmailAprovado($quemCompletou, $tarefaId) {
         $conexao = new classeConexao();
         $email = new PHPMailer();
         $email = $this->criarEstrutura();


         $completou = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemCompletou}");
         $tarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = {$tarefaId}");

         $atribuido = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_funcionario']}");
         $criador = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_criador']}");

         $email->addAddress("{$completou['tb_usuarios_email']}", "{$completou['tb_usuarios_nome']}");
         $email->addCC("{$atribuido['tb_usuarios_email']}", "{$atribuido['tb_usuarios_nome']}");
         $email->addCC("{$criador['tb_usuarios_email']}", "{$criador['tb_usuarios_nome']}");


         $email->Subject = "[".utf8_decode(' SISTEMA PROSPECTA ')."] - Tarefa: ".utf8_decode($tarefa['tb_tarefas_nome'])."";

         $mensagem = '<style type="text/css"> body {margin-bottom:0; margin:0} </style>';
         $mensagem .= '<div style="width:100%;text-align:center;height: 100%;background: #f1f1f1;padding-top: 15px;">';
         $mensagem .= '<div style="width:80%;margin-left:10%;margin-right:10%;text-align:left;padding: 20px;background: #ffffff;">';
         $mensagem .= '<div style="height:50px;margin-bottom:27px;">';
         $mensagem .= '<img src="http://www.agenciaprospecta.com.br/images/logo-verm.png" style="height: 100%">';
         $mensagem .= '</div>';
         $mensagem .= '<hr></hr>';

         $mensagem .= "O usuário {$completou['tb_usuarios_nome']} aprovou a tarefa: <a href='http://www.agenciaprospecta.com.br/sistema/editar/tarefa/{$tarefaId}'> {$tarefa['tb_tarefas_nome']} </a>";

         $mensagem .= '<div style="margin-left:10%;margin-right: 10%;margin-top:50px;padding: 19px;border: solid 1px #9a9a9a;line-height: 25px;"><table>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Título:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_nome'].'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Data Término:</b></td><td style="padding-left:10px;">'.DataBrasil($tarefa['tb_tarefas_data_termino']).'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Descrição:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_descricao'].'</td>';
         $mensagem .= '</tr>';

         if($tarefa['tb_tarefas_legenda']!='' && $tarefa['tb_tarefas_legenda']!=null){
             $mensagem .= '<tr>';
             $mensagem .= '<td><b>Legenda:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_legenda'].'</td>';
             $mensagem .= '</tr>';
         }

         $mensagem .= '</table></div>';
         $mensagem .= '</div>';
         $mensagem .= '</div>';




         $email->msgHTML(nl2br(utf8_decode($mensagem)));
         $email->send();
     }

     public function enviarEmailNovaConta($nome, $emailuser, $usuario, $senha) {

         $email = new PHPMailer();
         $email = $this->criarEstrutura();

         $email->addAddress("{$emailuser}", "{$nome}");

         $email->Subject = "[".utf8_decode(' SISTEMA PROSPECTA ')."] - Sua conta foi criada :)";

         $mensagem = '<style type="text/css"> body {margin-bottom:0; margin:0} </style>';
         $mensagem .= '<div style="width:100%;text-align:center;height: 100%;background: #f1f1f1;padding-top: 15px;">';
         $mensagem .= '<div style="width:80%;margin-left:10%;margin-right:10%;text-align:left;padding: 20px;background: #ffffff;">';
         $mensagem .= '<div style="height:50px;margin-bottom:27px;">';
         $mensagem .= '<img src="http://www.agenciaprospecta.com.br/images/logo-verm.png" style="height: 100%">';
         $mensagem .= '</div>';
         $mensagem .= '<hr></hr>';
         $mensagem .= "<h2>Olá, {$nome}</h2>";
         $mensagem .= "Sua conta do Sistema Prospecta foi criada, você pode acessa-la a utilizando os dados:";

         $mensagem .= '<div style="margin-left:10%;margin-right: 10%;margin-top:50px;padding: 19px;border: solid 1px #9a9a9a;line-height: 25px;"><table>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Endereço:</b></td><td style="padding-left:10px;"><a href="http://www.agenciaprospecta.com.br/sistema">www.agenciaprospecta.com.br/sistema</a></td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Usuário:</b></td><td style="padding-left:10px;">'.$usuario.'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Senha:</b></td><td style="padding-left:10px;">'.$senha.'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '</table></div>';
         $mensagem .= '</div>';
         $mensagem .= '</div>';




         $email->msgHTML(nl2br(utf8_decode($mensagem)));
         $email->send();
     }

     public function enviarEmailAprovadoAnexo($quemCompletou, $tarefaId, $anexoId,$descricao) {
         $conexao = new classeConexao();
         $email = new PHPMailer();
         $email = $this->criarEstrutura();


         $completou = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemCompletou}");

         $anexo = $conexao::fetchuniq("SELECT * FROM tb_arquivos WHERE id = {$anexoId}");

         $tarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = {$tarefaId}");

         $atribuido = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_funcionario']}");
         $criador = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_criador']}");

         $email->addAddress("{$completou['tb_usuarios_email']}", "{$completou['tb_usuarios_nome']}");
         $email->addCC("{$atribuido['tb_usuarios_email']}", "{$atribuido['tb_usuarios_nome']}");
         $email->addCC("{$criador['tb_usuarios_email']}", "{$criador['tb_usuarios_nome']}");


         $email->Subject = "[".utf8_decode(' SISTEMA PROSPECTA ')."] - Tarefa: ".utf8_decode($tarefa['tb_tarefas_nome'])."";

         $mensagem = '<style type="text/css"> body {margin-bottom:0; margin:0} </style>';
         $mensagem .= '<div style="width:100%;text-align:center;height: 100%;background: #f1f1f1;padding-top: 15px;">';
         $mensagem .= '<div style="width:80%;margin-left:10%;margin-right:10%;text-align:left;padding: 20px;background: #ffffff;">';
         $mensagem .= '<div style="height:50px;margin-bottom:27px;">';
         $mensagem .= '<img src="http://www.agenciaprospecta.com.br/images/logo-verm.png" style="height: 100%">';
         $mensagem .= '</div>';
         $mensagem .= '<hr></hr>';

         $mensagem .= "O usuário {$completou['tb_usuarios_nome']} aprovou o anexo: <a href='http://www.agenciaprospecta.com.br/sistema/view/images/uploads/anexos/{$anexo['tb_arquivos_nome']}'>{$anexo['tb_arquivos_nome']} </a> da tarefa: <a href='http://www.agenciaprospecta.com.br/sistema/editar/tarefa/{$tarefaId}'> {$tarefa['tb_tarefas_nome']} </a>";

         $mensagem .= "<br><br><b>Comentário sobre a aprovação:</b><br>";
         $mensagem .= "<div style='padding-left:2%;padding-right:2%;'>";
         $mensagem .= $descricao;
         $mensagem .= "</span>";
         $mensagem .= "<br><br>";

         $mensagem .= '<div style="margin-left:10%;margin-right: 10%;margin-top:50px;padding: 19px;border: solid 1px #9a9a9a;line-height: 25px;"><table>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Título:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_nome'].'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Data Término:</b></td><td style="padding-left:10px;">'.DataBrasil($tarefa['tb_tarefas_data_termino']).'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Descrição:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_descricao'].'</td>';
         $mensagem .= '</tr>';

         if($tarefa['tb_tarefas_legenda']!='' && $tarefa['tb_tarefas_legenda']!=null){
             $mensagem .= '<tr>';
             $mensagem .= '<td><b>Legenda:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_legenda'].'</td>';
             $mensagem .= '</tr>';
         }

         $mensagem .= '</table></div>';
         $mensagem .= '</div>';
         $mensagem .= '</div>';




         $email->msgHTML(nl2br(utf8_decode($mensagem)));
         $email->send();
     }

     public function enviarEmailNaoAprovadoAnexo($quemCompletou, $tarefaId, $anexoId, $descricao) {
         $conexao = new classeConexao();
         $email = new PHPMailer();
         $email = $this->criarEstrutura();


         $completou = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemCompletou}");

         $anexo = $conexao::fetchuniq("SELECT * FROM tb_arquivos WHERE id = {$anexoId}");

         $tarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = {$tarefaId}");

         $atribuido = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_funcionario']}");
         $criador = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$tarefa['tb_tarefas_criador']}");

         $email->addAddress("{$completou['tb_usuarios_email']}", "{$completou['tb_usuarios_nome']}");
         $email->addCC("{$atribuido['tb_usuarios_email']}", "{$atribuido['tb_usuarios_nome']}");
         $email->addCC("{$criador['tb_usuarios_email']}", "{$criador['tb_usuarios_nome']}");


         $email->Subject = "[".utf8_decode(' SISTEMA PROSPECTA ')."] - Tarefa: ".utf8_decode($tarefa['tb_tarefas_nome'])."";

         $mensagem = '<style type="text/css"> body {margin-bottom:0; margin:0} </style>';
         $mensagem .= '<div style="width:100%;text-align:center;height: 100%;background: #f1f1f1;padding-top: 15px;">';
         $mensagem .= '<div style="width:80%;margin-left:10%;margin-right:10%;text-align:left;padding: 20px;background: #ffffff;">';
         $mensagem .= '<div style="height:50px;margin-bottom:27px;">';
         $mensagem .= '<img src="http://www.agenciaprospecta.com.br/images/logo-verm.png" style="height: 100%">';
         $mensagem .= '</div>';
         $mensagem .= '<hr></hr>';

         $mensagem .= "O usuário {$completou['tb_usuarios_nome']} NÃO aprovou o anexo: <a href='http://www.agenciaprospecta.com.br/sistema/view/images/uploads/anexos/{$anexo['tb_arquivos_nome']}'>{$anexo['tb_arquivos_nome']} </a> da tarefa: <a href='http://www.agenciaprospecta.com.br/sistema/editar/tarefa/{$tarefaId}'> {$tarefa['tb_tarefas_nome']} </a>";

         $mensagem .= "<br><br><b>Comentário sobre a NÃO aprovação:</b><br>";
         $mensagem .= "<div style='padding-left:2%;padding-right:2%;'>";
         $mensagem .= $descricao;
         $mensagem .= "</span>";
         $mensagem .= "<br><br>";


         $mensagem .= '<div style="margin-left:10%;margin-right: 10%;margin-top:50px;padding: 19px;border: solid 1px #9a9a9a;line-height: 25px;"><table>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Título:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_nome'].'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Data Término:</b></td><td style="padding-left:10px;">'.DataBrasil($tarefa['tb_tarefas_data_termino']).'</td>';
         $mensagem .= '</tr>';

         $mensagem .= '<tr>';
         $mensagem .= '<td><b>Descrição:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_descricao'].'</td>';
         $mensagem .= '</tr>';

         if($tarefa['tb_tarefas_legenda']!='' && $tarefa['tb_tarefas_legenda']!=null){
             $mensagem .= '<tr>';
             $mensagem .= '<td><b>Legenda:</b></td><td style="padding-left:10px;">'.$tarefa['tb_tarefas_legenda'].'</td>';
             $mensagem .= '</tr>';
         }

         $mensagem .= '</table></div>';
         $mensagem .= '</div>';
         $mensagem .= '</div>';

         $email->msgHTML(nl2br(utf8_decode($mensagem)));
         $email->send();
     }

}