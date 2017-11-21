<?php
	session_start();
	require_once('funciones.php');
	if(estaLogueado()){
		header('Location: perfil-usuario.php'); exit;
	}
		if (estaCookiado()) {
		header('Location: index.php'); exit;
		}

	$sexos = [
		'F' => 'Femenino',
		'M' => 'Masculino',
		'O'=>'Otro'
	];
	$nombre = '';
	$apellido = '';
	$email = '';
	$username = '';
	$telefono = '';
	if ($_POST) {
		$nombre = $_POST['name'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$telefono = $_POST['telefono'];
		$erroresFinales = validarUsuario($_POST, $_FILES);
		if (empty($erroresFinales)) {
			$erroresFinales = guardarImagen('avatar', $erroresFinales);
			if (empty($erroresFinales)) {
				$usuarioAGuardar = crearUsuario($_POST);
				guardarUsuario($usuarioAGuardar);
				header('location: index.php'); exit;
			}
		}
	}
	$tituloDePagina = 'Registro de Usuarios';
	require_once('includes/head.php');
?>
<br><br><br>
		<form method="post" class="form-register" enctype="multipart/form-data">
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
						<input type="text" name="email" value="<?=$email;?>" placeholder="Correo Electronico" >
						<?php if (isset($erroresFinales['email'])): ?>
							<span class="error"><?=$erroresFinales['email'];?></span>
						<?php endif; ?>
					</div>

					<div class="unInput lg">
						<input type="text" name="username" value="<?=$username;?>" placeholder="Usuario" >
						<?php if (isset($erroresFinales['username'])): ?>
							<span class="error"><?=$erroresFinales['username'];?></span>
						<?php endif; ?>
					</div>

					<div class="unInput lg">
						<input type="password" name="pass" placeholder="Contraseña" >
						<?php if (isset($erroresFinales['pass'])): ?>
							<span class="error"><?=$erroresFinales['pass'];?></span>
						<?php endif; ?>
					</div>

					<div class="unInput lg">
						<input type="password" name="repass" placeholder="Repetir Contraseña">
						<?php if (isset($erroresFinales['repass'])): ?>
							<span class="error"><?=$erroresFinales['repass'];?></span>
						<?php endif; ?>
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
						<input type="file" name="avatar">
						<?php if (isset($erroresFinales['imagen'])): ?>
							<span class="error"><?=$erroresFinales['imagen'];?></span>
						<?php endif; ?>
					</div>



					<input type="submit" value="Registrar" class="btn-enviar">
					<p class="form-link"> ¿Ya tienes una cuenta? <a href="login.php"> Ingresa aquí </a></p>
				</div>
		</form>
<br><br><br><br><br><br><br><br><br><br>


<?php
	include_once ("includes/end.php");
?>
