<?php
	require_once('funciones.php');
		if (estaCookiado()) {
			$cookie = $_COOKIE['userid'];
			loguear(traerId($_COOKIE['userid']));
		}
		if (estaLogueado()) {
		$usuario = traerId($_SESSION['userId']);
		$laImagen = glob('images/avatares/' . $usuario['email'] . '*');
	}
	$tituloDePagina = 'Inicio';
?>
<?php
	require_once('includes/head.php');
?>
 <main>
      <section id="quienessomos">
          <h2> BIENVENIDOS A LONG STORY | ARGENTINA </h2>
        </section>

        <section id="productos">
          <h3> Lo último de nuestros productos </h3>
          <div class="contenedor">
            <article >
              <img src="images/producto1.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto2.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto3.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto4.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto5.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto6.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto7.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
            <article >
              <img src="images/producto8.jpg" class="producto2">
              <h4> Escoge tu preferido </h4>
            </article>
          </div>
        </section>

        <section id= "info">
          <h3> Algunos autores reconocidos en Latinoamérica </h3>
          <div class="contenedor">
            <div class="info-autores">
              <img src="images/autor1.jpg" >
              <h4> Lauren Kate </h4>
            </div>
            <div class="info-autores">
              <img src="images/autor2.jpg" >
              <h4> Maximilia Rodrigez </h4>
            </div>
            <div class="info-autores">
              <img src="images/autor3.jpg" >
              <h4> Tomas Aguirre </h4>
            </div>
            <div class="info-autores">
              <img src="images/autor4.jpg" alt="" >
              <h4> Facundo Esperanza </h4>
            </div>
          </div>
        </section>
 </main>

<?php
	include_once ("includes/end.php");
?>
