<?php

class Auth {
  public function __construct() {
    session_start();

    if (!isset($_SESSION["logueado"]) && isset($_COOKIE["logueado"])) {
      $_SESSION["logueado"] = $_COOKIE["logueado"];
    }
  }

  public function recordame($email) {
    setcookie("logueado", $email, time() + 3600 * 2);
  }

  public function logout() {
    session_destroy();
    setcookie("logueado", "", -1);
  }

  public function usuarioLogueado(db $db) {
    if ($this->estaLogueado()) {
      $mail = $_SESSION["logueado"];
      return $db->traerPorMail($mail);
    } else {
      return NULL;
    }

  }

  public function estaLogueado() {
		return isset($_SESSION["logueado"]);
	}

  public function loguear($email) {
		$_SESSION["logueado"] = $email;
	}

  function cookiar($usuario){
		// Tomar el array PHP
		$usuarioId = $usuario['id'];
		$usuarioEmail = $usuario['email'];
		setcookie("userid", $usuarioId, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie("useremail", $usuarioEmail, time() + (86400 * 30), "/"); // 86400 = 1 day
	}
	function estaCookiado() {
		return isset($_COOKIE["userid"]);
	}


}

?>
