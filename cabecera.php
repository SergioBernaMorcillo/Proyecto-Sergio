<?php
if (session_id() == '') {
    session_start();
}
include("Clases/Usuario.php");
include("Clases/Contenido.php");
include("Clases/Comentario.php");
include("Clases/Gestion.php");
$contenido = "inicio";
if (isset($_GET['d'])) {
    session_unset();
    session_destroy();
    $contenido = "iniciarSesion";
} else if (isset($_GET['p'])) {
    $contenido = $_GET['p'];
}

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $usu = new Usuario();
        $rows = $usu->get($_POST['email']);
        if(count($rows)==0){
            $alerta = '<div  id="alertaReportar" class="alert alert-danger "><strong>No existe ningún usuario con el email especificado.</strong> <a href="#" class="alert-link"></a></div>';
            $contenido = "iniciarSesion";
        }
        foreach ($rows as $key => $value) {
            if ($value['pas'] == $_POST['pass']) {
                $_SESSION['tipoUsr'] = $value['tipoUsr'];
                $_SESSION['id_usuario'] = $value['id_usuario'];
                $_SESSION['nombre'] = $value['nombre'];
                $_SESSION['apellidos'] = $value['apellidos'];
                $_SESSION['email'] = $value['email'];
                $contenido = "inicio";
            } else {
                $alerta = '<div  id="alertaReportar" class="alert alert-danger "><strong>Datos incorrectos.</strong> <a href="#" class="alert-link"></a></div>';
                $contenido = "iniciarSesion";
            }
        }
    }
}
if (isset($_POST['EnviarRegistro'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['pass1']) && !empty($_POST['pass1'])) {
        if ($_POST['pass1'] == $_POST['pass2']) {
            $u = new Usuario();
            $rows = $u->get($_POST['email']);
            if (count($rows) == 0) {
                $x = new Usuario();
                $datos = array(
                    'nombre' => $_POST['nombre'],
                    'apellidos' => $_POST['apellidos'],
                    'email' => $_POST['email'],
                    'pas' => $_POST['pass1'],
                    'tipoUsr' => 'usuario'
                );
                $x->set($datos);
                $alertaRegistro = '<div  id="alertaRegistro" class="alert alert-success "><strong>Te has registrado correctamente.</strong> <a href="#" class="alert-link"></a></div>';
                $_POST = array();
                /*Todo correcto*/
            } else {
                $alertaRegistro = '<div  id="alertaRegistro" class="alert alert-danger  "><strong>Email ya registrado.</strong> <a href="#" class="alert-link"></a></div>';
                $contenido = "registro";
                /* Ya existe este usuario*/
            }
        } else {
            $alertaRegistro = '<div  id="alertaRegistro" class="alert alert-danger "><strong>Las constraseñas no concuerdan.</strong> <a href="#" class="alert-link"></a></div>';
            $contenido = "registro";
            /*Las contraseñas no coinciden*/
        }
    }
    $contenido = "registro";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>MemeLón</title>
    <link rel="shortcut icon" href="./img/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/Style.css">

</head>

<body class="container-fluid mx-auto p-0 col-10 col-12 col-md-11 col-lg-10 col-xl-8 shadow-lg">
    <header>
        <div class="topnav border-bottom border-secondary" role="navigation">
            <nav class="navbar navbar-expand-lg p-0 ">
                <a class="navbar-brand ml-4 text-dark" href="index.php?p=inicio">MemeLón</a>
                <button class="navbar-toggler border border-secondary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <div class="d-relative collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">

                        <li class="nav-item w-100">
                            <a class="navbar-brand px-2 col-12 text-center border-bottom" href="index.php?p=inicio"><span>Inicio</span></a>
                        </li>

                        <?php
                        if (isset($_SESSION['tipoUsr'])) {
                            echo '<li class="nav-item ">';
                            echo '<a class="navbar-brand  px-2 col-12 text-center border-bottom" href="index.php?p=compartir"><span>Compartir</span></a>';
                            echo '</li>';
                            echo '<li class="nav-link dropdown ">';
                            echo '<a class="navbar-brand mt-1 col-12  h-100 px-2 mx-auto  text-center p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ' . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . '  <i class="far fa-arrow-alt-circle-down"></i></span></a>';
                            echo '<div class="dropdown-menu mt-3 w-100 px-2 mx-0 bg-secondary"  aria-labelledby="navbarDropdown" aria-haspopup="true">';

                            if ($_SESSION['tipoUsr'] == "admin") {
                                echo '<a class="dropdown-item w-100 h-100 text-center border-bottom text-white" href="index.php?p=usuarios">Usuarios</a>';
                                echo '<a class="dropdown-item w-100 h-100 text-center border-bottom text-white" href="index.php?p=reportes">Reportes</a>';
                            }
                            echo '<a class="dropdown-item w-100 h-100 text-center text-white" href="index.php?d=desconectar">Cerrar Sesion</a>';
                            echo '</div>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="navbar-brand h-100 px-2 col-12  text-center border-bottom" href="index.php?p=iniciarSesion"><span>Iniciar Sesión</span></a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="navbar-brand h-100 px-2 col-12  text-center" href="index.php?p=registro"><span>Registrarse</span></a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>


        </div>

        <!--<div  class="" role="imagenDeFondo">
            <img class="img-fluid rounded " src="img/portada.jpg">
        </div>-->
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <img class="d-block w-100" src="img/portada.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/portada.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/portada.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>