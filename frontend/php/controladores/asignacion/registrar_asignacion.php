<?php
   
    $casa         = $_POST['casa']; 
    $fecha        = $_POST['fecha']; 
    $servicios    = $_POST['servicios']; 
    $trabajadores = array_filter($_POST, function($valor, $campo) {
        return strpos($campo, "trabajador") === 0 && !empty($valor);
    }, ARRAY_FILTER_USE_BOTH);
    $trabajadores = implode(',', $trabajadores);


    $administrador  = $_POST['administrador'] ?? 0; ##### SOCIO - administrador de la casa #### 

    

    // Se verifica si algún trabajador tiene otra casa asignada a la misma hora
    $VERIFICAR = SQL("SELECT GROUP_CONCAT(nombre_trabajador SEPARATOR ', ') nombres FROM detalles_asignacion 
                                  INNER JOIN asignaciones USING(id_asignacion)
                                  INNER JOIN trabajadores t USING(id_trabajador)
                            WHERE 
                              fecha_asignacion = '$fecha'
                              AND t.id_trabajador IN($trabajadores) 
                          GROUP BY fecha_asignacion");//echo $VERIFICAR;exit();
    if (CAN_REG($VERIFICAR) > 0) {
      $nombres = $VERIFICAR [0] -> nombres;
      $Vmen = "Los trabajadores ($nombres) ya están asignados a una casa a la hora seleccionada";

    } else {


      // PRIMERO SE VERIFICA
      // SI LA CASA YA TIENE
      // UNA ASIGNACIÓN EN 
      // LA FECHA INDICADA
      $sql = "SELECT id_asignacion FROM asignaciones WHERE 
                    id_casa = $casa 
                  AND date(fecha_asignacion) = date('$fecha') LIMIT 1";//echo $sql;exit();

      $ASIGNACION = SQL($sql);

      if (CAN_REG($ASIGNACION) > 0) {
        // YA TIENE ASIGNACIÓN PARA ESTA FECHA


        $ASIGNACION = $ASIGNACION[0] -> id_asignacion;

        //$Vmen = "Esta casa ya está asignada para la fecha indicada";
        $tieneAsignación = true;

      } else { // NO TIENE ASIGNACIÓN

        $tieneAsignación = false;

        // SE INSERTA LA ASIGNACIÓN
        $ASIGNACION = SQL("INSERT INTO asignaciones SET id_casa = $casa, 
                                fecha_asignacion = '$fecha'");
      }

      if ($ASIGNACION > 0) {

        // EL ID_ASIGNACIÓN NUEVO
        $id = $ASIGNACION;

        // SE INSERTAN LOS DETALLES (SERVICIOS)
        foreach ($servicios as $idServicio) {
          // Obtener el ID del trabajador correspondiente al servicio
          $idTrabajador = $_POST['trabajador' . $idServicio];

            
          // Insertar la asignación en la base de datos
          $sql = "INSERT INTO detalles_asignacion (id_asignacion, id_servicio, id_trabajador) VALUES ($id, $idServicio, $idTrabajador)";
          $INSERTAR = SQL($sql);
          if($INSERTAR > 0) {
            $Vmen = "Servicios asignados";
            $Vest = 2;
          } else {
            $Vmen = "Ocurrió un error y no se pudo realizar el registro";
          }
        }
      } else {
        $Vmen = "Ocurrió un error al realizar la asignación";
      }
        
    }  

?>