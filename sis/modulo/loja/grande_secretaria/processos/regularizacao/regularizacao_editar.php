<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = $_GET['id'];
$readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
if ($readProcesso) {
    foreach ($readProcesso as $processo => $value);
    $readDados = read('glepaweb_dados_processos',"WHERE id_processo = '$value[id]'");
    if($readDados){
        foreach ($readDados as $dados);
    }
    $readAnexos = read('glepaweb_anexos_processos',"WHERE id_processo = '$value[id]'");
    if($readAnexos){
        foreach ($readAnexos as $anexos);
    }
    $readHistorico = read('glepaweb_historico_processos',"WHERE id_processo = '$value[id]'");
    if($readHistorico){
        foreach ($readHistorico as $historico);
    }
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
            <a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_editar.php?id=<?php echo $value['id']; ?>" class="ajaxify">Analisar Processo</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Regularização
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
                        if (($value['id_status'] === '1' || $value['id_status'] === '3') && $dados['enviado'] !== '1') {
                            echo '<a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_dados.php?id=' . $value['id'] . '" class="ajaxify"><i class="icon-arrow-right font-blue"></i></a>';
                        }
                        ?>
                    </td>
                    <td class="table-title"><h3><span>Dados Pessoais</span></h3>
                        <?php
                            if ($dados['enviado'] === '1') {
                                echo '<p>Data envio: <span class="font-grey-cascade">'.date('d/m/Y H:i:s',strtotime($dados['data_enviado'])).'</span></p>';
                            }
                        ?>
                    </td>
                    <td class="table-desc"> Dados pessoais do <?php echo get(glepaweb_dados_processos, id_processo, $value['id'], nome) ;?> </td>
                    <td class="table-download"><i class="icon-<?php echo ($dados['aprovado'] === '1' ? 'like font-blue' : 'clock font-yellow-crusta'); ?> "></i></td>
                </tr>
                <?php
                if ($value['id_etapa'] > '1' || $value['id_status'] > '1') {
                ?>
                <tr>
                    <td class="table-status">
                        <?php
                        if (($value['id_status'] === '1' || $value['id_status'] === '3') && $anexos['enviado'] !== '1') {
                            echo '<a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_anexos.php?id=' . $value['id'] . '" class="ajaxify"><i class="icon-arrow-right font-blue"></i></a>';
                        }
                        ?>
                    </td>
                    <td class="table-title"><h3><span>Documentos Anexados</span></h3>
                        <?php
                        if ($documentos['enviado'] === '1') {
                            echo '<p>Data envio: <span class="font-grey-cascade">'.date('d/m/Y H:i:s',strtotime($anexos['data_enviado'])).'</span></p>';
                        }
                        ?>
                    </td>
                    <td class="table-desc">Cópia em .PDF da documentação exigida</td>
                    <td class="table-download"><i class="icon-<?php echo ($anexos['aprovado'] == '1' ? 'like font-blue' : 'clock font-yellow-crusta'); ?> "></i></td>
                </tr>
                <?php
                }
                if ($value['id_etapa'] > '2' || $value['id_status'] > '1') {
                ?>
                <tr>
                    <td class="table-status">
                        <?php
                        if (($value['id_status'] === '1' || $value['id_status'] === '3') && $historico['enviado'] === '0') {
                            echo '<a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_historico.php?id=' . $value['id'] . '" class="ajaxify"><i class="icon-arrow-right font-blue"></i></a>';
                        }
                        ?>
                    </td>
                    <td class="table-title"><h3><span>Histórico</span></h3>
                        <?php
                        if ($historico['data_enviado'] != '') {
                            echo '<p>Data envio: <span class="font-grey-cascade">'.date('d/m/Y H:i:s',strtotime($historico['data_enviado'])).'</span></p>';
                        }
                        ?>
                    </td>
                    <td class="table-desc">Envio das datas de iniciação, elevação e exaltação</td>
                    <td class="table-download"><i class="icon-<?php echo ($historico['aprovado'] === '1' ? 'like font-blue' : 'clock font-yellow-crusta'); ?> "></i></td>
                </tr>
                <?php
                }
                if ($value['id_etapa'] === '4' || $value['id_status'] > '1') {
                ?>
                <tr>
                    <td class="table-status">
                        <?php
                        if (($value['id_status'] === '1' || $value['id_status'] === '3') && $value['data_prevista'] == '') {
                            echo '<a href="modulo/loja/grande_secretaria/processos/regularizacao/regularizacao_data.php?id=' . $value['id'] . '" class="ajaxify"><i class="icon-arrow-right font-blue"></i></a>';
                        }
                        ?>
                    </td>
                    <td class="table-title"><h3><span>Data Cerimonial</span></h3>
                        <?php
                        if ($value['data_envio_data_cerimonial'] != '') {
                            echo '<p>Data envio: <span class="font-grey-cascade">'.date('d/m/Y H:i:s',strtotime($value['data_envio_data_cerimonial'])).'</span></p>';
                        }
                        ?>
                    </td>
                    <td class="table-desc">Data prevista para o cerimonial</td>
                    <td class="table-download"><i class="icon-<?php echo ($value['data_prevista_aprovado'] == '1' ? 'like font-blue' : 'clock font-yellow-crusta'); ?> "></i></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

