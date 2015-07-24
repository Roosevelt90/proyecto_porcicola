function eliminar(id, variable, url) {
    $.ajax({
        url: url,
        data: variable + '=' + id,
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            location.reload();
        },
        error: function (objeto, quepaso, otroobj) {
            alert("estas viendo esto por q fallo"),
                    alert("paso lo siguiente :" + quepaso)
        }
    });
}

function myModalDetail (id){
        $('#myModalDetail').modal({show: 'false'});
            document.detailForm.detalle_registro_vacunas_id_registro.value = id;

}

function myModalDetailEdit (idCabecera, inputCabecera, idRegistro, inputRegistro){
        $('#myModalUpdate').modal({show: 'false'});
        alert("id: "+idCabecera+" "+" campo "+inputCabecera);
            document.detailFormEdit.detalle_registro_vacunas_id_registrovalue = idCabecera;
//            document.detailFormEdit.inputRegistro.value = idRegistro;

}

function modalDelete(id, campo, url) {
    $("#delete").on("click", function () {
        eliminar(id, campo, url)
    });
    $('#myModalDelete').modal({show: 'false'});
}

function myModalEnable(id, campo, url) {
    $("#delete").on("click", function () {
        eliminar(id, campo, url)
    });
    $('#myModalEnable').modal({show: 'false'});
}

function yModalDisable(id, campo, url) {
    $("#delete").on("click", function () {
        eliminar(id, campo, url)
    });
    $('#myModalDisable').modal({show: 'false'});
}

function paginador(objeto, url) {
    window.location.href = url + '?page=' + objeto;

}

function confirmarEliminar(id) {
    var rsp = confirm("¿Esta seguro de querer eliminar el registro indicado?");
    if (rsp == true) {
        $('#idDelete').val(id);
        $('#frmDelete').submit();
    }
}

function borrarSeleccion() {
    $("#myModalEliminarMasivo").modal("toggle");
}



$(document).ready(function () {
    $('#chkAll').click(function () {
        $('input[name="chk[]"]').each(function (index, element) {
            if ($('#chkAll').is(':checked') == true && $(element).is(':checked') == false) {
                $(element).prop('checked', true);
            } else if ($('#chkAll').is(':checked') == false && $(element).is(':checked') == true) {
                $(element).prop('checked', false);
            }
        });
    });
// $('input[name="chk[]"]').each(function (index, element){
//             if ($(element).is(':checked') == true) {
//                 $('#btnDeleteMasivo').removeClass('disabled');
//             }
//             });

});