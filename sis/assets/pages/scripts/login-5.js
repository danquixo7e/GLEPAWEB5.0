var Login = function () {

    var handleLogin = function () {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true
                },
                senha: {
                    required: true
                }
            },

            messages: {
                email: {
                    required: "Informe o email."
                },
                senha: {
                    required: "Informe a senha."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).html('Informe o email e a senha').show();
            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                $('.login-form').ajaxSubmit({
                    url: 'control_login.php',
                    data: {acao: 'sendLogin'},
                    type: 'POST',
                    beforeSend: function () {
                        $('.alert-danger', $('.login-form')).hide();
                    },
                    success: function (res) {
                        resposta = $.parseJSON(res);
                        if(resposta.sucesso ===true){
                            $(location).attr('href', 'dashboard.php');
                        }else{
                            if(resposta.route ===true){
                                $(location).attr('href', 'route.php');
                            }else{
                                $('.alert-danger', $('.login-form')).html('Não foi possível entrar').show();
                            }
                        }
                    },
                    complete: function () {
                        $('input[name="senha"]').val('');
                    },
                    error: function () {
                        $('.alert-danger', $('.login-form')).html('Erro no sistema').show();
                    }
                });
                return false;
            }
        });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        $('#forget-password').click(function () {
            $('.login-form').hide();
            $('.forget-form').show();
        });

        $('#back-btn').click(function () {
            $('.login-form').show();
            $('.forget-form').hide();
        });
    }




    return {
        //main function to initiate the module
        init: function () {

            handleLogin();

            // init background slide images
            $('.login-bg').backstretch([
                "assets/pages/img/login/bg1.jpg",
                "assets/pages/img/login/bg2.jpg",
                "assets/pages/img/login/bg3.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
            );

            $('.forget-form').hide();

        }

    };

}();

jQuery(document).ready(function () {
    Login.init();
    $('input[name="email"]').focus();
});