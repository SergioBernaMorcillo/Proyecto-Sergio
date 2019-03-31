Página de reportes
<?php
if (isset($_POST['botonBorrarReportado'])) {


    $comentarios = new Comentario();
    $comentarios->delete($_GET['id']);

    $seBorra = new Contenido();
    $seBorra->delete($_GET['id']);


}
$cont = new Contenido();

$rows = $cont->getReportados();

echo "<div class='container col-md-10 text-center'>";
foreach ($rows as $key => $value) {
    if ($value['reportes'] >= 5) {
        echo "<div class='caja" . $value['id_contenido'] . "'> ";
        echo "<a name='" . $value['id_contenido'] . "' ></a>";
        echo "<form  method='post' action='" . $_SERVER['PHP_SELF'] . "?p=reportes&id=" . $value['id_contenido'] . "'>";
        echo "<h1>" . $value['titulo'] . "</h1>";
        echo "<img src='img/" . $value["imagen"] . "'>";
        echo "<p>Numero de reportes : <input type='text' name='reporte' value='" . $value['reportes'] . "' readonly style='width:20px;'></p>";
        echo "<p><input type='submit' name='botonBorrarReportado' value='Eliminar'></p>";
        echo "<p><input type='submit' name='botonPublicacionApta' value='Apta'></p>";
        echo "</form>";
        echo "</div>";
    }
}
echo "</div>";

?>