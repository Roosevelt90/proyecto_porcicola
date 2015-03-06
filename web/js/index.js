function eliminar(id, variable, url){
    $.ajax({
        url: url,
        data: variable + '=' + id,
        dataType: 'json',
        type: 'POST',
        success: function(data){
           location.reload();
        },
        error: function(objeto, quepaso, otroobj){
            alert ("estas viendo esto por q fallo"),
            alert ("paso lo siguiente :" + quepaso)       
        }
    });
}

function confirmarEliminar(id) {
  var rsp = confirm("¿Esta seguro de querer eliminar el registro indicado?");
  if (rsp == true) {
    $('#idDelete').val(id);
    $('#frmDelete').submit();
  }
}

function borrarSeleccion() {
  var rsp = confirm("¿Esta seguro de querer eliminar los registros seleccionados?");
  if (rsp == true) {
    $('#frmDeleteAll').submit();
  }
}


$(document).ready(function(){
  $('#chkAll').click(function(){
    $('input[name="chk[]"]').each(function(index, element){
      if ($('#chkAll').is(':checked') == true && $(element).is(':checked') == false) {
        $(element).prop('checked', true);
      } else if ($('#chkAll').is(':checked') == false && $(element).is(':checked') == true) {
        $(element).prop('checked', false);
      }
    });
  });
});