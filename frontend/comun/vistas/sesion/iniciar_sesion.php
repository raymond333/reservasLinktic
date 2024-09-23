<div class="auth-main">
      <div class="auth-wrapper v3">
        <form class="auth-form for_api" data-api="login" data-metodo="post" data-texto-boton="Iniciando" data-redireccion="reservas.php">
          <div class="card my-5">
            <div class="card-body">
              <div class="d-flex justify-content-center">
                <img src="./assets/images/logo/logo.svg" alt="logo" width="70%">
              </div>
              <div class="row">
                <div class="d-flex justify-content-center">
                  <div class="auth-header">
                    <h2 class="text-secondary mt-5">
                      <b>Hola, bienvenid@</b>
                    </h2>
                    <p class="f-16 mt-2">Introduduce tus credenciales para iniciar sesión</p>
                  </div>
                </div>
              </div>
              
              <h5 class="my-4 d-flex justify-content-center">Inicia con tu usuario y contraseña</h5>
              <div class="form-floating mb-3">
                <input type="email" required class="form-control" id="correo" name="correo" placeholder="Correo">
                <label for="correo">Usuario</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" required class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                <label for="contrasena">Contraseña</label>
              </div>
              
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary">Entrar</button>
              </div>
              <hr>
              <div class="mensaje"></div>
            </div>
          </div>
        </form>
      </div>
    </div>