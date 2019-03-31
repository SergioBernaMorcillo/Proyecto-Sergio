<?php
include("../Clases/Usuario.php");
include("../Clases/Contenido.php");
include("../Clases/Gestion.php");

$letra = $_REQUEST['letra'];
$id_contenido = $_REQUEST['id_contenido'];
$id_usuario = $_REQUEST['id_usuario'];



    

$x = new Contenido();
$rows = $x->get($id_contenido);
$g = new Gestion();
$result = $g->get($id_usuario, $id_contenido); //hago un objeto gestion



if (count($result) == 0) { //compruebo si el usuario ha votado o reportado la publicacion con anterioridad
    $datos = array(
        'id_contenido' =>$id_contenido,
        'id_usuario' => $id_usuario,
        'aVotado' => 0,
        'aReportado' => 0
    );
    $g->set($datos); //si no lo ha hecho nunca lo meto en la base de datos con los valores predefinidos
}

$resultado = $g->get($id_usuario, $id_contenido); //Recojo los datos del usuario y de la publicacion que ya existen si o si
$pos = intval($rows[0]['votos_positivos']);
//recojo los valores que tiene
$neg = intval($rows[0]['votos_negativos']);
$aReportado = intval($resultado[0]['aReportado']);
$aVotado = intval($resultado[0]['aVotado']);
$numReportes = intval($rows[0]['reportes']);


if ($aVotado == 0) { //Si no ha votado se le permite entrar
    if ($letra=="p") { //Si ha presionado para votar positivamente se le permite votar pero solo una vez
        $pos++;
        $aVotado++;
        echo $pos;
    }
    if ($letra=="n") { //lo mismo que arriba
        $aVotado++;
        $neg++;
        echo $neg;
    }
}else{
    if ($letra=="p") { //Si ha presionado para votar positivamente se le permite votar pero solo una vez
        echo $pos;
    }
    if ($letra=="n") { //lo mismo que arriba
        echo $neg;
    }
}
if ($aReportado == 0) { //=
    if ($letra=="r") {
        $numReportes++;
        $aReportado++;
    }
}
$datos = array(
    'id_contenido' => $id_contenido,
    'id_usuario'=>$rows[0]['id_usuario'],
    'titulo' => $rows[0]['titulo'],
    'imagen' => $rows[0]['imagen'],
    'votos_positivos' => $pos,
    'votos_negativos' => $neg,
    'categoria' => $rows[0]['categoria'],
    'reportes' => $numReportes
);

$datosGestion = array(
    'id_contenido' => $id_contenido,
    'id_usuario' => $id_usuario,
    'aVotado' => $aVotado,
    'aReportado' => $aReportado,
);

$x->edit($datos); //introduzco los datos actualizados a las tablas gestion y contenido
$g->edit($datosGestion);
