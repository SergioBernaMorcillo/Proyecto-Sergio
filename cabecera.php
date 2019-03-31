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
        foreach ($rows as $key => $value) {
            if ($value['pas'] == $_POST['pass']) {
                $_SESSION['tipoUsr'] = $value['tipoUsr'];
                $_SESSION['id_usuario'] = $value['id_usuario'];
                $_SESSION['nombre'] = $value['nombre'];
                $_SESSION['apellidos'] = $value['apellidos'];
            }
        }
        $contenido = "inicio";
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
                /*echo "Registro correcto";*/
            } else {
                /* echo "Ya existe este usuario";*/ }
        } else {
            /*echo "Las contraseñas no coinciden";*/ }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>CSS Only Navigation Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/Style.css">

</head>

<body class="container container-fluid mx-auto p-0 border-0 col-md-8">
    <header>
        <div class="topnav border-bottom border-secondary" role="navigation">
            <nav class="navbar navbar-expand-lg p-0 ">
                <a class="navbar-brand ml-4 text-dark" href="index.php?p=inicio">MemeLon</a>
                <button class="navbar-toggler border border-secondary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                    
                        <li class="nav-item w-100">
                            <a class="navbar-brand px-2 col-12 text-center border-bottom" href="index.php?p=inicio"><span>Inicio</span></a>
                        </li>

                        <?php
                        if (isset($_SESSION['tipoUsr'])) {
                            echo '<li class="nav-item ">';
                            echo '<a class="navbar-brand  px-2 col-12 text-center border-bottom" href="index.php?p=compartir"><span>Compartir</span></a>';
                            echo '</li>';
                            echo '<li id="padreSub" class="nav-link dropdown ">';
                            echo '<a class="navbar-brand mt-1 dropdown-toggle  col-12  h-100 px-2 mx-auto  text-center p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ' . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . '  </span></a>';
                            echo '<div class="dropdown-menu mt-3 w-100 px-2 mx-0 bg-secondary "  aria-labelledby="navbarDropdown" aria-haspopup="true">';

                            if ($_SESSION['tipoUsr'] == "admin") {
                                echo '<a class="dropdown-item w-100 h-100 text-center border-bottom" href="index.php?p=usuarios">Usuarios</a>';
                                echo '<a class="dropdown-item w-100 h-100 text-center border-bottom" href="index.php?p=reportes">Reportes</a>';
                            }
                            echo '<a class="dropdown-item w-100 h-100 text-center " href="index.php?d=desconectar">Cerrar Sesion</a>';
                            echo '</div>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="navbar-brand h-100 px-2 col-12  text-center border-bottom" href="index.php?p=iniciarSesion"><span>Iniciar Sesion</span></a>';
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

        <div  class="h-150" role="imagenDeFondo">
            <img class="img-fluid h-100" src="img/portada.jpg">
        </div>
    </header> 