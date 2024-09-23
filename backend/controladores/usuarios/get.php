<?php



    // Condición para obtener solo el id que se requiere
    $condicion = ($idRegistro > 0) ? " AND id_usuario = $idRegistro" : '';

    $sql = "SELECT id_usuario, nombre, tipo, correo FROM usuarios WHERE 1 = 1 $condicion";
        
    $USUARIOS = SQL($sql);

    if ($USUARIOS > 0) {
        if(CAN_REG($USUARIOS) > 0) {
            $estatusRespuesta = 201; 
            $datosRespuesta = $USUARIOS;
        } else {
            $estatusRespuesta = 400; 
            $mensajeRespuesta = "Usuario no encontrado";
        }
    } else {
        $estatusRespuesta = 500; 
        $mensajeRespuesta = "Error al consultar los usuarios";
    }
    
?>
