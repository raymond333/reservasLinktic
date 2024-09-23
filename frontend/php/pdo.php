<?php
 
  
  try {
   
    $VGconexion = new PDO('mysql:host=localhost;dbname=c1620864_sagps;charset=utf8', 'c1620864_sagps', 'fiSU96peva');

    $VGconexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $VGconexion -> query("SET NAMES 'utf8';");
    //$VGconexion -> query("SET time_zone = 'America/Lima';");
    //$VGconexion -> query("SET GLOBAL time_zone = 'America/New_York'");
    //$VGconexion -> query("SET sql_mode = ''");
    //$VGconexion -> query("SET lc_time_names = 'es_ES'");
    
    
    

  }
  catch(PDOException $er) {
      echo 'Error conectando a la BD. '.$er->getMessage(); 
  }
 
?>