
<?php
echo '<div class="col  text-center  contenido p-0">';
$arrayCategorias = array("random", "deporte", "ot", "trollface");
if (isset($_POST['botonCompartir'])) {
    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {//sube la seleccionada imagen si todo esta correcto
        $nombreDirectorio = "img/";
        $nombreFichero = $_FILES["imagen"]["name"];
        $rutaCompleta = $nombreDirectorio . $nombreFichero;
        if (is_file($rutaCompleta)) {//la renombra si ya existe
            $nombreFichero = time() . "-" . $nombreFichero;
        }
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombreDirectorio . $nombreFichero);//aqui cuando la sube
        
        $cont = new Contenido();
        $resultado = $cont->getTitulo($_POST['titulo']);
        if (empty($resultado)) {
            $datos = array(
                'id_usuario' => $_SESSION['id_usuario'],
                'titulo' => $_POST['titulo'],
                'imagen' => $nombreFichero,
                'votos_positivos' => '0',
                'votos_negativos' => '0',
                'categoria' => $_POST['opcionesCategorias'],
                'reportes' => 0
            );
            $cont = new Contenido();
            $cont->set($datos);
        } else {
            $msg = "Titulo repetido";
        }
    }
}
?>
<form  class="mt-5 mb-5" action="<?php echo $_SERVER['PHP_SELF'] . "?p=compartir"; ?>" method="POST" enctype="multipart/form-data">
    <h1 class="  text-white sombraLetras">Nueva Publicación</h1>
    <p class="text-white sombraLetras mx-auto w-75"> <span class="h5"> </span><input placeholder="Titulo"  type="text" name="titulo"></p>
    <p class="btn inputWrapper text-white sombraLetras mx-auto subirImagen"> <span >Seleccionar imagen </span><input class="fileInput" type="file" name="imagen"></p>
    <?php
    echo "<p class='text-white '><span  class='h5'>Selecciona una categoria :</span> <SELECT class='h6 text-dark' name='opcionesCategorias'>";
    echo "<option value='porDefecto'>-</option>";
    foreach ($arrayCategorias as $key => $value) {
        echo "<option  value=" . $value . ">" . $value . "</option>";
    }
    echo "</SELECT></p>";
    ?>


    <input type="submit" value="Enviar" name="botonCompartir">
</form>
</div>
