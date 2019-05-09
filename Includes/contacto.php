<div class="container contact my-auto">
	<div class="row my-auto">
		<div class="col-md-9 mx-auto  d-none d-xl-block" id="contacto">
			<h2 class="text-center"><u>Contacto</u></h2>
			<div class="contact-form">
				<div class="form-group">
					<label class="control-label col-sm-2" for="fname">Nombre:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="fname" value="<?php if (isset($_SESSION['nombre'])) {
																						echo $_SESSION['nombre'];
																					} ?>" name="fname">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="lname">Apellidos:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="lname" value="<?php if (isset($_SESSION['apellidos'])) {
																						echo $_SESSION['apellidos'];
																					} ?>" name="lname">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="comment">Comentario:</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="5" id="comment"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" onclick="enviarCorreoContacto()" class="btn btn-success">Enviar datos</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-9 mx-auto d-block d-xl-none">
			<p class="">Si desea ponerse en contacto con los administradores de la web solo tiene que mandar un email a: <a href="#">sergiobernamorcillo@gmail.com</a></p>
		</div>
	</div>
</div>