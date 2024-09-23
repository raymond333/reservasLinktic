<div class="modal fade" id="modalRegistrarServicio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content for_api" data-api="servicios" data-metodo="post">
      <input type="hidden" id="idServicio" name="idServicio">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="form-floating">
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                <label for="descripcion">Descripción</label>
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
