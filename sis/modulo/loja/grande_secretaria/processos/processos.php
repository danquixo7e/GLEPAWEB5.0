<?php
require_once ('../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="home.php" class="ajaxify"><i class="icon-home"></i> Início</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/processos.php" class="ajaxify">Processos em andamento</a>
        </li>
    </ul>

</div>
<h3 class="page-title"> 
    <div class="btn-group pull-right">
        <a href="home.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Processo
    <small>Em andamento</small>
</h3>
<?php
$loja = $_SESSION['autGlepa']['id_loja'];
$readProcessos = read('glepaweb_processos', "WHERE cancelado != '1' AND id_loja = '$loja' AND id_status < '9'");
if (!$readProcessos) {
    echo '<div class="mt-element-ribbon bg-grey-steel">
            <div class="ribbon ribbon-left ribbon-vertical-left ribbon-shadow ribbon-border-dash-vert ribbon-color-primary uppercase">
                <div class="ribbon-sub ribbon-bookmark"></div>
                <i class="fa fa-star"></i>
            </div>
            <p class="ribbon-content">Não existem processos em andamento</p>
        </div>';
} else {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Processos em Andamento</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="mt-element-card mt-element-overlay">
                        <div class="row">
                            <?php
                            foreach ($readProcessos as $processso => $value):
                                if($value['id_tipo'] === '1' || ($value['id_tipo'] === '8' && $value['id_membro'] === '0')){
                                    $readDados = read('glepaweb_dados_processos', "WHERE id_processo = '$value[id]'");
                                    if ($readDados) {
                                        foreach ($readDados as $dados);
                                        if ($dados['nome'] == '') {
                                            $nome = $dados['cpf'];
                                        } else {
                                            $nome = ucfirst(strtolower(current(explode(" ", $dados['nome'])))) . ' ' . ucfirst(strtolower(end(explode(" ", $dados['nome']))));
                                        }
                                    }
                                }else{
                                    $readDados = read('glepaweb_membros', "WHERE id = '$value[id_membro]'");
                                    if ($readDados) {
                                        foreach ($readDados as $dados);
                                        $nome = ucfirst(strtolower(current(explode(" ", $dados['nome'])))) . ' ' . ucfirst(strtolower(end(explode(" ", $dados['nome']))));
                                    }
                                }
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1">
                                            <img src="<?php echo (($dados['foto'] != '' && file_exists('../../../../../uploads/fotos/' . $dados['foto'])) ? BASE . '/uploads/fotos/' . $dados['foto'] : 'assets/global/img/user.jpg'); ?>" />
                                            <div class="mt-overlay">
                                                <ul class="mt-info">
                                                    <li>
                                                        <a class="btn default yellow btn-outline ajaxify" href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id']; ?>">
                                                            <i class="icon-magnifier"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-card-content">
                                            <h3 class="mt-card-name"><?php echo $nome; ?></h3>
                                            <p class="mt-card-desc font-grey-mint"><?php echo get(glepaweb_tipo_processos, id, $value['id_tipo'], tipo); ?></p>
                                            <p class="mt-card-desc font-grey-mint">#<?php echo $value['id']; ?></p>
                                            <div class="mt-card-social">
                                                <a href="modulo/loja/grande_secretaria/processos/processos_editar.php?id=<?php echo $value['id']; ?>" class="btn btn-circle btn-sm <?php echo $value['id_status'] === '3' ? 'red' : 'yellow' ;?> btn-outline ajaxify"><?php echo get(glepaweb_status_processos, id, $value['id_status'], status) ;?></a>
                                            </div>
                                            <br>
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