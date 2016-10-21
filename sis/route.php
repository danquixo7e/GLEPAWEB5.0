<?php
ob_start();
session_start();
if (!$_SESSION['autRoute']) {
    header('Location: index.php');
} else {
    require_once ('../config/dtsSis.php');
    $id = $_SESSION['autRoute']['id'];
    $readUsuario = read('glepaweb_usuarios',"WHERE id = '$id'");
    if($readUsuario){
        foreach ($readUsuario as $usuario => $value);
        $nome = ucfirst(strtolower(current(explode(" ", $value['nome'])))).' '. ucfirst(strtolower(end(explode(" ", $value['nome']))));
    }else{
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="pt-br" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="pt-br" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>GLEPAWEB 5.0 | Painel Administrativo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/lock-2.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="">
        <div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="index.html">
                    <img src="assets/pages/img/logo-big.png" alt="logo" /> </a>
            </div>
            <div class="page-body">
                <img class="page-lock-img" src="assets/pages/media/profile/profile.jpg" alt="">
                <div class="page-lock-info">
                    <h1>Perfil</h1>
                    <span class="email"> bob@keenthemes.com </span>
                    <form class="form-inline" action="index.html">
                        <div class="input-group input-medium">
                            
                            <span class="input-group-btn">
                                <a class="btn green icn-only">
                                    <i class="m-icon-swapright m-icon-white"></i> Entrar
                                </a>
                            </span>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="page-body">
                <img class="page-lock-img" src="assets/pages/media/profile/profile.jpg" alt="">
                <div class="page-lock-info">
                    <h1><?php echo get(glepaweb_modulos, id, $value['id_modulo'], modulo) ;?></h1>
                    <span class="email"> <?php echo get(glepaweb_cargos, id, $value['id_cargo'], cargo) ;?> </span>
                    <form class="form-inline" action="index.html">
                        <div class="input-group input-medium">
                            
                            <span class="input-group-btn">
                                <a class="btn green icn-only btn_login_conta" id="<?php echo $id ;?>">
                                    <i class="m-icon-swapright m-icon-white"></i> Entrar
                                </a>
                            </span>
                        </div>
                        <!-- /input-group -->
                        <div class="relogin">
                            <a href="logoff.php"> Você não é <?php echo $nome ;?> ? </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer-custom"> <?php echo date('Y'); ?> &copy; GLEPAWEB | Painel Administrativo. </div>
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
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/lock-2.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>