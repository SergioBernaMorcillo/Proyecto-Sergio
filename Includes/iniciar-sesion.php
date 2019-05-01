<?php
if (!isset($_SESSION['tipoUsr'])) {
	?>
	<div class="container my-auto">
		<div class="d-flex justify-content-center h-100">

			<div class="card">
				<?php
				if (isset($alerta)) {
					echo $alerta;
				}
				?>
				<div class="card-header">
					<h3>Iniciar Sesión</h3>
				</div>
				<div class="card-body">
					<form class="form mx-auto" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?p=iniciarSesion'; ?>" ENCTYPE="multipart/form-data">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input autofocus type="text" name="email" class="form-control" placeholder="correo electronico" required>
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input id="contraseñaRegistro1" type="password" name="pass" class="form-control" placeholder="Contraseña" required><input style="display:none;" id="mostrarContraseña1" type="checkbox"> <label class="m-0 input-group-text" for="mostrarContraseña1"> <div class="input-group-append"><i id="iconoContraseña1" class="fas fa-eye-slash"></i></label></div>
						</div>
						<div class="form-group">
							<input type="submit" name="login" value="Enviar" class="btn float-right login_btn">
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						No tienes cuenta?<a href="index.php?p=registro">Regristrate</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
} else {
     echo "<script>window.location = 'https://memelon.000webhostapp.com/index.php?p=inicio'</script>";
}
?>