<?php
  
  require_once '../php/configuraciones.php';
  require_once '../php/controlar_accesos.php';

  $idTrabajador = $_POST['idTrabajador'];

  $TRABAJADOR = SQL("SELECT nombre_trabajador, documento_trabajador FROM trabajadores WHERE id_trabajador = $idTrabajador");

  if (CAN_REG($TRABAJADOR) == 0) {

    echo "<script>alert('Trabajador no encontrado');window.close()</script>";

  } else {

    $TRABAJADOR = $TRABAJADOR[0];
    $nombre     = $TRABAJADOR -> nombre_trabajador;
    $dni        = $TRABAJADOR -> documento_trabajador;

    $SERVICIOS  = SQL("SELECT DATE_FORMAT(a.fecha_asignacion, '%e de %M de %Y') AS fecha, 
                              s.nombre_servicio AS servicio, 
                              c.nombre_casa AS casa

                            FROM detalles_asignacion da
                      INNER JOIN servicios s ON da.id_servicio = s.id_servicio
                      INNER JOIN asignaciones a ON da.id_asignacion = a.id_asignacion
                      INNER JOIN casas c ON a.id_casa = c.id_casa
                      INNER JOIN trabajadores t ON da.id_trabajador = t.id_trabajador
                    WHERE t.id_trabajador = $idTrabajador AND fecha_asignacion <= CURRENT_DATE
                    ORDER BY fecha DESC");

    if (CAN_REG($SERVICIOS) == 0) {
      $mensaje = "Esta casa no tiene historial de servicios";
    } 
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reporte de Servicios por Trabajador</title>
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
        <h1>Reporte de Servicios por Trabajador</h1>
        <h2>Datos del trabajador:</h2>
      </td>
    </tr>
    <tr>
      <th>Nombre</th>
      <th>DNI</th>
    </tr>
    <tr>
      <td><?php echo $nombre ?></td>
      <td><?php echo $dni ?></td>
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
      <th style="background: royalblue;">CASA</th>
      <th style="background: royalblue;">FECHA</th>
    </tr>

    
    <?php

      if (isset($mensaje)) {
        echo "<h2> $mensaje</h2>";
      } else {
        foreach ($SERVICIOS as $SERVICIO) {
            $servicio   = $SERVICIO -> servicio;
            $fecha      = $SERVICIO -> fecha;
            $casa       = $SERVICIO -> casa;
            ?>

            
            <tr>
              <td><?php echo $servicio ?></td>
              <td><?php echo $casa ?></td>
              <td><?php echo $fecha ?></td>
            </tr>
            <?php
            

        }
      }
    ?>

        
  </table>
</body>
</html>