$('#enviar').click(function () {
    $.ajax({
        url: 'control_app.php',
        data: {acao: 'sendEmail'},
        type: 'POST',
        cache: false,
        beforeSend: function () {

        },
        success: function (res) {
            resposta = $.parseJSON(res);
            if (resposta.sucesso === true) {
                swal("Sucesso!", "Email enviado com sucesso.", "success");
            } else {
                swal("Erro!", "Não foi possível enviar o email.", "error");
            }
        },
        complete: function () {

        }
    });
});