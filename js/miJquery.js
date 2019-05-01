$(document).ready(function () {
    $('#botonCategorias').click(function () {
        $('#aside').toggle(1000);
    });

    $('#file').change(function () {
        $("#botonFile").toggleClass("inputfileDivVerde", "inputfileDiv");
    });
    $('#mostrarContraseña1').click(function () {
        mostrarContraseña("contraseñaRegistro1");
    });

    $('#mostrarContraseña2').click(function () {
        mostrarContraseña("contraseñaRegistro2");
    });
    $('#navbarDropdown').click(function () {
        $("#navbarDropdown span i").toggleClass("fa-arrow-alt-circle-down");
        $("#navbarDropdown span i").toggleClass("fa-arrow-alt-circle-up");
    });
    $('#imagenReportes').mouseover(function () {
    });


});

function enviarCorreoContacto() {
    var nombre = $('#fname').val();
    var apellidos = $('#lname').val();
    var asunto = $('#asunto').val();
    var comentario = $('#comment').val();

    if(nombre != "" && apellidos != "" && asunto != "" && comentario != ""){
        var cuerpo = "-Nombre:" + nombre + " " + apellidos + "  -Comentario:" + comentario;
        var mailto_link = 'mailto:sergiobernamorcillo@gmail.com?subject=' + asunto + '&body=' + cuerpo;
        window.open(mailto_link, '_self');
        $('#email').val("");
        $('#asunto').val("");
        $('#comment').val("");
        if (document.getElementById("alertaContacto") !== null) {
            $("#alertaContacto").remove();
        }
    }else{
        var alertaContacto = '<div  id="alertaContacto" class="alert alert-danger text-center"><strong>Completa todos los campos.</strong> <a href="#" class="alert-link"></a></div>';
        if (document.getElementById("alertaContacto") !== null) {//Para que no se acumulen las notificaciones y solo haya una.
            $("#alertaContacto").remove();
        }
        $("#contacto").prepend(alertaContacto);
    }


}

function mostrarContraseña(idCampo) {
    var idIcono = "#iconoContraseña" + idCampo.charAt(idCampo.length - 1);
    var tipo = document.getElementById(idCampo);
    if (tipo.type == "password") {
        tipo.type = "text";
        $(idIcono).removeClass("fa-eye-slash");
        $(idIcono).addClass("fa-eye");
    } else {
        $(idIcono).removeClass("fa-eye");
        $(idIcono).addClass("fa-eye-slash");

        tipo.type = "password";
    }
}
function maquinariaVotar(cod) {
    var alertaCorrecta = '<div  id="alertaSucessVotacion" class="alert alert-success"><strong>Has votado correctamente.</strong> <a href="#" class="alert-link"></a></div>';
    var alertaRegistro = '<div id="alertaFallida" class="alert alert-danger"><strong>Ya has votado una vez.</strong> <a href="#" class="alert-link"></a></div>';
    var alertaIniciaSesion = '<div id="alertaIniciaSesion" class="alert alert-danger"><strong>Inicia sesion para poder votar.</strong> <a href="#" class="alert-link"></a></div>';

    var c = cod.split("#");
    var letra = c[0];
    var id_contenido = c[1];
    var id_usuario = c[2];

    if (id_usuario != "") {
        if (letra == "p") {
            var inputId = "#inputPositivo-" + id_contenido;
        } else if (letra == "n") {
            var inputId = "#inputNegativo-" + id_contenido;
        }
        $.ajax({
            type: "POST",
            url: "./includes/go.php",
            data: {
                letra: letra,
                id_contenido: id_contenido,
                id_usuario: id_usuario
            },
            success: function (data) {
                console.log(data); //recuperando las variables
                $(inputId).val(data);
                if (document.getElementById("alertaSucessVotacion") !== null) {
                    $("#alertaSucessVotacion").remove();
                }
                $("#id-" + id_contenido).prepend(alertaCorrecta);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    } else {
        if (document.getElementById("alertaIniciaSesion") !== null) {
            $("#alertaIniciaSesion").remove();
        }
        $("#id-" + id_contenido).prepend(alertaIniciaSesion);
    }


}



function maquinariaReportar(cod) {
    var alertaReportar = '<div  id="alertaReportar" class="alert alert-warning "><strong>Has reportado esta publicacion.</strong> <a href="#" class="alert-link"></a></div>';
    var alertaReportarIniciarSesion = '<div  id="alertaReportarIniciarSesion" class="alert alert-warning "><strong>Debes iniciar sesion.</strong> <a href="#" class="alert-link"></a></div>';
    var c = cod.split("#");
    var letra = c[0];
    var id_contenido = c[1];
    var id_usuario = c[2];

    if (id_usuario != "") {
        $.ajax({
            type: "POST",
            url: "./includes/go.php",
            data: {
                letra: letra,
                id_contenido: id_contenido,
                id_usuario: id_usuario
            },
            success: function (data) {
                console.log(data); //recuperando las variables
                if (document.getElementById("alertaReportar") !== null) {
                    $("#alertaReportar").remove();
                }
                $("#id-" + id_contenido).prepend(alertaReportar);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    } else {
        if (document.getElementById("alertaReportarIniciarSesion") !== null) {
            $("#alertaReportarIniciarSesion").remove();
        }
        $("#id-" + id_contenido).prepend(alertaReportarIniciarSesion);
    }
}

function confirmacionBorrarUsu(id) {
    var opcion = confirm("¿Desea borrar el usuario?");
    if (opcion == true) {
        var clase = "." + id;
        $.ajax({
            type: "POST",
            url: "./includes/usuarios.php",
            data: {
                porAjax: true,
                id: id
            },
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
            data: {
                idPubli: idPubli
            },
            success: function () {
                $(ocultar).hide();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }

}

function borrarComentario(idpublicacion, idComentario) {


    var opcion = confirm("¿Desea borrar el comenario?");
    if (opcion == true) {
        var ocultar = "#comentrario-" + idComentario;
        $(ocultar).hide();
        $.ajax({
            type: "POST",
            url: "./includes/publicacion.php?p=publicacion&id=" + idpublicacion,
            data: {
                idComentario: idComentario
            },
            success: function () {
                $(ocultar).hide();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }

}