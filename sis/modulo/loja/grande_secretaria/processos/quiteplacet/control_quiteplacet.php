<?php
require_once ('../../../../../../config/dtsSis.php');
$acao = filter_input(INPUT_POST, 'acao');
switch ($acao){
    case 'sendQuitePlacet':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readMembro = read('glepaweb_membros',"WHERE id = '$id'");
        if($readMembro){
            $f['cpf']               = filter_input(INPUT_POST, 'cpf');
            $readCpf = read('glepaweb_membros',"WHERE cpf = '$f[cpf]' AND id != '$id'");
            if(!$readCpf){
                $f['email']             = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
                $readEmail = read('glepaweb_membros',"WHERE email = '$f[email]' AND id != '$id'");
                if(!$readEmail){
                    $f['rg']                = filter_input(INPUT_POST, 'rg');
                    $f['data_nascimento']   = filter_input(INPUT_POST, 'data_nascimento');
                    $f['data_nascimento']   = formDate($f['data_nascimento']);
                    $f['cep']               = filter_input(INPUT_POST, 'cep');
                    $f['bairro']            = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['bairro']            = formNome($f['bairro']);
                    $f['endereco']          = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['endereco']          = formNome($f['endereco']);
                    $f['celular']           = filter_input(INPUT_POST, 'celular');
                    $f['id_profissao']      = filter_input(INPUT_POST, 'id_profissao', FILTER_SANITIZE_NUMBER_INT);
                    $f['local_trabalho']    = filter_input(INPUT_POST, 'local_trabalho', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['local_trabalho']    = formNome($f['local_trabalho']);
                    $f['nome_simbolico']    = filter_input(INPUT_POST, 'nome_simbolico', FILTER_SANITIZE_SPECIAL_CHARS);
                    $f['nome_simbolico']    = formNome($f['nome_simbolico']);
                    update('glepaweb_membros', $f, "id = '$id'");

                    $id_loja = $_SESSION['autGlepa']['id_loja'];
                    $p['id_loja'] = $id_loja;
                    $p['id_membro'] = $id;
                    $p['id_tipo'] = '4';
                    $p['id_status'] = '2';
                    $p['data_abertura'] = date('Y-m-d H:i:s');
                    create('glepaweb_processos', $p);
                    $retorno['sucesso'] = true;
                }else{
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Este e-mail já está em uso em nosso sistema. Por favor, verifique.';
                }
            }else{
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Este CPF já está em uso em nosso sistema. Por favor, verifique.';
            }
        }else{
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = 'Não foi possível solicitar o Quite Placet deste membro';
        }
        echo json_encode($retorno);
        break;
    default: echo 'Erro';
}