<?php
 
  $documento = $_POST['documento']; 
  $nombre = $_POST['nombre']; 

  $idTrabajador    = $_POST['idTrabajador'] ?? 0;
  $idTrabajador    = emptyCase($idTrabajador);

  $accion = ($idTrabajador == 0) ? 'REGISTRADO' : 'MODIFICADO';
  $nuevoRegistro = ($idTrabajador == 0);

  $condicion = ($nuevoRegistro) ? '' : "AND id_trabajador <> '$idTrabajador'";

  $sql = "SELECT 1 FROM trabajadores WHERE documento_trabajador = '$documento' $condicion LIMIT 1";
  $VERIFICAR = SQL($sql);
  if (CAN_REG($VERIFICAR) > 0) {
    $Vmen = "ESTE DOCUMENTO DE IDENTIDAD YA ESTÁ REGISTRADO";
    $Vest = 1;
  } else {

    if($nuevoRegistro) {

      $sql = "INSERT INTO trabajadores(nombre_trabajador, documento_trabajador) 
                          VALUES ('$nombre', '$documento')";
    } else {

      $sql = "UPDATE trabajadores 
                SET nombre_trabajador = '$nombre', documento_trabajador = '$documento'
              WHERE id_trabajador = '$idTrabajador'";
    }

    $INSERTAR = SQL($sql);
                
    if ($INSERTAR > 0) {
      $Vmen = "TRABAJADOR $accion CON EXITO";
      $Vest = 2;
    } else {
      $Vmen = "Ocurrió un error";
    }
  }
            

?>