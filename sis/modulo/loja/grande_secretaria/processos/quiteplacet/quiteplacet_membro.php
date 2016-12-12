<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$readMembro = read('glepaweb_membros', "WHERE id = '$id'");
if ($readMembro) {
    foreach ($readMembro as $membro => $value);
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
            <a href="modulo/loja/grande_secretaria/processos/processos_iniciar.php" class="ajaxify">Abrir Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet.php" class="ajaxify">Quite Placet</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet_membros.php" class="ajaxify">Membros</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet_membro.php?id=<?php echo $id; ?>" class="ajaxify">Membro</a>
        </li>
    </ul>

</div>
<h3 class="page-title">
    <div class="btn-group pull-right">
        <a href="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet_membros.php" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Quite Placet
    <small>Membro</small>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered" id="form_wizard_quiteplacet">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Quite Placet - <span class="step-title"> Passo 1 de 3 </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" id="formQuitePlacet" name="<?php echo $id; ?>">
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Dados Pessoais </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Dados Maçônicos </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab" class="step">
                                        <span class="number"> 3 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Confirmação </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>
                            <div class="tab-content">
                                <div class="alert alert-danger display-none">
                                    <button class="close" data-dismiss="alert"></button> Por favor, preencha todos os campos
                                </div>
                                <div class="tab-pane active" id="tab1">
                                    <h3 class="block"><i class="icon-user"></i> <?php echo $value['nome']; ?></h3>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">CPF</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control mask_cpf" name="cpf" value="<?php echo ($value['cpf'] != '' ? $value['cpf'] : ''); ?>" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">RG</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control uppercase" name="rg" value="<?php echo ($value['rg'] != '' ? $value['rg'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Data de Nascimento</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control mask_date" name="data_nascimento" value="<?php echo (validaData($value['data_nascimento']) != '' ? date('d/m/Y', strtotime($value['data_nascimento'])) : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input style="text-transform: lowercase" type="text" class="form-control verifica_email" name="email" value="<?php echo ($value['email'] != '' ? $value['email'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">CEP</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control mask_cep busca_cep" name="cep" value="<?php echo ($value['cep'] != '' ? $value['cep'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bairro</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control uppercase" name="bairro" value="<?php echo ($value['bairro'] != '' ? $value['bairro'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Endereço Residencial</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control uppercase" name="endereco" value="<?php echo ($value['endereco'] != '' ? $value['endereco'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Celular</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control mask_tel" name="celular" value="<?php echo ($value['celular'] != '' ? $value['celular'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Profissão</label>
                                        <div class="col-md-6">
                                            <select class="form-control select2me" name="id_profissao">
                                                <?php
                                                $readProfissao = read('glepaweb_profissoes', "ORDER BY profissao ASC");
                                                if ($readProfissao) {
                                                    echo '<option></option>';
                                                    foreach ($readProfissao as $profissao):
                                                        echo '<option value="' . $profissao['id'] . '" ' . ($profissao['id'] === $value['id_profissao'] ? 'selected' : '') . '>' . $profissao['profissao'] . '</option>';
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Endereço de Trabalho</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control uppercase" name="local_trabalho" value="<?php echo ($value['local_trabalho'] != '' ? $value['local_trabalho'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <h3 class="block"><i class="icon-user"></i> <?php echo $value['nome']; ?></h3>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nome Simbólico</label>
                                        <div class="col-md-6">
                                            <div class="input-icon right"><i class="fa "></i>
                                                <input type="text" class="form-control uppercase" name="nome_simbolico" value="<?php echo ($value['nome_simbolico'] != '' ? $value['nome_simbolico'] : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <h3 class="block">Confirmação</h3>
                                    <h4 class="form-section">Informações Pessoais</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Membro:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> <?php echo $value['nome']; ?> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">CPF:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static" data-display="cpf"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">RG:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static" data-display="rg"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Data de Nascimento:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static" data-display="data_nascimento"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static" data-display="email"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">CEP:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static" data-display="cep"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bairro:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static uppercase" data-display="bairro"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Endereço Residencial:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static uppercase" data-display="endereco"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Celular:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static" data-display="celular"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Profissão:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static " data-display="id_profissao"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Endereço de Trabalho:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static uppercase" data-display="local_trabalho"> </p>
                                        </div>
                                    </div>
                                    <h4 class="form-section">Informações do Processo</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tipo de Processo:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> QUITE PLACET </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nome Simbólico:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static uppercase" data-display="nome_simbolico"> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="fa fa-angle-left"></i> Voltar </a>
                                    <a href="javascript:;" class="btn btn-outline green button-next"> Continuar
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <a href="javascript:;" class="btn green button-submit"> Enviar
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    <script src="modulo/loja/grande_secretaria/processos/quiteplacet/quiteplacet.js" type="text/javascript"></script>