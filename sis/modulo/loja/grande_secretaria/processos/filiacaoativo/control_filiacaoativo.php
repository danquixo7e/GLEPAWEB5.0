<?php

require_once ('../../../../../../config/dtsSis.php');
$acao = filter_input(INPUT_POST, 'acao');
switch ($acao) {
    case 'sendFiliacaoAtivoCpf':
        $cpf = filter_input(INPUT_POST, 'cpf');
        $cadastro = filter_input(INPUT_POST, 'cadastro');

        $readMembro = read('glepaweb_membros', "WHERE cpf = '$cpf' AND cadastro = '$cadastro'");
        if ($readMembro) {
            foreach ($readMembro as $membro);
            if ($membro['id_status'] === '1') {
                if(!($membro['id_loja'] !== '0' && $membro['id_loja2'] !== '0' && $membro['id_loja'] !== '0')){
                    $readProcesso = read('glepaweb_processos', "WHERE id_membro = '$membro[id]' AND cancelado != '1' AND id_status < '8'");
                    if (!$readProcesso) {
                        $loja = $_SESSION['autGlepa']['id_loja'];
                        $distrito = get(glepaweb_lojas, id, $loja, distrito);
                        $rito = get(glepaweb_lojas, id, $loja, rito);
                        $distrito1 = get(glepaweb_lojas, id, $membro[id_loja], distrito);
                        $rito1 = get(glepaweb_lojas, id, $membro[id_loja], rito);
                        $distrito2 = '0';
                        $rito2 = '0';
                        if($membro['id_loja2'] !== '0'){
                            $distrito2 = get(glepaweb_lojas, id, $membro['id_loja2'], distrito);
                            $rito2 = get(glepaweb_lojas, id, $membro['id_loja2'], rito);
                        }
                        if (($distrito1 != $distrito || $rito1 != $rito) && ($distrito2 != $distrito || $rito2 != $rito)) {
                            $retorno['sucesso'] = true;
                            $retorno['id'] = $membro['id'];
                        } else {
                            $retorno['sucesso'] = false;
                            $retorno['mensagem'] = 'Este membro já está filiado a uma Loja do mesmo Rito ou do mesmo Oriente';
                        }
                    } else {
                        $retorno['sucesso'] = false;
                        $retorno['mensagem'] = 'Existe um processo para este membro que não foi concluído';
                    }
                }else{
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Este membro já está filiado em 3 Lojas';
                }
            } else {
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Este membro não está ativo no sistema';
            }
        } else {
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = 'Não foi possível encontrar este membro';
        }
        echo json_encode($retorno);
        break;
    
    case 'sendFiliacaoAtivo':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readMembro = read('glepaweb_membros', "WHERE id = '$id'");
        if ($readMembro) {
            $f['cpf'] = filter_input(INPUT_POST, 'cpf');
            $readCpf = read('glepaweb_membros',"WHERE cpf = '$f[cpf]' AND id != '$id'");
            if(!$readCpf){
                
                $f['email'] = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
                $readEmail = read('glepaweb_membros',"WHERE email = '$f[email]' AND id != '$id'");
                if(!$readEmail){
                    $f['rg'] = filter_input(INPUT_POST, 'rg');
                    $f['data_nascimento'] = filter_input(INPUT_POST, 'data_nascimento');
                    $f['data_nascimento'] = formDate($f['data_nascimento']);
                    $f['cep'] = filter_input(INPUT_POST, 'cep');
                    $f['bairro'] = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['bairro'] = formNome($f['bairro']);
                    $f['endereco'] = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['endereco'] = formNome($f['endereco']);
                    $f['celular'] = filter_input(INPUT_POST, 'celular');
                    $f['id_profissao'] = filter_input(INPUT_POST, 'id_profissao', FILTER_SANITIZE_NUMBER_INT);
                    $f['local_trabalho'] = filter_input(INPUT_POST, 'local_trabalho', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['local_trabalho'] = formNome($f['local_trabalho']);
                    update('glepaweb_membros', $f, "id = '$id'");
                    
                    $id_processo = filter_input(INPUT_POST, 'id_processo', FILTER_SANITIZE_NUMBER_INT);
                    if($id_processo != ''){
                        $readProcesso = read('glepaweb_processos',"WHERE id = '$id_processo'");
                        if($readProcesso){
                            foreach ($readProcesso as $processo);
                            $p['id_status'] = '2';
                            $p['id_etapa'] = '0';
                            update('glepaweb_processos', $p, "id = '$processo[id]'");
                            $retorno['sucesso'] = true;
                        }
                    }else{
                        $p['id_loja'] = $_SESSION['autGlepa']['id_loja'];
                        $p['id_membro'] = $id;
                        $p['id_tipo'] = '10';
                        $p['id_status'] = '2';
                        $p['data_cerimonial'] = filter_input(INPUT_POST, 'data_cerimonial');
                        $p['data_cerimonial'] = formDate($p['data_cerimonial']);
                        $p['data_abertura'] = date('Y-m-d H:i:s');
                        create('glepaweb_processos', $p);
                        $retorno['sucesso'] = true;
                    }
                }else{
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Este e-mail já está em uso em nosso sistema. Por favor, verifique.';
                }
            }else{
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Este CPF já está em uso em nosso sistema. Por favor, verifique.';
            }
        } else {
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    default: echo 'Erro';
}