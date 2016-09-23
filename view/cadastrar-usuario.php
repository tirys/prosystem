<?php
$cookie = $_COOKIE['auth'];
$cookie = json_decode($cookie);

include("topo.php");
?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?php include("menulateral.php"); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Usuários > Cadastrar</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
                            <i class="icon-calendar"></i>
                            <span class="thin uppercase hidden-xs"></span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <h1 class="page-title">
                </h1>

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user font-blue"></i>
                                    <span class="caption-subject font-blue sbold uppercase">Novo usuário</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="#" id="form_sample_1" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> Por favor, preencha os dados corretamente. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nome
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="name" data-required="1" class="form-control" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input name="email" type="text" class="form-control" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">URL
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input name="url" type="text" class="form-control" />
                                                <span class="help-block"> e.g: http://www.demo.com or http://demo.com </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Login
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input name="number" type="text" class="form-control" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Senha
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input name="senha" type="password" class="form-control" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Credit Card
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input name="creditcard" type="text" class="form-control" />
                                                <span class="help-block"> e.g: 5500 0000 0000 0004 </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Occupation&nbsp;&nbsp;</label>
                                            <div class="col-md-4">
                                                <input name="occupation" type="text" class="form-control" />
                                                <span class="help-block"> optional field </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="select">
                                                    <option value="">Select...</option>
                                                    <option value="Category 1">Category 1</option>
                                                    <option value="Category 2">Category 2</option>
                                                    <option value="Category 3">Category 5</option>
                                                    <option value="Category 4">Category 4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Multi Select
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="select_multi" multiple>
                                                    <option value="Category 1">Category 1</option>
                                                    <option value="Category 2">Category 2</option>
                                                    <option value="Category 3">Category 3</option>
                                                    <option value="Category 4">Category 4</option>
                                                    <option value="Category 5">Category 5</option>
                                                </select>
                                                <span class="help-block"> select max 3 options, min 1 option </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Input Group
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                    <input type="text" class="form-control" name="input_group" placeholder="Email Address"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <button type="button" class="btn grey-salsa btn-outline">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- BEGIN CORE PLUGINS -->
    <script src="view/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="view/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
    <script src="view/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="view/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="view/assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="view/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="view/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="view/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="view/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
<?=include("rodape.php")?>