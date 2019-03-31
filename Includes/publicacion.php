<?php
$id_contenido = $_GET['id'];
if(isset($_POST["enviarComentario"])){
        $id_usuario = $_SESSION['id_usuario'];
        $comentario = $_POST['comentario'];
    
    
        $datos = array(
            'id_usuario' => $id_usuario,
            'id_contenido' => $id_contenido,
            'comentario' => $comentario
        );
        $aux = new Comentario();
        if($comentario!=""){
            $aux->set($datos);
        }
       
    }



$contenido = new Contenido();
$rows = $contenido->get($id_contenido);
echo '<div class="col text-center  contenido col-12 col-md-12 w-50 px-0 mx-auto">';
foreach ($rows as $key => $value) {
    $id_contenido = $value['id_contenido'];
    $x = "";
    $y = "";
    $r = "";
    if (isset($_SESSION['tipoUsr'])) {
        $id_contenido = $value['id_contenido'];
        $x = "n#" . $value['id_contenido']."#".$_SESSION['id_usuario'];
        $y = "p#" . $value['id_contenido']."#".$_SESSION['id_usuario'];
        $r = "r#" . $value['id_contenido']."#".$_SESSION['id_usuario'];
    }
    
    echo "<div  class='publicacion  pt-2 pb-2 mt-5  mb-2 border-bottom mx-auto' id=id-" . $value['id_contenido'] . ">";
    echo "<button onclick='maquinariaReportar(\"" . $r . "\")'class='btn btn-warning mr-1 float-right' type='submit' name='botonReportar'><i<i class='fas fa-exclamation'></i></button>";
    echo "<h1 class='text-white sombraLetras'>" . $value['titulo'] . "</h1>";
    echo "<img class='img-fluid mb-3 px-0 shadow-lg col-11 col-md-8' src='img/" . $value["imagen"] . "'>";
    echo "<br>";
    echo "<input id='inputPositivo-" . $value['id_contenido'] . "' type='text' name='inputPositivo' value='" . $value['votos_positivos'] . "' readonly style='width:20px;'>";
    echo "<button  onclick='maquinariaVotar(\"" . $y . "\")' class='mt-1 mb-2  ml-1 mr-5 btn btn-success' type='button' name='botonVotarPositivo'><i class='fas fa-thumbs-up'></i></button>";
    echo "<button  class=' mr-1 mt-1 mb-2  btn btn-danger' onclick='maquinariaVotar(\"" . $x . "\")' type='button' name='botonVotarNegativo'><i class='fas fa-thumbs-down'></i></button>";
    echo "<input class='' type='text' id='inputNegativo-" . $value['id_contenido'] . "' value='" . $value['votos_negativos'] . "' readonly style='width:20px;'>";
    
    echo "</div>";
}
echo "<hr class='mt-5'>";
echo "<div class='comentarios  mb-2'>";
if (isset($_SESSION['tipoUsr'])) {
    $c = $_SESSION['id_usuario']."#". $value['id_contenido'];
    echo "<form  method='POST' action=".$_SERVER['PHP_SELF'] . '?p=publicacion&id='.$id_contenido.">";
    echo "<textarea  placeholder='Comentar' class=' mt-4 col-12 col-sm-8' id='comentario' name='comentario' style='color:black;'></textarea><br>";
    echo "<input class='mt-1 mb-2 p-1 btn-success' type='submit' name='enviarComentario'>";
}


$comentario = new Comentario();
$rows = $comentario->get_todos();

$usuario = new Usuario();

echo "<div class='com '></div>";//sirve para que si no hay ningun comentario se pueda añadir mediante ajax delante de la clase 'com'

foreach ($rows as $key => $value) {
    if ($value['id_contenido'] == $id_contenido) {
        $user = $usuario->getPorId($value['id_usuario']);
        echo "<div class='com col-12 col-sm-8 mx-auto mb-2'>";
        echo "<p class ='nombreComentario'>".$user[0]['nombre']." ". $user[0]['apellidos']."</p>";
        echo "<p class ='comentario m-0'>" . $value['comentario'] . "</p>";
        echo "</div>";
    }
}
echo "</div>";


 ?>