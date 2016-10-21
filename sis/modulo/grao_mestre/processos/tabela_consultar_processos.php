<?php

require('../../../../config/dtsSis.php');
$readProcessos = read('glepaweb_processos');
if ($readProcessos) {
    $records = array();
    $records["data"] = array();
    foreach ($readProcessos as $processos => $value) {
        $records["data"][] = array(
            $value['id'],
            get(glepaweb_lojas, id, $value['id_loja'],nome),
            (($value['id_tipo'] === '1') ? get(glepaweb_dados_processos, id_processo, $value['id'],nome) : get(glepaweb_membros, id, $value['id'], nome)),
            get(glepaweb_status_processos, id, $value['id_status'], status),
            '<a href="modulo/grao_mestre/processos/processos_consultar.php?id='.$value['id'].'" class="btn yellow m-icon m-icon-only ajaxify"><i class="m-icon-swapright m-icon-white"></i></a>'
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