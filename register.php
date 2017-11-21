<?php
	include_once("soporte.php");
	if ($auth->estaLogueado()) {
		header("Location:perfil-usuario.php");exit;
	}
	$sexos = [
		'F' => 'Femenino',
		'M' => 'Masculino',
		'O'=>'Otro'
	];
	$nombre = '';
	$apellido = '';
	$emailDefault = "";
	$usernameDefault = "";
	$telefonoDefault = "";


	$errores = [];
	if ($_POST) {
		$nombre = $_POST['name'];
		$apellido = $_POST['apellido'];
		$errores = $validator->validarInformacion($_POST, $db);

		if (!isset($errores["email"])) {
			$emailDefault = $_POST["email"];
		}

		if (!isset($errores["edad"])) {
			$edadDefault = $_POST["edad"];
		}

		if (!isset($errores["username"])) {
			$usernameDefault = $_POST["username"];
		}
		if (count($errores) == 0) {
			$usuario = new Usuario($_POST["email"], $_POST["password"], $_POST["edad"], $_POST["username"], $_POST["pais"]);

			$usuario->guardarImagen();
			$usuario = $db->guardarUsuario($usuario);

			header("Location:perfilUsuario.php?mail=$mail");exit;
		}
	}

	$tituloDePagina = 'Registro de Usuarios';
	require_once('includes/head.php');
?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<ul class="errores">
		<?php foreach ($errores as $error) : ?>
			<li>
				<?=$error?>
			</li>
		<?php endforeach; ?>
		</ul>
		<form method="POST" class="form-register" action="register.php" enctype="multipart/form-data">
			<h2 class="form-titulo"> CREA UNA CUENTA </h2>
			<div class="contenedor-inputs">
				<div class="unInput">
					<input type="text" name="name" value="<?=$nombre;?>" placeholder="Nombre" class="input-48" >
					<?php if (isset($erroresFinales['nombre'])): ?>
						<span class="error"><?=$erroresFinales['nombre'];?></span>
					<?php endif; ?>
				</div>
				<div class="unInput">
					<input type="text" name="apellido" value="<?=$apellido;?>" placeholder="Apellido" class="input-48">
					<?php if (isset($erroresFinales['apellido'])): ?>
						<span class="error"><?=$erroresFinales['apellido'];?></span>
					<?php endif; ?>
				</div>
			<div class="unInput lg">
				<input class="form-control" type="text" name="email" id="email" value="<?=$emailDefault?>" placeholder="Correo Electronico">
			</div>
			<div class="unInput lg">
				<input class="form-control" type="text" name="username" id="username" value="<?=$usernameDefault?>" placeholder="Usuario">
			</div>
			<div class="unInput lg">
				<input id="password" class="form-control" type="password" name="password" placeholder="Contraseña">
			</div>
			<div class="unInput lg">
				<input id="cpassword" class="form-control" type="password" name="cpassword" placeholder="Repetir Contraseña">
			</div>
			<div class="unInput">
				<select name="sexo">
					<option value="">Indicar Sexo</option>
					<?php foreach ($sexos as $letra => $valor): ?>
						<?php if (isset($_POST['sexo']) && $_POST['sexo'] == $letra): ?>
							<option selected value="<?=$letra;?>"><?=$valor;?></option>
						<?php else: ?>
							<option value="<?=$letra;?>"><?=$valor;?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
				<?php if (isset($erroresFinales['sexo'])): ?>
					<span class="error"><?=$erroresFinales['sexo'];?></span>
				<?php endif; ?>
			</div>
			<div class="unInput">
				<input id="avatar" class="form-control" type="file" name="avatar">
			</div>
		</div>
		<input type="submit" value="Registrar" class="btn-enviar">
		<p class="form-link"> ¿Ya tienes una cuenta? <a href="login.php"> Ingresa aquí </a></p>
	</div>
</div>
</form>
<?php
	include_once ("includes/end.php");
?>
