<?php
require('../../../../../config/dtsSis.php');
$acao = filter_input(INPUT_POST, 'acao');
switch ($acao){
    case 'sendAprovaDados':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readDados = read('glepaweb_dados_processos', "WHERE id_processo = '$id'");
        if($readDados){
            foreach ($readDados as $dados);
            $f['aprovado'] = '1';
            $f['data_aprovado'] = date('Y-m-d H:i:s');
            update('glepaweb_dados_processos', $f, "id = '$dados[id]'");
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = 'Não foi possível aprovar análise';
        }
        echo json_encode($retorno);
        break;
    case 'sendReprovaDados':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readDados = read('glepaweb_dados_processos',"WHERE id_processo = '$id'");
        if($readDados){
            foreach ($readDados as $dados);
            $o['comentario'] = strtoupper(filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS));
            $o['id_processo'] = $dados['id_processo'];
            $o['data'] = date('Y-m-d H:i:s');
            $o['id_usuario'] = $_SESSION['autGlepa']['id'];
            create('glepaweb_comentarios_processos', $o);
            $f['id_etapa'] = '1';
            $f['id_status'] = '3';
            update('glepaweb_processos', $f, "id = '$dados[id_processo]'");
            $p['enviado'] = '0';
            $p['data_enviado'] = '';
            update('glepaweb_dados_processos', $p, "id = '$dados[id]'");
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
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
            $f['senior_demolay']    = filter_input(INPUT_POST, 'senior_demolay', FILTER_SANITIZE_NUMBER_INT);
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
            update('glepaweb_dados_processos', $f, "id_processo = '$id'");
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
            $documento = filter_input(INPUT_POST, 'documento');
            if ($_FILES[$documento]['tmp_name']) {
                $arquivo = $_FILES[$documento];
                $pasta = '../../../../../uploads/processos_anexo/';
                $ext = strtolower(strrchr($arquivo['name'], '.'));
                $nome = md5(time()) . $ext;
                $f[$documento] = $nome;
                $f['data_' . $documento] = date('Y-m-d H:i:s');
                move_uploaded_file($_FILES[$documento]['tmp_name'], $pasta.$nome);
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
    case 'sendExcluiDocumento':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $documento = filter_input(INPUT_POST, 'doc');
        $readProcesso = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
        if ($readProcesso) {
            $pasta = '../../../../../uploads/processos_anexo/';
            foreach ($readProcesso as $documentos);
            if (file_exists($pasta . $documentos[$documento]) && !is_dir($pasta . $documentos[$documento])) {
                unlink($pasta . $documentos[$documento]);
                $f[$documento] = NULL;
                $f['data_' . $documento] = '0000-00-00';
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
    case 'sendReprovaAnexos':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readAnexos = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
        if ($readAnexos) {
            foreach ($readAnexos as $anexos);
            $o['comentario'] = strtoupper(filter_input(INPUT_POST, 'comentario',FILTER_SANITIZE_SPECIAL_CHARS));
            $o['id_processo'] = $anexos['id_processo'];
            $o['data'] = date('Y-m-d H:i:s');
            $o['id_usuario'] = $_SESSION['autGlepa']['id'];
            create('glepaweb_comentarios_processos', $o);
            $f['id_etapa'] = '3';
            $f['id_status'] = '3';
            update('glepaweb_processos', $f, "id = '$anexos[id_processo]'");
            $p['enviado'] = '0';
            $p['data_enviado'] = '';
            update('glepaweb_anexos_processos', $p, "id_processo = '$anexos[id_processo]'");
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendAprovaAnexos':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readAnexos = read('glepaweb_anexos_processos', "WHERE id_processo = '$id'");
        if ($readAnexos) {
            foreach ($readAnexos as $anexos);
            $f['aprovado'] = '1';
            $f['data_aprovado'] = date('Y-m-d H:i:s');
            update('glepaweb_anexos_processos', $f, "id_processo = '$anexos[id_processo]'");
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendAlteraData':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
        if ($readProcesso) {
            $f['data_cerimonial'] = filter_input(INPUT_POST, 'data_cerimonial');
            $f['data_cerimonial'] = formDate($f['data_cerimonial']);
            update('glepaweb_processos', $f, "id = '$id'");
            $retorno['sucesso'] = true;
        } else {
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendReprovaData':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readProcesso = read('glepaweb_processos', "WHERE id = '$id'");
        if ($readProcesso) {
            foreach ($readProcesso as $processo);
            $o['comentario'] = strtoupper(filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS));
            $o['id_processo'] = $processo['id'];
            $o['data'] = date('Y-m-d H:i:s');
            $o['id_usuario'] = $_SESSION['autGlepa']['id'];
            create('glepaweb_comentarios_processos', $o);
            $f['id_etapa'] = '4';
            $f['id_status'] = '3';
            $f['data_cerimonial'] = '';
            update('glepaweb_processos', $f, "id = '$id'");
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    default: echo 'Error';
}
