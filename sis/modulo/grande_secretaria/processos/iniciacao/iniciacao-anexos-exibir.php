<?php
require_once ('../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('3') : header('Location: ' . BASE . '/sis/403.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$documento = filter_input(INPUT_GET, 'doc');
$readAnexo = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
if ($readAnexo) {
    foreach ($readAnexo as $anexo => $value)
        ;
    if (!file_exists('../../../../../uploads/processos_anexo/' . $documento)) {
        header('Location: ' . BASE . '/sis/404.php');
    }
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
            <a href="modulo/grande_secretaria/processos/processos_pendentes.php" class="ajaxify">Processos Pendentes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Editar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-editar.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Analisar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Anexos</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $documento; ?>" class="ajaxify">Visualizar Anexo</a>
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
        <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos.php?id=<?php echo $value['id_processo']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Visualizar 
    <small>documento anexado</small>
</h3>
<div class="full-height-content full-height-content-scrollable">
    <div class="full-height-content-body">
        <iframe src="<?php echo BASE; ?>/uploads/processos_anexo/<?php echo $documento; ?>" width="100%" height="100%" style="border: 0; height: 100vh;"></iframe>
    </div>
</div>