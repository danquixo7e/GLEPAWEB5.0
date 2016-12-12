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
        </li>
    </ul>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/processos_iniciar.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Regularização
    <small>Resumo</small>
</h3>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-user-unfollow font-green"></i>
            <span class="caption-subject font-green bold uppercase">Regularização</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="mt-element-step">
            <div class="row step-line">
                <div class="col-md-2 mt-step-col first done">
                    <div class="mt-step-number bg-white">1</div>
                    <div class="mt-step-title uppercase font-grey-cascade">SOLICITAR</div>
                    <div class="mt-step-content font-grey-cascade">Preenchendo os dados do membro, dados maçônicos e toda documentação exigida, inclusive o Quite placet</div>
                </div>
                <div class="col-md-2 mt-step-col active">
                    <div class="mt-step-number bg-white">2</div>
                    <div class="mt-step-title uppercase font-grey-cascade">GRANDE SECRETARIA</div>
                    <div class="mt-step-content font-grey-cascade">Analisa a solicitação</div>
                </div>
                <div class="col-md-3 mt-step-col active">
                    <div class="mt-step-number bg-white">3</div>
                    <div class="mt-step-title uppercase font-grey-cascade">TAXA</div>
                    <div class="mt-step-content font-grey-cascade">Kit para regularização <br> R$ <?php echo number_format(get('glepaweb_tipo_cobranca', 'id', '14', 'valor'), 2, ',', '.'); ?> + R$ <?php echo number_format(get('glepaweb_tipo_cobranca', 'id', '9', 'valor'), 2, ',', '.') ; ?> <br>Referente a inscrição na Beneficência Maçônica caso tenha menos de 65 anos</div>
                </div>
                <div class="col-md-3 mt-step-col active">
                    <div class="mt-step-number bg-white">4</div>
                    <div class="mt-step-title uppercase font-grey-cascade">CONCESSÃO</div>
                    <div class="mt-step-content font-grey-cascade">O Grão-Mestre assina a concessão do Placet para regularização</div>
                </div>
                <div class="col-md-2 mt-step-col last">
                    <div class="mt-step-number bg-white">5</div>
                    <div class="mt-step-title uppercase font-grey-cascade">IMPRIMIR</div>
                    <div class="mt-step-content font-grey-cascade">A loja imprime a concessão do Placet</div>
                </div>
            </div>
        </div>
        <hr>
        <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_route.php" class="btn btn-lg blue margin-top-20 ajaxify"> Iniciar Processo <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
