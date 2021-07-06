<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
header("Content-type: application/json; charset=utf-8");
require_once('../../APIopenweatherapp/conexion/conexion.php');

class User
{
	private $sentencia;
	private $listarUsuarios;
	private $listarUsuario;
	public $pdo;
    
	
	public function __construct($pdo)
	{
		$this->pdo=$pdo;
	}

	public function setUser($name,$user,$email,$pass){
		
        $this->name=$name;
        $this->user=$user;
        $this->email=$email;
        $this->pass=$pass;

		$this->sentencia = $this->pdo->prepare("INSERT INTO `usuarios`(`nombre`, `user`, `correo`, `pass`, `type`) VALUES ('$this->name','$this->user','$this->email','$this->pass',0);");
		$this->sentencia->execute();
	}

	public function getUsers(){
		$this->sentencia = $this->pdo->prepare("SELECT * FROM usuarios");
		$this->sentencia->execute();
		$this->listaUsuarios = $this->sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $this->listaUsuarios;
	}

	public function getUserLogin($user, $pass){

        $this->user=$user;
        $this->pass=$pass;

		$this->sentencia = $this->pdo->prepare("SELECT * FROM usuarios WHERE user='$user' AND pass='$pass'");
		$this->sentencia->execute();
		$this->listaUsuario = $this->sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $this->listaUsuario;
	}

	public function funciona(){
		echo('<h1>Está funcionando la clase</h1>');
	}

	public function deleteUser($id){
		$this->id=$id;
		$this->sentencia = $this->pdo->prepare("DELETE FROM usuarios WHERE id='$id'");
		$this->sentencia->execute();
	}
    
}


?>