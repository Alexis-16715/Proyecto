<?php
include_once('pdo/conexion.php');
	
	function validarUsuario($data, $files){
		$errores = [];
		if (trim($data['name']) == '') {
			$errores['nombre'] = 'Che escribí el nombre!';
		}
		if (trim($data['apellido']) == '') {
			$errores['apellido'] = 'Che escribí el apellido!';
		}
		if (trim($data['email']) == '') {
			$errores['email'] = 'Che escribí el email!';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$errores['email'] = 'Che el email ES INVALIDO!';
		} elseif (comprobarEmail($data['email']) != false) {
			$errores['email'] = 'Amigx el email ya existe';
		}
		if (trim($data['username']) == '') {
			$errores['username'] = 'Escribí un nombre de usuario!';
		} elseif (comprobarNick($data['username']) != false) {
			$errores['username'] = 'Amigx el username ya existe';
		}
		if (trim($data['pass']) == '') {
			$errores['pass'] = 'Che escribí la contraseña!';
		}
		if (trim($data['repass']) == '') {
			$errores['repass'] = 'Che escribí la contraseña de nuevo!';
		} elseif (trim($data['pass']) != trim($data['repass'])) {
			$errores['repass'] = 'Las contraseñas no coinciden!';
		}
		if (trim($data['sexo']) == '') {
			$errores['sexo'] = 'Che elegí un sexo!';
		}
		if ($files['avatar']['error'] != UPLOAD_ERR_OK) {
			$errores['imagen'] = 'Ché subí una imagen';
		}
		return $errores;
	}
	function crearUsuario($datos){
		$usuarioFinal = [
	//		'id' => generarId(), id autoincremental
			'name' => $datos['name'],
			'lastname' => $datos['apellido'],
			'email' => $datos['email'],
			'username' => $datos['username'],
			'password' => password_hash($datos['pass'], PASSWORD_DEFAULT),
			'gender' => $datos['sexo']
		];
		return $usuarioFinal;
	}
	function traerTodosJson(){
		$archivo = file_get_contents("usuarios.json");
        $usuariosJSON = explode(PHP_EOL, $archivo);
		array_shift($usuariosJSON);
		$usuariosFinal = [];
		foreach ($usuariosJSON as $usuario) {
			$usuariosFinal[] = json_decode($usuario, true);
		}
		return $usuariosFinal;
	}
	function traerTodos(){
	$archivo = file_get_contents("usuarios.json");
		$usuariosJSON = explode(PHP_EOL, $archivo);
	array_pop($usuariosJSON);
	$usuariosFinal = [];
	foreach ($usuariosJSON as $usuario) {
		$usuariosFinal[] = json_decode($usuario, true);
	}
	return $usuariosFinal;
	}
	function comprobarEmail($mail){
		$usuarios = traerTodos();
		foreach ($usuarios as $unUsuario) {
			if ($unUsuario['email'] == $mail) {
				return $unUsuario;
			}
		}
		return false;
	}
	function comprobarNick($nick){
		$usuarios = traerTodos();
		foreach ($usuarios as $unUsuario) {
			if ($unUsuario['username'] == $nick) {
				return $unUsuario;
			}
		}
		return false;
	}
	function guardarImagen($laImagen, $errores){
		if ($_FILES[$laImagen]['error'] == UPLOAD_ERR_OK) {
			$nombreImagen = $_FILES[$laImagen]['name'];
			$ext = pathinfo($nombreImagen, PATHINFO_EXTENSION);
			$archivoImagen = $_FILES[$laImagen]['tmp_name'];
			if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
				$rutaArchivo = dirname(__FILE__) . '/images/avatares/' . $_POST['email'] . '.' . $ext;
				move_uploaded_file($archivoImagen, $rutaArchivo);
			} else {
				$errores['imagen'] = 'El formato tiene que ser JPG, JPEG, PNG o GIF';
			}
		} else {
			$errores['imagen'] = 'No se pudo subir la imagen';
		}
		return $errores;
	}
	function traerId($id){
		$usuarios = traerTodos();
		foreach ($usuarios as $unUsuario) {
			if ($id == $unUsuario['id']) {
				return $unUsuario;
			}
		}
		return false;
	}
	function validarLogin($data){
		$errores = [];
		if (trim($data['email']) == '') {
			$errores['email'] = 'Che escribí el email!';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$errores['email'] = 'Che escribí un email valido!';
		} else if (comprobarEmail($data['email']) == false) {
      	$errores["email"] = "No existe el usuario";
     	} else {
      	$usuario = comprobarEmail($data['email']);
      	if (password_verify($data["pass"], $usuario["password"]) == false) {
         	$errores["email"] = "La información ingresada es erronea. Verifica tus datos.";
      	}
     	}
		return $errores;
	}
	function loguear($usuario) {
	   $_SESSION['userId'] = $usuario['id'];
	}
	function estaLogueado() {
		return isset($_SESSION['userId']);
	}
	// == FUNCTION - guarda  Cookie ==
	/*
		- Recibe un parámetro
		- $usuario: array creado con la función crearUsuario()
		- No retorna nada, se encarga de guardar en el cliente el usuario recibido
	*/
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

	function guardarUsuarioBd($usuario){
    if($_POST){
        //busco el usuario
        //Si existe Update
        //Sino insert
        //creo mi query
        $Sql = "INSERT INTO usuarios (name, lastname, email, username, password, gender) VALUES ( ?,?,?,?,?,? )";
        $stmt = $db->prepare($Sql);
        $stmt->bindValue(':name', $usuario['name'], PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $usuario['lastname'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $usuario['email'], PDO::PARAM_STR);
        $stmt->bindValue(':username', $usuario['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $usuario['password'], PDO::PARAM_STR);
        $stmt->bindValue(':gender', $usuario['gender'], PDO::PARAM_STR);
        $stmt->execute( [
             $usuario['name'],
             $$usuario['lastname'],
             $usuario['email'],
             $usuario['username'], //2017-10-10
             $usuario['password'],
             $usuario['gender']
            ] );
    }
	}
