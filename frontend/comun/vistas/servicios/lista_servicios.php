
<div class="pc-content">
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center justify-content-between">
              <h5>LISTA DE SERVICIOS</h5>
              <button class="btn btn-principal" data-bs-toggle="modal" data-bs-target="#modalRegistrarServicio" data-tabla="SERVICIO">
                <i class="ti ti-plus"></i>
              </button>
            </div>
        </div>
        <div class="card-body">
          <div class="row" id="tablaServicios">
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
      window.addEventListener('load', function() {

        // Cargar los servicios cuando la página esté lista
        cargarServicios();


        // Controla Modal Crear y Modificar Servicios
        modalRegistrarServicio.addEventListener('show.bs.modal', function (evento) {
          var modal         = modalRegistrarServicio;
          var formulario    = modal.querySelector('form');

          formulario.reset();

          var boton         = evento.relatedTarget;
          var accion        = boton.getAttribute('data-accion') ?? 'NUEVO';
          var nombre        = boton.getAttribute('data-nombre') ?? '';
          var datos         = JSON.parse(boton.getAttribute('data-datos')) ?? '';

          modificarRegistro = (accion == 'MODIFICAR')
          modal.querySelector('.modal-title').innerHTML   = `${accion} SERVICIO <b>${nombre}</b>`;
          
          botonGuardarCasa.innerHTML = (modificarRegistro) ? 'GUARDAR CAMBIOS' : 'CREAR SERVICIO'
          
          let f = formulario;
          if(modificarRegistro) {
            f.setAttribute('data-metodo', 'put');
            f.idServicio.value        = datos.idServicio;
            f.descripcion.value       = datos.descripcion;
          } else {
            f.setAttribute('data-metodo', 'post');
          }
          

        });
      });

      const cargarServicios = async () => {
        const respuesta = await fetch('api/servicios');
        const servicios = await respuesta.json();
        const datos     = servicios.datos; 


        tablaServicios.innerHTML = '';

        datos.forEach(servicio => {
            const divServicio = document.createElement('div');
            divServicio.className = "col-xl-3 col-lg-4 col-md-6";

            divServicio.innerHTML = `
                <div class="card profile-back-card">

                    <div class="" style="height: 6rem; background: #fd914f;"></div>
                    <a class="text-white xopacity-50 xarrow-none" title="Modificar Servicio" href="#"   
                                                          data-bs-toggle="modal" 
                                                          data-bs-target="#modalRegistrarServicio" 
                                                          data-accion="MODIFICAR" 
                                                          data-nombre="${servicio.descripcion}"
                                                          data-datos='${JSON.stringify(servicio)}' aria-haspopup="true" aria-expanded="false" style="position: absolute;top: 12px;right: 12px;">
                      <i class="ti ti-edit f-30"></i>
                    </a>
                   <div class="card-body p-3">
                        <img class="img-radius img-fluid img-userprofile mb-2" src="./assets/images/servicio.png" alt="">
                        <h3 class="mb-0 text-orange-400">${servicio.descripcion}</h3>
                        
                        <div class="row">
                            
                            <div class="col">
                                <form class="d-grid mt-2 for_api" data-metodo="delete" data-api="reservas/${servicio.id_servicio}">
                                    <button type="submit" class="btn btn-outline-danger" 
                                                                                  title="Eliminar Servicio" id="btnEliminar" 
                                                                                  data-contenedor=".profile-back-card" 
                                                                                  onclick="confirmarEliminarRegistros(event, '¿Está seguro de eliminar el servicio ${servicio.descripcion}?')">
                                        <i class="ti ti-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            tablaServicios.appendChild(divServicio); // Agregar la nueva tarjeta al contenedor
        });
    }; 
</script>

<?php
  include './comun/modales/servicio/registrar_servicio.php';
 

?>