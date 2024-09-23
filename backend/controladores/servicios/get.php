<?php


    $condicion = ($idRegistro > 0) ? " AND id_servicio = $idRegistro" : '';
    $sql = "SELECT id_servicio, descripcion FROM servicios WHERE 1 = 1 $condicion";
        
    $SERVICIOS = SQL($sql);

    if ($SERVICIOS > 0) {
        if(CAN_REG($SERVICIOS) > 0) {
            $estatusRespuesta = 201; 
            $datosRespuesta = $SERVICIOS;
        } else {
            $estatusRespuesta = 400; 
            $mensajeRespuesta = "Servicio no encontrado";
        }
    } else {
        $estatusRespuesta = 500; 
        $mensajeRespuesta = "Error al consultar los servicios";
    }
    
?>
