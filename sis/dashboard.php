<?php
ob_start();
session_start();
if (!$_SESSION['autGlepa']) {
    header('Location: index.php');
} else {
    require_once ('../config/dtsSis.php');
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="pt-br" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="pt-br" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>GLEPAWEB 5.0 | Painel Administrativo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="dashboard.php" class="ajaxify">
                        <img src="assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> 
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- BEGIN TOP NAVIGATION MENU -->
                <?php
                if ($_SESSION['autGlepa']['id_modulo'] === '1') {
                    setArq('includes/grao_mestre/top_menu');
                }elseif($_SESSION['autGlepa']['id_modulo'] === '3'){
                    setArq('includes/grande_secretaria/top_menu');
                }elseif($_SESSION['autGlepa']['id_modulo'] === '4'){
                    setArq('includes/grande_tesouraria/top_menu');
                }elseif($_SESSION['autGlepa']['id_modulo'] === '5'){
                    setArq('includes/beneficencia_maconica/top_menu');
                }
                ?>
                <!-- END TOP NAVIGATION MENU -->
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php
            if ($_SESSION['autGlepa']['id_modulo'] === '1') {
                setArq('includes/grao_mestre/sidebar');
            }elseif($_SESSION['autGlepa']['id_modulo'] === '3'){
                setArq('includes/grande_secretaria/sidebar');
            }elseif($_SESSION['autGlepa']['id_modulo'] === '4'){
                setArq('includes/grande_tesouraria/sidebar');
            }elseif($_SESSION['autGlepa']['id_modulo'] === '5'){
                setArq('includes/beneficencia_maconica/sidebar');
            }
            ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper"><div class="page-content"><div class="page-content-body"></div></div></div>
            <!-- END CONTENT -->
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> <?php echo date('Y'); ?> &copy; GLEPAWEB | Painel Administrativo</div>
            <div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
        </div>
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/global/plugins/jquery-forms/jquery.form.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
        <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/localization/messages_pt_BR.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/global/scripts/app.js" type="text/javascript"></script>
        <script src="assets/layouts/layout/scripts/layout.js" type="text/javascript"></script>
    </body>
</html>