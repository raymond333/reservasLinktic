<?php
  $id     = $_POST['idDetalleAsignacion']; 
  $sql = "DELETE FROM detalles_asignacion WHERE id_detalle_asignacion = '$id'";
  $ELIMINAR = SQL($sql);
  if ($ELIMINAR > 0) {
    $Vmen = "Servicio eliminado de la asignación";
    $Vest = 2;
  } else {
    $Vmen = "Ocurrió un error";
  }            
?>