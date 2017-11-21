<?php
	session_start();
	require_once('funciones.php');
	if(estaLogueado()){
		header('Location: perfil-usuario.php'); exit;
	}
		if (estaCookiado()) {
		header('Location: index.php'); exit;
		}

	if ($_POST) {
		$erroresFinales = validarLogin($_POST);
		if (empty($erroresFinales)) {
	      $usuario = comprobarEmail($_POST["email"]);
		  if ($_POST[recordar]) {
				cookiar($usuario);
		  }
	      loguear($usuario);
		  header('location: perfil-usuario.php'); exit;
		}
	}
	$tituloDePagina = 'Login';
	require_once('includes/head.php');
?>
<br><br><br>
		<form method="post" class="form-register">
				<h2 class="form-titulo"> INGRESA </h2>
				<div class="contenedor-inputs">
					<div class="unInput lg">
							<input type="email" name="email" placeholder="Correo">
							<?php if (isset($erroresFinales['email'])): ?>
								<span class="error"><?=$erroresFinales['email'];?></span>
							<?php endif; ?>
					</div>

					<div class="unInput lg">
						<input type="password" name="pass" placeholder="Contraseña">
					</div>


					<div class="unInput lg">
						<input type="submit" value="Entrar" class="btn-enviar">
					</div>

					<div class="container-recordarme">
						<input type="checkbox" name="recordar" value="recordar" ><span> Recordarme </span>
					</div>





					<br><br>

				</div>
				</form>


<br><br><br><br><br><br><br><br><br><br>
<?php
	include_once ("includes/end.php");
?>
