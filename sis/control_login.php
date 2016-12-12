<?php
require('../config/dtsSis.php');
$acao = mysql_real_escape_string($_POST['acao']);
switch ($acao){
    case 'sendLogin':
        $user   = mysql_real_escape_string($_POST['email']);
        $code   = mysql_real_escape_string($_POST['senha']);
        $senha  = md5($code);
        $readUser = read('glepaweb_usuarios',"WHERE email = '$user' AND hash = '$senha'");
        if($readUser){
            foreach ($readUser as $users);
            if($users['status'] == '1'){
                setcookie('autGlepa','',time()+3600,'/');
                if($users['id_modulo'] === '11'){
                    $_SESSION['autGlepa'] = $users;
                    $retorno['sucesso'] = true;
                }else{
                    $_SESSION['autRoute'] = $users;
                    $retorno['route'] = true;
                }
            }else{
                $retorno['sucesso'] = false;
            }
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
    break;
    case 'sendLoginPerfil':
        $id = mysql_real_escape_string($_POST['id']);
        $readUser = read('glepaweb_usuarios',"WHERE id = '$id'");
        if($readUser){
            foreach ($readUser as $user);
            unset($_SESSION['autRoute']);
            $_SESSION['autGlepa'] = $user;
            $_SESSION['autGlepa']['id_modulo'] = '10';
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    case 'sendLoginConta':
        $id = mysql_real_escape_string($_POST['id']);
        $readUser = read('glepaweb_usuarios',"WHERE id = '$id'");
        if($readUser){
            foreach ($readUser as $user);
            unset($_SESSION['autRoute']);
            $_SESSION['autGlepa'] = $user;
            $retorno['sucesso'] = true;
        }else{
            $retorno['sucesso'] = false;
        }
        echo json_encode($retorno);
        break;
    default: echo 'Error';
}