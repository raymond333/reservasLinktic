<?php
  
  require_once '../php/configuraciones.php';
  require_once '../php/controlar_accesos.php';

  $idCasa = $_POST['idCasa'];

  $CASA = SQL("SELECT nombre_casa, direccion_casa, nombre_propietario FROM casas WHERE id_casa = $idCasa");

  if (CAN_REG($CASA) == 0) {

    echo "<script>alert('Casa no cencontrada');window.close()</script>";

  } else {

    $CASA         = $CASA[0];
    $nombre       = $CASA -> nombre_casa;
    $direccion    = $CASA -> direccion_casa;
    $propietario  = $CASA -> nombre_propietario;

    $SERVICIOS  = SQL("SELECT DATE_FORMAT(a.fecha_asignacion, '%e de %M de %Y') AS fecha, 
                              s.nombre_servicio AS servicio, 
                              t.nombre_trabajador AS trabajador

                            FROM detalles_asignacion da
                      INNER JOIN servicios s ON da.id_servicio = s.id_servicio
                      INNER JOIN asignaciones a ON da.id_asignacion = a.id_asignacion
                      INNER JOIN casas c ON a.id_casa = c.id_casa
                      INNER JOIN trabajadores t ON da.id_trabajador = t.id_trabajador
                    WHERE c.id_casa = $idCasa
                      GROUP BY fecha, s.nombre_servicio, t.nombre_trabajador
                    ORDER BY fecha DESC");

    if (CAN_REG($SERVICIOS) == 0) {
      $mensaje = "Esta casa no tiene historial de servicios";
    } 
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reporte de Servicios</title>
  <style>
    /* Estilos CSS para el reporte */
    body {
      font-family: Arial, sans-serif;
    }
    
    h1 {
      text-align: center;
    }
    
    table {
      margin-left: auto;
      margin-right: auto;
      width: 50%;
      border-collapse: collapse;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
    }

    p {
        page-break-before: always;
        /*margin-top: 350px;*/
    }
      @page {
        /*declaraciones*/
       @top-left {
        content: 'Título';
        }
        @top-right {
        content: 'Pág. ' counter(page);
        }
       
      }
      @page {size: portrait;}
      @page rotada {size:  portrait;}
  </style>
</head>
<body>
  
  <table>
    <tr>
      <td colspan="3">
        <h1>Reporte de Servicios</h1>
        <h2>Datos de la casa:</h2>
      </td>
    </tr>
    <tr>
      <th>Nombre casa</th>
      <th>Dirección</th>
      <th>Propietario</th>
    </tr>
    <tr>
      <td><?php echo $nombre ?></td>
      <td><?php echo $direccion ?></td>
      <td><?php echo $propietario ?></td>
    </tr>
  </table>
  
  
  <table>
    <tr>
      <td colspan="3">
        <h2>Servicios realizados:</h2>
      </td>
    </tr>
    
    <tr style="color: white;">
      <th style="background: royalblue;">SERVICIO</th>
      <th style="background: royalblue;">TRABAJADOR</th>
    </tr>

    
    <?php

      $fechaAnterior = '';
      if (isset($mensaje)) {
        echo "<h2> $mensaje</h2>";
      } else {
        foreach ($SERVICIOS as $SERVICIO) {
            $servicio = $SERVICIO->servicio;
            $fecha = $SERVICIO->fecha;
            $trabajador = $SERVICIO->trabajador;

            if ($fecha <> $fechaAnterior) {
              echo "<tr>";
              echo "<th colspan='2' style='text-align:center'>$fecha</th colspan='2' style='text-align:center'>";
              echo "</tr>";
            }
           
            echo "<tr>";
            echo "<td>$servicio</td>";
            echo "<td>$trabajador</td>";
            echo "</tr>";
            

            $fechaAnterior = $fecha;
        }
      }
    ?>

        
  </table>
</body>
</html>