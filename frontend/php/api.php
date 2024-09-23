<?php

	$REGISTROS = false;
	error_reporting(-1);

	require_once 'configuraciones.php';
	require_once 'controlar_accesos.php';

	$Vmen = '';
	$Vest = '';
	$otrosDatos = '';

	if (isset($_REQUEST['a'])) {

	    $accion = REQ('a');
	    $accion = $_REQUEST['a'];
		$array = explode('_', $accion);
		$carpeta = $array[1].'/';

		require_once "controladores/$carpeta".$accion.".php";

	   
	}
	if (empty($Vmen)) { //NO SE REALIZó LA OPERACIÓN
	    switch ($Vest) {
	        case 0:
	            $Vmen = 'No hay registros';
	        break;
	        case -1:
	            $Vmen = 'Ocurrió un error11';
	        break;
	        case -2:
	            $Vmen = 'No existe parametro';
	        break;
	        case 2:
	            $Vmen = 'Operación realizada con exito';
	        break;

	        default:
	        break;
	    }
	} else {
	    if (empty($Vmen)) {
	        $Vest = 0;
	    }
	}
	$RESPUESTA = json_encode(array(
	    'est' => $Vest,
	    'men' => json_encode($Vmen),
	    'otrosDatos' => json_encode($otrosDatos)
	));

	if($REGISTROS) {
		$RESPUESTA = json_decode($RESPUESTA, true);
		$RESPUESTA['registros'] = json_encode($REGISTROS);
		$RESPUESTA = json_encode($RESPUESTA);
	}

	echo $RESPUESTA;


	

?>