<?php
require_once ('../../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('3') : header('Location: ' . BASE . '/sis/403.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$readAnexos = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
if ($readAnexos) {
    foreach ($readAnexos as $anexos => $value);
    $readDados = read('glepaweb_dados_processos',"WHERE id_processo = '$id'");
    if($readDados){
        foreach ($readDados as $dados);
        $idade = calculaIdade($dados['data_nascimento']);
    }
} else {
    header('Location: ' . BASE . '/sis/404.php');
}
?>
<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
        <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-editar.php?id=<?php echo $value['id_processo']; ?>" class="btn btn-outline blue btn-sm ajaxify"><i class="fa fa-angle-left"></i> Voltar </a>
    </div>
    Iniciação 
    <small>documentos anexados</small>
</h3>
<?php
if($idade > 65){
    echo '<div class="note note-warning"><h4 class="block">Atenção! Beneficência Maçônica</h4><p> Este candidato possui mais de 65 anos. Portanto, não precisa do formulário de inscrição na Beneficência Maçônica.  </p></div>';
}
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-edit font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> Documentos Anexados</span>
        </div>
    </div>
    <div class="portlet-body form">

        <form class="horizontal-form" name="formAnexos" id="<?php echo $value['id_processo']; ?>">
            <table class="table table-hover table-light">
                <thead>
                    <tr class="uppercase">
                        <th width="20%"> Documento </th>
                        <th width="60%">  </th>
                        <th width="20%"> Opções </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Página 1 - Proposta </td>
                        <td> 
                            <div class="progress progress-striped active" id="proposta1" style="display: none">
                                <div class="progress-bar progress-bar-success proposta1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['proposta1'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta1'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_proposta1" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="proposta1" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['proposta1'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta1'])) ? 'hide' : '') ?>" id="opcao_proposta1">
                                <a name="proposta1" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['proposta1'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Página 2 - Proposta </td>
                        <td> 
                            <div class="progress progress-striped active" id="proposta2" style="display: none">
                                <div class="progress-bar progress-bar-success proposta2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['proposta2'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta2'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_proposta2" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="proposta2" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['proposta2'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta2'])) ? 'hide' : '') ?>" id="opcao_proposta2">
                                <a name="proposta2" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['proposta2'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Página 3 - Proposta </td>
                        <td> 
                            <div class="progress progress-striped active" id="proposta3" style="display: none">
                                <div class="progress-bar progress-bar-success proposta3" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['proposta3'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta3'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_proposta3" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="proposta3" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['proposta3'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta3'])) ? 'hide' : '') ?>" id="opcao_proposta3">
                                <a name="proposta3" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['proposta3'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Página 4 - Proposta </td>
                        <td> 
                            <div class="progress progress-striped active" id="proposta4" style="display: none">
                                <div class="progress-bar progress-bar-success proposta4" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['proposta4'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta4'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_proposta4" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="proposta4" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['proposta4'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['proposta4'])) ? 'hide' : '') ?>" id="opcao_proposta4">
                                <a name="proposta4" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['proposta4'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> RG e CPF </td>
                        <td> 
                            <div class="progress progress-striped active" id="rg" style="display: none">
                                <div class="progress-bar progress-bar-success rg" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['rg'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['rg'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_rg" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="rg" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['rg'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['rg'])) ? 'hide' : '') ?>" id="opcao_rg">
                                <a name="rg" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['rg'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Certidão de Nascimento </td>
                        <td> 
                            <div class="progress progress-striped active" id="certidao" style="display: none">
                                <div class="progress-bar progress-bar-success certidao" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['certidao'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_certidao" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="certidao" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['certidao'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao'])) ? 'hide' : '') ?>" id="opcao_certidao">
                                <a name="certidao" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['certidao'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Comprovante de Renda </td>
                        <td> 
                            <div class="progress progress-striped active" id="renda" style="display: none">
                                <div class="progress-bar progress-bar-success renda" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['renda'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['renda'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_renda" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="renda" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['renda'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['renda'])) ? 'hide' : '') ?>" id="opcao_renda">
                                <a name="renda" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['renda'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Atestado Médico </td>
                        <td> 
                            <div class="progress progress-striped active" id="medico" style="display: none">
                                <div class="progress-bar progress-bar-success medico" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['medico'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['medico'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_medico" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="medico" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['medico'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['medico'])) ? 'hide' : '') ?>" id="opcao_medico">
                                <a name="medico" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['medico'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Certidao Negativa Judiciário </td>
                        <td> 
                            <div class="progress progress-striped active" id="certidao_negativa_judiciario" style="display: none">
                                <div class="progress-bar progress-bar-success certidao_negativa_judiciario" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['certidao_negativa_judiciario'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_negativa_judiciario'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_certidao_negativa_judiciario" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="certidao_negativa_judiciario" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['certidao_negativa_judiciario'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_negativa_judiciario'])) ? 'hide' : '') ?>" id="opcao_certidao_negativa_judiciario">
                                <a name="certidao_negativa_judiciario" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['certidao_negativa_judiciario'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Certidao Negativa Federal </td>
                        <td> 
                            <div class="progress progress-striped active" id="certidao_negativa_federal" style="display: none">
                                <div class="progress-bar progress-bar-success certidao_negativa_federal" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['certidao_negativa_federal'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_negativa_federal'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_certidao_negativa_federal" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="certidao_negativa_federal" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['certidao_negativa_federal'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_negativa_federal'])) ? 'hide' : '') ?>" id="opcao_certidao_negativa_federal">
                                <a name="certidao_negativa_federal" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['certidao_negativa_federal'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> Certidao Negativa Protesto </td>
                        <td> 
                            <div class="progress progress-striped active" id="certidao_negativa_protesto" style="display: none">
                                <div class="progress-bar progress-bar-success certidao_negativa_protesto" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['certidao_negativa_protesto'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_negativa_protesto'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_certidao_negativa_protesto" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="certidao_negativa_protesto" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['certidao_negativa_protesto'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_negativa_protesto'])) ? 'hide' : '') ?>" id="opcao_certidao_negativa_protesto">
                                <a name="certidao_negativa_protesto" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['certidao_negativa_protesto'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        if($idade <= 65){
                    ?>
                    <tr>
                        <td> Beneficência  </td>
                        <td> 
                            <div class="progress progress-striped active" id="beneficencia" style="display: none">
                                <div class="progress-bar progress-bar-success beneficencia" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['beneficencia'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['beneficencia'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_beneficencia" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="beneficencia" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['beneficencia'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['beneficencia'])) ? 'hide' : '') ?>" id="opcao_beneficencia">
                                <a name="beneficencia" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['beneficencia'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                        if($dados['senior_demolay'] === '1'){
                    ?>
                    <tr>
                        <td> Regularidade DeMolay  </td>
                        <td> 
                            <div class="progress progress-striped active" id="certidao_demolay" style="display: none">
                                <div class="progress-bar progress-bar-success certidao_demolay" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['certidao_demolay'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_demolay'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_certidao_demolay" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="certidao_demolay" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['certidao_demolay'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_demolay'])) ? 'hide' : '') ?>" id="opcao_certidao_demolay">
                                <a name="certidao_demolay" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['certidao_demolay'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                        if($dados['militar'] === '1'){
                    ?>
                    <tr>
                        <td> Certidão Militar  </td>
                        <td> 
                            <div class="progress progress-striped active" id="certidao_militar" style="display: none">
                                <div class="progress-bar progress-bar-success certidao_militar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </td>
                        <td align="right">
                            <div class="fileinput fileinput-new <?php echo(($value['certidao_militar'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_militar'])) ? 'hide' : '') ?>" data-provides="fileinput" id="input_certidao_militar" >
                                <span class="btn green btn-file">
                                    <span class="fileinput-new"> Anexar </span>
                                    <span class="fileinput-exists"> Alterar </span>
                                    <input type="file" name="certidao_militar" accept="application/pdf"> </span>
                            </div>
                            <div class="<?php echo(!($value['certidao_militar'] != '' && file_exists('../../../../../uploads/processos_anexo/' . $value['certidao_militar'])) ? 'hide' : '') ?>" id="opcao_certidao_militar">
                                <a name="certidao_militar" class="btn red btn_exclui"><i class="fa fa-trash-o"></i></a>
                                <a href="modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos-exibir.php?id=<?php echo $value['id_processo']; ?>&doc=<?php echo $value['certidao_militar'] ?>" class="btn blue ajaxify"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <div class="form-actions">
                <a class="btn red reprovaAnexos" id="<?php echo $value['id_processo']; ?>"><i class="fa fa-ban"></i> Reprovar </a>
                <a class="btn green pull-right aprovaAnexos" id="<?php echo $value['id_processo']; ?>"><i class="fa fa-check"></i> Aprovar </a>
            </div>
        </form>

    </div>
</div>
<script type="text/javascript" src="modulo/grande_secretaria/processos/iniciacao/iniciacao.js"></script>