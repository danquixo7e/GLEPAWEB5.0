var formCpf = $('form[name="formCPf"]');
var errorDados = $('.alert-danger', formCpf);
formCpf.validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: false,
    ignore: "", // validate all fields including form hidden input
    rules: {
        cpf: {
            required: true,
            cpfBR: true
        }
    },
    invalidHandler: function (event, validator) {
        errorDados.show();
        App.scrollTo(errorDados, -200);
    },
    errorPlacement: function (error, element) {
        var icon = $(element).parent('.input-icon').children('i');
        icon.removeClass('fa-check').addClass("fa-warning");
        icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass("has-success").addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    success: function (label, element) {
        var icon = $(element).parent('.input-icon').children('i');
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
        icon.removeClass("fa-warning").addClass("fa-check");
    },
    submitHandler: function () {
        errorDados.hide();
        swal({
            title: "Iniciar Processo",
            text: "Você tem certeza que deseja iniciar este processo?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            confirmButtonText: "Sim, iniciar",
            cancelButtonText: "Não",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                formCpf.ajaxSubmit({
                    url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/control_filiacaopotencia.php',
                    data: {acao: 'sendCpf'},
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (res) {
                        resposta = $.parseJSON(res);
                        if (resposta.sucesso === true) {
                            swal("Sucesso!", "Processo iniciado com sucesso", "success");
                            $.ajax({
                                url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_dados.php?id=' + resposta.id,
                                success: function (res) {
                                    $('.page-content .page-content-body').html(res);
                                    Layout.fixContentHeight();
                                    App.initAjax();
                                }
                            });
                        } else {
                            swal("Erro!", "Não foi possível iniciar o processo.", "error");
                        }

                    },
                    complete: function () {

                    },
                    error: function () {

                    }
                });
            }
        });

    }
});
var formDados = $('form[name="formDadosPessoais"]');
var errorDados = $('.alert-danger', formDados);
var id_processo = formDados.attr('id');
formDados.validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: false,
    ignore: "", // validate all fields including form hidden input
    rules: {
        cpf: {
            required: true,
            cpfBR: true
        },
        nome: {
            required: true
        },
        pai: {
            required: true
        },
        mae: {
            required: true
        },
        naturalidade: {
            required: true
        },
        nacionalidade: {
            required: true
        },
        data_nascimento: {
            required: true
        },
        cep: {
            required: true
        },
        endereco: {
            required: true
        },
        telefone: {
            required: true
        },
        celular: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        militar: {
            required: true
        },
        bairro: {
            required: true
        },
        id_estado: {
            required: true
        },
        id_cidade: {
            required: true
        },
        id_profissao: {
            required: true
        },
        local_trabalho: {
            required: true
        },
        rg: {
            required: true
        },
        rg_data_expedicao: {
            required: true
        },
        rg_orgao_emissor: {
            required: true
        },
        id_grupo_sanguineo: {
            required: true
        },
        id_religiao: {
            required: true
        },
        id_estado_civil: {
            required: true
        },
        nome_esposa: {
            required: function () {
                if ($('select[name=id_estado_civil]').val() === '2' || $('select[name=id_estado_civil]').val() === '4') {
                    return true;
                } else {
                    return false;
                }
            }
        },
        data_nascimento_esposa: {
            required: function () {
                if ($('select[name=id_estado_civil]').val() === '2' || $('select[name=id_estado_civil]').val() === '4') {
                    return true;
                } else {
                    return false;
                }
            }
        },
        cpf_esposa: {
            required: function () {
                if ($('select[name=id_estado_civil]').val() === '2' || $('select[name=id_estado_civil]').val() === '4') {
                    return true;
                } else {
                    return false;
                }
            },
            cpfBR: true
        },
        id_profissao_esposa: {
            required: function () {
                if ($('select[name=id_estado_civil]').val() === '2' || $('select[name=id_estado_civil]').val() === '4') {
                    return true;
                } else {
                    return false;
                }
            }
        },
        local_trabalho_esposa: {
            required: function () {
                if ($('select[name=id_estado_civil]').val() === '2' || $('select[name=id_estado_civil]').val() === '4') {
                    return true;
                } else {
                    return false;
                }
            }
        }
    },
    invalidHandler: function (event, validator) {
        errorDados.show();
        App.scrollTo(errorDados, -200);
    },
    errorPlacement: function (error, element) {
        var icon = $(element).parent('.input-icon').children('i');
        icon.removeClass('fa-check').addClass("fa-warning");
        icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass("has-success").addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    success: function (label, element) {
        var icon = $(element).parent('.input-icon').children('i');
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
        icon.removeClass("fa-warning").addClass("fa-check");
    },
    submitHandler: function () {
        errorDados.hide();
        swal({
            title: "Enviar Dados",
            text: "Você tem certeza que deseja enviar estes dados?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            confirmButtonText: "Sim, enviar",
            cancelButtonText: "Não",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                formDados.ajaxSubmit({
                    url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/control_filiacaopotencia.php',
                    data: {acao: 'sendDadosPessoais', id: id_processo},
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (res) {
                        resposta = $.parseJSON(res);
                        if (resposta.sucesso === true) {
                            swal("Enviado!", "Os dados pessoais foram enviados.", "success");
                            if (resposta.redireciona === true) {
                                var url = 'modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_anexos.php?id=' + id_processo;
                            } else {
                                var url = 'modulo/loja/grande_secretaria/processos/processos.php';
                            }
                            $.ajax({
                                url: url,
                                success: function (res) {
                                    $('.page-content .page-content-body').html(res);
                                    Layout.fixContentHeight();
                                    App.initAjax();
                                }
                            });
                        } else {
                            swal("Erro!", "Não foi possível enviar os dados.", "error");
                        }

                    },
                    complete: function () {

                    },
                    error: function () {

                    }
                });
            }
        });

    }
});
$('form[name="formAnexos"] input[type="file"]').change(function () {
    file = $(this).val();
    var ext = file.split('.').pop();
    if (ext !== 'pdf') {
        swal("Erro!", "Aceitamos somente arquivo em PDF", "error");
        $(this).val('');
    } else {
        var name = $(this).attr('name');
        var id_processo = $('form[name="formAnexos"]').attr('id');
        $('form[name="formAnexos"]').ajaxSubmit({
            url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/control_filiacaopotencia.php',
            data: {acao: 'sendAnexo', id: id_processo, documento: name},
            type: 'POST',
            beforeSubmit: function () {
                $('div#' + name).fadeIn('fast');
                $('#input_' + name).fadeOut('slow');
                var percentVal = '0';
                $('.' + name).css({
                    width: percentVal + '%'
                });
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                $('.' + name).css({
                    width: percentVal
                });
            },
            success: function (res) {
                resposta = $.parseJSON(res);
                if (resposta.sucesso === true) {
                    if(resposta.redireciona !== true){
                        var url = 'modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_anexos.php?id=' + id_processo;
                    }else{
                        var url = 'modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_historico.php?id=' + id_processo;
                    }
                    $.ajax({
                        url: url,
                        success: function (res) {
                            $('.page-content .page-content-body').html(res);
                            Layout.fixContentHeight();
                            App.initAjax();
                        }
                    });
                } else {
                    swal("Erro!", "Não foi possível enviar o arquivo", "error");
                }
            },
            complete: function () {
                $('div#' + name + '').fadeOut('slow');
            },
            error: function () {

            }
        });
        return false;
    }
});
$('.btn_exclui').click(function () {
    var name = $(this).attr('name');
    var id_processo = $('form[name="formAnexos"]').attr('id');
    swal({
        title: "Excluir documento",
        text: "Você tem certeza que deseja excluir este documento?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim, excluir",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/control_filiacaopotencia.php',
                data: {acao: 'sendExcluiDocumento', doc: name, id: id_processo},
                type: 'POST',
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Excluido!", "O documento foi excluido com sucesso", "success");
                        $('#opcao_' + name).addClass('hide');
                        $('#input_' + name).removeClass('hide');
                    } else {
                        swal("Erro!", "Não foi possível excluir o documento", "error");
                    }
                },
                complete: function () {

                }
            });
        }
    });
});
$('.enviaData').click(function () {
    var id_processo = $(this).attr('id');
    var data = $('#data_cerimonial').datepicker('getFormattedDate');
    swal({
        title: "Enviar Data",
        text: "Você tem certeza que deseja enviar esta data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, enviar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/control_filiacaopotencia.php',
                data: {acao: 'sendData', id: id_processo, data_cerimonial: data},
                type: 'POST',
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Finalizado!", "Seu processo foi enviado a Grande Secretaria.", "success");
                        $.ajax({
                            url: 'modulo/loja/grande_secretaria/processos/processos.php',
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "Não foi possível enviar esta data.", "error");
                    }

                },
                complete: function () {

                },
                error: function () {

                }
            });
        }
    });
});
var formHistorico = $('form[name="formHistorico"]');
var errorHistorico = $('.alert-danger', formHistorico);
var id_processo = formHistorico.attr('id');
formHistorico.validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: false,
    ignore: "", // validate all fields including form hidden input
    rules: {
        ini_data: {
            required: true,
        },
        ini_loja: {
            required: true
        },
        ini_potencia: {
            required: true
        },
        ele_data: {
            required: true
        },
        ele_loja: {
            required: true
        },
        ele_potencia: {
            required: true
        },
        exa_data: {
            required: true
        },
        exa_loja: {
            required: true
        },
        exa_potencia: {
            required: true
        }
    },
    invalidHandler: function (event, validator) {
        errorHistorico.show();
        App.scrollTo(errorHistorico, -200);
    },
    errorPlacement: function (error, element) {
        var icon = $(element).parent('.input-icon').children('i');
        icon.removeClass('fa-check').addClass("fa-warning");
        icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass("has-success").addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    success: function (label, element) {
        var icon = $(element).parent('.input-icon').children('i');
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
        icon.removeClass("fa-warning").addClass("fa-check");
    },
    submitHandler: function () {
        errorHistorico.hide();
        swal({
            title: "Enviar Dados",
            text: "Você tem certeza que deseja enviar estes dados?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            confirmButtonText: "Sim, enviar",
            cancelButtonText: "Não",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                formHistorico.ajaxSubmit({
                    url: 'modulo/loja/grande_secretaria/processos/filiacaopotencia/control_filiacaopotencia.php',
                    data: {acao: 'sendHistorico', id: id_processo},
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (res) {
                        resposta = $.parseJSON(res);
                        if (resposta.sucesso === true) {
                            swal("Enviado!", "Os dados pessoais foram enviados.", "success");
                            if (resposta.redireciona === true) {
                                var url = 'modulo/loja/grande_secretaria/processos/filiacaopotencia/filiacaopotencia_data.php?id=' + id_processo;
                            } else {
                                var url = 'modulo/loja/grande_secretaria/processos/processos.php';
                            }
                            $.ajax({
                                url: url,
                                success: function (res) {
                                    $('.page-content .page-content-body').html(res);
                                    Layout.fixContentHeight();
                                    App.initAjax();
                                }
                            });
                        } else {
                            swal("Erro!", "Não foi possível enviar os dados.", "error");
                        }

                    },
                    complete: function () {

                    },
                    error: function () {

                    }
                });
            }
        });

    }
});