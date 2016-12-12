<?php
require('../../../../../config/dtsSis.php');
$acao = filter_input(INPUT_POST, 'acao');
switch ($acao){
    case 'sendElevacao':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $readProcesso = read('glepaweb_processos',"WHERE id = '$id'");
        if($readProcesso){
            foreach ($readProcesso as $processo);
            $readMembro = read('glepaweb_membros',"WHERE id = '$processo[id_membro]'");
            if($readMembro){
                foreach ($readMembro as $membro);
                $f['cpf']               = filter_input(INPUT_POST, 'cpf');
                $readCpf = read('glepaweb_membros',"WHERE cpf = '$f[cpf]' AND id != '$membro[id]'");
                if(!$readCpf){
                    $f['email']             = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
                    $readEmail = read('glepaweb_membros',"WHERE email = '$f[email]' AND id != '$membro[id]'");
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
                        update('glepaweb_membros', $f, "id = '$membro[id]'");
                        
                        $p['data_cerimonial'] = filter_input(INPUT_POST, 'data_cerimonial');
                        $p['data_cerimonial'] = formDate($p['data_cerimonial']);
                        if($membro['senior_demolay'] === '1'){
                            $readIsencao = read('glepaweb_isencao_demolay',"WHERE id_membro = '$membro[id]' AND beneficio = '1'");
                            if($readIsencao){
                                $p['id_status'] = '5';
                                $p['pagamento_taxa'] = '1';
                            }
                        }else{
                            $p['id_status'] = '4';
                            
                            $b['id_loja'] = $processo['id_loja'];
                            $b['id_tipo_cobranca'] = '3';
                            $b['data_vencimento'] = date('Y-m-d',strtotime("-3 days", strtotime($p['data_cerimonial'])));
                            $b['data_documento'] = date('Y-m-d');
                            $b['valor'] = get(glepaweb_tipo_cobranca, id, '3', valor);
                            $b['nosso_numero'] = '03'.str_pad(get('glepaweb_lojas', 'id', $processo['id_loja'], 'numero'), 3 , "0", STR_PAD_LEFT).str_pad($processo['id'], 5 , "0", STR_PAD_LEFT);
                            $b['id_processo'] = $processo['id'];
                            create('glepaweb_boletos', $b);
                        }
                        
                        update('glepaweb_processos', $p, "id = '$processo[id]'");
                        $retorno['sucesso'] = true;
                        
                    }else{
                        $retorno['sucesso'] = false;
                        $retorno['mensagem'] = 'Este e-mail já está em uso em nosso sistema. Por favor, verifique.';
                    }
                }else{
                    foreach ($readCpf as $cpf);
                    $retorno['id'] = $cpf['id'];
                    $retorno['nome'] = $cpf['nome'];
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Este CPF já está em uso em nosso sistema. Por favor, verifique.';
                }
            }else{
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Não foi possível liberar o processo';
            }
        }else{
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = 'Não foi possível liberar o processo';
        }
        echo json_encode($retorno);
        break;
    default: echo 'Error';
}
