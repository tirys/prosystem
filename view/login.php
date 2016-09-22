<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>Prospecta - Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
    <meta content="" name="author" />
    <!-- Estilos principais -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugins da Pagina -->
    <link href="view/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="view/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Estilo global do tema -->
    <link href="view/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="view/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />


    <link href="view/assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg" style="background-image:url(view/assets/pages/img/login/bg1.jpg)">
                <img class="login-logo" src="view/assets/pages/img/login/logo.png" /> </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content">
                <h1>LOGIN</h1>
                <p> Informe suas credenciais para realizar o acesso ao sistema. </p>
                <form action="pages/login.php" class="login-form" method="post">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Por favor, insira seu usuário e senha. </span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Usuário" name="usuario" required/> </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Senha" name="senha" required/> </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" value="1" /> Lembre-me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="javascript:;" id="forget-password" class="forget-password">Esqueceu sua senha?</a>
                            </div>
                            <button class="btn green" type="submit">Entrar</button>
                        </div>
                    </div>
                </form>
                <!-- START Formulario de esqueci minha senha-->
                <form class="forget-form" action="javascript:;" method="post">
                    <h3 class="font-green">Esqueceu sua senha ?</h3>
                    <p> Insira seu endereço de email para redefinir sua senha. </p>
                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">Voltar</button>
                        <button type="submit" class="btn btn-success uppercase pull-right">Enviar</button>
                    </div>
                </form>
                <!-- END Formulario de esqueci minha senha-->
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-5 bs-reset">
                        <ul class="login-social">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Agência Prospecta 2016</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--[if lt IE 9]>
<script src="view/assets/global/plugins/respond.min.js"></script>
<script src="view/assets/global/plugins/excanvas.min.js"></script>
<script src="view/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<script src="view/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="view/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="view/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="view/assets/pages/scripts/login-5.min.js" type="text/javascript"></script>
