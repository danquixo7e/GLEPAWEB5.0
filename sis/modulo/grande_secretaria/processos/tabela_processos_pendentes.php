<?php

require('../../../../config/dtsSis.php');
$readProcessos = read('glepaweb_processos',"WHERE id_status = '2' AND cancelado = '0'");
if ($readProcessos) {
    $records = array();
    $records["data"] = array();
    foreach ($readProcessos as $processos => $value) {
        $records["data"][] = array(
            $value['id'],
            get(glepaweb_lojas, id, $value['id_loja'],nome),
            (($value['id_tipo'] === '1') ? get(glepaweb_dados_processos, id_processo, $value['id'],nome) : get(glepaweb_membros, id, $value['id'], nome)),
            date('d/m/Y',strtotime($value['data_cerimonial'])),
            '<a href="modulo/grande_secretaria/processos/processos_editar.php?id='.$value['id'].'" class="btn green m-icon m-icon-only ajaxify"><i class="m-icon-swapright m-icon-white"></i></a>'
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