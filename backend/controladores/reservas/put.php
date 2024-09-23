<?php

$relacionUsuario = '';
if ($_SESSION['tipoUsuario'] == 'administrador') { // Reserva manual
    $idUsuario       = $DATOS['idUsuario'] ?? ''; // Usuario tipo Cliente seleccionado por el administrador
    $idAdministrador = $_SESSION['idUsuario'];
} else {
    $idUsuario       = $_SESSION['idUsuario']; // Usuario logueado (cliente)
    $idAdministrador = 'NULL';

    // Condición para filtrar solo si la reserva a modificar pertenece al cliente logueado
    $relacionUsuario = " AND id_usuario = $idUsuario";
}

$idReserva      = $DATOS['idReserva'] ?? null; // Obtener el ID de la reserva a actualizar
$fecha          = $DATOS['fecha'] ?? '';
$idServicio     = $DATOS['idServicio'] ?? '';
$idDetalle      = $DATOS['idDetalleReserva'] ?? '';

if (empty($idReserva) || count(array_filter([$fecha, $idServicio, $idUsuario, $idDetalle])) < 4) {
    $estatusRespuesta = 400; 
    $mensajeRespuesta = "Datos incompletos";
} else {
    // Verificar si la reserva existe
    $sql = "SELECT 1 FROM reservas WHERE id_reserva = $idReserva $relacionUsuario";
    $VERIFICAR = SQL($sql);

    if (CAN_REG($VERIFICAR) == 0) {
        $estatusRespuesta = 404; 
        $mensajeRespuesta = "Reserva no encontrada";
    } else {
        // Verificar si el servicio ya está reservado para la nueva fecha
        $sql = "SELECT id_servicio FROM detalles_reserva 
                            INNER JOIN reservas AS R USING(id_reserva)
                                WHERE id_servicio = $idServicio 
                                    AND fecha_inicio = '$fecha' 
                                    AND R.estado = 'pendiente' 
                                    AND R.id_reserva != $idReserva LIMIT 1";
        
        $VERIFICAR = SQL($sql);

        if (CAN_REG($VERIFICAR) > 0) {
            $estatusRespuesta = 409; 
            $mensajeRespuesta = "Este servicio ya está reservado para el día seleccionado";
        } else {
            // Se verifica si el servicio y usuario del cliente a registrar existen
            $sql = "SELECT 
                        EXISTS(SELECT 1 FROM usuarios WHERE id_usuario = $idUsuario AND tipo = 'cliente') AS usuario,
                        EXISTS(SELECT 1 FROM servicios WHERE id_servicio = $idServicio) AS servicio";

            // En esta consulta se añadió tipo = 'cliente' par evitar asignar reservas a Administradores (opcional)

            $VERIFICAR = SQL($sql);

            $usuarioExiste  = $VERIFICAR[0] -> usuario;
            $servicioExiste = $VERIFICAR[0] -> servicio;

            if($usuarioExiste == 0) {

                $mensajeRespuesta = "El cliente que quiere asignar a la reserva no se encuentra registrado";
                $estatusRespuesta = 409;

            } elseif($servicioExiste == 0) {

                $mensajeRespuesta = "El servicio que quiere asignar a la reserva no se encuentra registrado";
                $estatusRespuesta = 409;

            } else {

                // Actualizar la reserva
                $sql = "UPDATE reservas 
                            SET id_usuario = '$idUsuario', 
                                fecha_inicio = '$fecha' 
                            WHERE id_reserva = $idReserva";
                
                $RESERVA = SQL($sql);

                if ($RESERVA) {

                    $sql = "UPDATE detalles_reserva 
                                    SET id_servicio = '$idServicio' WHERE id_detalle_reserva = $idDetalle";
                
                    $DETALLES_RESERVA = SQL($sql);


                    $estatusRespuesta = 200; 
                    $mensajeRespuesta = "Reserva actualizada exitosamente";
                } else {
                    $estatusRespuesta = 500; 
                    $mensajeRespuesta = "Error al actualizar la reserva";
                }
            }
        }
    }
}


?>
