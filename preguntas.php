<?php
	include("soporte.php");
	$usuarioLogueado = $auth->usuarioLogueado($db);
	if ($usuarioLogueado == null) {
		$nombre = "Invitado";
	} else {
		$nombre = $usuarioLogueado->getUsername();
		$laImagen = glob('images/avatares/' . $usuario['email'] . '*');
	}
	$productos = ["VideoCasetera", "Walkman", "Discman", "Gameboy"];
	$usuarios = $db->traerTodos();
	$tituloDePagina = 'Preguntas';
?>
<?php
	require_once('includes/head.php');
?>

<div class="acordeon">

  <div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item1">
		<label for="item1" class="acordeon__titulo"> ¿Qué es Long Story?</label>
		<p class ="acordeon__contenido"> Somos una editorial que apuesta por un modelo más democrático de la industria del libro. Utilizamos el crowdfunding para desarrollar nuestros proyectos editoriales, y establecemos una relación más justa y transparente con nuestros autores.</p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item2">
		<label for="item2" class="acordeon__titulo"> ¿Qué es el crowdfunding editorial? </label>
		<p class ="acordeon__contenido"> El crowdfunding o micromecenazgo es un sistema de financiación colectivo en el que muchas personas apoyan económicamente un proyecto para que pueda llevarse a cabo. En nuestro caso, abarcamos exclusivamente proyectos de publicación de libros y recompensamos a los mecenas que nos dan su apoyo.</p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item3">
		<label for="item3" class="acordeon__titulo"> ¿Son una plataforma de autopublicación? </label>
		<p class ="acordeon__contenido"> No. Las plataformas de autopublicación ofrecen recursos muy limitados para la edición de los libros, dejando en manos del autor aspectos claves y necesarios que requieren conocimientos profesionales. Libros.com es una editorial que asegura una edición, diseño, maquetación, difusión y distribución de calidad sin ningún coste para el autor.</p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item4">
		<label for="item4" class="acordeon__titulo"> ¿Por qué apoyar un proyecto de crowdfunding editorial?</label>
		<p class="acordeon__contenido">Desde siempre, los artistas han necesitado mecenas para poder desarrollar su talento. La irrupción de Internet ha multiplicado infinitamente las vías de financiación de los artistas, que ya no dependen exclusivamente de filántropos o instituciones. Apoyar un proyecto de crowdfunding editorial no sólo significa contribuir en la publicación de un libro: con tu aportación, también estás fomentando un modelo editorial más justo, y una cultura más rica y diversa que beneficia al conjunto de la sociedad. </p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item5">
		<label for="item5" class="acordeon__titulo"> ¿Qué es una campaña de crowdfunding?</label>
		<p class="acordeon__contenido"> Son períodos de 30 días en los que se dan a conocer los nuevos proyectos de libros. Durante ese tiempo, autores, mecenas y todo el equipo de Libros.com unimos energías para recaudar todos los apoyos necesarios para que el libro siga adelante.  </p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item6">
		<label for="item6" class="acordeon__titulo"> ¿Es lo mismo contribuir en un proyecto que comprar un libro?  </label>
		<p class="acordeon__contenido"> Cuando contribuyes en un proyecto, estás aportando dinero para que un libro pueda ser publicado. Salvo excepciones, el libro todavía no está escrito cuando se inicia la campaña de recaudación de apoyos. En ese sentido, estás permitiendo que un autor disponga de los recursos necesarios para escribir su obra y que nosotros, la editorial, podamos publicarlo. También puedes comprar un libro a posteriori, pero no obtendrás obsequios especiales ni serás mencionado en la sección de agradecimientos del libro.  </p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item7">
		<label for="item7" class="acordeon__titulo"> ¿Qué pasa cuando una campaña termina con éxito? </label>
		<p class="acordeon__contenido"> Empieza el proceso de edición, publicación y distribución del libro. Esto suele durar entre tres y nueve meses, depende de cada caso. Entonces se entregan las recompensas a los mecenas y el libro se distribuye digital y físicamente.   </p>
	</div>

	<div class="acordeon__item" >
    <input type="checkbox" name="acordeon" id="item8">
		<label for="item8" class="acordeon__titulo"> ¿Dónde puedo comprar vuestros libros? </label>
		<p class="acordeon__contenido"> Puedes hacerlo en nuestra página web, tanto en papel como en digital. También en plataformas de distribución online como Amazon, iBookstore, Kobo o Barnes & Noble. Llegamos a librerías de todo el territorio nacional</p>
	</div>




</div>

<br><br><br><br><br><br><br>
<?php
	include_once ("includes/end.php");
?>
