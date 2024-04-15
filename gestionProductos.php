<?php
	//Regoger los valores del formulario Agregar al Carro
	$codigo= isset($_POST['codigo']) ? $_POST['codigo'] : false;
	$cantidad= isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
	$accion= isset($_POST['accion']) ? $_POST['accion'] : false;
	
	if ($accion and $accion='AGREGAR_CARRO') {
		session_start();
		//$pedido = [$codigo,$cantidad];
		//$pedido = json_encode($pedido);				
		$claseDatos  = new stdClass();
		$claseDatos->codigo  = $codigo;
		$claseDatos->cantidad  = $cantidad;		
		if (isset($_SESSION['carrito'])) {
			/*$dat = explode('|',$_SESSION['carrito']);
			foreach ($dat as $value) {
				$pedido = json_decode($value);
				if ($pedido->codigo == $codigo) {
					// code...
				}
				echo $pedido->codigo;
			}*/
			$_SESSION['carrito'] = $_SESSION['carrito'].'|'.json_encode($claseDatos);
			$_SESSION['item'] += $cantidad;
		}else{
			$_SESSION['carrito'] = json_encode($claseDatos);
			$_SESSION['item'] = $cantidad;		
		}
		echo $_SESSION['item'];
	}
//----------------------------------------------------------	
	function consultarProductos($vcod){		
		date_default_timezone_set('America/Bogota');
		$mysqli = conectar();
		$vcod = mysqli_real_escape_string($mysqli,$vcod);
		if (!empty($vcod)) {
			$vcod=base64_decode($vcod);
		}

		$datos = array();
		$query= "SELECT codigo,nombre,descripcion,precio,existencias,imagen FROM producto WHERE codigo like '%$vcod%' and estado='A'";			
		$sql= $mysqli->prepare($query);
		$sql->execute();
		$resultado = $sql->get_result();	  
	  while ($r = $resultado->fetch_assoc()) {  
	  	$claseDatos  = new stdClass();    	
	  	$claseDatos->codigo  = $r['codigo'];
	  	$claseDatos->nombre  = $r['nombre'];
	  	$claseDatos->descripcion  = $r['descripcion'];
	  	$claseDatos->precio  = $r['precio'];
	  	$claseDatos->existencias  = $r['existencias'];
	  	$claseDatos->imagen  = $r['imagen'];
	  	$datos[] = $claseDatos;
	  }
	  $sql->close();
		$mysqli->close();
		//$claseGeneral	  = new stdClass();
		//$claseGeneral->data = $datos;
		return $datos;
	}
?>