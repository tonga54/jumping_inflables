$("form").submit(validarFormulario);

function validarFormulario(){
  var formulario = document.getElementsByTagName("form");
  var bandera = true;
  var mensaje = "ERROR: \n";

  for(var i = 0; i < formulario[0].length; i++){
    var id = formulario[0][i].id;
    id = id.substr(3,id.length-1);
    var result = verificarUrl();
      if(!(formulario[0][i].className == "choices__button" || formulario[0][i].className == "choices__input choices__input--cloned")){
        //Si la url es editarEvento entonces no sera obligatiorio seleccionar materiales
        if(!verificarUrl()){
          if(formulario[0][i].className == "form-control choices__input is-hidden" && formulario[0][i].value == ""){
            mensaje += "Debes elegir por lo menos un material\n";
            bandera = false;
          }
        }

        if(formulario[0][i].className != "form-control choices__input is-hidden"){

          // Obtener id del elemento y extraer el nombre del input

          var aux = "";
          for(var x = 0;x < id.length;x++){
            if(id[x] == id[x].toUpperCase()){
              aux += " ";
              aux += id[x];
            }else{
              aux += id[x];
            }//end if
          }//end for

          // FIN - Obtener id del elemento y extraer el nombre del input

          if(formulario[0][i].type == "tel"){
            if(isNaN(formulario[0][i].value)){
              aux += " debe ser numerico\n";
              mensaje += aux;
              bandera = false;
            }else if(formulario[0][i].value == ""){
              aux += " vacio\n";
              mensaje += aux;
              bandera = false;
            }
          }
          else if(formulario[0][i].type == "number"){
            if(Number(formulario[0][i].value) <= 0){
              aux += " no puede ser menor o igual a 0\n";
              mensaje += aux;
              bandera = false;
            }else if(formulario[0][i].value == ""){
              aux += " vacio\n";
              mensaje += aux;
              bandera = false;
            }
          }
          else if(formulario[0][i].value == ""){
            aux += " vacio\n";
            mensaje += aux;
            bandera = false;
          }
        }//end if

      }//end if


  }//end function

  if(!bandera){
    alert(mensaje);
  }

  return bandera;
}


function verificarUrl(){
  var url = window.location.href;
  if(url.indexOf("editarEvento")>-1){
    return true;
  }else{
    return false;
  }
}
