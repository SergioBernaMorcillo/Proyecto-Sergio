<?php
if (isset($_REQUEST['id']) or isset($_SESSION['tipoUsr']) and $_SESSION['tipoUsr'] == "admin") {

    if (isset($_REQUEST['id'])) {
        require_once("../Clases/Usuario.php");
        require_once("../Clases/Comentario.php");
        require_once("../Clases/Contenido.php");
        require_once("../Clases/Gestion.php");
        $usu = new Usuario();
        $coment = new Comentario();
        $cont = new Contenido();
        $gest = new Gestion();

        $cont->deletePorUsu($_REQUEST['id']);
        $gest->deletePorUsu($_REQUEST['id']);
        $coment->deletePorUsu($_REQUEST['id']);
        $usu->deletePorUsu($_REQUEST['id']);
    } else {
        $usu = new Usuario();
        if (isset($_GET['inicio'])) {
            $inicio = $_GET['inicio'];
        } else {
            $inicio = 1;
        }
    }



    $allRows = $usu->get_todos(); //cojo todas las publicaciones
    $totalPublicaciones = count($allRows);

    $usu = new Usuario();
    $usuarios = $usu->getPaginado($inicio);

    $paginas = ceil($totalPublicaciones / 10);
   
    echo "<h2 class='mt-4 mb-4 mx-auto text-white sombraLetras'><u>Usuarios Registrados</u></h2>";
    echo "<table class='ml-1 ml-lg-5 mr-1 mr-lg-5 table table-striped'>";
    echo "<thead><tr class='border px-0'>";
    echo "<th scope='col' class='px-0 border'>ID</th>";
    echo "<th scope='col' class='px-0 d-none d-sm-table-cell border'>Nombre</th>";
    echo "<th scope='col' class='px-0 d-none d-md-table-cell border'>Apellidos</th>";
    echo "<th scope='col' class='px-0 border '>Email</th>";
    echo "<th scope='col' class='px-0 d-none d-md-table-cell  border'>Contraseña</th>";
    echo "<th scope='col' class='px-0 border'>Tipo</th>";
    echo "<th scope='col' class='px-0 border'>Borrar</th>";
    echo "</tr> </thead>";
    foreach ($usuarios as $key => $value) {
        echo "<tr class='" . $value['id_usuario'] . "'>";
        echo "<td scope='row' class='px-0'> " . $value['id_usuario'] . "</td>";
        echo "<td  class='d-none d-sm-table-cell px-0'>" . $value['nombre'] . "</td>";
        echo "<td class='d-none d-md-table-cell px-0' >" . $value['apellidos'] . "</td>";
        echo "<td class='px-0'>" . $value['email'] . "</td>";
        echo "<td class='d-none d-md-table-cell px-0' >" . $value['pas'] . "</td>";
        echo "<td class='px-0'>" . $value['tipoUsr'] . "</td>";
        if ($value['tipoUsr'] != "admin") {
            echo "<td class='px-0'><button onclick='confirmacionBorrarUsu(" . $value['id_usuario'] . ")'><i class='fas fa-trash-alt'></i></button></td>";
        } else {
            echo "<td>-</td>";
        }
        echo "</tr>";
    }
    echo "</table>"; 
    echo '<a  class="mx-auto" target="_blank" href="./pdf/listaUsuarios.php"><u>Descargar pdf</u></a>';
   // echo '<button class="btn btn-success mx-auto w-25" ><i class="fa fa-download"></i> Descargar pdf</button>';

    //Paginacion
    echo '<nav class="w-100  d-flex justify-content-center">';
    echo '<ul class="mx-auto pagination  float-left">';
   
    if ($inicio != 1) {
        echo '<li class="page-item"><a class="page-link" href="index.php?p=usuarios&inicio=' . ($inicio - 1) . '">Anterior</a></li>';
    }
    if ($inicio > 2) {
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=usuarios&inicio=' . ($inicio - 2) . '">' . ($inicio - 2) . '</a></li>';
    }
    if ($inicio > 1) {
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=usuarios&inicio=' . ($inicio - 1) . '">' . ($inicio - 1) . '</a></li>';
    }

    echo '<li class="page-item"><a  class="page-link active" href="index.php?p=usuarios&inicio=' . ($inicio) . '">' . ($inicio) . '</a></li>';


    if ($inicio != $paginas) {
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=usuarios&inicio=' . ($inicio + 1) . '">' . ($inicio + 1) . '</a></li>';
    }
    if ($inicio < $paginas - 1) {
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=usuarios&inicio=' . ($inicio + 2) . '">' . ($inicio + 2) . '</a></li>';
    }

    if ($inicio != $paginas) {
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=usuarios&inicio=' . ($inicio + 1) . '">Siguiente</a></li>';
    }
    echo '</ul>';
    echo '</nav>';

} else {
        echo "<script>window.location = 'https://memelon.000webhostapp.com/index.php?p=inicio'</script>";
}
