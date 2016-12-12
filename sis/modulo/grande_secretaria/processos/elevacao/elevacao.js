var FormWizardElevacao = function () {
    return {
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
            var form = $('#formElevacao');
            var id_processo = form.attr('name');
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
                $('.step-title', $('#form_wizard_elevacao')).text('Passo ' + (index + 1) + ' de ' + total);
                jQuery('li', $('#form_wizard_elevacao')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }
                if (current === 1) {
                    $('#form_wizard_elevacao').find('.button-previous').hide();
                } else {
                    $('#form_wizard_elevacao').find('.button-previous').show();
                }
                if (current >= total) {
                    $('#form_wizard_elevacao').find('.button-next').hide();
                    $('#form_wizard_elevacao').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_elevacao').find('.button-next').show();
                    $('#form_wizard_elevacao').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }
            $('#form_wizard_elevacao').bootstrapWizard({
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
                    $('#form_wizard_elevacao').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_elevacao').find('.button-previous').hide();
            $('#form_wizard_elevacao .button-submit').click(function () {
                swal({
                    title: "Solicitar Elevação",
                    text: "Você tem certeza que deseja solicitar este processo de elevação?",
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
                            url: 'modulo/grande_secretaria/processos/elevacao/control_elevacao.php',
                            data: {acao: 'sendElevacao', id: id_processo},
                            type: 'POST',
                            beforeSend: function () {

                            },
                            success: function (res) {
                                resposta = $.parseJSON(res);
                                if (resposta.sucesso === true) {
                                    swal("Enviado!", "O processo foi liberado com sucesso.", "success");
                                    $.ajax({
                                        url: 'modulo/grande_secretaria/processos/processos_pendentes.php',
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
    FormWizardElevacao.init();
});