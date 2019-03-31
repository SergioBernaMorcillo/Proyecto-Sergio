<div class="col text-center  contenido p-0">
    <?php
    echo '<aside  class="d-block d-lg-none  col-12 mx-0 p-0 pt-1">';
    echo "<ul class=' nav nav-tabs h-100  ml-1 mt-0'>";
    echo '<li class="px-2 categorias"><a class="px-1 pb-3 h-100" href="index.php?p=inicio"><span>Inicio</span></a></li>';
    if ($_GET['c'] == "random") {
        echo '<li class="px-1  active bg-white"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=random"><span>Random</span></a></li>';
    } else {
        echo '<li class="px-1  categorias"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=random"><span>Random</span></a></li>';
    }

    if ($_GET['c'] == "deporte") {
        echo '<li class="px-1  active bg-white"><a class="h-100" href="index.php?p=categoria&c=deporte"><span>Deporte</span></a></li>';
    } else {
        echo '<li class="px-1 categorias"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=deporte"><span>Deporte</span></a></li>';
    }

    if ($_GET['c'] == "ot") {
        echo '<li class="px-1 active bg-white"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=ot"><span >OT</span></a></li>';
    } else {
        echo '<li class="px-1 categorias"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=ot"><span >OT</span></a></li>';
    }

    if ($_GET['c'] == "trollface") {
        echo '<li class="px-1 active bg-white"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=trollface"><span class="mt-2">Trollface</span></a></li>';
    } else {
        echo '<li class="px-1 categorias"><a class="px-1 pb-3 h-100" href="index.php?p=categoria&c=trollface"><span class="mt-2">Trollface</span></a></li>';
    }
    echo "</ul>";
    echo '</aside>';
    if (isset($_SESSION['tipoUsr'])) {
        if (isset($_POST['botonPositivo']) or isset($_POST['botonNegativo'])) {
            $x = new Contenido();
            $rows = $x->get($_GET['id']);

            if ($rows[0]['votado'] == 0) {
                if (isset($_POST['botonPositivo'])) {
                    $num1 = intval($rows[0]['votos_positivos']) + 1;
                } else {
                    $num1 = intval($rows[0]['votos_positivos']);
                }

                if (isset($_POST['botonNegativo'])) {
                    $num2 = intval($rows[0]['votos_negativos']) + 1;
                } else {
                    $num2 = intval($rows[0]['votos_negativos']);
                }
                $datos = array(
                    'id_contenido' => $_GET['id'],
                    'titulo' => $rows[0]['titulo'],
                    'imagen' => $rows[0]['imagen'],
                    'votos_positivos' => $num1,
                    'votos_negativos' => $num2,
                    'categoria' => $rows[0]['categoria'],
                    'votado' => 1
                );
                $x->edit($datos);
            }
        }
    }
    if (isset($_GET['inicio'])) {
        $inicio = $_GET['inicio'];
    } else {
        $inicio = 1;
    }
    if (isset($_GET['c'])) {
        $categoria = $_GET['c'];
        $contenido = new Contenido();
        $allRows = $contenido->getCategoria($categoria);
        $totalPublicaciones = count($allRows);
        $cont = new Contenido();
        $memes = $cont->getPaginado($inicio,$categoria);

    $paginas = ceil($totalPublicaciones / 10);


        if (count($memes) == 0) {
            echo "<div  class='publicacion col-13 col-md-12 mt-5 mb-5 border-bottom'>";
            echo "No se han encontrado publicaciones";
            echo "</div>";
        }
        foreach ($memes as $key => $value) {

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
            echo "<br><h1 class='mt-3 mb-3 text-white sombraLetras'>" . $value['titulo'] . "</h1>";
            echo "<a href='index.php?p=publicacion&id=" . $value['id_contenido'] . "'><img class='px-0 mb-3 shadow-lg img-fluid col-12 col-md-8' src='img/" . $value["imagen"] . "'></a>";
            echo "<br>";
            echo "<input  class='text-center inputContador' id='inputPositivo-" . $value['id_contenido'] . "' type='text' name='inputPositivo' value='" . $value['votos_positivos'] . "' readonly'>";
            echo "<button  onclick='maquinariaVotar(\"" . $y . "\")' class='mt-1 mb-2  ml-1 mr-5 btn btn-success' type='button' name='botonVotarPositivo'><i class='fas fa-thumbs-up'></i></button>";
            echo "<button  class=' mr-1 mt-1 mb-2  btn btn-danger' onclick='maquinariaVotar(\"" . $x . "\")' type='button' name='botonVotarNegativo'><i class='fas fa-thumbs-down'></i></button>";
            echo "<input class='text-center inputContador' type='text' id='inputNegativo-" . $value['id_contenido'] . "' value='" . $value['votos_negativos'] . "' readonly'>";
            echo "</div>";
        }
    }


//Paginacion

echo '<nav class="mx-auto w-25" aria-label="Page navigation example">';
echo '<ul class="pagination">';
if ($inicio != 1) {
    echo '<li class="page-item"><a class="page-link" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ($inicio - 1) . '">Anterior</a></li>';
}
if($inicio>2){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ( $inicio-2) . '">'.($inicio-2).'</a></li>';
    }
if($inicio>1){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ( $inicio-1) . '">'.($inicio-1).'</a></li>';
}

if($paginas!=1){
echo '<li class="page-item"><a  class="page-link active" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ( $inicio) . '">'.($inicio).'</a></li>';
}

if($inicio != $paginas ){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ( $inicio+1) . '">'.($inicio+1).'</a></li>';
}
if($inicio < $paginas-1 ){
    echo '<li class="page-item"><a  class="page-link" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ( $inicio+2) . '">'.($inicio+2).'</a></li>';
    }

    if($inicio != $paginas ){
        echo '<li class="page-item"><a  class="page-link" href="index.php?p=categoria&c='.$categoria.'&inicio=' . ( $inicio+1) . '">Siguiente</a></li>';
        }

echo '</ul>';
echo '</nav>';
    ?>
</div> 