var formReadmissaoCpf = $('form[name="formReadmissaoCpf"]');
var errorDados = $('.alert-danger', formReadmissaoCpf);
formReadmissaoCpf.validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: false,
    ignore: "", // validate all fields including form hidden input
    rules: {
        cpf: {
            required: true,
            cpfBR: true
        },
        cadastro:{
            required: true
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
            title: "Readmissão",
            text: "Você tem certeza que deseja iniciar este processo de readmissão?",
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
                formReadmissaoCpf.ajaxSubmit({
                    url: 'modulo/loja/grande_secretaria/processos/readmissao/control_readmissao.php',
                    data: {acao: 'sendReadmissaoCpf'},
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (res) {
                        resposta = $.parseJSON(res);
                        if(resposta.quiteplacet === true){
                            var url = 'modulo/loja/grande_secretaria/processos/readmissao/readmissao_membro.php?id='+resposta.id;
                        }else{
                            var url = 'modulo/loja/grande_secretaria/processos/readmissao/readmissao_quiteplacet_membro.php?id='+resposta.id;
                        }
                        if (resposta.sucesso === true) {
                            swal("Sucesso!", "Processo iniciado com sucesso", "success");
                            $.ajax({
                                url: url,
                                success: function (res) {
                                    $('.page-content .page-content-body').html(res);
                                    Layout.fixContentHeight();
                                    App.initAjax();
                                }
                            });
                        } else {
                            swal("Erro!", resposta.mensagem, "error");
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
$('input[type="file"]').change(function () {
    file = $(this).val();
    var ext = file.split('.').pop();
    if (ext !== 'pdf') {
        swal("Erro!", "Aceitamos somente arquivo em PDF", "error");
        $(this).val('');
    } 
});
var FormWizardReadmissaoQuitePlacet = function () {
    return {
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
            var form = $('#formReadmissaoQuitePlacet');
            
            var error = $('.alert-danger', form);

            form.validate({
                doNotHideMessage: true,
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: false,
                messages: {
                    quite_placet: {
                        extension: 'Aceitamos somente arquivos em .PDF'
                    }
                },
                rules: {
                    cpf: {
                        required: true,
                        cpfBR: true
                    },
                    rg: {
                        required: true
                    },
                    data_nascimento: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    cep: {
                        required: true
                    },
                    bairro: {
                        required: true
                    },
                    endereco: {
                        required: true
                    },
                    celular: {
                        required: true
                    },
                    id_profissao: {
                        required: true
                    },
                    local_trabalho: {
                        required: true
                    },
                    quite_placet: {
                        required: true,
                        extension: "pdf"
                    },
                    data_cerimonial: {
                        required: true
                    }
                },
                errorPlacement: function (error, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },
                invalidHandler: function (event, validator) {
                    error.show();
                    App.scrollTo(error, -200);
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
                submitHandler: function (form) {
                    error.hide();
                }
            });

            var displayConfirm = function () {
                $('#tab4 .form-control-static', form).each(function () {
                    var input = $('[name="' + $(this).attr("data-display") + '"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="' + $(this).attr("data-display") + '"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea") || input.is(":file")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    }
                });
            }

            var handleTitle = function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                $('.step-title', $('#form_wizard_readmissao_quiteplacet')).text('Passo ' + (index + 1) + ' de ' + total);
                jQuery('li', $('#form_wizard_readmissao_quiteplacet')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }
                if (current === 1) {
                    $('#form_wizard_readmissao_quiteplacet').find('.button-previous').hide();
                } else {
                    $('#form_wizard_readmissao_quiteplacet').find('.button-previous').show();
                }
                if (current >= total) {
                    $('#form_wizard_readmissao_quiteplacet').find('.button-next').hide();
                    $('#form_wizard_readmissao_quiteplacet').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_readmissao_quiteplacet').find('.button-next').show();
                    $('#form_wizard_readmissao_quiteplacet').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }
            $('#form_wizard_readmissao_quiteplacet').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    error.hide();
                    if (form.valid() === false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    error.hide();
                    if (form.valid() === false) {
                        return false;
                    }
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    error.hide();
                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_readmissao_quiteplacet').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_readmissao_quiteplacet').find('.button-previous').hide();
            $('#form_wizard_readmissao_quiteplacet .button-submit').click(function () {
                var id_membro = $('#form_wizard_readmissao_quiteplacet').attr('name');
                swal({
                    title: "Solicitar Readmissão",
                    text: "Você tem certeza que deseja solicitar este processo de Readmissão?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "Sim, solicitar",
                    cancelButtonText: "Não",
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        form.ajaxSubmit({
                            url: 'modulo/loja/grande_secretaria/processos/readmissao/control_readmissao.php',
                            data: {acao: 'sendReadmissaoQuitePlacet', id: id_membro},
                            type: 'POST',
                            beforeSend: function () {

                            },
                            success: function (res) {
                                resposta = $.parseJSON(res);
                                if (resposta.sucesso === true) {
                                    swal("Enviado!", "O processo foi enviado com sucesso.", "success");
                                    $.ajax({
                                        url: 'modulo/loja/grande_secretaria/processos/processos.php',
                                        success: function (res) {
                                            $('.page-content .page-content-body').html(res);
                                            Layout.fixContentHeight();
                                            App.initAjax();
                                        }
                                    });
                                } else {
                                    swal("Erro!", resposta.mensagem, "error");
                                }

                            },
                            complete: function () {

                            },
                            error: function () {

                            }
                        });
                    }
                });
            }).hide();

        }

    };

}();
var FormWizardReadmissao = function () {
    return {
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
            var form = $('#formReadmissao');
            
            var error = $('.alert-danger', form);

            form.validate({
                doNotHideMessage: true,
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: false,
                rules: {
                    cpf: {
                        required: true,
                        cpfBR: true
                    },
                    rg: {
                        required: true
                    },
                    data_nascimento: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    cep: {
                        required: true
                    },
                    bairro: {
                        required: true
                    },
                    endereco: {
                        required: true
                    },
                    celular: {
                        required: true
                    },
                    id_profissao: {
                        required: true
                    },
                    local_trabalho: {
                        required: true
                    },
                    data_cerimonial: {
                        required: true
                    }
                },
                errorPlacement: function (error, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },
                invalidHandler: function (event, validator) {
                    error.show();
                    App.scrollTo(error, -200);
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
                submitHandler: function (form) {
                    error.hide();
                }
            });

            var displayConfirm = function () {
                $('#tab3 .form-control-static', form).each(function () {
                    var input = $('[name="' + $(this).attr("data-display") + '"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="' + $(this).attr("data-display") + '"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    }
                });
            }

            var handleTitle = function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                $('.step-title', $('#form_wizard_readmissao')).text('Passo ' + (index + 1) + ' de ' + total);
                jQuery('li', $('#form_wizard_readmissao')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }
                if (current === 1) {
                    $('#form_wizard_readmissao').find('.button-previous').hide();
                } else {
                    $('#form_wizard_readmissao').find('.button-previous').show();
                }
                if (current >= total) {
                    $('#form_wizard_readmissao').find('.button-next').hide();
                    $('#form_wizard_readmissao').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_readmissao').find('.button-next').show();
                    $('#form_wizard_readmissao').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }
            $('#form_wizard_readmissao').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    error.hide();
                    if (form.valid() === false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    error.hide();
                    if (form.valid() === false) {
                        return false;
                    }
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    error.hide();
                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_readmissao').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_readmissao').find('.button-previous').hide();
            $('#form_wizard_readmissao .button-submit').click(function () {
                var id_membro = $('#form_wizard_readmissao').attr('name');
                swal({
                    title: "Solicitar Readmissão",
                    text: "Você tem certeza que deseja solicitar este processo de Readmissão?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "Sim, solicitar",
                    cancelButtonText: "Não",
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        form.ajaxSubmit({
                            url: 'modulo/loja/grande_secretaria/processos/readmissao/control_readmissao.php',
                            data: {acao: 'sendReadmissao', id: id_membro},
                            type: 'POST',
                            beforeSend: function () {

                            },
                            success: function (res) {
                                resposta = $.parseJSON(res);
                                if (resposta.sucesso === true) {
                                    swal("Enviado!", "O processo foi enviado com sucesso.", "success");
                                    $.ajax({
                                        url: 'modulo/loja/grande_secretaria/processos/processos.php',
                                        success: function (res) {
                                            $('.page-content .page-content-body').html(res);
                                            Layout.fixContentHeight();
                                            App.initAjax();
                                        }
                                    });
                                } else {
                                    swal("Erro!", resposta.mensagem, "error");
                                }

                            },
                            complete: function () {

                            },
                            error: function () {

                            }
                        });
                    }
                });
            }).hide();

        }

    };

}();

jQuery(document).ready(function () {
    FormWizardReadmissaoQuitePlacet.init();
    FormWizardReadmissao.init();
});