<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");
$conexao = new classeConexao();
$usuario = $conexao::fetchuniq("SELECT tu.id FROM tb_usuarios tu, tb_sessao ts WHERE ts.tb_sessao_usuario_id = tu.id AND ts.tb_sessao_token ='".$cookie['t']."'");
$usuario_id = $usuario['id'];

if($usuario_tipo == 2) {

    //Empresa do Cliente
    $empresa = $conexao::fetchuniq("SELECT tb_clientes_empresas_id FROM tb_clientes WHERE tb_clientes_usuario_id = {$usuario['id']}");

    //Aprovações Clientes
        $aprovacoes = $conexao::fetch("SELECT ta.*, pro.tb_projetos_nome, pro.id as projetoID FROM tb_tarefas ta, tb_projetos pro WHERE ta.tb_tarefas_projeto = pro.id AND tb_tarefas_aprovacao != 0 AND ta.tb_tarefas_status != 1 AND pro.id_projetos_empresas_id = {$empresa['tb_clientes_empresas_id']} ORDER BY tb_tarefas_aprovacao");
}
else {
    //Aprovações Geral
    $aprovacoes = $conexao::fetch("SELECT ta.*, pro.tb_projetos_nome, pro.id as projetoID FROM tb_tarefas ta, tb_projetos pro WHERE ta.tb_tarefas_projeto = pro.id AND tb_tarefas_aprovacao != 0 AND ta.tb_tarefas_status != 1 ORDER BY tb_tarefas_aprovacao");
}

?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Aprovações</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="pull-right tooltips btn btn-sm">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"><?=strftime('%A, %d de %B de %Y', strtotime('today'))?></span>&nbsp;
                        </div>
                    </div>
                </div>
                <h1 class="page-title"> Aprovações
                    <small>itens enviados para aprovação</small>
                </h1>

                <br><br><br>

                <!-- START: APROVAÇÕES -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-2">
                            <div class="imagem-aprovacao">
                                <img class="myImg" id="myImg" src="view/images/uploads/anexos/Desert.jpg" width="200px" height="200px"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="texto-aprovacao">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A debitis deserunt dicta dolore, eius eos est in iste iusto labore natus, nihil quidem ratione soluta, voluptate. Architecto deserunt illum placeat?
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="botoes-aprovacao">
                                <a class="btn btn-success aprovarPeca" data-role="observacoes1"><span class="fa fa-check"></span> Aprovar</a>
                                <a class="btn btn-danger NaprovarPeca" data-role="observacoes1"><span class="fa fa-times"></span> Não Aprovar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row observacoes1" style="display: none;">
                        <div class="col-md-12">
                            <br>
                            <b>Observações?</b>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <textarea class="form-control">

                            </textarea>
                        </div>
                        <div class="col-md-12">
                            <br>
                           <div class="pull-right botoes-aprovacao">
                               <a class="btn green-sharp btn-outline sbold cancelarObservacao" data-role="observacoes1"><span class="fa fa-times"></span> Cancelar</a>
                               <a class="btn btn-success enviarObservacao" data-role="observacoes1"><span class="fa fa-send"></span> Enviar</a>
                           </div>
                        </div>
                    </div>

                    <br>
                    <hr></hr>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="imagem-aprovacao">
                                <img class="myImg" id="myImg" src="view/images/uploads/anexos/Desert.jpg" width="200px" height="200px"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="texto-aprovacao">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A debitis deserunt dicta dolore, eius eos est in iste iusto labore natus, nihil quidem ratione soluta, voluptate. Architecto deserunt illum placeat?
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="botoes-aprovacao">
                                <a class="btn btn-success aprovarPeca" data-role="observacoes2"><span class="fa fa-check"></span> Aprovar</a>
                                <a class="btn btn-danger NaprovarPeca" data-role="observacoes2"><span class="fa fa-times"></span> Não Aprovar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row observacoes2" style="display: none;">
                        <div class="col-md-12">
                            <br>
                            <b>Observações?</b>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <textarea class="form-control">

                            </textarea>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="pull-right botoes-aprovacao">
                                <a class="btn green-sharp btn-outline sbold cancelarObservacao" data-role="observacoes2"><span class="fa fa-times"></span> Cancelar</a>
                                <a class="btn btn-success enviarObservacao" data-role="observacoes2"><span class="fa fa-send"></span> Enviar</a>
                            </div>
                        </div>
                    </div>

                    <br>
                    <hr></hr>
                    <br>

                </div>
                <!-- END: APROVAÇÕES -->

                <!-- START: MODAL -->
                <div id="myModal" class="modal" onclick="document.getElementById('myModal').style.display='none'">
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <!-- END: MODAL -->

            </div>
        </div>
    </div>
<?=include("rodape.php")?>

<script>
    $(".aprovarPeca").on("click", function () {
        var observacaoN = $(this).attr("data-role");

        $("."+observacaoN).slideDown( "slow", function() {
            
        });
    });

    $(".cancelarObservacao").on("click", function () {
        var observacaoN = $(this).attr("data-role");

        $("."+observacaoN).slideUp( "slow", function() {

        });
    });

    $(".NaprovarPeca").on("click", function () {
        var observacaoN = $(this).attr("data-role");

        $("."+observacaoN).slideDown( "slow", function() {

        });
    });

    $(".enviarObservacao").on("click", function () {
        var observacaoN = $(this).attr("data-role");

        $("."+observacaoN).slideUp( "slow", function() {

        });
    });


    var modal = document.getElementById('myModal');
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    $('img').on('click',function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    });

    var span = document.getElementsByClassName("close")[0];


</script>
