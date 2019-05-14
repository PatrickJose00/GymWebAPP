$("#add-presenca").click(function () {
    var regId = $(this).attr("data-reg");
    $.post("../../presenca/adicionar-presenca/" + regId, function (data) {
        $("#totalPresencas").html(data);
        if (data >= $("#max-permitido").text()) {
            $("#totalPresencas").removeClass("green");
            $("#totalPresencas").addClass("red");
        }
    });
});

$(".add-presenca-aula").click(function () {
    var regId = $(this).attr("data-reg");
    $.post("../../presenca/adicionar-presenca-aula/" + regId, function (data) {
        $("#totalPresencas-aula-" + regId).html(data);
        if (data >= $(".max-entradas").attr("data-max")) {
            $("#totalPresencas-aula-" + regId).removeClass("green");
            $("#totalPresencas-aula-" + regId).addClass("red");
        }
    });
});

$("#exercicio-categoriaexercicio_id").change(function () {
    $.post("lista/" + $(this).val(), function (data) {
        $("select#exercicioplano-exercicios_id").html(data);
        var id = $("select#exercicioplano-exercicios_id").val();
        mostrarImagem(id);
    });
});

function removeAndDisplay(data) {
    $("#mostrar-imagem").remove();
    $("#display-image").append("<div id='mostrar-imagem'>" + data + "</div>");
}

function mostrarImagem(id) {
    $.post("mostrar-imagem/" + id, function (data) {
        removeAndDisplay(data);
    });
}

$("select#exercicioplano-exercicios_id").change(function () {
    $.post("mostrar-imagem/" + $(this).val(), function (data) {
        removeAndDisplay(data);
    });
});


//Nutricao

$("#alimento-categoriaalimentos_id").change(function () {
    $.post("lista/" + $(this).val(), function (data) {
        $("select#alimetoplanorefeicao-alimento_id").html(data);
        var id = $("select#alimetoplanorefeicao-alimento_id").val();
    });
});

$("a#modal-btn").click(function () {
    $("#modal").modal('show')
            .find("#modal-content")
            .load($(this).attr('data-content'));
});