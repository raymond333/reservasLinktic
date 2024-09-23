<?php
  $id     = $_POST['idCasa']; 
  $sql = "DELETE FROM casas WHERE id_casa = '$id'";
  $ELIMINAR = SQL($sql);
  if ($ELIMINAR > 0) {
    $Vmen = "Casa Eliminada";
    $Vest = 2;
  } else {
    $Vmen = "Ocurrió un error";
  }            
?>