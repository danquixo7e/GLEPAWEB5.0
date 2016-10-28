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
    default: echo 'Error';
}