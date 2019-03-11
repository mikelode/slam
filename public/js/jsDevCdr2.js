var optCdr = {
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

function jsFnOrgDoc(tipo,valor) //use
{
      if(tipo =="RQ")
                {
                    $('#txTipoCdDoc').attr("codID",tipo);
                    $('#txTipoCdDoc').text("REQUERIMIENTO");                    
                }
                 else if(tipo =="CZ")
                {
                    $('#txTipoCdDoc').attr("codID",tipo);
                    $('#txTipoCdDoc').text("COTIZACION");
                }
                else
                {
                     $('#txTipoCdDoc').attr("codID","**");
                    $('#txTipoCdDoc').text("OTROS");
                }
                $('#txCC_CtzNo').val(valor);
}


$( document ).on( 'click', '.menu-TipoCdDoc li', function( event ) { //use
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txTipoCdDoc").attr("codID",TipoReq);

    if(TipoReq=="**")
    {
        $("#txCC_CtzNo").attr("codID","**");    
        $("#txCC_CtzNo").val("*********");

        //$("#txCC_CtzNo").prop('disabled', true) ;   
         //jsFnDialogBox(400, 145, "WARNING", null, "ADVERTENCIA", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");     
    }
    else
    {           
        $("#txCC_CtzNo").val("");
        $("#txCC_CtzNo").prop('disabled', false) ;
        $("#txCC_CtzNo").focus();
    }
     return false;
    
});



$( document ).on( 'keydown',  '.btn-search,.btn-cdrSelect,#btnLogCCSave , #btnLogCCCancel, #btnLogCCUpd, #btnLogCCDel, #btnLogCCSearch, #btnLogCCNew, #btnLogCCPrint , #btnLogCCBusy , #btnLogCCTrsh,    #btnLogCCRucADD,  #btnLogCCRucSave,  #btnLogCCRucCancel',function(e) {
    e.preventDefault();
});


$(document).on('click', '#btnLogCCRucSUNAT', function(e){
    $(".modal-backdrop").remove();
    var valor = $('#txRUC').val();
    var Evento = $('#txRUC').attr('name');
    fnFindRucProveedor(valor, Evento);
});

$( document ).on( 'click',  '#btnLogCCLeft',function(e) {
    e.preventDefault();
    jsFunDBCCLR( "L");
});


$( document ).on( 'click',  '#btnLogCCRight',function(e) {
    e.preventDefault();
    jsFunDBCCLR( "R");
});



$( document ).on( 'keydown',  '#txCCNo',function(e) { // use
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        if($("#txCCNo").val().length>0) {
            
                jsFunDBCC_GetData("SI","COD", $("#txCCNo").val());
            
            return;
        }
    }
});

$( document ).on( 'keydown',  '#txCC_CtzNo',function(e) { // use
    if(e.shiftKey)     {        e.preventDefault();      }
    if(e.keyCode == 13 ) {
    TipoDoc= $("#txTipoCdDoc").attr("codID");
    if (TipoDoc=="CZ" || TipoDoc=="RQ")
    {        
        if($("#CDR").attr("opeID")=="UPD")
        { 
           tmpOrgID  = $("#CDR").attr("orgID")  ;
           tmpOrgRef = $("#CDR").attr("orgRef")  ;
           tmpOrgDoc = $("#CDR").attr("orgDoc");

         
            $("#divDialog").dialog(optCdr);
            $("#divDialog").dialog(optCdr).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
            $("#divDialog").dialog(optCdr).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
            $("#divDialog").dialog("open");
            $("#divDialog").dialog({ width:400 ,height: 150, title:"CONFIRMAR OPERACION" });
            $("#divDialogCont").html( "Esta seguro de cambiar el Documento<br><strong>LOS BIENES DEL CUADRO SE ELIMINARAN</strong>");
            $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {
                    if(TipoDoc=="CZ") {
                      jsFunDBCC_CtzSetData( "COD",$("#txCC_CtzNo").val());
                    }
                    else  {
                      jsFunDBCC_ReqSetData( "COD",$("#txCC_CtzNo").val());
                    }
                    $(this).dialog("close");
                 },
                "Cancel": function () {   jsFnOrgDoc (tmpOrgDoc,tmpOrgRef);   $(this).dialog("close"); }    }
            });
        }    
        else 
        {
            $("#tabBienesList").html('');
           if(TipoDoc=="CZ") jsFunDBCC_CtzGetData( "COD",$("#txCC_CtzNo").val()); 
           else jsFunDBCC_ReqGetData( "COD",$("#txCC_CtzNo").val()); 
        } 
     }
   
       
       // if(jsFunDBCC_CtzValidar($('#CDR').attr("ctzID")) ) {
        //    jsFunCdrClear();
       // }
    }
});

$( document ).on( 'change','#rIgvSI, #rIgvNO,#rIgvRH',function(e) {
    e.preventDefault();
    if ($('#rIgvSI').is(":checked")) {  $("#txCC_IGV").attr("IGV","SI") ; }
    else if ($("#rIgvNO").is(":checked")) {       $("#txCC_IGV").attr("IGV","NO") ;  }
    else if ($("#rIgvRH").is(":checked")) {       $("#txCC_IGV").attr("IGV","RH") ;  }
    else {   $("#txCC_IGV").attr("IGV","NN") ;}
});







/***************************************************************************************/
/********* SECTION EVENT SIMPLE    *****************************************************/

$( document ).on( 'click',  '.btn-cdrSelect',function(e) {
    e.preventDefault();
    idtmp = $(this).attr("codID");
    $('#modalCCSearch').modal('hide');
    jsFunDBCC_GetData("SI", "ID",idtmp);
    $("body").css("overflow"," scroll");

});

$( document ).on( 'click',  '#btnLogCCSearch',function(e) { // use
    e.preventDefault();
  //  jsFunDBCC_GetData( "COD",$("#txCCNo").val());

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCCSearch",
        data:{ '_token': $('#tokenBtnMain').val()} ,

        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $(".modal-backdrop").remove();
            $("#loadModalsMain").html(VR);
            $('#modalCCSearch').modal('show');
        }
    });

});


/*******************************************************************/
/*******************************************************************/
$( document ).on( 'click',  '#btnLogCCNew',function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CC",'_token': $('#tokenBtnMain').val() },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
        success: function (VR) { $("#txCCNo").val( VR[0].Codigo ); }
    });

    jsFunCdrClear();
    jsFunCdrEnable(false);
    jsFunCdrButtons(true);


});

$( document ).on( 'click',  '#btnLogCCUpd',function(e) {
    e.preventDefault();
    if($("#CDR").attr("cdrID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione el Cuadro Comparativo");return ;}
    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 175, title: "CONFIRMAR PROCESOS"});
    $("#divDialogCont").html("Esta Seguro de Actualizar el Cuadro Comparativo Nº");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
                $("#CDR").attr("opeID","UPD");
                jsFunCdrEnable(false);
                jsFunCdrButtons(true);
                $(this).dialog("close");
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });
});

$( document ).on( 'click',  '#btnLogCCCancel',function(e) {
    e.preventDefault();
    jsFunCdrClear();
    jsFunCdrEnable(true);
    jsFunCdrButtons(false);

});


$(document).on('click , keydown','#btnLogCdrItem',function(e) {
    e.preventDefault();
    $(".modal-backdrop").remove();
    //if(!jsFunCtzVal()){return ; }
    filaBase= jsFunCdrGetRowTemplate("ADD") ;
    $("#tbCdrBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#tbCdrBarraBienes").prepend(filaBase);
    $("#dvCdrBarraAdd").css({'background': '#d9edf7'});
    $("#dvCdrBarraAdd").css({'display': 'inherit'});
});



/***********************************************************************************/
/************* CTRL MENU ITEM ******************************************************/

$(document).on('click','.btnCdrRowADD',function(e){
    e.preventDefault();
    var objEvento = $(this).parent().parent();
    if(!jsFunCdrVal(objEvento )){return ; }
    if(!jsFunCdrDllVal("ADD",objEvento )){return ; }

    fila = $("#tbCdr_Dll tfoot tr").clone(true).removeClass('fila-Hide');
    if(varCdr.cdrOPE=="UPD")
    {
        varCdrDll.OPE="ADD";
        varCdrDll.ID= 0 ;
        var fullData = {
            'varCdr': varCdr,
            'varCdrDll': varCdrDll,
            '_token': $('#tokenBtn').val()
        }

        $.ajax({
            type: "POST",
            url: "logistica/spLogSetCCD",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                
                if(VR["CdrDll"].length>0)
                {                   
                    $("#tabBienesList").html(VR["CdrDll"]);
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
        fila.find("td[name=tdCdItm]")      .html(0);
        fila.find("td[name=tdRqItm]")      .html(0);
        fila.find("td[name=tdRqItm]")      .html(0);
        fila.find("td[name=tdCant]")    .html(varCdrDll.prodCant);
        fila.find("td[name=tdProd]")    .html(varCdrDll.prodDsc);
        fila.find("td[name=tdUnd]")     .html(varCdrDll.prodUndAbrv);
        fila.find("td[name=tdEspf]")    .html(varCdrDll.prodEspf);
        fila.find("td[name=tdClasf]")    .html(varCdrDll.prodClasf);
        fila.find("td[name=tdProd]")    .attr("codID",varCdrDll.prodID);
        fila.find("td[name=tdUnd]")     .attr("codID",varCdrDll.prodUndID);
        fila.find("td[name=tdClasf]")     .attr("codID",varCdrDll.prodClasfID);
        objEvento.fadeOut(300, function () {      objEvento.remove();      });
        //$("#tbCtzDll").prepend(fila);
        $("#tbCdr_Dll").append(fila);
    }
    $("#tbCdrBarraBienes tr").each(function (index) {      $(this).remove();     });
    $("#dvCdrBarraAdd").css({'background': '#efefef'});
    $("#dvCdrBarraAdd").css({'display': 'none'});
});


$(document).on('click','.btnCdrRowCANCEL',function(e){
    e.preventDefault();
    var parent = $(this).parent().parent();
    parent.fadeOut(700, function(){     parent.remove(); });
    $("#dvCdrBarraAdd").css({'display': 'none'});
});


/*******  MENU REQ DLL   ***************************************************?????*/
$(document).on('click','.btnCdrRowEDIT',function(e){
   
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();
   
    $("#tbCdr_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {

        $("#tbCdr_Dll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide" && $(this).attr("class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });

        trCurrent.html("").append(jsFunCdrGetRowTemplate("UPD")).css("background","#d9edf7").attr("trFocus","ACTIVE");
        trCurrent.find("td[name=tdCdItm]")      .html(trClone.find("td[name=tdCdItm]").text());
        trCurrent.find("td[name=tdCzItm]")      .html(trClone.find("td[name=tdCzItm]").text());
        trCurrent.find("td[name=tdRqItm]")      .html(trClone.find("td[name=tdRqItm]").text());
        trCurrent.find("td[name=tdCant]")    .find('input[id=txProdCant]')      .val(trClone.find("td[name=tdCant]").text().trim());
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(trClone.find("td[name=tdProd]").text()) ;
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(trClone.find("td[name=tdUnd]").text())  ;
        trCurrent.find("td[name=tdClasf]")     .find('input[id=txProdClasf]')       .val(trClone.find("td[name=tdClasf]").text())  ;
        trCurrent.find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(trClone.find("td[name=tdEspf]").text()) ;
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]').attr("codID",trClone.find("td[name=tdProd]").attr ("codID"));
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]') .attr("codID",trClone.find("td[name=tdUnd]").attr ("codID"));   
        trCurrent.find("td[name=tdClasf]")     .find('input[id=txProdClasf]') .attr("codID",trClone.find("td[name=tdClasf]").attr ("codID"));   
        varCdrDll.OPE="UPD";
    }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }

});


$(document).on('click','.btnCdrRowDEL',function(e){
    e.preventDefault();
    var objCurrent = $(this).parent().parent();
    var flg = false;

     $("#tbCdr_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

     if (flg)
     { $(".modal-backdrop").remove();   $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA',"<br>Tiene una fila ya en proceso de actualizacion."));  $('#dvAviso').modal('show');   return ;   }

    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
    $("#divDialogCont").html("Esta seguro que desea ELIMINAR el Registro Seleccionado ?");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {

                if(!jsFunCdrVal()){ return ;  }
                if(!jsFunCdrDllVal("DEL",objCurrent)){ return ;  }

                if(varCdr.cdrOPE=="UPD")
                {
                    varCdrDll.OPE="DEL";
                    var fullData = {
                        'varCdr': varCdr,
                        'varCdrDll': varCdrDll,// JSON.parse(JSON.stringify(ItemArray)),
                        '_token': $('#tokenBtn').val()
                    }

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetCCD",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objCurrent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", objCurrent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();
                            if(VR["CdrDll"].length>0)
                            {
                                $("#tabBienesList").html(VR["CdrDll"]);
                                // $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
                                //$('#dvAviso').modal('show');
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


$( document ).on( 'click' ,'.btnCdrRowATRAS',function(e) {
    filaHide="";
   
       $("#tbCdr_Dll tfoot tr").each(function () {
           if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
               filaHide = $(this).html();
       });
       $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");
  

});


$(document).on('click','.btnCdrRowUPD',function(e){
    e.preventDefault();
    var objEvento = $(this).parent().parent();    
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();

    if(!jsFunCdrVal(objEvento )){return ; }
    if(!jsFunCdrDllVal("UPD",objEvento )){return ; }

    if(varCdr.cdrOPE=="UPD")
    {
       
        varCdrDll.OPE="UPD";
        var fullData = {
            'varCdr': varCdr,
            'varCdrDll': varCdrDll,
            '_token': $('#tokenBtn').val()
        }
        $.ajax({
            type: "POST",
            url: "logistica/spLogSetCCD",
            data: fullData,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", objEvento, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {  jsFnDialogBox(400, 145, "WARNING", objEvento, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                if(VR["CdrDll"].length>0)
                {
                   $("#tabBienesList").html(VR["CdrDll"]);
                }
                else {
                    jsFnDialogBox(400, 140, "WARNING", $(this), "AVISO ", "Este Requerimiento no tienes ningun registro</strong>");
                }
            }
        });
    }
    else {

        $("#tbCdr_Dll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide"  )
                     tmp =  $(this).html();
        });
       
       if (typeof tmp == "undefined") { $(".modal-backdrop").remove();   $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA',"<br>Vuelva a Intentarlo Nuevamente."));  $('#dvAviso').modal('show');   return ;   }

        objEvento.html("").append(tmp).css("background","#d9edf7").attr("trFocus","ACTIVE");
        objEvento.find("td[name=tdCdItm]").html(varCdrDll.cdItm);
        objEvento.find("td[name=tdCzItm]").html(varCdrDll.czItm);
        objEvento.find("td[name=tdRqItm]").html(varCdrDll.rqItm);
        objEvento.find("td[name=tdCant]").html(varCdrDll.prodCant);
        objEvento.find("td[name=tdProd]").html(varCdrDll.prodDsc);
        objEvento.find("td[name=tdUnd]").html(varCdrDll.prodUndAbrv);
        objEvento.find("td[name=tdClasf]").html(varCdrDll.prodClasf);
        objEvento.find("td[name=tdEspf]").html(varCdrDll.prodEspf);
        objEvento.find("td[name=tdProd]").attr("codID", varCdrDll.prodID);
        objEvento.find("td[name=tdUnd]").attr("codID", varCdrDll.prodUndID);
        objEvento.find("td[name=tdClasf]").attr("codID", varCdrDll.prodClasfID);
        objEvento.removeAttr("style").removeAttr("trFocus");
        
    }
    $("#tbCdrBarraBienes tr").each(function (index) { $(this).remove(); })  ;
    $("#dvCdrBarraAdd").css({'background': '#efefef'});
    $("#dvCdrBarraAdd").css({'display': 'none'});
});



/********************************************************/


$( document ).on( 'click',  '#btnLogCCSave , #btnLogCCDel',function(e){ // use
    e.preventDefault();

        if(!jsFunCdrVal()){return ; }
        if($(this).attr("id") =="btnLogCCDel")  varCdr.cdrOPE="DEL" ;

        if(!(varCdr.cdrOPE=="ADD" || varCdr.cdrOPE =="UPD"  || varCdr.cdrOPE=="DEL") || varCdr.cdrOPE=="NN" )
        {
            $(".modal-backdrop").remove();
            $("#loadModals").html( jsFunLoadAviso('MENSAJE DE ERROR','Se Produjo un ERROR en la Operacion Seleccionado'));
            $('#dvAviso').modal('show');
            return;
        }
        var parentt = $(this);

        if (varCdr.cdrOPE=="ADD" || varCdr.cdrOPE =="UPD" || varCdr.cdrOPE=="DEL" ) {

        var ItemArray = new Array();
        $('#tbCdr_Dll tbody tr').each(function ()
        {
            if ($(this).attr("class")!="fila-Hide")  {
                var fila = new Object();
                fila.cdItm= $(this).find("td[name=tdCdItm]").html();
                fila.czItm= $(this).find("td[name=tdCzItm]").html();
                fila.rqItm= $(this).find("td[name=tdRqItm]").html();
                fila.secfun = $(this).find("td[name=tdSF]").attr('codID');
                fila.rubro = $(this).find("td[name=tdRubro]").attr('codID');
                fila.cant= $(this).find("td[name=tdCant]").html();
                fila.cant= $(this).find("td[name=tdCant]").html();
                fila.cant= $(this).find("td[name=tdCant]").html();
                fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                fila.espf = $(this).find("td[name=tdEspf]").html();
                //fila.precioUnt = $(this).find("td[name=tdPrecio]").html();
                ItemArray.push(fila);
            }
        });

        var fullData = {
            'varCdr': varCdr,
            'varCdrDll' : JSON.parse(JSON.stringify(ItemArray)),
            '_token': $('#tokenBtn').val()
        }
        
        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
        if (varCdr.cdrOPE=="DEL")     $("#divDialogCont").html('Esta seguro que desea ELIMINAR el Registro Seleccionado ? <br> Motivo : <input id ="txCC_Motivo" class="gs-input" style="width:280px;" />');
        else if (varCdr.cdrOPE=="UPD")     $("#divDialogCont").html('Esta seguro que desea ACTUALIZAR el Registro Seleccionado ? ');
        else if ( varCdr.cdrOPE=="ADD")     $("#divDialogCont").html('Esta seguro que desea GUARDAR el Registro Seleccionado ? ');
        
        
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {
                    if(  varCdr.cdrOPE =="DEL" ) varCdr.cdrObsv  = $("#txCC_Motivo").val();

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetCC",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();

                            if(VR["msgId"] == 500){
                                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
                            }
                            else{
                                $("#divDialog").dialog(opt);
                                $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
                                $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
                                $("#divDialog").dialog("open");
                                $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
                                $("#divDialogCont").html(VR["Result"][0].Mensaje);
                                $("#divDialog").dialog({
                                    buttons: {
                                        "Aceptar": function () {jsFunDBCC_GetData("SI","CID",VR["Result"][0].CCNo);}
                                    }
                                });
                            }
                        }
                    });
                                
                },
                "Cancel": function () {
                    $(this).dialog("close");
                }
            }
        });                             
    }

   
  //  if(!jsFunCdrDllVal("UPD",objEvento )){return ; }
    
  //  jsFunCdrSave();
});

$( document ).on( 'click',  '#btnLogCCPrint',function(e) {
    e.preventDefault();
    if($("#CDR").attr("cdrID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione el Cuadro Comparativo");return ;}
    if(!jsFunCdrVal()){return; }
    var anio = $(".txVarAnioEjec").val();
    window.open("logistica/rptCC/"+anio+"/"+varCdr.cdrID+"",'width=275,height=340,scrollbars=NO,location=no');
});



$( document ).on( 'click',  '#btnLogCCBusy',function(e) {
    e.preventDefault();
    var  Cod="NN";
    var datos = {Anio:$(".txVarAnioEjec").val(), '_token': $('#tokenBtn').val()}

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CC",'_token': $('#tokenBtnMain').val() },
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
            $("#divDialogCont").html("<br>Esta Seguro que desea RESERVAR el Cuadro No:<strong> "+Cod+"<strong>");
            $("#divDialog").dialog({
                buttons: {
                    "Aceptar": function () {

                        var datos = {Anio:$(".txVarAnioEjec").val(), Usr: '00000','_token': $('#tokenBtn').val()}
                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogSetCCBusy",
                            data: datos,
                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");                        },
                            success: function (VR) {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();
                                if (VR.length > 0) {
                                    if (VR[0].Error == "0") {
                                        $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE <br> Se ha Reservador el Cuadro = ' + VR[0].Codigo));
                                        $('#dvAviso').modal('show');

                                        jsFunCdrClear();
                                        jsFunCdrEnable(true);
                                        jsFunCdrButtons(false);

                                        $.ajax({
                                            type: "POST",
                                            url: "logistica/spLogGetCodNext",
                                            data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CC",'_token': $('#tokenBtnMain').val() },
                                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                                            success: function (VR) { $("#txCCNo").val( VR[0].Codigo ); }
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

/********************************************************/

function jsFunCdrSave ()
{
     if(!jsFunCdrVal( )){return ; }

    var flg = false;
    var ItemArray = new Array();
    $('#tbCdr_Dll tbody tr').each(function ()
        {
            if ($(this).attr("class")!="fila-Hide")  {
                    var fila = new Object();
                    fila.ID=0;
                    fila.cdItm= $(this).find("td[name=tdCdItm]").html();
                    fila.czItm= $(this).find("td[name=tdCzItm]").html();
                    fila.rqItm= $(this).find("td[name=tdRqItm]").html();
                    fila.cant= $(this).find("td[name=tdCant]").html();
                    fila.cant= $(this).find("td[name=tdCant]").html();
                    fila.cant= $(this).find("td[name=tdCant]").html();
                    fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                    fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                    fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                    fila.espf = $(this).find("td[name=tdEspf]").html();
                    //fila.precioUnt = $(this).find("td[name=tdPrecio]").html();
                    ItemArray.push(fila);
                flg= true;
            }
        });

     var fullData = {
            'varCdr': varCdr,
            'varCdrDll': JSON.parse(JSON.stringify(ItemArray)),
            '_token': $('#tokenBtn').val()
        }

        $.ajax({
                                    type: "POST",
                                    url: "logistica/spLogSetCC",
                                    data: fullData,
                                    beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                                    error: function () {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                                    success: function (VR) {
                                        $("#divDialog").dialog("close");
                                        $(".modal-backdrop").remove();
                                        jsFunDBCC_GetData("SI","CID",VR["Result"][0].CCNo)
                                      //  $("#divDialog").dialog(opt);
                                      //  $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
                                      //  $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
                                     //   $("#divDialog").dialog("open");
                                     //   $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
                                       /* $("#divDialogCont").html(VR["Result"][0].Mensaje);
                                        $("#divDialog").dialog({
                                            buttons: {
                                                "Aceptar": function () {
                                                    //jsFunDBCC_GetData("CID",VR["Result"][0].CCNo);          
                                                 }}});*/

                                    }
        });
    //  alert("Se guardo correctamente");

}

function jsFunCdrClear()
{
    $("#CDR").attr("anioID",$(".txVarAnioEjec").val() );
    $("#CDR").attr("opeID","ADD");
    $("#CDR").attr("cdrID","NN");    
    $("#CDR").attr("fteID","NN");
    $("#CDR").attr("cdrEtapa","NN");
   
    $("#CDR").attr("orgDoc",'NN');
    $("#CDR").attr("orgID",'NN');
    $("#CDR").attr("orgRef","NN");
    
    $('#txCCNo').val("");
    $('#txCC_CtzNo').val("");
    $('#txFecha').val("");
    $('#txEtapa').html("");
    $('#txObsv').val("");

    $('#txTipoCdDoc').text("Seleccione...");
    $('#txTipoCdDoc').attr("codID","NN");

   // $('#divCCDll').html("");
    $('#txFecha').val(moment().format('YYYY-MM-DD'));

    $("#liRucAdd").css({'display': 'none'});
    $("#liBns").css({'display': 'inherit'});
    $("#liRucList").css({'display': 'inherit'});
    $("#liAdj").css({'display': 'inherit'});
    $("#liRucBns").css({'display': 'none'});

     $("#tabBienesList").html('');
     $("#tabRucAdd").html('');
     $("#tabRucBns").html('');
     $("#tabRucList").html('');
     //$("#tabAdj").html('');
}

function jsFunCdrEnable (flg)
{

    $('#btnLogCtzItem').prop('disabled', flg);
    $('#txCC_CtzNo').prop('disabled', flg);
    $('#txCCNo').prop('disabled', !flg);
    $('#txFecha').prop('disabled', flg);
    $('#txObsv').prop('disabled', flg);
    $('#btnLogCdrRucADD').prop('disabled', flg);
    $('#btnLogCdrCtgo').prop('disabled', flg);
    $('#btnLogCdrItem').prop('disabled', flg);
    $('#btnLogCdrItemClear').prop('disabled', flg);

    $('#btnTipoCdDoc').prop('disabled', flg);
    if(flg) {
        $('#tbRUCs tbody tr').each(function () {
          
            $(this).find('button[id=btnCCRucVER]').addClass("fila-Hide");
            $(this).find('button[id=btnCCRucBUENAPRO]').addClass("fila-Hide");
            $(this).find('button[id=btnCCRucEDIT]').addClass("fila-Hide");
            $(this).find('button[id=btnCCRucDEL]').addClass("fila-Hide");
        });

        $('#tbCdr_Dll tbody tr').each(function () {          
            $(this).find('button[id=btnCdrRowEDIT]').addClass("fila-Hide");
            $(this).find('button[id=btnCdrRowDEL]').addClass("fila-Hide");            
        });
    }
    else
    {
        $('#tbRUCs tbody tr').each(function () {
            $(this).find('button[id=btnCCRucVER]').removeClass("fila-Hide");
            $(this).find('button[id=btnCCRucBUENAPRO]').removeClass("fila-Hide");
            $(this).find('button[id=btnCCRucEDIT]').removeClass("fila-Hide");
            $(this).find('button[id=btnCCRucDEL]').removeClass("fila-Hide");
        });
         $('#tbCdr_Dll tbody tr').each(function () {
            $(this).find('button[id=btnCdrRowEDIT]').removeClass("fila-Hide");
            $(this).find('button[id=btnCdrRowDEL]').removeClass("fila-Hide");            
        });
    }
}

function jsFunCdrButtons(flg)
{
    if(!flg) {
        $("#btnLogCCSave")     .addClass("fila-Hide");
        $("#btnLogCCCancel")   .addClass("fila-Hide");
        $("#btnLogCCNew")      .removeClass("fila-Hide");
        $("#btnLogCCUpd")      .removeClass("fila-Hide");
        $("#btnLogCCDel")      .removeClass("fila-Hide");
        $("#btnLogCCPrint")    .removeClass("fila-Hide");
        $("#btnLogCCBusy")     .removeClass("fila-Hide");
        $("#btnLogCCLeft")     .removeClass("fila-Hide");
        $("#btnLogCCRight")     .removeClass("fila-Hide");
        $("#btnLogCCSearch")     .removeClass("fila-Hide");
    }
    else {
        $("#btnLogCCSave")     .removeClass("fila-Hide");
        $("#btnLogCCCancel")   .removeClass("fila-Hide");
        $("#btnLogCCNew")      .addClass("fila-Hide");
        $("#btnLogCCUpd")      .addClass("fila-Hide");
        $("#btnLogCCDel")      .addClass("fila-Hide");
        $("#btnLogCCPrint")    .addClass("fila-Hide");
        $("#btnLogCCBusy")     .addClass("fila-Hide");
        $("#btnLogCCLeft")     .addClass("fila-Hide");
        $("#btnLogCCRight")     .addClass("fila-Hide");
        $("#btnLogCCSearch")     .addClass("fila-Hide");
    }
}


function jsFunCdrVal ()
{
    $(".modal-backdrop").remove();
    var cdrAnio = $(".txVarAnioEjec").val();
    var cdrOPE =  $("#CDR").attr("opeID");
    var cdrID = $("#CDR").attr("cdrID");   
    var cdrFecha = $('#txFecha').val();
    var cdrFteID = $('#CDR').attr("fteID");
    var cdrObsv= $('#txObsv').val();
    var cdrJustf = $("#txAdjJustf").val();
    var cdrEje= $('#txAdjEje').val();
    var cdrLugarEnt = $("#txAdjLugarEnt").val();
    var cdrEnt = $("#txAdjPlazo").val();
    var cdrOrgDoc  = $("#txTipoCdDoc").attr("codID");
    var cdrOrgID = $("#CDR").attr("orgID");
    var cdrOrgRef     =  $('#txCC_CtzNo').val();

    var ctzErrores="<p>";
    if(cdrOPE=="UDP") if (typeof cdrID != "undefined"){  if(cdrID=="NN" ||   cdrID.length<4){  ctzErrores+=' <br> * Tipo de Operacion'; } } else {  ctzErrores+= ' <br> * Tipo de Operacion';  }
    if (typeof cdrAnio != "undefined"){  if(cdrAnio=="NN" ||   cdrAnio.length<4){  ctzErrores+=' <br> * Año '; } } else {  ctzErrores+= ' <br> * Año ';  }
    if (typeof cdrFecha != "undefined"){  if(cdrFecha =="NN" ||   cdrFecha .length<8){  ctzErrores+=' <br> * Fecha '; } } else {  ctzErrores+= ' <br> * Fecha ';  }
   // if (typeof cdrCtzID != "undefined"){  if(cdrCtzID=="NN" ||   cdrCtzID.length<2) {  ctzErrores+=' <br> * Cotizacion'; } } else {  ctzErrores+= ' <br> * Cotizacion ';  }

   /* if (typeof cdrCtzID != "undefined"){
        if(cdrCtzID=="NN") {    $(".modal-backdrop").remove();  $("#loadModals").html( jsFunLoadAviso('ADVERTENCIA','Advertencia, NO existe el Requerimiento ORIGEN'));  $('#dvAviso').modal('show'); }}
    else {  $(".modal-backdrop").remove();  $("#loadModals").html( jsFunLoadAviso('ERROR DE CONFIGURACION','Error de Configuracion del Requerimiento Origen '));  $('#dvAviso').modal('show');   return false ; }
*/
    if (typeof cdrOrgDoc != "undefined"){  if(cdrOrgDoc=="NN" ||   cdrOrgDoc.length<2){  ctzErrores+=' <br> * Origen del Documento'; } } else {  ctzErrores+= ' <br> * Origen del Documento ';  }
    ctzErrores+="</p>";
    if(ctzErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',ctzErrores));  $('#dvAviso').modal('show');   return false ; }

    
    varCdr.cdrAnio   = cdrAnio;
    varCdr.cdrOPE    = cdrOPE ;
    varCdr.cdrID     = cdrID;
    varCdr.cdrFecha  = cdrFecha;    
    varCdr.cdrFteID  = cdrFteID;
    varCdr.cdrObsv   = cdrObsv;
    //varCdr.ctzUsr    = "000000";
    varCdr.cdrJustf  =  cdrJustf;
    varCdr.cdrEnt  = cdrEnt;
    varCdr.cdrEje  = cdrEje;
    varCdr.cdrLugarEnt  = cdrLugarEnt;
    varCdr.cdrOrgID  = cdrOrgID;
    varCdr.cdrOrgDoc  = cdrOrgDoc;
    varCdr.cdrOrgRef  = cdrOrgRef;
    varCdr._token    = $('#tokenBtn').val();
   // alert(""+$("#txAdjJustf").val());
    return true ;

}


function jsFunCdrDllVal( tipo ,obj)
{
    $(".modal-backdrop").remove();
    if (tipo=="ADD" || tipo =="UPD") {
        var cant = parseFloat(obj.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
        var cdItm = parseInt(obj.find("td[name=tdCdItm]").html().trim());
        var czItm = parseInt(obj.find("td[name=tdCzItm]").html().trim());
        var rqItm = parseInt(obj.find("td[name=tdRqItm]").html().trim());
        var prodID = obj.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID");
        var prodDsc = obj.find("td[name=tdProd]").find('input[id=txProdProd]').val();
        var undID = parseInt(obj.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));
        var undAbrv = obj.find("td[name=tdUnd]").find('input[id=txProdUnd]').val();
        var espf = obj.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val();
        var clasf = obj.find("td[name=tdClasf]").find('input[id=txProdClasf]').val();
        var clasfID = obj.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID");
    }
    else //if (tipo=="DEL")
    {
        var cant        = parseFloat(obj.find("td[name=tdCant]").text()).toFixed(2) ;
        var cdItm       = parseInt(obj.find("td[name=tdCdItm]").html().trim());
        var czItm       = parseInt(obj.find("td[name=tdCzItm]").html().trim());
        var rqItm       = parseInt(obj.find("td[name=tdRqItm]").html().trim());
        var prodID      = obj.find("td[name=tdProd]").attr("codID");
        var prodDsc     = obj.find("td[name=tdProd]").text();
        var undID       = parseInt( obj.find("td[name=tdUnd]").attr("codID"));
        var undAbrv     = obj.find("td[name=tdUnd]").text() ;
        var espf        = obj.find("td[name=tdEspf]").text() ;
        var clasf       = obj.find("td[name=tdClasf]").text();
        var clasfID     = obj.find("td[name=tdClasf]").attr("codID");
    }
    var ctzErrores="<p>";
    if(tipo != 'DEL')
    {
        if ( cant.toString() == "NaN") {  ctzErrores+=' <br> * Cantidad '; }
        if (typeof prodID != "undefined"){  if(prodID=="NN" ||   prodID.length<3){  ctzErrores+=' <br> * Producto'; } } else {  ctzErrores+= ' <br> * Producto  ';  }
        if (typeof undID != "undefined"){  if(undID=="NN" ||   undID.length==0){  ctzErrores+=' <br> * Unidad'; } } else {  ctzErrores+= ' <br> * Unidad  ';  }
        if (typeof clasfID != "undefined"){  if(clasfID=="NN" ||   clasfID.length==0){  ctzErrores+=' <br> * Unidad'; } } else {  ctzErrores+= ' <br> * Clasificador  ';  }
    }
    ctzErrores+="</p>";
    if(ctzErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',ctzErrores));  $('#dvAviso').modal('show');   return false; }
  
   // varCtzDll.ID= ID ;
    varCtzDll.OPE=tipo;
    varCdrDll.cdItm= cdItm ;
    varCdrDll.czItm= czItm ;
    varCdrDll.rqItm= rqItm ;
    varCdrDll.prodCant= cant ;
    varCdrDll.prodID = prodID ;
    varCdrDll.prodDsc = prodDsc ;
    varCdrDll.prodUndID = undID ;
    varCdrDll.prodUndAbrv = undAbrv ;
    varCdrDll.prodClasf = clasf ;
    varCdrDll.prodClasfID = clasfID ;
    varCdrDll.prodEspf = espf ;    
    return true ;
}

function jsFunFteVal ()
{
    $(".modal-backdrop").remove();
    var fteAnio     = $(".txVarAnioEjec").val();
    var fteOPE      = $("#tbCCRuc").attr("fteOPE")
    var fteID       = $("#tbCCRuc").attr("fteID");
    var fteCdrID    = $('#CDR').attr("cdrID");
    var fteRuc      = $("#txRUC").val();
    var ftePlazo    = $('#txPlazo').val();
    var fteGarantia = $('#txGarantia').val();
    var fteIGV      = $('#txCC_IGV').attr("IGV");
    var fteObsv     = $('#txRucObsv').val();

    var ctzErrores="<p>";
    if(fteOPE=="UDP") if (typeof fteID != "undefined"){  if(fteID=="NN" ||   fteID.length<4){  ctzErrores+=' <br> * Nro de Fuente '; } } else {  ctzErrores+= ' <br> * Nro de Fuente ';  }
    if (typeof fteRuc != "undefined"){  if(fteRuc=="NN" ||   fteRuc.length<4){  ctzErrores+=' <br> * Ruc '; } } else {  ctzErrores+= ' <br> * Ruc ';  }
   // if (typeof ftePlazo != "undefined"){  if(ftePlazo=="NN" ||   ftePlazo.length<1){  ctzErrores+=' <br> * Plazo de Entrega'; } } else {  ctzErrores+= ' <br> * Plazo de Entrega';  }
    if (typeof fteIGV != "undefined"){  if(fteIGV=="NN" ||   fteIGV.length<1){  ctzErrores+=' <br> * IGV '; } } else {  ctzErrores+= ' <br> * IGV';  }
    

        ctzErrores+="</p>";
    if(ctzErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',ctzErrores));  $('#dvAviso').modal('show');   return false ; }

    varFte.fteOPE= fteOPE ;
    varFte.fteID= fteID;
    varFte.fteCdrID= fteCdrID;
    varFte.fteAnio= fteAnio;
    varFte.fteRuc = fteRuc;
    varFte.ftePlazo = ftePlazo;
    varFte.fteGarantia= fteGarantia;
    varFte.fteIGV = fteIGV;
    varFte.fteObsv = fteObsv;

    varFte.fteUsrID     = "000000";
    varFte._token = $('#tokenBtn').val();
    return true ;

}

/******************************************************/
/****DECLARACION DE VARIABLES *************************/



var varCdr = jQuery.parseJSON('{  ' +
'"cdrAnio":"NN",' +
'"cdrOPE":"NN",' +
'"cdrID":"NN",' +
'"cdrFecha":"NN",' +
'"cdrCtzID":"NN",' +
'"cdrObsv":"NN",' +
'"cdrFteID":"NN",' +
'"cdrUsrID":"NN"' +
'}  ' ) ;


var varCdrDll = jQuery.parseJSON('{  ' +
'"dllOPE":"NN",' +
'"dllID":"NN",' +
'"dllFteID":"NN",' +
'"dllProdID":"NN",' +
'"dllUndID":"NN",' +
'"dllClasfID":"NN",' +
'"dllPrecio":"NN" ,' +
'"dllMarca":"NN" ,' +
'"dllUsr":"NN" ,' +
'"dllEspf":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;


var varFte = jQuery.parseJSON('{  ' +
'"fteOPE":"NN",' +
'"fteID":"NN",' +
'"fteRuc":"NN",' +
'"fteAnio":"NN",' +
'"ftePlazo":"NN" ,' +
'"fteGarantia":"NN" ,' +
'"fteIGV":"NN" ,' +
'"fteCdrID":"NN" ,' +
'"fteUsrID":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;

var varFteDll = jQuery.parseJSON('{  ' +
'"dllOPE":"NN",' +
'"dllID":"NN",' +
'"dllFteID":"NN",' +
'"dllProdID":"NN",' +
'"dllUndID":"NN",' +
'"dllClasfID":"NN",' +
'"dllPrecio":"NN" ,' +
'"dllMarca":"NN" ,' +
'"dllUsr":"NN" ,' +
'"dllEspf":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;

/*******************************************************************************/
/***** SUB MENU ****************************************************************/
$( document ).on( 'click' ,'#btnLogCdrRucADD',function(e){
    e.preventDefault();
   // if($('#CDR').attr("ctzID")=="NN" || $('#CDR').attr("ctzID")== undefined) { jsFnDialogBox(400, 145, "WARNING", null, "::VERIFIQUE SUS DATOS", "Primero tiene que buscar la cotizacion relacionada"); }

    var datos = {
        'varCond': "NO",
        'varFteID':"NN",
        'varCtzID': $('#CDR').attr("ctzID"),
        '_token': $('#tokenBtn').val()
    }
    $.ajax({
        type: "GET",
        url: "logistica/vwCCRucAdd",
        data: datos,
        beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function () {
            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
        },
        success: function (VR) {
            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#tabRucAdd").html(VR["vwRuc"]);
            $("#liRucAdd").css({'display': 'inherit'});
            $("#liBns").css({'display': 'none'});
            $("#liRucList").css({'display': 'none'});
            $("#liAdj").css({'display': 'none'});
            $("#liRucBns").css({'display': 'none'});
             $('#aRucAdd').click();

        }
    });
});


$( document ).on( 'click' ,'#btnLogCdrRucSave ',function(e) { // use

    if ($("#CDR").attr("opeID")=="ADD"){  
     
        if(!jsFunCdrVal( )){return ; }

            var flg = false;
            var ItemArray = new Array();
            $('#tbCdr_Dll tbody tr').each(function ()
            {
                if ($(this).attr("class")!="fila-Hide")  {
                        var fila = new Object();
                        fila.ID=0;
                        fila.cdItm= $(this).find("td[name=tdCdItm]").html();
                        fila.czItm= $(this).find("td[name=tdCzItm]").html();
                        fila.rqItm= $(this).find("td[name=tdRqItm]").html();
                        fila.secfun= $(this).find("td[name=tdSF]").attr('codID');
                        fila.rubro = $(this).find("td[name=tdRubro]").attr('codID');
                        fila.cant= $(this).find("td[name=tdCant]").html();
                        fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                        fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                        fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                        fila.espf = $(this).find("td[name=tdEspf]").html();
                        ItemArray.push(fila);
                    flg= true;
                }
            });

            var fullData = {
                'varCdr': varCdr,
                'varCdrDll': JSON.parse(JSON.stringify(ItemArray)),
                '_token': $('#tokenBtn').val()
            }

            $.ajax({
                type: "POST",
                url: "logistica/spLogSetCC",
                data: fullData,
                // beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                error: function () {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                success: function (VR) {

                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    if(VR["msgId"] == 500){
                        jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
                    }
                    else{
                        //  jsFunDBCC_GetData("CID",VR["Result"][0].CCNo)
                        $("#CDR").attr("cdrID",VR["Result"][0].CCNo);
                        jsFunCdrEnable(false);
                        jsFunCdrButtons(true);

                        if(!jsFunFteVal()){alert("Error en los datos ingresados del RUC"); return ;}
                        var datos = {
                            'varFte': varFte,
                            '_token': $('#tokenBtn').val()
                        };

                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogSetFte",
                            data: datos,
                            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                            error: function ()      { jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                            success: function (VR)  {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();

                                if(VR["msgId"] == 500){
                                    jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
                                }
                                else{
                                    $("#tabRucList").html(VR["Fte"]);
                                }
                            }
                        });
                    }
                }
            });
        $("#CDR").attr("opeID","UPD");
    }
    else
    {
        if(!jsFunFteVal()){alert("Error en los datos ingresados del RUC"); return ;}

        var datos = {
            'varFte': varFte,
            '_token': $('#tokenBtn').val()
        };

        $.ajax({
            type: "POST",
            url: "logistica/spLogSetFte",
            data: datos,
            beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
            error: function ()      { jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR)  {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();

                if(VR["msgId"] == 500){
                    jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
                }
                else{
                    $("#tabRucList").html(VR["Fte"]);
                }
            }
        });
    }

     $("#liRucAdd").css({'display': 'none'});
     $("#liBns").css({'display': 'inherit'});
     $("#liRucList").css({'display': 'inherit'});
     $("#liAdj").css({'display': 'inherit'});
     $("#liRucBns").css({'display': 'none'});
     $('#aRucList').click();
   
});


$( document ).on( 'click' ,'#btnLogCdrRucCancel, #btnLogCdrRucBack',function(e){
    e.preventDefault();
   

    var datos = {
        'varCond': "NO",
        'varFteID':"NN",
        'varCtzID': $('#CDR').attr("cdrID"),
        '_token': $('#tokenBtn').val()
    }
    $.ajax({
        type: "GET",
        url: "logistica/spLogGetFte",
        data: datos,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function ()      {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
        success: function (VR)  {
            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#tabRucList").html(VR);
        }
    });


    $("#liRucAdd").css({'display': 'none'});
    $("#liBns").css({'display': 'inherit'});
    $("#liRucList").css({'display': 'inherit'});
    $("#liAdj").css({'display': 'inherit'});
    $("#liRucBns").css({'display': 'none'});
    $('#aRucList').click();
});



$( document ).on( 'click' ,'#btnCCRucVER',function(e){
    e.preventDefault();
    var idTmp = $(this).parent().parent().find("td[name=tdID]").html();
    var datos = {
        'varCond': "SI",
        'varFteID':idTmp,
        'varCtzID': $('#CDR').attr("ctzID"),
        '_token': $('#tokenBtn').val()
    }
    $.ajax({
        type: "GET",
        url: "logistica/vwCCRucAdd",
        data: datos,
        beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function () {
            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
        },
        success: function (VR) {
            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#tabRucAdd").html(VR["vwRuc"]);
            $("#tbCCRuc").attr("fteID", VR["Ruc"][0].fteID)
            $("#tbCCRuc").attr("fteOPE", "UPD")
            $("#txRUC").val(VR["Ruc"][0].fteRuc)
            $("#txRSocial").val(VR["Ruc"][0].fteRazon)
            $("#txPlazo").val(VR["Ruc"][0].ftePlazo)
            $("#txGarantia").val(VR["Ruc"][0].fteGarantia)
            $("#txRucObsv").val(VR["Ruc"][0].fteObsv)

            if(VR["Ruc"][0].fteIgv=="SI")    {   $("#rIgvSI").prop("checked", true) ;  $("#txCC_IGV").attr("IGV","SI");}
            else if(VR["Ruc"][0].fteIgv=="RH")    {   $("#rIgvRH").prop("checked", true) ;  $("#txCC_IGV").attr("IGV","RH");}
            else {$("#rIgvNO").prop("checked", true); $("#txCC_IGV").attr("IGV","NO");}

            $("#liRucAdd").css({'display': 'inherit'});
            $("#liBns").css({'display': 'none'});
            $("#liRucList").css({'display': 'none'});
            $("#liAdj").css({'display': 'none'});
            $("#liRucBns").css({'display': 'none'});
            $('#aRucAdd').click();

        }
    });
});



$( document ).on( 'click' ,'#btnCCRucEDIT',function(e){
    e.preventDefault();
    var idTmp = $(this).parent().parent().find("td[name=tdID]").html();
    varFte.fteID=idTmp;
    var datos = {
        'varFteID':idTmp,
        '_token': $('#tokenBtn').val()
    }
    $.ajax({
        type: "GET",
        url: "logistica/spLogGetFteD",
        data: datos,
        beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
        success: function (VR) {
            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#tabRucBns").html(VR);

            $("#liRucAdd").css({'display': 'none'});
            $("#liBns").css({'display': 'none'});
            $("#liRucList").css({'display': 'none'});
            $("#liAdj").css({'display': 'none'});
            $("#liRucBns").css({'display': 'inherit'});
            $('#aRucBns').click();

        }
    });
});

$( document ).on( 'click' ,'#btnCCRucDEL',function(e){
    e.preventDefault();
    //if(!jsFunFteVal()){alert("error"); return ;}
    var idTmp = $(this).parent().parent().find("td[name=tdID]").html();
    varFte.fteID = idTmp;
    varFte.fteOPE="DEL";
    //varFte.fteCtzID= $('#CDR').attr("cdrID");
    
    varFte.fteAnio= $(".txVarAnioEjec").val();
    varFte.fteRuc = "";
    varFte.ftePlazo = "";
    varFte.fteGarantia= "";
    varFte.fteIGV = "";
    varFte.fteObsv = "";
    varFte.fteCdrID = $('#CDR').attr("cdrID") ;
    
    var datos = {
        'varFte': varFte,
        '_token': $('#tokenBtn').val()
    }

    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
    $("#divDialogCont").html("<br>Esta Seguro que desea ELIMINAR la Propuesta:<strong> <strong>");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
            $.ajax({
                type: "POST",
                url: "logistica/spLogSetFte",
                data: datos,
                beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                error: function () {      jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                success: function (VR) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();
                    //$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', VR["Result"][0].Mensaje ));
                    //$('#dvAviso').modal('show');
                    $("#tabRucList").html(VR["Fte"]);
                     $("#liRucAdd").css({'display': 'none'});
                    $("#liBns").css({'display': 'inherit'});
                    $("#liRucList").css({'display': 'inherit'});
                    $("#liAdj").css({'display': 'inherit'});
                    $("#liRucBns").css({'display': 'none'});
                    $('#aRucList').click();

                    
            }
            });
        },
        "Cancel": function () {  $(this).dialog("close"); }    }
    });

});


$( document ).on( 'click' ,'#btnCCRucBUENAPRO',function(e){ // use
    //e.preventDefault();
    trClone = $(this).parent().parent().clone();
    var idTmp   = $(this).parent().parent().find("td[name=tdID]").html();
    var fte     = trClone.find("td[name=tdID]").html();
    var ruc     = trClone.find("td[name=tbRuc]").html();
    var rsocial = trClone.find("td[name=tbRSocial]").html();
    var igv     = trClone.find("td[name=tbIGV]").html();
    var plazo   = trClone.find("td[name=tbPlazo]").html();
    var garantia = trClone. find("td[name=tbGarantia]").html();
    var monto   = trClone.find("td[name=tbMonto]").html();

    //varCdr.cdrOPE=$('#CDR').attr("opeID");
    $('#CDR').attr("fteID", idTmp);
    if(!jsFunCdrVal()){return;}
    var datos = {
        'varCC': varCdr,
        '_token': $('#tokenBtn').val()
    };

    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400,height: 150, title: "CONFIRMAR OPERACION"});
    $("#divDialogCont").html("Esta Seguro que desea ASIGNAR LA BUENA PRO a la Propuesta:<strong> RUC: "+ruc +" , Razon Social :"+rsocial+"  </strong>");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {

               /* if(varCdr.cdrOPE=="UPD")
                {
                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetCC",
                        data: datos,
                        beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                        error: function () {      jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();
                            //$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', VR["Result"][0].Mensaje ));
                            //$('#dvAviso').modal('show');
                            //$("#divCCDll").html(VR["Fte"]);
                            jsFunDBCC_GetData("CID",varCdr.cdrID);
                            $(this).dialog("close");
                        }
                    });
                }
                else
                {
                    $("#tbAdjRuc").html(ruc);
                    $("#tbAdjRSocial").text(rsocial);
                    $("#tbAdjPlazo").text(plazo);
                    $("#tbAdjGarantia").text(garantia);
                    $("#tbAdjMonto").text(monto);
                    $("#tbAdjIGV").text(" =========="+igv+" INCLUYE IGV ============== ");
                    $("#tbAdjIGV").attr("codID",igv);
                    $("#CDR").attr("fteID", idTmp);
                    $('#liAdj').click();

                    $(this).dialog("close");
                }
                */
                $("#tbAdjRuc").html(ruc);
                $("#tbAdjRSocial").text(rsocial);
                $("#txAdjPlazo").val(plazo);
                $("#tbAdjGarantia").text(garantia);
                $("#tbAdjMonto").text(monto);
                if(igv =="SI" || igv =="NO")
                $("#tbAdjIGV").text(" =========="+igv+" INCLUYE IGV ============== ");
                else 
                    $("#tbAdjIGV").text(" ======== R.H. ======= ");
                
                $("#tbAdjIGV").attr("codID",igv);
                $("#CDR").attr("fteID", idTmp);
                // $("#tabRucList").html(VR["Fte"]);
                     $("#liRucAdd").css({'display': 'none'});
                    $("#liBns").css({'display': 'inherit'});
                    $("#liRucList").css({'display': 'inherit'});
                    $("#liAdj").css({'display': 'inherit'});
                    $("#liRucBns").css({'display': 'none'});
                    $('#aAdj').click();

                $(this).dialog("close");

            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });

});



/****************************************************************************************************************/
/********************** MENU ITEMS FTE **************************************************************************/


$( document ).on( 'click' ,'#btnLogCC_ItemEDIT ',function(e) {
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = $(this).parent().parent().html();

    $("#tbCdr_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {

        $("#tbCdr_Dll tfoot tr").each(function() {
            if ($(this).attr("Class")=="fila-Hide" && $(this).attr("Class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });


        trCurrent.html("").append(jsFunFteGetRowTemplate()).css("background","#d9edf7").attr("trFocus","ACTIVE");
        trCurrent.find("td[name=tdCdItm]")   .attr("fteID",trClone .find("td[name=tdCdItm]").attr ("fteID"));
        trCurrent.find("td[name=tdCdItm]")      .html( trClone.find("td[name=tdCdItm]").text() );
        trCurrent.find("td[name=tdCzItm]")      .html( trClone.find("td[name=tdCzItm]").text() );
        trCurrent.find("td[name=tdRqItm]")      .html( trClone.find("td[name=tdRqItm]").text() );

        trCurrent.find("td[name=tdCant]")    .html(trClone .find("td[name=tdCant]").text().trim());
        //trCurrent.find("td[name=tdCant]")  .find('input[id=txProdCant]')    .val(trClone .find("td[name=tdCant]").text().trim());
        //trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')     .val(trClone .find("td[name=tdClasf]").text()) ;
        //trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')     .attr("codID",trClone .find("td[name=tdClasf]").attr("codID")) ;
        trCurrent.find("td[name=tdClasf]")   .html(trClone .find("td[name=tdClasf]").text()) ;
        
        trCurrent.find("td[name=tdProd]")     .html(trClone .find("td[name=tdProd]").text()) ;
        //trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(trClone .find("td[name=tdProd]").text()) ;
        //trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .attr("codID",trClone .find("td[name=tdProd]").attr("codID")) ;

        trCurrent.find("td[name=tdUnd]")     .html(trClone .find("td[name=tdUnd]").text())  ;
        //trCurrent.parent().find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(trClone .find("td[name=tdUnd]").text())  ;
        //trCurrent.parent().find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .attr("codID",trClone .find("td[name=tdUnd]").attr("codID"))  ;

        trCurrent.find("td[name=tdEspf]")    .html(trClone .find("td[name=tdEspf]").text()) ;
        //trCurrent.parent().find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(trClone .find("td[name=tdEspf]").text()) ;

        trCurrent.find("td[name=tdPrecio]")  .find('input[id=txProdPrecio]')    .val(trClone .find("td[name=tdPrecio]").text().trim());
        trCurrent.find("td[name=tdMarca]")  .find('input[id=txProdMarca]')    .val(trClone .find("td[name=tdMarca]").text().trim());

        trCurrent.find("td[name=tdClasf]")   .attr("codID",trClone .find("td[name=tdClasf]").attr ("codID"));
        trCurrent.find("td[name=tdProd]")    .attr("codID",trClone .find("td[name=tdProd]").attr ("codID"));
        trCurrent.find("td[name=tdUnd]")     .attr("codID",trClone .find("td[name=tdUnd]").attr ("codID"));


        

        /******* valores extras*******/
        //trCurrent.find("td[name=tdCant]")    .find('input[id=txProdCant]')      .val(trClone .find("td[name=tdCant]").text().trim());
        //trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')     .val(trClone .find("td[name=tdClasf]").text()) ;
        //trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(trClone .find("td[name=tdProd]").text()) ;
        //trCurrent.parent().find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(trClone .find("td[name=tdUnd]").text())  ;
        //trCurrent.parent().find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(trClone .find("td[name=tdEspf]").text()) ;

        //trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]').attr("codID",trClone .find("td[name=tdClasf]").attr ("codID"));
        //trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]').attr("codID",trClone .find("td[name=tdProd]").attr ("codID"));
        //trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]') .attr("codID",trClone .find("td[name=tdUnd]").attr ("codID"));
    }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }

    $( "#txProdMarca" ).focus();
    $( "#txProdMarca" ).focus();

});

$( document ).on( 'click' ,'#btnLogCC_ItemCancel ',function(e) {
    filaHide="";
    $("#tbCdr_Dll tfoot tr").each(function() {
        if ($(this).attr("Class")=="fila-Hide" && $(this).attr("Class")!="gsTh" )
            filaHide= $(this).html();
    });
    $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");

});

$( document ).on( 'click' ,'#btnLogCC_ItemSave',function(e) { // use
    trCurrent = $(this).parent().parent();
    var trClone = $(this).parent().parent().clone();
    varFteDll.dllOPE="UPD";
    varFteDll.dllID=trClone.find("td[name=tdCdItm]").html();
    //varFteDll.dllFteID=varFte.fteID;
    varFteDll.dllFteID = trClone.find("td[name=tdCdItm]").attr("fteID");
    varFteDll.dllProdID=trClone .find("td[name=tdProd]").attr ("codID");
    varFteDll.dllUndID=trClone .find("td[name=tdUnd]").attr ("codID");
    varFteDll.dllClasfID=trClone .find("td[name=tdClasf]").attr ("codID");
    varFteDll.dllCant=trClone.find("td[name=tdCant]").html().trim();
    //varFteDll.dllProdID=trClone .find("td[name=tdProd]").attr ("codID");

    varFteDll.dllPrecio=trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val( );
    varFteDll.dllEspf=trClone.find("td[name=tdEspf]").html( );
    
    varFteDll.dllMarca=trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val( );
    varFteDll.dllUsrID="NN";
    varFte._token="-";

    var nxtrow = $(this).data('key') + 1;
     
    //alert(varFteDll.dllEspf);

    var datos = {
        varBns:varFteDll,
        '_token': $('#tokenBtn').val()
    };
    $.ajax({
        type: "post",
        url: "logistica/spLogSetFteD",
        data: datos,
        beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
        success: function (VR) {

            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            if(VR["msgId"] == 500){
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                //  $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
                // $('#dvAviso').modal('show');

                //$("#tabRucBns").html(VR["FteDll"]);
                // $("#aRucBns").click();
                //   $("#divOC_Dll").html(VR["vwDll"]);
                document.getElementById('sthMontoCC').innerHTML = "MONTO TOTAL:<span style='font-size: 14px; color:blue;'> " + VR["MontoDll"] + "</span>";

                $('#row' + nxtrow).find("input[name=txProdMarca]").focus();
            }
        }
    });
});



/********************/



function jsFunDBCC_GetData(tmp , Tipo,valor) // use
{
    $("#tabBienesList").html('');
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (cdrcodigo,4,5) as int ) = "+valor;  }
    else  {   qry=" and cdrid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCC",
        data: dataString,
        beforeSend: function () {
            jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");
        },
        error: function () {
            jsFunCdrClear();
            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
        },
        success: function (VR) {

            if(VR["msgId"] == 500){
                jsFunCdrClear();
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                if (VR["CC"].length > 0) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    $("#CDR").attr("cdrEtapa",VR["CC"][0].cdrEtapa);
                    $("#CDR").attr("anioID",VR["CC"][0].cdrAnio);
                    $("#CDR").attr("cdrID",VR["CC"][0].cdrID);
                    $("#CDR").attr("ctzID",VR["CC"][0].cdrCtzID);
                    $("#CDR").attr("reqID",VR["CC"][0].cdrReqID);
                    $("#CDR").attr("fteID",VR["CC"][0].cdrOrg);
                    $('#txEtapa').html(VR["CC"][0].cdrEtapa);
                    $('#txFecha').val(VR["CC"][0].cdrFechaFormat);
                    $('#txCCNo').val(VR["CC"][0].cdrCodigo);

                    $("#CDR").attr("orgID",VR["CC"][0].cdrOrgID);
                    $("#CDR").attr("orgDoc",VR["CC"][0].cdrOrgDoc);
                    $("#CDR").attr("orgRef",VR["CC"][0].cdrOrgRef);

                    jsFnOrgDoc(VR["CC"][0].cdrOrgDoc , VR["CC"][0].cdrOrgRef   );
                    $('#txObsv').val(VR["CC"][0].cdrObsv);
                    $("#tabBienesList").html(VR["CdrDll"]);
                    $('#aBns').click();



                    $("#tabRucList").html(VR["Fts"]);
                    $("#tabAdj").html(VR["Adj"]);

                    if (tmp=="SI" )
                    {
                        $("#CDR").attr("opeID","ADD");
                        jsFunCdrEnable(true);
                        jsFunCdrButtons(false);
                    }

                    /*     jsFunCdrEnable(true);
                         jsFunCdrButtons(false);
                         if (VR["Adj"].length > 0) {
                             $('#liBns').click();
                         }
                         else
                         {
                             jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Los datos fueron recuperados corectamente,<BR> <STRONG> PERO AUNO NO FUE ADJUDICADO</STRONG> ");

                         }*/
                }
                else {
                    jsFunCdrClear();
                    jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");

                }
            }
        }

    });

}


function jsFunDBCC_CtzGetData(Tipo,valor) // use
{
    $("#CDR").attr("orgID","NN");
    $("#CDR").attr("orgRef","NN");
    $("#CDR").attr("orgDoc","NN");
    $("#tabBienesList").html('');
    var parent = null;
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (ctzcodigo,4,5) as int ) = "+valor;  }
    else if (Tipo=="ID") {   qry=" and ctzid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCC_Ctz",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            $(".modal-backdrop").remove();

            if(VR["msgId"] == 500){
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                if( VR["Ctz"].length>0 )
                {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    /*  if(VR["Ctz"][0].ctzEtapa=="PROCESADO" || VR["Ctz"][0].ctzEtapa=="ANULADO" ) {
                          jsFnDialogBox(400, 145, "WARNING", null, "VERIFIQUE SUS DATOS - CT", "- La Cotizacion seleccionada esta <strong>"+VR["Ctz"][0].ctzEtapa+"</strong>");
                          jsFunCdrClear();
                          return;
                      }*/
                    $("#CDR").attr("orgID", VR["Ctz"][0].ctzID);
                    $("#CDR").attr("orgRef", VR["Ctz"][0].ctzCodigo);
                    $("#CDR").attr("orgDoc", "CZ");
                    $("#txCC_CtzNo").val( VR["Ctz"][0].ctzCodigo);
                    $("#tabBienesList").html(VR["CdrDll"]);

                    //  alert ( $("#CDR").attr("ctzID"));

                }
                else
                {   jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro el Numero de Cotizacion <br> Vuelva a intentarlo "); $("#divCCDll").html("");}
            }
        }
    });
}

function jsFunDBCC_ReqGetData(Tipo,valor) // use
{
    $("#CDR").attr("orgID","NN");
    $("#CDR").attr("orgRef","NN");
    $("#CDR").attr("orgDoc","NN");
    $("#tabBienesList").html('');
 
    var parent = null;
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (dbo.fnLogGetCodRq (reqID),4,5) as int ) = "+valor;  }
    else if (Tipo=="ID") {   qry=" and reqid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCC_Req",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            $(".modal-backdrop").remove();

            if(VR["msgId"] == 500){
                jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", VR["msg"]);
            }
            else{
                if( VR["Req"].length>0 )
                {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    /*  if(VR["Ctz"][0].ctzEtapa=="PROCESADO" || VR["Ctz"][0].ctzEtapa=="ANULADO" ) {
                          jsFnDialogBox(400, 145, "WARNING", null, "VERIFIQUE SUS DATOS - CT", "- La Cotizacion seleccionada esta <strong>"+VR["Ctz"][0].ctzEtapa+"</strong>");
                          jsFunCdrClear();
                          return;
                      }*/
                    $("#CDR").attr("orgID", VR["Req"][0].reqID);
                    $("#CDR").attr("orgRef", VR["Req"][0].reqCodigo);
                    $("#CDR").attr("orgDoc", "RQ");
                    $("#txCC_CtzNo").val( VR["Req"][0].reqCodigo);
                    $("#tabBienesList").html(VR["CdrDll"]);
                }
                else
                {   jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro el Numero de Cotizacion <br> Vuelva a intentarlo "); $("#divCCDll").html("");}
            }
        }
    });
}



function jsFunDBCC_CtzSetData(Tipo,valor) // use
{
    var parent = null;
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (ctzcodigo,4,5) as int ) = "+valor;  }
    else if (Tipo=="ID") {   qry=" and ctzid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCC_Ctz",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            $(".modal-backdrop").remove();

            if(VR["msgId"] == 500){
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                $("#CDR").attr("orgID","NN");
                $("#CDR").attr("orgRef","NN");
                $("#CDR").attr("orgDoc","NN");
                $("#tabBienesList").html('');

                if( VR["Ctz"].length>0 )
                {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    /*  if(VR["Ctz"][0].ctzEtapa=="PROCESADO" || VR["Ctz"][0].ctzEtapa=="ANULADO" ) {
                          jsFnDialogBox(400, 145, "WARNING", null, "VERIFIQUE SUS DATOS - CT", "- La Cotizacion seleccionada esta <strong>"+VR["Ctz"][0].ctzEtapa+"</strong>");
                          jsFunCdrClear();
                          return;
                      }*/
                    $("#CDR").attr("orgID", VR["Ctz"][0].ctzID);
                    $("#CDR").attr("orgRef", VR["Ctz"][0].ctzCodigo);
                    $("#CDR").attr("orgDoc", "CZ");
                    $("#txCC_CtzNo").val( VR["Ctz"][0].ctzCodigo);

                    $("#tabBienesList").html(VR["CdrDll"]);

                    /*************************************************/
                    if(!jsFunCdrVal( )){return ; }

                    flg = false;
                    ItemArray = new Array();
                    $('#tbCdr_Dll tbody tr').each(function ()
                    {
                        if ($(this).attr("class")!="fila-Hide")  {
                            var fila = new Object();
                            fila.ID=0;
                            fila.cdItm= $(this).find("td[name=tdCdItm]").html();
                            fila.czItm= $(this).find("td[name=tdCzItm]").html();
                            fila.rqItm= $(this).find("td[name=tdRqItm]").html();
                            fila.secfun= $(this).find("td[name=tdSF]").attr('codID');
                            fila.rubro= $(this).find("td[name=tdRubro]").attr('codID');
                            fila.cant= $(this).find("td[name=tdCant]").html();
                            fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                            fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                            fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                            fila.espf = $(this).find("td[name=tdEspf]").html();
                            //fila.precioUnt = $(this).find("td[name=tdPrecio]").html();
                            ItemArray.push(fila);
                            flg= true;
                        }
                    });

                    valor = $("#CDR").attr("cdrID");
                    qry=" and cdrid = '"+valor+"'";

                    var fullData = {
                        'prCdrID': varCdr.cdrID,
                        'prOrgID': varCdr.cdrOrgID ,
                        'prOrgDoc': varCdr.cdrOrgDoc ,
                        'prOrgRef': varCdr.cdrOrgRef ,
                        'varCdrDll': JSON.parse(JSON.stringify(ItemArray)),
                        'prAnio': $(".txVarAnioEjec").val(),
                        'prRows':' Top 1 ',
                        'prQry':qry,
                        '_token': $('#tokenBtn').val()
                    }

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetCCCz",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();

                            if(VR["msgId"] == 500){
                                jsFnDialogBox(400, 145, "WARNING", parent, VR["msg"]);
                            }
                            else{
                                jsFunDBCC_GetData("NO","CID",valor)
                            }
                        }
                    });

                }
                else
                {
                    jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro el Numero de Cotizacion <br> Vuelva a intentarlo ");
                    $("#divCCDll").html("");
                }

            }
        }
    });
}


function jsFunDBCC_ReqSetData(Tipo,valor)  // use
{
    var parent = null;
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (dbo.fnLogGetCodRq (reqID),4,5) as int ) = "+valor;  }
    else if (Tipo=="ID") {   qry=" and reqzid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCC_Req",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            $(".modal-backdrop").remove();

            if(VR["msgId"] == 500){
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                $("#CDR").attr("orgID","NN");
                $("#CDR").attr("orgRef","NN");
                $("#CDR").attr("orgDoc","NN");
                $("#tabBienesList").html('');

                if( VR["Req"].length>0 )
                {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    /*  if(VR["Ctz"][0].ctzEtapa=="PROCESADO" || VR["Ctz"][0].ctzEtapa=="ANULADO" ) {
                          jsFnDialogBox(400, 145, "WARNING", null, "VERIFIQUE SUS DATOS - CT", "- La Cotizacion seleccionada esta <strong>"+VR["Ctz"][0].ctzEtapa+"</strong>");
                          jsFunCdrClear();
                          return;
                      }*/
                    $("#CDR").attr("orgID", VR["Req"][0].reqID);
                    $("#CDR").attr("orgRef", VR["Req"][0].reqCodigo);
                    $("#CDR").attr("orgDoc", "RQ");
                    $("#txCC_CtzNo").val( VR["Req"][0].reqCodigo);
                    $("#tabBienesList").html(VR["CdrDll"]);

                    /*************************************************/
                    if(!jsFunCdrVal( )){return ; }

                    flg = false;
                    ItemArray = new Array();
                    $('#tbCdr_Dll tbody tr').each(function ()
                    {
                        if ($(this).attr("class")!="fila-Hide")  {
                            var fila = new Object();
                            fila.ID=0;
                            fila.cdItm= $(this).find("td[name=tdCdItm]").html();
                            fila.czItm= $(this).find("td[name=tdCzItm]").html();
                            fila.rqItm= $(this).find("td[name=tdRqItm]").html();
                            fila.secfun= $(this).find("td[name=tdSF]").attr('codID');
                            fila.rubro= $(this).find("td[name=tdRubro]").attr('codID');
                            fila.cant= $(this).find("td[name=tdCant]").html();
                            fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                            fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                            fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                            fila.espf = $(this).find("td[name=tdEspf]").html();
                            //fila.precioUnt = $(this).find("td[name=tdPrecio]").html();
                            ItemArray.push(fila);
                            flg= true;
                        }
                    });

                    valor = $("#CDR").attr("cdrID");
                    qry=" and cdrid = '"+valor+"'";

                    var fullData = {
                        'prCdrID': varCdr.cdrID,
                        'prOrgID': varCdr.cdrOrgID ,
                        'prOrgDoc': varCdr.cdrOrgDoc ,
                        'prOrgRef': varCdr.cdrOrgRef ,
                        'varCdrDll': JSON.parse(JSON.stringify(ItemArray)),
                        'prAnio': $(".txVarAnioEjec").val(),
                        'prRows':' Top 1 ',
                        'prQry':qry,
                        '_token': $('#tokenBtn').val()
                    }

                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetCCCz",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();

                            if(VR["msgId"] == 500){
                                jsFnDialogBox(400, 145, "WARNING", parent, VR["msg"]);
                            }
                            else{
                                jsFunDBCC_GetData("NO" ,"CID",valor)
                            }
                        }
                    });


                    //  alert ( $("#CDR").attr("ctzID"));

                }
                else
                {   jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro el Numero de Cotizacion <br> Vuelva a intentarlo "); $("#divCCDll").html("");}
            }
        }
    });
}





function jsFunDBCC_DelDll(ID)
{


}

function jsFunDBCCLR(prPosition)
{
    var token= $('#tokenBtn').val();
    var dataString = {'prAnio': $(".txVarAnioEjec").val(),'prPosition': prPosition, 'prCodCC':$("#CDR").attr("cdrID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCCLR",
        data: dataString,
        //  beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunCdrClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(VR[0].ID!="NN") {

                jsFunDBCC_GetData("SI","CID",VR[0].ID);
            }
            else
            {    jsFunCdrClear(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
        }
    });

}
