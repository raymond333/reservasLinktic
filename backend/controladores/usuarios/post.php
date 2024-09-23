<?php

    $nombre     = $DATOS['nombre'] ?? '';
    $tipo       = $DATOS['tipo'] ?? '';
    $contrasena = $DATOS['contrasena'] ?? '';
    $correo     = $DATOS['correo'] ?? '';

    if (count(array_filter([$nombre, $tipo, $contrasena, $correo])) < 4) {
        $estatusRespuesta = 400; 
        $mensajeRespuesta = "Datos incompletos";
    } else {

        $sql = "SELECT nombre, tipo, contrasena FROM usuarios WHERE correo = trim('$correo') LIMIT 1";
        
        $VERIFICAR = SQL($sql);

        if(CAN_REG($VERIFICAR) > 0) {
            $estatusRespuesta = 409; 
            $mensajeRespuesta = "Este usuario ya existe";
        } else {


            $contrasena = password_hash($contrasena, PASSWORD_DEFAULT); 

            $sql = "INSERT INTO usuarios SET nombre = '$nombre', tipo = '$tipo', contrasena = '$contrasena', correo = '$correo'";
            
            $INSERTAR = SQL($sql);

            if ($INSERTAR > 0) {
                $estatusRespuesta = 201; 

                $datosRespuesta = [
                    "id_usuario" => $INSERTAR, // $INSERTAR contiene el id del ultimo registro isertado (lastInsertId)
                    "nombre" => $nombre,
                    "tipo" => $tipo,
                    "correo" => $correo,
                    "mensaje" => "Usuario creado exitosamente"
                ];
            } else {
                $estatusRespuesta = 500; 
                $mensajeRespuesta = "Error al crear el usuario";
            }
        }
    }
?>
