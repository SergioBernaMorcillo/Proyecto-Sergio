<?php

if (isset($_REQUEST['idPubli'])) {
    require_once("../Clases/Contenido.php");
    echo "asd" . $_REQUEST['idPubli'];
    $contenido = new Contenido();
    $contenido->delete($_REQUEST['idPubli']);
}
if (isset($_GET['inicio'])) {
    $inicio = $_GET['inicio'];
} else {
    $inicio = 1;
}


echo '<div class="col text-center  contenido  p-0 ">';
echo '<aside  class="d-block d-lg-none  col-12 mx-0 p-0 pt-1">';
echo "<ul class=' nav nav-tabs h-100  ml-1 mt-0'>";
echo '<li class="px-1 active bg-white text-dark"><a class="h-100 px-1 pb-3" href="index.php?p=inicio"><span>Inicio</span></a></li>';
echo '<li class="px-1 categorias"><a class="h-100  pb-3" href="index.php?p=categoria&c=random"><span>Random</span></a></li>';
echo '<li class="px-1 categorias"><a class="h-100 px-1 pb-3" href="index.php?p=categoria&c=deporte"><span>Deporte</span></a></li>';
echo '<li class="px-1 categorias"><a class="h-100 px-1 pb-3" href="index.php?p=categoria&c=ot"><span >OT</span></a></li>';
echo '<li class="px-1 categorias"><a class="h-100 px-1 pb-3" href="index.php?p=categoria&c=trollface"><span class="mt-2">Trollface</span></a></li>';
echo "</ul>";
echo '</aside>';

$cont = new Contenido();
$allRows = $cont->get_todos(); //cojo todas las publicaciones
$totalPublicaciones = count($allRows);

$cont = new Contenido();
$rows = $cont->getPaginado($inicio);

$paginas = ceil($totalPublicaciones / 10);
 //doy la vuelta al array para mostrar las publicaciones nuevas primero
foreach ($rows as $key => $value) { //las muestro
    $x = "";
    $y = "";
    $r = "";

    if (isset($_SESSION['tipoUsr'])) {
        $x = "n#" . $value['id_contenido'] . "#" . $_SESSION['id_usuario'];
        $y = "p#" . $value['id_contenido'] . "#" . $_SESSION['id_usuario'];
        $r = "r#" . $value['id_contenido'] . "#" . $_SESSION['id_usuario'];
    }
    echo "<div  class='publicacion col-13 col-md-12 mt-0 pt-4 mb-5 border-bottom' id=id-" . $value['id_contenido'] . ">";
    if (isset($_SESSION['tipoUsr']) and $value['id_usuario'] == $_SESSION['id_usuario'] or isset($_SESSION['tipoUsr']) and $_SESSION['tipoUsr'] == "admin") {
        echo "<button onclick='borrarPublicacion(" . $value['id_contenido'] . ")'class='btn btn-light border float-right' type='button' name='botonBorrarPublicacion'><i class='fas fa-trash-alt'></i></button>";
    }
    echo "<button onclick='maquinariaReportar(\"" . $r . "\")'class='btn btn-warning mr-1 float-right' type='submit' name='botonReportar'><i<i class='fas fa-exclamation'></i></button>";
    echo "<br><h1 class='mt-3 mb-3 w-50 mx-auto text-white sombraLetras'><u style='text-dark'>" . $value['titulo'] . "</u></h1>";
    echo "<a href='index.php?p=publicacion&id=" . $value['id_contenido'] . "'><img class='mb-3 px-0 shadow-lg img-fluid col-12 col-md-8 hoverable' src='img/" . $value["imagen"] . "'></a>";
    echo "<br>";
    echo "<input  class='text-center inputContador' id='inputPositivo-" . $value['id_contenido'] . "' type='text' name='inputPositivo' value='" . $value['votos_positivos'] . "' readonly>";
    echo "<button  onclick='maquinariaVotar(\"" . $y . "\")' class='mt-1 mb-2  ml-1 mr-5 btn btn-success' type='button' name='botonVotarPositivo'><i class='fas fa-thumbs-up'></i></button>";
    echo "<button  class=' mr-1 mt-1 mb-2  btn btn-danger' onclick='maquinariaVotar(\"" . $x . "\")' type='button' name='botonVotarNegativo'><i class='fas fa-thumbs-down'></i></button>";
    echo "<input class=' text-center inputContador' type='text' id='inputNegativo-" . $value['id_contenido'] . "' value='" . $value['votos_negativos'] . "' readonly>";
    echo "</div>";
}

//Paginacion
echo '<nav class="mx-auto w-25" aria-label="Page navigation example">';
echo '<ul class="pagination">';
if ($inicio != 1) {
    echo '<li class="page-item"><a class="page-link" href="index.php?p=inicio&inicio=' . ($inicio - 1) . '">Anterior</a></li>';
}
if($inicio>2){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=inicio&inicio=' . ( $inicio-2) . '">'.($inicio-2).'</a></li>';
    }
if($inicio>1){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=inicio&inicio=' . ( $inicio-1) . '">'.($inicio-1).'</a></li>';
}

echo '<li class="page-item"><a  class="page-link active" href="index.php?p=inicio&inicio=' . ( $inicio) . '">'.($inicio).'</a></li>';


if($inicio != $paginas ){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=inicio&inicio=' . ( $inicio+1) . '">'.($inicio+1).'</a></li>';
}
if($inicio < $paginas-1 ){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=inicio&inicio=' . ( $inicio+2) . '">'.($inicio+2).'</a></li>';
    }

    if($inicio != $paginas ){
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=inicio&inicio=' . ( $inicio+1) . '">Siguiente</a></li>';
        }

echo '</ul>';
echo '</nav>';
?>


</div> 