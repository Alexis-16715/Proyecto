<?php

require_once("db.php");

class Validator {
  public 	function validarLogin($informacion, db $db) {
  		$errores = [];

  		foreach ($informacion as $clave => $valor) {
  			$informacion[$clave] = trim($valor);
  		}


  		if ($informacion["email"] == "") {
  			$errores["email"] = "Che, dejaste el mail incompleto";
  		}
  		else if (filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
  			$errores["mail"] = "El mail tiene que ser un mail";
  		} else if ($db->traerPorMail($informacion["email"]) == NULL) {
  			$errores["mail"] = "El usuario no esta en nuestra base";
  		}

  		$usuario = $db->traerPorMail($informacion["email"]);

  		if ($informacion["password"] == "") {
  			$errores["password"] = "No llenaste la contraseña";
  		} else if ($usuario != NULL) {
  			//El usuario existe y puso contraseña
  			// Tengo que validar que la contraseño que ingreso sea valida
  			if (password_verify($informacion["password"], $usuario->getPassword()) == false) {
  				$errores["password"] = "La contraseña no verifica";
  			}
  		}




  		return $errores;
  	}

    function validarInformacion($informacion, db $db) {
      $errores = [];

      $nombre=$_FILES["avatar"]["name"];

      $ext = pathinfo($nombre, PATHINFO_EXTENSION);

      if ($_FILES["avatar"]["error"] != 0) {
        $errores["avatar"] = "Error al cargar la foto";
      } else if ($ext != "jpg" && $ext != "jpeg" && $ext != "png") {
        $errores["avatar"] = "La extension de la foto no es válida";
      }

      foreach ($informacion as $clave => $valor) {
        $informacion[$clave] = trim($valor);
      }
      if ($informacion["name"] == "") {
        $errores["nombre"] = 'Che escribí el nombre!';
      }
      if ($informacion["apellido"] == "") {
        $errores["apellido"] = 'Che escribí el apellido!';
      }

      if (strlen($informacion["username"]) <= 3) {
        $errores["username"] = "Tenes que poner más de 3 caracteres en tu nombre de usuario";
      }

      if ($informacion["email"] == "") {
        $errores["email"] = "Che, dejaste el mail incompleto";
      }
      else if (filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
        $errores["mail"] = "El mail tiene que ser un mail";
      } else if ($db->traerPorMail($informacion["email"]) != NULL) {
        $errores["mail"] = "El usuario ya existia!";
      }

      if ($informacion["password"] == "") {
        $errores["password"] = "No llenaste la contraseña";
      }

      if ($informacion["cpassword"] == "") {
        $errores["cpassword"] = "No llenaste completar contraseña";
      }

      if ($informacion["password"] != "" && $informacion["cpassword"] != "" && $informacion["password"] != $informacion["cpassword"]) {
        $errores["password"] = "Las contraseñas no coinciden";
      }


      return $errores;
    }

}

?>
