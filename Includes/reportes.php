
<?php
if (isset($_SESSION['tipoUsr']) and $_SESSION['tipoUsr'] == "admin") {
    if (isset($_POST['botonBorrarReportado'])) {
        $comentarios = new Comentario();
        $comentarios->delete($_GET['id']);

        $seBorra = new Contenido();
        $seBorra->delete($_GET['id']);
    }
    if (isset($_POST['botonPublicacionApta'])) {
        $publicacion = new Contenido();
        $resultados = $publicacion->get($_GET['id']);
        $datos = array(
            'id_contenido' => $resultados[0]['id_contenido'],
            'id_usuario' => $resultados[0]['id_usuario'],
            'titulo' => $resultados[0]['titulo'],
            'imagen' => $resultados[0]['imagen'],
            'votos_positivos' => $resultados[0]['votos_positivos'],
            'votos_negativos' => $resultados[0]['votos_negativos'],
            'categoria' => $resultados[0]['categoria'],
            'reportes' => 0
        );
        $publicacion->edit($datos);
    }
    $cont = new Contenido();

    $rows = $cont->getReportados();
    $cont = 0;
    echo "<div class='mt-1 container col-md-10 text-left'>";
    echo "<br><h1 class='mt-3 mb-5 mx-auto text-center text-white sombraLetras'><u>Revisión de reportes</u></h1>";
    foreach ($rows as $key => $value) {
        if ($value['reportes'] >= 5) {
            echo "<div id='revisionReportes' class='mb-2 row'>";
            echo "<a name='" . $value['id_contenido'] . "' ></a>";
            echo "<form  method='post' action='" . $_SERVER['PHP_SELF'] . "?p=reportes&id=" . $value['id_contenido'] . "'>";
            echo "<h3 class='ml-2' >" . $value['titulo'] . "</h3>";
            echo "<div class='mb-2 ml-4 float-left w-25'><img id='imagenReportes' class='border shadow w-100' src='img/" . $value["imagen"] . "'></div>";
            echo "<div class='text-center'><p class=''>Número de reportes : <input type='text' class='text-center inputContador' name='reporte ' value='" . $value['reportes'] . "' readonly style='width:20px;'></p>";
            echo "<p class='d-inline'><input type='submit' class='btn btn-danger' name='botonBorrarReportado' value='Eliminar'></p>";
            echo "<p class='ml-2 d-inline '><input type='submit' class='btn btn-success' name='botonPublicacionApta' value='Apta'></p>";
            echo "</form>";
            echo "</div></div>";
            $cont++;
        }
    }
    if ($cont == 0) {
        echo "<div  class='publicacion col-13 col-md-12 mt-5 mb-5 border-bottom'>";
        echo "No se han encontrado publicaciones";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<script>window.location = 'https://memelon.000webhostapp.com/index.php?p=inicio'</script>";
}
?>