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
				include 'comun/vistas/usuarios/lista_usuarios.php';
			
    ?>
    </div>


    <?php include 'comun/secciones/librerias_scripts.html' ?>


    
  </body>
</html>