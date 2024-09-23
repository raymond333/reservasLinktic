document.getElementById("subir_imagen").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let lector = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  lector.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  lector.onload = function(){
    let vistaPrevia = document.getElementById('vista_previa_imagen'),
    imagen = document.createElement('img');

    imagen.src = lector.result;

    vistaPrevia.innerHTML = '';
    vistaPrevia.append(imagen);
  };
}

function mostrar(opcion) {
  Vblock = 'block';
  Vempleado = 'none';
  Vrepresentante = 'none';
  Vchofer = 'none';
  console.log(opcion);
  switch (opcion) {
    case 'EMPLEADO':
      Vempleado = Vblock;
      break;

    case 'REPRESENTANTE':
      Vrepresentante = Vblock;
      break;

    case 'CHOFER':
      Vchofer = Vblock;
      break;
  }

  document.getElementById("empleado").style.display = Vempleado;
  document.getElementById("representante").style.display = Vrepresentante;
  document.getElementById("chofer").style.display = Vchofer;            
        
}
