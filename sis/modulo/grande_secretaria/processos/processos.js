$('#tabela_processos_pendentes').DataTable({
    ajax: "modulo/grande_secretaria/processos/tabela_processos_pendentes.php",
    initComplete: function () {
        App.init();
    },
    order: [[0, "desc"]],
    pageLength: 10,
    pagingType: "bootstrap_full_number",
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese.json"
    }
});
$('#tabela_consultar_processos').DataTable({
    ajax: "modulo/grande_secretaria/processos/tabela_consultar_processos.php",
    initComplete: function () {
        App.init();
    },
    order: [[0, "desc"]],
    pageLength: 10,
    pagingType: "bootstrap_full_number",
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese.json"
    }
});
$('.btn_libera_processo').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Liberar Processo",
        text: "Você tem certeza que deseja liberar este processo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, liberar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: 'modulo/grande_secretaria/processos/control_processos.php',
                        data: {acao: 'sendLiberaProcesso', id: id_processo},
                        type: 'POST',
                        cache: false,
                        beforeSend: function () {

                        },
                        success: function (res) {
                            resposta = $.parseJSON(res);
                            if (resposta.sucesso === true) {
                                swal("Liberado!", "O processo foi liberado.", "success");
                                $.ajax({
                                    url: 'modulo/grande_secretaria/processos/processos_pendentes.php',
                                    success: function (res) {
                                        $('.page-content .page-content-body').html(res);
                                        Layout.fixContentHeight();
                                        App.initAjax();
                                    }
                                });
                            } else {
                                swal("Erro!", "O processo não foi liberado.", "error");
                            }
                        },
                        complete: function () {

                        }
                    });
                }
            });
});