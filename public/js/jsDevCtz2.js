

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




 $( document ).on( 'click', '.menu-TipoCzDoc li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txTipoCzDoc").attr("codID",TipoReq);

    if(TipoReq=="**")
    {
        $("#txCodReq").attr("codID","**");    
        $("#txCodReq").val("*********");
        $("#txCodReq").prop('disabled', true) ;       
    }
    else
    {           
        $("#txCodReq").val("");
        $("#txCodReq").prop('disabled', false) ;
          $("#txCodReq").focus();
    }
     return false;
    
});



/***************************************************************************************/
/********* SECTION EVENT SIMPLE    *****************************************************/
$( document ).on( 'click',  '.btn-ctzSelect',function(e) {
    e.preventDefault();
    idtmp = $(this).attr("codID");
    $('#modalCtzSearch').modal('hide');
    jsFunDBCtzGetData( "ID",idtmp);


});

$( document ).on( 'click',  '#btnLogCtzSearch',function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCtzSearch",
        data:{ '_token': $('#tokenBtnMain').val()} ,

        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $(".modal-backdrop").remove();
            $("#loadModalsMain").html(VR);
            $('#modalCtzSearch').modal('show');
        }
    });

   //jsFunDBCtzGetData( "COD",$("#txCtzNo").val());

});
$( document ).on( 'keydown',  '#txCtzNo',function(e) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        jsFunDBCtzGetData( "COD",$("#txCtzNo").val());

    }
});
$(document).on('click , keydown','#btnLogCtzItem',function(e) {
    e.preventDefault();
    $(".modal-backdrop").remove();
    if(!jsFunCtzVal()){return ; }
    filaBase= jsFunCtzGetRowTemplate("ADD") ;
    $("#tbCtzBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#tbCtzBarraBienes").prepend(filaBase);
    $("#dvCtzBarraAdd").css({'background': '#d9edf7'});
    $("#dvCtzBarraAdd").css({'display': 'inherit'});
});

$( document ).on( 'keydown',  '#txCodReq',function(e) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        jsFunDBReqGetData( "COD",$("#txCodReq").val(),  $(".txVarAnioEjec").val() );
    }
});

/***************************************************************************************/
/********* SECTION CLICK MAIN MENU *****************************************************/
$( document ).on( 'keydown',  '#btnLogCtzSave , #btnLogCtzCancel, #btnLogCtzUpd, #btnLogCtzDel, #btnLogCtzSearch, #btnLogCtzNew, #btnLogCtzPrint , #btnLogCtzBusy , #btnLogCtzTrsh',function(e) {
    e.preventDefault();
});
// $( document ).on( 'click',  '#btnLogCtzBusy',function(e) {
//     e.preventDefault();
//     var  Cod="NN";
//     var datos = {Anio:$(".txVarAnioEjec").val(), '_token': $('#tokenBtn').val()}
//     $.ajax({
//         type: "POST",
//         url: "logistica/spLogGetCtzBusy",
//         data: datos,
//         beforeSend: function () {jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
//         error: function () {     jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");        },
//         success: function (returnData) {
//             $(".modal-backdrop").remove();
//             Cod = returnData[0].Codigo ;
//             $("#divDialog").dialog(opt);
//             $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
//             $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
//             $("#divDialog").dialog("open");
//             $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
//             $("#divDialogCont").html("<br>Esta Seguro que desea RESERVAR el Requerimiento:<strong> "+Cod+"<strong>");
//             $("#divDialog").dialog({
//                 buttons: {
//                     "Aceptar": function () {
//
//                         var datos = {Anio:$(".txVarAnioEjec").val(), Usr: '00000','_token': $('#tokenBtn').val()}
//                         $.ajax({
//                             type: "POST",
//                             url: "logistica/spLogSetCtzBusy",
//                             data: datos,
//                             beforeSend: function () {
//                                 jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento...");
//                             },
//                             error: function () {
//                                 jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
//                             },
//                             success: function (returnData) {
//                                 $("#divDialog").dialog("close");
//                                 $(".modal-backdrop").remove();
//
//                                 if (returnData.length > 0) {
//                                     if (returnData[0].Error == "0") {
//                                         $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE <br> Se ha Reservador el Requerimiento = ' + returnData[0].Codigo));
//                                         $('#dvAviso').modal('show');
//                                     }
//                                     else {
//                                         jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>" + returnData[0].Mensaje + "</strong>");
//                                     }
//                                 }
//                                 else {
//                                     jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>No se retorno ningun registro.!</strong>");
//                                 }
//                             }
//                         });
//
//                         $(this).dialog("close");
//                     },
//                     "Cancel": function () {  $(this).dialog("close"); }    }
//             });
//
//
//         }
//     });
// });

$( document ).on( 'click',  '#btnLogCtzSave , #btnLogCtzDel , #btnLogCtzTrsh',function(e){
    e.preventDefault();
    if(!jsFunCtzVal()){return ; }
    if($(this).attr("id") =="btnLogCtzDel")  varCtz.ctzOPE="DEL" ;
    if($(this).attr("id") =="btnLogCtzTrsh")  varCtz.ctzOPE="TRH" ;

    if(!(varCtz.ctzOPE=="ADD" || varCtz.ctzOPE =="UPD"  || varCtz.ctzOPE=="DEL" ||   varCtz.ctzOPE=="TRH"  )   || varCtz.ctzOPE=="NN" )
    {
        $(".modal-backdrop").remove();
        $("#loadModals").html( jsFunLoadAviso('MENSAJE DE ERROR','Se Produjo un ERROR en la Operacion Seleccionado'));
        $('#dvAviso').modal('show');
        return;
    }
    var parentt = $(this);

    if (varCtz.ctzOPE=="ADD" || varCtz.ctzOPE =="UPD" || varCtz.ctzOPE=="DEL" ||   varCtz.ctzOPE=="TRH"    ) {

        var ItemArray = new Array();
        $('#tbCtzDll tbody tr').each(function ()
        {
            if ($(this).attr("class")!="fila-Hide")
            {
                var fila = new Object();
                fila.czItm=$(this).find("td[name=tdCzItm]").html();
                fila.rqItm=$(this).find("td[name=tdRqItm]").html();
                fila.cant= $(this).find("td[name=tdCant]").html();
                fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                fila.espf = $(this).find("td[name=tdEspf]").html();
                ItemArray.push(fila);
            }
        });
        var fullData = {
            'varCtz': varCtz,
            'varCtzDll': JSON.parse(JSON.stringify(ItemArray)),
            '_token': $('#tokenBtn').val()
        }

        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
        if (varCtz.ctzOPE=="DEL")     $("#divDialogCont").html('Esta seguro que desea ANULAR el Registro Seleccionado ? <br> Motivo : <input  id  = "txCz_Motivo" class="gs-input" style="width:280px;" />');
        else if (varCtz.ctzOPE=="TRH")     $("#divDialogCont").html('Esta seguro que desea ELIMINAR el Registro Seleccionado ? <br> Motivo : <input class="gs-input" style="width:280px;" />');
        else if (varCtz.ctzOPE=="UPD")     $("#divDialogCont").html('Esta seguro que desea ACTUALIZAR el Registro Seleccionado ? ');
        else if (varCtz.ctzOPE=="ADD")     $("#divDialogCont").html('Esta seguro que desea GUARDAR el Registro Seleccionado ? ');
        $("#divDialog").dialog({
          buttons: {
          "Aceptar": function () {
            if(  varCtz.ctzOPE =="DEL" ) varCtz.ctzObsv  = $("#txCz_Motivo").val();
             $.ajax({
            type: "POST",
            url: "logistica/spLogSetCtz",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (returnData) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                if (returnData.length > 0) {
                  //  console.log(returnData);
                    if (returnData[0].Error == "0") {
                        varCtz.ctzID = returnData[0].CtzNo;
                        jsFunCtzEnable(true);
                        jsFunCtzButtons(false);
                        $("#divDialog").dialog(opt);
                        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
                        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
                        $("#divDialog").dialog("open");
                        $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
                        $("#divDialogCont").html(returnData[0].Mensaje);
                        $("#divDialog").dialog({
                            buttons: {
                                "Aceptar": function () {           jsFunDBCtzGetData("ID",varCtz.ctzID);            }}});
                    }
                    else {  jsFnDialogBox(400, 160, "ERROR", parentt, "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>" + returnData[0].Mensaje + "</strong>"); }
                }
                else {jsFnDialogBox(400, 160, "ERROR", parentt, "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>No se retorno ningun registro.!</strong>");}
              }
            });

                },
                "Cancel": function () {
                    $(this).dialog("close");
                }
            }
        });

    }
});
$( document ).on( 'click',  '#btnLogCtzCancel',function(e) {
    e.preventDefault();
    jsFunCtzClear();
    jsFunCtzEnable(true);
    jsFunCtzButtons(false);

});
$( document ).on( 'click',  '#btnLogCtzNew',function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CZ",'_token': $('#tokenBtnMain').val() },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
        success: function (VR) { $("#txCtzNo").val( VR[0].Codigo ); }
    });

    jsFunCtzClear();
    jsFunCtzEnable(false);
    jsFunCtzButtons(true);

});
$( document ).on( 'click',  '#btnLogCtzUpd',function(e) {
    e.preventDefault();
    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 175, title: "CONFIRMAR PROCESOS"});
    $("#divDialogCont").html("Esta Seguro de Actualizar el COTIZACION Nº");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
                $("#CTZ").attr("opeID","UPD");
                jsFunCtzEnable(false);
                jsFunCtzButtons(true);
                $(this).dialog("close");
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });
});
$( document ).on( 'click',  '#btnLogCtzDel',function(e) {
    e.preventDefault();
    $("#CTZ").attr("opeID","DEL");   
});

$( document ).on( 'click',  '#btnLogCtzPrint',function(e) {
    e.preventDefault();
    if(!jsFunCtzVal()){return; }
    window.open("logistica/rptCtz/"+varCtz.ctzID+"/"+$('.txVarAnioEjec').val()+"",'width=275,height=340,scrollbars=NO,location=no');
});



$( document ).on( 'click',  '#btnLogCtzBusy',function(e) {
    e.preventDefault();
    var  Cod="NN";
    var datos = {Anio:$(".txVarAnioEjec").val(), '_token': $('#tokenBtn').val()}

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CZ",'_token': $('#tokenBtnMain').val() },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
        success: function (VR)
        {
            $(".modal-backdrop").remove();
            Cod = VR[0].Codigo ;
            $("#divDialog").dialog(opt);
            $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
            $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
            $("#divDialog").dialog("open");
            $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
            $("#divDialogCont").html("<br>Esta Seguro que desea RESERVAR la Cotizacion No:<strong> "+Cod+"<strong>");
            $("#divDialog").dialog({
                buttons: {
                    "Aceptar": function () {

                        var datos = {Anio:$(".txVarAnioEjec").val(), Usr: '00000','_token': $('#tokenBtn').val()}
                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogSetCtzBusy",
                            data: datos,
                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");                        },
                            success: function (VR) {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();
                                if (VR.length > 0) {
                                    if (VR[0].Error == "0") {
                                        $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE <br> Se ha Reservador la Cotizacion = ' + VR[0].Codigo));
                                        $('#dvAviso').modal('show');

                                        jsFunCtzClear();
                                        jsFunCtzEnable(true);
                                        jsFunCtzButtons(false);

                                        $.ajax({
                                            type: "POST",
                                            url: "logistica/spLogGetCodNext",
                                            data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CZ",'_token': $('#tokenBtnMain').val() },
                                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                                            success: function (VR) { $("#txCtzNo").val( VR[0].Codigo ); }
                                        });
                                    }
                                    else { jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>"+VR[0].Mensaje+" </strong>");                            }
                                }
                                else {  jsFnDialogBox(400, 160, "ERROR", $(this), "ERROR EN LA PETICION", "Se produjo un ERROR en la Proceso. <br><strong>No se retorno ningun registro.!</strong>"); }
                            }
                        });

                        $(this).dialog("close");
                    },
                    "Cancel": function () {  $(this).dialog("close"); }    }
            });


        }
    });
});

/********************************************************************/
/********************************************************************/

// $( document ).on( 'keydown','#txGlosa, #txLugarEnt, #txCondicion ',function(event) {
//     if(event.keyCode == 13 ) {
//         var Evento = $(this).attr('ID');
//         if (Evento == 'txGlosa') {     $("#txLugarEnt").focus();   }
//         else if (Evento == 'txLugarEnt') {  $("#txDNI").focus();   }
//         else if (Evento == 'txCondicion') {   $("#txObsv").focus();   }
//     }
// });


/***********************************************************************************/
/******* SECTION MENU REQ DLL   ****************************************************/

$(document).on('click','.btnCtzRowADD',function(e){
    e.preventDefault();
    var objEvento = $(this).parent().parent();
    if(!jsFunCtzVal(objEvento )){return ; }
    if(!jsFunCtzDllVal("ADD",objEvento )){return ; }

    fila = $("#tbCtzDll tfoot tr").clone(true).removeClass('fila-Hide');
    if(varCtz.ctzOPE=="UPD")
    {
        varCtzDll.OPE="ADD";
        varCtzDll.ID= 0 ;
        var fullData = {
            'varCtz': varCtz,
            'varCtzDll': varCtzDll,
            '_token': $('#tokenBtn').val()
        }

        $.ajax({
            type: "POST",
            url: "logistica/spLogSetCtzD",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                
                if(VR["CtzDll"].length>0)
                {                   
                    $("#divCtzProdBienes").html(VR["CtzDll"]);
                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', VR["Flg"].toString()));
                    $('#dvAviso').modal('show');
                }
                else {
                    jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                }
            }
        });

    }
    else {
        fila.find("td[name=tdCzItm]")      .html(0);
        fila.find("td[name=tdRqItm]")      .html(0);
        fila.find("td[name=tdCant]")    .html(varCtzDll.prodCant);
        fila.find("td[name=tdProd]")    .html(varCtzDll.prodDsc);
        fila.find("td[name=tdUnd]")     .html(varCtzDll.prodUndAbrv);
        fila.find("td[name=tdEspf]")    .html(varCtzDll.prodEspf);
        fila.find("td[name=tdProd]")    .attr("codID",varCtzDll.prodID);
        fila.find("td[name=tdUnd]")     .attr("codID",varCtzDll.prodUndID);
        objEvento.fadeOut(300, function () {      objEvento.remove();      });
        //$("#tbCtzDll").prepend(fila);
        $("#tbCtzDll").append(fila);
    }
    $("#tbCtzBarraBienes tr").each(function (index) {      $(this).remove();     });
    $("#dvCtzBarraAdd").css({'background': '#efefef'});
    $("#dvCtzBarraAdd").css({'display': 'none'});
});


$(document).on('click','.btnCtzRowCANCEL',function(e){
    e.preventDefault();
    var parent = $(this).parent().parent();
    parent.fadeOut(700, function(){     parent.remove(); });
    $("#dvCtzBarraAdd").css({'display': 'none'});
});


/*******  MENU REQ DLL   ****************************************************/
$(document).on('click','.btnCtzRowEDIT',function(e){
   
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();
   
    $("#tbCtzDll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {

        $("#tbCtzDll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide" && $(this).attr("class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });

        trCurrent.html("").append(jsFunCtzGetRowTemplate("UPD")).css("background","#d9edf7").attr("trFocus","ACTIVE");
        trCurrent.find("td[name=tdCzItm]")      .html(trClone.find("td[name=tdCzItm]").text());
        trCurrent.find("td[name=tdRqItm]")      .html(trClone.find("td[name=tdRqItm]").text());
        trCurrent.find("td[name=tdCant]")    .find('input[id=txProdCant]')      .val(trClone.find("td[name=tdCant]").text().trim());
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(trClone.find("td[name=tdProd]").text()) ;
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(trClone.find("td[name=tdUnd]").text())  ;
        trCurrent.find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(trClone.find("td[name=tdEspf]").text()) ;
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]').attr("codID",trClone.find("td[name=tdProd]").attr ("codID"));
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]') .attr("codID",trClone.find("td[name=tdUnd]").attr ("codID"));   
        varOCDll.OPE="UPD";
    }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }

});


$(document).on('click','.btnCtzRowDEL',function(e){
    e.preventDefault();
    var objCurrent = $(this).parent().parent();
    var flg = $("#rowCtzTmp").attr("codID");
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

                if(!jsFunCtzVal()){ return ;  }
                if(!jsFunCtzDllVal("DEL",objCurrent)){ return ;  }

                if(varCtz.ctzOPE=="UPD")
                {
                    varCtzDll.OPE="DEL";
                    var fullData = {
                        'varCtz': varCtz,
                        'varCtzDll': varCtzDll,// JSON.parse(JSON.stringify(ItemArray)),
                        '_token': $('#tokenBtn').val()
                    }

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetCtzD",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objCurrent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", objCurrent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();
                            if(VR["CtzDll"].length>0)
                            {
                                $("#divCtzProdBienes").html(VR["CtzDll"]);
                                $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
                                $('#dvAviso').modal('show');
                            }
                            else {
                                jsFnDialogBox(400, 140, "WARNING", objCurrent, "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                            }
                        }
                    });

                }
                else
                {
                    objCurrent.fadeOut(300, function () 
                        {    objCurrent.remove();  });  
                     $(this).dialog("close");   
                }
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });

});


$( document ).on( 'click' ,'.btnCtzRowATRAS',function(e) {
    filaHide="";
   
       $("#tbCtzDll tfoot tr").each(function () {
           if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
               filaHide = $(this).html();
       });
       $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");
  

});


$(document).on('click','.btnCtzRowUPD',function(e){
    e.preventDefault();
    var objEvento = $(this).parent().parent();    
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();

    if(!jsFunCtzVal(objEvento )){return ; }
    if(!jsFunCtzDllVal("UPD",objEvento )){return ; }

    if(varCtz.ctzOPE=="UPD")
    {
        varCtzDll.OPE="UPD";
        var fullData = {
            'varCtz': varCtz,
            'varCtzDll': varCtzDll,
            '_token': $('#tokenBtn').val()
        }
        $.ajax({
            type: "POST",
            url: "logistica/spLogSetCtzD",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                if(VR["CtzDll"].length>0)
                {
                    $("#divCtzProdBienes").html(VR["CtzDll"]);
                }
                else {
                    jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                }
            }
        });
    }
    else {

        $("#tbCtzDll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide"  )
                     tmp =  $(this).html();
        });
       
       if (typeof tmp == "undefined") { $(".modal-backdrop").remove();   $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA',"<br>Vuelva a Intentarlo Nuevamente."));  $('#dvAviso').modal('show');   return ;   }

        objEvento.html("").append(tmp).css("background","#d9edf7").attr("trFocus","ACTIVE");
        objEvento.find("td[name=tdCzItm]").html(varCtzDll.czItm);
        objEvento.find("td[name=tdRqItm]").html(varCtzDll.rqItm);
        objEvento.find("td[name=tdCant]").html(varCtzDll.prodCant);
        objEvento.find("td[name=tdProd]").html(varCtzDll.prodDsc);
        objEvento.find("td[name=tdUnd]").html(varCtzDll.prodUndAbrv);
        objEvento.find("td[name=tdEspf]").html(varCtzDll.prodEspf);
        objEvento.find("td[name=tdProd]").attr("codID", varCtzDll.prodID);
        objEvento.find("td[name=tdUnd]").attr("codID", varCtzDll.prodUndID);
        objEvento.removeAttr("style").removeAttr("trFocus");
        
    }
    $("#tbCtzBarraBienes tr").each(function (index) { $(this).remove(); })  ;
    $("#dvCtzBarraAdd").css({'background': '#efefef'});
    $("#dvCtzBarraAdd").css({'display': 'none'});
});

function jsFunCtzEnable (flg)
{
    $('#txCtzNo').prop('disabled', !flg);
    $('#btnLogCtzItem').prop('disabled', flg);
    $('#txCodReq').prop('disabled', flg);
    $('#txFecha').prop('disabled', flg);
    $('#txGlosa').prop('disabled', flg);
    $('#txLugarEnt').prop('disabled', flg);
    $('#txObsv').prop('disabled', flg);
    $('#btnLogItem').prop('disabled', flg);
    $('#btnTipoCzDoc').prop('disabled', flg);
    
    if(flg) {
        $('#tbCtzDll tbody tr').each(function () {
            $("#EDIT").addClass("fila-Hide");
            $("#DEL").addClass("fila-Hide");
            $(this).find('button[id=EDIT]').parent().addClass("fila-Hide");
            $(this).find('button[id=DEL]').parent().addClass("fila-Hide");
            $(this).find('button[id=EDIT]').addClass("fila-Hide");
            $(this).find('button[id=DEL]').addClass("fila-Hide");
        });
    }
    else
    {
        $('#tbCtzDll tbody tr').each(function () {
            $("#EDIT").removeClass("fila-Hide");
            $("#DEL").removeClass("fila-Hide");
            $(this).find('button[id=EDIT]').parent().removeClass("fila-Hide");
            $(this).find('button[id=DEL]').parent().removeClass("fila-Hide");
            $(this).find('button[id=EDIT]').removeClass("fila-Hide");
            $(this).find('button[id=DEL]').removeClass("fila-Hide");
        });
    }
}

function jsFunCtzButtons(flg)
{
    if(!flg) {
        $("#btnLogCtzSave")     .addClass("fila-Hide");
        $("#btnLogCtzCancel")   .addClass("fila-Hide");
        $("#btnLogCtzNew")      .removeClass("fila-Hide");
        $("#btnLogCtzUpd")      .removeClass("fila-Hide");
        $("#btnLogCtzDel")      .removeClass("fila-Hide");
        $("#btnLogCtzPrint")    .removeClass("fila-Hide");
        $("#btnLogCtzBusy")     .removeClass("fila-Hide");
        $("#btnLogCtzTrsh")     .removeClass("fila-Hide");
        $("#btnLogCtzLeft")     .removeClass("fila-Hide");
        $("#btnLogCtzRight")    .removeClass("fila-Hide");
        $("#btnLogCtzSearch")    .removeClass("fila-Hide");
    }
    else {
        $("#btnLogCtzSave")     .removeClass("fila-Hide");
        $("#btnLogCtzCancel")   .removeClass("fila-Hide");
        $("#btnLogCtzNew")      .addClass("fila-Hide");
        $("#btnLogCtzUpd")      .addClass("fila-Hide");
        $("#btnLogCtzDel")      .addClass("fila-Hide");
        $("#btnLogCtzPrint")    .addClass("fila-Hide");
        $("#btnLogCtzBusy")     .addClass("fila-Hide");
        $("#btnLogCtzTrsh")     .addClass("fila-Hide");
        $("#btnLogCtzLeft")     .addClass("fila-Hide");
        $("#btnLogCtzRight")    .addClass("fila-Hide");
        $("#btnLogCtzSearch")    .addClass("fila-Hide");
    }

}

/****************************************************************************************/
/** SECTION FUNCTION  OWN => DB *********************************************************/



function jsFunDBReqGetData(Tipo,valor)
{
    var qry = "";
    if(Tipo=="COD")
    {
        qry=" and cast(substring (reqcodigo,4,5) as int ) = "+valor;
    }
    else if (Tipo=="ID")
    {
        qry=" and reqid = '"+valor+"'";
    }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token, 'val': valor } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCtzReq",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(typeof VR.msg !== 'undefined'){
                    jsFunReqClear(); jsFnDialogBox(400, 160, "ERROR", null, "ATENCION", VR.msg);
            }
            else{
                if(VR["Req"].length>0)
                {
                    var tmpreq = $("#CTZ").attr("reqID");
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    $("#CTZ").attr("reqID", VR["Req"][0].reqID);
                    $('#txCodReq').val(VR["Req"][0].reqCodigo);
                    $('#txGlosa').val(VR["Req"][0].reqGlosa)
                    $('#txLugarEnt').val(VR["Req"][0].reqLugarEnt);
                    $("#divCtzProdBienes").html(VR["ReqDll"]);
                    if(tmpreq != $("#CTZ").attr("reqID")) { //VR["Req"][0].reqEtapa == "PROCESADO" ||
                        if ( VR["Req"][0].reqEtapa == "RESERVADO" || VR["Req"][0].reqEtapa == "ANULADO" || VR["Req"][0].reqEtapa == "ELIMINADO") {
                            jsFnDialogBox(400, 160, "ERROR", null, "RESULTADOS DE LA BUSQUEDA", "El Requerimiento se encuenta : <strong> " + VR["Req"][0].reqEtapa + "</strong> <br> Vuelva a intentarlo ");
                            jsFunCtzClear();
                            return;
                        }
                    }
                    // $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos del Requerimiento Fueron Recuperados'));
                    // $('#dvAviso').modal('show');
                }
                else
                {    jsFunReqClear(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
            }
        }
    });

}

function jsFunDBCtzGetData(Tipo,valor)
{
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (ctzcodigo,4,5) as int ) = "+valor;  }
    else if (Tipo=="ID") {   qry=" and ctzid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCtz",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunCtzClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if( VR["Ctz"].length>0 )
            {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                $("#CTZ").attr("ctzEtapa",VR["Ctz"][0].ctzEtapa);
                $("#CTZ").attr("anioID",VR["Ctz"][0].ctzAnio);
                $("#CTZ").attr("ctzID", VR["Ctz"][0].ctzID);
                $("#CTZ").attr("reqID", VR["Ctz"][0].ctzReqID);

                $('#txFecha').val(VR["Ctz"][0].ctzFechaFormat);
                $('#txCtzNo').val(VR["Ctz"][0].ctzCodigo);
                $('#txEtapa').html(VR["Ctz"][0].ctzEtapa);
                $('#txGlosa').val(VR["Ctz"][0].ctzGlosa)
                $('#txCodReq').val(VR["Ctz"][0].ctzRef);
                $('#txLugarEnt').val(VR["Ctz"][0].ctzLugarEnt);
                $('#txObsv').val(VR["Ctz"][0].ctzObsv);


                if(VR["Ctz"][0].ctzOrgDoc =="RQ")
                {
                    $('#txTipoCzDoc').attr("codID",VR["Ctz"][0].ctzOrgDoc);
                    $('#txTipoCzDoc').text("REQUERIMIENTO");
                }
                else
                {
                     $('#txTipoCzDoc').attr("codID","**");
                    $('#txTipoCzDoc').text("OTROS");
                }
                

                $("#divCtzProdBienes").html(VR["CtzDll"]);
               // $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
               // $('#dvAviso').modal('show');
                jsFunCtzEnable(true);
                jsFunCtzButtons(false);
            }
            else
            {    jsFunCtzClear(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}

        }
    });

}
/****************************************************************************************/
/** SECTION FUNCTION  OWN *****************************************************************/

function jsFunCtzClear()
{
    $("#CTZ").attr("anioID",$(".txVarAnioEjec").val() );
    $("#CTZ").attr("opeID","ADD");
    $("#CTZ").attr("ctzID","NN");
    $("#CTZ").attr("reqID","NN");
    $("#CTZ").attr("ctzEtapa","NN");
    $('#txTipoCzDoc').text("Seleccione...");
    $('#txTipoCzDoc').attr("codID","NN");
    $('#txCodReq').val("");
    $('#txFecha').val("");
    $('#txCtzNo').val("");
    $('#txEtapa').html("");
    $('#txGlosa').val("")
    $('#txLugarEnt').val("");
    $('#txObsv').val("");
    $("#tbCtzDll tr").each(function() {
        if ($(this).attr("Class")!="fila-Hide" && $(this).attr("Class")!="gsTh" )
            $(this).remove();
    });
    $('#txFecha').val(moment().format('YYYY-MM-DD'));
     $("#dvCtzBarraAdd").css({'display': 'none'});
}
function jsFunCtzVal ()
{
    $(".modal-backdrop").remove();
    var ctzOPE =    $("#CTZ").attr("opeID");
    var ctzID = $("#CTZ").attr("ctzID");
    var ctzReqID = $("#CTZ").attr("reqID");
    var ctzReqNo = $("#txCodReq").val();
    var ctzAnio = $(".txVarAnioEjec").val();
    var ctzFecha = $('#txFecha').val();
    var ctzGlosa    = $('#txGlosa').val();
    var ctzLugarEnt = $('#txLugarEnt').val();
    var ctzObsv     = $('#txObsv').val();
    var ctzOrgDoc     = $("#txTipoCzDoc").attr("codID");

    var ctzErrores="<p>";
    if(ctzOPE=="UDP") if (typeof ctzID != "undefined"){  if(ctzID=="NN" ||   ctzID.length<4){  ctzErrores+=' <br> * Nro del Requerimiento '; } } else {  ctzErrores+= ' <br> * Nro del Requerimiento ';  }
    if (typeof ctzAnio != "undefined"){  if(ctzAnio=="NN" ||   ctzAnio.length<4){  ctzErrores+=' <br> * Año '; } } else {  ctzErrores+= ' <br> * Año ';  }
    if (typeof ctzFecha != "undefined"){  if(ctzFecha=="NN" ||   ctzFecha.length<8){  ctzErrores+=' <br> * Fecha '; } } else {  ctzErrores+= ' <br> * Fecha ';  }
    if (typeof ctzReqNo != "undefined"){  if(ctzReqNo=="NN" ||   ctzReqNo.length<2){  ctzErrores+=' <br> * Referencia del Requerimiento'; } } else {  ctzErrores+= ' <br> * Referencia del Requerimiento ';  }
     //if (typeof ctzOrgDoc != "undefined"){  if(ctzOrgDoc=="NN" ||   ctzOrgDoc.length<2){  ctzErrores+=' <br> * Origen del Documento'; } } else {  ctzErrores+= ' <br> * Origen del Documento ';  }
    if (typeof ctzOrgDoc != "undefined"){  if(ctzOrgDoc=="NN" ||   ctzOrgDoc.length<2){  ctzErrores+=' <br> * Origen del Documento'; } } else {  ctzErrores+= ' <br> * Origen del Documento ';  }
    //if(ctzGlosa.length<3){  ctzErrores+=' <br> * Glosa'; }
    //if(ctzLugarEnt.length<3){  ctzErrores+=' <br> * Lugar de Entrega'; }

    /*if (typeof ctzReqID != "undefined"){
       if(ctzReqID=="NN") {    $(".modal-backdrop").remove();  $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA','Advertencia, NO existe el Requerimiento ORIGEN'));  $('#dvAviso').modal('show'); }}
    else {  $(".modal-backdrop").remove();  $("#loadModals").html( jsFunLoadAviso('ERROR DE CONFIGURACION','Error de Configuracion del Requerimiento Origen '));  $('#dvAviso').modal('show');   return false ; }
    */
    ctzErrores+="</p>";
    if(ctzErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',ctzErrores));  $('#dvAviso').modal('show');   return false ; }

    varCtz.ctzOPE= ctzOPE ;
    varCtz.ctzAnio= ctzAnio;
    varCtz.ctzID = ctzID;
    varCtz.ctzFecha = ctzFecha;
    varCtz.ctzReqID  = ctzReqID;
    varCtz.ctzRef = ctzReqNo;
    varCtz.ctzGlosa    = ctzGlosa;
    varCtz.ctzLugarEnt = ctzLugarEnt;

    varCtz.ctzObsv     = ctzObsv;

    varCtz.ctzUsr     = "000000";
    varCtz.ctzObj     = "";
    varCtz.ctzOrgDoc = ctzOrgDoc ; 
    varCtz._token = $('#tokenBtn').val();
    return true ;

}
function jsFunCtzDllVal( tipo ,obj)
{
    $(".modal-backdrop").remove();
    if (tipo=="ADD" || tipo =="UPD") {
        var cant = parseFloat(obj.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
        var czItm = parseInt(obj.find("td[name=tdCzItm]").html().trim());
        var rqItm = parseInt(obj.find("td[name=tdRqItm]").html().trim());
        var prodID = obj.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID");
        var prodDsc = obj.find("td[name=tdProd]").find('input[id=txProdProd]').val();
        var undID = parseInt(obj.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));
        var undAbrv = obj.find("td[name=tdUnd]").find('input[id=txProdUnd]').val();
        var espf = obj.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val();
    }
    else //if (tipo=="DEL")
    {
        var cant        = parseFloat(obj.find("td[name=tdCant]").text()).toFixed(2) ;
        var czItm          = parseInt(obj.find("td[name=tdCzItm]").html().trim());
        var rqItm          = parseInt(obj.find("td[name=tdRqItm]").html().trim());
        var prodID      = obj.find("td[name=tdProd]").attr("codID");
        var prodDsc     = obj.find("td[name=tdProd]").text();
        var undID       = parseInt( obj.find("td[name=tdUnd]").attr("codID"));
        var undAbrv     = obj.find("td[name=tdUnd]").text() ;
        var espf        = obj.find("td[name=tdEspf]").text() ;
    }
    var ctzErrores="<p>";
    if ( cant.toString() == "NaN") {  ctzErrores+=' <br> * Cantidad '; }
    if (typeof prodID != "undefined"){  if(prodID=="NN" ||   prodID.length<3){  ctzErrores+=' <br> * Producto'; } } else {  ctzErrores+= ' <br> * Producto  ';  }
    if (typeof undID != "undefined"){  if(undID=="NN" ||   undID.length==0){  ctzErrores+=' <br> * Unidad'; } } else {  ctzErrores+= ' <br> * Unidad  ';  }
    ctzErrores+="</p>";
    if(ctzErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',ctzErrores));  $('#dvAviso').modal('show');   return false; }
   // varCtzDll.ID= ID ;
    //varCtzDll.OPE="ADD";
    varCtzDll.czItm= czItm ;
    varCtzDll.rqItm= rqItm ;
    varCtzDll.prodCant= cant ;
    varCtzDll.prodID = prodID ;
    varCtzDll.prodDsc = prodDsc ;
    varCtzDll.prodUndID = undID ;
    varCtzDll.prodUndAbrv = undAbrv ;
    varCtzDll.prodEspf = espf ;    
    return true ;
}

/****************************************************************************************/
/** SECTION VAR GLOBALS *****************************************************************/

var varCtz = jQuery.parseJSON('{  ' +
'"ctzAnio":"NN",' +
'"ctzOPE":"NN",' +
'"ctzID":"NN",' +
'"ctzFecha":"NN",' +
'"ctzTipoReq":"NN",' +
'"ctzDep":"NN" ,' +
'"ctzSecFun":"NN" ,' +
'"ctzSubSec":"NN" ,' +
'"ctzRubro":"NN" ,' +
'"ctzGlosa":"NN" ,' +
'"ctzOrgDoc":"NN" ,' +
'"ctzLugarEnt":"NN" ,' +
'"ctzObsv":"NN" ,' +
'"ctzObj":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;
var varCtzDll = jQuery.parseJSON('{  ' +
'"czItm":"0",' +
'"rqItm":"0",' +
'"OPE":"0",'+
'"prodCant":"NN",' +
'"prodID":"NN" ,' +
'"prodUndID":"NN" ,' +
'"prodEspf":"NN" ' +
'}  ' ) ;


$( document ).on( 'click',  '#btnLogCtzLeft',function(e) {
    e.preventDefault();
    jsFunDBCtzLR( "L");
});


$( document ).on( 'click',  '#btnLogCtzRight',function(e) {
    e.preventDefault();
    jsFunDBCtzLR( "R");
});


function jsFunDBCtzLR(prPosition)
{
    var token= $('#tokenBtn').val();
    var dataString = {'prAnio': $(".txVarAnioEjec").val(),'prPosition': prPosition, 'prCodCtz':$("#CTZ").attr("ctzID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCtzLR",
        data: dataString,
      //  beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(VR[0].ID!="NN") {

                jsFunDBCtzGetData("ID",VR[0].ID);
            }
            else
            {    jsFunReqClear(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
        }
    });

}
