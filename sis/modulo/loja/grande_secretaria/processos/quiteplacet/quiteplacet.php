<?php
require_once ('../../../../../../config/dtsSis.php');
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
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet.php" class="ajaxify">Quite Placet</a>
        </li>
    </ul>

</div>
<h3 class="page-title"> Quite Placet
    <small>Resumo</small>
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/processos_iniciar.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
</h3>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-user-unfollow font-green"></i>
            <span class="caption-subject font-green bold uppercase">Quite Placet</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="mt-element-step">
            <div class="row step-line">
                <div class="col-md-4 mt-step-col first done">
                    <div class="mt-step-number bg-white">1</div>
                    <div class="mt-step-title uppercase font-grey-cascade">SOLICITAR</div>
                    <div class="mt-step-content font-grey-cascade">Preenchendo os dados do membro</div>
                </div>
                <div class="col-md-4 mt-step-col active">
                    <div class="mt-step-number bg-white">2</div>
                    <div class="mt-step-title uppercase font-grey-cascade">GRANDE SECRETARIA</div>
                    <div class="mt-step-content font-grey-cascade">Assina a concessão</div>
                </div>
                <div class="col-md-4 mt-step-col last">
                    <div class="mt-step-number bg-white">4</div>
                    <div class="mt-step-title uppercase font-grey-cascade">IMPRIMIR</div>
                    <div class="mt-step-content font-grey-cascade">A loja imprime a concessão do Quite Placet</div>
                </div>
            </div>
        </div>
        <hr>
        <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet_membros.php" class="btn btn-lg blue margin-top-20 ajaxify"> Iniciar Processo <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
