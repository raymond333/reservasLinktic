<?php
    @session_start();//session_destroy();exit(); 
    header("Content-Type: application/json");

    require_once '../funciones.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    $url = $_SERVER['REQUEST_URI'];

    // Se elimina la parte de la URL a partir de ?, es decir, los parameros
    // Esto se hace para tener la ENTIDAD limpia
    $url = strtok($url, '?');
    $url = explode('/', trim($url, '/'));

        
    if (count($url) < 3 || $url[1] !== 'api') {
        $estatusRespuesta = (404);    
        echo json_encode(["mensaje" => "Recurso no encontradoR"]);
        exit;
    }

    $entidad = strtolower($url[2]); 


    if($entidad !== 'login') { // Si no es el Login (podemos añadir mas opciones para permitir consumir sin estar logueado)
        if(!isset($_SESSION['idUsuario'])) { // Se verifica si ya e inició sesión
            $estatusRespuesta = (401); // 
            echo json_encode(['error' => 'Primero debe iniciar sesión']);
            exit();
        }
    }
    $idRegistro = $url[3] ?? 0; // El parametro para sonsultar un registro especifico de una entidad

    // Se construye la ruta del controlador con la entidd y el metodo recibido
    $rutaControlador = '../controladores/' . strtolower($entidad) . '/' . strtolower($metodo) . '.php';

    // Verificar si el archivo del controlador existe
    if (file_exists($rutaControlador)) {
        $DATOS = json_decode(file_get_contents("php://input"), true);
        
        include $rutaControlador;

        
        //echo json_encode(["mensaje" => $mensajeRespuesta]);

    } else {
        $estatusRespuesta = (404);
        $mensajeRespuesta = "Recurso no encontrado";
    }


    $respuesta = [
        "estatus" => $estatusRespuesta < 400 ? "ok" : "error", // Determina el estado
        "codigo" => $estatusRespuesta, // Código de estado HTTP
        "datos" => [], // Inicializa el campo de datos
        "mensaje" => $mensajeRespuesta ?? ''// Mensaje informativo
    ];

    if(isset($datosRespuesta)) {
        $respuesta["datos"] = $datosRespuesta;
    }
    echo json_encode($respuesta);
    http_response_code($estatusRespuesta); 
?>
