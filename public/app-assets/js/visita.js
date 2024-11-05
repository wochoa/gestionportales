function esNumerico(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode < 48 || charCode > 57)
        return false;

    return true;
}

function convertToUppercase(input) {
    input.value = input.value.toUpperCase();
}

function limpiarVisitante(){
    $('#ndocu').val('');
    $('#nombre').val('');
    $('#tipopersona').val(0);
    $('#foto').html('<img style="width: 100%" src="data:image/jpg;base64,iVBORw0KGgoAAAANSUhEUgAAAMQAAADECAAAAADlzdG3AAAEP0lEQVRo3u3a8U9TVxTAcf+68+gLJasVtQxKw6p1NC0URCSIuBQcG2BG02psazKEwpIOVBQITPKsUNpH7x+1Zb8tU+y9u+f01J3vP3DzSdPkvnvOFfUVdEUQghCEIAQhCEEIQhCCEIQgBCEIQQhCEIIQhCAEIQhBCEIQghDEV4toepvL9xKxWOLecsXzuxFR21pKRYIO/J0TjKR/rNS6DLH3w7fwrwbn33QRYnfChU/mZna6BHE068Bnc2aPugFRDMOlhYvsEfVZ+GIP6rwRJwloo8QJZ8T7GLRV7D1fxEkU2ix6whVxFoe2i58xRUyBRlM8EXnQKs8RsR/UQwT3+SEu0qDZ2AU7xEtHF9GzwQ3RGgHtvmsxQ2yCQRVmiJQJIs0LcdBngug7ZIVYA6NynBCtcTNEhhPC6zdD9HuMELuOGcJ5xQjxHAwrMkIsmiIeM0JMmyKmGSHGTBFjjBBJU0SSEWLUFDHKCJEyRaQYISZNEXcZIeZNEfOMEGumiDVGiIopYosR4ihoZggeM0I04maIW01OH0ULZohFVl922wETQ+A3Vohm1AQx3GSFUKsmiFVmTzYfvtE3hGrMEOonfcTP7N5ivRu6hpsf2CFUURdRUvwQakLPMKE4IrzrOobrHkuEqmrcoIJVxROhym2/oTkvFFeEKva0OSR6rvgiVNltx+CWFGeEqrTxtHxtS/FGqOMvTlHT1jee7O87tXKXLjyFcxeKP+KvXZu5zw6/+h78gXAgziLju+wnf41r2bcox2GtlJ6WJm/842svcHOydIZ0GOJy78ft3Nx4fCgSGYqPz+W2P+KdhL1mfV7zvNo58iGyKy4IQQiijfzG+aU1fM6Ii4ONwsJMZjQRv7TEaGZmobBx4LND+If56WhIYznCCQ1OFfZ9Roi9J7eMHpSd2yt7PBB+Od0LxvWmyn7HEfVnQ/AfGyrUO4t4EQMLxcodRLxJgqWSrzuE8Jd7wVq9y81OIA6/B6vdOaRHrIfBcld/pUasOWA95xdaxGNAaZES8QiQekSHQDMYKkwQS4DYEg0iD6jlKRBVFxfhVvERepM5k/SnebqIVgbQy7SQEU+BoGe4iKMwBSJ8jIq4DyTNYCJ2HBpEzw4eopUEopItNITZkhz+Yp0WIgNkZbAQey4dwn2LhMgCYQs4iPN+SkR/AwWxDqS9REHcp0XMYCDqg7SIwToCYselRbi7CIgCEFdAQDykRjy0j2gmqRFJ3zrCi1AjBjzriGqIGhH63TqiEKBGBJ5aR2SBvKx1xCQ94q51RIIeccc6YoQeMWIdMUyPGLaOiNIjooIQhCDkj/0/QaToEWnriBL9LbZsHdG4TY1INK0j1CY1ooLxeLZCa1jBeVBep7vJOiPrWPOJ09UBknmXM/DklGRpi1OCEIQgBCEIQQhCEIIQhCAEIQhBCEIQghCEIAQhCEEIQhCCEEQX9yevG1nOA/oDXgAAAABJRU5ErkJggg==">');
    $("#ndocu" ).focus();
}


function limpiar(nomoficina){
    $('#ndocu').val('');
    $('#nombre').val('');
    $('#tipopersona').val(0);
    $('#institucion').val('');
    $('#fginstitucion').hide();
    $('#foto').html('<img style="width: 100%" src="data:image/jpg;base64,iVBORw0KGgoAAAANSUhEUgAAAMQAAADECAAAAADlzdG3AAAEP0lEQVRo3u3a8U9TVxTAcf+68+gLJasVtQxKw6p1NC0URCSIuBQcG2BG02psazKEwpIOVBQITPKsUNpH7x+1Zb8tU+y9u+f01J3vP3DzSdPkvnvOFfUVdEUQghCEIAQhCEEIQhCCEIQgBCEIQQhCEIIQhCAEIQhBCEIQghDEV4toepvL9xKxWOLecsXzuxFR21pKRYIO/J0TjKR/rNS6DLH3w7fwrwbn33QRYnfChU/mZna6BHE068Bnc2aPugFRDMOlhYvsEfVZ+GIP6rwRJwloo8QJZ8T7GLRV7D1fxEkU2ix6whVxFoe2i58xRUyBRlM8EXnQKs8RsR/UQwT3+SEu0qDZ2AU7xEtHF9GzwQ3RGgHtvmsxQ2yCQRVmiJQJIs0LcdBngug7ZIVYA6NynBCtcTNEhhPC6zdD9HuMELuOGcJ5xQjxHAwrMkIsmiIeM0JMmyKmGSHGTBFjjBBJU0SSEWLUFDHKCJEyRaQYISZNEXcZIeZNEfOMEGumiDVGiIopYosR4ihoZggeM0I04maIW01OH0ULZohFVl922wETQ+A3Vohm1AQx3GSFUKsmiFVmTzYfvtE3hGrMEOonfcTP7N5ivRu6hpsf2CFUURdRUvwQakLPMKE4IrzrOobrHkuEqmrcoIJVxROhym2/oTkvFFeEKva0OSR6rvgiVNltx+CWFGeEqrTxtHxtS/FGqOMvTlHT1jee7O87tXKXLjyFcxeKP+KvXZu5zw6/+h78gXAgziLju+wnf41r2bcox2GtlJ6WJm/842svcHOydIZ0GOJy78ft3Nx4fCgSGYqPz+W2P+KdhL1mfV7zvNo58iGyKy4IQQiijfzG+aU1fM6Ii4ONwsJMZjQRv7TEaGZmobBx4LND+If56WhIYznCCQ1OFfZ9Roi9J7eMHpSd2yt7PBB+Od0LxvWmyn7HEfVnQ/AfGyrUO4t4EQMLxcodRLxJgqWSrzuE8Jd7wVq9y81OIA6/B6vdOaRHrIfBcld/pUasOWA95xdaxGNAaZES8QiQekSHQDMYKkwQS4DYEg0iD6jlKRBVFxfhVvERepM5k/SnebqIVgbQy7SQEU+BoGe4iKMwBSJ8jIq4DyTNYCJ2HBpEzw4eopUEopItNITZkhz+Yp0WIgNkZbAQey4dwn2LhMgCYQs4iPN+SkR/AwWxDqS9REHcp0XMYCDqg7SIwToCYselRbi7CIgCEFdAQDykRjy0j2gmqRFJ3zrCi1AjBjzriGqIGhH63TqiEKBGBJ5aR2SBvKx1xCQ94q51RIIeccc6YoQeMWIdMUyPGLaOiNIjooIQhCDkj/0/QaToEWnriBL9LbZsHdG4TY1INK0j1CY1ooLxeLZCa1jBeVBep7vJOiPrWPOJ09UBknmXM/DklGRpi1OCEIQgBCEIQQhCEIIQhCAEIQhBCEIQghCEIAQhCEEIQhCCEEQX9yevG1nOA/oDXgAAAABJRU5ErkJggg==">');
    $('#oficodigo').val(0);
    $('#nomoficinai').val('');
    $('#nomoficina').val(nomoficina).trigger('change');
    $("#funcionario").empty();
    $('#cargo').val('');
    $('#smotivo').val(0);
    $('#motivo').val('');
    $('#fgmotivo').hide();
    $('#lugar').val(nomoficina);

    $("#ndocu" ).focus();
}

function rellenarDatosVisitante(data){
    $('#nombre').val(data['prenombres'] + ' ' + data['apPrimer'] + ' ' + data['apSegundo']);
    $('#tipopersona').val('Persona Natural');
    $('#foto').html('<img style="width: 100%" src="data:image/jpg;base64,' +  data['foto'] + '">');
}

$("#ndocu").keyup(function() {
    var user_id = $('#ndocu').val();

    if($('#ndocu').val().length == 8) {
        $.ajax({type:'GET',
            url:'/reniec/' + user_id,
            dataType: "json",
            data:{
                cdni:user_id
            },
            success:function(data){
                rellenarDatosVisitante(data);
            },
            error: function(data){
                limpiarVisitante();
            }

        });
    }
});

$('#tipopersona').change(function(){
    var seleccionado = $(this).val();
    if (seleccionado === 'Persona Natural' || seleccionado === '0') {
        $('#fginstitucion').hide();
        $('#institucion').val('Persona Natural: a titulo personal');
    } else {
        if(seleccionado === 'Entidad Publica'){
            $('#linstitucion').html(seleccionado + ':');
        }else{
            $('#linstitucion').html('Entidad Privada:');
        }
        $('#fginstitucion').show();
        $('#institucion').val('');
        $('#institucion').focus();
    }
});

$('#nomoficina').change(function(){
    var seleccionado = $(this).find('option:selected').data('id');
    if (seleccionado == '0') {
        $('#oficodigo').val('0');
        $('#nomoficinai').val('');
        $('#cargo').val('');
        $('#lugar').val('');
    } else {
        $('#oficodigo').val(seleccionado);
        $('#nomoficinai').val($('#nomoficina  option:selected').text());

        let vurl = "/listarFuncionarios/" + seleccionado;
        $.get(vurl, function (data) {
            $("#funcionario").empty();
            $("#funcionario").append('<option value="0" data-id="0"><< SELECCIONE >></option>');
            for(var i = 0; i < data['funcionarios'].length; i++) {
                $('#funcionario').append('<option value="'+ data['funcionarios'][i]['funcionario']+ '" data-id="' + data['funcionarios'][i]['cargo'] + '">'+data['funcionarios'][i]['valor']+'</option>');
            }
        });
        $('#lugar').val($('#nomoficina  option:selected').text());
    }
});

$('#funcionario').change(function(){
    var seleccionado =  $(this).find('option:selected').data('id');
    if (seleccionado !== '0') {
        $('#cargo').val(seleccionado);
    }
});

$('#smotivo').change(function(){
    var seleccionado = $(this).val();
    if (seleccionado !== 'Otros') {
        $('#fgmotivo').hide();
        $('#motivo').val(seleccionado);
    } else {
        $('#fgmotivo').show();
        $('#motivo').val('');
        $('#motivo').focus();
    }
});

$(document).on("submit", ".frmvisita", function (e) {
    e.preventDefault();
    /////////limpiar errores
    var elem = document.getElementById('frmvisita').elements;
    for(var i = 0; i < elem.length; i++)
    {
        $('#' + elem[i].name + '_error').html('');
    }
    ////////////////////////////////////////////////////////////////////////
    var vid = $(this).attr("id");

    var vurl = "/visitas";
    var vform = new FormData($("#"+vid+"")[0]);

    $.ajax({
        url: vurl,
        type: 'POST',
        data: vform,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#mensaje').html($('#cargador2').html());
        },
        complete: function() {
            $('#mensaje').html('');
        },
        success: function (data) {
            if(data.resultado){
                toastr.success(data.mensaje);
                limpiar($('#nomoficina').val());
                $('#btnbuscar').click();
            }else{
                if(data.codigo === 0){
                    toastr.info(data.mensaje);
                }else{
                    toastr.error('Verifique la informacion registrada ...');
                }
            }
        },
        error:function(data) {
            console.log(data);
            if(data.status == 422){
                toastr.error('Verifique la informacion registrada ...');
                var resp_c = data.responseJSON;
                var i = 0;
                var enfocar;
                $.each(resp_c.errors,function(index,value) {
                    i++;
                    if (value.length != 0) {
                        if (i === 1) {
                            enfocar = index;
                        }
                        $('#' + index + '_error').html(value);
                    }

                    $('#' + enfocar).focus();
                });
            }else{
                toastr.error('Error ' + data.status + ': Verifique la informacion registrada ...');
            }
        }
    });
});

function frmSalida(codigo) {
    console.log(codigo);
    var vurl = "/visitas/" + codigo + "/edit";

    $("#myModal").html($("#cargador_empresa").html());
    $.get(vurl, function (resul) {
        $("#myModal").html(resul);
        $('#myModal').modal({ backdrop: 'static', }).on('shown.bs.modal', function () {
            $('#observaciones').focus();
        });
    });
}

$(document).on("submit", ".frmsalida", function (e) {
    e.preventDefault();
    /////////limpiar errores
    var elem = document.getElementById('frmsalida').elements;
    for(var i = 0; i < elem.length; i++)
    {
        $('#' + elem[i].name + '_error').html('');
    }
    ////////////////////////////////////////////////////////////////////////
    var vid = $(this).attr("id");

    var vurl = "/visitas/" + $("input[name=idregvisita]").val();
    var vform = new FormData($("#"+vid+"")[0]);

    $.ajax({
        url: vurl,
        type: 'POST',
        data: vform,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#mensaje').html($('#cargador2').html());
        },
        complete: function() {
            $('#mensaje').html('');
        },
        success: function (data) {
            if(data.resultado){
                toastr.success('Fue registrado la salida');
                $("#myModal").modal('hide');
                $('#btnbuscar').click();
            }else{
                toastr.error('Verifique la informacion registrada ...');
            }
        },
        error:function(data) {
            console.log(data);
            if(data.status == 422){
                toastr.error('Verifique la informacion registrada ...');
                var resp_c = data.responseJSON;
                var i = 0;
                var enfocar;
                $.each(resp_c.errors,function(index,value) {
                    i++;
                    if (value.length != 0) {
                        if (i === 1) {
                            enfocar = index;
                        }
                        $('#' + index + '_error').html(value);
                    }

                    $('#' + enfocar).focus();
                });
            }else{
                toastr.error('Error ' + data.status + ': Verifique la informacion registrada ...');
            }
        }
    });
});

