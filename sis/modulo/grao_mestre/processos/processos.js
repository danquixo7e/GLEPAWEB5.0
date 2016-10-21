$('#tabela_processos_pendentes').DataTable({
    ajax: "modulo/grao_mestre/processos/tabela_processos_pendentes.php",
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
    ajax: "modulo/grao_mestre/processos/tabela_consultar_processos.php",
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
$('.btn_cancela_processo').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Cancelar Processo",
        text: "Você tem certeza que deseja cancelar este processo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, cancelar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: 'modulo/grao_mestre/processos/control_processos.php',
                        data: {acao: 'sendCancelarProcesso', id: id_processo},
                        type: 'POST',
                        cache: false,
                        beforeSend: function () {

                        },
                        success: function (res) {
                            resposta = $.parseJSON(res);
                            if (resposta.sucesso === true) {
                                swal("Cancelado!", "O processo foi cancelado.", "success");
                                App.scrollTop();
                                $.ajax({
                                    url: 'modulo/grao_mestre/processos/processos_editar.php?id=' + id_processo,
                                    success: function (res) {
                                        $('.page-content .page-content-body').html(res);
                                        Layout.fixContentHeight();
                                        App.initAjax();
                                    },
                                    error: function () {
                                        $.ajax({
                                            url: '404.php',
                                            success: function (res) {
                                                $('.page-content .page-content-body').html(res);
                                                Layout.fixContentHeight();
                                            }
                                        });
                                    }
                                });
                            } else {
                                swal("Erro!", "O processo não foi cancelado.", "error");
                            }
                        },
                        complete: function () {

                        }
                    });
                }
            });
});
$('.btn_reativa_processo').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Reativar Processo",
        text: "Você tem certeza que deseja reativar este processo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, reativar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: 'modulo/grao_mestre/processos/control_processos.php',
                        data: {acao: 'sendReativaProcesso', id: id_processo},
                        type: 'POST',
                        cache: false,
                        beforeSend: function () {

                        },
                        success: function (res) {
                            resposta = $.parseJSON(res);
                            if (resposta.sucesso === true) {
                                swal("Reativado!", "O processo foi ativado.", "success");

                                App.scrollTop();
                                $.ajax({
                                    url: 'modulo/grao_mestre/processos/processos_editar.php?id=' + id_processo,
                                    success: function (res) {
                                        $('.page-content .page-content-body').html(res);
                                        Layout.fixContentHeight();
                                        App.initAjax();
                                    },
                                    error: function () {
                                        $.ajax({
                                            url: '404.php',
                                            success: function (res) {
                                                $('.page-content .page-content-body').html(res);
                                                Layout.fixContentHeight();
                                            }
                                        });
                                    }
                                });
                            } else {
                                swal("Erro!", "O processo não foi ativado.", "error");
                            }
                        },
                        complete: function () {

                        }
                    });
                }
            });
});
$('.btn_libera_concessao').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Liberar Processo",
        text: "Você tem certeza que deseja liberar esta concessão?",
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
                        url: 'modulo/grao_mestre/processos/control_processos.php',
                        data: {acao: 'sendLiberaConcessao', id: id_processo},
                        type: 'POST',
                        cache: false,
                        beforeSend: function () {

                        },
                        success: function (res) {
                            resposta = $.parseJSON(res);
                            if (resposta.sucesso === true) {
                                swal("Liberado!", "O processo foi liberado.", "success");
                                $.ajax({
                                    url: 'modulo/grao_mestre/processos/processos_pendentes.php',
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