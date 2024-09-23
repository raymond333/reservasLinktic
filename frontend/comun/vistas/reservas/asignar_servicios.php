<?php 
  ob_start(); // Iniciar el almacenamiento en búfer de salida

  echo '<option value="">-- Seleccionar trabajador --</option>';
    llenarSelect("SELECT id_trabajador, nombre_trabajador FROM trabajadores", 'nombre_trabajador', 'id_trabajador');
  echo '</select>';

  $selectTrabajadores = ob_get_clean(); // Almacenar la salida HTML generada en una variable

  

?> 
<div class="pc-content" id="">
 
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>ASIGNAR SERVICIOS A CASA</h5>
        </div>
          <div class="card-body">
            
          
          <?php
          // Array con el nombre y el ID de cada servicio
          $services = [
              ['name' => 'Remodeling', 'id' => 'remodeling', 'id' => '1'],
              ['name' => 'Paiting', 'id' => 'paiting', 'id' => '2'],
              ['name' => 'Texturing', 'id' => 'texturing', 'id' => '3'],
              ['name' => 'Cleaning', 'id' => 'cleaning', 'id' => '4'],
              ['name' => 'Drywall', 'id' => 'drywall', 'id' => '5'],
              ['name' => 'PRECARPET', 'id' => 'precarpet', 'id' => '6'],
              ['name' => 'QA', 'id' => 'qa', 'id' => '7'],
              ['name' => 'CIERRE', 'id' => 'cierre', 'id' => '8'],
              ['name' => 'PARCHE', 'id' => 'parche', 'id' => '9'],
          ];

          ?>

          <form class="for_api" data-api="registrar_asignacion">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="casa">Seleccionar casa:</label>
                  <select class="form-control" name="casa" id="casa" required>
                      <option value="">-- Seleccionar casa --</option>
                      <?php llenarSelect("SELECT id_casa, nombre_casa FROM casas", 'nombre_casa', 'id_casa') ?>

                  </select>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="fecha">Seleccionar Fecha:</label>
                  <input type="datetime-local" name="fecha" class="form-control" required>
                </div>
              </div>
            </div>
              

              <div class="form-group">
                  <label>Seleccionar servicios:</label>
                  <table class="table">
                      <thead>
                          <tr>
                              <th width="10">Selec.</th>
                              <th>Servicio</th>
                              <th>Asignar trabajador</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($services as $service) { 
                            $idTrabajador = "trabajador" . $service['id'];?>
                              <tr>
                                  <td><input type="checkbox" name="servicios[]" value="<?php echo $service['id']; ?>" style="width: 40px;height: 40px;"></td>
                                  <td><?php echo $service['name']; ?></td>
                                  <td>
                                    <select class="form-control" name="<?php echo $idTrabajador; ?>" id="<?php echo $idTrabajador; ?>">
                                      <?php echo $selectTrabajadores; ?>
                                    </select>
                                  </td>
                              </tr>
                          <?php } ?>
                      </tbody>
                  </table>
              </div>

              <div class="mensaje"></div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-principal">Guardar</button>
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

    
    
<?php
  include './comun/modales/expediente/registrar_expediente.php';
  //include './comun/modales/transporte/transporte_bl.php';
  include './comun/modales/guia/guias.php';
?>