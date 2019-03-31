
 <div class="contenido col-12 mx-auto text-center" >
<form  class="form mx-auto  col-10  col-sm-8 col-md-4" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?p=iniciarSesion'; ?>" ENCTYPE="multipart/form-data">
    <h1 >Iniciar sesión</h1>
    <p>Tu e-mail:<br><input class="w-100" type="text" name="email"></p>
    <p> Contraseña:<br><input  class="w-100" type="password" name="pass"></p>
    <input  class="btn btn-info"  type="submit" class="w-100"  value="Enviar" name="login">
</form>
</div>