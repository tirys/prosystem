<?php
    use PHPMailer;
//    include ('../libs/phpmailer/phpmailer/class.phpmailer.php');
//    include ('../libs/phpmailer/phpmailer/class.smtp.php');


 class Email {

    public function enviarEmailAtibuido($quemAtribuido, $quemAtribuiu, $tarefaId) {
        echo 'ok';
        $email = new PHPMailer();
        $email = $this->criarEstrutura();

        $email->addAddress($quemAtribuido, "Jéssica");
        $email->Subject = "[".utf8_decode(' PROSPECTA ')."] - Nome Tarefa";

        $mensagem = "Você foi atribuído como responsável pela tarefa: <a href='www.agenciaprospecta.com.br'> nometarefacomlinnk </a>";

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
        $email->setFrom('send@agenciaprospecta.com.br', 'web');

        return $email;
    }

}