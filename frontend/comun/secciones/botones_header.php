        <div class="ms-auto">
          <ul class="list-unstyled">
            
            <li class="dropdown pc-h-item header-user-profile">
              <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="./assets/images/user/usuario-100.png" alt="user-image" class="user-avtar">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
              </a>
              <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                <div class="dropdown-header">
                  <h4>Hola, <span class="small text-muted" id="sesionNombreUsuario"> <?php echo $_SESSION['nombreUsuario'] ?></span>
                  </h4>
                  <p class="text-muted"><?php echo $_SESSION['tipoUsuario'] ?></p>
                  
                  <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
                    <form class="for_api" data-api="cerrarSesion" data-metodo="post" onclick="document.location='./login.php'">
                      <button class="dropdown-item" type="submit">
                        <i class="ti ti-logout"></i>
                        <span>Cerrar Sesión</span>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>