<?php




  function EstatusConsulta($VPcon){
    if($VPcon>0){ 
          if(CAN_REG($VPcon)==0){
            return 0;
          }else{
            return 1;
          }
        }else{
          return -1;
        }
  }  


  function checkSeleccionarTodos($id = 'seleccionarTodos') {
    echo "
    <th width='10' class='text-center'>
      <input class='form-check-input' id='seleccionarTodos' type='checkbox'>
    </th>";
  }
  function checkSeleccionar($name, $value, $dataCodigo) {
    echo "
      <td width='10' class='text-center'>
        <input class='form-check-input' name='$name' type='checkbox' value='$value' data-campo='$dataCodigo'>
      </td>";
  }


  
  /**
  * Funcion que sirve para insertar en la Bitacora las acciones de los usuarios
  * @author Raymond Medina
  * 
  * @param numeric $usuario Id del usuario logueado ($idUsuario)
  * @param string $accion Acción que realiza el usuario
  * @param string $datos  
  * @param string $observacion (opcional)
  * @return No retorna valor 
  */ 
  function insertarBitacora($usuario, $accion, $datos, $observacion = '') {
      $sql = "INSERT INTO siscomar2021.bitacora(id_us, fec_bit, hora_bit, obs_bit, datos, obs) 
      VALUES('$usuario', CURRENT_DATE,CURRENT_TIME, '$accion', '$datos', '$observacion')";

      $consulta = SQL($sql);

      ### Si falla el registro de la bitacora, se inserta un registro con el fallo
      if (!$consulta > 0) {
          insertarBitacora ($usuario, "FALLO EN REGITRAR BITACORA", $accion);
      }


  } 
  

  function esInicioSesion() {
    $Vtem = $_REQUEST['a'] ?? '';
    return ($Vtem == 'login');
  }

  function esRegistroEmpresa() {
    $Vtem = $_REQUEST['a'] ?? '';
    return ($Vtem == 'registrar_empresa');
  }

  function opcionConsultarEmpresa($carpeta, $titulo = 'Consultar Empresa') {
    echo "
      <li class='nav-item'>
        <a class='nav-link' href='#' 
          data-coreui-toggle='modal' 
          data-coreui-target='#modalSeleccionarEmpresa'  
          data-opcion='consultar-empresa' 
          data-carpeta='$carpeta' >
          <svg class='nav-icon'>
            <use xlink:href='vendors/@coreui/icons/svg/free.svg#cil-address-book'></use>
          </svg> $titulo
        </a>
      </li>";
  }

  function CODIGO_CATEGORIA2($categoria){
    $CATEGORIA = SQL("SELECT id_categoria_viejo FROM siscomar2021.reg_auxiliar
    WHERE id_reg_aux = '$categoria'");


    return $CATEGORIA [0]  -> id_categoria_viejo;


  }
?>