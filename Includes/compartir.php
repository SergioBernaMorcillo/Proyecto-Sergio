<?php
if (isset($_SESSION['tipoUsr'])) {
    $tipos = array('image/jpeg', 'image/gif', "image/png");
    echo '<div class="col  text-center p-0">';
    $arrayCategorias = array("aleatorio", "deporte", "videojuegos", "trollface");
    if (isset($_POST['botonCompartir'])) {
        if (!empty($_POST['titulo']) && $_POST['opcionesCategorias'] != "porDefecto") {
            if ($_FILES['imagen']['size'] <= 20000000) {
                if (in_array($_FILES['imagen']['type'], $tipos)) {
                    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) { //sube la seleccionada imagen si todo esta correcto
                        $nombreDirectorio = "img/";
                        $nombreFichero = $_FILES["imagen"]["name"];
                        $rutaCompleta = $nombreDirectorio . $nombreFichero;
                        if (is_file($rutaCompleta)) { //la renombra si ya existe
                            $nombreFichero = time() . "-" . $nombreFichero;
                        }

                        move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombreDirectorio . $nombreFichero); //aqui cuando la sube

                        $cont = new Contenido();
                        $resultado = $cont->getTitulo($_POST['titulo']);
                        if (empty($resultado)) {
                            $titulo =$_POST['titulo'];
                            if (strpos($titulo, ' ')==false) {
                                $titulo = chunk_split_unicode($titulo,10);
                            }
                            $datos = array(
                                'id_usuario' => $_SESSION['id_usuario'],
                                'titulo' => $titulo,
                                'imagen' => $nombreFichero,
                                'votos_positivos' => '0',
                                'votos_negativos' => '0',
                                'categoria' => $_POST['opcionesCategorias'],
                                'reportes' => 0
                            );
                            $cont = new Contenido();
                            $cont->set($datos);
                          $alertaCompartir = '<div  id="alertaCompartir" class="alert alert-success "><strong>Meme subido correctamente.</strong> <a href="#" class="alert-link"></a></div>';
                          $_POST = array();
                        } else {
                            $alertaCompartir = '<div  id="alertaCompartir" class="alert alert-danger "><strong>Titulo repetido.</strong> <a href="#" class="alert-link"></a></div>';
                            $contenido = "compartir";
                        }
                    }
                } else {
                    $alertaCompartir = '<div  id="alertaCompartir" class="alert alert-danger "><strong>La imagen debe de ser de tipo PNG,JPG o GIF</strong> <a href="#" class="alert-link"></a></div>';
                    $contenido = "compartir";
                }
            } else {
                $alertaCompartir = '<div  id="alertaCompartir" class="alert alert-danger "><strong>El tamaño de la imagen excede lo permitido. (MAX 2MB)</strong> <a href="#" class="alert-link"></a></div>';
                $contenido = "compartir";
            }
        } else {
            $alertaCompartir = '<div  id="alertaCompartir" class="alert alert-danger "><strong>Faltan datos por completar.</strong> <a href="#" class="alert-link"></a></div>';
            $contenido = "compartir";
        }
    }
    ?>
    <div class="container my-auto">
        <div class="d-flex justify-content-center h-100">

            <div class="card">
                <?php
                if (isset($alertaCompartir)) {
                    echo $alertaCompartir;
                }
                ?>
                <div class="card-header">
                    <h3 class="sombraLetras">Nueva publicación</h3>
                </div>
                <div class="card-body">
                    <form class="mt-5 mb-5" action="<?php echo $_SERVER['PHP_SELF'] . "?p=compartir"; ?>" method="POST" enctype="multipart/form-data">
                        <div class="input-group form-group">

                            <input class="form-control" type="text" maxlength="30" placeholder="Titulo" name="titulo" required value="<?php if (isset($_POST['titulo'])) { echo $_POST['titulo'];} ?>">
                        </div>
                        <div class="input-group form-group">
                            <div  id="botonFile" class="inputfileDiv text-white p-2 pb-0 mx-auto">
                                <span><i class="fas fa-file-upload"></i><input class="inputfile" id="file" type="file" name="imagen"></span>
                                <label for="file">Subir imagen</label>
                            </div>
                        </div>


                        <p class='text-white '><span class='h5'>Selecciona una categoria :</span> <SELECT class='h6 text-dark rounded' name='opcionesCategorias'>
                                <?php
                                echo "<option value='porDefecto'>-</option>";
                                foreach ($arrayCategorias as $key => $value) {
                                    if (isset($_POST['opcionesCategorias']) and $_POST['opcionesCategorias'] == $value) {
                                        echo "<option selected value=" . $value . ">" . $value . "</option>";
                                    } else {
                                        echo "<option  value=" . $value . ">" . $value . "</option>";
                                    }
                                }
                                echo "</SELECT></p>";
                                ?>
                                <div class="form-group">
                                    <input type="submit" name="botonCompartir" value="Enviar" class="btn float-right login_btn">
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "<script>window.location = '". $_SERVER['PHP_SELF']."?p=categoria&c=aleatorio'</script>";
}

function chunk_split_unicode($str, $l = 76, $e = "\r\n") {
    $tmp = array_chunk(
        preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $l);
    $str = "";
    foreach ($tmp as $t) {
        $str .= join("", $t) . $e;
    }
    return $str;
}
?>

