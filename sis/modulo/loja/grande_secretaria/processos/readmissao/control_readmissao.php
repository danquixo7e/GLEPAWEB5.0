<?php

require_once ('../../../../../../config/dtsSis.php');
$acao = filter_input(INPUT_POST, 'acao');
switch ($acao) {
    case 'sendReadmissaoCpf':
        $cpf = filter_input(INPUT_POST, 'cpf');
        $cadastro = filter_input(INPUT_POST, 'cadastro');

        $readMembro = read('glepaweb_membros', "WHERE cpf = '$cpf' AND cadastro = '$cadastro'");
        if ($readMembro) {
            foreach ($readMembro as $membro);
            if ($membro['id_status'] === '2') {
                $loja = $_SESSION['autGlepa']['id_loja'];
                $readProcesso = read('glepaweb_processos', "WHERE id_loja = '$loja' AND id_membro = '$membro[id]' AND id_status > '6' ORDER BY id DESC LIMIT 1");
                if ($readProcesso) {
                    foreach ($readProcesso as $processo);
                    if ($processo['id_tipo'] === '4' || $processo['id_tipo'] === '5' || $processo['id_tipo'] === '6') {
                        if ($processo['id_loja'] === $loja) {
                            $retorno['sucesso'] = true;
                            $retorno['quiteplacet'] = true;
                            $retorno['id'] = $membro['id'];
                        } else {
                            $retorno['sucesso'] = false;
                            $retorno['mensagem'] = 'Este membro não foi excluido por esta loja. Verifique junto a GLEPA';
                        }
                    } else {
                        $retorno['sucesso'] = false;
                        $retorno['mensagem'] = 'O último processo realizado por este membro não foi de exclusão desta Loja. Verifique junto a GLEPA';
                    }
                } else {
                    $retorno['sucesso'] = true;
                    $retorno['id'] = $membro['id'];
                }
            } else {
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Este membro não está inativo no sistema';
            }
        } else {
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = 'Não foi possível encontrar este membro';
        }
        echo json_encode($retorno);
        break;
    case 'sendReadmissaoQuitePlacet':
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

                    if ($_FILES['quite_placet']['tmp_name']) {

                        $arquivo = $_FILES['quite_placet'];
                        $pasta = '../../../../../../uploads/processos_anexo/';
                        $ext = strtolower(strrchr($arquivo['name'], '.'));
                        $nome = md5(time()) . $ext;
                        $p['quite_placet'] = $nome;
                        move_uploaded_file($_FILES['quite_placet']['tmp_name'], $pasta . $nome);


                        $p['id_loja'] = $_SESSION['autGlepa']['id_loja'];
                        $p['id_membro'] = $id;
                        $p['id_tipo'] = '7';
                        $p['id_status'] = '2';
                        $p['data_cerimonial'] = filter_input(INPUT_POST, 'data_cerimonial');
                        $p['data_cerimonial'] = formDate($p['data_cerimonial']);
                        $p['data_abertura'] = date('Y-m-d H:i:s');

                        create('glepaweb_processos', $p);

                        $retorno['sucesso'] = true;
                    } else {
                        $retorno['sucesso'] = false;
                        $retorno['mensagem'] = 'Por favor, envie o Quite Placet deste membro no campo informado';
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
            $retorno['mensagem'] = 'Não foi possível solicitar a exaltação deste membro';
        }
        echo json_encode($retorno);
        break;
    case 'sendReadmissao':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readMembro = read('glepaweb_membros', "WHERE id = '$id'");
        if ($readMembro) {
            $f['cpf'] = filter_input(INPUT_POST, 'cpf');
            $f['rg'] = filter_input(INPUT_POST, 'rg');
            $f['data_nascimento'] = filter_input(INPUT_POST, 'data_nascimento');
            $f['data_nascimento'] = formDate($f['data_nascimento']);
            $f['email'] = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
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

            $p['id_loja'] = $_SESSION['autGlepa']['id_loja'];
            $p['id_membro'] = $id;
            $p['id_tipo'] = '7';
            $p['id_status'] = '2';
            $p['data_cerimonial'] = filter_input(INPUT_POST, 'data_cerimonial');
            $p['data_cerimonial'] = formDate($p['data_cerimonial']);
            $p['data_abertura'] = date('Y-m-d H:i:s');

            create('glepaweb_processos', $p);

            $retorno['sucesso'] = true;
            
        } else {
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    default: echo 'Erro';
}