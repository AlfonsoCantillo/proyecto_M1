<?php 
	/*$server = 'localhost';
	$user		= 'root';
	$pass   = '';
	$db     = 'tienda';
	$con = mysqli_connect($server, $user, $pass, $db);
	if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
	}
	mysqli_query($con,"SET NAMES 'utf8'");*/
//---------------------------------------------------------------------
function conectar(){            
  date_default_timezone_set('America/Bogota');              
  $mysqli = new mysqli("localhost","root","","tienda");
  if ($mysqli->connect_errno) {
    printf("Error de Conexi&oacute;n. Consulte con su DBA.");
    return 0;
  }else{
    $mysqli->set_charset("utf8");
    return $mysqli;
  }
}	
//---------------------------------------------------------------------
function cerrar_conexion($mysqli){
  $mysqli->close();
}  
//---------------------------------------------------------------------
function listar($query){
  $conn = conectar();
  $resultado = $conn->query($query);
  cerrar_conexion($conn);
  return $resultado;
}
?>
