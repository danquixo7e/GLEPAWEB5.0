<?php
require('../config/dtsSis.php');
$acao = mysql_real_escape_string($_POST['acao']);
switch ($acao){
    case 'readCidades':
        $estado_id = mysql_real_escape_string($_POST['id']);
        if($estado_id !== ''){
            $readCidades = read('glepaweb_cidades', "WHERE estado_id = '$estado_id'");
            if ($readCidades) {
                echo '<option></option>';
                foreach ($readCidades as $cidades):
                    echo '<option value="' . $cidades['id'] . '">' . $cidades['nome'] . '</option>';
                endforeach;
            }
        }
        break;
    case 'sendEmail':
        $readMail = read('glepaweb_usuarios');
        if($readMail){
            foreach ($readMail as $mail);
            $msg = 'Teste';
            sendMail('Teste de Email', $msg, MAILUSER, SITENAME, $mail['email'], $mail['nome']);
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    default: echo 'Error';
}