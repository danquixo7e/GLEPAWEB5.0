<?php

require('../../../../../../config/dtsSis.php');
$loja = $_SESSION['autGlepa']['id_loja'];
$readMestres = read('glepaweb_membros',"WHERE (id_loja = '$loja' OR id_loja2 = '$loja' OR id_loja3 = '$loja') AND id_status = '1' AND id_grau = '3'");
if ($readMestres) {
    $records = array();
    $records["data"] = array();
    foreach ($readMestres as $mestres => $value) {
        $records["data"][] = array(
            '<a href="modulo/loja/grande_secretaria/processos/placetdeexclusao/placetdeexclusao_membro.php?id='.$value['id'].'" class="ajaxify">'.$value['nome'].'</a>'
        );
    }
    echo json_encode($records);
} else {
    echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
}