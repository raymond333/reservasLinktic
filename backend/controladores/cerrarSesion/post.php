<?php
    @session_start();
    @session_unset();
    @session_destroy();
    $estatusRespuesta = 200;
    $mensajeRespuesta = "Sesión cerrada";
?>
