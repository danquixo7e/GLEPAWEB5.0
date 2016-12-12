<?php
require_once ('../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = $_GET['id'];
$readProcesso = read('glepaweb_processos',"WHERE id = '$id'");
if($readProcesso){
    foreach ($readProcesso as $processo => $value);
    if($value['id_tipo'] === '1' || ($value['id_tipo'] === '8' && $value['id_membro'] === '0')){
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
            <a href="modulo/loja/grande_secretaria/processos/processos.php" class="ajaxify">Processos em andamento</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id'] ;?>" class="ajaxify">Editar Processo</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/processos.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Editar
    <small>Processos</small>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption"><i class="icon-wrench"></i> #<?php echo $value['id'] ;?> </div>
                <div class="actions btn-set">
                    <a class="btn btn-info ajaxify" href="<?php echo get(glepaweb_tipo_processos, id, $value['id_tipo'], url_loja).$value['id'] ;?>">
                        <i class="fa fa-arrow-circle-o-right"></i> Acessar Processo</a>
                    <div class="btn-group">
                        <a class="btn yellow" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-cogs"></i> Opções
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-print"></i> Imprimir Processo</a>
                            </li>
                            <div class="divider"></div>
                            <li>
                                <a href="javascript:;" class="ajaxify">
                                    <i class="fa fa-ban"></i> Cancelar Processo </a>
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
                                <div class="col-md-7 value"> <?php echo ($dados['nome'] == '' ? $dados['cpf'] : $dados['nome']) ;?> </div>
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
<script type="text/javascript" src="modulo/grande_secretaria/processos/processos.js"></script>