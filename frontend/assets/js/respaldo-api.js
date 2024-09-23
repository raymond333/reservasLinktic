document.querySelectorAll('.for_api').forEach(formularios => formularios.addEventListener('submit', e => {
        
  e.preventDefault();

  


  FORMULARIO = e.target;  /* EL FORMULARIO QUE SE ENVIÓ       */
  BOTON = e.submitter;    /* EL BOTÓN QUE ENVIÓ EL FORMULARIO */

  FORMULARIO.querySelector('.mensaje').innerHTML = ''

  /* DESACTIVAR Y ANIMAR EL BOTÓN */
  textoBoton = BOTON.innerHTML;
  nuevoTexto = FORMULARIO.dataset.textoBoton ?? textoBoton;
  BOTON.innerHTML = `<span class="spinner-border spinner-border-sm" role="status"></span> ${nuevoTexto}`;
  BOTON.disabled = true;

 
  
  datos = new FormData(FORMULARIO);
  //datos = new URLSearchParams(datos);
  accion = FORMULARIO.dataset.api;
  funcion = FORMULARIO.dataset.funcion;

  datos.append('a', accion);


  fetch('php/api.php', {
    method: 'POST',
    contentType: false,
    body: (datos),
  })
  .then((respuesta) => respuesta.json())
  .then((respuesta) => {

    /* VOLVER EL BOTÓN A SU ESTADO INICIAL */
    BOTON.innerHTML = textoBoton;
    BOTON.disabled = false;

    console.log('Success:', respuesta);
    Respuesta = respuesta;
    Mensaje=JSON.parse(Respuesta.men);
    Estatus = Respuesta.est;
    OtrosDatos = JSON.parse(Respuesta.otrosDatos);

    //Vmod=$(vvv).parents('.modal')[0];//PARA SABER SI ESTÃ€ DENTRODE UN MODAL
    if(Estatus === 2) {

      if(typeof(funcion) !== 'undefined'){
        self[funcion](FORMULARIO, respuesta);
      }

      FORMULARIO.querySelector('.mensaje').innerHTML = MostrarMensaje(Mensaje, 1);
      FORMULARIO.reset();

      redireccion = OtrosDatos.redireccion;
      if (redireccion !== undefined) {
        location.href = redireccion;
      }
    } else {
      FORMULARIO.querySelector('.mensaje').innerHTML = MostrarMensaje(Mensaje,(Estatus === 2) ? '' : 3);
    }

  })
  .catch((error) => {
    error = error;
    error2 = "Ocurrió un error. Consulte al adiministrador del sistema"
    FORMULARIO.querySelector('.mensaje').innerHTML = MostrarMensaje(error2, 4);
    /* VOLVER EL BOTÓN A SU ESTADO INICIAL */
    BOTON.innerHTML = textoBoton;
    BOTON.disabled = false;
  });
}));