   <header class="pc-header">
      <div class="m-header p-0">
        <a href="reservas.php" class="b-brand m-3" style="width: 165px">
          <img src="./assets/images/logo/logo.svg" alt class="w-100 logo logo-lg">
        </a>
        <?php if(!$tipoUsuario === 'cliente') { ?>}
        <div class="pc-h-item">
          <a href="#" class="pc-head-link head-link-secondary m-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </div>
      <?php } ?>
      </div>
      <div class="header-wrapper">
         <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
               <li class="pc-h-item header-mobile-collapse">
                  <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                     <i class="ti ti-menu-2"></i>
                  </a>
               </li>

            </ul>
         </div>
        

         <!-- MEGA MENÚ -->
         <?php include 'comun/secciones/botones_header.php' ?>


      </div>
    </header>

