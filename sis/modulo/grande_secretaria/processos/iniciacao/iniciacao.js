$('.reprovaDados').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Reprovar Dados",
        text: "Você tem certeza que deseja reprovar estes dados?",
        type: "input",
        inputPlaceholder: "Escreva um comentário",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, reprovar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (inputValue) {
        if (inputValue === false) {
            return false;
        }
        if (inputValue === '') {
            swal.showInputError("Você precisa escrever um comentário!");
            return false;
        } else {
            $.ajax({
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                data: {acao: 'sendReprovaDados', id: id_processo, comentario: inputValue},
                type: 'POST',
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Reprovado!", "Os dados foram reprovados.", "success");
                        $.ajax({
                            url: 'modulo/grande_secretaria/processos/processos_pendentes.php',
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "Os dados não foram reprovados.", "error");
                    }
                },
                complete: function () {

                }
            });
        }
    });
});
$('.aprovaDados').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Aprovar Dados",
        text: "Você tem certeza que deseja aprovar estes dados?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, aprovar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                data: {acao: 'sendAprovaDados', id: id_processo},
                type: 'POST',
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Aprovado!", "Os dados foram aprovados.", "success");
                        $.ajax({
                            url: 'modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos.php?id=' + id_processo,
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "Os dados não foram aprovados.", "error");
                    }
                },
                complete: function () {

                }
            });
        }
    });
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
        senior_demolay: {
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
            title: "Alterar Dados",
            text: "Você tem certeza que deseja alterar estes dados?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            confirmButtonText: "Sim, alterar",
            cancelButtonText: "Não",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                formDados.ajaxSubmit({
                    url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                    data: {acao: 'sendDadosPessoais', id: id_processo},
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (res) {
                        resposta = $.parseJSON(res);
                        if (resposta.sucesso === true) {
                            swal("Alterado!", "Suas alterações foram realizadas com sucesso.", "success");
                            $.ajax({
                                url: 'modulo/grande_secretaria/processos/iniciacao/iniciacao-dados.php?id=' + id_processo,
                                success: function (res) {
                                    $('.page-content .page-content-body').html(res);
                                    Layout.fixContentHeight();
                                    App.initAjax();
                                }
                            });
                        } else {
                            swal("Erro!", "Não foi possível realizar alterações.", "error");
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
            url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
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
                    $.ajax({
                        url: 'modulo/grande_secretaria/processos/iniciacao/iniciacao-anexos.php?id=' + id_processo,
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
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
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
$('.reprovaAnexos').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Reprovar Anexos",
        text: "Você tem certeza que deseja reprovar estes anexos?",
        type: "input",
        inputPlaceholder: "Escreva um comentário",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, reprovar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (inputValue) {
        if (inputValue === false) {
            return false;
        }
        if (inputValue === '') {
            swal.showInputError("Você precisa escrever um comentário!");
            return false;
        } else {
            $.ajax({
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                data: {acao: 'sendReprovaAnexos', id: id_processo, comentario: inputValue},
                type: 'POST',
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Reprovado!", "Os anexos foram reprovados.", "success");
                        $.ajax({
                            url: 'modulo/grande_secretaria/processos/processos_pendentes.php',
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "Os anexos não foram reprovados.", "error");
                    }
                },
                complete: function () {

                }
            });
        }
    });
});
$('.aprovaAnexos').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Aprovar Anexos",
        text: "Você tem certeza que deseja aprovar estes anexos?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, aprovar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                data: {acao: 'sendAprovaAnexos', id: id_processo},
                type: 'POST',
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Aprovado!", "Os anexos foram aprovados.", "success");
                        $.ajax({
                            url: 'modulo/grande_secretaria/processos/iniciacao/iniciacao-data.php?id=' + id_processo,
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "Os anexos não foram aprovados.", "error");
                    }
                },
                complete: function () {

                }
            });
        }
    });
});

$('.alteraData').click(function () {
    var id_processo = $(this).attr('id');
    var data = $('#data_cerimonial').datepicker('getFormattedDate');
    swal({
        title: "Alterar Data",
        text: "Você tem certeza que deseja alterar esta data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, alterar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                data: {acao: 'sendAlteraData', id: id_processo, data_cerimonial: data},
                type: 'POST',
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Alterado!", "Suas alterações foram realizadas com sucesso.", "success");
                        $.ajax({
                            url: 'modulo/grande_secretaria/processos/iniciacao/iniciacao-data.php?id=' + id_processo,
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "Não foi possível realizar alterações.", "error");
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
$('.reprovaData').click(function () {
    var id_processo = $(this).attr('id');
    swal({
        title: "Reprovar Data",
        text: "Você tem certeza que deseja reprovar esta data do cerimonial",
        type: "input",
        inputPlaceholder: "Escreva um comentário",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sim, reprovar",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (inputValue) {
        if (inputValue === false) {
            return false;
        }
        if (inputValue === '') {
            swal.showInputError("Você precisa escrever um comentário!");
            return false;
        } else {
            $.ajax({
                url: 'modulo/grande_secretaria/processos/iniciacao/control_iniciacao.php',
                data: {acao: 'sendReprovaData', id: id_processo, comentario: inputValue},
                type: 'POST',
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        swal("Reprovado!", "A data do cerimonial foi reprovada.", "success");
                        $.ajax({
                            url: 'modulo/grande_secretaria/processos/processos_pendentes.php',
                            success: function (res) {
                                $('.page-content .page-content-body').html(res);
                                Layout.fixContentHeight();
                                App.initAjax();
                            }
                        });
                    } else {
                        swal("Erro!", "A data do cerimonial não foi reprovada.", "error");
                    }
                },
                complete: function () {

                }
            });
        }
    });
});