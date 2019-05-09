<?php
if (!isset($_SESSION['tipoUsr'])) {
	?>
	<div class="container my-auto">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<?php
				if (isset($alertaRegistro)) {
					echo $alertaRegistro;
				}
				?>
				<div class="card-header">
					<h3>Introduce tus datos</h3>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?p=registro'; ?>">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php if (isset($_POST['nombre'])) {
																													echo $_POST['nombre'];
																												} ?>" required autofocus>
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="<?php if (isset($_POST['apellidos'])) {
																														echo $_POST['apellidos'];
																													} ?>" required>
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="email" name="email" class="form-control" placeholder="email" value="<?php if (isset($_POST['email'])) {
																													echo $_POST['email'];
																												} ?>" required>
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input id="contraseñaRegistro1" type="password" name="pass1" class="form-control" placeholder="Contraseña" required><input style="display:none;" id="mostrarContraseña1" type="checkbox"> <label class="m-0 input-group-text" for="mostrarContraseña1">
								<div class="input-group-append"><i id="iconoContraseña1" class="fas fa-eye-slash"></i>
							</label>
						</div>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input id="contraseñaRegistro2" type="password" name="pass2" class="form-control" placeholder="Contraseña" required><input style="display:none;" id="mostrarContraseña2" type="checkbox"> <label class="m-0 input-group-text" for="mostrarContraseña2">
						<div class="input-group-append"><i id="iconoContraseña2" class="fas fa-eye-slash"></i>
					</label>
				</div>
			</div>

			<div class="form-group">
				<input type="submit" name="EnviarRegistro" value="Enviar" class="btn float-right login_btn">
			</div>
			</form>
		</div>
	</div>
	</div>
	</div>
<?php
} else {
	echo "<script>window.location = '" . $_SERVER['PHP_SELF'] . "?p=categoria&c=aleatorio'</script>";
}
?>