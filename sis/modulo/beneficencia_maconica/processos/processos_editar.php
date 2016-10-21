<?php
require_once ('../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('5') : header('Location: ' . BASE . '/sis/403.php');
$id = $_GET['id'];
$readProcesso = read('glepaweb_processos',"WHERE id = '$id'");
if($readProcesso){
    foreach ($readProcesso as $processo => $value);
    if($value['id_tipo'] === '1'){
        $readDados = read('glepaweb_dados_processos',"WHERE id_processo = '$value[id]'");
        if($readDados){
            foreach ($readDados as $dados);
        }
    }else{
        $readDados = read('glepaweb_membros',"WHERE id = '$value[id_membro]'");
        if($readDados){
            foreach ($readDados as $dados);
        }
    }
}else{
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
            <a href="modulo/beneficencia_maconica/processos/processos_pendentes.php" class="ajaxify">Processos Pendentes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/beneficencia_maconica/processos/processos_editar.php?id=<?php echo $value['id'] ;?>" class="ajaxify">Editar Processo</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    Editar
    <small>Processos</small>
    <div class="btn-group pull-right">
        <a href="modulo/beneficencia_maconica/processos/processos_pendentes.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption"><i class="icon-wrench"></i> #<?php echo $value['id'] ;?> </div>
                <div class="actions btn-set">
                    <button class="btn btn-success btn_libera_processo" id="<?php echo $value['id'] ;?>">
                        <i class="fa fa-check-circle"></i> Liberar Processo</button>
                    <div class="btn-group">
                        <a class="btn yellow" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-cogs"></i> Opções
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-search"></i> Analisar </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-print"></i> Imprimir </a>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a> Dados Gerais </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="row static-info">
                                <div class="col-md-5 name"> Número do processo: </div>
                                <div class="col-md-7 value"> <?php echo $value['id']; ?> </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-5 name"> Nome: </div>
                                <div class="col-md-7 value"> <?php echo $dados['nome'] ;?> </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-5 name"> Data de abertura: </div>
                                <div class="col-md-7 value"> <?php echo date('d/m/Y H:i:s',strtotime($value['data_abertura'])); ?> </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-5 name"> Tipo: </div>
                                <div class="col-md-7 value"> <?php echo get(glepaweb_tipo_processos, id, $value['id_tipo'],tipo) ;?> </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-5 name"> Status: </div>
                                <div class="col-md-7 value"> <?php echo get(glepaweb_status_processos, id, $value['id_status'],status) ;?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="modulo/beneficencia_maconica/processos/processos.js"></script>