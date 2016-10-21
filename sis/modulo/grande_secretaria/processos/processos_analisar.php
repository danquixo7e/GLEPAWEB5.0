<?php
require_once ('../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('3') : header('Location: ' . BASE . '/sis/403.php');
$id = $_GET['id'];
$readProcesso = read('glepaweb_processos',"WHERE id = '$id'");
if($readProcesso){
    foreach ($readProcesso as $processo => $value);
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
            <a href="modulo/grande_secretaria/processos/processos_pendentes.php" class="ajaxify">Processos Pendentes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id'] ;?>" class="ajaxify">Editar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_secretaria/processos/processos_analisar.php?id=<?php echo $value['id'] ;?>" class="ajaxify">Analisar Processo</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> Managed Datatables
    <small>managed datatable samples</small>
</h3>
<div class="row">
    
</div>
<script type="text/javascript" src="modulo/grao_mestre/processos/processos_pendentes.js"></script>