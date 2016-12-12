<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = $_GET['id'];
$readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
if ($readProcesso) {
    foreach ($readProcesso as $processo => $value);
} else {
    header('Location: ' . BASE . '/sis/404.php');
}
?>
<link href="assets/pages/css/search.min.css" rel="stylesheet" type="text/css" />
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
            <a href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau_editar.php?id=<?php echo $value['id']; ?>" class="ajaxify">Acessar Processo</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Certificado de Grau
    <small>Acesar Processo</small>
</h3>
<div class="search-page search-content-4">
    <div class="search-table table-responsive">
        <table class="table table-bordered table-striped table-condensed">
            <thead class="bg-blue">
                <tr>
                    <th>
                        <a>Acesar</a>
                    </th>
                    <th>
                        <a>Etapa</a>
                    </th>
                    <th>
                        <a>Descrição</a>
                    </th>
                    <th>
                        <a>Status</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="table-status">
                        <?php
                        if ($value['id_status'] === '3') {
                            echo '<a href="modulo/loja/grande_secretaria/processos/certificadodegrau/certificadodegrau_membro.php?id=' . $value['id'] . '" class="ajaxify"><i class="icon-arrow-right font-blue"></i></a>';
                        }
                        ?>
                    </td>
                    <td class="table-title"><h3><span>Dados</span></h3>
                        <?php
                            if ($value['id_status'] > '1') {
                                echo '<p>Data envio: <span class="font-grey-cascade">'.date('d/m/Y H:i:s',strtotime($value['data_abertura'])).'</span></p>';
                            }
                        ?>
                    </td>
                    <td class="table-desc"> Dados pessoais do <?php echo get(glepaweb_membros, id, $value['id_membro'], nome) ;?></td>
                    <td class="table-download"><i class="icon-<?php echo (($value['id_status'] > '2' && $value['id_status'] !== '3') ? 'like font-blue' : 'clock font-yellow-crusta'); ?> "></i></td>
                </tr>
                <?php
                if ($value['id_status'] === '6') {
                ?>
                <tr>
                    <td class="table-status">
                        <a href="publico/imprimir/processos/certificadodegrau.php?id=<?php echo $value['id']; ?>" class="ajaxify"><i class="icon-arrow-right font-blue"></i></a>
                    </td>
                    <td class="table-title"><h3><span>Concessão de Placet</span></h3>
                        <?php
                        if ($value['data_impressao_concessao'] != '') {
                            echo '<p>Data envio: <span class="font-grey-cascade">'.date('d/m/Y H:i:s',strtotime($anexos['data_pagamento_taxa'])).'</span></p>';
                        }
                        ?>
                    </td>
                    <td class="table-desc">Imprimir a concessão do Certificado de Grau</td>
                    <td class="table-download"><i class="icon-<?php echo ($value['data_impressao_concessao'] != '' ? 'like font-blue' : 'clock font-yellow-crusta'); ?> "></i></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

