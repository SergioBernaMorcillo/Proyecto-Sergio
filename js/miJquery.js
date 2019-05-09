$(document).ready(function () {
    /*$('#botonCategorias').click(function () {
        $('#aside').toggle(1000);
    });*/

    $('#file').change(function () { //Cambia  de color el boton para subir una imagen
        $("#botonFile").toggleClass("inputfileDivVerde", "inputfileDiv");
    });
    $('#mostrarContraseña1').click(function () { //Cauando te registras y das click en ver la contraseña llama a esta funcion y le pasa la id a la siguiente funcion
        mostrarContraseña("contraseñaRegistro1");
    });

    $('#mostrarContraseña2').click(function () { //Cauando te registras y das click en ver la contraseña llama a esta funcion y le pasa la id a la siguiente funcion
        mostrarContraseña("contraseñaRegistro2");
    });
    $('#navbarDropdown').click(function () { //Cambia de direccion la flecha del menú cada vez que haces click
        $("#navbarDropdown span i").toggleClass("fa-chevron-circle-down");
        $("#navbarDropdown span i").toggleClass("fa-chevron-circle-up");
    });
    $('#imagenReportes').mouseover(function () {});


});

function enviarCorreoContacto() { //Recoge todos los datos del formulario de contacto,y hace un mailto para que puedas mandar un emai
    var nombre = $('#fname').val(); //Recojo todas las variables
    var apellidos = $('#lname').val();
    var nombreCompleto = nombre + " " + apellidos;
    var comentario = $('#comment').val();

    if (nombre != "" && apellidos != "" && comentario != "") { //Compruebo de que ninguna este vacia
        var mailto_link = 'mailto:sergiobernamorcillo@gmail.com?subject=' + nombreCompleto + '&body=' + comentario;
        window.open(mailto_link, '_self');
        $('#email').val("");
        $('#comment').val("");
        if (document.getElementById("alertaContacto") !== null) {
            $("#alertaContacto").remove();
        }
    } else { //si alguna variable esta vacia mando un error
        var alertaContacto = '<div  id="alertaContacto" class="alert alert-danger text-center"><strong>Completa todos los campos.</strong> <a href="#" class="alert-link"></a></div>';
        if (document.getElementById("alertaContacto") !== null) { //Para que no se acumulen las notificaciones y solo haya una.
            $("#alertaContacto").remove(); //borra la notificacion si ya hay alguna
        }
        $("#contacto").prepend(alertaContacto); //Mando el nuevo error
    }


}

function mostrarContraseña(idCampo) { //Sirve para mostrar la contraseña en el registro o al iniciar sesion
    var idIcono = "#iconoContraseña" + idCampo.charAt(idCampo.length - 1); //Formo la id
    var tipo = document.getElementById(idCampo); //recojo que tipo tiene acualmente el campo
    if (tipo.type == "password") { //si es tipo password lo cambio a text
        tipo.type = "text";
        $(idIcono).removeClass("fa-eye-slash"); //Borro el icono del ojo tachado y muesto el ojo normal
        $(idIcono).addClass("fa-eye");
    } else {
        $(idIcono).removeClass("fa-eye"); //Borro el icono del ojo  y muesto el ojo tachado
        $(idIcono).addClass("fa-eye-slash");
        tipo.type = "password"; //Si es tipo text lo pongo tipo password
    }
}

function maquinariaVotar(cod) {
    var alertaCorrecta = '<div  id="alertaSucessVotacion" class="alert alert-success"><strong>Has votado correctamente.</strong> <a href="#" class="alert-link"></a></div>';
    var alertaIniciaSesion = '<div id="alertaIniciaSesion" class="alert alert-danger"><strong>Inicia sesión para poder votar.</strong> <a href="#" class="alert-link"></a></div>';
    //Recojo variables con un split
    var c = cod.split("#");
    var letra = c[0];
    var id_contenido = c[1];
    var id_usuario = c[2];

    if (id_usuario != "") {
        if (letra == "p") { //formo la id
            var inputId = "#inputPositivo-" + id_contenido;
        } else if (letra == "n") {
            var inputId = "#inputNegativo-" + id_contenido;
        }
        $.ajax({ //llamo un metodo ajax que vota sin refrescar la pagina
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
                if (document.getElementById("alertaSucessVotacion") !== null) { //compruebo que no hay notificaciones sino las borro para que no se acumulen
                    $("#alertaSucessVotacion").remove(); //las borro
                }
                $("#id-" + id_contenido).prepend(alertaCorrecta); //añado la nueva notificacion
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    } else {
        if (document.getElementById("alertaIniciaSesion") !== null) {
            $("#alertaIniciaSesion").remove();
        }
        $("#id-" + id_contenido).prepend(alertaIniciaSesion); //Muestro la notificacion de que debes iniciar sesion
    }


}



function maquinariaReportar(cod) {
    var alertaReportar = '<div  id="alertaReportar" class="alert alert-warning "><strong>Has reportado esta publicacion.</strong> <a href="#" class="alert-link"></a></div>';
    var alertaReportarIniciarSesion = '<div  id="alertaReportarIniciarSesion" class="alert alert-warning "><strong>Debes iniciar sesión.</strong> <a href="#" class="alert-link"></a></div>';
    //Recojo valores
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
                $("#id-" + id_contenido).prepend(alertaReportar); //muestro alerta de que has reportado.
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    } else {
        if (document.getElementById("alertaReportarIniciarSesion") !== null) {
            $("#alertaReportarIniciarSesion").remove();
        }
        $("#id-" + id_contenido).prepend(alertaReportarIniciarSesion); //muestro alerta de primero inicia sesion
    }
}

function confirmacionBorrarUsu(id) {
    var opcion = confirm("¿Desea borrar el usuario?"); //Confirmamos si quieres borrar el usuario
    if (opcion == true) { //si has vostado que si
        var clase = "." + id; //formamos la clase
        $.ajax({
            type: "POST",
            url: "./includes/usuarios.php",
            data: {
                porAjax: true,
                id: id
            },
            success: function (data) {
                console.log(data);
                $(clase).hide(); //ocultamos al usuario
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }

}

function borrarPublicacion(idPubli) {
    var opcion = confirm("¿Desea borrar la publicacion?"); //Confirmamos si quieres borrar la publicacion
    if (opcion == true) {
        var ocultar = "#id-" + idPubli;
        $.ajax({
            type: "POST",
            url: "./includes/categoria.php?p=categoria",
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
    var opcion = confirm("¿Desea borrar el comenario?"); //Confirmamos si quieres borrar el comentario
    if (opcion == true) {
        var ocultar = "#comentrario-" + idComentario; //id para ocultarlo
        $.ajax({ //y lo borramos de la BD mediante ajax
            type: "POST",
            url: "./includes/publicacion.php?p=publicacion&id=" + idpublicacion,
            data: {
                idComentario: idComentario
            },
            success: function () {
                $(ocultar).hide(); //si todo sale bien lo ocultamos
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
            }
        })
    }
}