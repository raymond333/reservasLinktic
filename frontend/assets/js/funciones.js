

//FUNCIONES PARA EL ALMACENAMIENTO

const guardarLocalStorage = (nombre, valor) => {
  localStorage.setItem(nombre, JSON.stringify(valor));
};

const leerLocalStorage = (nombre) => {
  const valor = localStorage.getItem(nombre);
  return valor ? JSON.parse(valor) : null;
};

const borrarLocalStorage = (nombre) => {
  localStorage.removeItem(nombre);
};  


function LOWER(VPtex){
  return VPtex.toLowerCase().trim();
}

function numero(VPval){//Completar fecha
  return !isNaN(VPval);
}
function MostrarMensaje(VPmen,VPtip,VPtit,VPx){
  switch(VPtip){
    case 1:
      VTtip='success';
      break;  
    case 2:
      VTtip='info';
      break;
    case 3:
      VTtip='danger';
      break;
    case 4:
      VTtip='warning';
      break;
    case true:
      VPx=true;
      VTtip='success';
      break;
    default:
      VTtip='success';
  }
  if(!numero(VPtip)){

    VPx=VPtit;
    VPtit=VPtip;
  }
  if(VPtit==true){
    VPx=true;
    VPtit=undefined;
  }
  VClaCer=VPx==true ? ' alert-dismissible' : '';
  Vtem=`<div class="animated zoomInDown alert alert-${VTtip+VClaCer}   fade show" role="alert">`;

  if(VPx==true){
    Vtem=Vtem+`<button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">Ã—</span>
          </button>`;
  }
  
  if(VPtit!=undefined){
    Vtem= Vtem+ '<h4 id="oh-snap!-you-got-an-error!">'+VPtit+'<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>';
  }
  return Vtem+VPmen+'</div>';

}

function MAYUS(e){
  if(e.type==='undefined'){
    return e.toUpperCase();
  }else{
    return e.value=e.value.toUpperCase();
  }
}
function MINUS(e){
  if(e.type=='undefined'){
    return e.toLowerCase();
  }else{
    return e.value=e.value.toLowerCase();
  }
}
