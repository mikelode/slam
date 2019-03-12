/***************************************************************************************/
/********* SECTION EVENT SIMPLE    *****************************************************/
$( document ).on( 'click',  '.btn-cerrar',function(e) {
    e.preventDefault();
    $('.alm-content-wrapper').html("");

});


$( document ).on( 'click',  '#btnLogReqSearch',function(e) {
    e.preventDefault();
    jsFunReqGetData( "COD",$("#txReqNo").val());

});
$( document ).on( 'keydown',  '#txReqNo',function(e) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        jsFunReqGetData( "COD",$("#txReqNo").val());
    }
});

$(document).on('click , keydown','#btnLogItem',function(e) {
    e.preventDefault();
    $(".modal-backdrop").remove();
    if(!jsFunReqValidarDatos()){return ; }
    flg= false ;
    $("#tbProdBienes tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;
    if(flg) {
        jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>");
        return;
    }

    var valsf = $('#txCodSecFun').val();

    $("#tbBarraBienes tr").html("");
    filaBase='<tr valign="top" trfocus="ACTIVE">';
    filaBase+= jsFunGetRowTemplate("NEW",valsf) ;
    filaBase+="</tr>";
    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#tbBarraBienes").prepend(filaBase);
    $("#dvBarraAdd").css({'background': '#d9edf7'});
    $("#dvBarraAdd").css({'display': 'inherit'});
});

/***************************************************************************************/
/********* SECTION CLICK MAIN MENU *****************************************************/
$( document ).on( 'keydown',  '#btnLogReqSave , #btnLogReqCancel, #btnLogReqUpd, #btnLogReqDel, #btnLogReqSearch, #btnLogReqNew, #btnLogReqPrint , #btnLogReqBusy , #btnLogReqTrsh',function(e) {
    e.preventDefault();
});

$( document ).on( 'click',  '#btnLogReqSave , #btnLogReqDel ,  #btnLogReqTrsh',function(e){ /* USE */
    e.preventDefault();
    if(!jsFunReqValidarDatos()){return ; }
    if($(this).attr("id") =="btnLogReqDel")  varDatosReq.reqOPE="DEL" ;
    if($(this).attr("id") =="btnLogReqTrsh")  varDatosReq.reqOPE="TRH" ;

    if(!(varDatosReq.reqOPE=="ADD" || varDatosReq.reqOPE =="UPD"  || varDatosReq.reqOPE=="DEL" || varDatosReq.reqOPE=="TRH" ) || varDatosReq.reqOPE=="NN" )
    {
        $(".modal-backdrop").remove();
        $("#loadModals").html( jsFunLoadAviso('MENSAJE DE ERROR','Se Produjo un ERROR en la Operacion Seleccionado'));
        $('#dvAviso').modal('show');
        return;
    }
    parentt = $(this);
    flg = false ;
    if (varDatosReq.reqOPE=="ADD" || varDatosReq.reqOPE =="UPD" || varDatosReq.reqOPE =="DEL" || varDatosReq.reqOPE =="TRH"   ) {
    var ItemArray = new Array();
    $('#tbProdBienes tbody tr').each(function ()
        {
            if ($(this).attr("class")!="fila-Hide")  {
                    var fila = new Object();
                    fila.ID=0;
                    fila.cant= $(this).find("td[name=tdCant]").html();
                    fila.secfun = $(this).find("td[name=tdSF]").attr('codId');
                    fila.rubro = $(this).find("td[name=tdRubro]").attr('codID');
                    fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                    fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                    fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                    fila.espf = $(this).find("td[name=tdEspf]").html();
                    fila.precioUnt = $(this).find("td[name=tdPrecio]").html();
                    ItemArray.push(fila);
                flg= true;
            }
        });
       if(varDatosReq.reqOPE =="ADD" || varDatosReq.reqOPE =="UPD")  {
            if(!flg){
                jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Falta ingresar los detalles del requerimiento ( Bienes o Servicios )");return ;
            }
            var fullData = {
                'datos': varDatosReq,
                'lista': JSON.parse(JSON.stringify(ItemArray)),
                '_token': $('#tokenBtnMain').val()
            }
       }
        else {
           var fullData = {
               'datos': varDatosReq,
            //   'lista': JSON.parse(JSON.stringify(ItemArray)),
               '_token': $('#tokenBtnMain').val()
           }
       }


        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
        if (varDatosReq.reqOPE=="DEL")     $("#divDialogCont").html('Esta seguro que desea ANULAR el Registro Seleccionado ? <br> Motivo : <input class="gs-input" style="width:280px;" />');
        else if (varDatosReq.reqOPE=="TRH")     $("#divDialogCont").html('Esta seguro que desea ELIMINAR el Registro Seleccionado ? <br> Motivo : <input class="gs-input" style="width:280px;" />');
        else if (varDatosReq.reqOPE=="UPD")     $("#divDialogCont").html('Esta seguro que desea ACTUALIZAR el Registro Seleccionado ? ');
        else if (varDatosReq.reqOPE=="ADD")     $("#divDialogCont").html('Esta seguro que desea GUARDAR el Registro Seleccionado ? ');
        else $("#divDialogCont").html('ERROR de SELECCION ');
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetReq",
                        data: fullData,
                        beforeSend: function () {
                            jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");
                        },
                        error: function () {
                            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>");
                        },
                        success: function (data) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();

                            if(data.msgId == 500){
                                jsFnDialogBox(400, 160, "ERROR", parentt, "ERROR EN LA PETICION", data.msg);
                            }
                            else{

                                var returnData = data.result;

                                varDatosReq.reqID = returnData[0].ReqNo;

                                jsFunReqEnable(true);
                                jsFunReqButtons(false);
                                $("#divDialog").dialog(opt);
                                $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display", "block");
                                $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
                                $("#divDialog").dialog("open");
                                $("#divDialog").dialog({width: 400, height: 150, title: "CONFIRMAR OPERACION"});
                                $("#divDialogCont").html(returnData[0].Mensaje);
                                $("#divDialog").dialog({
                                    buttons: {
                                        "Aceptar": function () {
                                            if(varDatosReq.reqID!="NN") jsFunReqGetData("ID", varDatosReq.reqID);
                                        }
                                    }
                                });
                            }
                        }

                    });
                    $(this).dialog("close");
                },
                "Cancel": function () {
                    $(this).dialog("close");
                }
            }
            });
    }
});
$( document ).on( 'click',  '#btnLogReqCancel',function(e) {
    e.preventDefault();
    jsFunReqClear();
    jsFunReqEnable(true);
    jsFunReqButtons(false);

});
$( document ).on( 'click',  '#btnLogReqNew',function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"RQ",'_token': $('#tokenBtnMain').val() },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); return "-";},
        success: function (VR) { $("#txReqNo").val( VR[0].Codigo ); }
    });

    jsFunReqClear();
    jsFunReqEnable(false);
    jsFunReqButtons(true);

});
$( document ).on( 'click',  '#btnLogReqUpd',function(e) {
    e.preventDefault();
   // if(!jsFunReqValidarDatos()){return ; }
   $("#REQ").attr("opeID","UPD");
   varDatosReq.reqID = $("#REQ").attr("reqID");
   jsFunReqEnable(false);
   jsFunReqButtons(true);

   /* $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 175, title: "CONFIRMAR PROCESOS"});
    $("#divDialogCont").html("Esta Seguro de Actualizar el REQUERIMIENTO Nº");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
                $("#REQ").attr("opeID","UPD");
                varDatosReq.reqID = $("#REQ").attr("reqID");
                if( $("#REQ").attr("opeID") =="UPD")
                {
                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogGetBusy",
                        data: { obj:"REQ", codigo: varDatosReq.reqID,'_token': $('#tokenBtnMain').val() },
                        error: function () {
                            jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>");
                        },
                        success: function (returnData) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();
                            if (returnData.length > 0) {
                                if (returnData[0].Estado == "PROCESADO" || returnData[0].Estado == "ANULADO") {
                                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', ' El Requerimiento se encuenta<strong> ' + returnData[0].Estado) + '</strong>');
                                    $('#dvAviso').modal('show');
                                }
                                else {
                                    jsFunReqEnable(false);
                                    jsFunReqButtons(true);
                                }
                            }
                            else {
                                jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>No se retorno ningun registro.!</strong>");
                            }
                        }
                    });

                }

                $(this).dialog("close");


            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });
*/

});
$( document ).on( 'click',  '#btnLogReqDel',function(e) {
    e.preventDefault();
    $("#REQ").attr("opeID","DEL");
    //alert('ELIMINADO');
});

$( document ).on( 'click',  '#btnLogReqPrint',function(e) {
    e.preventDefault();
    if(!jsFunReqValidarDatos()){return; }
    window.open("logistica/rptReq/"+varDatosReq.reqID+"/"+$('.txVarAnioEjec').val()+'width=275,height=340,scrollbars=NO,location=no');
});

$( document ).on( 'click',  '#btnLogReqBusy',function(e) {
    e.preventDefault();
    var  Cod="NN";
    var datos = {Anio:$(".txVarAnioEjec").val(), '_token': $('#tokenBtn').val()}
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetReqBusy",
        data: datos,
        beforeSend: function () {jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function () {     jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>");        },
        success: function (returnData) {
            // $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            Cod = returnData[0].Codigo ;

            $("#divDialog").dialog(opt);
            $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
            $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
            $("#divDialog").dialog("open");
            $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
            $("#divDialogCont").html("<br>Esta Seguro que desea RESERVAR el Requerimiento:<strong> "+Cod+"<strong>");
            $("#divDialog").dialog({
                buttons: {
                    "Aceptar": function () {

                        var datos = {Anio:$(".txVarAnioEjec").val(), Usr: '00000','_token': $('#tokenBtn').val()}
                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogSetReqBusy",
                            data: datos,
                            beforeSend: function () {
                                jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento...");
                            },
                            error: function () {
                                jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>");
                            },
                            success: function (returnData) {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();

                                if (returnData.length > 0) {
                                    if (returnData[0].Error == "0") {
                                        $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE <br> Se ha Reservador el Requerimiento = ' + returnData[0].Codigo));
                                        $('#dvAviso').modal('show');
                                    }
                                    else {
                                        jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>" + returnData[0].Mensaje + "</strong>");
                                    }
                                }
                                else {
                                    jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>No se retorno ningun registro.!</strong>");
                                }
                            }
                        });

                        $(this).dialog("close");
                    },
                    "Cancel": function () {  $(this).dialog("close"); }    }
            });


        }
    });
});

/**********************************************************************************************/
/**************** EVENT BUSQ , ADD ROW A DB ***************************************************/

$( document ).on( 'keydown','#txCodDep, #txCodTipoReq ,#txCodSecFun , #txCodRubro  , #txDNI   ',function(event) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 )
    {
        $('#dvAviso').modal('hide');
        $('#dvWait').modal('hide');
        $(".modal-backdrop").remove();
        var valor = $(this).val();
        if(valor.length<1) {return;}

        var id ;
        var cod;
        var dsc;
        var obj ='NN';
        var tipo;
        var token = $('#tokenBtn').val();
        var Evento = $(this).attr('name');
        var Flg = false ;

        if(Evento=='txCodDep' )   {  obj='DEP'; tipo='COD';  }
        else if(Evento=='txCodSecFun'){  obj='SECFUN'; tipo='COD'; }
        else if(Evento=='txCodRubro') {  obj='RUBRO';  tipo='COD';}
        else if(Evento=='txDNI')      {  obj='DNI';  tipo='COD';}
        else {  $(".modal-backdrop").remove();  obj="NN"; $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encuentra dentro de los parametros establecidos'));  $('#dvAviso').modal('show');   }

        $("#loadModals").html(jsFunLoadWait());

        var dataString = {'anio':$(".txVarAnioEjec").val() ,'obj':obj,'tipo': tipo ,'valor':valor,'_token':$('#tokenBtn').val() } ;
        $.ajax({
            type: "POST",
            url: "logistica/spLogGetDatos",
            data: dataString,
            beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
            error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>") ;},
            success: function(data) {
                $("#divDialog").dialog("close");
                $('#dvWait').modal('hide');
                $('#dvAviso').modal('hide');
                $(".modal-backdrop").remove();
                if( data.length>0 ) {
                    Flg = true;
                    id = data[0].ID;
                    cod = data[0].Cod;
                    dsc = data[0].Dsc;
                    if (id == null)
                    {
                        Flg = false;
                        $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor 1'));  $('#dvAviso').modal('show');
                    }
                }
                else {
                    Flg = false;
                    $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show');
                }

                if(Evento=='txCodDep')
                {
                    if (Flg==false) {
                        $('#txCodDep').attr('depID','NN');  $('#txCodDep').val('');  $('#txDep').val('');    $( "#txCodDep" ).focus();
                    }
                    else{
                        $('#txCodDep').attr('depID',id);    $('#txCodDep').val(cod); $('#txDep').val(dsc);   $( "#txCodSecFun" ).focus();
                    }
                }
                else if(Evento=='txCodSecFun')
                {
                    if (Flg==false) {
                        $('#txCodSecFun').attr('secFunID','NN');
                        $('#txCodSecFun').val('');
                        $('#txSecFun').val('');
                        $( "#txCodSecFun" ).focus();
                    }
                    else{
                        $('#txCodSecFun').attr('secFunID',id);
                        $('#txCodSecFun').val(cod);
                        $('#txSecFun').val(dsc);

                        if(cod == '000M'){
                            $('#tbProdBienes thead tr th:nth-child(2)').show();
                            $('#tbProdBienes thead tr th:nth-child(3)').show();
                            $('#tbProdBienes tbody tr td:nth-child(2)').show();
                            $('#tbProdBienes tbody tr td:nth-child(3)').show();
                        }
                        else{
                            $('#tbProdBienes thead tr th:nth-child(2)').hide();
                            $('#tbProdBienes thead tr th:nth-child(3)').hide();
                            $('#tbProdBienes tbody tr td:nth-child(2)').hide();
                            $('#tbProdBienes tbody tr td:nth-child(3)').hide();
                        }

                        $( "#txCodRubro" ).focus();
                    }
                }
                else if(Evento=='txCodRubro')
                {
                    if (Flg==false) {
                        $('#txCodRubro').attr('rubroID','NN');  $('#txCodRubro').val('');  $('#txRubro').val('');    $( "#txCodRubro" ).focus();
                    }
                    else {
                        $('#txCodRubro').attr('rubroID',id);    $('#txCodRubro').val(cod); $('#txRubro').val(dsc);   $( "#txGlosa" ).focus();
                    }
                }
                else if(Evento=='txDNI')
                {
                    if (Flg==false) {
                        $('#txDNI').attr('dniID','NN');  $('#txDNI').val('');  $('#txSolicitante').val('');    $( "#txDNI" ).focus();
                    }
                    else {
                        $('#txDNI').attr('dniID',id);    $('#txDNI').val(cod); $('#txSolicitante').val(dsc);   $( "#txCondicion" ).focus();
                    }
                }
                else {obj="NN";}
            }
        });

        if($(this).attr('name')=='txCodTipoReq'){ $('#txTipoReq').val($(this).val()); $( "#txCodSecFun" ).focus();}
    }
    // if (event.keyCode == 46 || event.keyCode == 8  || event.keyCode == 37 || event.keyCode == 39    ){  }
    // else {
    //     if (event.keyCode < 95) {   if (event.keyCode < 48 || event.keyCode > 57) {      event.preventDefault();      }     }
    //     else {   if (event.keyCode < 96 || event.keyCode > 105) {     event.preventDefault();    }        }
    // }
});



/**********************************************************************************************/
/**************** EVENT BUSQ , ADD ROW A DB ***************************************************/

function fnFindRucProveedor(valor, Evento){
    if(valor.length<1) {return;}

    var id ;
    var cod;
    var dsc;
    var obj ='NN';
    var tipo;
    var token = $('#tokenBtn').val();
    var Flg = false ;

    if(Evento=='txProdUnd' )   {  obj='UND'; tipo='STR';  }
    else if(Evento=='txProdClasf'){  obj='CLASF'; tipo='STR'; }
    else if(Evento=='txOC_Ruc'  ){  obj='RUC'; tipo='STR'; }
    else if(Evento=='txOS_Ruc'  ){  obj='RUC'; tipo='STR'; }
    else if(Evento=='txRUC'  )  {  obj='RUC'; tipo='STR'; }

    else {  $(".modal-backdrop").remove();  obj="NN"; $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encuentra dentro de los parametros establecidos'));  $('#dvAviso').modal('show'); return;  }

    $("#loadModals").html(jsFunLoadWait());

    var dataString = {'obj':obj,'tipo': tipo ,'valor':valor,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetDatos",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
        error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>") ;},
        success: function(data) {
            $("#divDialog").dialog("close");
            $('#dvWait').modal('hide');
            $('#dvAviso').modal('hide');
            $(".modal-backdrop").remove();
            if( data.length>0 ) {
                Flg = true;
                id = data[0].ID;
                cod = data[0].Cod;
                dsc = data[0].Dsc;
                if (id == null) {  Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor '));  $('#dvAviso').modal('show');   }
            }
            else { Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show'); }

            if(Evento=='txProdUnd')
            {
                if (Flg==false) {   $('#txProdUnd').attr('codID','NN');  $('#txProdUnd').val('');   $( "#txProdUnd" ).focus(); }
                else      {   $('#txProdUnd').attr('codID',id);    $('#txProdUnd').val(cod);    $( "#txProdProd" ).focus();  }
            }
            else if(Evento=='txProdClasf')
            {
                if (Flg==false) {  $('#txProdClasf').attr('codID','NN');  $('#txProdClasf').val('');   $( "#txProdClasf" ).focus(); }
                else      {  $('#txProdClasf').attr('codID',id);    $('#txProdClasf').val(cod);    $( "#txProdUnd" ).focus();  }
            }
            else if(Evento=='txOC_Ruc')
            {
                if (Flg==false) {  $('#txOC_Ruc').attr('codID','NN');  $('#txOC_Ruc').attr('tel','-'); $('#txOC_Ruc').attr('dir','-');   $('#txOC_Ruc').val('');   $('#txOC_RSocial').val('');  $( "#txOC_Ruc" ).focus(); }
                else      {  $('#txOC_Ruc').attr('codID',id);    $('#txOC_Ruc').val(cod);   $('#txOC_RSocial').val(dsc);  $('#txOC_Ruc').attr("tel",data[0].Tel); $('#txOC_RSocial').attr("dir",data[0].Dir);   $( "#txOC_Plazo" ).focus();  }
            }
            else if(Evento=='txOS_Ruc')
            {
                if (Flg==false) {  $('#txOS_Ruc').attr('codID','NN');  $('#txOS_Ruc').attr('tel','-'); $('#txOS_Ruc').attr('dir','-');   $('#txOS_Ruc').val('');   $('#txOS_RSocial').val('');  $( "#txOS_Ruc" ).focus(); }
                else      {  $('#txOS_Ruc').attr('codID',id);    $('#txOS_Ruc').val(cod);   $('#txOS_RSocial').val(dsc);  $('#txOS_Ruc').attr("tel",data[0].Tel); $('#txOS_RSocial').attr("dir",data[0].Dir);   $( "#txOS_Plazo" ).focus();  }
            }
            else if(Evento=='txRUC')
            {
                if (Flg==false) {   $('#txRUC').attr('codID','NN');  $('#txRUC').val('');       $('#txRSocial').val('');   $('#txRUC').attr('tel','-');     $('#txRUC').attr('dir','-');      $( "#txRUC" ).focus(); }
                else      {         $('#txRUC').attr('codID',id);    $('#txRUC').val(cod);       $('#txRSocial').val(dsc);  $('#txRUC').attr("tel",data[0].Tel); $('#txRSocial').attr("dir",data[0].Dir);   $( "#txPlazo" ).focus();  }
            }

            else {obj="NN";}
        }
    });
}

//$( document ).on( 'keydown',' #txProdClasf , #txProdUnd  ,#txOC_Ruc ,#txOS_Ruc  ,#txRUC ',function(event) {
$( document ).on( 'keydown',' #txOC_Ruc ,#txOS_Ruc  ,#txRUC ',function(event) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 )
    {
        $(".modal-backdrop").remove();
        var valor = $(this).val();
        var Evento = $(this).attr('name');
        fnFindRucProveedor(valor, Evento);

    }
    //if (event.keyCode == 46 || event.keyCode == 8  || event.keyCode == 37 || event.keyCode == 39    ){  }
    //else {
    //    if (event.keyCode < 95) {   if (event.keyCode < 48 || event.keyCode > 57) {      event.preventDefault();      }     }
    //    else {   if (event.keyCode < 96 || event.keyCode > 105) {     event.preventDefault();    }        }
    //}
});



$( document ).on( 'keydown', '#txCodDep, #txCodTipoReq ,#txCodSecFun , #txCodRubro  , #txDNI ,  #txProdProd ', function( ) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if (event.keyCode == 113) {
        var obj=$(this).attr('name') ;
        if(obj=='txCodDep')   {  obj='DEP';  }
        else if(obj=='txCodSecFun'){  obj='SECFUN';  }
        else if(obj=='txCodRubro') {  obj='RUBRO';  }
        else if(obj=='txDNI')      {  obj='DNI';  }
        else if(obj=='txProdClasf')     {  obj='CLASF';  }
        else if(obj=='txProdProd')      {  obj='BNS';  }
        else if(obj=='txProdUnd')       {  obj='UND';  }
        else { obj="NN"; }

        $("#loadModals").html(jsFunModalBusqudaDatos('BUSQUEDA DE DATOS'));
        $('#modalContBusqDatos').css({'width': '600px', 'height': '400px'});
        $('#modalVentBusqDatos').modal('show');
        $('#modalVentBusqDatos').attr('obj',obj);
    }
});


// $( document ).on( 'keydown','#txGlosa, #txLugarEnt, #txCondicion ',function(event) {
//     if(event.keyCode == 13 ) {
//         var Evento = $(this).attr('ID');
//         if (Evento == 'txGlosa') {     $("#txLugarEnt").focus();   }
//         else if (Evento == 'txLugarEnt') {  $("#txDNI").focus();   }
//         else if (Evento == 'txCondicion') {   $("#txObsv").focus();   }
//     }
// });
$( document ).on( 'change','#r1, #r2',function(e) {
    e.preventDefault();
    if ($('#r1').is(":checked")) {  $("#txTipoGto").attr("tipoGtoID","0") ; }
    else if ($("#r2").is(":checked")) {       $("#txTipoGto").attr("tipoGtoID","1") ;  }
    else {   $("#txTipoGto").attr("tipoGtoID","NN") ;}
});

/***********************************************************************************/
/******* SECTION MENU REQ DLL   ****************************************************/

function jsFunReqValidarPto ( _idClasf, _codClasf)
{
  var objEvento = $(this).parent().parent();
  var fullData = {
            'datos': varDatosReq,
            'lista': varDatosReqProd,// JSON.parse(JSON.stringify(ItemArray)),
            '_token': $('#tokenBtn').val()
        }
   var valor = true;
     $.ajax({
            type: "POST",
            url: "logistica/spLogSetPrePto",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
            success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
              //  console.log(VR);
                if(VR["Msg"].length>0)
                {
                   if (VR["Msg"][0].Codigo =="1" )
                   {
                     
                     valor= false ;

                  /* $("#divDialog").dialog(opt);
                     $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display", "block");
                     $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
                     $("#divDialog").dialog("open");
                     $("#divDialog").dialog({width: 400, height: 150, title: "CONFIRMAR OPERACION"});
                     $("#divDialogCont").html(
                     "\n===================================\n " + VR["Msg"][0].Msg+ " \n "+ VR["Msg"][0].Pto +" \n * TE FALTA : s/.  "+  VR["Msg"][0].Saldo +"\n\n===================================\n "
                        );
                     $("#divDialog").dialog({
                                      buttons: {
                                            "Aceptar": function () {
                                                   valor= false ;
                                            }
                                        }
                                    });
                  */

                     alert("===================================\n\n "+ VR["Msg"][0].Msg+ " \n "+ VR["Msg"][0].Pto +" \n * TE FALTA : s/.  "+  VR["Msg"][0].Saldo +"\n\n===================================\n ") ;                     
                     // jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", VR["Msg"][0].Msg +" -  TE FALTA : s/.  "+  VR["Msg"][0].Saldo); 
                       
                   }
                }
                else {      valor =  false ;}
            }
        });
   return valor ;
}

$(document).on('click','.addRow',function(e){ // use
    e.preventDefault();
    var objEvento = $(this).parent().parent();
    if(!jsFunReqValidarDatos(objEvento )){return ; }
    if(!jsFunReqValidarProd("ADD",objEvento )){return ; }
    
   // if(!jsFunReqValidarPto(varDatosReqProd.prodClasfID , varDatosReqProd.prodClasfCod )){ return ; }
    
    fila = $("#tbProdBienes tr:last").clone(true).removeClass('fila-Hide');
    if(varDatosReq.reqOPE=="UPD")
    {
            varDatosReqProd.OPE="ADD";
            varDatosReqProd.ID= 0 ;
            var fullData = {
                'datos': varDatosReq,
                'lista': varDatosReqProd,// JSON.parse(JSON.stringify(ItemArray)),
                '_token': $('#tokenBtn').val()
            };

        $.ajax({
            type: "POST",
            url: "logistica/spLogSetReqD",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
            success: function (data) {

                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();

                if(data.msgId == 500){
                    jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "<strong>"+data.msg+"</strong>");
                }
                else{

                    var VR = data.varReturn;
                    if(VR["ReqDll"].length>0)
                    {
                        $("#divProdBienes").html(VR["ReqDll"]);
                        $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
                        $('#dvAviso').modal('show');
                    }
                    else {
                        jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                    }
                }
            }
        });

    }
    else {
        fila.find("td[name=tdID]")      .html(varDatosReqProd.prodID);
        fila.find("td[name=tdSF]")      .html(varDatosReqProd.prodSfDsc);
        fila.find("td[name=tdRubro]")   .html(varDatosReqProd.prodRubroDsc);
        fila.find("td[name=tdCant]")    .html(varDatosReqProd.prodCant);
        fila.find("td[name=tdClasf]")   .html(varDatosReqProd.prodClasfCod);
        fila.find("td[name=tdProd]")    .html(varDatosReqProd.prodDsc);
        fila.find("td[name=tdUnd]")     .html(varDatosReqProd.prodUndAbrv);
        fila.find("td[name=tdEspf]")    .html(varDatosReqProd.prodEspf);
        fila.find("td[name=tdPrecio]")  .html(varDatosReqProd.prodPrecioUnt);
        fila.find("td[name=tdTotal]")   .html(varDatosReqProd.prodTotal);
        fila.find("td[name=tdSF]")      .attr("codID",varDatosReqProd.prodSfID);
        fila.find("td[name=tdRubro]")   .attr("codID",varDatosReqProd.prodRubroID);
        fila.find("td[name=tdClasf]")   .attr("codID",varDatosReqProd.prodClasfID);
        fila.find("td[name=tdProd]")    .attr("codID",varDatosReqProd.prodID);
        fila.find("td[name=tdUnd]")     .attr("codID",varDatosReqProd.prodUndID);
        objEvento.fadeOut(300, function () {      objEvento.remove();      });
        $("#tbProdBienes").prepend(fila);
    }
    $("#tbBarraBienes tr").each(function (index) {      $(this).remove();     });
    $("#dvBarraAdd").css({'background': '#efefef'});
    $("#dvBarraAdd").css({'display': 'none'});
});


/*$(document).on('click','.editRow',function(e){
    e.preventDefault();
    var flg = $("#rowTemplate").attr("codID");
    if (typeof flg != "undefined") { $(".modal-backdrop").remove();  $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA',"<br>Tiene una fila ya en proceso de actualizacion."));  $('#dvAviso').modal('show');   return ;   }
    var RowActual = $(this).parent().parent();
    filaBase = jsFunGetRowTemplate("EDIT");
    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#tbBarraBienes").prepend(filaBase);
    $("#dvBarraAdd").css({'background': '#d9edf7'});
    $("#dvBarraAdd").css({'display': 'inherit'});

    var rwTmp = $("#rowTemplate");
    rwTmp.find("td[name=tdID]")      .html( RowActual.find("td[name=tdID]").text() );
    rwTmp.find("td[name=tdCant]")    .find('input[id=txProdCant]')      .val(RowActual.find("td[name=tdCant]").text().trim());
    rwTmp.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')     .val(RowActual.find("td[name=tdClasf]").text()) ;
    rwTmp.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(RowActual.find("td[name=tdProd]").text()) ;
    rwTmp.find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(RowActual.find("td[name=tdUnd]").text())  ;
    rwTmp.find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(RowActual.find("td[name=tdEspf]").text()) ;
    rwTmp.find("td[name=tdPrecio]")  .find('input[id=txProdPrecio]')    .val(RowActual.find("td[name=tdPrecio]").text().trim());
    rwTmp.find("td[name=tdClasf]")   .find('input[id=txProdClasf]').attr("codID",RowActual.find("td[name=tdClasf]").attr ("codID"));
    rwTmp.find("td[name=tdProd]")    .find('input[id=txProdProd]').attr("codID",RowActual.find("td[name=tdProd]").attr ("codID"));
    rwTmp.find("td[name=tdUnd]")     .find('input[id=txProdUnd]') .attr("codID",RowActual.find("td[name=tdUnd]").attr ("codID"));
    RowActual.fadeOut(700, function(){  RowActual.remove(); });

});
*/

$( document ).on( 'click' ,'.editRow ',function(e) {
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = $(this).parent().parent().html();

    flg= false ;
    $("#tbBarraBienes tr").each(function (index) {

        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(flg) {
        jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila Actual que desea ingresarse<br> <strong>Primero tiene que termina el proceso actual</strong>");
        return;
    }

    flg= false ;
    $("#tbProdBienes tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {

        $("#tbProdBienes tr").each(function() {
            if ($(this).attr("Class")=="fila-Hide" && $(this).attr("Class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });

        trCurrent.html("").append(jsFunGetRowTemplate("EDIT",$('#txCodSecFun').val())).css("background","#d9edf7").attr("trFocus","ACTIVE");
        trCurrent.find("td[name=tdID]")      .html( trClone.find("td[name=tdID]").text() );
        trCurrent.find("td[name=tdCant]")    .find('input[id=txProdCant]')    .val(trClone .find("td[name=tdCant]").text().trim());
        trCurrent.find("td[name=tdSF]")      .find('input[id=txProdSF]') .val(trClone .find('td[name=tdSF]').text().trim());
        trCurrent.find("td[name=tdRubro]")   .find('input[id=txProdRubro]') .val(trClone .find('td[name=tdRubro]').text().trim());
        trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')    .val(trClone .find("td[name=tdClasf]").text()) ;
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')    .val(trClone .find("td[name=tdProd]").text()) ;
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]')    .val(trClone .find("td[name=tdUnd]").text())  ;
        trCurrent.find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')    .val(trClone .find("td[name=tdEspf]").text()) ;
        trCurrent.find("td[name=tdPrecio]")  .find('input[id=txProdPrecio]')    .val(trClone .find("td[name=tdPrecio]").text().trim())  ;
        //trCurrent.find("td[name=tdMarca]")  .find('input[id=txProdMarca]')    .val(trClone .find("td[name=tdMarca]").text().trim());

        trCurrent.find("td[name=tdSF]")      .find('input[id=txProdSF]').attr('codID', trClone .find('td[name=tdSF]').attr('codid'));
        trCurrent.find("td[name=tdRubro]")  .find('input[id=txProdRubro]').attr('codID', trClone .find('td[name=tdRubro]').attr('codid'));
        trCurrent.find("td[name=tdClasf]")    .find('input[id=txProdClasf]').attr("codID",trClone .find("td[name=tdClasf]").attr ("codid"));
        trCurrent.find("td[name=tdProd]")     .find('input[id=txProdProd]').attr("codID",trClone .find("td[name=tdProd]").attr ("codid"));
        trCurrent.find("td[name=tdUnd]")      .find('input[id=txProdUnd]').attr("codID",trClone .find("td[name=tdUnd]").attr ("codid"));

      }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }

});


$( document ).on( 'click' ,'.atrasRow',function(e) {
    filaHide="";
    $("#tbProdBienes tr").each(function() {
        if ($(this).attr("Class")=="fila-Hide" && $(this).attr("Class")!="gsTh" )
            filaHide= $(this).html();
    });
    $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");

});


$(document).on('click','.deleteRow',function(e){
    e.preventDefault();
    var objCurrent = $(this).parent().parent();
    var flg = $("#rowTemplate").attr("codID");
    if (typeof flg != "undefined") { $(".modal-backdrop").remove();   $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA',"<br>Tiene una fila ya en proceso de actualizacion."));  $('#dvAviso').modal('show');   return ;   }

    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
    $("#divDialogCont").html("Esta seguro que desea ELIMINAR el Registro Seleccionado ?");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {

                if(!jsFunReqValidarDatos()){ return ;  }
                if(!jsFunReqValidarProd("DEL",objCurrent)){ return ;  }

                if(varDatosReq.reqOPE=="UPD")
                {
                    varDatosReqProd.OPE="DEL";
                    var fullData = {
                        'datos': varDatosReq,
                        'lista': varDatosReqProd,// JSON.parse(JSON.stringify(ItemArray)),
                        '_token': $('#tokenBtn').val()
                    }

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetReqD",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objCurrent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", objCurrent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
                        success: function (response) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();

                            if(response.msgId == 500){
                                jsFnDialogBox(400, 140, "WARNING", objCurrent, "AVISO ", response.msg);
                            }
                            else{
                                var VR = response.varReturn;
                                // console.log(VR);
                                if(VR["ReqDll"].length>0)
                                {
                                    $("#divProdBienes").html(VR["ReqDll"]);
                                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE: ITEM BORRADO'));
                                    $('#dvAviso').modal('show');
                                }
                                else {
                                    jsFnDialogBox(400, 140, "WARNING", objCurrent, "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                                }
                            }
                        }
                    });

                }
                else
                {objCurrent.fadeOut(300, function () {    objCurrent.remove();  });   $(this).dialog("close");   }
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });

});
$(document).on('click','.CancelRow',function(e){
    e.preventDefault();
    var parent = $(this).parent().parent();
    parent.fadeOut(700, function(){     parent.remove(); });
    $("#dvBarraAdd").css({'display': 'none'});
});



$(document).on('click','.updRow',function(e){ /* USE */
    e.preventDefault();
    var objEvento = $(this).parent().parent();

    if(!jsFunReqValidarDatos(objEvento )){return ; }
    if(!jsFunReqValidarProd("UPD",objEvento )){return ; }

    flg= false ;
    $("#tbBarraBienes tr").each(function (index) {

        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;
    if(flg) {
        jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila nueva que desea ingresarse<br> <strong>Primero tiene que termina el proceso actual</strong>");
        return;
    }

    if(varDatosReq.reqOPE=="UPD")
    {
        varDatosReqProd.OPE="UPD";
        var fullData = {
            'datos': varDatosReq,
            'lista': varDatosReqProd,// JSON.parse(JSON.stringify(ItemArray)),
            '_token': $('#tokenBtn').val()
        }
        $.ajax({
            type: "POST",
            url: "logistica/spLogSetReqD",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
            success: function (data) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();

                if(data.msgId == 500){
                    jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "<strong>" + data.msg + "</strong>");
                }
                else{
                    var VR = data.varReturn;
                    if (typeof VR["ReqDll"] != "undefined")
                    {
                        if(VR["ReqDll"].length>0)
                        {
                            $("#divProdBienes").html(VR["ReqDll"]);

                            if (VR["Msg"][0].Error != 0 ) {
                                jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "<br><strong>" + VR["Msg"][0].Mensaje + "</strong>");
                            }

                        }
                        else {
                            jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                        }
                    }
                    else
                    {
                        jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>" +VR[0].Mensaje + "</strong>");
                    }
                }
                    
           }
        });
    }
    else {

        fila = $("#tbProdBienes tr:last").clone(true).removeClass('fila-Hide');
        fila.find("td[name=tdID]").html(varDatosReqProd.ID);
        fila.find("td[name=tdSF]").html(varDatosReqProd.prodSfDsc);
        fila.find("td[name=tdRubro]").html(varDatosReqProd.prodRubroDsc);
        fila.find("td[name=tdCant]").html(varDatosReqProd.prodCant);
        fila.find("td[name=tdClasf]").html(varDatosReqProd.prodClasfCod);
        fila.find("td[name=tdProd]").html(varDatosReqProd.prodDsc);
        fila.find("td[name=tdUnd]").html(varDatosReqProd.prodUndAbrv);
        fila.find("td[name=tdEspf]").html(varDatosReqProd.prodEspf);
        fila.find("td[name=tdPrecio]").html(varDatosReqProd.prodPrecioUnt);
        fila.find("td[name=tdTotal]").html(varDatosReqProd.prodTotal);
        fila.find("td[name=tdSF]").attr("codID",varDatosReqProd.prodSfID);
        fila.find("td[name=tdRubro]").attr("codID",varDatosReqProd.prodRubroID);
        fila.find("td[name=tdClasf]").attr("codID", varDatosReqProd.prodClasfID);
        fila.find("td[name=tdProd]").attr("codID", varDatosReqProd.prodID);
        fila.find("td[name=tdUnd]").attr("codID", varDatosReqProd.prodUndID);

        objEvento.fadeOut(300, function () {      objEvento.remove();     });
        $("#tbProdBienes").prepend(fila);
    }
    $("#tbBarraBienes tr").each(function (index) { $(this).remove(); })  ;
    $("#dvBarraAdd").css({'background': '#efefef'});
    $("#dvBarraAdd").css({'display': 'none'});
});

function jsFunReqEnable (flg)
{
    $('#txReqNo').prop('disabled', !flg);
    $('#txFecha').prop('disabled', true);
    $('#btnTipoReq').prop('disabled', flg);
    $('#txFecha').prop('disabled', flg);
    $('#txCodDep').prop('disabled', flg);
    $('#txCodSecFun').prop('disabled', flg);
    $('#txCodSubSec').prop('disabled', flg);
    $('#txCodRubro').prop('disabled', flg);
    $('#txGlosa').prop('disabled', flg);
    $('#txLugarEnt').prop('disabled', flg);
    $('#txDNI').prop('disabled', flg);
    $('#txCondicion').prop('disabled', flg);
    $('#txObsv').prop('disabled', flg);
    $('#btnLogItem').prop('disabled', flg);
  if(flg) {
      $('#tbProdBienes tbody tr').each(function () {
          $(this).find('button[id=btnLogItemEDIT]').parent().addClass("fila-Hide");
          $(this).find('button[id=btnLogItemDEL]').parent().addClass("fila-Hide");
          $(this).find('button[id=btnLogItemEDIT]').addClass("fila-Hide");
          $(this).find('button[id=btnLogItemDEL]').addClass("fila-Hide");
      });
  }
    else
  {
      $('#tbProdBienes tbody tr').each(function () {
          $(this).find('button[id=btnLogItemEDIT]').parent().removeClass("fila-Hide");
          $(this).find('button[id=btnLogItemDEL]').parent().removeClass("fila-Hide");
          $(this).find('button[id=btnLogItemEDIT]').removeClass("fila-Hide");
          $(this).find('button[id=btnLogItemDEL]').removeClass("fila-Hide");
      });
  }
}

function jsFunReqButtons(flg)
{
    if(!flg) {
        $("#btnLogReqSave")     .addClass("fila-Hide");
        $("#btnLogReqCancel")   .addClass("fila-Hide");
        $("#btnLogReqNew")      .removeClass("fila-Hide");
        $("#btnLogReqUpd")      .removeClass("fila-Hide");
        $("#btnLogReqDel")      .removeClass("fila-Hide");
        $("#btnLogReqPrint")    .removeClass("fila-Hide");
        $("#btnLogReqBusy")    .removeClass("fila-Hide");
        $("#btnLogReqTrsh")    .removeClass("fila-Hide");
        $("#btnLogReqLeft")    .removeClass("fila-Hide");
        $("#btnLogReqRight")    .removeClass("fila-Hide");
        $("#btnLogReqSearch")    .removeClass("fila-Hide");

    }
    else {
        $("#btnLogReqSave")     .removeClass("fila-Hide");
        $("#btnLogReqCancel")   .removeClass("fila-Hide");
        $("#btnLogReqNew")      .addClass("fila-Hide");
        $("#btnLogReqUpd")      .addClass("fila-Hide");
        $("#btnLogReqDel")      .addClass("fila-Hide");
        $("#btnLogReqPrint")    .addClass("fila-Hide");
        $("#btnLogReqBusy")     .addClass("fila-Hide");
        $("#btnLogReqTrsh")     .addClass("fila-Hide");
        $("#btnLogReqLeft")     .addClass("fila-Hide");
        $("#btnLogReqRight")    .addClass("fila-Hide");
        $("#btnLogReqSearch")   .addClass("fila-Hide");
    }

}

/****************************************************************************************/
/** SECTION FUNCTION  OWN => DB *********************************************************/

function jsFunReqGetData(Tipo,valor) // USE
{
    var qry = "";
    if(Tipo=="COD")
    {
       // qry=" where cast(substring (reqcodigo,4,5) as int ) = "+valor;  RQ160003165
       // qry=" where reqid like  '00"+valor;
       qry=" and cast(substring (reqid,8,4) as int ) = "+valor;  
    }
    else if (Tipo=="ID")
    {
        qry=" and reqid = '"+valor+"'";
    }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetReqTmpII",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (data)
        {
            if(data.msgId == 500){
                jsFunReqClear();
                jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", data.msg);
            }
            else{
                var VR = data.ReturnData;

                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                $("#REQ").attr("reqEtapa",VR["Req"][0].reqEtapa);
                $("#REQ").attr("anioID",VR["Req"][0].reqAnio);
                $("#REQ").attr("reqID", VR["Req"][0].reqID);
                $("#REQ").attr("reqUsr", VR["Req"][0].reqUsrID);
                $('#txCodTipoReq').attr("tipoReqID", VR["Req"][0].reqTipoReqID);
                $('#txTipoReq').text(VR["Req"][0].reqTipoReqDsc);
                $('#txFecha').val(VR["Req"][0].reqFechaFormat);
                $('#txReqNo').val(VR["Req"][0].reqCodigo);
                $('#txEtapa').html(VR["Req"][0].reqEtapa);

                $('#txCodDep').attr('depID',VR["Req"][0].reqDepID);
                $('#txCodDep').val(VR["Req"][0].reqDepCod);
                $('#txDep').val(VR["Req"][0].reqDepDsc);
                $('#txCodSecFun').attr("secFunID",VR["Req"][0].reqSecFunID);
                $('#txCodSecFun').val(VR["Req"][0].reqSecFunCod);
                $('#txSecFun').val(VR["Req"][0].reqSecFunDsc);
                $('#txCodSubSec').attr("subSecID", VR["Req"][0].reqSubSecID);
                $('#txCodSubSec').val(VR["Req"][0].reqSubSecCod);
                $('#txSubSec').val(VR["Req"][0].reqSubSecDsc);
                $('#txCodRubro').attr("rubroID",VR["Req"][0].reqRubroID);
                $('#txCodRubro').val(VR["Req"][0].reqRubroCod);
                $('#txRubro').val(VR["Req"][0].reqRubroDsc);
                $('#txGlosa').val(VR["Req"][0].reqGlosa)
                $('#txLugarEnt').val(VR["Req"][0].reqLugarEnt);
                $('#txTipoGto').attr("tipoGtoID", VR["Req"][0].reqGtoTip);
                if (VR["Req"][0].reqGtoTip == "0") {
                    $("#r1").prop("checked", true);
                }
                else if (VR["Req"][0].reqGtoTip == "1") {
                    $("#r2").prop("checked", true);
                }
                $('#txDNI').attr("dniID",VR["Req"][0].reqSolID);
                $('#txDNI').val(VR["Req"][0].reqSolID);
                $('#txSolicitante').val(VR["Req"][0].reqSolDsc);
                $('#txCondicion').val(VR["Req"][0].reqSolCond);
                $('#txObsv').val(VR["Req"][0].reqObsv);
                $('#stxMontoReq').html("MONTO REQUERIMIENTO: <span style='font-size: 14px;'>" + VR["Req"][0].reqMonto + "</span>");

                $("#divProdBienes").html(VR["ReqDll"]);
                // $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
                // $('#dvAviso').modal('show');
                jsFunReqEnable(true);
                jsFunReqButtons(false);
            }
        }
    });

}
/****************************************************************************************/
/** SECTION FUNCTION  OWN *****************************************************************/

function jsFunReqClear()
{
    $("#REQ").attr("anioID",$(".txVarAnioEjec").val() );
    $("#REQ").attr("opeID","ADD");
    $("#REQ").attr("reqID","NN");
    $("#REQ").attr("reqUsr","NN");


    $("#REQ").attr("reqEtapa","NN");
    $('#txCodTipoReq').attr("tipoReqID","NN");
    $('#txTipoReq').text("");
    $('#txFecha').val("");
    $('#txReqNo').val("");
    $('#txEtapa').html("");

    $('#txCodDep').attr('depID', "NN");
    $('#txCodDep').val("");
    $('#txDep').val("");
    $('#txCodSecFun').attr("secFunID", "NN");
    $('#txCodSecFun').val("");
    $('#txSecFun').val("");
    $('#txCodSubSec').attr("subSecID", "NN");
    $('#txCodSubSec').val("");
    $('#txSubSec').val("");
    $('#txCodRubro').attr("rubroID", "NN");
    $('#txCodRubro').val("");
    $('#txRubro').val("");
    $('#txGlosa').val("")
    $('#txLugarEnt').val("");
    $('#txTipoGto').attr("tipoGtoID", "NN");
    $("#r1").prop("checked", false);
    $("#r2").prop("checked", false);
    $('#txDNI').attr("dniID", "NN");
    $('#txDNI').val("");
    $('#txSolicitante').val("");
    $('#txCondicion').val("");
    $('#txObsv').val("");
    $("#tbProdBienes tr").each(function() {
        if ($(this).attr("Class")!="fila-Hide" && $(this).attr("Class")!="gsTh" )
            $(this).remove();
    });
    $('#txFecha').val(moment().format('YYYY-MM-DD'));
    $('#stxMontoReq').html('');

}
function jsFunReqValidarDatos ()
{
    $(".modal-backdrop").remove();

    var reqOPE =    $("#REQ").attr("opeID");
    var reqID = $("#REQ").attr("reqID");
    var reqAnio = $("#REQ").attr("anioID");
    var reqFecha = $('#txFecha').val();
    var reqTipoReq = $('#txCodTipoReq').attr("tipoReqID");
    var reqDep = $('#txCodDep').attr("depID");
    var reqSecFun   = $('#txCodSecFun').attr("secFunID");
    var reqSubSec   = $('#txCodSubSec').attr("subSecID");
    var reqRubro    = $('#txCodRubro').attr("rubroID");
    var reqGlosa    = $('#txGlosa').val();
    var reqLugarEnt = $('#txLugarEnt').val();

    var reqTipoGto  = $('#txTipoGto').attr("tipoGtoID");
    var reqDNI      = $('#txDNI').attr("dniID");
    var reqCondicion = $('#txCondicion').val();
    var reqObsv     = $('#txObsv').val();

    var reqErrores="<p>";
    if(reqOPE=="UDP") if (typeof reqID != "undefined"){  if(reqID=="NN" ||   reqID.length<4){  reqErrores+=' <br> * Nro del Requerimiento '; } } else {  reqErrores+= ' <br> * Nro del Requerimiento ';  }
    if (typeof reqAnio != "undefined"){  if(reqAnio=="NN" ||   reqAnio.length<4){  reqErrores+=' <br> * Año '; } } else {  reqErrores+= ' <br> * Año ';  }
    if (typeof reqFecha != "undefined"){  if(reqFecha=="NN" ||   reqFecha.length<8){  reqErrores+=' <br> * Fecha '; } } else {  reqErrores+= ' <br> * Fecha ';  }
    if (typeof reqTipoReq != "undefined"){  if(reqTipoReq=="NN" ||   reqTipoReq.length<2){  reqErrores+=' <br> * Tipo de Requerimiento'; } } else {  reqErrores+= ' <br> * Tipo de Requerimiento ';  }
    if (typeof reqDep != "undefined"){  if(reqDep=="NN" ||   reqDep.length<3){  reqErrores+=' <br> * Dependencia'; } } else {  reqErrores+= ' <br> * La Dependencia  ';  }
    if (typeof reqSecFun != "undefined"){  if(reqSecFun=="NN" ||   reqSecFun.length<3){  reqErrores+=' <br> * Secuencia Funcional'; } } else {  reqErrores+= ' <br > * La Secuencia Funcional  ';  }
    if (typeof reqRubro != "undefined"){  if(reqRubro=="NN" ||   reqRubro.length<2){  reqErrores+=' <br> * Rubro '; } } else {  reqErrores+= ' <br> * Rubro ';  }
    if (typeof reqDNI != "undefined"){  if(reqDNI =="NN" ||   reqDNI .length<3){  reqErrores+=' <br> * DNI del Solicitante'; } } else {  reqErrores+= ' <br> * DNI del Solicitante  ';  }
    if (typeof reqTipoGto != "undefined"){  if(reqTipoGto =="NN" ||   reqTipoGto .length<1){  reqErrores+=' <br> * Tipo de Solicitante'; } } else {  reqErrores+= ' <br> * Tipo de Solicitante  ';  }
    if(reqGlosa.length<3){  reqErrores+=' <br> * Glosa'; }
    if(reqLugarEnt.length<3){  reqErrores+=' <br> * Lugar de Entrega'; }
    if(reqCondicion.length<3){  reqErrores+=' <br> * La Condicion del solicitante'; }

    reqErrores+="</p>";
    if(reqErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',reqErrores));  $('#dvAviso').modal('show');   return false ; }

    varDatosReq.reqOPE= reqOPE ;
    varDatosReq.reqAnio= reqAnio;
    varDatosReq.reqID = reqID;
    varDatosReq.reqFecha = reqFecha;
    varDatosReq.reqTipoReq  = reqTipoReq;
    varDatosReq.reqDep      = reqDep;
    varDatosReq.reqSecFun   = reqSecFun;
    varDatosReq.reqSubSec   = "-";
    varDatosReq.reqRubro    = reqRubro;
    varDatosReq.reqGlosa    = reqGlosa;
    varDatosReq.reqLugarEnt = reqLugarEnt;

    varDatosReq.reqTipoGto  = reqTipoGto;
    varDatosReq.reqDNI      = reqDNI;
    varDatosReq.reqCondicion = reqCondicion;
    varDatosReq.reqObsv     = reqObsv;
    varDatosReq.reqUsr     = $("#REQ").attr("reqUsr");
    varDatosReq.reqObj     = "";
    varDatosReq._token = $('#tokenBtn').val();
    return true ;

}
function jsFunReqValidarProd( tipo ,obj)
{
    $(".modal-backdrop").remove();
    if (tipo=="ADD" || tipo =="UPD") {
        var cant = parseFloat(obj.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
        var precioUnt = parseFloat(obj.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val()).toFixed(2)
        var total = parseFloat(cant * precioUnt).toFixed(4);
        var ID = parseInt(obj.find("td[name=tdID]").html().trim());
        var secfunID = obj.find("td[name=tdSF]").find('input[id=txProdSF]').attr("codID");
        var secfunDsc = obj.find("td[name=tdSF]").find('input[id=txProdSF]').val();
        var rubroID = obj.find("td[name=tdRubro]").find('input[id=txProdRubro]').attr("codID");
        var rubroDsc = obj.find("td[name=tdRubro]").find('input[id=txProdRubro]').val();
        var clasfID = obj.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID");
        var clasfCod = obj.find("td[name=tdClasf]").find('input[id=txProdClasf]').val();
        var prodID = obj.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID");
        var prodDsc = obj.find("td[name=tdProd]").find('input[id=txProdProd]').val();
        var undID = parseInt(obj.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));
        var undAbrv = obj.find("td[name=tdUnd]").find('input[id=txProdUnd]').val();
        var espf = obj.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val();
        var undTmp =   obj.find("td[name=tdUnd]").attr("codID") ;
    }
    else //if (tipo=="DEL")
    {
        var cant        = parseFloat(obj.find("td[name=tdCant]").text()).toFixed(2) ;
        var precioUnt   = parseFloat( obj.find("td[name=tdPrecio]").text()).toFixed(2)
        var total       = parseFloat( cant*precioUnt).toFixed(4);
        var ID          = parseInt(obj.find("td[name=tdID]").html().trim());
        var secfunID    = obj.find("td[name=tdSF]").attr('codID');
        var secfunDsc   = obj.find("td[name=tdSF]").text();
        var rubroID     = obj.find("td[name=tdRubro]").attr('codID');
        var rubroDsc    = obj.find("td[name=tdRubro]").text();
        var clasfID     = obj.find("td[name=tdClasf]").attr("codID");
        var clasfCod    = obj.find("td[name=tdClasf]").text();
        var prodID      = obj.find("td[name=tdProd]").attr("codID");
        var prodDsc     = obj.find("td[name=tdProd]").text();
        var undTmp      = obj.find("td[name=tdUnd]").attr("codID") ;
        var undID       = parseInt( obj.find("td[name=tdUnd]").attr("codID"));
        var undAbrv     = obj.find("td[name=tdUnd]").text() ;
        var espf        = obj.find("td[name=tdEspf]").text() ;
    }
   // alert(undID);

    var reqErrores="<p>";
    if ( cant.toString() == "NaN") {  reqErrores+=' <br> * Cantidad '; }
    if (typeof clasfID != "undefined"){  if(clasfID=="NN" ||   clasfID.length<3){  reqErrores+=' <br> * Clasificador'; } } else {  reqErrores+= ' <br> * Clasificador  ';  }
    if (typeof prodID != "undefined"){  if(prodID=="NN" ||   prodID.length<3){  reqErrores+=' <br> * Producto'; } } else {  reqErrores+= ' <br> * Producto  ';  }
   // if (isNaN(undID) )  {  reqErrores+=' <br> * Unidad';  } else {  reqErrores+= ' <br> * Unidad  ';  }
    if ( undID.toString() == "NaN"  )  {   reqErrores+=' <br> * Unidad';  } 
    if ( precioUnt.toString() == "NaN") {  reqErrores+=' <br> * Precio Unitario '; }
     // alert(undID.toString());
     // alert(undTmp);
    reqErrores+="</p>";
    if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }
    varDatosReqProd.ID= ID ;
    varDatosReqProd.OPE="ADD";
    varDatosReqProd.prodCant= cant ;
    varDatosReqProd.prodSfID = secfunID;
    varDatosReqProd.prodSfDsc = secfunDsc;
    varDatosReqProd.prodRubroID = rubroID;
    varDatosReqProd.prodRubroDsc = rubroDsc;
    varDatosReqProd.prodClasfID = clasfID ;
    varDatosReqProd.prodClasfCod = clasfCod;
    varDatosReqProd.prodID = prodID ;
    varDatosReqProd.prodDsc = prodDsc ;
    varDatosReqProd.prodUndID = undID ;
    varDatosReqProd.prodUndAbrv = undAbrv ;
    varDatosReqProd.prodEspf = espf ;
    varDatosReqProd.prodPrecioUnt = precioUnt;
    varDatosReqProd.prodTotal = total;
    //varDatosReqProd.UsrID = $("#REQ").attr("reqUsr");
    return true ;
}

/****************************************************************************************/
/** SECTION VAR GLOBALS *****************************************************************/

var varDatosReq = jQuery.parseJSON('{  ' +
'"reqAnio":"NN",' +
'"reqOPE":"NN",' +
'"reqID":"NN",' +
'"reqFecha":"NN",' +
'"reqTipoReq":"NN",' +
'"reqDep":"NN" ,' +
'"reqSecFun":"NN" ,' +
'"reqSubSec":"NN" ,' +
'"reqRubro":"NN" ,' +
'"reqGlosa":"NN" ,' +
'"reqLugarEnt":"NN" ,' +
'"reqTipoGto":"NN" ,' +
'"reqDNI":"NN" ,' +
'"reqCondicion":"NN" ,' +
'"reqObsv":"NN" ,' +
'"reqObj":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;
var varDatosReqProd = jQuery.parseJSON('{  ' +
'"ID":"0",' +
'"OPE":"0",'+
'"prodCant":"NN",' +
'"prodClasfID":"NN" ,' +
'"prodID":"NN" ,' +
'"prodUndID":"NN" ,' +
'"prodEspf":"NN" ,' +
'"prodPrecioUnt":"NN" ' +
'}  ' ) ;



/**************************************/


var opt = {
    autoOpen: false,
    modal: true,
    width: 400,
    height:140,
    draggable: true,
    show: 'fade',
    resizable: false
    //hide: 'fade'
    //dialogClass: 'main-dialog-class'

};

function jsFnDialogBox(ancho, alto ,tipo , parent,titulo,mensaje)
{
    if(tipo=="CONFIRMAR")
    {
        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:ancho ,height: alto, title: titulo});
        $("#divDialogCont").html(mensaje);
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {   parent.fadeOut(300, function () {    parent.remove();  });   $(this).dialog("close");   },
                "Cancel": function () {  $(this).dialog("close"); }    }
        });
    }
    else if (tipo=="LOAD")
    {
        $("#divDialog").dialog(opt);
        //$("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","none");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:300 ,height: 70, title: titulo});
        $("#divDialogCont").html('<br><span style="font-size: 13px;margin-left:20px;"><strong> '+mensaje+'</strong></span>');
        $("#divDialog").dialog({
            buttons: {                }

        }) ;
    }
    else if (tipo=="WARNING")
    {
        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("ui-state-warning");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:ancho ,height: alto, title:titulo});
        $("#divDialogCont").html(mensaje);
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {  $(this).dialog("close"); }

            }}) ;
    }
    else if (tipo=="ERROR")
    {
        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("ui-state-error");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:ancho ,height: alto, title:titulo});
        $("#divDialogCont").html(mensaje);
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {  $(this).dialog("close"); }

            }
        }) ;
    }
}






$( document ).on( 'click',  '#btnLogReqLeft',function(e) {
    e.preventDefault();
    jsFunDBReqLR( "L");
});


$( document ).on( 'click',  '#btnLogReqRight',function(e) {
    e.preventDefault();
    jsFunDBReqLR( "R");
});


function jsFunDBReqLR(prPosition)
{
    var token= $('#tokenBtnMain').val();
    var dataString = {'prAnio': $(".txVarAnioEjec").val(),'prPosition': prPosition, 'prCodReq':$("#REQ").attr("reqID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetReqLR",
        data: dataString,
        //  beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function (err) {
            jsFunReqClear();
            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (VR)
        {
            if(VR.msgId == 500){
                jsFunReqClear();
                jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", VR.msg);
            }
            else{
                jsFunReqGetData("ID",VR.ReturnData[0].ID);
            }
        }
    });

}

/****** FUNCTION DE SEGUIMIENTO DE DOCUMENTOS ****************************/

$(document).on('click','#btnLogReqSgSearch',function(e){
    e.preventDefault();
    $("#TblBody").html("");
    $("#divReqSegDll").html("");
    $("#lbLogReqSegDllTitle").html("");    

    tipo = $("#txReqSgBuq").attr("codID");
    valor = $("#txReqSgNro").val();
    anio = $(".txVarAnioEjec").val();
    if (typeof tipo != "undefined"){  if(tipo=="NN" ||   tipo.length<2){ $("#titleBusq").html("SELECCION EL TIPO DE BUSQUEDA"); return;}}
    else {$("#titleBusq").html("SELECCION EL TIPO DE BUSQUEDA"); return;}
    if (valor.length==0){ $("#titleBusq").html("INGRESE EL VALOR"); return;}
        $("#titleBusq").html("");
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetReqSg",
        data:{ Anio:anio, Tipo:tipo,Valor:'0'+valor,'_token': $('#tokenBtnMain').val()} ,  
          beforeSend: function () {     $('#TblBodyReqSeg').html('<tr><td colspan="30"><h2>Procesando la Consulta....</h2></td></tr>');    },    
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (VR) {         
            $("#TblBodyReqSeg").html(VR);   
            
        }
    });
});


$( document ).on( 'click', '.menu-ReqSgBusq li', function( event ) {
    var $target = $( event.currentTarget );

    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txReqSgBuq").attr("codID",TipoReq);
    return false;
});


$(document).on('click','.btnLogReqSegVer',function(e){
    e.preventDefault();
    var idReqItem = $(this).attr("reqID");
    var CodigoReqItem = $(this).attr("reqCodigo");
	 var token= $('#tokenBtnMain').val();
    var dataString = {'reqID':idReqItem ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetReqSgDll",
        data: dataString,        
        error: function () {   jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (VR)
        {			
            $("#lbLogReqSegDllTitle").html("<h3> Detalle del  Requermiento No :"+CodigoReqItem+"</h3>");
            $("#lbLogReqSegDllTitle").attr("codID",idReqItem );
           $("#divReqSegDll").html(VR); 
           $('#liAdj').click();
        }
    });
    
});


$(document).on('click','#btnLogReqSgExcel',function(e){
    e.preventDefault();

    tipo = $("#txReqSgBuq").attr("codID");
    valor = $("#txReqSgNro").val();
    anio = $(".txVarAnioEjec").val();
    if (typeof tipo != "undefined" && typeof anio != "undefined" ){  if(tipo=="NN" ||   tipo.length<2){ $("#titleBusq").html("SELECCION EL TIPO DE BUSQUEDA"); return;}}
    else {$("#titleBusq").html("SELECCION EL TIPO DE BUSQUEDA"); return;}
    if (valor.length==0){ $("#titleBusq").html("INGRESE EL VALOR"); return;}
    $("#titleBusq").html("");
    window.open("logistica/rptSegExcel/"+anio+"/"+tipo+"/"+valor, "rpt");
});

$(document).on('click','#btnLogReqSgSearchDllXls',function(e){
    e.preventDefault();

    id = $("#lbLogReqSegDllTitle").attr("codID");
   //alert(id);
  //  if (typeof tipo != "undefined" && typeof anio != "undefined" ){  if(tipo=="NN" ||   tipo.length<2){ $("#titleBusq").html("SELECCION EL TIPO DE BUSQUEDA"); return;}}
 //   else {$("#titleBusq").html("SELECCION EL TIPO DE BUSQUEDA"); return;}
  //  if (valor.length==0){ $("#titleBusq").html("INGRESE EL VALOR"); return;}
  //  $("#titleBusq").html("");
    window.open("logistica/rptSegDllExcel/"+id, "rpt");
});


/*************************************/




