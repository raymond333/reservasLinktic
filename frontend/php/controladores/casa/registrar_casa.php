<?php
 
  $direccion = $_POST['direccion']; 
  $nombre = $_POST['nombre']; 
  $propietario = $_POST['propietario']; 

  $idCasa    = $_POST['idCasa'] ?? 0;
  $idCasa    = emptyCase($idCasa);

  $accion = ($idCasa == 0) ? 'REGISTRADO' : 'MODIFICADO';
  $nuevoRegistro = ($idCasa == 0);

  $condicion = ($nuevoRegistro) ? '' : "AND id_casa <> '$idCasa'";

  $sql = "SELECT 1 FROM casas WHERE nombre_casa = '$$nombre' $condicion LIMIT 1";
  $VERIFICAR = SQL($sql);
  if (CAN_REG($VERIFICAR) > 0) {
    $Vmen = "ESTE NOMBRE DE CASA YA ESTÁ REGISTRADO";
    $Vest = 1;
  } else {

    if($nuevoRegistro) {

      $sql = "INSERT INTO casas(nombre_casa, direccion_casa, nombre_propietario) 
                          VALUES ('$nombre', '$direccion', '$propietario')";
    } else {

      $sql = "UPDATE casas 
                SET nombre_casa = '$nombre', direccion_casa = '$direccion', nombre_propietario = '$propietario'
              WHERE id_casa = '$idCasa'";
    }

    $INSERTAR = SQL($sql);
                
    if ($INSERTAR > 0) {
      $Vmen = "CASA $accion CON EXITO";
      $Vest = 2;
    } else {
      $Vmen = "Ocurrió un error";
    }
  }
            

?>