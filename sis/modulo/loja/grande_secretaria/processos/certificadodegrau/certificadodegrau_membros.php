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
            <a href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau.php" class="ajaxify">Certificado de Grau</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau_membros.php" class="ajaxify">Membros</a>
        </li>
    </ul>

</div>
<h3 class="page-title">
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Certificado de Grau
    <small>Membros</small>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-user-unfollow font-dark"></i>
                    <span class="caption-subject bold uppercase"> Aprendizes e Companheiros </span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tabela_ac">
                    <thead>
                        <tr>
                            <th> Nome </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau.js"></script>