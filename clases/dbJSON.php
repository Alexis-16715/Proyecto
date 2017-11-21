<?php

require_once("db.php");

class dbJSON extends db {
  private $arch;

  public function __construct() {
    $this->arch = "usuarios.json";
  }

  public function traerTodos() {

  }

  public function traerPorMail($email) {

  }

  public function guardarUsuario(Usuario $usuario) {
    
  }
}

?>
