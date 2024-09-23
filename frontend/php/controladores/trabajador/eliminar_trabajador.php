<?php
  $id     = $_POST['idTrabajador']; 
  $sql = "DELETE FROM trabajadores WHERE id_trabajador = '$id'";
  $ELIMINAR = SQL($sql);
  if ($ELIMINAR > 0) {
    $Vmen = "Trabajador Eliminado";
    $Vest = 2;
  } else {
    $Vmen = "Ocurrió un error";
  }            
?>