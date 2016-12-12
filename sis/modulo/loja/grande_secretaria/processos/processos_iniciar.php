<?php
require_once ('../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="home.php" class="ajaxify"><i class="icon-home"></i> Início</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/processos_iniciar.php" class="ajaxify">Abrir Processo</a>
        </li>
    </ul>
    
</div>
<h3 class="page-title"> Processo
    <small>Iniciar</small>
    <div class="btn-group pull-right">
        <a href="home.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
</h3>
<div class="row">
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/iniciacao.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Iniciação </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao.php" class="ajaxify">
                        <i class="fa fa-user-plus fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/elevacao.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Elevação </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/elevacao/elevacao.php" class="ajaxify">
                        <i class="fa fa-arrow-right fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/elevacao/elevacao.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/exaltacao.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Exaltação </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/exaltacao/exaltacao.php" class="ajaxify">
                        <i class="fa fa-key fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/exaltacao/exaltacao.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/quiteplacet.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Quite Placet </div>
                <div class="mt-body-icons">
                    <a class="ajaxify" href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet.php">
                        <i class="fa fa-user-times fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/certificado.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Certificado de Grau </div>
                <div class="mt-body-icons">
                    <a class="ajaxify" href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau.php">
                        <i class="fa fa-user-times fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/readmissao.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Readmissão </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/readmissao/readmissao.php" class="ajaxify">
                        <i class="fa fa-plus-square fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/readmissao/readmissao.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/regularizacao.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Regularização </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao.php" class="ajaxify">
                        <i class="fa fa-check-circle fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/filiacaoa.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Filiação Ativo </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/filiacaoativo/filiacaoativo.php" class="ajaxify">
                        <i class="fa fa-share-alt fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/filiacaoativo/filiacaoativo.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/filiacaoi.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Filiação Inativo </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/filiacaoativo/filiacaoativo.php" class="ajaxify">
                        <i class="fa fa-user-plus fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/filiacaoinativo/filiacaoinativo.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/filiacaoo.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Filiação Outra Potência </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia.php" class="ajaxify">
                        <i class="fa fa-globe fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mt-widget-4">
            <div class="mt-img-container">
                <img src="assets/pages/img/background/exclusao.jpg" /> </div>
            <div class="mt-container bg-dark-opacity">
                <div class="mt-head-title"> Placet de Exclusão </div>
                <div class="mt-body-icons">
                    <a href="modulo/loja/grande_secretaria/processos/placetdeexclusao/placetdeexclusao.php" class="ajaxify">
                        <i class="fa fa-user-times fa-2x"></i>
                    </a>
                </div>
                <div class="mt-footer-button">
                    <a href="modulo/loja/grande_secretaria/processos/placetdeexclusao/placetdeexclusao.php" class="btn btn-circle blue-soft btn-sm ajaxify">Iniciar</a>
                </div>
            </div>
        </div>
    </div>
</div>