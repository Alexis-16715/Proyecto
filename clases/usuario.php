<?php

class Usuario {
  private $id;
  private $email;
  private $password;
  private $edad;
  private $username;
  private $pais;

  public function __construct($email, $password, $edad, $username, $pais, $id = null) {
    if ($id == null) {
      // Viene por POST
      $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    else {
      // Viene de la base
      $this->password = $password;
    }

    $this->email = $email;
    $this->edad = $edad;
    $this->username = $username;
    $this->pais = $pais;
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function setEdad($edad) {
    $this->edad = $edad;
  }

  public function getEdad() {
    return $this->edad;
  }

  public function getPais() {
    return $this->pais;
  }

  public function setPais($pais){
    $this->pais = $pais;
  }

  function guardarImagen() {

		if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK)
		{

			$nombre=$_FILES["avatar"]["name"];
			$archivo=$_FILES["avatar"]["tmp_name"];

			$ext = pathinfo($nombre, PATHINFO_EXTENSION);

			$miArchivo = dirname(__FILE__);
			$miArchivo = $miArchivo . "/../img/";
			$miArchivo = $miArchivo . $this->email . "." . $ext;

			move_uploaded_file($archivo, $miArchivo);
		}
	}
}

?>
