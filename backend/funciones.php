<?php 

    function SQL($VPsql){
        require("pdo.php");
        try {
            $VFresultado = $VGconexion -> prepare((($VPsql)));
            $ejecutar = $VFresultado -> execute();
            if($ejecutar) {
                // Para SELECT, retorna los resultados
                if (strpos(trim($VPsql), 'SELECT') === 0) {
                    return $VFresultado->fetchAll(); 
                }
                // Para INSERT, retorna el último ID insertado
                if (strpos(trim($VPsql), 'INSERT') === 0) {
                    return $VGconexion->lastInsertId();
                }
                // Para UPDATE y DELETE, retorna la cantidad de filas afectadas
                $retorno = array($VFresultado->rowCount());
                return $retorno; // Retorna true si se afectaron filas
                
                  
            }
            return $ejecutar;
       
        } catch (PDOException $e) {
            //$VmensajeRespuestamen = "Ocurrió un error. Consulte al administrador del sistema";
            //if(defined('PRODUCCION')) {
                $mensajeRespuesta = $e->getMessage();
            //}
            http_response_code(500); // 
            echo json_encode(['error' => $mensajeRespuesta]);
            exit();
        }
    }


    function CAN_REG($VPreg){
        return count($VPreg);
    }
