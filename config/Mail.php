<?php
    require_once ('pacoteClasses.php');


 class Email {

    public function enviarEmailAtibuido($quemAtribuido, $quemAtribuiu, $tarefaId) {
        $conexao = new classeConexao();
        $email = new PHPMailer();
        $email = $this->criarEstrutura();


        //receber id quem foi atribuido
            //pegar os dados de quem foi atribuído
            $atribuido = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemAtribuido}");
        //receber id quem atribuiu
            //pegar os dados de quem atribuiu
            $atribuiu = $conexao::fetchuniq("SELECT * FROM tb_usuarios WHERE id = {$quemAtribuiu}");
        //receber id tarefa que foi atualizada
            //pegar os dados da tarefa que foi atualizada
            $tarefa = $conexao::fetchuniq("SELECT * FROM tb_tarefas WHERE id = {$tarefaId}");

        $email->addAddress("{$atribuido['tb_usuarios_email']}", "{$atribuido['tb_usuarios_nome']}");
        $email->Subject = "[".utf8_decode(' PROSPECTA ')."] - Tarefa: {$tarefa['tb_tarefas_nome']}";

        $mensagem = "O usuário {$atribuiu['tb_usuarios_nome']} atribuiu você como responsável pela tarefa: <a href='www.agenciaprospecta.com.br/sistema/editar/tarefa/{$tarefaId}'> {$tarefa['tb_tarefas_nome']} </a>";

        $email->msgHTML(nl2br(utf8_decode($mensagem)));
        $email->send();
    }

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

}