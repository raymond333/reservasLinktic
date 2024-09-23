<div class="modal fade" id="modalRegistrarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content for_api" data-api="usuarios" data-metodo="post">
      <input type="hidden" id="idUsuario" name="idUsuario">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          
          <div class="col-md-12 mb-3">
            <label for="">Tipo de Usuario</label>
            <div class="form-floating">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo" id="tipoAdm" value="administrador"> 
                  <label class="form-check-label" for="tipoAdm">Administrador</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tipo" id="tipoCliente" value="cliente"> 
                  <label class="form-check-label" for="tipoCliente">Cliente</label>
                </div>
                
            </div>
          </div>

          <div class="col-md-12 mb-3">
            <div class="form-floating">
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <label for="nombre">Nombre</label>
            </div>
          </div>

          <div class="col-md-12 mb-3">
            <div class="form-floating">
                <input type="email" class="form-control" id="correo" name="correo" required>
                <label for="correo">Correo</label>
            </div>
          </div>

          <div class="col-md-12 mb-3">
            <div class="form-floating">
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                <label for="contrasena">Contraseña</label>
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
