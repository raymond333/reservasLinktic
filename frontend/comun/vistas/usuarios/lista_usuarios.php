
<div class="pc-content">
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center justify-content-between">
              <h5>LISTA DE USUARIOS</h5>
              <button class="btn btn-principal" data-bs-toggle="modal" data-bs-target="#modalRegistrarUsuario" data-tabla="USUARIO">
                <i class="ti ti-plus"></i>
              </button>
            </div>
        </div>
        <div class="card-body">
          <div class="row" id="tablaUsuarios">
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
      window.addEventListener('load', function() {

        // Cargar los usuarios cuando la página esté lista
        cargarUsuarios();


        // Controla Modal Crear y Modificar Usuarios
        modalRegistrarUsuario.addEventListener('show.bs.modal', function (evento) {
          var modal         = modalRegistrarUsuario;
          var formulario    = modal.querySelector('form');

          formulario.reset();

          var boton         = evento.relatedTarget;
          var accion        = boton.getAttribute('data-accion') ?? 'NUEVO';
          var nombre        = boton.getAttribute('data-nombre') ?? '';
          var datos         = JSON.parse(boton.getAttribute('data-datos')) ?? '';

          modificarRegistro = (accion == 'MODIFICAR')
          modal.querySelector('.modal-title').innerHTML   = `${accion} USUARIO <b>${nombre}</b>`;
          
          botonGuardarCasa.innerHTML = (modificarRegistro) ? 'GUARDAR CAMBIOS' : 'CREAR USUARIO'
          
          let f = formulario;
          if(modificarRegistro) {
            f.setAttribute('data-metodo', 'put');
            f.idUsuario.value         = datos.id_usuario;
            f.tipo.value              = datos.tipo;
            f.correo.value            = datos.correo
            f.nombre.value            = datos.nombre
            f.contrasena.value        = datos.nombre
          } else {
            f.setAttribute('data-metodo', 'post');
          }
          

        });
      });

      const cargarUsuarios = async () => {
        const respuesta = await fetch('api/usuarios');
        const usuarios  = await respuesta.json();
        const datos     = usuarios.datos; 


        tablaUsuarios.innerHTML = '';

        datos.forEach(usuario => {
            const divUsuario = document.createElement('div');
            divUsuario.className = "col-xl-3 col-lg-4 col-md-6";

            divUsuario.innerHTML = `
                <div class="card profile-back-card">

                    <div class="" style="height: 6rem; background: #fd914f;"></div>
                    <a class="text-white xopacity-50 xarrow-none" title="Modificar Usuario" href="#"   
                                                          data-bs-toggle="modal" 
                                                          data-bs-target="#modalRegistrarUsuario" 
                                                          data-accion="MODIFICAR" 
                                                          data-nombre="${usuario.correo}"
                                                          data-datos='${JSON.stringify(usuario)}' aria-haspopup="true" aria-expanded="false" style="position: absolute;top: 12px;right: 12px;">
                      <i class="ti ti-edit f-30"></i>
                    </a>
                   <div class="card-body p-3">
                        <img class="img-radius img-fluid img-userprofile mb-2" src="./assets/images/user/usuario-100.png" alt="">
                        <h4 class="mb-2 text-truncate">${usuario.tipo}</h4>
                        <h3 class="mb-0 text-orange-400">${usuario.nombre}</h3>
                        <h6 class="text-truncate text-muted mb-0">
                            <i class="ti ti-calendar"></i> ${usuario.correo}
                        </h6>
                        <div class="row">
                            
                            <div class="col">
                                <form class="d-grid mt-2 for_api" data-metodo="delete" data-api="reservas/${usuario.id_usuario}">
                                    <button type="submit" class="btn btn-outline-danger" 
                                                                                  title="Eliminar Usuario" id="btnEliminar" 
                                                                                  data-contenedor=".profile-back-card" 
                                                                                  onclick="confirmarEliminarRegistros(event, '¿Está seguro de eliminar el usuario ${usuario.correo}?')">
                                        <i class="ti ti-message"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            tablaUsuarios.appendChild(divUsuario); // Agregar la nueva tarjeta al contenedor
        });
    }; 
</script>

<?php
  include './comun/modales/usuario/registrar_usuario.php';
 

?>