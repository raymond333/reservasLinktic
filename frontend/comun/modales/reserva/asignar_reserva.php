<div class="modal fade" id="modalAsignarReserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content for_api" data-api="reservas" data-metodo="put">
      <input type="hidden" id="idReserva" name="idReserva">
      <input type="hidden" id="idDetalleReserva" name="idDetalleReserva">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Asignar Reserva</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        
        <?php if(!$tipoUsuario === 'cliente') { ?>}
        <div class="col-md-12 mb-3">
          <div class="form-floating">
              <select class="form-select" id="idUsuario" name="idUsuario" required data-api="clientes" data-metodo="get">
                  <option value="" disabled selected>Selecciona el usuario</option>
                  
              </select>
              <label for="idUsuario">Usuario</label>
          </div>
        </div>
        <?php } ?>

        <div class="col-md-12 mb-3">
          <div class="form-floating">
              <select class="form-select" id="idServicio" name="idServicio" required data-api="servicios" data-metodo="get">
                  <option value="" disabled selected>Selecciona el servicio</option>
                  
              </select>
              <label for="idServicio">Servicio</label>
          </div>
        </div>

        <div class="col-md-12 mb-3">
          <div class="form-floating">
              <input type="date" class="form-control" id="fecha" name="fecha" required>
              <label for="fecha">Fecha</label>
          </div>
        </div>

        

          
        </div>
      </div>
      <div class="mensaje"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-principal" id="botonGuardarCasa">Guardar</button>
      </div>
    </form>
  </div>
</div>
