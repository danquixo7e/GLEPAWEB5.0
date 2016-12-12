<?php
require_once ('../../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('10') : header('Location: ' . BASE . '/sis/403.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$readDados = read('glepaweb_dados_processos', "WHERE id_processo = '$id'");
if ($readDados) {
    foreach ($readDados as $dados => $value)
        ;
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
            <a href="modulo/loja/grande_secretaria/processos/processos.php" class="ajaxify">Abrir Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao.php" class="ajaxify">Iniciação</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao_editar.php?id=<?php echo $value['id_processo']; ?>" class="ajaxify">Analisar Processo</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao_dados.php?id=<?php echo $value['id_processo'] ;?>" class="ajaxify">Dados Pessoais</a>
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
        <a href="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao_editar.php?id=<?php echo $value['id_processo']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Iniciação 
    <small>dados pessoais</small>
</h3>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-edit font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> Dados Pessoais</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="horizontal-form" name="formDadosPessoais" id="<?php echo $value['id_processo']; ?>">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> 
                Por favor, preencha todas as informações.
            </div>
            <div class="form-body">
                <h3 class="form-section">Informações Pessoais do Candidato</h3>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">CPF</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_cpf" name="cpf" value="<?php echo $value['cpf'] ? $value['cpf'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Nome </label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="nome" value="<?php echo $value['nome'] ? $value['nome'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Nome do Pai</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="pai" value="<?php echo $value['pai'] ? $value['pai'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Nome da Mãe</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="mae" value="<?php echo $value['mae'] ? $value['mae'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Naturalidade</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="naturalidade" value="<?php echo $value['naturalidade'] ? $value['naturalidade'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Nacionalidade</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="nacionalidade" value="<?php echo $value['nacionalidade'] ? $value['nacionalidade'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Data de Nascimento</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_date" name="data_nascimento" value="<?php echo validaData($value['data_nascimento']) ? date('d/m/Y', strtotime($value['data_nascimento'])) : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">CEP</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_cep busca_cep" name="cep" value="<?php echo $value['cep'] ? $value['cep'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="control-label">Endereço</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase " name="endereco" value="<?php echo $value['endereco'] ? $value['endereco'] : '' ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Telefone</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_tel" name="telefone" value="<?php echo $value['telefone'] ? $value['telefone'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Celular</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_tel" name="celular" value="<?php echo $value['celular'] ? $value['celular'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">E-mail</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input style="text-transform: lowercase" type="text" class="form-control" name="email" value="<?php echo $value['email'] ? $value['email'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group col-md-6">
                            <label>Militar</label>
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="militar" value="1" <?php echo ($value['militar'] === '1' ? 'checked' : ''); ?>> Sim 
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="militar" value="0" <?php echo ($value['militar'] === '0' ? 'checked' : ''); ?>> Não 
                                    <span></span>
                                </label>
                            </div>
                        </div> 
                        <div class="form-group col-md-6">
                            <label>Demolay</label>
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="senior_demolay" value="1" <?php echo ($value['senior_demolay'] === '1' ? 'checked' : ''); ?>> Sim 
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="senior_demolay" value="0" <?php echo ($value['senior_demolay'] === '0' ? 'checked' : ''); ?>> Não 
                                    <span></span>
                                </label>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Bairro</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="bairro" value="<?php echo $value['bairro'] ? $value['bairro'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Estado</label>
                        <select class="form-control select2me read_cidades" name="id_estado">
                            <?php
                            $readEstado = read('glepaweb_estados', "ORDER BY nome ASC");
                            if ($readEstado) {
                                echo '<option></option>';
                                foreach ($readEstado as $estado):
                                    echo '<option value="' . $estado['id'] . '" ' . ($estado['id'] === $value['id_estado'] ? 'selected' : '') . '>' . $estado['nome'] . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Cidade</label>
                        <select class="form-control select2me" name="id_cidade">
                            <?php
                            $readCidade = read('glepaweb_cidades', "WHERE estado_id = '$value[id_estado]' ORDER BY nome ASC");
                            if ($readCidade) {
                                echo '<option></option>';
                                foreach ($readCidade as $cidade):
                                    echo '<option value="' . $cidade['id'] . '" ' . ($cidade['id'] === $value['id_cidade'] ? 'selected' : '') . '>' . $cidade['nome'] . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Profissão</label>
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
                    <div class="form-group col-md-6">
                        <label class="control-label">Endereço de Trabalho</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="local_trabalho" value="<?php echo $value['local_trabalho'] ? $value['local_trabalho'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">RG</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="rg" value="<?php echo $value['rg'] ? $value['rg'] : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Data de Expedição</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control mask_date" name="rg_data_expedicao" value="<?php echo validaData($value['rg_data_expedicao']) ? date('d/m/Y', strtotime($value['rg_data_expedicao'])) : '' ?>" /> </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Órgão Emissor</label>
                        <div class="input-icon right"><i class="fa "></i>
                            <input type="text" class="form-control uppercase" name="rg_orgao_emissor" value="<?php echo $value['rg_orgao_emissor'] ? $value['rg_orgao_emissor'] : '' ?>" /> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Grupo Sanguíneo</label>
                        <select class="form-control" name="id_grupo_sanguineo">
                            <?php
                            $readGrupoSanguineo = read('glepaweb_grupos_sanguineo');
                            if ($readGrupoSanguineo) {
                                echo '<option></option>';
                                foreach ($readGrupoSanguineo as $grupo):
                                    echo '<option value="' . $grupo['id'] . '" ' . ($grupo['id'] === $value['id_grupo_sanguineo'] ? 'selected' : '') . '>' . $grupo['grupo'] . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Religião</label>
                        <select class="form-control" name="id_religiao">
                            <?php
                            $readReligiao = read('glepaweb_religioes');
                            if ($readReligiao) {
                                echo '<option></option>';
                                foreach ($readReligiao as $religiao):
                                    echo '<option value="' . $religiao['id'] . '" ' . ($religiao['id'] === $value['id_religiao'] ? 'selected' : '') . '>' . $religiao['religiao'] . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Estado Cívil</label>
                        <select class="form-control estado_civil" name="id_estado_civil">
                            <?php
                            $readEstadoCivil = read('glepaweb_estados_civis');
                            if ($readEstadoCivil) {
                                echo '<option></option>';
                                foreach ($readEstadoCivil as $estado_civil):
                                    echo '<option value="' . $estado_civil['id'] . '" ' . ($estado_civil['id'] === $value['id_estado_civil'] ? 'selected' : '') . '>' . $estado_civil['estado_civil'] . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="div_esposa" style="display: <?php echo ($value['id_estado_civil'] === '2' || $value['id_estado_civil'] === '4' ? 'block' : 'none'); ?>">
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Nome da Cunhada</label>
                            <div class="input-icon right"><i class="fa "></i>
                                <input type="text" class="form-control uppercase" name="nome_esposa" value="<?php echo $value['nome_esposa'] ? $value['nome_esposa'] : '' ?>" /> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">CPF da Cunhada</label>
                            <div class="input-icon right"><i class="fa "></i>
                                <input type="text" class="form-control mask_cpf" name="cpf_esposa" value="<?php echo $value['cpf_esposa'] ? $value['cpf_esposa'] : '' ?>" /> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Profissão da Cunhada</label>
                            <select class="form-control select2me" name="id_profissao_esposa">
                                <?php
                                $readProfissaoE = read('glepaweb_profissoes', "ORDER BY profissao ASC");
                                if ($readProfissaoE) {
                                    echo '<option></option>';
                                    foreach ($readProfissaoE as $profissaoE):
                                        echo '<option value="' . $profissaoE['id'] . '" ' . ($profissaoE['id'] === $value['id_profissao_esposa'] ? 'selected' : '') . '>' . $profissaoE['profissao'] . '</option>';
                                    endforeach;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Data de Nascimento da Cunhada</label>
                            <div class="input-icon right"><i class="fa "></i>
                                <input type="text" class="form-control mask_date" name="data_nascimento_esposa" value="<?php echo validaData($value['data_nascimento_esposa']) ? date('d/m/Y', strtotime($value['data_nascimento_esposa'])) : '' ?>" /> </div>
                        </div>
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
<script type="text/javascript" src="modulo/loja/grande_secretaria/processos/iniciacao/iniciacao.js"></script>