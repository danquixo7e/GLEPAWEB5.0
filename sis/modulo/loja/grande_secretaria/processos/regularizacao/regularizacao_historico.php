<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$readAnexos = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
if ($readAnexos) {
    foreach ($readAnexos as $anexos => $value);
    $readHistorico = read('glepaweb_historico_processos',"WHERE id_processo = '$id'");
    if($readHistorico){
        foreach ($readHistorico as $historico);
    }
} else {
    header('Location: ' . BASE . '/sis/404.php');
}
?>
<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
            <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Editar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_editar.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Analisar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_historico.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Histórico</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-shield"></i> Another action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user"></i> Something else here</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-bag"></i> Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_editar.php?id=<?php echo $value['id_processo']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Regularização 
    <small>Histórico</small>
</h3>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-edit font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> Histórico </span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="horizontal-form" name="formHistorico" id="<?php echo $value['id_processo']; ?>">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> 
                Por favor, preencha todas as informações.
            </div>
            <div class="form-body">
                <h3 class="form-section">Iniciação</h3>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Data</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_date" name="ini_data" value="<?php echo validaData($historico['ini_data']) ? date('d/m/Y', strtotime($historico['ini_data'])) : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Loja </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="ini_loja" value="<?php echo $historico['ini_loja'] ? $historico['ini_loja'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Potência Maçônica </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="ini_potencia" value="<?php echo $historico['ini_potencia'] ? $historico['ini_potencia'] : '' ?>" /> </div>
                    </div>
                </div>
                <h3 class="form-section">Elevação</h3>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Data</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_date" name="ele_data" value="<?php echo validaData($historico['ele_data']) ? date('d/m/Y', strtotime($historico['ele_data'])) : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Loja </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="ele_loja" value="<?php echo $historico['ele_loja'] ? $historico['ele_loja'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Potência Maçônica </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="ele_potencia" value="<?php echo $historico['ele_potencia'] ? $historico['ele_potencia'] : '' ?>" /> </div>
                    </div>
                </div>
                <h3 class="form-section">Exaltação</h3>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Data</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_date" name="exa_data" value="<?php echo validaData($historico['exa_data']) ? date('d/m/Y', strtotime($historico['exa_data'])) : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Loja </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="exa_loja" value="<?php echo $historico['exa_loja'] ? $historico['exa_loja'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Potência Maçônica </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="exa_potencia" value="<?php echo $historico['exa_potencia'] ? $historico['exa_potencia'] : '' ?>" /> </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="reset" class="btn default"><i class="fa fa-times"></i> Cancelar</button>
                <button type="submit" class="btn blue"><i class="fa fa-save"></i> Enviar</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao.js"></script>