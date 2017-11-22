<?php

require_once("db.php");

class dbJSON extends db {
  private $arch;

  public function __construct() {
    $this->arch = "usuarios.json";
  }

  public function traerTodos() {
    $this->arch = "usuarios.json";
      $usuariosJSON = explode(PHP_EOL, $this->$arch);
		  array_pop($usuariosJSON);
		  $usuariosFinal = [];
    		foreach ($usuariosJSON as $usuario) {
    			$usuariosFinal[] = json_decode($usuario, true);
    		}
    		return $usuariosFinal;
  }

      function generarId(){
    		$usuarios = traerTodos();
    		if (count($usuarios) == 0) {
    			return 1;
    		}
    		$elUltimo = array_pop($usuarios);
    		$id = $elUltimo['id'];
    		return $id + 1;
    	}

  public function traerPorMail($email) {
        $usuarios = traerTodos();
      foreach ($usuarios as $unUsuario) {
        if ($unUsuario['email'] == $mail) {
          return $unUsuario;
        }
      }
      return false;
    }

  public function guardarUsuario(Usuario $usuario) {
    $usuarioFinal = json_encode($usuario);
		file_put_contents('usuarios.json', $usuarioFinal . PHP_EOL, FILE_APPEND);
  }
}

?>
