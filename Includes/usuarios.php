<?php
if(isset($_REQUEST['id'])){
    require_once("../Clases/Usuario.php");
    require_once("../Clases/Comentario.php");
    require_once("../Clases/Contenido.php");
    require_once("../Clases/Gestion.php");
    $usu = new Usuario();
    $coment=new Comentario();
    $cont = new Contenido();
    $gest = new Gestion();
    
    
    
    $cont->deletePorUsu($_REQUEST['id']);
    $gest->deletePorUsu($_REQUEST['id']);
    $coment->deletePorUsu($_REQUEST['id']);
    $usu->deletePorUsu($_REQUEST['id']);
}else{
    $usu = new Usuario();
}
$usuarios=$usu->get_todos();
echo "<div class='container col-md-10 text-center'>";
echo "<h2>Usuarios Registrados</h2>";
echo "<table class='table table-striped w-100'>";
    echo "<thead><tr class='border px-0'>";
        echo "<th scope='col' class='px-0 border'>ID</th>";
        echo "<th scope='col' class='px-0 d-none d-sm-table-cell border'>Nombre</th>";
        echo "<th scope='col' class='px-0 d-none d-md-table-cell border'>Apellidos</th>";
        echo "<th scope='col' class='px-0 border'>Email</th>";
        echo "<th scope='col' class='px-0 d-none d-md-table-cell  border'>Contraseña</th>";
        echo "<th scope='col' class='px-0 border'>Tipo</th>";
        echo "<th scope='col' class='px-0 border'>Borrar</th>";
    echo "</tr></thead>";
foreach ($usuarios as $key => $value) {
    echo "<tr class=".$value['id_usuario'].">";
        echo "<td scope='row' class='px-0'> ".$value['id_usuario']."</td>";
        echo "<td  class='d-none d-sm-table-cell px-0'>".$value['nombre']."</td>";
        echo "<td class='d-none d-md-table-cell px-0' >".$value['apellidos']."</td>";
        echo "<td class='px-0'>".$value['email']."</td>";
        echo "<td class='d-none d-md-table-cell px-0' >".$value['pas']."</td>";
        echo "<td class='px-0'>".$value['tipoUsr']."</td>";
        if($value['tipoUsr'] != "admin"){
            echo "<td class='px-0'><button onclick='confirmacionBorrarUsu(".$value['id_usuario'].")'><i class='fas fa-trash-alt'></i></button></td>";
        }else{
            echo "<td>-</td>";
        }
       
    echo "</tr>";
}

echo "</table>";
echo "</div>"
?>