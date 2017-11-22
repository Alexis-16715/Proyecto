<?php

require_once("db.php");

class Validator {
  public 	function validarLogin($data, db $db) {
  		$errores = [];

  		foreach ($data as $clave => $valor) {
  			$data [$clave] = trim($valor);
  		}


  		if ($data ["email"] == "") {
  			$errores["email"] = "Che, dejaste el mail incompleto";
  		}
  		else if (filter_var($data ["email"], FILTER_VALIDATE_EMAIL) == false) {
  			$errores["mail"] = "El mail tiene que ser un mail";
  		} else if ($db->traerPorMail($data ["email"]) == NULL) {
  			$errores["mail"] = "El usuario no esta en nuestra base";
  		}

  		$usuario = $db->traerPorMail($data ["email"]);

  		if ($data ["password"] == "") {
  			$errores["password"] = "No llenaste la contraseña";
  		} else if ($usuario != NULL) {
  			//El usuario existe y puso contraseña
  			// Tengo que validar que la contraseño que ingreso sea valida
  			if (password_verify($data ["password"], $usuario->getPassword()) == false) {
  				$errores["password"] = "La contraseña no verifica";
  			}
  		}
  		return $errores;
  	}

    function validarInformacion($data, db $db) {
      $errores = [];

      $nombre=$_FILES["avatar"]["name"];

      $ext = pathinfo($nombre, PATHINFO_EXTENSION);

      if ($_FILES["avatar"]["error"] != 0) {
        $errores["avatar"] = "Error al cargar la foto";
      } else if ($ext != "jpg" && $ext != "jpeg" && $ext != "png") {
        $errores["avatar"] = "La extension de la foto no es válida";
      }

      foreach ($data  as $clave => $valor) {
        $data [$clave] = trim($valor);
      }
      if ($data ["name"] == "") {
        $errores["nombre"] = 'Che escribí el nombre!';
      }
      if ($data ["apellido"] == "") {
        $errores["apellido"] = 'Che escribí el apellido!';
      }

      if (strlen($data ["username"]) <= 3) {
        $errores["username"] = "Escribi un nombre de usuario!";
      }

      if ($data ["email"] == "") {
        $errores["email"] = "Che, dejaste el mail incompleto";
      }
      else if (filter_var($data ["email"], FILTER_VALIDATE_EMAIL) == false) {
        $errores["mail"] = "El mail tiene que ser un mail";
      } else if ($db->traerPorMail($data ["email"]) != NULL) {
        $errores["mail"] = "El usuario ya existia!";
      }

      if ($data ["password"] == "") {
        $errores["password"] = "No llenaste la contraseña";
      }

      if ($data ["repass"] == "") {
        $errores["repass"] = "No llenaste completar contraseña";
      }

      if ($data ["password"] != "" && $data ["repass"] != "" && $data ["password"] != $data ["repass"]) {
        $errores["password"] = "Las contraseñas no coinciden";
      }

    return $errores;
    }

}

?>
