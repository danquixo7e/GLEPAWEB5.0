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
            <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_iniciar.php" class="ajaxify">Regularização</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_route.php" class="ajaxify">Informar</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_iniciar.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Regularização
    <small>Informar</small>
</h3>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-user-unfollow font-green"></i>
            <span class="caption-subject font-green bold uppercase">Regularização</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="alert alert-block alert-warning fade in">
            <h4 class="alert-heading">Atenção!</h4>
            <p> O membro que você deseja regularizar já fez parte da GLEPA anteriormente e agora deseja retornar? </p>
            <br>
            <p>
                <a class="btn red ajaxify" href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_cpf.php"> Não </a>
                <a class="btn blue" href="javascript:;"> Sim </a>
            </p>
        </div>
    </div>
</div>
