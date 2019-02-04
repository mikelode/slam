/* JAVASCRIPT PARA EL SISTEMA DE TRAMITE *//**
 * Created by HP i5 on 16/07/2015.
 */

function showDocDetail(code)
{
    $.getJSON('doc/detail/' + code).done( function(response){
        var output = "<dl><dt>Código:</dt><dd>" + response.documento[0].tdocId + "</dd>";
        output += "<dt>Remitente:</dt><dd>" + response.documento[0].tdocSenderName + " " + response.documento[0].tdocSenderPaterno + " " + response.documento[0].tdocSenderMaterno + "</dd>";
        output += "<dt>Asunto:</dt><dd>" + response.documento[0].tdocSubject + "</dd>";
        output += "<dt>Folio:</dt><dd>" + response.documento[0].tdocFolio + "</dd>";
        output += "<dt>Referencias:<dt><dd>" + response.documento[0].tdocRef + "</dd>";
        output += "<dt>Anexos:</dt>";
        output += "<dd><ul>";
        
        $.each(response.anexos, function(i, anexo){
            output += "<li>" + anexo.tdaTypAnx + "&nbsp;-&nbsp;" + anexo.tdaNumAnex + "&nbsp;:&nbsp;" + anexo.tdaDsc + "</li>";
        });

        output += "</ul></dd>";

        $('#detail_document').html(output);
    });
}

function showOperationDetail(codeId)
{

    $.getJSON('operation/detail/' + codeId, function(response){
        
        var output = "";

        if(response[0].thisFlagA == true)
        {
            output += "<p>DESCRIPCION DE LA ATENCION:</p>";
            output += "<h4>" + response[0].thisDscA + "</h4>";
        }
        else if(response[0].thisFlagD == true)
        {
            output += "<p>DESCRIPCIÓN DE LA DERIVACIÓN POR PARTE DE LA OFICINA REMITENTE:</p>";
            output += "<h4>" + response[0].thisDscD + "</h4>";
        }
        else
        {
            output += "El documento no ha sido atendido ó derivado."
        }

        $('#detail_operation').html(output);
    });

}

function showTrackingDoc(code)
{
    $.get('tracking/' + code);
}

function change_menu_to(path)
{
    /*$('.preloader').show();*/
    var year = $('#periodSys').val();

    $.get(path, {period : year}, function(data){

        if(data == '401')
        {
            bootbox.alert('USTED NO ESTA AUTORIZADO PARA INGRESAR A ESTA SECCION.');
        }
        else
        {
            $('.alm-content-wrapper').html(data);
            /*$('.preloader').hide();*/
        }
    });
}

function change_to_submenu(path)
{
    $.get(path, function(data){
        $('.alm-sub-content').html(data);
    });
}

function change_to_bandeja(path)
{
    $.get(path, function(data){
        $('.detail-bandeja').html(data);
    });
}

function fntest()
{

}

function get_result_forMany(url, data)
{
    $.post(url,data,function(result){

        if(result.length == 0)
        {
            bootbox.alert('EL DOCUMENTO CON EL ASUNTO BUSCADO NO ES ENCONTRADO');
            return;
        }

        var path = '';
        var output = "<table class='table table-hover table-striped'>";
        output += "<tr><th style='width: 10px'>#</th><th>Documento</th><th>Tipo</th><th>Remitente</th><th>Asunto</th><th>Fecha de Presentación</th><th>Estado</th><th>Detalle Seguimiento</th></tr>";

        $.each(result, function(i, item){

            path = 'doc/tracking/' + item.tarcExp;
            output += "<tr>";
            output += "<td>" + (i+1) +"</td>";
            output += "<td>" + item.tdocId + "</td>";
            output += "<td>" + item.ttypDesc + "</td>";
            output += "<td>" + item.tdocDni + "</td>";
            output += "<td>" + item.tdocSubject + "</td>";
            output += "<td>" + item.tarcDatePres + "</td>";
            output += "<td>" + item.tarcStatus + "</td>";
            output += "<td><a href='javascript:void(0)' onclick='change_menu_to(\"" + path + "\")'> Ver </td>";
            output += "</tr>";
        });
        output += "</table>";

        $('#resultRows').empty();
        $('#resultRows').html(output);
    }).fail(function(){
        bootbox.alert('Error. Revise su Conexión.');
    });
}

function get_result_for(url, data)
{
    $.post(url,data,function(result){

        if(result == "")
        {
            bootbox.alert('EL CODIGO BUSCADO NO EXISTE');
            return;
        }

        var path = 'doc/tracking/' + result[0]['tarcExp'];
        var output = "<table class='table table-hover table-striped'>";
        output += "<tr><th style='width: 10px'>#</th><th>Documento</th><th>Tipo</th><th>Remitente</th><th>Asunto</th><th>Fecha de Presentación</th><th>Estado</th><th>Detalle Seguimiento</th></tr>";
        output += "<tr>";
        output += "<td>1</td>";
        output += "<td>" + result[0]['tdocId'] + "</td>";
        output += "<td>" + result[0]['ttypDesc'] + "</td>";
        output += "<td>" + result[0]['tdocDni'] + "</td>";
        output += "<td>" + result[0]['tdocSubject'] + "</td>";
        output += "<td>" + result[0]['tarcDatePres'] + "</td>";
        output += "<td>" + result[0]['tarcStatus'] + "</td>";
        output += "<td><a href='javascript:void(0)' onclick='change_menu_to(\"" + path + "\")'> Ver </td>";
        output += "</tr>";
        output += "</table>";

        $('#resultRows').empty();
        $('#resultRows').html(output);

    }).fail(function(){
        bootbox.alert('Revise los datos ingresados');
    });
}

function close_chat_box(id)
{
    $('#chat-box-' + id).remove();
}

function updateScroll(id){
    var element = $('#direct-chat-messages-' + id);
    element[0].scrollTop = element[0].scrollHeight;
}

function change_source_doc_to(source)
{
    switch (source)
    {
        case 'ext':
            $('#dni_sender_input').val('');
            $('#name_sender_input').val('');
            $('#patern_sender_input').val('');
            $('#matern_sender_input').val('');
            break;
        case 'int':
            //change_menu_to('doc/register');
            $.getJSON('doc/manager',function(manager){
                if(manager.length == 0) return;
                $('#dni_sender_input').val(manager[0].trepDni);
                $('#name_sender_input').val(manager[0].trepName);
                $('#patern_sender_input').val(manager[0].trepPaterno);
                $('#matern_sender_input').val(manager[0].trepMaterno);
            });
            break;
    }
}

function min_chat_box(id)
{
    $('#chat-body-box-' + id).slideToggle('slow');
}

function open_chat_box(id, user)
{
    /*$('#chat-box-mdv').show();*/

    var id_html = '#chat-box-' + id;

    if($(id_html).length != 0) return;

    var chatbox = '';

    chatbox += '<div class="chat-box" id="chat-box-'+ id + '">';
    chatbox += '<div class="box box-primary direct-chat direct-chat-primary">';
    chatbox += '<div class="box-header with-border">';
    chatbox += '<h3 class="box-title">' + user + '</h3>';
    chatbox += '<div class="box-tools pull-right">';
    chatbox += '<button class="btn btn-box-tool" onclick="min_chat_box(\'' + id + '\')"><i class="fa fa-minus"></i></button>';
    chatbox += '<button class="btn btn-box-tool" onclick="close_chat_box(\'' + id + '\');"><i class="fa fa-times"></i></button>'
    chatbox += '</div></div><div id="chat-body-box-' + id + '">';
    chatbox += '<div class="box-body">';
    chatbox += '<div class="direct-chat-messages" id="direct-chat-messages-' + id + '">';
    chatbox += '</div></div>';
    chatbox += '<div class="box-footer"><form id="send-message-' + id + '"><div class="input-group">';
    chatbox += '<input type="text" id="' + id + '" name="message" placeholder="Mensaje ..." class="input-chat form-control" style="width: 230px" autocomplete="off" />';
    chatbox += '<span class="input-group-btn">';
    chatbox += '</span></div></form></div></div></div></div>';



    $('#chat-box-container').append(chatbox);
}

function fillData(check, source, target, control, flag)
{
    var active = $(check).prop('checked');
    var n = $(check).prop('id').split('-');
    var row = $(check).closest('tr#rowProduct' + n[1]);
    var p = $(check).data('prod');

    if(active)
    {
        var c = '';
        if(flag == 'int')
            c = parseFloat(row.find('#' + source + '-' + p).val()) - parseFloat(row.find('#' + control + '-' + p).val());

        if(flag == 'dis')
            c = row.find('#' + source + '-' + p).val();

        row.find('#' + target + '-' + p).val(c);
    }
    else
    {
        row.find('#' + target + '-' + p).val('0');
    }
}

function validar_cantidad(cod_prod, cant_pref, stock_pref, flag, row)
{
    var cant_ingresada = '';
    var cant_prod = row.find('#' + cant_pref + '-' + cod_prod).val();
    var cant_stock = row.find('#' + stock_pref + '-' + cod_prod).val();
    var control = '';

    if(flag == 'int')
    {
        cant_ingresada = $('#intQ-' + cod_prod).val();
        control = cant_prod-cant_stock;
    }
    else if(flag == 'dis')
    {
        cant_ingresada = $('#disQ-' + cod_prod).val();
        control = cant_stock;
    }

    var vacio = check_empty(cant_ingresada);
    var limite = check_limit(cant_ingresada, control);

    if(!vacio || !limite)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function check_limit(valor_caja, control)
{
    valor_caja = parseFloat(valor_caja);
    control = parseFloat(control);

    if(valor_caja > control)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function check_empty(valor_caja)
{
    if($.trim(valor_caja) == '')
    {
        return false;
    }
    else
    {
        return true;
    }
}

function check_empty_checker(checkers)
{
    var state = false;

    checkers.each(function(i){
        var actived = $(this).prop('checked');

        if(actived)
        {
            state  = true;
        }
    });

    return state;
}

function add_row_to(section)
{
    switch(section)
    {
        case 'NA':
            return;
        case 'F':
            var id;
            var tmp;
            var row;
            var row2 = $('#tableProducts tbody tr:eq(1)');

            if(row2.length > 0)
            {
                id = row2.attr('id');
                if(id == null)
                {
                    id = 'row-1';
                }
                else
                {
                    tmp = id.split('-');
                    id = 'row-' + (parseInt(tmp[1]) + 1);
                }
                row = $('#tableProducts tbody tr:eq(0)').clone().removeClass('net-baseRow').attr('id',id);
                $('#tableProducts tbody tr:eq(0)').after(row);
            }
            else
            {
                id = 'row-1';
                row = $('#tableProducts tbody tr:eq(0)').clone().removeClass('net-baseRow').attr('id',id);
                $('#tableProducts tbody tr:eq(0)').after(row);
            }
            break;
    }
}

/*
* FUNCIONES DE INTERNAMIENTO
* */

function ampliarPlazo()
{
    var url = 'task/plazo';
    var data = $('#frm-extend-date').serialize();

    $.post(url, data, function(response){
        alert(response + ' Plazo Modificado Correctamente ');
        $('#limitDateModal').modal('hide');
        /*$('body').removeClass('modal-open');
        $('.modal-backdrop').remove();*/
        getMenuInternamiento();
    }).fail(function(dataError){
        var error = $.parseJSON(dataError.responseText);
        var msg = '';

        $.each(error, function(i, item){
            msg += item[0] + '\n';
        });
        alert('ERROR: revise lo siguiente \n' + msg);
    });
}

function anularOc()
{
    var url = 'task/anular';
    var data = $('#frm-cancel-oc').serialize();

    $.post(url, data, function(response){
        alert(response);
        $('#cancelOcModal').modal('hide');
        getMenuInternamiento();
    }).fail(function(dataError){
        var error = $.parseJSON(dataError.responseText);
        var msg = '';

        $.each(error, function(i, item){
            msg += item[0] + '\n';
        });
        alert('ERROR: revise lo siguiente \n' + msg);
    });
}

/*
*  FUNCIONES DE ACCESO A LOS MENUS
* */

function getMenuInternamiento()
{
    var year = $('#periodSys').val();
    var url = 'internamiento/period/' + year;
    $.get(url,function(data){
        $('.alm-content-wrapper').html(data);
    });
}

function getMenuDistribucion()
{
    var year = $('#periodSys').val();
    var url = 'distribucion/period/' + year;
    $.get(url,function(data){
        $('.alm-content-wrapper').html(data);
    });
}

function getMenuVerificacion()
{
    var url = 'filtro';
    $.get(url,function(data){
        $('.alm-content-wrapper').html(data);
    });
}