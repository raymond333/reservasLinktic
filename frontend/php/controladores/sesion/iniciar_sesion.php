<?php
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];

	$contrasena = sha1(md5($contrasena));

	$Usuario = SQL("SELECT * FROM usuarios 
					INNER JOIN niveles_usuarios USING(id_nivel_usuario) WHERE (estatus_usuario = 'A') AND nombre_usuario = '$usuario' AND contrasena_usuario = '$contrasena' ");
	if (CAN_REG($Usuario) == 0) {
		
		$Vmen = "Usuario o contrasena inconrectos";
		$Vest = 0;
	
	} else {

		@session_start();

	   	$Usuario = $Usuario[0];

	   
			$_SESSION[NOMBRE_SISTEMA] = true;
			$_SESSION['usuario'] = $_POST['usuario'];
		   	$_SESSION['contrasena'] = $_POST['contrasena'];
		   	$_SESSION['nombre_usuario'] = $Usuario -> nombre_usuario;
		   	$_SESSION['contrasena'] = $Usuario -> contrasena_usuario;
		   	
		   	$id = $Usuario -> id_usuario;
		   	$idNivel = $Usuario -> id_nivel_usuario;
		   	$nivel = $Usuario -> nivel_usuario;
		   	$nombre = $Usuario -> nombre_real_usuario;
		   	$_SESSION['ID_USUARIO'] = $id;
		   	$_SESSION['NIVEL_USUARIO'] = $nivel;
		   	$_SESSION['NOMBRE_USUARIO'] = $nombre;



		   	$Vmen = "BIENVENIDO AL SISTEMA $nombre !!!";
		   	$Vest = 2;
	                
			//date_default_timezone_set('America/Caracas');
		    $h = date(' h:i:s a', time());
		    $hr = strtotime($h);
		    $hrs = date("H:i", $hr);


			/* INSERTAR AQUÍ UNA BITACORA DE INICIOS DE SESIÓN */


			switch ($idNivel) {
			    case 1:  #### ADMINISTRADOR
			    	$carpeta = './asignaciones.php';
			    	break;
                case 2:  #### SOCIOS
			    	$carpeta = './panel.php';
			    	break;
            
			    default:
			        $carpeta = 'sin carpeta';
			    break;

			}
					
			$otrosDatos = array('redireccion' => $carpeta);

	}
							


?>