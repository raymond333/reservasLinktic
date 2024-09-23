document.addEventListener('submit', function(e) {
  // Verifica si el formulario que disparó el evento tiene la clase .for_api
  if (e.target.matches('.for_api')) {
      e.preventDefault();

      const FORMULARIO = e.target;  // EL FORMULARIO QUE SE ENVIÓ
      const BOTON = e.submitter;     // EL BOTÓN QUE ENVIÓ EL FORMULARIO

      let elementoMensaje = FORMULARIO.querySelector('.mensaje');
      if (elementoMensaje) {
          elementoMensaje.innerHTML = '';
      }

      // DESACTIVAR Y ANIMAR EL BOTÓN
      const textoBoton = BOTON.innerHTML;
      const nuevoTexto = FORMULARIO.dataset.textoBoton ?? textoBoton;
      BOTON.innerHTML = `<span class="spinner-border spinner-border-sm" role="status"></span> ${nuevoTexto}`;
      BOTON.disabled = true;

      // Crear un objeto FormData
      const formData = new FormData(FORMULARIO);
      const metodo = FORMULARIO.dataset.metodo; // Obtener el método desde el formulario
      const urlApi = FORMULARIO.dataset.api; // Obtener la URL de la API desde el formulario

      // Convertir FormData a un objeto JSON usando Object.fromEntries
      const datos = Object.fromEntries(formData.entries());

      // Realizar la petición a la API
      fetch('api/' + urlApi, {
          method: metodo, // Usar el método especificado (POST, GET, etc.)
          headers: {
              'Content-Type': 'application/json' // Establecer el tipo de contenido a JSON
          },
          body: JSON.stringify(datos), // Convertir el objeto a JSON
      })
      .then((respuesta) => {
          // Verificar el código de estado de la respuesta
          if (!respuesta.ok) {
              return respuesta.json().then(errorData => {
                  throw new Error(errorData.mensaje || "Error desconocido");
              });
          }
          return respuesta.json();
      })
      .then((respuesta) => {
          // VOLVER EL BOTÓN A SU ESTADO INICIAL
          BOTON.innerHTML = textoBoton;
          BOTON.disabled = false;

          console.log('Success:', respuesta);
          const estatus = respuesta.estatus;

          if (estatus === "ok") {

            
            // Manejar la respuesta exitosa
            const mensaje = respuesta.mensaje; // Obtener el mensaje de la respuesta
            const datos   = respuesta.datos ?? ''; // Obtener los datos de la respuesta
            
            if (elementoMensaje) {
                elementoMensaje.innerHTML = MostrarMensaje(mensaje, 1); // Mostrar el mensaje en el elemento correspondiente
            }

            // Verificar si se ejecutó un inició de sesión
            if(urlApi == 'login') {
              guardarLocalStorage('sesion', datos);
            }
            
            // Verificar si hay un data-redireccion en el formulario
            const redireccionUrl = FORMULARIO.dataset.redireccion; // Obtener la URL de redirección si existe
            if (redireccionUrl) {
                // Redirigir después de 2 segundos
                setTimeout(() => {
                    window.location.href = redireccionUrl; // Redirigir a la URL especificada
                }, 2000); // 2000 milisegundos = 2 segundos
            }
            FORMULARIO.reset();
          } else {
              // Manejar el caso de error
              if (elementoMensaje) {
                  elementoMensaje.innerHTML = MostrarMensaje(respuesta.mensaje, 3);
              }
          }
      })
      .catch((error) => {
          const error2 = error.message || "Ocurrió un error. Consulte al administrador del sistema";
          if (elementoMensaje) {
              elementoMensaje.innerHTML = MostrarMensaje(error2, 4);
          }
          // VOLVER EL BOTÓN A SU ESTADO INICIAL
          BOTON.innerHTML = textoBoton;
          BOTON.disabled = false;
      });
  }
});





async function cargarSelects() {
  try {
    const selectElements = document.querySelectorAll('select[data-api]');

    selectElements.forEach(select => {
      const url = select.getAttribute('data-api');
      const metodo = select.getAttribute('data-metodo');
      const primeraOpcion = select.getAttribute('data-primera-opcion') ?? 'Seleccione';

      // Realiza una solicitud Ajax para obtener los datos del endpoint
      fetch('api/' + url, {
        method: metodo
      })
      .then(response => {
        // Verificar si la respuesta es exitosa
        if (!response.ok) {
          throw new Error('Error en la red: ' + response.status);
        }
        return response.json();
      })
      .then(data => {
        // Verificar que 'data' contenga la propiedad 'mensaje' que tiene la lista de opciones
      if (data.datos && Array.isArray(data.datos)) {
          select.innerHTML = '<option value="" disabled selected>' + primeraOpcion + '</option>';

          data.datos.forEach(opcion => {
            // Asignar dinámicamente las claves para el valor y el texto
            const valor = opcion[Object.keys(opcion)[0]]; // Primer campo
            const texto = opcion[Object.keys(opcion)[1]]; // Segundo campo
            const opcionElemento = document.createElement('option');
            opcionElemento.value = valor;
            opcionElemento.textContent = texto;
            select.appendChild(opcionElemento);
          });
        } else {
          console.error('Datos no válidos:', data);
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  } catch (error) {
    console.error('Error:', error);
  }
}


const confirmarEliminarRegistros = (event, descripcion) => {
  XX = event;
  // Botón presionado
  const boton      = event.target ?? event.target.parentElement;

  const confirmar = prompt(`${descripcion}?\n \n Escriba la palabra SI en mayusculas para confirmar la eliminación`) ?? '';

  if (confirmar.trim() === 'SI') {

    // Eliminar el contenedor del registro

    
    // Contenedor a eliminar o a esconder
    const contenedor = event.target.dataset.contenedor ?? event.target.parentElement.dataset.contenedor;
    const fila       = boton.closest(contenedor);
    // Se esconde el contenedor
    fila.classList   = 'd-none';
  } else {
      event.preventDefault();
  }
}

window.onload = cargarSelects;
