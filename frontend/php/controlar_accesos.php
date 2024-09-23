<?php
  
  require_once("funciones.php");
  require_once("funciones_app.php");


  $accion = $entidad ?? '';
  $esInicioSesion =  ($accion == 'login');
  #### SI NO ES INICIO DE SESIÓN, ES DECIR QUE YA ESTÁ DENTRO DEL SISTEMA
  if(!$esInicioSesion) { 

    @session_start();
    $inicio = $_SERVER['HTTP_HOST'] . '/reservas/login.php';

    $sesion = isset($_SESSION['idUsuario']);


    if(!$sesion) {
          
        header('Location: //' . $inicio);
    }
    $tipoUsuario = $_SESSION['tipoUsuario'];
      
  } else {
      header('Location: //' . $inicio);// .$_SERVER['HTTP_HOST'] . basename(RUTA_BASE));
      $Vmen = "Error al procesar los datos";
      
  }

  

?>