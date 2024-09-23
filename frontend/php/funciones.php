<?php


  function emptyCase ($variable) {
    

    return (empty($variable) ? 0 : $variable);
    
  }
  function SQL($VPsql){
    require("pdo.php");
    try {
      $VFresultado = $VGconexion -> prepare((($VPsql)));
      $result = $VFresultado -> execute();
      //$VGconexion = null;
      if($result) {
          $retorno = $VFresultado->fetchAll(); 
          if(count($retorno) == 0) {
            $ultimoId = $VGconexion -> lastInsertId();
            $retorno = ($ultimoId == 0) ? $retorno : $ultimoId;
          }
          return $retorno;
      }
      $Vmen = "Ocurrió un error al procesar consulta SQL.";
    } catch (PDOException $e) {
      //echo $e->getMessage();
      $Vmen = "Ocurrió un error. Consulte al administrador del sistema";
      if(defined('PRODUCCION')) {
        $Vmen = $e->getMessage();
      }
      $Vest = -1;
      echo $Vmen;
      exit();
    }
  }
  function SQL_respaldo($VPsql){
    require("pdo.php");
    try {
      $VFresultado = $VGconexion -> prepare((($VPsql)));
      $result = $VFresultado -> execute();
      $VGconexion = null;
      if($result) {
          return $VFresultado->fetchAll(); 
      }
      $Vmen = "Ocurrió un error al procesar consulta SQL.";
    } catch (PDOException $e) {
      //echo $e->getMessage();
      $Vmen = "Ocurrió un error. Consulte al administrador del sistema";
      if(defined('PRODUCCION')) {
        $Vmen = $e->getMessage();
      }
      $Vest = -1;
      echo $Vmen;
      exit();
    }
  }
 
  function LlenarSelect($consulta, $texto, $valor, $opcionSeleccionada = '', $primeraOpcion = '') {
    
    require_once 'pdo.php';

    $registros = SQL($consulta);

    if(!empty($primeraOpcion)){
      echo "<option value=''>$primeraOpcion</option>";
    }

    foreach ($registros as $registro) {
      $Vtexto = ($registro -> $texto);
      $Vvalor = ($registro -> $valor);
      $selecconada = ($Vtexto == $opcionSeleccionada) ? 'selected' : '';
     
      echo "<option value='$Vvalor' $selecconada>$Vtexto</option>";
    }
  }

  function LlenarSelect2($consulta, $texto, $valor, $opcionSeleccionada = '', $primeraOpcion = '') {
    
    require_once 'pdo.php';

    $registros = SQL($consulta);

    if(!empty($primeraOpcion)){
      echo "<option value=''>$primeraOpcion</option>";
    }

    foreach ($registros as $registro) {
      $Vt = ($registro -> $texto);
      $Vv = ($registro -> $valor);
      $Vtem = '';
      if($Vt == $opcionSeleccionada){
        $Vtem = 'selected';
      }
      echo "<option $Vtem value='$Vv'>$Vt</option>";
    }
  }


  function CAN_REG($VPreg){
    return count($VPreg);
  }

  function REQ($VPtem){
    return $_REQUEST[$VPtem];
  }


  function SepararNombres($PNom){
      /* separar el nombre completo en espacios */
      $tokens = explode(' ', trim($PNom));
      /* arreglo donde se guardan las "palabras" del nombre */
      $names = array();
      /* palabras de apellidos (y nombres) compuetos */
      $special_tokens = array('da', 'de', 'del', 'la', 'las', 'los', 'mac', 'mc', 'van', 'von', 'y', 'i', 'san', 'santa');
      
      $prev = "";
      foreach($tokens as $token) {
          $_token = strtolower($token);
          if(in_array($_token, $special_tokens)) {
              $prev .= "$token ";
          } else {
              $names[] = $prev. $token;
              $prev = "";
          }
      }
      
      $num_nombres = count($names);
      $nombres = $apellidos = "";
      switch ($num_nombres) {
          case 0:
              $nombres = '';
              break;
          case 1: 
              $nombres = $names[0];
              break;
          case 2:
              $nombres    = $names[0];
              $apellidos  = $names[1];
              break;
          case 3:
            $nombres = $names[0];
            $apellidos = $names[2];
            break;
        case 4:
            $nombres = $names[0];
            $apellidos = $names[2];
            break;
        default:
            $nombres = $names[0] . ' ' . $names[1];
            unset($names[0]);
            unset($names[1]);
            $apellidos = implode(' ', $names);
            break;
      }
      return $nombres .' ' . $apellidos;
  }

  function llenar_datalist2($Vcons,$Vtex,$Vval,$Vcod,$VOpcSel,$Vid){
    //require_once 'pdo.php';
    echo "<datalist id='$Vid'>";
    $rows=SQL2($Vcons);
    foreach ($rows as $row) {
      $Vt=($row->$Vtex);
      $Vv=($row->$Vval);
      $Vc=($row->$Vcod);
      $Vtem='';
      if($Vres==$VOpcSel){
        $Vtem='selected';
      }
      echo "<option value='$Vv' id='$Vc' label='$Vt'>";
    }
    echo '</datalist>';
  }

  function llenar_datalist($Vcons,$Vtex,$Vval,$Vcod,$VOpcSel,$Vid){
    //require_once 'pdo.php';
    echo "<datalist id='$Vid'>";
    $rows=SQL($Vcons);
    foreach ($rows as $row) {
      $Vt=($row->$Vtex);
      $Vv=($row->$Vval);
      $Vc=($row->$Vcod);
      $Vtem='';
      if($Vres==$VOpcSel){
        $Vtem='selected';
      }
      echo "<option value='$Vv' id='$Vc' label='$Vt'>";
    }
    echo '</datalist>';
  }

  /*esta función su trabajo o función es poder descargar reportes tipo excel don se le pasa un parametro que es el nombre del archivo
   */

  function descagarExcel($nombreArchivo){
    header("Content-Type: application/xls");  
    header("Expires: 0");    
    header("Content-Disposition: attachment; filename=$nombreArchivo");
    header("Pragma: no-cache"); 
  }


  function FormatoMiles($numero, $coma = true) {
    return number_format($numero, ($coma) ? 3 : 0, ',', ".");
  }
  

?>