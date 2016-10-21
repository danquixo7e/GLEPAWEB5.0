<?php
ob_start();
session_start();
require_once ('dbaSis.php');

function myAutSis($nivel = NULL){
    if($_SESSION['autGlepa']){
        $id         = $_SESSION['autGlepa']['id'];
        $email      = $_SESSION['autGlepa']['email'];
        $senha      = $_SESSION['autGlepa']['hash'];
        $readAutUser = read('glepaweb_usuarios',"WHERE id = '$id' AND email = '$email' AND hash = '$senha' AND status = '1'");
        if(!$readAutUser){
            unset($_SESSION['autGlepa']);
            header('Location: index.php');
        }else{
            if(isset($nivel) && $nivel != $_SESSION['autGlepa']['id_modulo']){
                header('Location: '.BASE.'/sis/403.php');
            }
        }
    }else{
        header('Location: '.BASE.'/sis/dashboard.php');
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



function sendMail($assunto, $mensagem, $remetente, $nomeRemetente, $destino, $nomeDestino, $reply = NULL, $replyNome = NULL) {
    require_once('mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer
    $mail = new PHPMailer(); //INICIA A CLASSE
    //$mail->IsSMTP(); //Habilita envio SMPT
    $mail->SMTPAuth = false; //Ativa email autenticado
    $mail->IsHTML(true);
    $mail->Host = MAILHOST; //Servidor de envio
    $mail->Port = MAILPORT; //Porta de envio
    $mail->Username = MAILUSER; //email para smtp autenticado
    $mail->Password = MAILPASS; //seleciona a porta de envio
    $mail->From = utf8_decode($remetente); //remtente
    $mail->FromName = utf8_decode($nomeRemetente); //remetente nome
    if ($reply != NULL) {
        $mail->AddReplyTo(utf8_decode($reply), utf8_decode($replyNome));
    }
    $mail->Subject = utf8_decode($assunto); //assunto
    $mail->Body = utf8_decode($mensagem); //mensagem
    $mail->AddAddress(utf8_decode($destino), utf8_decode($nomeDestino)); //email e nome do destino
    if ($mail->Send()) {
        return true;
    } else {
        return false;
    }
}