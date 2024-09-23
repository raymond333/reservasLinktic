
<div class="pc-content">
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center justify-content-between">
              <h5>LISTA DE RESERVAS</h5>
              <button class="btn btn-principal" data-bs-toggle="modal" data-bs-target="#modalAsignarReserva" data-tabla="RESERVA">
                <i class="ti ti-plus"></i>
              </button>
            </div>
        </div>
        <div class="card-body">
          <div class="row" id="tablaReservas">
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
      window.addEventListener('load', function() {

        // Cargar las reservas cuando la página esté lista
        cargarReservas();


        // Controla Modal ParASignar y Modificar Reservas
        modalAsignarReserva.addEventListener('show.bs.modal', function (evento) {
          var modal         = modalAsignarReserva;
          var formulario    = modal.querySelector('form');

          formulario.reset();

          var boton         = evento.relatedTarget;
          var accion        = boton.getAttribute('data-accion') ?? 'NUEVA';
          var nombre        = boton.getAttribute('data-nombre') ?? '';
          var datos         = JSON.parse(boton.getAttribute('data-datos')) ?? '';

          modificarRegistro = (accion == 'MODIFICAR')
          modal.querySelector('.modal-title').innerHTML   = `${accion} RESERVA `;
          
          botonGuardarCasa.innerHTML = (modificarRegistro) ? 'GUARDAR CAMBIOS' : 'ASIGNAR RESERVA'
         
          let f = formulario;
          if(modificarRegistro) {
            f.setAttribute('data-metodo', 'put');
            f.idReserva.value         = datos.id_reserva;
            f.fecha.value             = datos.fecha_inicio
            f.idServicio.value        = datos.id_servicio
            f.idDetalleReserva.value  = datos.id_detalle_reserva
            if(f.idUsuario) {
              f.idUsuario.value       = datos.id_usuario;
            }
          } else {
            f.setAttribute('data-metodo', 'post');
          }
          

        });
      });

      const cargarReservas = async () => {
        var fecha = new URLSearchParams(window.location.search).get('fecha') ?? '';
        fecha = (fecha) ? `?fecha=${fecha}` : ''; 
        const respuesta = await fetch(`api/reservas${fecha}`);
        const reservas = await respuesta.json();
        const datos = reservas.datos; 


        tablaReservas.innerHTML = '';

        datos.forEach(reserva => {
            const divReserva = document.createElement('div');
            divReserva.className = "col-xl-3 col-lg-4 col-md-6";

            divReserva.innerHTML = `
                <div class="card profile-back-card">

                    <div class="" style="height: 6rem; background: #fd914f;"></div>
                    <a class="text-white xopacity-50 xarrow-none" title="Modificar Reserva" href="#"   
                                                          data-bs-toggle="modal" 
                                                          data-bs-target="#modalAsignarReserva" 
                                                          data-accion="MODIFICAR"
                                                          data-datos='${JSON.stringify(reserva)}' aria-haspopup="true" aria-expanded="false" style="position: absolute;top: 12px;right: 12px;">
                      <i class="ti ti-edit f-30"></i>
                    </a>
                   <div class="card-body p-3">
                        <img class="img-radius img-fluid img-userprofile mb-2" src="./assets/images/servicio.png" alt="">
                        <h4 class="mb-2 text-truncate">${reserva.cliente}</h4>
                        <h3 class="mb-0 text-orange-400">${reserva.servicio}</h3>
                        <h6 class="text-truncate text-muted mb-0">
                            <i class="ti ti-calendar"></i> ${reserva.fecha}
                        </h6>
                        <div class="row">
                            <div class="col">
                                <form class="d-grid mt-2 for_api" data-metodo="patch" data-api="reservas/${reserva.id_reserva}">
                                    <input type="hidden" name="estado" value="ejecutada">
                                    <button type="submit" class="btn btn-outline-principal" 
                                                                                  title="Ejecutar Reserva" id="btnEliminar" 
                                                                                  data-contenedor=".profile-back-card" 
                                                                                  onclick="confirmarEliminarRegistros(event, '¿Está seguro de ejecutar la reserva asignada al cliente ${reserva.cliente}?')">
                                        <i class="ti ti-check"></i> Ejecutar
                                    </button>
                                </form>
                            </div>
                            <div class="col">
                                <form class="d-grid mt-2 for_api" data-metodo="patch" data-api="reservas/${reserva.id_reserva}">
                                    <input type="hidden" name="estado" value="cancelada">
                                    <button type="submit" class="btn btn-outline-danger" 
                                                                                  title="Cancelar Reserva" id="btnEliminar" 
                                                                                  data-contenedor=".profile-back-card" 
                                                                                  onclick="confirmarEliminarRegistros(event, '¿Está seguro de cancelar la reserva asignada al cliente ${reserva.cliente}?')">
                                        <i class="ti ti-message"></i> Cancelar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            tablaReservas.appendChild(divReserva); // Agregar la nueva tarjeta al contenedor
        });
    }; 
</script>

<?php
  include './comun/modales/reserva/asignar_reserva.php';
 

?>