<?php

ob_start();
session_start();
require_once ('dbaSis.php');

function myAutSis($nivel = NULL) {
    if ($_SESSION['autGlepa']) {
        $id = $_SESSION['autGlepa']['id'];
        $email = $_SESSION['autGlepa']['email'];
        $senha = $_SESSION['autGlepa']['hash'];
        $readAutUser = read('glepaweb_usuarios', "WHERE id = '$id' AND email = '$email' AND hash = '$senha' AND status = '1'");
        if (!$readAutUser) {
            unset($_SESSION['autGlepa']);
            header('Location: index.php');
        } else {
            if (isset($nivel) && $nivel != $_SESSION['autGlepa']['id_modulo']) {
                header('Location: ' . BASE . '/sis/403.php');
            }
        }
    } else {
        header('Location: ' . BASE . '/sis/dashboard.php');
    }
}

function get($tabelaId, $colunaId, $id, $campo = NULL) {
    $elemento = mysql_real_escape_string($id);
    $coluna = mysql_real_escape_string($colunaId);
    $tabela = mysql_real_escape_string($tabelaId);
    $read = read($tabela, "WHERE $coluna = '$elemento'");
    if ($read) {
        if ($campo) {
            foreach ($read as $r => $value) {
                return $value[$campo];
            }
        } else {
            return $read;
        }
    } else {
        return NULL;
    }
}

function setArq($nomeArquivo) {
    if (file_exists($nomeArquivo . '.php')) {
        include($nomeArquivo . '.php');
    } else {
        echo 'Erro ao incluir <strong>' . $nomeArquivo . '.php</strong>, arquivo ou caminho não conferem!';
    }
}

//function sendMail($assunto, $mensagem, $remetente, $nomeRemetente, $destino, $nomeDestino, $reply = NULL, $replyNome = NULL) {
//    require_once('mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer
//    $mail = new PHPMailer(); //INICIA A CLASSE
//    //$mail->IsSMTP(); //Habilita envio SMPT
//    $mail->SMTPAuth = false; //Ativa email autenticado
//    $mail->IsHTML(true);
//    $mail->Host = MAILHOST; //Servidor de envio
//    $mail->Port = MAILPORT; //Porta de envio
//    $mail->Username = MAILUSER; //email para smtp autenticado
//    $mail->Password = MAILPASS; //seleciona a porta de envio
//    $mail->From = utf8_decode($remetente); //remtente
//    $mail->FromName = utf8_decode($nomeRemetente); //remetente nome
//    if ($reply != NULL) {
//        $mail->AddReplyTo(utf8_decode($reply), utf8_decode($replyNome));
//    }
//    $mail->Subject = utf8_decode($assunto); //assunto
//    $mail->Body = utf8_decode($mensagem); //mensagem
//    $mail->AddAddress(utf8_decode($destino), utf8_decode($nomeDestino)); //email e nome do destino
//    if ($mail->Send()) {
//        return true;
//    } else {
//        return false;
//    }
//}

function validaData($data) {
    if (!empty($data) && $data !== '1969-12-31') {
        $data = mysql_real_escape_string($data);
        $data = split("[-,/]", $data);
        if (!checkdate($data[1], $data[0], $data[2]) and ! checkdate($data[1], $data[2], $data[0])) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

function formDate($data) {
    if ($data == '') {
        return $data;
    } else {
        $resultado = implode("-", array_reverse(explode("/", $data)));
        return $resultado;
    }
}

function formNome($string) {
    return strtoupper(strtr(utf8_decode($string), utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ"), "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy"));
}

function calculaIdade($data_nascimento) {
    $data_nascimento = strtotime($data_nascimento . " 00:00:00");
    $data_calcula = strtotime(date('Y-m-d') . " 00:00:00");
    $idade = floor(abs($data_calcula - $data_nascimento) / 60 / 60 / 24 / 365);
    return $idade;
}

function sendMail($assunto, $mensagem, $remetente, $nomeRemetente, $destino, $nomeDestino, $reply = NULL, $replyNome = NULL) {
    require_once('mail/class.phpmailer.php');
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = MAILHOST;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = MAILUSER;                 // SMTP username
    $mail->Password = MAILPASS;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = MAILPORT;                                    // TCP port to connect to

    $mail->setFrom(utf8_decode($remetente), utf8_decode($nomeRemetente));
    $mail->addAddress(utf8_decode($destino), utf8_decode($nomeDestino));     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    if($reply != NULL){
        $mail->addReplyTo(utf8_decode($reply), utf8_decode($replyNome));
    }
    $mail->Subject = utf8_decode($assunto);
    $mail->Body = utf8_decode($mensagem);
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        return true;
    } else {
        return false;
    }
}
