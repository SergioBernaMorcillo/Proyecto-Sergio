<?php
require_once("cabecera.php");
?>
<section class="row justify-content-md-center col-12 container-fluid mx-0 p-0">
    <?php
    if ($contenido == "inicio" or $contenido == "categoria") {
        echo '<aside  class="d-none d-lg-block col-12 col-sm-12  col-md-12 col-lg-3 d-lg-block text-center" id="aside">';
        echo "<ul class='nav row categorias'>";
        echo '<li class="text-dark nav-item col-6 col-sm-3 col-md-12 "><a class="h-100 pb-3" href="index.php?p=categoria&c=random"><span>Random</span></a></li>';
        echo '<li class="nav-item col-6 col-sm-3 col-md-12"><a class="h-100 pb-3" href="index.php?p=categoria&c=deporte"><span>Deporte</span></a></li>';
        echo '<li class="nav-item col-6 col-sm-3 col-md-12"><a class="h-100 pb-3" href="index.php?p=categoria&c=ot"><span >OT</span></a></li>';
        echo '<li class="nav-item col-6 col-sm-3 col-md-12 "><a class="h-100 pb-3" href="index.php?p=categoria&c=trollface"><span class="mt-2">Trollface</span></a></li>';
        echo "</ul>";
        echo '</aside>';
    }
    if ($contenido == "iniciarSesion") {
        include("./includes/iniciar-sesion.php");
    } else if ($contenido == "registro") {
        include("./includes/registro.php");
    } else if ($contenido == "inicio") {
        include("./includes/inicio.php");
    } else if ($contenido == "compartir") {
        include("./includes/compartir.php");
    } else if ($contenido == "contacto") {
        include("./includes/contacto.php");
    } else if ($contenido == "politica") {
        include("./includes/politica.php");
    } else if ($contenido == "categoria") {
        include("./includes/categoria.php");
    } else if ($contenido == "publicacion") {
        include("./includes/publicacion.php");
    } else if ($contenido == "usuarios") {
        include("./includes/usuarios.php");
    } else if ($contenido == "reportes") {
        include("./includes/reportes.php");
    }
    ?>
</section>
<?php
require_once("pie.php");
?>