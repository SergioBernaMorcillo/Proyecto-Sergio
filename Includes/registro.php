<div class="contenido w-100 mx-auto text-center" >
<form class="form  mx-auto  col-10  col-sm-8 col-md-4" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?p=registro'; ?>">
    <h1>Registro</h1>
    <p> Nombre:<br><input class="w-100" type="text" name="nombre"></p>
    <p> Apellidos:<br><input class="w-100" type="text" name="apellidos"></p>
    <p>E-mail:<br><input class="w-100" type="text" name="email"></p>
    <p> Contraseña:<br><input class="w-100" type="password" name="pass1"></p>
    <p> Repita la contraseña:<br><input class="w-100" type="password" name="pass2"></p>
    <input class="w-100" type="submit" value="Enviar" name="EnviarRegistro">
</form>
</div>
