let popUp = $("#popup");
let fondoOpaco = $("#fondoOpaco");

$("#btnRegistrar").click(function(){
  if(validarFormulario()){
    popUp.show();
    fondoOpaco.show();

    let values = [$("#txtCliente").val(),$("#txtTelefono").val(),$("#txtFecha").val(),$("#txtHoraInicio").val(),$("#txtHoraFin").val(),$("#txtCantChicos").val(),$("#txtDireccion").val(),$("#txtObservaciones").val(),$("#txtCosto").val(),$("#txtDuracion").val()];

    let selecciones = $('.choices__item--selectable');
    let stringSeleccion = "";
    for(let i = 0; i < selecciones.length;i++){
      let seleccion = $(selecciones[i]);
      if(seleccion.attr("aria-selected") == "true" && !seleccion.attr("role")){
        let select = $(seleccion).text();
        let re = select.indexOf("Remove");
        if(re > -1){select = select.substr(0,re)}
        stringSeleccion+= "- " + select + "<br>";
      }
    }

    values.push(stringSeleccion);
    let campos = $(".tbl table tbody tr td");

    for(let i = 0; i < campos.length;i++){
      $(campos[i]).html(values[i]);
    }
  }

});

$(".icon-cross").click(function(){
  popUp.hide();
  fondoOpaco.hide()
});

$("#btnConfirmar").click(function(){
  $("#formAltaEvento").submit();
});

// popUp.toggle();
