<?php    
  require_once 'php/controlar_accesos.php';
?>
<!DOCTYPE html>
<html lang="en">
  <?php include 'comun/secciones/head.php' ?>
  <body>
    <?php include 'comun/secciones/cargando.html' ?>

    <!-- HEADER -->
    <?php include 'comun/secciones/header.php' ?>

    <!-- MENÚ -->
    <?php include 'comun/secciones/menu.php' ?>

    <div class="pc-container">
		<?php
      // Obtener la vista solicitada desde la URL
      //$vista = isset($_GET['vista']) ? $_GET['vista'] : 'reservas'; // Valor por defecto
		  include 'comun/vistas/reservas/lista_reservas.php';
			
    ?>
    </div>


    <?php include 'comun/secciones/librerias_scripts.html' ?>


  </body>
</html>