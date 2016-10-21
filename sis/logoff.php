<?php
ob_start();
session_start();
if(!empty($_SESSION['autGlepa'])){
    unset($_SESSION['autGlepa']);
}
if(!empty($_SESSION['autRoute'])){
    unset($_SESSION['autRoute']);
}
header('Location: index.php');
ob_end_flush();
?>