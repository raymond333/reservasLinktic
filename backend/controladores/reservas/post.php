<?php

    if($_SESSION['tipoUsuario'] == 'administrador') { // Reserva manual
        $idUsuario       = $DATOS['idUsuario'] ?? ''; // Usuario tipo Cliente seleccionado por el administrador
        $idAdministrador = $_SESSION['idUsuario'];
    } else {
        $idUsuario       = $_SESSION['idUsuario']; // Usuario logueado (cliente)
        $idAdministrador = 'NULL';
    }
    
    $fecha       = $DATOS['fecha'] ?? '';
    $idServicio  = $DATOS['idServicio'] ?? '';

    if (count(array_filter([$fecha, $idServicio, $idUsuario])) < 3) {
        $estatusRespuesta = 400; 
        $mensajeRespuesta = "Datos incompletos";
    } else {

        $sql = "SELECT id_servicio FROM detalles_reserva 
                                INNER JOIN reservas AS R USING(id_reserva)
                                        WHERE id_servicio = $idServicio 
                                            AND fecha_inicio = '$fecha' 
                                            AND R.estado = 'pendiente' LIMIT 1";
        
        $VERIFICAR = SQL($sql);

        if(CAN_REG($VERIFICAR) > 0) {
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

                // Se registra la reserva
                $sql = "INSERT INTO reservas 
                                    SET id_usuario = '$idUsuario', 
                                        id_administrador = '$idAdministrador', 
                                        fecha_inicio = '$fecha'";
                
                $RESERVA = SQL($sql);

                if ($RESERVA > 0) {

                    $idReserva = $RESERVA;

                    $sql = "INSERT INTO detalles_reserva 
                                    SET id_reserva = '$idReserva', 
                                        id_servicio = '$idServicio'";
                
                    $DETALLES_RESERVA = SQL($sql);


                    $estatusRespuesta = 201; 

                    $detalles = [
                        "id_detalle_reserva" => $DETALLES_RESERVA, // $INSERTAR contiene el id del ultimo registro isertado (lastInsertId)
                        "id_reserva" => $idReserva,
                        "id_servicio" => $idServicio
                    ];

                    $mensajeRespuesta = [
                        "id_reserva" => $idReserva, // $INSERTAR contiene el id del ultimo registro isertado (lastInsertId)
                        "id_usuario" => $idUsuario,
                        "id_administrador" => $idAdministrador,
                        "fecha_inicio" => $fecha,
                        "estado" => 'pendiente',
                        "mensaje" => "Reserva creada exitosamente",
                        "detalles_reserva" => $detalles
                    ];
                } else {
                    $estatusRespuesta = 500; 
                    $mensajeRespuesta = "Error al crear la reserva";
                }
            }
        }
    }
?>
