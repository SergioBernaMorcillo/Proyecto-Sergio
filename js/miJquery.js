$(document).ready(function () {
    $('#botonCategorias').click(function () {
        $('#aside').toggle(1000);
    });

});


function maquinariaVotar(cod) {

    var c = cod.split("#");
    var letra = c[0];
    var id_contenido = c[1];
    var id_usuario = c[2];

    if (cod != "") {

        if (letra == "p") {
            var inputId = "#inputPositivo-" + id_contenido;
        } else if (letra == "n") {
            var inputId = "#inputNegativo-" + id_contenido;
        }
        $.ajax({
            type: "POST",
            url: "./includes/go.php",
            data: { letra: letra, id_contenido: id_contenido, id_usuario: id_usuario },
            success: function (data) {
                console.log(data); //recuperando las variables
                $(inputId).val(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }
}
function maquinariaReportar(cod) {
    var c = cod.split("#");
    var letra = c[0];
    var id_contenido = c[1];
    var id_ususario = c[2];
    if (cod != "") {
        $.ajax({
            type: "POST",
            url: "./includes/go.php",
            data: { letra: letra, id_contenido: id_contenido, id_ususario: id_ususario },
            success: function (data) {
                console.log(data); //recuperando las variables
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }
}
function confirmacionBorrarUsu(id) {
    var opcion = confirm("¿Desea borrar el usuario?");
    if (opcion == true) {
        var clase = "." + id;
        $.ajax({
            type: "POST",
            url: "./includes/usuarios.php",
            data: { id: id },
            success: function (data) {
                console.log(data);
                $(clase).hide();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }

}
function borrarPublicacion(idPubli) {
    var ocultar = "#" + idPubli;
    $(ocultar).hide();
    var opcion = confirm("¿Desea borrar la publicacion?");
    if (opcion == true) {
        var ocultar = "#id-" + idPubli;
        $.ajax({
            type: "POST",
            url: "./includes/inicio.php",
            data: { idPubli: idPubli },
            success: function () {
                $(ocultar).hide();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }

}