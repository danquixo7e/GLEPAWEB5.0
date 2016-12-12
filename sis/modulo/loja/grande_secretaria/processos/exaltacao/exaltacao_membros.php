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
            <a href="modulo/loja/grande_secretaria/processos/exaltacao/exaltacao.php" class="ajaxify">Exaltação</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/exaltacao/exaltacao_membros.php" class="ajaxify">Membros</a>
        </li>
    </ul>

</div>
<h3 class="page-title">
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/exaltacao/exaltacao.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Exaltação
    <small>Membros</small>
</h3>
<?php
$id_loja = $_SESSION['autGlepa']['id_loja'];
$readCompanheiros = read('glepaweb_membros',"WHERE id_loja = '$id_loja' AND id_status = '1' AND id_grau = '2'");
if(!$readCompanheiros){
    echo '<div class="mt-element-ribbon bg-grey-steel">
            <div class="ribbon ribbon-left ribbon-vertical-left ribbon-shadow ribbon-border-dash-vert ribbon-color-primary uppercase">
                <div class="ribbon-sub ribbon-bookmark"></div>
                <i class="fa fa-star"></i>
            </div>
            <p class="ribbon-content">A loja não possui companheiros para serem exaltados</p>
        </div>';
}else{
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Companheiros</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="mt-element-card mt-element-overlay">
                    <div class="row">
                        <?php
                        foreach ($readCompanheiros as $companheiros => $value):
                        $nome = ucfirst(strtolower(current(explode(" ", $value['nome'])))) . ' ' . ucfirst(strtolower(end(explode(" ", $value['nome']))));
                        
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="mt-card-item">
                                <div class="mt-card-avatar mt-overlay-4">
                                    <img src="<?php echo (($value['foto'] != '' && file_exists('../../../../../../uploads/fotos/' . $value['foto'])) ? BASE . '/uploads/fotos/' . $value['foto'] : 'assets/global/img/user.jpg'); ?>" />
                                    <div class="mt-overlay">
                                        <h2><?php echo $nome ;?></h2>
                                        <div class="mt-info font-white">
                                            <div class="mt-card-content">
                                                <p class="mt-card-desc font-white"><a href="modulo/loja/grande_secretaria/processos/exaltacao/exaltacao_membro.php?id=<?php echo $value['id'] ;?>" class="btn btn-outline green ajaxify">Solicitar</a></p>
                                                <div class="mt-card-social">
                                                    <ul>
                                                        <li>
                                                            <a class="mt-card-btn" href="javascript:;">
                                                                <i class="icon-magnifier-add"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>