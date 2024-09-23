<?php
    $tipoUsuario = $_SESSION['tipoUsuario'];
    $idUsuario   = $_SESSION['idUsuario'];

    // FILTROS PARA FECHAS
        #### FALTA VALIDAR QUE LAS FECHAS SEAN FECHAS
       
        $fecha      = $_GET['fecha'] ?? '';
        $fechaDesde = $_GET['fechaDesde'] ?? '';
        $fechaHasta = $_GET['fechaHasta'] ?? '';

        $condicionFechas = ' >= CURDATE()'; // Condición predeterminada par no mostrar reservas vencidas

        // Se verifica si se solicitó una fecha en epecifico
        if (!empty($fecha)) {
            // Si la fecha es 'hoy', se asigna la función CURDATE()
            if ($fecha === 'hoy') {
                $condicionFechas = " = CURDATE()"; // Filtrar por la fecha actual
            } else {
                $condicionFechas = " = '$fecha'"; // Filtrar por una fecha específica
            }
        } else {

            // Se verifica si se pasó un rango de fechas
            if (!empty($fechaDesde)) {
                $condicionFechas = " >= '$fechaDesde'"; 
            }

            if (!empty($fechaHasta)) {
                // Si ya hay una condición, se agrega 'AND'
                if (!empty($condicionFechas)) {
                    $condicionFechas .= " AND ";
                }
                $condicionFechas .= "fecha_inicio <= '$fechaHasta'"; 
            }
        }

        $condicionFechas = "AND fecha_inicio $condicionFechas";
    // FIN  FILTROS PARA FECHAS

    //Condición para filtrar solo las reservas del cliente loguado
    $condicion = ($tipoUsuario == 'cliente') ? " AND id_usuario = $idUsuario" : '';

    //Condición para filtrar sola las reservas del id recibido
    $condicion .= ($idRegistro > 0) ? " AND id_reserva = $idRegistro" : '';
    $sql = "SELECT id_reserva, id_usuario, id_administrador, fecha_inicio, R.estado, nombre AS cliente, descripcion AS servicio, id_servicio, id_detalle_reserva, 
                                        IF(DATE(fecha_inicio) = CURDATE(), 
                                            'HOY', DATE_FORMAT(fecha_inicio, '%W, %d-%m-%Y')) AS fecha
                                    FROM reservas AS R
                                INNER JOIN usuarios USING(id_usuario) 
                                INNER JOIN detalles_reserva USING(id_reserva) 
                                INNER JOIN servicios USING(id_servicio)
                            WHERE 
                                1 = 1 AND R.estado = 'pendiente' 
                                $condicionFechas 
                                $condicion 
                            ORDER BY fecha_inicio"; //echo $sql;
        
    $RESERVAS = SQL($sql);

    if ($RESERVAS > 0) {
        if(CAN_REG($RESERVAS) > 0) {

            $estatusRespuesta = 201; 
            $datosRespuesta = $RESERVAS;

        } else {
            $estatusRespuesta = 400; 
            $mensajeRespuesta = "Reserva no encontrada";
        }
    } else {
        $estatusRespuesta = 500; 
        $mensajeRespuesta = "Error al consultar los reservas";
    }
    
?>
