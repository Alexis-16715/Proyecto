<?php
	session_start();
	require_once('funciones.php');
	if(!estaLogueado()){
		header('Location: login.php'); exit;
	}
	if (estaCookiado()) {
		$cookie = $_COOKIE['userid'];
		$usuario = traerId($cookie);
		loguear($usuario);
	}
	if (estaLogueado()) {
		$usuario = traerId($_SESSION['userId']);
		$laImagen = glob('images/avatares/' . $usuario['email'] . '*');
	}
	$tituloDePagina = 'Perfil del Usuario';
	require_once('includes/head.php');
?>
<?php
$elUsuario = traerId($_SESSION['userId']);
$laImagen = glob('images/avatares/' . $elUsuario['email'] . '*');
 ?>
<section class="imagen-perfil">
		<img src="<?=$laImagen[0];?>" width="180" alt="avatar" style="border-radius: 50%;">
<<<<<<< Updated upstream
	</div>
	<div class="contenedor-perfil">
		<div><h2>Hola <?=$elUsuario['name'];?> <?=$elUsuario['lastname'];?></h2></div>
			<div><h3><?=$elUsuario['email'];?></h3></div>
	          <p> <a href="index.php" class="button">Volver al inicio</a></p>
      		  <p> <a href="logout.php" class="button">Salir</a></p>
  </div>
</section>
=======
</section>
<section class="contenedor-perfil">
	<h2>Hola <?=$elUsuario['name'];?> <?=$elUsuario['lastname'];?></h2>
	<br>
		<em><?=$elUsuario['email'];?></em>
		<br><br>
		<a href="index.php" class="btn-enviar">Volver al inicio</a>
		<a href="logout.php" class="btn-enviar">Salir</a>
		</section>
>>>>>>> Stashed changes
	<?php
	include ('includes/end.php');
	?>
