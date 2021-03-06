<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
if ($readProcesso) {
    foreach ($readProcesso as $processo => $value)
        ;
} else {
    header('Location: ' . BASE . '/sis/404.php');
}
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="home.php" class="ajaxify"><i class="icon-home"></i> Início</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/processos.php" class="ajaxify">Processos em andamento</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id']; ?>" class="ajaxify">Editar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_editar.php?id=<?php echo $value['id']; ?>" class="ajaxify">Analisar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_data.php?id=<?php echo $value['id']; ?>" class="ajaxify">Data Cerimonial</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Filiação
    <small>Data Cerimonial</small>
</h3>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-edit font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> Data do Cerimonial</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal">
            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button> 
                    Por favor, preencha todas as informações.
                </div>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <div class="date-picker" id="data_cerimonial" data-date-format="dd/mm/yyyy" data-date="<?php echo (validaData($value['data_cerimonial']) ? date('d/m/Y',strtotime($value['data_cerimonial'])) : '') ;?>" data-date-start-date="+7d"> </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn default"><i class="fa fa-times"></i> Cancelar</button>
                    <a class="btn blue enviaData" id="<?php echo $value['id']; ?>"><i class="fa fa-save"></i> Finalizar Processo</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia.js"></script>
