<?php
require_once ('../../../../../../config/dtsSis.php');
$acao = filter_input(INPUT_POST, 'acao');
switch ($acao){
    case 'sendCpf':
        $cpf = filter_input(INPUT_POST, 'cpf');
        $readLivro = read('glepaweb_livronegro',"WHERE cpf = '$cpf'");
        if($readLivro){
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = 'Este candidato está impossibilitado de realizar o processo. Por favor, verifique junto a GLEPA';
        }else{
            $readMembro = read('glepaweb_membros',"WHERE cpf = '$cpf'");
            if($readMembro){
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Este CPF já está em uso. Por favor, verifique!';
            }else{
                $readDados = read('glepaweb_dados_processos',"WHERE cpf = '$cpf'");
                if($readDados){
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Já existe um processo para este CPF. Por favor, verifique!';
                }else{
                    $f['id_loja'] = $_SESSION['autGlepa']['id_loja'];
                    $f['id_tipo'] = '8';
                    $f['id_etapa'] = '1';
                    $f['id_status'] = '1';
                    $f['data_abertura'] = date('Y-m-d H:i:s');
                    create('glepaweb_processos', $f);
                    $b['id_processo'] = mysql_insert_id();
                    $b['cpf'] = $cpf;
                    $c['id_processo'] = $b['id_processo'];
                    create('glepaweb_dados_processos', $b);
                    create('glepaweb_anexos_processos', $c);
                    create('glepaweb_historico_processos', $c);
                    $retorno['id'] = $b['id_processo'];
                    $retorno['sucesso'] = true;
                }
            }
        }
        echo json_encode($retorno);
        break;
    case 'sendDadosPessoais':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readDados = read('glepaweb_dados_processos',"WHERE id_processo = '$id'");
        if($readDados){
            $f['cpf']               = filter_input(INPUT_POST, 'cpf');
            $f['nome']              = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['nome']              = formNome($f['nome']);
            $f['pai']               = filter_input(INPUT_POST, 'pai', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['pai']               = formNome($f['pai']);
            $f['mae']               = filter_input(INPUT_POST, 'mae',FILTER_SANITIZE_SPECIAL_CHARS);
            $f['mae']               = formNome($f['mae']);
            $f['naturalidade']      = filter_input(INPUT_POST, 'naturalidade',FILTER_SANITIZE_SPECIAL_CHARS);
            $f['naturalidade']      = formNome($f['naturalidade']);
            $f['nacionalidade']     = filter_input(INPUT_POST, 'nacionalidade', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['nacionalidade']     = formNome($f['nacionalidade']);
            $f['data_nascimento']   = filter_input(INPUT_POST, 'data_nascimento');
            $f['data_nascimento']   = formDate($f['data_nascimento']);
            $f['cep']               = filter_input(INPUT_POST, 'cep');
            $f['endereco']          = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['endereco']          = formNome($f['endereco']);
            $f['telefone']          = filter_input(INPUT_POST, 'telefone');
            $f['celular']           = filter_input(INPUT_POST, 'celular');
            $f['email']             = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $f['militar']           = filter_input(INPUT_POST, 'militar', FILTER_SANITIZE_NUMBER_INT);
            $f['bairro']            = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['bairro']            = formNome($f['bairro']);
            $f['id_estado']         = filter_input(INPUT_POST, 'id_estado', FILTER_SANITIZE_NUMBER_INT);
            $f['id_cidade']         = filter_input(INPUT_POST, 'id_cidade', FILTER_SANITIZE_NUMBER_INT);
            $f['id_profissao']      = filter_input(INPUT_POST, 'id_profissao', FILTER_SANITIZE_NUMBER_INT);
            $f['local_trabalho']    = filter_input(INPUT_POST, 'local_trabalho', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['local_trabalho']    = formNome($f['local_trabalho']);
            $f['rg']                = filter_input(INPUT_POST, 'rg');
            $f['rg_data_expedicao'] = filter_input(INPUT_POST, 'rg_data_expedicao');
            $f['rg_data_expedicao'] = formDate($f['rg_data_expedicao']);
            $f['rg_orgao_emissor']  = filter_input(INPUT_POST, 'rg_orgao_emissor');
            $f['rg_orgao_emissor']  = formNome($f['rg_orgao_emissor']);
            $f['id_grupo_sanguineo'] = filter_input(INPUT_POST, 'id_grupo_sanguineo', FILTER_SANITIZE_NUMBER_INT);
            $f['id_religiao']       = filter_input(INPUT_POST, 'id_religiao', FILTER_SANITIZE_NUMBER_INT);
            $f['id_estado_civil']   = filter_input(INPUT_POST, 'id_estado_civil', FILTER_SANITIZE_NUMBER_INT);
            if($f['id_estado_civil'] === '2' || $f['id_estado_civil'] === '4'){
                $f['nome_esposa']               = filter_input(INPUT_POST, 'nome_esposa', FILTER_SANITIZE_SPECIAL_CHARS);
                $f['nome_esposa']               = formNome($f['nome_esposa']);
                $f['cpf_esposa']                = filter_input(INPUT_POST, 'cpf_esposa');
                $f['id_profissao_esposa']       = filter_input(INPUT_POST, 'id_profissao_esposa', FILTER_SANITIZE_NUMBER_INT);
                $f['data_nascimento_esposa']    = filter_input(INPUT_POST, 'data_nascimento_esposa');
                $f['data_nascimento_esposa']    = formDate($f['data_nascimento_esposa']);
            }
            $f['data_enviado'] = date('Y-m-d H:i:s');
            $f['enviado'] = '1';
            update('glepaweb_dados_processos', $f, "id_processo = '$id'");
            $readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
            if ($readProcesso) {
                foreach ($readProcesso as $processo);
                if ($processo['id_status'] === '1') {
                    $u['id_etapa'] = '3';
                    update('glepaweb_processos', $u, "id = '$id'");
                    $retorno['redireciona'] = true;
                } else {
                    $u['id_etapa'] = '0';
                    $u['id_status'] = '2';
                    update('glepaweb_processos', $u, "id = '$id'");
                }
            }
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendAnexo':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readDocumentos = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
        if ($readDocumentos) {
            $documento = mysql_real_escape_string($_POST['documento']);
            if ($_FILES[$documento]['tmp_name']) {
                $arquivo = $_FILES[$documento];
                $pasta = '../../../../../../uploads/processos_anexo/';
                $ext = strtolower(strrchr($arquivo['name'], '.'));
                $nome = md5(time()) . $ext;
                $f[$documento] = $nome;
                $f['data_' . $documento] = date('Y-m-d H:i:s');
                move_uploaded_file($_FILES[$documento]['tmp_name'], $pasta . $nome);
                update('glepaweb_anexos_processos', $f, "id_processo = '$id'");
                //VERIFICA SE TODOS OS DOCUMENTOS JÁ FORAM ENVIADOS
                $readDados = read('glepaweb_dados_processos',"WHERE id_processo = '$id'");
                if($readDados){
                    foreach ($readDados as $dados);
                }
                $militar = $dados['militar'];
                $idade = calculaIdade($dados['data_nascimento']);
                $readAnexos = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
                foreach ($readAnexos as $anexos);
                if ($anexos['rg'] != '' && $anexos['certidao'] != '' && $anexos['renda'] != '' && $anexos['medico'] != '' && $anexos['certidao_negativa_judiciario'] != '' && $anexos['certidao_negativa_federal'] != '' && $anexos['certidao_negativa_protesto'] != '' && $anexos['proposta1'] != '' && $anexos['proposta2'] != '' && $anexos['proposta3'] != '' && $anexos['proposta4'] != '') {
                    if (($militar === '1' && $anexos['certidao_militar'] != '') && ($idade <= 65 && $anexos['beneficencia'] != '')) {
                        $retorno['redireciona'] = true;
                    } else {
                        if (($militar === '0' && $anexos['certidao_militar'] == '') && ($idade <= 65 && $anexos['beneficencia'] != '')) {
                            $retorno['redireciona'] = true;
                        } else {
                            if (($militar === '1' && $anexos['certidao_militar'] != '') && ($idade > 65 && $anexos['beneficencia'] == '')) {
                                $retorno['redireciona'] = true;
                            }else{
                                if (($militar === '0' && $anexos['certidao_militar'] == '') && ($idade > 65 && $anexos['beneficencia'] == '')) {
                                    $retorno['redireciona'] = true;
                                }
                            }
                        }
                    }
                }
                //VERIFICA SE O PROCESSO ESTÁ EM ANDAMENTO OU COM DOCUMENTAÇÃO INCOMPLETA
                if ($retorno['redireciona'] === true) {
                    $readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
                    if ($readProcesso) {
                        foreach ($readProcesso as $processo);
                        if ($processo['id_status'] === '1') {
                            $u['id_etapa'] = '3';
                            update('glepaweb_processos', $u, "id = '$id'");
                            $z['enviado'] = '1';
                            $z['data_enviado'] = date('Y-m-d H:i:s');
                            update('glepaweb_anexos_processos', $z, "id_processo = '$id'");
                        } else {
                            $u['id_etapa'] = '0';
                            $u['id_status'] = '2';
                            update('glepaweb_processos', $u, "id = '$id'");
                            $z['enviado'] = '1';
                            $z['data_enviado'] = date('Y-m-d H:i:s');
                            update('glepaweb_anexos_processos', $z, "id_processo = '$id'");
                        }
                    }
                }
                $retorno['sucesso'] = true;
            } else {
                $retorno['sucesso'] = false;
            }
        } else {
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendExcluiDocumento':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $documento = filter_input(INPUT_POST, 'doc');
        $readProcesso = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
        if ($readProcesso) {
            $pasta = '../../../../../../uploads/processos_anexo/';
            foreach ($readProcesso as $documentos);
            if (file_exists($pasta . $documentos[$documento]) && !is_dir($pasta . $documentos[$documento])) {
                unlink($pasta . $documentos[$documento]);
                $f[$documento] = NULL;
                update('glepaweb_anexos_processos', $f, "id_processo = '$id'");
                $retorno['sucesso'] = true;
            } else {
                $retorno['sucesso'] = false;
            }
        } else {
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendData':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
        if ($readProcesso) {
            $f['data_cerimonial'] = filter_input(INPUT_POST, 'data_cerimonial');
            $f['data_cerimonial'] = formDate($f['data_cerimonial']);
            $f['data_envio_data_cerimonial'] = date('Y-m-d H:i:s');
            $f['id_etapa'] = '0';
            $f['id_status'] = '2';
            update('glepaweb_processos', $f, "id = '$id'");
            $retorno['sucesso'] = true;
        } else {
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendHistorico':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readProcesso = read('glepaweb_historico_processos', "WHERE id_processo = '$id'");
        if ($readProcesso) {
            $f['ini_data']               = filter_input(INPUT_POST, 'ini_data');
            $f['ini_data']               = formDate($f['ini_data']);
            $f['ini_loja']               = filter_input(INPUT_POST, 'ini_loja', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['ini_loja']               = formNome($f['ini_loja']);
            $f['ini_potencia']           = filter_input(INPUT_POST, 'ini_potencia', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['ini_potencia']           = formNome($f['ini_potencia']);
            $f['ele_data']               = filter_input(INPUT_POST, 'ele_data');
            $f['ele_data']               = formDate($f['ele_data']);
            $f['ele_loja']               = filter_input(INPUT_POST, 'ele_loja', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['ele_loja']               = formNome($f['ele_loja']);
            $f['ele_potencia']           = filter_input(INPUT_POST, 'ele_potencia', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['ele_potencia']           = formNome($f['ele_potencia']);
            $f['exa_data']               = filter_input(INPUT_POST, 'exa_data');
            $f['exa_data']               = formDate($f['exa_data']);
            $f['exa_loja']               = filter_input(INPUT_POST, 'exa_loja', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['exa_loja']               = formNome($f['exa_loja']);
            $f['exa_potencia']           = filter_input(INPUT_POST, 'exa_potencia', FILTER_SANITIZE_SPECIAL_CHARS);
            $f['exa_potencia']           = formNome($f['exa_potencia']);
            $f['enviado'] = '1';
            $f['data_enviado'] = date('Y-m-d H:i:s');
            update('glepaweb_historico_processos', $f, "id_processo = '$id'");
            $readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
            if ($readProcesso) {
                foreach ($readProcesso as $processo);
                if ($processo['id_status'] === '1') {
                    $u['id_etapa'] = '4';
                    update('glepaweb_processos', $u, "id = '$id'");
                    $retorno['redireciona'] = true;
                } else {
                    $u['id_etapa'] = '0';
                    $u['id_status'] = '2';
                    update('glepaweb_processos', $u, "id = '$id'");
                }
            }
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    default: echo 'Error';
}

