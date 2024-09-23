<?php 
  $idHistorico = $_POST['idHistorico'];
  $nombreBuque = $_POST['nombreBuque'];

  $sql = "SELECT nombre_empresa AS nombre_consignatario, cantidad_producto, nombre_producto, id_expediente 
              FROM expedientes e 
        INNER JOIN empresas ON e.id_consignatario = empresas.id_empresa 
        INNER JOIN productos USING(id_producto)
              WHERE id_historico_buque = '$idHistorico'";//echo $sql;exit();
  $EXPEDIENTES = SQL($sql);
  

?> 
<div class="pc-content" id="">
 
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-tabs profile-tabs border-bottom mb-3 d-print-none" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">
                <i class="material-icons-two-tone me-2"></i>ASIGNAR SERVICIOS A CASA </a>
            </li>
          </ul>
          <form>
            <div class="form-group">
              <label for="casa">Seleccionar casa:</label>
              <select class="form-control" id="casa">
                <option value="">-- Seleccionar casa --</option>
                <option value="casa1">Casa 1</option>
                <option value="casa2">Casa 2</option>
                <option value="casa3">Casa 3</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="nuevaCasa">Registrar nueva casa:</label>
              <input type="text" class="form-control" id="nuevaCasa" placeholder="Nombre de la nueva casa">
            </div>
            
            <div class="form-group">
              <label>Seleccionar servicios:</label><table class="table">
                <thead>
                  <tr>
                    <th>Seleccionar</th>
                    <th>Servicio</th>
                    <th>Asignar trabajador</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" value="remodeling"></td>
                    <td>Remodeling</td>
                    <td>
                      <select class="form-control" id="trabajador1">
                        <option value="">-- Seleccionar trabajador --</option>
                        <option value="trabajador1">Trabajador 1</option>
                        <option value="trabajador2">Trabajador 2</option>
                        <option value="trabajador3">Trabajador 3</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" value="paiting"></td>
                    <td>Paiting</td>
                    <td>
                      <select class="form-control" id="trabajador2">
                        <option value="">-- Seleccionar trabajador --</option>
                        <option value="trabajador1">Trabajador 1</option>
                        <option value="trabajador2">Trabajador 2</option>
                        <option value="trabajador3">Trabajador 3</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" value="texturing"></td>
                    <td>Texturing</td>
                    <td>
                      <select class="form-control" id="trabajador3">
                        <option value="">-- Seleccionar trabajador --</option>
                        <option value="trabajador1">Trabajador 1</option>
                        <option value="trabajador2">Trabajador 2</option>
                        <option value="trabajador3">Trabajador 3</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" value="cleaning"></td>
                    <td>Cleaning</td>
                    <td>
                      <select class="form-control" id="trabajador4">
                        <option value="">-- Seleccionar trabajador --</option>
                        <option value="trabajador1">Trabajador 1</option>
                        <option value="trabajador2">Trabajador 2</option>
                        <option value="trabajador3">Trabajador 3</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" value="drywall"></td>
                    <td>Drywall</td>
                    <td>
                      <select class="form-control" id="trabajador5">
                        <option value="">-- Seleccionar trabajador --</option>
                        <option value="trabajador1">Trabajador 1</option>
                        <option value="trabajador2">Trabajador 2</option>
                        <option value="trabajador3">Trabajador 3</option>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
    include './comun/modales/expediente/registrar_expediente.php';
    include './comun/modales/transporte/asignar_transporte.php';
    include './comun/modales/transporte/transporte_bl.php';
    include './comun/modales/guia/asignar_guia.php';
    include './comun/modales/guia/guias.php';
  ?>
</div>



    <script>
      window.addEventListener('load', function() {


        let modales = contenedorExpedientes.querySelectorAll('.modal');

        modales.forEach(modal => {
          modal.addEventListener('show.bs.modal', evento => {
          //modalAsignarTransporte.addEventListener('show.bs.modal', function (evento) {
            //var modal = evento.delegateTarget;

            var boton           = evento.relatedTarget;
            var expediente      = boton.getAttribute('data-expediente');
            var tabla           = boton.getAttribute('data-tabla');
           
            var titulo          = modal.querySelector('.modal-title');
            var idExpediente    = modal.querySelector('input#idExpediente');

            titulo.innerHTML    =  `ASIGNAR ${tabla} A EXPEDIENTE <span class="text-success"> #${expediente}</span>`;
            if (idExpediente) {
              idExpediente.value  = expediente;
            }

            funcion = boton.getAttribute('data-funcion');

            // Verifica si el atributo data-funcion existe en el botón
            if (funcion) {
              // Ejecuta la función correspondiente
              window[funcion](expediente);
            }

          });
        });

        //var modal = modalRegistrarVehiculo;
        modalRegistrarVehiculo.addEventListener('show.bs.modal', event => {
            const boton                   = event.relatedTarget
            var formulario                = modalRegistrarVehiculo.querySelector('form');
            formulario.tipoVehiculo.value = boton.getAttribute('data-tipo');
            
            
            
        });


       

      mostrarTransportesExpedientes= (FORMULARIO, respuesta) => {
        ff = FORMULARIO;
        rr = respuesta;

        let TRANSPORTES = JSON.parse(respuesta.men);

        //const template = document.getElementById('plantillaTransportesExpediente');

        if(modalTransportesExpediente.checkVisibility()) {

          /* ### SE MUESTRA LISTADO DE TRANSPORTES EN MODAL ### */
          let html = TRANSPORTES.map(TRANSPORTE => {
            return `
              <tr>
                <td>
                  <h5 class="mb-0">${TRANSPORTE.id_transporte_expediente}</h5>
                </td>
                <td>
                  <button type="button" class="avtar btn btn-icon btn-light-success d-inline-flex" onclick="mostrarPagina(${TRANSPORTE.id_transporte_expediente})">${TRANSPORTE.id_transporte_expediente}</button>
                </td>
                <td>
                  <button type="button" class="avtar btn btn-icon btn-light d-inline-flex" onclick="mostrarPagina(${TRANSPORTE.id_transporte_expediente})">${TRANSPORTE.id_transporte_expediente}</button>
                </td>
                <td>
                  <button type="button" class="avtar btn btn-icon btn-warning d-inline-flex" onclick="mostrarPagina(${TRANSPORTE.id_transporte_expediente})">${TRANSPORTE.id_transporte_expediente}</button>
                </td>
                <td>
                  <button type="button" class="avtar btn btn-icon btn-light-info d-inline-flex" onclick="mostrarPagina(${TRANSPORTE.id_transporte_expediente})">${TRANSPORTE.id_transporte_expediente}</button>
                </td>
                <td>
                  <button type="button" class="avtar btn btn-icon btn-light-danger d-inline-flex" onclick="mostrarPagina(${TRANSPORTE.id_transporte_expediente})">${TRANSPORTE.id_transporte_expediente}</button>
                </td>
                <td>
                  <h5 class="mb-0 text-danger">${TRANSPORTE.id_transporte_expediente}</h5>
                </td>
                <td>
                  <h5 class="mb-0 text-danger">${TRANSPORTE.id_transporte_expediente}</h5>
                </td>
              </tr>
            `;
          }).join('');

          modalTransportesExpediente.querySelector('table tbody').innerHTML = html;
        } else {

          let html = TRANSPORTES.map(TRANSPORTE => {
            return `<option value="${TRANSPORTE.id_transporte_expediente}"> ${TRANSPORTE.nombre_empresa} | ${TRANSPORTE.rif_empresa}</option>`;
          }).join('');

          html = '<option>Seleccione Transporte</option>' + html;
          modalAsignarGuia.querySelector('#idTransporteExpediente').innerHTML = html;


        }
      }

      cargarSelects();
    });
      
    </script>

    
  
    
    <div class="">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrarExpediente">Nuevo Expediente</button>
      
      <a type="button" class="btn btn-danger" href="historico-buques.php?status=operaciones">Atras</a>
    </div>
    
    
<?php
  include './comun/modales/expediente/registrar_expediente.php';
  //include './comun/modales/transporte/transporte_bl.php';
  include './comun/modales/guia/guias.php';
?>