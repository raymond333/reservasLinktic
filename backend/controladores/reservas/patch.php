<?php

    $idReserva      = $idRegistro; // Obtener el ID de la reserva a cancelar
    $nuevoEstado    = $DATOS['estado'] ?? '';    // Indica si se  va a cancelar o a ejecutar la reserva
    $idUsuario      = $_SESSION['idUsuario'];

    if(in_array($nuevoEstado, array('cancelada', 'ejecutada'))) {


        // Condición para filtrar solo si la reserva a modificar pertenece al cliente logueado
        $relacionUsuario = ($_SESSION['tipoUsuario'] == 'administrador') ? '' : " AND id_usuario = $idUsuario";

        if (count(array_filter([$idReserva, $nuevoEstado])) < 2) {
            $estatusRespuesta = 400; 
            $mensajeRespuesta = "Datos incompletos";
        } else {
            // Verificar si la reserva existe
            $sql = "SELECT estado FROM reservas WHERE id_reserva = $idReserva $relacionUsuario";
            $RESERVA = SQL($sql);

            if (CAN_REG($RESERVA) == 0) {
                $estatusRespuesta = 404; 
                $mensajeRespuesta = "Reserva no encontrada o pertenece a otro usuario";
            } else {

                $estadoReserva = $RESERVA[0] -> estado;
                if($estadoReserva <> 'pendiente') {
                    $estatusRespuesta = 404; 
                    $mensajeRespuesta = "ESta reserva no puede ser $nuevoEstado porque ya está '$estadoReserva'";
                    
                } else {
            
                    // Cancela o ejecutar la reserva la reserva
                    $sql = "UPDATE reservas 
                                SET estado = '$nuevoEstado' 
                                WHERE id_reserva = $idReserva";
                            
                    $RESERVA = SQL($sql);

                    if ($RESERVA) {
                                $estatusRespuesta = 200; 
                                $mensajeRespuesta = "Reserva $nuevoEstado exitosamente";
                    } else {
                                $estatusRespuesta = 500; 
                                $mensajeRespuesta = "Error al actualizar la reserva";
                    }
                }
            }
        }
    } else {
        $estatusRespuesta = (404);
        $mensajeRespuesta = "Estado de reserva no valido";
    }

?>
