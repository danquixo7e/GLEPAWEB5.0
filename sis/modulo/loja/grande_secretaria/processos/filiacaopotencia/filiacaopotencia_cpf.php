<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/404.php');
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="home.php" class="ajaxify"><i class="icon-home"></i> Início</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/processos.php" class="ajaxify">Abrir Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia.php" class="ajaxify">Filiação</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_cpf.php" class="ajaxify">Abrir Processo</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia.php" class="btn btn-outline btn-sm blue ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Filiação
    <small>Abrir Processo</small>
</h3>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="fa fa-user-plus font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> CPF do Candidato</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="horizontal-form" name="formCPf">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> 
                Por favor, preencha todas as informações.
            </div>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">CPF</label>
                            <div class="input-icon right"><i class="fa "></i>
                                <input placeholder="Informe o CPF do membro" type="text" class="form-control mask_cpf" name="cpf" /> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="reset" class="btn default"><i class="fa fa-times"></i> Cancelar</button>
                <button type="submit" class="btn blue"><i class="fa fa-check"></i> Enviar</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia.js"></script>
