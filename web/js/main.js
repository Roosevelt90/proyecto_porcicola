$(document).ready(function(){
  // $('#mvcIcon').hide();
  $('#mvcIcon .mvcPointer').click(function(){
    $('#mvcMain').toggle(150);
    $('#mvcIcon').toggle(150);
  });
  $('#mvcMain .mvcPointer').click(function(){
    $('#mvcMain').toggle(150);
    $('#mvcIcon').toggle(150);
  });
});

//funcion para cerrar la ventana de error automaticamente
function closeError() {
    $('div[class="alert alert-danger alert-dismissible"]').alert('close');
}
function closeSucess(){
    $('div[class="alert alert-success alert-dismissible"]').alert('close');
}
$(document).ready(function () {
    setTimeout(closeError, 8000);
    setTimeout(closeSucess, 8000);
});
// FIN DE LA FUNCION