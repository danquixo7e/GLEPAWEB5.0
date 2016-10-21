var Lock = function () {
    
    var handleRoute = function () {
        $('.btn_login_perfil').click(function(){
            var id_user = $(this).attr('id');
            $.ajax({
                url: 'control_login.php',
                data: {acao: 'sendLoginPerfil', id: id_user},
                type: 'POST',
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        $(location).attr('href', 'dashboard.php');
                    }else{
                        $('.alert-danger', $('.login-form')).html('Erro no sistema').show();
                    }
                },
                complete: function () {

                },
                error: function () {
                    $('.alert-danger', $('.register-form')).html('Erro no sistema').show();
                }
            });
        });
        $('.btn_login_conta').click(function(){
            var id_user = $(this).attr('id');
            $.ajax({
                url: 'control_login.php',
                data: {acao: 'sendLoginConta', id: id_user},
                type: 'POST',
                beforeSend: function () {

                },
                success: function (res) {
                    resposta = $.parseJSON(res);
                    if (resposta.sucesso === true) {
                        $(location).attr('href', 'dashboard.php');
                    }else{
                        $('.alert-danger', $('.login-form')).html('Erro no sistema').show();
                    }
                },
                complete: function () {

                },
                error: function () {
                    $('.alert-danger', $('.register-form')).html('Erro no sistema').show();
                }
            });
        });
    }

    return {
        //main function to initiate the module
        init: function () {

            $.backstretch([
                "assets/pages/media/bg/1.jpg",
                "assets/pages/media/bg/2.jpg",
                "assets/pages/media/bg/3.jpg",
                "assets/pages/media/bg/4.jpg"
            ], {
                fade: 1000,
                duration: 8000
            });
            handleRoute();
        }

    };

}();

jQuery(document).ready(function () {
    Lock.init();
});