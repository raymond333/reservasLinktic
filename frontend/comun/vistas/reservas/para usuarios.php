
<div class="p-0 p-md-4 pc-content">
  
  <div class="row">
    <div class="p-0 col-sm-12">
      <div class="p-0 card table-card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
              <h5>CASAS</span></h5>
              <button class="btn btn-principal" data-bs-toggle="modal" data-bs-target="#modalRegistrarCasa" data-tabla="CASA">
                <i class="ti ti-plus"></i>
              </button>
            </div>
        </div>
        <div class="p-0 card-body">
          
           <div class="tab-content">         
              <div class="table-responsive">
                  <table class="data_tabla table table-hover" id="tablaReservas">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Cliente</th>
                          <th>Servicio</th>
                          <th>Fecha</th>
                          <th class="d-none d-md-table-cell">Propietario</th>
                          <th class="text-center"></th>
                        </tr>
                      </thead>
                      <tbody> 
                        
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
      window.addEventListener('load', function() {
        modalRegistrarCasa.addEventListener('show.bs.modal', function (evento) {
          var modal         = modalRegistrarCasa;
           formulario    = modal.querySelector('form');

          formulario.reset();

          var boton         = evento.relatedTarget;
          var accion        = boton.getAttribute('data-accion') ?? 'NUEVO';
          var nombre        = boton.getAttribute('data-nombre') ?? '';
           datos         = JSON.parse(boton.getAttribute('data-datos')) ?? '';

          modificarRegistro = (accion == 'MODIFICAR')
          modal.querySelector('.modal-title').innerHTML   = `${accion} CASA `;
          
          botonGuardarCasa.innerHTML = (modificarRegistro) ? 'GUARDAR CAMBIOS' : 'REGISTRAR'
         
          if(modificarRegistro) {

            let f = formulario;
            f.idCasa.value      = datos.id_casa;
            f.nombre.value      = datos.nombre_casa;
            f.direccion.value   = datos.direccion_casa
            f.propietario.value = datos.nombre_propietario
            

          }
          

        });
      });

        const cargarReservas = async () => {
            const respuesta = await fetch('api/reservas');
            const reservas = await respuesta.json();
            const datos = reservas.datos;

            //const tablaReservas = document.getElementById('tablaReservas').getElementsByTagName('tbody')[0];

            datos.forEach(reserva => {
                const fila = tablaReservas.insertRow();
                fila.innerHTML = `
                    <td>${reserva.id}</td>
                    <td>${reserva.nombre}</td>
                    <td>${reserva.fecha}</td>
                    <td>${reserva.hora}</td>
                `;
            });
            
        };



        // Cargar las reservas cuando la página esté lista
        window.onload = cargarReservas;

        const dataTabla = new simpleDatatables.DataTable('.data_tabla', {
              sortable: false,
              perPage: 5
            });

       

       
    </script>

<?php
  include './comun/modales/casa/registrar_casa.php';
 

?>