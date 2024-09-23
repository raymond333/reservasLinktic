    <nav class="pc-sidebar <?php echo ($tipoUsuario === 'cliente') ? 'pc-sidebar-hide' : '' ?>">
      <div class="navbar-wrapper">
        <div class="m-header p-1">
          <a href="panel.php" class="b-brand m-4">
            <img src="./assets/images/logo/logo.svg" alt class="logo logo-lg w-100">
          </a>
        </div>
        <?php if($tipoUsuario === 'administrador') { ?>}
        <div class="navbar-content">
          <ul class="pc-navbar">
            <li class="pc-item pc-caption">
              <label>Menú</label>
              <i class="ti ti-chart-arcs"></i>
            </li>
            
            <li class="pc-item">
              <a href="usuarios.php" class="pc-link">
                <span class="pc-micon">
                  <i class="ti ti-users"></i>
                </span>
                <span class="pc-mtext">Usuarios</span>
              </a>
            </li>

            <li class="pc-item">
              <a href="servicios.php" class="pc-link">
                <span class="pc-micon">
                  <i class="ti ti-building-warehouse"></i>
                </span>
                <span class="pc-mtext">Servicios</span>
              </a>
            </li>
            

            <li class="pc-item pc-caption">
              <label>Reservas Asignadas</label>
              <i class="ti ti-chart-arcs"></i>
            </li> 
            <li class="pc-item">
              <a href="reservas.php?fecha=hoy" class="pc-link">
                <span class="pc-micon">
                  <i class="ti ti-clipboard-list"></i>
                </span>
                <span class="pc-mtext">Hoy</span>
              </a>
            </li>

            <li class="pc-item">
              <a href="reservas.php" class="pc-link">
                <span class="pc-micon">
                  <i class="ti ti-calendar-event"></i>
                </span>
                <span class="pc-mtext">Pendientes</span>
              </a>
            </li>
           
          </ul>
        
          
        </div>
        <?php } ?>
      </div>
    </nav>
  