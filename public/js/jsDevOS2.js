$( document ).on( 'click', '.menu-TipoReqOS li', function( event ) {

    var $target = $(event.currentTarget);
    $target.closest('.btn-group').find('[data-bind="label"]').text($target.text()).end().children('.dropdown-toggle').dropdown('toggle');
    var TipoDoc= $target.attr("psrId");
    $('#txOS_CodTipoDoc').val("");
    $("#txOS_CodTipoDoc").attr("codID", TipoDoc);
    $("#txOS_NroDoc").val('');
    $("#txOS_NroDoc").attr("codID", 'NN');
    $("#txOS_NroDoc").focus();
    jsFunOS_ClearOrigen();
     $('#txOS_NroDoc').prop('readOnly', false);
    if(TipoDoc=="NN" ) {

    mgsTipoNN = confirm ("==================================== \n - Esta seguro que para esta O/S no tiene documento Origen \n\n\n ==================================== \n\n");
    if(mgsTipoNN)        {
         
            
            if( $("#OS").attr("opeID")  =="UPD")
            {
                $.ajax({
                type: "POST",
                url: "logistica/spLogSetOSDDel",
                data:{   'osID': $("#OS").attr("osID")  ,  '_token': $('#tokenBtnMain').val()} ,
          
                error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();  
                $('#divOS_Dll').html(VR["OsDll"]); 
                }
                
                });
            }
            else 
            {
                var dataString = {'osOPE': $("#OS").attr("opeID") ,'_token':$('#tokenBtn').val() } ;
                $.ajax({
                    type: "POST",
                    url: "logistica/vwGetTableOSDll",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                    beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                    success: function(VR) {
                        $("#divDialog").dialog("close");
                        $('#divOS_Dll').html(VR);
                    }
                    });
            }
            
            $('#txOS_NroDoc').prop('readOnly', true);
            

           
           
        }
    }
    
    return false;
});

$( document ).on( 'keydown',  '#btnLogOSSave , #btnLogOSCancel, #btnLogOSUpd, #btnLogOSDel, #btnLogOSSearch, #btnLogOSNew, #btnLogOSPrint , #btnLogOSBusy , #btnLogOSTrsh',function(e) {
    e.preventDefault();
});

$( document ).on( 'keydown',  '#txOS_No',function(e) { // use
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        jsFunDBOS_Get( "COD",$("#txOS_No").val());
    }
});

$( document ).on( 'keydown',  '#txOS_NroDoc',function(e) { // use
    if(e.shiftKey)     {        e.preventDefault();      }
    if(e.keyCode == 13 ) {
        var valor  = $("#txOS_NroDoc").val() ;
        var tipoDoc   = $("#txOS_CodTipoDoc").attr("codID") ;
        if (typeof tipoDoc == "undefined" || tipoDoc=='NN' ) {    jsFnDialogBox(400, 145, "WARNING", null, "::VERIFIQUE SUS DATOS", "Ingrese el Tipo de documento origen"); return;    }
        
        if ($("#OS").attr("opeID")=="UPD")
        {
            var mgs66 = confirm ("==================================== \n - ESTA SEGURO DE BORRAR TODOS LOS ITEM DE LA BASE DE DATOS \n \n\n==================================== \n");
            if(mgs66)
            {
                $.ajax({
                    type: "POST",
                    url: "logistica/spLogSetOSDDel",
                    data:{   'osID': $("#OS").attr("osID")  ,  '_token': $('#tokenBtnMain').val()} ,

                    error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                    success: function (VR) {
                        $("#divDialog").dialog("close");
                        $(".modal-backdrop").remove();

                        if(VR["msgId"] == 500){
                            jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", VR["msg"]);
                        }
                        else{
                            $('#divOS_Dll').html(VR["OsDll"]);

                            jsFunOS_ClearOrigen();
                            if (tipoDoc=='CC' )
                            { jsFunDBOS_CCGetData("COD",valor); }
                            else if (tipoDoc=='RQ' )
                            { jsFunDBOS_ReqGetData("COD",valor);}
                            else if (tipoDoc =='NN')    {
                                var dataString = {'osOPE': $("#OS").attr("opeID") ,'_token':$('#tokenBtn').val() } ;
                                $.ajax({
                                    type: "POST",
                                    url: "logistica/vwGetTableOSDll",
                                    data: dataString,
                                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                                    beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                                    success: function(VR) {
                                        $("#divDialog").dialog("close");
                                        // $('#divOS_Dll').html(VR);
                                    }
                                });
                                $('#txOS_NroDoc').prop('readOnly', false);
                            }
                            else { alert("Tiene que seleccionar un tipo de documento origen"); return ;}
                        }
                    }
                });
            }

        }
        else
        {

            jsFunOS_ClearOrigen();
            if (tipoDoc=='CC' )
               { jsFunDBOS_CCGetData("COD",valor); }
            else if (tipoDoc=='RQ' )
               { jsFunDBOS_ReqGetData("COD",valor);}
            else if (tipoDoc =='NN')    {
                var dataString = {'osOPE': $("#OS").attr("opeID") ,'_token':$('#tokenBtn').val() } ;
                $.ajax({
                    type: "POST",
                    url: "logistica/vwGetTableOSDll",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                    beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                    success: function(VR) {
                        $("#divDialog").dialog("close");
                        $('#divOS_Dll').html(VR);
                    }
                });
                $('#txOS_NroDoc').prop('readOnly', false);
            }
            else { alert("Tiene que seleccionar un tipo de documento origen"); return ;}
        }

       
    }
});



$( document ).on( 'click' ,'#btnLogOS_Ruc',function(e) {

});

/************************************************************************************/

/**********************************************************************************************/
/**************** EVENT BUSQ , ADD ROW A DB ***************************************************/
$( document ).on( 'keydown', '#txOS_CodDep, #txOS_CodTipoProc,#txOS_CodSecFun , #txOS_CodRubro ', function( ) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if (event.keyCode == 113) {
        var obj=$(this).attr('name') ;
        if(obj=='txOS_CodDep')   {  obj='DEP';  }
        else if(obj=='txOS_CodSecFun'){  obj='SECFUN';  }
        else if(obj=='txOS_CodRubro') {  obj='RUBRO';  }
        else if(obj=='txOS_CodTipoProc')      {  obj='TPROC';  }

        else { obj="NN"; }

        $("#loadModals").html(jsFunModalBusqudaDatos('BUSQUEDA DE DATOS'));
        $('#modalContBusqDatos').css({'width': '600px', 'height': '400px'});
        $('#modalVentBusqDatos').modal('show');
        $('#modalVentBusqDatos').attr('obj',obj);
    }
});

$( document ).on( 'keydown','#txOS_Ref, #txOS_LugarEnt',function(event) {
    if (event.keyCode == 13) {
        var Evento = $(this).attr('name');
        if(Evento=='txOS_Ref' )   {$("#txOS_CodTipoProc").focus();}
        else if(Evento=='txOS_LugarEnt' ){   $("#txOS_Ref").focus();}
    }
});

$( document ).on( 'keydown','#txOS_CodDep, #txOS_CodTipoProc,#txOS_CodSecFun , #txOS_CodRubro  ',function(event) {
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
        var tipo="nn";
        var token = $('#tokenBtn').val();
        var Evento = $(this).attr('name');
        var Flg = false ;

        if(Evento=='txOS_CodDep' )   {  obj='DEP'; tipo='COD';  }
        else if(Evento=='txOS_CodSecFun'){  obj='SECFUN'; tipo='COD'; }
        else if(Evento=='txOS_CodRubro') {  obj='RUBRO';  tipo='COD';}
        else if(Evento=='txOS_CodTipoProc')      {  obj='TPROC';  tipo='COD';}
        else {  $(".modal-backdrop").remove();  obj="NN"; $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encuentra dentro de los parametros establecidos'));  $('#dvAviso').modal('show');   }

        var dataString = {'anio':$(".txVarAnioEjec").val(),'obj':obj,'tipo': tipo ,'valor':valor,'_token':token } ;
        $.ajax({
            type: "POST",
            url: "logistica/spLogGetDatos",
            data: dataString,
            beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
            error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
            success: function(data) {
                $("#divDialog").dialog("close");
                // $('#dvWait').modal('hide');
                // $('#dvAviso').modal('hide');
                $(".modal-backdrop").remove();
                if( data.length>0 ) {
                    Flg = true;
                    id = data[0].ID;
                    cod = data[0].Cod;
                    dsc = data[0].Dsc;
                    if (id == null) {  Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor 1'));  $('#dvAviso').modal('show');   }
                }
                else { Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show'); }

                if(Evento=='txOS_CodDep')
                {
                    if (Flg==false) {   $('#txOS_CodDep').attr('codID','NN');  $('#txOS_CodDep').val('');  $('#txOS_Dep').val('');    $( "#txOS_CodDep" ).focus(); }
                    else      {   $('#txOS_CodDep').attr('codID',id);    $('#txOS_CodDep').val(cod); $('#txOS_Dep').val(dsc);   $( "#txOS_CodSecFun" ).focus();  }
                }
                else if(Evento=='txOS_CodSecFun')
                {
                    if (Flg==false) {  $('#txOS_CodSecFun').attr('codID','NN');  $('#txOS_CodSecFun').val('');  $('#txOS_SecFun').val('');    $( "#txOS_CodSecFun" ).focus(); }
                    else      {  $('#txOS_CodSecFun').attr('codID',id);    $('#txOS_CodSecFun').val(cod); $('#txOS_SecFun').val(dsc);   $( "#txOS_CodRubro" ).focus();  }
                }
                else if(Evento=='txOS_CodRubro')
                {
                    if (Flg==false) {  $('#txOS_CodRubro').attr('codID','NN');  $('#txOS_CodRubro').val('');  $('#txOS_Rubro').val('');    $( "#txOS_CodRubro" ).focus(); }
                    else      {  $('#txOS_CodRubro').attr('codID',id);    $('#txOS_CodRubro').val(cod); $('#txOS_Rubro').val(dsc);   $( "#txOS_LugarEnt" ).focus();  }
                }
                else if(Evento=='txOS_CodTipoProc')
                {
                    if (Flg==false) {  $('#txOS_CodTipoProc').attr('codID','NN');  $('#txOS_CodTipoProc').val('');  $('#txOS_TipoProc').val('');    $( "#txOS_CodTipoProc" ).focus(); }
                    else      {  $('#txOS_CodTipoProc').attr('codID',id);    $('#txOS_CodTipoProc').val(cod); $('#txOS_TipoProc').val(dsc);   $( "#txObsv" ).focus();  }
                }



                else {obj="NN";}
            }
        });
    }
    if (event.keyCode == 46 || event.keyCode == 8  || event.keyCode == 37 || event.keyCode == 39    ){  }
    else {
        if (event.keyCode < 95) {   if (event.keyCode < 48 || event.keyCode > 57) {      event.preventDefault();      }     }
        else {   if (event.keyCode < 96 || event.keyCode > 105) {     event.preventDefault();    }        }
    }
});

/************************************************************************************/
/************************************************************************************/

$( document ).on( 'click',  '.btn-osSelect',function(e) {
    e.preventDefault();
    idtmp = $(this).attr("codID");
    $('#modalOSSearch').modal('hide');
    jsFunDBOS_Get( "ID",idtmp);
    $("body").css("overflow"," scroll");



});

$( document ).on( 'click',  '#btnLogOSSearch',function(e) {
    e.preventDefault();
  //  jsFunDBOS_Get( "COD",$("#txOS_No").val());
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOSSearch",
        data:{ '_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $(".modal-backdrop").remove();
            $("#loadModalsMain").html(VR);
            $('#modalOSSearch').modal('show');
        }
    });
});

$( document ).on( 'click',  '#btnLogOSSave , #btnLogOSDel',function(e){ // use
    e.preventDefault();
    if(!jsFunOS_Val()){return ; }
    if($(this).attr("id") =="btnLogOSDel")  varOS.osOPE="DEL" ;

    if(!(varOS.osOPE=="ADD" || varOS.osOPE =="UPD"  || varOS.osOPE=="DEL") || varOS.osOPE=="NN" )
    {
        $(".modal-backdrop").remove();
        $("#loadModals").html( jsFunLoadAviso('MENSAJE DE ERROR','Se Produjo un ERROR en la Operacion Seleccionado'));
        $('#dvAviso').modal('show');
        return;
    }

    if( $('#tbOS_Dll').attr('doc') =="Cdr" || $('#tbOS_Dll').attr('doc') =="Req"  || $('#tbOS_Dll').attr('doc') =="Null" ) {
         varOS.FlgADD = "ADD";
     }
    else {
        varOS.FlgADD = "NOT";
    }

    var tmpOS = $("#tbOS_Dll").html();
    var OsDlls = new Array();
    if ( typeof tmpOS != "undefined")
    {        
        $('#tbOS_Dll tbody tr').each(function ()
        {
            if ($(this).attr("class")!="fila-Hide")
            {
                var fila = new Object();
                fila.osItm=$(this).find("td[name=tdOsItm]").html();
                fila.cdItm=$(this).find("td[name=tdCdItm]").html();
                fila.czItm=$(this).find("td[name=tdCzItm]").html();
                fila.rqItm=$(this).find("td[name=tdRqItm]").html();

                fila.secfun= $(this).find("td[name=tdSF]").attr("codID");
                fila.rubro= $(this).find("td[name=tdRubro]").attr("codID");

                fila.cant= $(this).find("td[name=tdCant]").html();
                fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                fila.espf = $(this).find("td[name=tdEspf]").html();
                fila.marca = $(this).find("td[name=tdMarca]").html();
                fila.precio = $(this).find("td[name=tdPrecio]").html();
                OsDlls .push(fila);
            }
        });
    }
    //var parentt = $(this);
    if (varOS.osOPE=="ADD" || varOS.osOPE =="UPD" || varOS.osOPE=="DEL" ) {
        var fullData = {
            'varOS': varOS,
            'varOSDll': JSON.parse(JSON.stringify(OsDlls )),
            '_token': $('#tokenBtn').val()
        };

        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
        if (varOS.osOPE=="DEL")     $("#divDialogCont").html('Esta seguro que desea ELIMINAR el Registro Seleccionado ? <br> Motivo : <input id ="txOS_Motivo" class="gs-input" style="width:280px;" />');
        else if (varOS.osOPE=="UPD")     $("#divDialogCont").html('Esta seguro que desea ACTUALIZAR el Registro Seleccionado ? ');
        else if (varOS.osOPE=="ADD")     $("#divDialogCont").html('Esta seguro que desea GUARDAR el Registro Seleccionado ? ');
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {
					if(  varOS.osOPE=="DEL"   ) varOS.osObsv     = $("#txOS_Motivo").val();
                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetOS",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();

                            if(VR["msgId"] == 500){
                                jsFnDialogBox(400, 145, "ERROR", null, "ERROR EN LA PETICION", VR["msg"]);
                            }
                            else{
                                if(VR[0].Error==1){
                                    jsFnDialogBox(400, 145, "ERROR", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>"+VR[0].Mensaje+"</strong>");
                                }
                                //	alert(VR[0].OSNo);
                                //  jsFunDBOS_Get("ID",VR[0].OSNo);
                                else { jsFunDBOS_Get("ID",VR[0].OSNo); }
                            }
                        }
                    });

                },
                "Cancel": function () {    $(this).dialog("close");  }
            }
        });

    }
});

$( document ).on( 'click',  '#btnLogOSCancel',function(e) {
    e.preventDefault();
    jsFunOS_Default();
    jsFunOS_EnableText(true);
    jsFunOS_EnableBtns(false);

});
$( document ).on( 'click',  '#btnLogOSNew',function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OS",'_token': $('#tokenBtnMain').val() },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
        success: function (VR) { $("#txOS_No").val( VR[0].Codigo ); }
    });
    jsFunOS_Default();
    jsFunOS_EnableText(false);
    jsFunOS_EnableBtns(true);
});
$( document ).on( 'click',  '#btnLogOSUpd',function(e) {
    e.preventDefault();
    if($("#OS").attr("osID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione la ORDEN DE SERVICIO");return ;}
    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 175, title: "CONFIRMAR PROCESOS"});
    $("#divDialogCont").html("Esta Seguro de Actualizar la ORDEN DE SERVICIO");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
                $("#OS").attr("opeID","UPD");
                jsFunOS_EnableText(false);
                jsFunOS_EnableBtns(true);
                $(this).dialog("close");
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });
});
$( document ).on( 'click',  '#btnLogOSDel',function(e) {
    e.preventDefault();
    if($("#OS").attr("osID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione la ORDEN DE SERVICIO");return ;}
    $("#OS").attr("opeID","DEL");
});

$( document ).on( 'click',  '#btnLogOSPrint',function(e) {
    e.preventDefault();
    if($("#OS").attr("osID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione la ORDEN DE SERVICIO");return ;}
    if(!jsFunOS_ValPrint()){return; }
    window.open("logistica/rptOS/"+$(".txVarAnioEjec").val()+"/"+varOS.osID+"",'width=275,height=340,scrollbars=NO,location=no');
});




$( document ).on( 'click',  '#btnLogOSBusy',function(e) {
    e.preventDefault();
    var  Cod="NN";
    var datos = {Anio:$(".txVarAnioEjec").val(), '_token': $('#tokenBtn').val()}

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OS",'_token': $('#tokenBtnMain').val() },
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
            $("#divDialogCont").html("<br>Esta Seguro que desea RESERVAR la O/S Nº :<strong> "+Cod+"<strong>");
            $("#divDialog").dialog({
                buttons: {
                    "Aceptar": function () {

                        var datos = {Anio:$(".txVarAnioEjec").val(), Usr: '00000','_token': $('#tokenBtn').val()}
                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogSetOSBusy",
                            data: datos,
                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");                        },
                            success: function (VR) {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();
                                if (VR.length > 0) {
                                    if (VR[0].Error == "0") {
                                        $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE <br> Se ha Reservador la O/S = ' + VR[0].Codigo));
                                        $('#dvAviso').modal('show');

                                        jsFunOS_Default();

                                        $.ajax({
                                            type: "POST",
                                            url: "logistica/spLogGetCodNext",
                                            data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OS",'_token': $('#tokenBtnMain').val() },
                                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                                            success: function (VR) { $("#txOS_No").val( VR[0].Codigo ); }
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


/*****************************************************************************************************************************/
/****** FUNCTION VALIDTION ************************************************************************************************/

$( document ).on( 'click' ,'#btnLogOS_dllEDIT ',function(e) {
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();
    //alert(trCloneHtml);
    $("#tbOS_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {

        $("#tbOS_Dll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide" && $(this).attr("class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });

        trCurrent.html("").append(jsFunOS_EditColumns("UPD")).css("background","#d9edf7").attr("trFocus","ACTIVE");
        //trCurrent.find("td[name=tdID]")   .attr("osID",trClone .find("td[name=tdID]").attr ("osID"));
        trCurrent.find("td[name=tdOsItm]")      .html( trClone.find("td[name=tdOsItm]").text() );
        trCurrent.find("td[name=tdCdItm]")      .html( trClone.find("td[name=tdCdItm]").text() );
        trCurrent.find("td[name=tdCzItm]")      .html( trClone.find("td[name=tdCzItm]").text() );
        trCurrent.find("td[name=tdRqItm]")      .html( trClone.find("td[name=tdRqItm]").text() );

        trCurrent.find("td[name=tdSF]") .find('input[id=txProdSF]').val(trClone.find("td[name=tdSF]").text().trim());
        trCurrent.find("td[name=tdRubro]") .find('input[id=txProdRubro]').val(trClone.find("td[name=tdRubro]").text().trim());

        trCurrent.find("td[name=tdCant]")    .find('input[id=txProdCant]')      .val(trClone .find("td[name=tdCant]").text().trim());
        trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')     .val(trClone .find("td[name=tdClasf]").text()) ;
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(trClone .find("td[name=tdProd]").text()) ;
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(trClone .find("td[name=tdUnd]").text())  ;
        trCurrent.find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(trClone .find("td[name=tdEspf]").text()) ;

        trCurrent.find("td[name=tdPrecio]")  .find('input[id=txProdPrecio]')    .val(trClone .find("td[name=tdPrecio]").text().trim());
        trCurrent.find("td[name=tdMarca]")  .find('input[id=txProdMarca]')    .val(trClone .find("td[name=tdMarca]").text().trim());

        trCurrent.find("td[name=tdSF]") .find('input[id=txProdSF]').attr('codID',trClone.find("td[name=tdSF]").attr('codID'));
        trCurrent.find("td[name=tdRubro]") .find('input[id=txProdRubro]').attr('codID',trClone.find("td[name=tdRubro]").attr('codID'));

        trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]').attr("codID",trClone .find("td[name=tdClasf]").attr ("codID"));
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]').attr("codID",trClone .find("td[name=tdProd]").attr ("codID"));
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]') .attr("codID",trClone .find("td[name=tdUnd]").attr ("codID"));
        varOSDll.OPE="UPD";
    }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }
    
});

$( document ).on( 'click' ,'#btnLogOS_dllCANCEL',function(e) {
/*    filaHide="";
    $("#tbOS_Dll tfoot tr").each(function() {
        if ($(this).attr("Class")=="fila-Hide" && $(this).attr("Class")!="gsTh" )
            filaHide= $(this).html();
    });
    $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");*/

    filaHide="";
    if(varOSDll.OPE=="UPD") {
        $("#tbOS_Dll tfoot tr").each(function () {
            if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
                filaHide = $(this).html();
        });
        $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");
    }
    else{
        $("#dvBarraAdd").css({'background': '#efefef'});
        $("#dvBarraAdd").css({'display': 'none'});
    }

});



$( document ).on( 'click' ,'#btnLogOS_dllSAVE',function(e) { // use
    trCurrent = $(this).parent().parent();
    var trClone = $(this).parent().parent().clone();
    
   if($("#tbOS_Dll").attr('doc')=="Ods")
   {  

        varOSDll.osID = $("#OS").attr("osID");
        varOSDll.osItm=trClone.find("td[name=tdOsItm]").html();
        varOSDll.cdItm=trClone.find("td[name=tdCdItm]").html();
        varOSDll.czItm=trClone.find("td[name=tdCzItm]").html();
        varOSDll.rqItm=trClone.find("td[name=tdRqItm]").html();

       varOSDll.prodSecfun = trClone.find("td[name=tdSF]").find('input[id=txProdSF]').attr('codID');
       varOSDll.prodRubro = trClone.find("td[name=tdRubro]").find('input[id=txProdRubro]').attr('codID');

        varOSDll.prodCant=trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val( );
        varOSDll.prodID=trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID");
        varOSDll.prodUndID=trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID");
        varOSDll.prodClasfID=trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID");
        varOSDll.prodEspf=trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val( );
        varOSDll.prodMarca=trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val( );
        varOSDll.prodPrecio=trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val( );
        varOSDll.prodUsrID="NN";

        reqErrores="<p>";
        if ( parseFloat(varOSDll.prodCant).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Cantidad '; }
        if ( parseFloat(varOSDll.prodPrecio).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Precio Unitario '; }    
        if ( parseFloat(varOSDll.prodUndID).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Unidad '; }
        if ( varOSDll.prodID== "NN") {  reqErrores+=' <br> * Seleccione el Producto de Catalogo '; }
        if ( varOSDll.prodClasfID== "NN") {  reqErrores+=' <br> * Clasificador '; }
        reqErrores+="</p>";
        if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }


        var datos = {
            varBns:varOSDll,
            '_token': $('#tokenBtn').val()
        };
        $.ajax({
            type: "post",
            url: "logistica/spLogSetOSD",
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
                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
                    $('#dvAviso').modal('show');
                    $("#divOS_Dll").html(VR["vwDll"]);
                }
            }
        });
    }

   else 
   {
        $("#tbOS_Dll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide"  )
                     tmp =  $(this).html();
        });
        trCurrent.html("").append(tmp).css("background","#d9edf7").attr("trFocus","ACTIVE");
       
        trCurrent.find("td[name=tdOsItm]").html(trClone.find("td[name=tdOsItm]").text());
        trCurrent.find("td[name=tdCdItm]").html(trClone.find("td[name=tdCdItm]").text());
        trCurrent.find("td[name=tdCzItm]").html(trClone.find("td[name=tdCzItm]").text());
        trCurrent.find("td[name=tdRqItm]").html(trClone.find("td[name=tdRqItm]").text());

        trCurrent.find("td[name=tdSF]").html(trClone.find('td[name=tdSF]').find('input[id=txProdSF]').val());
        trCurrent.find("td[name=tdRubro]").html(trClone.find("td[name=tdRubro]").find('input[id=txProdRubro]').val());

        trCurrent.find("td[name=tdCant]").html(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val());
        trCurrent.find("td[name=tdClasf]").html(trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').val());
        trCurrent.find("td[name=tdProd]").html(trClone.find("td[name=tdProd]").find('input[id=txProdProd]').val());
        trCurrent.find("td[name=tdUnd]").html(trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').val());
        trCurrent.find("td[name=tdEspf]").html(trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val());

        trCurrent.find("td[name=tdPrecio]").html(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val());
        trCurrent.find("td[name=tdMarca]").html(trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val());

       trCurrent.find("td[name=tdSF]").attr("codID",trClone.find('td[name=tdSF]').find('input[id=txProdSF]').attr("codID"));
       trCurrent.find("td[name=tdRubro]").attr("codID",trClone.find("td[name=tdRubro]").find('input[id=txProdRubro]').attr("codID"));

        trCurrent.find("td[name=tdClasf]").attr("codID", trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID"));
        trCurrent.find("td[name=tdProd]").attr("codID", trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID"));
        trCurrent.find("td[name=tdUnd]").attr("codID", trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));

        var cant = parseFloat(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
        var precioUnt = parseFloat(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val()).toFixed(2)
        var total       = parseFloat( cant*precioUnt).toFixed(4);
        trCurrent.find("td[name=tdTotal]").html(total);
        trCurrent.removeAttr("style").removeAttr("trFocus");     
        $("#tbOS_Dll").append(trCurrent);

   }


    $("#dvBarraAdd").css({'background': '#efefef'});
    $("#dvBarraAdd").css({'display': 'none'});
});





$( document ).on( 'click' ,'#btnLogOS_dllDEL ',function(e) {

    var msg= confirm("ESTA SEGURO QUE DESEA ELIMINAR EL REGISTRO");
    if(msg)
    {   
             
                        var trCloneFILAS = $(this).parent().parent();
                        varOSDll.OPE="DEL";
                        varOSDll.osID =$("#OS").attr("osID");
                        varOSDll.osItm=trCloneFILAS.find("td[name=tdOsItm]").html();
                        varOSDll.cdItm=trCloneFILAS.find("td[name=tdCdItm]").html();
                        varOSDll.czItm=trCloneFILAS.find("td[name=tdCzItm]").html();
                        varOSDll.rqItm=trCloneFILAS.find("td[name=tdRqItm]").html();

                        varOSDll.prodCant=trCloneFILAS.find("td[name=tdCant]").html( );
                        varOSDll.prodID=trCloneFILAS.find("td[name=tdProd]").attr("codID");
                        
                        varOSDll.prodUndID=trCloneFILAS.find("td[name=tdUnd]").attr("codID");
                        varOSDll.prodClasfID=trCloneFILAS.find("td[name=tdClasf]").attr("codID");
                        varOSDll.prodEspf=trCloneFILAS.find("td[name=tdEspf]").html( );
                        varOSDll.prodMarca=trCloneFILAS.find("td[name=tdMarca]").html( );
                        varOSDll.prodPrecio=trCloneFILAS.find("td[name=tdPrecio]").html( );
                        varOSDll.prodUsrID="NN";


                        var datos = {
                            varBns:varOSDll,
                            '_token': $('#tokenBtn').val()
                        }
                        $.ajax({
                            type: "post",
                            url: "logistica/spLogSetOSD",
                            data: datos,
                            beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                            error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
                            success: function (VR) {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();
                                //$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
                                //$('#dvAviso').modal('show');
                                $("#divOS_Dll").html(VR["vwDll"]);
                            }
                        });
                        $("#dvBarraAdd").css({'background': '#efefef'});
                        $("#dvBarraAdd").css({'display': 'none'});
               


   }


});




/*

function jsFunOS_EditColumnsReq()
{
    tmpTds ='    <td name="tdID"  style="display: none" ></td> ';
    tmpTds+='    <td name="tdCant"  align="center"> <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdClasf" align="center"> <input id="txProdClasf" name ="txProdClasf" class="form-control gs-input" placeholder="Clasificador" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdUnd"   align="center" > <input id="txProdUnd" name ="txProdUnd" class="form-control gs-input" placeholder="Und" style="width:45px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdProd"  align="left"  > <input id="txProdProd" name ="txProdProd" class="form-control gs-input" placeholder="Descripcion" style="width:350px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdEspf"  align="left"  > <textarea id="txProdEspf" name ="txProdEspf" class="form-control gs-input" placeholder="Especificaciones" style="width:300px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" rows="3"></textarea>  </td>';

    tmpTds+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:90px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdTotal"   align="center">  </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" width="50px"><button id="btnLogOSReq_dllSAVE" class="btn btn-primary " style="width:45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">Guardar</button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnLogOSReq_dllCANCEL" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
    return tmpTds;
}

function jsFunOS_NuevoItem()
{
    tmpTds ='    <td name="tdID"  style="display: none" >-1</td> ';
    tmpTds+='    <td name="tdCant"  align="center"> <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdClasf" align="center"> <input id="txProdClasf" name ="txProdClasf" class="form-control gs-input" placeholder="Clasificador" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdProd"  align="left"  > <input id="txProdProd" name ="txProdProd" class="form-control gs-input" placeholder="Descripcion" style="width:350px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdUnd"   align="center" > <input id="txProdUnd" name ="txProdUnd" class="form-control gs-input" placeholder="Und" style="width:45px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdEspf"  align="left"  > <textarea id="txProdEspf" name ="txProdEspf" class="form-control gs-input" placeholder="Especificaciones" style="width:300px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" rows="3"></textarea>  </td>';

    tmpTds+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:110px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdTotal"   align="center">  </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" width="50px"><button id="btnLogOSReq_dllSAVE" class="btn btn-primary " style="width:45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">Guardar</button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnLogOSReq_dllSalir" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
    return tmpTds;
}

*/
/*****************************************************************************************************************************/
/****** FUNCTION VALIDTION ************************************************************************************************/

function jsFunOS_ValPrint()
{
    $(".modal-backdrop").remove();

    var osOPE   = $("#OS").attr("opeID");
    var osID    = $("#OS").attr("osID");
    var osAnio  = $("#OS").attr("anioID");
    var osFecha = $('#txOS_Fecha').val();

    var osTipoProc  = $('#txOS_CodTipoProc').attr("codID");
    var osDep       = $('#txOS_CodDep').attr("codID");
    var osSecFun    = $('#txOS_CodSecFun').attr("codID");
    var osRubro     = $('#txOS_CodRubro').attr("codID");

    var osRuc       = $('#txOS_Ruc').attr("codID");
    var osPlazo     = $('#txOS_Plazo').val();
    var osGarantia  = $('#txOS_Garantia').val();
    var osIGV       = $('#txOS_IGV').val();
    var osGlosa     = $('#txOS_Glosa').val();
    var osLugar     = $('#txOS_LugarEnt').val();
    var osRef       = $('#txOS_Ref').val();
    var osObsv      = $('#txOS_Obsv').val();
    var osCondicion      = $('#txOS_Condicion').val();
    var osCondicion      = $('#txOS_Condicion').parent().find('.note-editable').html();

    var osReq     = $('#OS').attr("reqID");
    var osCtz     = $('#OS').attr("ctzID");
    var osCdr      = $('#OS').attr("cdrID");

    

   
    varOS.osAnio= osAnio;
    varOS.osOPE = osOPE ;
    varOS.osID = osID;
    varOS.osFecha = osFecha;

    varOS.osTipoProcID = osTipoProc;
    varOS.osDepID = osDep;
    varOS.osSecFunID = osSecFun;
    varOS.osRubroID = osRubro;
    varOS.osRuc = osRuc;
    varOS.osPlazo = osPlazo;
    varOS.osIGV = osIGV;
    varOS.osGarantia = osGarantia;

    varOS.osGlosa = osGlosa;
    varOS.osLugar = osLugar;
    varOS.osRef  = osRef;
    varOS.osObsv     = osObsv;
    varOS.osCondicion     = osCondicion;
    varOS.osReqID     = osReq;
    varOS.osCtzID     = osCtz;
    varOS.osCdrID     = osCdr;
    varOS.osUsrID     = "000000";
    varOC._token = $('#tokenBtn').val();
    return true ;

}


function jsFunOS_Val()
{
    $(".modal-backdrop").remove();

    var osOPE   = $("#OS").attr("opeID");
    var osID    = $("#OS").attr("osID");
    var osAnio  = $("#OS").attr("anioID");
    var osFecha = $('#txOS_Fecha').val();

    var osTipoProc  = $('#txOS_CodTipoProc').attr("codID");
    var osDep       = $('#txOS_CodDep').attr("codID");
    var osSecFun    = $('#txOS_CodSecFun').attr("codID");
    var osRubro     = $('#txOS_CodRubro').attr("codID");

    var osRuc       = $('#txOS_Ruc').attr("codID");
    var osPlazo     = $('#txOS_Plazo').val();
    var osGarantia  = $('#txOS_Garantia').val();
    var osIGV       = $('#txOS_IGV').val();
    var osGlosa     = $('#txOS_Glosa').val();
    var osLugar     = $('#txOS_LugarEnt').val();
    var osRef       = $('#txOS_Ref').val();
    var osObsv      = $('#txOS_Obsv').val();
    var osCondicion      = $('#txOS_Condicion').val();
	var osCondicion      = $('#txOS_Condicion').parent().find('.note-editable').html();

    var osReq     = $('#OS').attr("reqID");
    var osCtz     = $('#OS').attr("ctzID");
    var osCdr      = $('#OS').attr("cdrID");

    

    var reqErrores="<p>";
    if(osOPE=="UDP"  || osOPE=="DEL") if (typeof osID != "undefined"){  if(osID=="NN" ||   osID.length<4){  reqErrores+=' <br> * Nro del Requerimiento '; } } else {  reqErrores+= ' <br> * Nro del Requerimiento ';  }
    if (typeof osAnio != "undefined"){  if(osAnio =="NN" ||   osAnio .length<4){  reqErrores+=' <br> * Año '; } } else {  reqErrores+= ' <br> * Año ';  }
    if (typeof osFecha != "undefined"){  if(osFecha =="NN" ||   osFecha.length<8){  reqErrores+=' <br> * Fecha '; } } else {  reqErrores+= ' <br> * Fecha ';  }
    if (typeof osTipoProc != "undefined"){  if(osTipoProc=="NN" ||   osTipoProc.length<2){  reqErrores+=' <br> * Tipo de Proceso'; } } else {  reqErrores+= ' <br> * Tipo de Proceso ';  }
    if (typeof osDep != "undefined"){  if(osDep =="NN" ||   osDep .length<3){  reqErrores+=' <br> * Dependencia'; } } else {  reqErrores+= ' <br> * La Dependencia  ';  }
    if (typeof osSecFun != "undefined"){  if(osSecFun=="NN" ||   osSecFun.length<3){  reqErrores+=' <br> * Secuencia Funcional'; } } else {  reqErrores+= ' <br > * La Secuencia Funcional  ';  }
    if (typeof osRubro != "undefined"){  if(osRubro=="NN" ||   osRubro.length<2){  reqErrores+=' <br> * Rubro '; } } else {  reqErrores+= ' <br> * Rubro ';  }
    if (typeof osRuc != "undefined"){  if(osRuc=="NN" ||   osRuc.length<2){  reqErrores+=' <br> * Nro de RUC '; } } else {  reqErrores+= ' <br> * Nro de RUC ';  }

    if(osPlazo.length<1){  reqErrores+=' <br> * Plazo '; }
    if(osIGV.length<2){  reqErrores+=' <br> * IGV'; }

    if(osLugar.length<3){  reqErrores+=' <br> * Lugar de Entrega'; }
    if(osRef.length<3){  reqErrores+=' <br> * Referencia Documentaria'; }

    reqErrores+="</p>";
    if(reqErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',reqErrores));  $('#dvAviso').modal('show');   return false ; }

    varOS.osAnio= osAnio;
    varOS.osOPE = osOPE ;
    varOS.osID = osID;
    varOS.osFecha = osFecha;

    varOS.osTipoProcID = osTipoProc;
    varOS.osDepID = osDep;
    varOS.osSecFunID = osSecFun;
    varOS.osRubroID = osRubro;
    varOS.osRuc = osRuc;
    varOS.osPlazo = osPlazo;
    varOS.osIGV = osIGV;
    varOS.osGarantia = osGarantia;

    varOS.osGlosa = osGlosa;
    varOS.osLugar = osLugar;
    varOS.osRef  = osRef;
    varOS.osObsv     = osObsv;
    varOS.osCondicion     = osCondicion;
    varOS.osReqID     = osReq;
    varOS.osCtzID     = osCtz;
    varOS.osCdrID     = osCdr;
    varOS.osUsrID     = "000000";
    varOC._token = $('#tokenBtn').val();
    return true ;

}
/*****************************************************************************************************************************/
/****** FUNCTION GET DATABASE ************************************************************************************************/


function jsFunDBOS_Get( Tipo , valor) // use
{
    jsFunOS_ClearOrigen();
    var qry = "";
    if(Tipo=="COD")
    {
        qry=" and cast(substring (osCodigo,4,5) as int ) = "+valor;
    }
    else
    {
        qry=" and osID = '"+valor+"'";
    }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOS",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(VR["msgId"] == 500){
                jsFunReqClear();
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                if(VR["OS"].length>0)
                {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    //$("#OS").attr("ocEtapa",VR["Req"][0].reqEtapa);
                    $('#txOS_Etapa').html(VR["OS"][0].osEtapa);
                    $("#OS").attr("anioID",VR["OS"][0].osAnio);
                    $("#OS").attr("osID", VR["OS"][0].osID);
                    $("#OS").attr("ctzID", VR["OS"][0].osCtzID);
                    $("#OS").attr("cdrID", VR["OS"][0].osCcID);
                    $("#OS").attr("reqID", VR["OS"][0].osReqID);
                    $('#txOS_No').val(VR["OS"][0].osCodigo);


                    $('#txOS_Fecha').val(VR["OS"][0].osFechaFormat);

                    $('#txOS_CodDep').attr('codID',VR["OS"][0].osDepID);
                    $('#txOS_CodDep').val(VR["OS"][0].osDepCod);
                    $('#txOS_Dep').val(VR["OS"][0].osDepDsc);
                    $('#txOS_CodSecFun').attr("codID",VR["OS"][0].osSecFunID);
                    $('#txOS_CodSecFun').val(VR["OS"][0].osSecFunCod);
                    $('#txOS_SecFun').val(VR["OS"][0].osSecFunDsc);
                    $('#txOS_CodRubro').attr("codID",VR["OS"][0].osRubroID);
                    $('#txOS_CodRubro').val(VR["OS"][0].osRubroCod);
                    $('#txOS_Rubro').val(VR["OS"][0].osRubroDsc);
                    $('#txOS_LugarEnt').val(VR["OS"][0].osLugar);
                    $('#txOS_Ref').val(VR["OS"][0].osRef);
                    $('#txOS_CodTipoProc').val(VR["OS"][0].osTipoProcCod);
                    $('#txOS_TipoProc').val(VR["OS"][0].osTipoProcDsc);
                    $('#txOS_CodTipoProc').attr("codID",VR["OS"][0].osTipoProcID);

                    $('#txOS_Ruc').attr("codID",VR["OS"][0].osRUC);
                    $('#txOS_Ruc').val(VR["OS"][0].osRUC);
                    $('#txOS_RSocial').val(VR["OS"][0].osRazon);
                    $('#txOS_Plazo').val(VR["OS"][0].osPlazo);
                    $('#txOS_Garantia').val(VR["OS"][0].osGarantia);
                    $('#txOS_IGV').val(VR["OS"][0].osIGV);

                    $('#txOS_Glosa').val(VR["OS"][0].osGlosa);
                    $('#txOS_Obsv').val(VR["OS"][0].osObsv);
                    //$('#txOS_Condicion').val(VR["OS"][0].osCondicion);
                    $('#txOS_Condicion').parent().find('.note-editable').html(VR["OS"][0].osCondicion);
                    $('.note-editable p').css('margin','0px');
                    $("#divOS_Dll").html(VR["OSDll"]);

                    if( VR["OS"][0].osCcID.length>5){
                        $('#txOS_NroDoc').val(VR["OS"][0].osCcCod);
                        $('#txOS_CodTipoDoc').attr("codID","CC");
                        $('#txOS_TipoDoc').text("Cuadro Comp.");
                    }
                    else
                    {
                        if( VR["OS"][0].osReqID.length>5){
                            $('#txOS_NroDoc').val(VR["OS"][0].osReqCod);
                            $('#txOS_CodTipoDoc').attr("codID","RQ");
                            $('#txOS_TipoDoc').text("Requerimiento");
                        }
                        else {
                            $('#txOS_NroDoc').val("-");
                            $('#txOS_CodTipoDoc').attr("codID","NN");
                            $('#txOS_TipoDoc').text("Sin Origen");
                        }
                    }

                    $("#lblExp").html(VR["Exp"][0].msg);
                    // $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
                    // $('#dvAviso').modal('show');
                    jsFunOS_EnableText(true);
                    jsFunOS_EnableBtns(false);
                }
                else
                {    jsFunOS_Default(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
            }
        }
    });

}

function jsFunDBOS_CCGetData(Tipo,valor) // use
{
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (cdrcodigo,4,5) as int ) = "+valor;  }
    else if (Tipo=="ID") {   qry=" and cdrid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOS_CCVal",
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
                jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", VR["msg"]);
            }
            else{
                if (VR["CC"].length > 0) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();

                    $("#OS").attr("cdrID",VR["CC"][0].cdrID);
                    $("#OS").attr("ctzID",VR["CC"][0].cdrOrgID);
                    $('#txOS_NroDoc').val(VR["CC"][0].cdrCodigo);
                    $("#txOS_LugarEnt").val(VR["CC"][0].cdrLugarEnt);
                    $("#OS").attr("fteID",VR["AdjDll"][0].fteID);
                    $("#txOS_Ruc").attr("codID",VR["AdjDll"][0].fteRuc);
                    $("#txOS_Ruc").val(VR["AdjDll"][0].fteRuc);
                    $("#txOS_RSocial").val(VR["AdjDll"][0].fteRazon);
                    $("#txOS_Plazo").val(VR["AdjDll"][0].ftePlazo);
                    $("#txOS_Garantia").val(VR["AdjDll"][0].fteGarantia);
                    $("#txOS_IGV").val(VR["AdjDll"][0].fteIgv);

                    $("#OS").attr("reqID",VR["Req"][0].reqID);
                    $("#txOS_CodDep").val(VR["Req"][0].reqDepCod);
                    $("#txOS_CodDep").attr("codID",VR["Req"][0].reqDepID);
                    $("#txOS_Dep").val(VR["Req"][0].reqDepDsc);
                    $("#txOS_CodSecFun").attr("codID",VR["Req"][0].reqSecFunID);
                    $("#txOS_CodSecFun").val(VR["Req"][0].reqSecFunCod);
                    $("#txOS_SecFun").val(VR["Req"][0].reqSecFunDsc);
                    $("#txOS_CodRubro").attr("codID",VR["Req"][0].reqRubroID);
                    $("#txOS_CodRubro").val(VR["Req"][0].reqRubroCod);
                    $("#txOS_Rubro").val(VR["Req"][0].reqRubroDsc);
                    $("#txOS_Glosa").val(VR["Req"][0].reqGlosa);
                    //$("#txOS_Ref").val(VR["Ref"][0].Ref);
                    $("#divOS_Dll").html(VR["OsDll"]);

                }
                else {
                    jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");
                }
            }
        }
    });

}


function jsFunDBOS_ReqGetData(Tipo,valor) // use
{
    var qry = "";
    if(Tipo=="COD")      {   qry=" and cast(substring (reqid,8,4) as int )  = "+valor;  }
    else if (Tipo=="CID") {   qry=" and reqrid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOSReq",
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
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", VR["msg"]);
            }
            else{
                if (VR["Req"].length > 0) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();
                    //$("#OC").attr("cdrID",VR["CC"][0].cdrID);
                    //$("#OC").attr("ctzID",VR["CC"][0].cdrCtzID);
                    $('#txOS_NroDoc').val(VR["Req"][0].reqCodigo);
                    $("#OS").attr("reqID",VR["Req"][0].reqID);
                    $("#txOS_CodDep").val(VR["Req"][0].reqDepCod);
                    $("#txOS_CodDep").attr("codID",VR["Req"][0].reqDepID);
                    $("#txOS_Dep").val(VR["Req"][0].reqDepDsc);
                    $("#txOS_CodSecFun").attr("codID",VR["Req"][0].reqSecFunID);
                    $("#txOS_CodSecFun").val(VR["Req"][0].reqSecFunCod);
                    $("#txOS_SecFun").val(VR["Req"][0].reqSecFunDsc);
                    $("#txOS_CodRubro").attr("codID",VR["Req"][0].reqRubroID);
                    $("#txOS_CodRubro").val(VR["Req"][0].reqRubroCod);
                    $("#txOS_Rubro").val(VR["Req"][0].reqRubroDsc);
                    $("#txOS_LugarEnt").val(VR["Req"][0].reqLugarEnt);
                    $("#txOS_Glosa").val(VR["Req"][0].reqGlosa);
                    $("#divOS_Dll").html(VR["OsDll"]);
                    //$("#txOS_Ref").val(VR["Ref"][0].Ref);
                }
                else {
                    // jsFunCdrClear();
                    jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");
                }
            }



        }
    });

}

/*****************************************************************************/
/*****************************************************************************/

function jsFunOS_Default()
{
    $('#txOS_No').val("");
    $("#OS").attr("osEtapa","NN");
    $("#OS").attr("opeID","ADD");
    $("#OS").attr("osID","NN");
    $("#OS").attr("anioID",$(".txVarAnioEjec").val() );
    $('#txOS_Fecha').val("");
    $('#txOS_CodTipoDoc').attr("codID","NN");
    $('#txOS_TipoDoc').text("");
	$('#txOS_Etapa').val("");
    jsFunOS_ClearOrigen();
}

function jsFunOS_ClearOrigen()
{
    $("#OS").attr("cdrID","NN");
    $("#OS").attr("fteID","NN");
    $("#OS").attr("ctzID","NN");
    $("#OS").attr("reqID","NN");

    
	$('#txOS_NroDoc').val("");
    $('#txOS_NroDoc').attr("codID","NN");

    $('#txOS_CodDep').val("");
    $('#txOS_Dep').val("");
    $('#txOS_CodSecFun').val("");
    $('#txOS_SecFun').val("");
    $('#txOS_CodRubro').val("");
    $('#txOS_Rubro').val("");
    $('#txOS_Ref').val("");
    $('#txOS_LugarEnt').val("");
    $('#txOS_CodTipoProc').val("");
    $('#txOS_TipoProc').val("");
    $('#txOS_Obsv').val("");
    $('#txOS_Glosa').val("");
    $('#txOS_Condicion').val("");
    $('#txOS_CodDep').attr("codID","NN");
    $('#txOS_CodSecFun').attr("codID","NN");
    $('#txOS_CodRubro').attr("codID","NN");
    $('#txOS_CodTipoProc').attr("codID","NN");
    $('#txOS_Ruc').attr("codID","NN");

    $('#txOS_Ruc').val("");
    $('#txOS_RSocial').val("");
    $('#txOS_Plazo').val("");
    $('#txOS_IGV').val("");
    $('#txOS_Garantia').val("");

    $('#txOS_Etapa').html("");
    $('#divOS_Dll').html("");
    $('#txOS_Fecha').val(moment().format('YYYY-MM-DD'));
    $('#txOS_Condicion').parent().find('.note-editable').html("");
	$('.note-editable p').css('margin','0px');
    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#dvBarraAdd").css({'background': '#efefef'});
    $("#dvBarraAdd").css({'display': 'none'});

}

function jsFunOS_EnableText (flg)
{
     $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#dvBarraAdd").css({'background': '#efefef'});
    $("#dvBarraAdd").css({'display': 'none'});


    $('#txOS_No').prop('disabled', !flg);
    $('#txOS_Fecha').prop('disabled', flg);
    $('#txOS_CodTipoDoc').prop('disabled', flg);
    $('#txOS_NroDoc').prop('disabled', flg);
    $('#txOS_CodDep').prop('disabled', flg);
    $('#txOS_Dep').prop('disabled', true);
    $('#txOS_CodSecFun').prop('disabled', flg);
    $('#txOS_SecFun').prop('disabled', true);
    $('#txOS_CodRubro').prop('disabled', flg);
    $('#txOS_Rubro').prop('disabled', true);
    $('#txOS_Ref').prop('disabled', flg);
    $('#txOS_LugarEnt').prop('disabled', flg);
    $('#txOS_CodTipoProc').prop('disabled', flg);
    $('#txOS_TipoProc').prop('disabled', true);
    $('#txOS_Obsv').prop('disabled', flg);
    $('#txOS_Condicion').prop('disabled', flg);
    $('#txOS_Glosa').prop('disabled', flg);

    $('#txOS_Ruc').prop('disabled', flg);
    $('#txOS_RSocial').prop('disabled', flg);
    $('#txOS_Plazo').prop('disabled', flg);
    $('#txOS_IGV').prop('disabled', flg);
    $('#txOS_Garantia').prop('disabled', flg);
    $('#btnOC_Ruc').prop('disabled', flg);
    $('.note-editable').attr('contenteditable', !flg);


    if(flg) {
        $('#tbRUCs tbody tr').each(function () {
            /*$(this).find('button[id=btnCCRucVER]').parent().addClass("fila-Hide");
             $(this).find('button[id=btnCCRucBUENAPRO]').parent().addClass("fila-Hide");
             $(this).find('button[id=btnCCRucEDIT]').parent().addClass("fila-Hide");
             $(this).find('button[id=btnCCRucDEL]').parent().addClass("fila-Hide");
             */
            $(this).find('button[id=btnCCRucVER]').addClass("fila-Hide");
            $(this).find('button[id=btnCCRucBUENAPRO]').addClass("fila-Hide");
            $(this).find('button[id=btnCCRucEDIT]').addClass("fila-Hide");
            $(this).find('button[id=btnCCRucDEL]').addClass("fila-Hide");
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
    }


    if(flg) {
        $('#tbOS_Dll tbody tr').each(function () {
            $(this).find('button[id=btnLogOS_dllEDIT]').parent().addClass("fila-Hide");
          $(this).find('button[id=btnLogOS_dllDEL]').parent().addClass("fila-Hide");
          $(this).find('button[id=btnLogOS_dllEDIT]').addClass("fila-Hide");
          $(this).find('button[id=btnLogOS_dllDEL]').addClass("fila-Hide");         
        
        });
    }
    else
    {
        $('#tbOS_Dll tbody tr').each(function () {
          $(this).find('button[id=btnLogOS_dllEDIT]').parent().removeClass("fila-Hide");
          $(this).find('button[id=btnLogOS_dllDEL]').parent().removeClass("fila-Hide");
          $(this).find('button[id=btnLogOS_dllEDIT]').removeClass("fila-Hide");
          $(this).find('button[id=btnLogOS_dllDEL]').removeClass("fila-Hide");
        
        });
    }

}

function jsFunOS_EnableBtns(flg)
{
    if(!flg) {
        $("#btnLogOSSave")     .addClass("fila-Hide");
        $("#btnLogOSCancel")   .addClass("fila-Hide");
        $("#btnLogOSNew")      .removeClass("fila-Hide");
        $("#btnLogOSUpd")      .removeClass("fila-Hide");
        $("#btnLogOSDel")      .removeClass("fila-Hide");
        $("#btnLogOSPrint")    .removeClass("fila-Hide");
        $("#btnLogOSBusy")     .removeClass("fila-Hide");

        $("#btnLogOSLeft")     .removeClass("fila-Hide");
        $("#btnLogOSRight")     .removeClass("fila-Hide");
        $("#btnLogOSSearch")     .removeClass("fila-Hide");
    }
    else {
        $("#btnLogOSSave")     .removeClass("fila-Hide");
        $("#btnLogOSCancel")   .removeClass("fila-Hide");
        $("#btnLogOSNew")      .addClass("fila-Hide");
        $("#btnLogOSUpd")      .addClass("fila-Hide");
        $("#btnLogOSDel")      .addClass("fila-Hide");
        $("#btnLogOSPrint")    .addClass("fila-Hide");
        $("#btnLogOSBusy")     .addClass("fila-Hide");
        $("#btnLogOSLeft")     .addClass("fila-Hide");
        $("#btnLogOSRight")     .addClass("fila-Hide");
        $("#btnLogOSSearch")     .addClass("fila-Hide");

    }
}


/******************************************************/
/****DECLARACION DE VARIABLES *************************/

var varOS = jQuery.parseJSON('{  ' +
'"ocOPE":"NN",' +
'"osID":"NN",' +
'"osAnio":"NN",' +
'"osFecha":"NN",' +
'"osTipoSrvID":"NN" ,' +
'"osTipoProcID":"NN" ,' +
'"osDepID":"NN" ,' +
'"osRubroID":"NN" ,' +
'"osSecFunID":"NN" ,' +
'"osRuc":"NN" ,' +
'"osPlazo":"NN" ,' +
'"osGarantia":"NN" ,' +
'"osIGV":"NN" ,' +
'"osLugar":"NN" ,' +
'"osRef":"NN" ,' +
'"osObsv":"NN" ,' +

'"osReqID":"NN" ,' +
'"osCtzID":"NN" ,' +
'"osCdrID":"NN" ,' +
'"osUsrID":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;

var varOSDll = jQuery.parseJSON('{  ' +
'"OPE":"0",'+
'"osID":"NN",' +
'"ID":"0",' +
'"prodCant":"NN",' +
'"prodClasfID":"NN" ,' +
'"prodID":"NN" ,' +
'"prodUndID":"NN" ,' +
'"prodMarca":"NN" ,'+
'"prodEspf":"NN" ,' +
'"prodPrecio":"NN" ,' +
'"UsrID":"NN" ' +
'}  ' ) ;




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





/*****************************************************/
/** TRASH ********************************************/
/*  var trPrev;
 $("#tbCC_Bienes tr").each(function() {
 if ($(this).attr("Class")=="fila-Hide" && $(this).attr("Class")!="gsTh" )
 trPrev= $(this);
 });
 if(typeof trPrev == "undefined" ){jsFnDialogBox(400, 160, "ERROR", null, "ADVERTENCIA", "<strong>SE PRODUJO UN ERROR, ACTUALIZE NUEVAMENTE EL CUADRO</strong>"); return;}
 trPrev.find("td[name=tdID]").html(trClone.find("td[name=tdID]").html());
 trPrev.find("td[name=tdCant]").html(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val( ));
 trPrev.find("td[name=tdClasf]").html(trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').val( ));
 trPrev.find("td[name=tdProd]").html(trClone.find("td[name=tdProd]").find('input[id=txProdProd]').val( ));
 trPrev.find("td[name=tdUnd]").html(trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').val( ));
 trPrev.find("td[name=tdMarca]").html(trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val( ));
 trPrev.find("td[name=tdPrecio]").html(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val( ));
 trPrev.find("td[name=tdEspf]").html(trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val( ));
 trPrev.find("td[name=tdEspf]").html(trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val( ));
 trPrev.find("td[name=tdClasf]") .attr("codID",trClone .find("td[name=tdClasf]").find('input[id=txProdClasf]').attr ("codID"));
 trPrev.find("td[name=tdProd]")  .attr("codID",trClone .find("td[name=tdProd]").find('input[id=txProdProd]').attr ("codID"));
 trPrev.find("td[name=tdUnd]")   .attr("codID",trClone .find("td[name=tdUnd]").find('input[id=txProdUnd]').attr ("codID"));
 trCurrent.html("").append(trPrev.html()).removeAttr("style").removeAttr("trFocus");
 */





$( document ).on( 'click',  '#btnLogOSLeft',function(e) { // use
    e.preventDefault();
    jsFunDBOSLR( "L");
});


$( document ).on( 'click',  '#btnLogOSRight',function(e) { // use
    e.preventDefault();
    jsFunDBOSLR( "R");
});


function jsFunDBOSLR(prPosition) // use
{
    var token= $('#tokenBtn').val();
    var dataString = {'prAnio': $(".txVarAnioEjec").val(),'prPosition': prPosition, 'prCodOS':$("#OS").attr("osID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOSLR",
        data: dataString,
        //  beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunOS_Default(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(VR[0].ID!="NN") {

                jsFunDBOS_Get("ID",VR[0].ID);
            }
            else
            {    jsFunOS_Default(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
        }
    });

}

$( document ).on( 'click' ,'#btnLogOSCatalogo',function(e) {
        e.preventDefault();
//              $("#divDialog").dialog("close");
        $(".modal-backdrop").remove();
        $('#modalCatalogo').modal('hide');            
        var url = 'logistica/vwCatalogoOC';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalCatalogo').modal('show');            
        });
    });



$( document ).on( 'click',  '#btnLogOSLimpiar ',function(e){

var mgs3 = confirm ('========================= \n :: ESTA SEGURO DE BORRAR TODOS LOS ITEM DE LA BASE DE DATOS   \n ===========================\n\n\n');
if(mgs3)
        {
            if ($("#OS").attr("opeID")=="UPD")
             {
                 $.ajax({
                type: "POST",
                url: "logistica/spLogSetOSDDel",
                data:{   'osID': $("#OS").attr("osID")  ,  '_token': $('#tokenBtnMain').val()} ,

                error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                success: function (VR) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();
                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
                    $('#dvAviso').modal('show');
                    $("#divOS_Dll").html(VR["vwDll"]);
                }
                });
            }
        else 
        {   
            
            $('#tbCC_Bienes tbody tr').each(function ()
            {
            if ($(this).attr("class")!="fila-Hide")
            {
               $(this).remove();
            }
            });
        }       
    }
         
});


$(document).on('click','#btnLogOSItem',function(e) {
    e.preventDefault();
    flg= false;   
    $("#tbOS_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(flg){jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>");return; }

    $(".modal-backdrop").remove();
    if ($("#OS").attr("opeID")=="UPD") filaBase= jsFunOS_EditColumns("UPD") ;
    else filaBase= jsFunOS_EditColumns("NEW") ;

    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#tbBarraBienes").prepend("<tr VALIGN='top'>"+filaBase+"</tr>");
    $("#dvBarraAdd").css({'background': '#d9edf7'});
    $("#dvBarraAdd").css({'display': 'inherit'});
    varOSDll.OPE="ADD";
});






$( document ).on( 'click' ,'#btnLogOS_dllADD',function(e) { // use
    var flg = false;
  
    var objEvento = $(this).parent().parent();
    var trClone = $(this).parent().parent().clone();

    reqErrores="<p>";
    if ( parseFloat(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Cantidad '; }
    if ( parseFloat(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val()).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Precio Unitario '; }
       // if ( parseFloat(trClone.find("td[name=tdEnvio]").find('input[id=txProdEnvio]').val()).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Envio '; }
    if ( parseFloat(trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID")).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Unidad '; }
    if ( trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID")== "NN") {  reqErrores+=' <br> * Seleccione el Producto de Catalogo '; }
    if ( trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID")== "NN") {  reqErrores+=' <br> * Clasificador '; }

    if ( trClone.find("td[name=tdSF]").find('input[id=txProdSF]').attr("codID")== "NN") {  reqErrores+=' <br> * Secuencia Funcional Producto '; }

    if ( trClone.find("td[name=tdRubro]").find('input[id=txProdRubro]').attr("codID")== "NN") {  reqErrores+=' <br> * Rubro Producto '; }

    reqErrores+="</p>";
    if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }


    filaADD = $("#tbOS_Dll tfoot tr").clone(true).removeClass('fila-Hide');

    //filaADD.find("td[name=tdID]").attr("fteID", trClone.find("td[name=tdID]").attr("fteID"));
    filaADD.find("td[name=tdOsItm]").html(trClone.find("td[name=tdOsItm]").text());
    filaADD.find("td[name=tdCdItm]").html(trClone.find("td[name=tdCdItm]").text());
    filaADD.find("td[name=tdCzItm]").html(trClone.find("td[name=tdCzItm]").text());
    filaADD.find("td[name=tdRqItm]").html(trClone.find("td[name=tdRqItm]").text());

    filaADD.find("td[name=tdSF]").html(trClone.find("td[name=tdSF]").find("input[id=txProdSF]").val());
    filaADD.find("td[name=tdRubro]").html(trClone.find("td[name=tdRubro]").find("input[id=txProdRubro]").val());

    filaADD.find("td[name=tdCant]").html(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val());
    filaADD.find("td[name=tdClasf]").html(trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').val());
    filaADD.find("td[name=tdProd]").html(trClone.find("td[name=tdProd]").find('input[id=txProdProd]').val());
    filaADD.find("td[name=tdUnd]").html(trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').val());
    filaADD.find("td[name=tdEspf]").html(trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val());

    filaADD.find("td[name=tdPrecio]").html(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val());
    filaADD.find("td[name=tdMarca]").html(trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val());

    filaADD.find("td[name=tdSF]").attr("codID", trClone.find("td[name=tdSF]").find("input[id=txProdSF]").attr("codID"));
    filaADD.find("td[name=tdRubro]").attr("codID", trClone.find("td[name=tdRubro]").find("input[id=txProdRubro]").attr("codID"));

    filaADD.find("td[name=tdClasf]").attr("codID", trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID"));
    filaADD.find("td[name=tdProd]").attr("codID", trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID"));
    filaADD.find("td[name=tdUnd]").attr("codID", trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));

    var cant = parseFloat(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
    var precioUnt = parseFloat(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val()).toFixed(2)
    var total       = parseFloat( cant*precioUnt).toFixed(4);
    filaADD.find("td[name=tdTotal]").html(total);

    $("#tbOS_Dll").append(filaADD);
    $("#tbBarraBienes tr").each(function (index) {      $(this).remove();     });
    $("#dvBarraAdd").css({'background': '#efefef'});
    $("#dvBarraAdd").css({'display': 'none'});
});

$(document).on('click , keydown','#btnLogOS_dllCLOSE',function(e) {
    e.preventDefault();
    //
     $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
        $("#dvBarraOCAdd").css({'background': '#efefef'});
                        $("#dvBarraOCAdd").css({'display': 'none'});
});

$( document ).on( 'click' ,'#btnLogOS_dllX',function(e) {
var msg2= confirm(' \n ESTA SEGURO QUE DESEA ELIMINAR EL REGISTRO \n\n ');
    if(msg2)        
    $(this).parent().parent().remove();
});


$( document ).on( 'click', '#btnLogOSSiaf', function(e ) {
 e.preventDefault(); 
       
        var dataString = { 'prID': $("#OS").attr("osID")  ,'_token':$('#tokenBtn').val() } ;
        $.ajax({
                    type: "POST",
                    url: "logistica/spLogGetOC_Expediente",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                   // beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                    success: function(VR) {

                      $("#modalOC").html(jsFunModalExpediente( $("#txOS_No").val(), VR));
                       $("#txExpAnio").val($(".txVarAnioEjec").val());
                      $('#modalContExpediente').css({'width': '550px', 'height': '210px'});
                      $('#modalVentExpediente').modal('show');
                      $('#modalVentExpediente').attr('obj',obj);               
                    }
    }); 

  });

$( document ).on( 'click', '#btnLogOSSiaf_ADD , .btnLogOSSiaf_DEL ', function(e ) {
    e.preventDefault();
     
    ope="";
    titulo="";
    tipo = $(this).attr("name");
    item = $(this).attr("idItem");
    if(tipo=="btnLogOSSiaf_ADD") { ope="ADD";  titulo=" GUARDAR "  }
    else if(tipo=="btnLogOSSiaf_DEL") { ope="DEL";  titulo=" ELIMINAR " }
    else {return ;}
    
    var msgExp= confirm("ESTA SEGURO QUE DESEA "+titulo +" EL REGISTRO"); 
      if(msgExp )
      {
                var dataString = { 'prTipo':ope  ,'prItem':item  ,'prID': $("#OS").attr("osID"), 'prAnio': $("#txExpAnio").val() , 'prExp': $("#txExpCod").val()  ,'_token':$('#tokenBtn').val() } ;
                $.ajax({
                    type: "POST",
                    url: "logistica/spLogSetOC_Expediente",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                    success: function(VR) {                 
                    $('#modalExp').html(VR);

                        var dataStringRow = { 'prID': $("#OS").attr("osID") ,'_token':$('#tokenBtn').val() } ;
                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogGetOC_ExpedienteRow",
                            data: dataStringRow,
                            error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                            success: function(VR2) {                 
                            $('#lblExp').html(VR2["Exp"][0].msg);
                            }
                        });  
                    }
                }); 

            $("#modalOC").html("");  
            $(".modal-backdrop").remove();  
      }

      $("#txExpCod").val("");
  });
