$( document ).on( 'click', '.menu-TipoReqOC li', function( event ) {

    var $target = $(event.currentTarget);
    $target.closest('.btn-group').find('[data-bind="label"]').text($target.text()).end().children('.dropdown-toggle').dropdown('toggle');
    var TipoDoc= $target.attr("psrId");
    $('#txOC_CodTipoDoc').val("");
    $("#txOC_CodTipoDoc").attr("codID", TipoDoc);
    $("#txOC_NroDoc").val('');
    $("#txOC_NroDoc").attr("codID", 'NN');
    $("#txOC_NroDoc").focus();
    jsFunOC_ClearOrigen();
    $('#txOC_NroDoc').prop('readOnly', false);
    if(TipoDoc=="NN" ) {

        mgsTipoNN = confirm ("==================================== \n - Esta seguro que para esta O/C no tiene documento Origen \n\n\n ==================================== \n\n");
        if(mgsTipoNN)        {
            var dataString = {'ocOPE': $("#OC").attr("opeID") ,'_token':$('#tokenBtn').val() } ;
            $.ajax({
                type: "POST",
                url: "logistica/vwGetTable",
                data: dataString,
                error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                success: function(VR) {
                    $("#divDialog").dialog("close");
                    $('#divOC_Dll').html(VR);

                }
            });
            $('#txOC_NroDoc').prop('readOnly', true);
        }

    }

    return false;
});

$( document ).on( 'keydown',  '#btnLogOCSave , #btnLogOCCancel, #btnLogOCUpd, #btnLogOCDel, #btnLogOCSearch, #btnLogOCNew, #btnLogOCPrint , #btnLogOCBusy , #btnLogOCTrsh',function(e) {
    e.preventDefault();
});

$( document ).on( 'keydown',  '#txOC_No',function(e) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
		
		
        jsFunDBOC_Get( "COD",$("#txOC_No").val());
    }
});

$( document ).on( 'keydown',  '#txOC_NroDoc',function(e) {
    if(e.shiftKey)     {        e.preventDefault();      }
    if(e.keyCode == 13 ) {
        var valor  = $("#txOC_NroDoc").val() ;
        var tipoDoc   = $("#txOC_CodTipoDoc").attr("codID") ;
        if (typeof tipoDoc == "undefined" /*|| tipoDoc=='NN'*/ ) {    jsFnDialogBox(400, 145, "WARNING", null, "::VERIFIQUE SUS DATOS", "Ingrese el Tipo de documento origen"); return;    }
        
		 if ($("#OC").attr("opeID")=="UPD")
			 {
				 var mgs66 = confirm ("==================================== \n - ESTA SEGURO DE BORRAR TODOS LOS ITEM DE LA BASE DE DATOS \n \n\n==================================== \n");
				if(mgs66)
				{			
						 $.ajax({
						type: "POST",
						url: "logistica/spLogSetOCDDel",
						data:{   'ocID': $("#OC").attr("ocID")  ,  '_token': $('#tokenBtnMain').val()} ,

						error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
						success: function (VR) {
							$("#divDialog").dialog("close");
							$(".modal-backdrop").remove();
							//$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
							//$('#dvAviso').modal('show');
							//$("#divOC_Dll").html(VR["vwDll"]);
						}
						});
				}
			}		
		
            jsFunOC_ClearOrigen();
            if (tipoDoc=='CC' )
            {   jsFunDBOC_CCGetData("COD",valor);}
            else if (tipoDoc=='RQ' )
            {  jsFunDBOC_ReqGetData("COD",valor);}
            else if (tipoDoc =='NN')	{
                var dataString = {'ocOPE': $("#OC").attr("opeID") ,'_token':$('#tokenBtn').val() } ;
                $.ajax({
                    type: "POST",
                    url: "logistica/vwGetTable",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                    beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                    success: function(VR) {
                    $("#divDialog").dialog("close");
                    $('#divOC_Dll').html(VR);

                    }
                  });
            }
            else { alert("Tiene que seleccionar un tipo de documento origen"); return ;}
	
	
	
    }
});



$( document ).on( 'click' ,'#btnLogOC_Ruc',function(e) {

});

/************************************************************************************/

/**********************************************************************************************/
/**************** EVENT BUSQ , ADD ROW A DB ***************************************************/
$( document ).on( 'keydown', '#txOC_CodDep, #txOC_CodTipoProc,#txOC_CodSecFun , #txOC_CodRubro ', function( ) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if (event.keyCode == 113) {
        var obj=$(this).attr('name') ;
        if(obj=='txOC_CodDep')   {  obj='DEP';  }
        else if(obj=='txOC_CodSecFun'){  obj='SECFUN';  }
        else if(obj=='txOC_CodRubro') {  obj='RUBRO';  }
        else if(obj=='txOC_CodTipoProc')      {  obj='TPROC';  }

        else { obj="NN"; }

        $("#loadModals").html(jsFunModalBusqudaDatos('BUSQUEDA DE DATOS'));
        $('#modalContBusqDatos').css({'width': '600px', 'height': '400px'});
        $('#modalVentBusqDatos').modal('show');
        $('#modalVentBusqDatos').attr('obj',obj);
    }
});

$( document ).on( 'keydown','#txOC_Ref, #txOC_LugarEnt',function(event) {
    if (event.keyCode == 13) {
        var Evento = $(this).attr('name');
        if(Evento=='txOC_Ref' )   {$("#txOC_CodTipoProc").focus();}
        else if(Evento=='txOC_LugarEnt' ){   $("#txOC_Ref").focus();}
    }
});

$( document ).on( 'keydown','#txOC_CodDep, #txOC_CodTipoProc,#txOC_CodSecFun , #txOC_CodRubro  ',function(event) {
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

        if(Evento=='txOC_CodDep' )   {  obj='DEP'; tipo='COD';  }
        else if(Evento=='txOC_CodSecFun'){  obj='SECFUN'; tipo='COD'; }
        else if(Evento=='txOC_CodRubro') {  obj='RUBRO';  tipo='COD';}
        else if(Evento=='txOC_CodTipoProc')      {  obj='TPROC';  tipo='COD';}
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

                if(Evento=='txOC_CodDep')
                {
                    if (Flg==false) {   $('#txOC_CodDep').attr('codID','NN');  $('#txOC_CodDep').val('');  $('#txOC_Dep').val('');    $( "#txOC_CodDep" ).focus(); }
                    else      {   $('#txOC_CodDep').attr('codID',id);    $('#txOC_CodDep').val(cod); $('#txOC_Dep').val(dsc);   $( "#txOC_CodSecFun" ).focus();  }
                }
                else if(Evento=='txOC_CodSecFun')
                {
                    if (Flg==false) {  $('#txOC_CodSecFun').attr('codID','NN');  $('#txOC_CodSecFun').val('');  $('#txOC_SecFun').val('');    $( "#txOC_CodSecFun" ).focus(); }
                    else      {  $('#txOC_CodSecFun').attr('codID',id);    $('#txOC_CodSecFun').val(cod); $('#txOC_SecFun').val(dsc);   $( "#txOC_CodRubro" ).focus();  }
                }
                else if(Evento=='txOC_CodRubro')
                {
                    if (Flg==false) {  $('#txOC_CodRubro').attr('codID','NN');  $('#txOC_CodRubro').val('');  $('#txOC_Rubro').val('');    $( "#txOC_CodRubro" ).focus(); }
                    else      {  $('#txOC_CodRubro').attr('codID',id);    $('#txOC_CodRubro').val(cod); $('#txOC_Rubro').val(dsc);   $( "#txOC_LugarEnt" ).focus();  }
                }
                else if(Evento=='txOC_CodTipoProc')
                {
                    if (Flg==false) {  $('#txOC_CodTipoProc').attr('codID','NN');  $('#txOC_CodTipoProc').val('');  $('#txOC_TipoProc').val('');    $( "#txOC_CodTipoProc" ).focus(); }
                    else      {  $('#txOC_CodTipoProc').attr('codID',id);    $('#txOC_CodTipoProc').val(cod); $('#txOC_TipoProc').val(dsc);   $( "#txObsv" ).focus();  }
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

$( document ).on( 'click',  '.btn-ocSelect',function(e) {
    e.preventDefault();
    idtmp = $(this).attr("codID");
    $('#modalOCSearch').modal('hide');
    jsFunDBOC_Get( "ID",idtmp);
    $("body").css("overflow"," scroll");

});

$( document ).on( 'click',  '#btnLogOCSearch',function(e) {
    e.preventDefault();
 //   jsFunDBOC_Get( "COD",$("#txOC_No").val());
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOCSearch",
        data:{ '_token': $('#tokenBtnMain').val()} ,

        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $(".modal-backdrop").remove();
            $("#loadModalsMain").html(VR);
            $('#modalOCSearch').modal('show');
        }
    });
});


$( document ).on( 'click',  '#btnLogOCLimpiar ',function(e){

var mgs3 = confirm ('==================================== \n :: ESTA SEGURO DE BORRAR TODOS LOS ITEM DE LA BASE DE DATOS   \n ====================================\n\n\n');
if(mgs3)
	    {
			if ($("#OC").attr("opeID")=="UPD")
			 {
				 $.ajax({
				type: "POST",
				url: "logistica/spLogSetOCDDel",
				data:{   'ocID': $("#OC").attr("ocID")  ,  '_token': $('#tokenBtnMain').val()} ,

				error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
				success: function (VR) {
					$("#divDialog").dialog("close");
					$(".modal-backdrop").remove();
					$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
					$('#dvAviso').modal('show');
					$("#divOC_Dll").html(VR["vwDll"]);
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
		
		

$( document ).on( 'click',  '#btnLogOCSave , #btnLogOCDel',function(e){
    e.preventDefault();

    if(!jsFunOC_Val()){return ; }
    if($(this).attr("id") =="btnLogOCDel")  varOC.ocOPE="DEL" ;

    if(!(varOC.ocOPE=="ADD" || varOC.ocOPE =="UPD"  || varOC.ocOPE=="DEL") || varOC.ocOPE=="NN" )
    {
        $(".modal-backdrop").remove();
        $("#loadModals").html( jsFunLoadAviso('MENSAJE DE ERROR','Se Produjo un ERROR en la Operacion Seleccionado'));
        $('#dvAviso').modal('show');
        return;
    }
    i=0;
    
    if( $('#tbOC_Dll').attr('doc') =="Cdr" || $('#tbOC_Dll').attr('doc') =="Req"  || $('#tbOC_Dll').attr('doc') =="Null"  ) {  varOC.FlgADD = "ADD";  }
    else {  varOC.FlgADD = "NOT";  }
 
    var tmpOS = $("#tbOC_Dll").html();
    var OcDlls = new Array();
    if ( typeof tmpOS != "undefined")
    {
        $('#tbOC_Dll tbody tr').each(function ()  {
                if ($(this).attr("class")!="fila-Hide") {
                    var fila = new Object();
                    fila.ocItm=$(this).find("td[name=tdOcItm]").html();
                    fila.cdItm=$(this).find("td[name=tdCdItm]").html();
                    fila.czItm=$(this).find("td[name=tdCzItm]").html();
                    fila.rqItm=$(this).find("td[name=tdRqItm]").html();

                    fila.secfund=$(this).find("td[name=tdSF]").attr('codID');
                    fila.rubro=$(this).find("td[name=tdRubro]").attr('codID');

                    fila.cant= $(this).find("td[name=tdCant]").html();
                    fila.clasf= $(this).find("td[name=tdClasf]").attr("codID");
                    fila.prod = $(this).find("td[name=tdProd]").attr("codID");
                    fila.und = $(this).find("td[name=tdUnd]").attr("codID");
                    fila.espf = $(this).find("td[name=tdEspf]").html();
                    fila.marca = $(this).find("td[name=tdMarca]").html();
                    fila.precio = $(this).find("td[name=tdPrecio]").html();
                    fila.secFun = $(this).find("td[name=tdSecFun]").attr("codID");
                    fila.envio = 0;
                    OcDlls .push(fila);
                    i++;
                }
        });      
    }else {  alert("Existe un error en los detalles de la orden de compra"); return ;}

     if(i==0 && varOC.ocOPE!="DEL" ){
          $(".modal-backdrop").remove();
          $("#loadModals").html( jsFunLoadAviso('MENSAJE DE ADVERTENCIA','Falta Ingresar los Bienes'));
          $('#dvAviso').modal('show');
          return;
     }
    if(  varOC.ocOPE=="DEL")  varOC.FlgADD = "NOT";

    if (varOC.ocOPE=="ADD" || varOC.ocOPE =="UPD" || varOC.ocOPE=="DEL" ) {
        var fullData = {  'varOC': varOC,   'varOCDll': JSON.parse(JSON.stringify(OcDlls )),   '_token': $('#tokenBtn').val()   }

        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:400 ,height: 140, title: "Confirmar Operacion"});
        if (varOC.ocOPE=="DEL")     $("#divDialogCont").html('Esta seguro que desea ELIMINAR el Registro Seleccionado ? <br> Motivo : <input id ="txOC_Motivo" class="gs-input" style="width:280px;" />');
        else if (varOC.ocOPE=="UPD")     $("#divDialogCont").html('Esta seguro que desea ACTUALIZAR el Registro Seleccionado ? ');
        else if (varOC.ocOPE=="ADD")     $("#divDialogCont").html('Esta seguro que desea GUARDAR el Registro Seleccionado ? ');
        $("#divDialog").dialog({
            buttons: {
                "Aceptar": function () {
					 if(  varOC.ocOPE=="DEL"   ) varOC.ocObsv     = $("#txOC_Motivo").val();
                    $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetOC",
                        data: fullData,
                        beforeSend: function () { jsFnDialogBox(0, 0, "LOAD", null, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
                        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
                        success: function (VR) {
                            $("#divDialog").dialog("close");
                            $(".modal-backdrop").remove();
                            if(VR[0].Error==1){
                                jsFnDialogBox(400, 165, "ERROR", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>"+VR[0].Mensaje+"</strong>");
                            }
                            else { jsFunDBOC_Get("CID",VR[0].OCNo); }
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

$( document ).on( 'click',  '#btnLogOCCancel',function(e) {
    e.preventDefault();
    jsFunOC_Default();
    //jsFunOC_ClearOrigen()
    jsFunOC_EnableText(true);
    jsFunOC_EnableBtns(false);

});
$( document ).on( 'click',  '#btnLogOCNew',function(e) {
    e.preventDefault();
    //jsFunOC_ClearOrigen()

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OC",'_token': $('#tokenBtnMain').val() },
        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
        success: function (VR) { $("#txOC_No").val( VR[0].Codigo ); }
    });

    jsFunOC_Default();
    jsFunOC_EnableText(false);
    jsFunOC_EnableBtns(true);
});
$( document ).on( 'click',  '#btnLogOCUpd',function(e) {
    e.preventDefault();
    if($("#OC").attr("ocID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione la ORDEN DE COMPRA");return ;}
    $("#divDialog").dialog(opt);
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
    $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
    $("#divDialog").dialog("open");
    $("#divDialog").dialog({ width:400 ,height: 175, title: "CONFIRMAR PROCESOS"});
    $("#divDialogCont").html("Esta Seguro de Actualizar el ORDEN DE COMPRA");
    $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
                $("#OC").attr("opeID","UPD");
                jsFunOC_EnableText(false);
                jsFunOC_EnableBtns(true);
                $(this).dialog("close");
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
    });
});
$( document ).on( 'click',  '#btnLogOCDel',function(e) {
    e.preventDefault();
    if($("#OC").attr("ocID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione la ORDEN DE COMPRA");return ;}
    $("#OC").attr("opeID","DEL");
});

$( document ).on( 'click',  '#btnLogOCPrint',function(e) {
    e.preventDefault();
    if($("#OC").attr("ocID")=="NN"){   jsFnDialogBox(400, 145, "WARNING", null, "Resultados de la Peticion", "Primero seleccione la ORDEN DE COMPRA");return ;}
    if(!jsFunOC_ValPrint()){return; }
    window.open("logistica/rptOC/"+$(".txVarAnioEjec").val()+"/"+varOC.ocID+"",'width=275,height=340,scrollbars=NO,location=no');
    //window.open("logistica/rptOC/"+varOC.ocObsv+"",'width=275,height=340,scrollbars=NO,location=no');
});




$( document ).on( 'click',  '#btnLogOCBusy',function(e) {
    e.preventDefault();
    var  Cod="NN";
    var datos = {Anio:$(".txVarAnioEjec").val(), '_token': $('#tokenBtn').val()}

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCodNext",
        data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OC",'_token': $('#tokenBtnMain').val() },
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
            $("#divDialogCont").html("<br>Esta Seguro que desea RESERVAR la O/C Nº :<strong> "+Cod+"<strong>");
            $("#divDialog").dialog({
                buttons: {
                    "Aceptar": function () {

                        var datos = {Anio:$(".txVarAnioEjec").val(), Usr: '00000','_token': $('#tokenBtn').val()}
                        $.ajax({
                            type: "POST",
                            url: "logistica/spLogSetOCBusy",
                            data: datos,
                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");                        },
                            success: function (VR) {
                                $("#divDialog").dialog("close");
                                $(".modal-backdrop").remove();
                                if (VR.length > 0) {
                                    if (VR[0].Error == "0") {
                                        $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE <br> Se ha Reservador la O/C = ' + VR[0].Codigo));
                                        $('#dvAviso').modal('show');
                                        jsFunOC_Default();

                                        $.ajax({
                                            type: "POST",
                                            url: "logistica/spLogGetCodNext",
                                            data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OC",'_token': $('#tokenBtnMain').val() },
                                            error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                                            success: function (VR) { $("#txOC_No").val( VR[0].Codigo ); }
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


$( document ).on( 'click' ,'#btnLogOC_dllEDIT ',function(e) {
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();
    //alert(trCloneHtml);
    $("#tbOC_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {

        $("#tbOC_Dll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide" && $(this).attr("class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });

        trCurrent.html("").append(jsFunOC_EditColumns("UPD")).css("background","#d9edf7").attr("trFocus","ACTIVE");

        //trCurrent.find("td[name=tdID]")   .attr("ocID",trClone .find("td[name=tdID]").attr ("ocID"));
        trCurrent.find("td[name=tdOcItm]")      .html( trClone.find("td[name=tdOcItm]").text() );
        trCurrent.find("td[name=tdCdItm]")      .html( trClone.find("td[name=tdCdItm]").text() );
        trCurrent.find("td[name=tdCzItm]")      .html( trClone.find("td[name=tdCzItm]").text() );
        trCurrent.find("td[name=tdRqItm]")      .html( trClone.find("td[name=tdRqItm]").text() );

        trCurrent.find("td[name=tdSF]").find('input[id=txProdSF]').val(trClone.find("td[name=tdSF]").text().trim());
        trCurrent.find("td[name=tdRubro]").find('input[id=txProdRubro]').val(trClone.find("td[name=tdRubro]").text().trim());

        trCurrent.find("td[name=tdSecFun]")    .find('input[id=txProdSecFun]')      .val(trClone .find("td[name=tdSecFun]").text().trim());

        trCurrent.find("td[name=tdCant]")    .find('input[id=txProdCant]')      .val(trClone .find("td[name=tdCant]").text().trim());
        trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]')     .val(trClone .find("td[name=tdClasf]").text()) ;
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]')      .val(trClone .find("td[name=tdProd]").text()) ;
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]')       .val(trClone .find("td[name=tdUnd]").text())  ;
        trCurrent.find("td[name=tdEspf]")    .find('textarea[id=txProdEspf]')   .val(trClone .find("td[name=tdEspf]").text()) ;

        trCurrent.find("td[name=tdPrecio]")  .find('input[id=txProdPrecio]')    .val(trClone .find("td[name=tdPrecio]").text().trim());
		trCurrent.find("td[name=tdEnvio]")  .find('input[id=txProdEnvio]')    .val(trClone .find("td[name=tdEnvio]").text().trim());
        trCurrent.find("td[name=tdMarca]")  .find('input[id=txProdMarca]')    .val(trClone .find("td[name=tdMarca]").text().trim());

        trCurrent.find("td[name=tdSF]")   .find('input[id=txProdSF]').attr("codID",trClone .find("td[name=tdSF]").attr ("codID"));
        trCurrent.find("td[name=tdRubro]")   .find('input[id=txProdRubro]').attr("codID",trClone .find("td[name=tdRubro]").attr ("codID"));

        trCurrent.find("td[name=tdClasf]")   .find('input[id=txProdClasf]').attr("codID",trClone .find("td[name=tdClasf]").attr ("codID"));
        trCurrent.find("td[name=tdProd]")    .find('input[id=txProdProd]').attr("codID",trClone .find("td[name=tdProd]").attr ("codID"));
        trCurrent.find("td[name=tdUnd]")     .find('input[id=txProdUnd]') .attr("codID",trClone .find("td[name=tdUnd]").attr ("codID"));
        trCurrent.find("td[name=tdSecFun]")     .find('input[id=txProdSecFun]') .attr("codID",trClone .find("td[name=tdSecFun]").attr ("codID"));

        varOCDll.OPE="UPD";
    }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }

});

$( document ).on( 'click' ,'#btnLogOC_dllCANCEL',function(e) {
    filaHide="";
   if(varOCDll.OPE=="UPD") {
       $("#tbOC_Dll tr").each(function () {
           if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
               filaHide = $(this).html();
       });
       $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");
   }
    else
   {
       $("#dvBarraOCAdd").css({'background': '#efefef'});
       $("#dvBarraOCAdd").css({'display': 'none'});
   }

});


$( document ).on( 'click' ,'#btnLogReq_dllCANCEL',function(e) {
    //filaHide="";
    
   $("#tbCC_Bienes tr").each(function () {
           if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
               filaHide = $(this).html();
       });
       //alert(filaHide);
	   $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");
   
   

});


$( document ).on( 'click' ,'#btnLogOC_dllSAVE',function(e) {
   var trCurrent = $(this).parent().parent();
   var trClone = $(this).parent().parent().clone();

          

   if($("#tbOC_Dll").attr('doc')=="Odc"   )  //||  ($("#tbOC_Dll").attr('doc')=="Null" && $("#OC").attr("opeID") =="UPD" ) 
   {         

            varOCDll.OCID =$("#OC").attr("ocID");
            varOCDll.ocItm=trClone.find("td[name=tdOcItm]").html();
            varOCDll.cdItm=trClone.find("td[name=tdCdItm]").html();
            varOCDll.czItm=trClone.find("td[name=tdCzItm]").html();
            varOCDll.rqItm=trClone.find("td[name=tdRqItm]").html();

            varOCDll.prodsf = trClone.find("td[name=tdSF]").find('input[id=txProdSF]').attr("codID");
            varOCDll.prorubro = trClone.find("td[name=tdRubro]").find('input[id=txProdRubro]').attr("codID");

            varOCDll.prodSecFun=trClone.find("td[name=tdSecFun]").find('input[id=txProdSecFun]').attr("codID");
            varOCDll.prodCant=trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val( );
            varOCDll.prodID=trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID");
            varOCDll.prodUndID=trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID");
            varOCDll.prodClasfID=trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID");
            varOCDll.prodEspf=trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val( );
            varOCDll.prodMarca=trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val( );
            varOCDll.prodPrecio=trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val( );
            varOCDll.prodEnvio=trClone.find("td[name=tdEnvio]").find('input[id=txProdEnvio]').val( );

            varOCDll.prodUsrID="NN";
              reqErrores="<p>";
            if ( parseFloat(varOCDll.prodCant).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Cantidad '; }
            if ( parseFloat(varOCDll.prodPrecio).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Precio Unitario '; }
            if ( parseFloat(varOCDll.prodEnvio).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Envio '; }
            if ( parseFloat(varOCDll.prodUndID).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Unidad '; }
           
            if ( varOCDll.prodID== "NN") {  reqErrores+=' <br> * Seleccione el Producto de Catalogo '; }
            if ( varOCDll.prodClasfID== "NN") {  reqErrores+=' <br> * Clasificador '; }
            if ( varOCDll.prodSecFun== "NN") {  reqErrores+=' <br> * Secuencia Funcional '; }
            reqErrores+="</p>";
            if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }


            var datos = {
                varBns:varOCDll,
                '_token': $('#tokenBtn').val()
            }
            $.ajax({
                type: "post",
                url: "logistica/spLogSetOCD",
                data: datos,
                beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
                success: function (VR) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();
                    //$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
                    //$('#dvAviso').modal('show');
                    $("#divOC_Dll").html(VR["vwDll"]);
                }
            });

             
   }
   else 
   {
        $("#tbOC_Dll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide"  )
                     tmp =  $(this).html();
        });


        trCurrent.html("").append(tmp).css("background","#d9edf7").attr("trFocus","ACTIVE");
       
        trCurrent.find("td[name=tdOcItm]").html(trClone.find("td[name=tdOcItm]").text());
        trCurrent.find("td[name=tdCdItm]").html(trClone.find("td[name=tdCdItm]").text());
        trCurrent.find("td[name=tdCzItm]").html(trClone.find("td[name=tdCzItm]").text());
        trCurrent.find("td[name=tdRqItm]").html(trClone.find("td[name=tdRqItm]").text());

        trCurrent.find("td[name=tdCant]").html(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val());
        trCurrent.find("td[name=tdClasf]").html(trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').val());
        trCurrent.find("td[name=tdProd]").html(trClone.find("td[name=tdProd]").find('input[id=txProdProd]').val());
        trCurrent.find("td[name=tdUnd]").html(trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').val());
        trCurrent.find("td[name=tdEspf]").html(trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val());
        trCurrent.find("td[name=tdSecFun]").html(trClone.find("td[name=tdSecFun]").find('textarea[id=txProdSecFun]').val());

        trCurrent.find("td[name=tdPrecio]").html(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val());
        trCurrent.find("td[name=tdMarca]").html(trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val());
        trCurrent.find("td[name=tdEnvio]").html(trClone.find("td[name=tdEnvio]").find('input[id=txProdEnvio]').val());

        trCurrent.find("td[name=tdClasf]").attr("codID", trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID"));
        trCurrent.find("td[name=tdProd]").attr("codID", trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID"));
        trCurrent.find("td[name=tdUnd]").attr("codID", trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));
        trCurrent.find("td[name=tdSecFun]").attr("codID", trClone.find("td[name=tdSecFun]").find('input[id=txProdSecFun]').attr("codID"));

        var cant = parseFloat(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
        var precioUnt = parseFloat(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val()).toFixed(2)
        var total       = parseFloat( cant*precioUnt).toFixed(4);
        trCurrent.find("td[name=tdTotal]").html(total);
        trCurrent.removeAttr("style").removeAttr("trFocus");          
        $("#tbOC_Dll").append(trCurrent);


   }
    $("#dvBarraOCAdd").css({'background': '#efefef'});
    $("#dvBarraOCAdd").css({'display': 'none'});
});




$(document).on('click , keydown','#btnLogOCItem',function(e) {
    e.preventDefault();
    //
    flg= false;   
    $("#tbOC_Dll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(flg){jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>");return; }

    $(".modal-backdrop").remove();
    if ($("#OC").attr("opeID")=="UPD") filaBase= jsFunOC_EditColumns("UPD") ;
    else filaBase= jsFunOC_EditColumns("NEW") ;

    //filaBase= jsFunOC_EditColumns() ;

    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#tbBarraBienes").prepend("<tr VALIGN='top'>"+filaBase+"</tr>");
    $("#dvBarraOCAdd").css({'background': '#d9edf7'});
    $("#dvBarraOCAdd").css({'display': 'inherit'});
    varOCDll.OPE="ADD";
});



$(document).on('click , keydown','#btnLogReq_dllSalir',function(e) {
    e.preventDefault();
    //
	 $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
  $("#dvBarraOCAdd").css({'background': '#efefef'});
						$("#dvBarraOCAdd").css({'display': 'none'});
});




$( document ).on( 'click' ,'#btnLogOC_dllDEL ',function(e) {



    var msg= confirm("ESTA SEGURO QUE DESEA ELIMINAR EL REGISTRO");
	if(msg)
	{	
						var trCloneFILAS = $(this).parent().parent();
						varOCDll.OPE="DEL";
						varOCDll.OCID =$("#OC").attr("ocID");
						varOCDll.ocItm=trCloneFILAS.find("td[name=tdOcItm]").html();
                        varOCDll.cdItm=trCloneFILAS.find("td[name=tdCdItm]").html();
                        varOCDll.czItm=trCloneFILAS.find("td[name=tdCzItm]").html();
                        varOCDll.rqItm=trCloneFILAS.find("td[name=tdRqItm]").html();

						varOCDll.prodCant=trCloneFILAS.find("td[name=tdCant]").html( );
						varOCDll.prodID=trCloneFILAS.find("td[name=tdProd]").attr("codID");
						
						varOCDll.prodUndID=trCloneFILAS.find("td[name=tdUnd]").attr("codID");
						varOCDll.prodClasfID=trCloneFILAS.find("td[name=tdClasf]").attr("codID");
						varOCDll.prodEspf=trCloneFILAS.find("td[name=tdEspf]").html( );
						varOCDll.prodMarca=trCloneFILAS.find("td[name=tdMarca]").html( );
						varOCDll.prodPrecio=trCloneFILAS.find("td[name=tdPrecio]").html( );
                        varOCDll.prodSecFun=trCloneFILAS.find("td[name=tdSecFun]").attr("codID");
						varOCDll.prodUsrID="NN";


						var datos = {
							varBns:varOCDll,
							'_token': $('#tokenBtn').val()
						}
						$.ajax({
							type: "post",
							url: "logistica/spLogSetOCD",
							data: datos,
							beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
							error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
							success: function (VR) {
								$("#divDialog").dialog("close");
								$(".modal-backdrop").remove();
								//$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["varReturns"][0].Mensaje ));
								//$('#dvAviso').modal('show');
								$("#divOC_Dll").html(VR["vwDll"]);
							}
						});
						$("#dvBarraOCAdd").css({'background': '#efefef'});
						$("#dvBarraOCAdd").css({'display': 'none'});


   }


});




/*****************************************************************************************************************************/
/****** FUNCTION VALIDTION ************************************************************************************************/

function jsFunOC_ValPrint()
{
    $(".modal-backdrop").remove();

    var ocOPE   = $("#OC").attr("opeID");
    var ocID    = $("#OC").attr("ocID");
    var ocAnio  = $("#OC").attr("anioID");
    var ocFecha = $('#txOC_Fecha').val();

    var ocTipoProc  = $('#txOC_CodTipoProc').attr("codID");
    var ocDep       = $('#txOC_CodDep').attr("codID");
    var ocSecFun    = $('#txOC_CodSecFun').attr("codID");
    var ocRubro     = $('#txOC_CodRubro').attr("codID");
    var ocGlosa     = $('#txOC_Glosa').val();

    var ocRuc       = $('#txOC_Ruc').attr("codID");
    var ocPlazo     = $('#txOC_Plazo').val();
    var ocGarantia  = $('#txOC_Garantia').val();
    var ocIGV       = $('#txOC_IGV').val();
    var ocLugar     = $('#txOC_LugarEnt').val();
    var ocRef       = $('#txOC_Ref').val();
    var ocObsv      = $('#txOC_Obsv').val();
    //var ocCondicion      = $('#txOC_Condicion').val();
    var ocCondicion      = $('#txOC_Condicion').parent().find('.note-editable').html();
    
      var ocSubTotal  = 0;
    var ocDescuento = $('#txOC_tDesc').val();
    var ocEnvio     = $('#txOC_tEnvio').val();
    var ocTotal     = 0;
    


    var ocReq     = $('#OC').attr("reqID");
    var ocCtz     = $('#OC').attr("ctzID");
    var ocCdr      = $('#OC').attr("cdrID");

  
    varOC.ocAnio= ocAnio;
    varOC.ocOPE = ocOPE ;
    varOC.ocID = ocID;
    varOC.ocFecha = ocFecha;

    varOC.ocTipoProcID = ocTipoProc;
    varOC.ocDepID = ocDep;
    varOC.ocSecFunID = ocSecFun;
    varOC.ocRubroID = ocRubro;
    varOC.ocGlosa= ocGlosa;
    varOC.ocRuc = ocRuc;
    varOC.ocPlazo = ocPlazo;
    varOC.ocIGV = ocIGV;
    varOC.ocGarantia = ocGarantia;
    varOC.ocCondicion = ocCondicion;

    varOC.ocLugar = ocLugar;
    varOC.ocRef  = ocRef;
    varOC.ocObsv     = ocObsv;
    varOC.ocReqID     = ocReq;
    varOC.ocCtzID     = ocCtz;
    varOC.ocCdrID     = ocCdr;
    varOC.ocUsrID     = "000000";
    varOC._token = $('#tokenBtn').val();
    
    varOC.ocSubTotal = ocSubTotal ;
    varOC.ocDescuento = ocDescuento;
    varOC.ocEnvio = ocEnvio ;
    varOC.ocTotal = ocTotal;
    
    return true ;

}



function jsFunOC_Val()
{
    $(".modal-backdrop").remove();

    var ocOPE   = $("#OC").attr("opeID");
    var ocID    = $("#OC").attr("ocID");
    var ocAnio  = $("#OC").attr("anioID");
    var ocFecha = $('#txOC_Fecha').val();

    var ocTipoProc  = $('#txOC_CodTipoProc').attr("codID");
    var ocDep       = $('#txOC_CodDep').attr("codID");
    var ocSecFun    = $('#txOC_CodSecFun').attr("codID");
    var ocRubro     = $('#txOC_CodRubro').attr("codID");
    var ocGlosa     = $('#txOC_Glosa').val();

    var ocRuc       = $('#txOC_Ruc').attr("codID");
    var ocPlazo     = $('#txOC_Plazo').val();
    var ocGarantia  = $('#txOC_Garantia').val();
    var ocIGV       = $('#txOC_IGV').val();
    var ocLugar     = $('#txOC_LugarEnt').val();
    var ocRef       = $('#txOC_Ref').val();
    var ocObsv      = $('#txOC_Obsv').val();
    //var ocCondicion      = $('#txOC_Condicion').val();
    var ocCondicion      = $('#txOC_Condicion').parent().find('.note-editable').html();
	
	  var ocSubTotal  = 0;
    var ocDescuento = $('#txOC_tDesc').val();
    var ocEnvio     = $('#txOC_tEnvio').val();
    var ocTotal     = 0;
	


    var ocReq     = $('#OC').attr("reqID");
    var ocCtz     = $('#OC').attr("ctzID");
    var ocCdr      = $('#OC').attr("cdrID");

    var reqErrores="<p>";
    if(ocOPE=="UDP"  || ocOPE=="DEL") if (typeof ocID != "undefined"){  if(ocID=="NN" ||   ocID.length<4){  reqErrores+=' <br> * Nro del Requerimiento '; } } else {  reqErrores+= ' <br> * Nro del Requerimiento ';  }
    if (typeof ocAnio != "undefined"){  if(ocAnio =="NN" ||   ocAnio .length<4){  reqErrores+=' <br> * Año '; } } else {  reqErrores+= ' <br> * Año ';  }
    if (typeof ocFecha != "undefined"){  if(ocFecha =="NN" ||   ocFecha.length<8){  reqErrores+=' <br> * Fecha '; } } else {  reqErrores+= ' <br> * Fecha ';  }
    if (typeof ocTipoProc != "undefined"){  if(ocTipoProc=="NN" ||   ocTipoProc.length<2){  reqErrores+=' <br> * Tipo de Proceso'; } } else {  reqErrores+= ' <br> * Tipo de Proceso ';  }
    if (typeof ocDep != "undefined"){  if(ocDep =="NN" ||   ocDep .length<3){  reqErrores+=' <br> * Dependencia'; } } else {  reqErrores+= ' <br> * La Dependencia  ';  }
    if (typeof ocSecFun != "undefined"){  if(ocSecFun=="NN" ||   ocSecFun.length<3){  reqErrores+=' <br> * Secuencia Funcional'; } } else {  reqErrores+= ' <br > * La Secuencia Funcional  ';  }
    if (typeof ocRubro != "undefined"){  if(ocRubro=="NN" ||   ocRubro.length<2){  reqErrores+=' <br> * Rubro '; } } else {  reqErrores+= ' <br> * Rubro ';  }
    if (typeof ocRuc != "undefined"){  if(ocRuc=="NN" ||   ocRuc.length<2){  reqErrores+=' <br> * Nro de RUC '; } } else {  reqErrores+= ' <br> * Nro de RUC ';  }

	if (typeof ocSubTotal == "undefined"){  ocSubTotal=0;  }
    if (typeof ocDescuento == "undefined"){  ocDescuento=0;  }
    if (typeof ocEnvio == "undefined"){  ocEnvio=0;  }
    if (typeof ocTotal == "undefined"){  ocTotal=0;  }

    if ( parseFloat(ocEnvio).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Costo de Envio '; }
    if ( parseFloat(ocDescuento).toFixed(2).toString() == "NaN") {  reqErrores+=' <br> * Descuentos '; }


    if(ocPlazo.length<1){  reqErrores+=' <br> * Plazo '; }
    if(ocIGV.length<2){  reqErrores+=' <br> * IGV'; }
    if(ocLugar.length<3){  reqErrores+=' <br> * Lugar de Entrega'; }
    if(ocRef.length<3){  reqErrores+=' <br> * Referencia Documentaria'; }

    reqErrores+="</p>";
    if(reqErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',reqErrores));  $('#dvAviso').modal('show');   return false ; }

    varOC.ocAnio= ocAnio;
    varOC.ocOPE = ocOPE ;
    varOC.ocID = ocID;
    varOC.ocFecha = ocFecha;

    varOC.ocTipoProcID = ocTipoProc;
    varOC.ocDepID = ocDep;
    varOC.ocSecFunID = ocSecFun;
    varOC.ocRubroID = ocRubro;
    varOC.ocGlosa= ocGlosa;
    varOC.ocRuc = ocRuc;
    varOC.ocPlazo = ocPlazo;
    varOC.ocIGV = ocIGV;
    varOC.ocGarantia = ocGarantia;
    varOC.ocCondicion = ocCondicion;

    varOC.ocLugar = ocLugar;
    varOC.ocRef  = ocRef;
    varOC.ocObsv     = ocObsv;
    varOC.ocReqID     = ocReq;
    varOC.ocCtzID     = ocCtz;
    varOC.ocCdrID     = ocCdr;
    varOC.ocUsrID     = "000000";
    varOC._token = $('#tokenBtn').val();
	
	varOC.ocSubTotal = ocSubTotal ;
    varOC.ocDescuento = ocDescuento;
    varOC.ocEnvio = ocEnvio ;
    varOC.ocTotal = ocTotal;
	
    return true ;

}
/*****************************************************************************************************************************/
/****** FUNCTION GET DATABASE ************************************************************************************************/


function jsFunDBOC_Get( Tipo , valor)
{
    jsFunOC_ClearOrigen();
    var qry = "";
    if(Tipo=="COD")
    {
        qry=" and  cast(substring (ocCodigo,4,5) as int ) = "+valor;
    }
    else
    {
        qry=" and ocid = '"+valor+"'";
    }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOCTmp",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(VR["OC"].length>0)
            {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();

                //$("#OC").attr("ocEtapa",VR["Req"][0].reqEtapa);
                $("#OC").attr("anioID",VR["OC"][0].ocAnio);
                $("#OC").attr("ocID", VR["OC"][0].ocID);
                $("#OC").attr("ctzID", VR["OC"][0].ocCtzID);
                $("#OC").attr("cdrID", VR["OC"][0].ocCcID);
                $("#OC").attr("reqID", VR["OC"][0].ocReqID);

                $('#txOC_Fecha').val(VR["OC"][0].ocFechaFormat);
                $('#txOC_No').val(VR["OC"][0].ocCodigo);
                $('#txOC_Etapa').html(VR["OC"][0].ocEtapa);


                if( VR["OC"][0].ocCcID.length>5){
                    $('#txOC_NroDoc').val(VR["OC"][0].ocCcCod);
                    $('#txOC_CodTipoDoc').attr("codID","CC");
                    $('#txOC_TipoDoc').text("Cuadro Comp.");
                }
                else
                {
                    if( VR["OC"][0].ocReqID.length>5){
                        $('#txOC_NroDoc').val(VR["OC"][0].ocReqCod);
                        $('#txOC_CodTipoDoc').attr("codID","RQ");
                        $('#txOC_TipoDoc').text("Requerimiento");
                    }
					else {
						$('#txOC_NroDoc').val("-");
                        $('#txOC_CodTipoDoc').attr("codID","NN");
                        $('#txOC_TipoDoc').text("Sin Origen");
					}
                }

                $('#txOC_CodDep').attr('codID',VR["OC"][0].ocDepID);
                $('#txOC_CodDep').val(VR["OC"][0].ocDepCod);
                $('#txOC_Dep').val(VR["OC"][0].ocDepDsc);
                $('#txOC_CodSecFun').attr("codID",VR["OC"][0].ocSecFunID);
                $('#txOC_CodSecFun').val(VR["OC"][0].ocSecFunCod);
                $('#txOC_SecFun').val(VR["OC"][0].ocSecFunDsc);
                $('#txOC_CodRubro').attr("codID",VR["OC"][0].ocRubroID);
                $('#txOC_CodRubro').val(VR["OC"][0].ocRubroCod);
                $('#txOC_Rubro').val(VR["OC"][0].ocRubroDsc);
                $('#txOC_LugarEnt').val(VR["OC"][0].ocLugar);
                $('#txOC_Glosa').val(VR["OC"][0].ocGlosa);
                $('#txOC_Ref').val(VR["OC"][0].ocRef);
                $('#txOC_CodTipoProc').val(VR["OC"][0].ocTipoProcCod);
                $('#txOC_TipoProc').val(VR["OC"][0].ocTipoProcDsc);
                $('#txOC_CodTipoProc').attr("codID",VR["OC"][0].ocTipoProcID);
				
				 if( $('#txOC_CodTipoProc').attr("codID") !="009" )
                {
                    $('#txOC_tSubTotal').val(0);
                    $('#txOC_tDesc').val(0);
                    $('#txOC_tEnvio').val(0);
                    $('#txOC_tTotal').val(0);
                  //  $('#txOC_tSubTotal').prop('disabled',true);
                  //  $('#txOC_tDesc').prop('disabled',true);
                  //  $('#txOC_tEnvio').prop('disabled',true);
                    //$('#txOC_tTotal').prop('disabled',true);

                }
                else
                {
                        $('#txOC_tSubTotal').val(VR["OC"][0].ocMonto);
                        $('#txOC_tDesc').val(VR["OC"][0].ocDescuento);
                        $('#txOC_tEnvio').val(VR["OC"][0].ocEnvio);
                        $('#txOC_tTotal').val(VR["OC"][0].ocTotal);
                    $('#txOC_tSubTotal').prop('disabled',false);
                    $('#txOC_tDesc').prop('disabled',false);
                    $('#txOC_tEnvio').prop('disabled',false);
                    //$('#txOC_tTotal').prop('disabled',false);

                }

				 $("#lblExp").html(VR["Exp"][0].msg);

                $('#txOC_Ruc').attr("codID",VR["OC"][0].ocRUC);
                $('#txOC_Ruc').val(VR["OC"][0].ocRUC);
                $('#txOC_RSocial').val(VR["OC"][0].ocRazon);
                $('#txOC_Plazo').val(VR["OC"][0].ocPlazo);
                $('#txOC_Garantia').val(VR["OC"][0].ocGarantia);
                $('#txOC_IGV').val(VR["OC"][0].ocIGV);
                $('#txOC_Obsv').val(VR["OC"][0].ocObsv);
                //$('#txOC_Condicion').val(VR["OC"][0].ocCondicion);
                $('#txOC_Condicion').parent().find('.note-editable').html(VR["OC"][0].ocCondicion);
				$('.note-editable p').css('margin','0px');
                $("#divOC_Dll").html(VR["OCDll"]);
                //$("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION', 'Los Datos fueron Procesados CORRECTAMENTE'));
                //$('#dvAviso').modal('show');
                jsFunOC_EnableText(true);
                jsFunOC_EnableBtns(false);
            }
            else
            {    jsFunOC_Default(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
        }
    });

}

function jsFunDBOC_CCGetData(Tipo,valor)
{
    var qry = "";
    if(Tipo=="COD")      {   qry="  AND cast(substring (cdrcodigo,4,5) as int ) = "+valor;  }
    else if (Tipo=="CID") {   qry=" and cdrid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOC_CCVal",
        data: dataString,
        beforeSend: function () {
            jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");
        },
        error: function () {
            jsFunCdrClear();
            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
        },
        success: function (VR) {

            if (VR["CC"].length > 0) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();

                $("#OC").attr("cdrID",VR["CC"][0].cdrID);
                $("#OC").attr("ctzID",VR["CC"][0].cdrOrgID);
                $('#txOC_NroDoc').val(VR["CC"][0].cdrCodigo);

                $("#OC").attr("fteID",VR["AdjDll"][0].fteID);
                $("#txOC_Ruc").attr("codID",VR["AdjDll"][0].fteRuc);
                $("#txOC_Ruc").val(VR["AdjDll"][0].fteRuc);
                $("#txOC_RSocial").val(VR["AdjDll"][0].fteRazon);
                $("#txOC_Plazo").val(VR["AdjDll"][0].ftePlazo);
                $("#txOC_Garantia").val(VR["AdjDll"][0].fteGarantia);
                $("#txOC_IGV").val(VR["AdjDll"][0].fteIgv);
                $("#txOC_LugarEnt").val(VR["CC"][0].cdrLugarEnt);
                $("#divOC_Dll").html(VR["OcDll"]);

                $("#OC").attr("reqID",VR["Req"][0].reqID);
                $("#txOC_CodDep").val(VR["Req"][0].reqDepCod);
                $("#txOC_CodDep").attr("codID",VR["Req"][0].reqDepID);
                $("#txOC_Dep").val(VR["Req"][0].reqDepDsc);
                $("#txOC_CodSecFun").attr("codID",VR["Req"][0].reqSecFunID);
                $("#txOC_CodSecFun").val(VR["Req"][0].reqSecFunCod);
                $("#txOC_SecFun").val(VR["Req"][0].reqSecFunDsc);
                $("#txOC_CodRubro").attr("codID",VR["Req"][0].reqRubroID);
                $("#txOC_CodRubro").val(VR["Req"][0].reqRubroCod);
                $("#txOC_Rubro").val(VR["Req"][0].reqRubroDsc);
                $("#txOC_Glosa").val(VR["Req"][0].reqGlosa);
                
                
               // $("#txOC_Ref").val(VR["Ref"][0].Ref);
                

            }
            else {
               
                jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");
            }

        }
    });

}


function jsFunDBOC_ReqGetData(Tipo,valor)
{
    var qry = "";
    if(Tipo=="COD")      {   qry=" and  cast(substring (reqid,8,4) as int ) = "+valor;  }
    else if (Tipo=="CID") {   qry=" and  reqrid = '"+valor+"'";  }
    var token= $('#tokenBtn').val();
    var dataString = {'prRows':' top 1 ','prAnio': $(".txVarAnioEjec").val() ,'prQry':qry ,  'ocOPE':$("#OC").attr("opeID") , 'ocID':$("#OC").attr("ocID") ,'_token':token  } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOCReq",
        data: dataString,
        beforeSend: function () {
            jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");
        },
        error: function () {
            jsFunCdrClear();
            jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
        },
        success: function (VR) {

            if (VR["Req"].length > 0) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                //$("#OC").attr("cdrID",VR["CC"][0].cdrID);
                //$("#OC").attr("ctzID",VR["CC"][0].cdrCtzID);
                $('#txOC_NroDoc').val(VR["Req"][0].reqCodigo);
                $("#OC").attr("reqID",VR["Req"][0].reqID);
                $("#txOC_CodDep").val(VR["Req"][0].reqDepCod);
                $("#txOC_CodDep").attr("codID",VR["Req"][0].reqDepID);
                $("#txOC_Dep").val(VR["Req"][0].reqDepDsc);
                $("#txOC_CodSecFun").attr("codID",VR["Req"][0].reqSecFunID);
                $("#txOC_CodSecFun").val(VR["Req"][0].reqSecFunCod);
                $("#txOC_SecFun").val(VR["Req"][0].reqSecFunDsc);
                $("#txOC_CodRubro").attr("codID",VR["Req"][0].reqRubroID);
                $("#txOC_CodRubro").val(VR["Req"][0].reqRubroCod);
                $("#txOC_Rubro").val(VR["Req"][0].reqRubroDsc);
                $("#txOC_LugarEnt").val(VR["Req"][0].reqLugarEnt);
               // $("#txOC_Ref").val(VR["Ref"][0].Ref);
                $("#txOC_Glosa").val(VR["Req"][0].reqGlosa);
                $("#divOC_Dll").html(VR["vwDll"]);
            }
            else {
                // jsFunCdrClear();
                jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");
            }

        }
    });

}
/*****************************************************************************/
/*****************************************************************************/

function jsFunOC_Default()
{
    $('#txOC_No').val("");
    $("#OC").attr("ocEtapa","NN");
    $("#OC").attr("opeID","ADD");
    $("#OC").attr("ocID","NN");
    $("#OC").attr("anioID",$(".txVarAnioEjec").val() );
    $('#txOC_Fecha').val("");
    $('#txOC_CodTipoDoc').attr("codID","NN");
    $('#txOC_TipoDoc').text("");


    jsFunOC_ClearOrigen();
}

function jsFunOC_ClearOrigen()
{
    $("#OC").attr("cdrID","NN");
    $("#OC").attr("fteID","NN");
    $("#OC").attr("ctzID","NN");
    $("#OC").attr("reqID","NN");

    $('#txOC_NroDoc').val("");
    $('#txOC_NroDoc').attr("codID","NN");


    $('#txOC_CodDep').val("");
    $('#txOC_Dep').val("");
    $('#txOC_CodSecFun').val("");
    $('#txOC_SecFun').val("");
    $('#txOC_CodRubro').val("");
    $('#txOC_Rubro').val("");
    $('#txOC_Ref').val("");
    $('#txOC_LugarEnt').val("");
    $('#txOC_CodTipoProc').val("");
    $('#txOC_TipoProc').val("");
    $('#txOC_Obsv').val("");
    $('#txOC_Condicion').val("");
    $('#txOC_Condicion').parent().find('.note-editable').html("");
    $('#txOC_Glosa').val("");

    $('#txOC_CodDep').attr("codID","NN");
    $('#txOC_CodSecFun').attr("codID","NN");
    $('#txOC_CodRubro').attr("codID","NN");
    $('#txOC_CodTipoProc').attr("codID","NN");
    $('#txOC_Ruc').attr("codID","NN");

    $('#txOC_Ruc').val("");
    $('#txOC_RSocial').val("");
    $('#txOC_Plazo').val("");
    $('#txOC_IGV').val("");
    $('#txOC_Garantia').val("");
	
	$('#txOC_tSubTotal').val(0);
	$('#txOC_tDesc').val(0);
	$('#txOC_tEnvio').val(0);
	

    $('#txOC_Etapa').html("");
    $('#divOC_Dll').html("");
    //$('#txOC_Fecha').val(moment().format('YYYY-MM-DD'));
	$('.note-editable p').css('margin','0px');
    
    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#dvBarraOCAdd").css({'background': '#efefef'});
    $("#dvBarraOCAdd").css({'display': 'none'});
}

function jsFunOC_EnableText (flg)
{
    $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
    $("#dvBarraOCAdd").css({'background': '#efefef'});
    $("#dvBarraOCAdd").css({'display': 'none'});

    $('#txOC_No').prop('disabled', !flg);
    $('#txOC_Fecha').prop('disabled', flg);
    $('#txOC_CodTipoDoc').prop('disabled', flg);
    $('#txOC_NroDoc').prop('disabled', flg);
    $('#txOC_CodDep').prop('disabled', flg);
    $('#txOC_Dep').prop('disabled', true);
    $('#txOC_CodSecFun').prop('disabled', flg);
    $('#txOC_SecFun').prop('disabled', true);
    $('#txOC_CodRubro').prop('disabled', flg);
    $('#txOC_Rubro').prop('disabled', true);
    $('#txOC_Ref').prop('disabled', flg);
    $('#txOC_LugarEnt').prop('disabled', flg);
    $('#txOC_CodTipoProc').prop('disabled', flg);
    $('#txOC_TipoProc').prop('disabled', true);
    $('#txOC_Obsv').prop('disabled', flg);
    $('#txOC_Condicion').prop('disabled', flg);
    $('#txOC_Glosa').prop('disabled', flg);
    $('.note-editable').attr('contenteditable', !flg);
    $('#txOC_Ruc').prop('disabled', flg);
    $('#txOC_RSocial').prop('disabled', flg);
    $('#txOC_Plazo').prop('disabled', flg);
    $('#txOC_IGV').prop('disabled', flg);
    $('#txOC_Garantia').prop('disabled', flg);
    $('#btnOC_Ruc').prop('disabled', flg);
	
	$('#txOC_tSubTotal').prop('disabled', flg);
	$('#txOC_tDesc').prop('disabled', flg);
	$('#txOC_tEnvio').prop('disabled', flg);
	
    if(flg) {
        $('#tbOC_Dll tbody tr').each(function () {
            $(this).find('button[id=btnLogOC_dllEDIT]').parent().addClass("fila-Hide");
          $(this).find('button[id=btnLogOC_dllDEL]').parent().addClass("fila-Hide");
          $(this).find('button[id=btnLogOC_dllEDIT]').addClass("fila-Hide");
          $(this).find('button[id=btnLogOC_dllDEL]').addClass("fila-Hide");			
		
        });
    }
    else
    {
        $('#tbOC_Dll tbody tr').each(function () {
          $(this).find('button[id=btnLogOC_dllEDIT]').parent().removeClass("fila-Hide");
          $(this).find('button[id=btnLogOC_dllDEL]').parent().removeClass("fila-Hide");
          $(this).find('button[id=btnLogOC_dllEDIT]').removeClass("fila-Hide");
          $(this).find('button[id=btnLogOC_dllDEL]').removeClass("fila-Hide");
		
        });
    }
}

function jsFunOC_EnableBtns(flg)
{
    if(!flg) {
        $("#btnLogOCSave")     .addClass("fila-Hide");
        $("#btnLogOCCancel")   .addClass("fila-Hide");
        $("#btnLogOCNew")      .removeClass("fila-Hide");
        $("#btnLogOCUpd")      .removeClass("fila-Hide");
        $("#btnLogOCDel")      .removeClass("fila-Hide");
        $("#btnLogOCPrint")    .removeClass("fila-Hide");
        $("#btnLogOCBusy")     .removeClass("fila-Hide");
        $("#btnLogOCLeft")     .removeClass("fila-Hide");
        $("#btnLogOCRight")     .removeClass("fila-Hide");
        $("#btnLogOCSearch")     .removeClass("fila-Hide");
		$("#btnLogOCItem")     .addClass("fila-Hide");
		$("#btnLogOCIgv")     .addClass("fila-Hide");
		$("#btnLogOCCatalogo")     .addClass("fila-Hide");
		$("#btnLogOCLimpiar")     .addClass("fila-Hide");
    }
    else {
        $("#btnLogOCSave")     .removeClass("fila-Hide");
        $("#btnLogOCCancel")   .removeClass("fila-Hide");
        $("#btnLogOCNew")      .addClass("fila-Hide");
        $("#btnLogOCUpd")      .addClass("fila-Hide");
        $("#btnLogOCDel")      .addClass("fila-Hide");
        $("#btnLogOCPrint")    .addClass("fila-Hide");
        $("#btnLogOCBusy")     .addClass("fila-Hide");
        $("#btnLogOCLeft")     .addClass("fila-Hide");
        $("#btnLogOCRight")     .addClass("fila-Hide");
        $("#btnLogOCSearch")     .addClass("fila-Hide");
		$("#btnLogOCItem")     .removeClass("fila-Hide");
		$("#btnLogOCIgv")     .removeClass("fila-Hide");
		$("#btnLogOCCatalogo")     .removeClass("fila-Hide");
		$("#btnLogOCLimpiar")     .removeClass("fila-Hide");
		
    }
}


/******************************************************/
/****DECLARACION DE VARIABLES *************************/

var varOC = jQuery.parseJSON('{  ' +
'"ocOPE":"NN",' +
'"ocID":"NN",' +
'"ocAnio":"NN",' +
'"ocFecha":"NN",' +
'"ocTipoProcID":"NN" ,' +
'"ocDepID":"NN" ,' +
'"ocRubroID":"NN" ,' +
'"ocSecFunID":"NN" ,' +
'"ocRuc":"NN" ,' +
'"ocPlazo":"NN" ,' +
'"ocGarantia":"NN" ,' +
'"ocIGV":"NN" ,' +
'"ocLugar":"NN" ,' +
'"ocRef":"NN" ,' +
'"ocObsv":"NN" ,' +

'"ocReqID":"NN" ,' +
'"ocCtzID":"NN" ,' +
'"ocCdrID":"NN" ,' +
'"ocUsrID":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;

var varOCDll = jQuery.parseJSON('{  ' +
'"OPE":"0",'+
'"ocID":"NN",' +
'"ocItm":"0",' +
'"czItm":"0",' +
'"cdItm":"0",' +
'"rqItm":"0",' +

'"prodCant":"NN",' +
'"prodClasfID":"NN" ,' +
'"prodID":"NN" ,' +
'"prodUndID":"NN" ,' +
'"prodMarca":"NN" ,'+
'"prodEspf":"NN" ,' +
'"prodPrecio":"NN" ,' +
'"UsrID":"NN" ' +

'}  ' ) ;

var varFte = jQuery.parseJSON('{  ' +
'"fteOPE":"NN",' +
'"fteID":"NN",' +
'"fteRuc":"NN",' +
'"fteAnio":"NN",' +
'"ftePlazo":"NN" ,' +
'"fteGarantia":"NN" ,' +
'"fteIGV":"NN" ,' +
'"fteCtzID":"NN" ,' +
'"fteUsrID":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;

var varFteDll = jQuery.parseJSON('{  ' +
'"dllOPE":"NN",' +
'"dllID":"NN",' +
'"dllFteID":"NN",' +
'"dllProdID":"NN",' +
'"dllPrecio":"NN" ,' +
'"dllMarca":"NN" ,' +
'"dllUsr":"NN" ,' +
'"_token":"NN" '+
'}  ' +
'') ;

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






$( document ).on( 'click',  '#btnLogOCLeft',function(e) {
    e.preventDefault();
    jsFunDBOCLR( "L");
});


$( document ).on( 'click',  '#btnLogOCRight',function(e) {
    e.preventDefault();
    jsFunDBOCLR( "R");
});


function jsFunDBOCLR(prPosition)
{
    var token= $('#tokenBtn').val();
    var dataString = {'prAnio': $(".txVarAnioEjec").val(),'prPosition': prPosition, 'prCodOC':$("#OC").attr("ocID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetOCLR",
        data: dataString,
        //  beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunOC_Default(); jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR)
        {
            if(VR[0].ID!="NN") {

                jsFunDBOC_Get("ID",VR[0].ID);
            }
            else
            {    jsFunOC_Default(); jsFnDialogBox(400, 160, "WARNING", null, "RESULTADOS DE LA BUSQUEDA", "No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");}
        }
    });

}


$( document ).on( 'click' ,'#btnLogOCCatalogo',function(e) {
        e.preventDefault();
//				$("#divDialog").dialog("close");
		$(".modal-backdrop").remove();
		$('#modalCatalogo').modal('hide');            
        var url = 'logistica/vwCatalogoOC';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalCatalogo').modal('show');            
        });
    });



$( document ).on( 'click' ,'#btnLogOCIgv',function(e) {
        e.preventDefault();

       if($("#txOC_CodTipoProc").attr("codID")!="009"){  jsFnDialogBox(400, 145, "WARNING", null, "PETICION EN PROCESO", "SOLO SE PUEDE CALCULAR IGV PARA EL CONVENCIO MARCO.");       return; }
       //if($("#OC").attr("ocOPE")!="UPD"){  jsFnDialogBox(400, 145, "WARNING", null, "PETICION EN PROCESO", " PRIMERO TIENE QUE GUARDAR LA O/C PARA PODER CALCULAR EL IGV");       return; }
        var msg5 = confirm("Esta seguro que desea calcular el IGV");
        if (msg5)
        {


                var datos = {
                                    varOC:$("#OC").attr("ocID"),
                                    '_token': $('#tokenBtn').val()
                                }

                                $.ajax({
                                    type: "post",
                                    url: "logistica/spLogSetOCIgv",
                                    data: datos,
                                    beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                                    error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
                                    success: function (VR) {
                                        $("#divDialog").dialog("close");
                                        $(".modal-backdrop").remove();
                                        $("#divOC_Dll").html(VR["vwDll"]);
                                    }
                                });
                                $("#dvBarraOCAdd").css({'background': '#efefef'});
                                $("#dvBarraOCAdd").css({'display': 'none'});

        }
    });
	
	
	




$( document ).on( 'click' ,'#btnLogOC_dllADD',function(e) {
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

        if ( trClone.find("td[name=tdSecFun]").find('input[id=txProdSecFun]').attr("codID")== "NN") {  reqErrores+=' <br> * Secuencia Funcional '; }

        reqErrores+="</p>";
        if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }


        filaADD = $("#tbOC_Dll tfoot tr").clone(true).removeClass('fila-Hide');

        //filaADD.find("td[name=tdID]").attr("fteID", trClone.find("td[name=tdID]").attr("fteID"));
        filaADD.find("td[name=tdOcItm]").html(trClone.find("td[name=tdOsItm]").text());
        filaADD.find("td[name=tdCdItm]").html(trClone.find("td[name=tdCdItm]").text());
        filaADD.find("td[name=tdCzItm]").html(trClone.find("td[name=tdCzItm]").text());
        filaADD.find("td[name=tdRqItm]").html(trClone.find("td[name=tdRqItm]").text());

        filaADD.find("td[name=tdCant]").html(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val());
        filaADD.find("td[name=tdClasf]").html(trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').val());
        filaADD.find("td[name=tdProd]").html(trClone.find("td[name=tdProd]").find('input[id=txProdProd]').val());
        filaADD.find("td[name=tdUnd]").html(trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').val());
        filaADD.find("td[name=tdEspf]").html(trClone.find("td[name=tdEspf]").find('textarea[id=txProdEspf]').val());

        filaADD.find("td[name=tdPrecio]").html(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val());
        filaADD.find("td[name=tdMarca]").html(trClone.find("td[name=tdMarca]").find('input[id=txProdMarca]').val());
        filaADD.find("td[name=tdEnvio]").html(trClone.find("td[name=tdEnvio]").find('input[id=txProdEnvio]').val());
      

        filaADD.find("td[name=tdClasf]").attr("codID", trClone.find("td[name=tdClasf]").find('input[id=txProdClasf]').attr("codID"));
        filaADD.find("td[name=tdProd]").attr("codID", trClone.find("td[name=tdProd]").find('input[id=txProdProd]').attr("codID"));
        filaADD.find("td[name=tdUnd]").attr("codID", trClone.find("td[name=tdUnd]").find('input[id=txProdUnd]').attr("codID"));
        filaADD.find("td[name=tdSecFun]").attr("codID", trClone.find("td[name=tdSecFun]").find('input[id=txProdSecFun]').attr("codID"));

        var cant = parseFloat(trClone.find("td[name=tdCant]").find('input[id=txProdCant]').val()).toFixed(2);
        var precioUnt = parseFloat(trClone.find("td[name=tdPrecio]").find('input[id=txProdPrecio]').val()).toFixed(6)
        var total       = parseFloat( cant*precioUnt).toFixed(2);
        filaADD.find("td[name=tdTotal]").html(total);

        $("#tbOC_Dll").append(filaADD);
        $("#tbBarraBienes tr").each(function (index) {      $(this).remove();     });
        $("#dvBarraAdd").css({'background': '#efefef'});
        $("#dvBarraAdd").css({'display': 'none'});
});

$(document).on('click , keydown','#btnLogOC_dllCLOSE',function(e) {
    e.preventDefault();
    //
     $("#tbBarraBienes tr").each(function (index) { $(this).fadeOut(0, function(){  $(this).remove(); }) }) ;
  $("#dvBarraOCAdd").css({'background': '#efefef'});
                        $("#dvBarraOCAdd").css({'display': 'none'});
});

$( document ).on( 'click' ,'#btnLogOC_dllX',function(e) {
var msg2= confirm(' \n ESTA SEGURO QUE DESEA ELIMINAR EL REGISTRO \n\n ');
    if(msg2)        
    $(this).parent().parent().remove();
});

	
	


$( document ).on( 'click', '#btnLogOCSiaf', function(e ) {
 e.preventDefault(); 
       
        var dataString = { 'prID': $("#OC").attr("ocID")  ,'_token':$('#tokenBtn').val() } ;
        $.ajax({
                    type: "POST",
                    url: "logistica/spLogGetOC_Expediente",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                   // beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
                    success: function(VR) {

                      $("#modalOC").html(jsFunModalExpediente( $("#txOC_No").val(), VR));
                       $("#txExpAnio").val($(".txVarAnioEjec").val());
                      $('#modalContExpediente').css({'width': '550px', 'height': '210px'});
                      $('#modalVentExpediente').modal('show');
                      $('#modalVentExpediente').attr('obj',obj);               
                    }
    }); 

  });


$( document ).on( 'click', '#btnLogOCSiaf_ADD , .btnLogOCSiaf_DEL ', function(e ) {
    e.preventDefault();
     
    ope="";
    titulo="";
    tipo = $(this).attr("name");
    item = $(this).attr("idItem");
    if(tipo=="btnLogOCSiaf_ADD") { ope="ADD";  titulo=" GUARDAR "  }
    else if(tipo=="btnLogOCSiaf_DEL") { ope="DEL";  titulo=" ELIMINAR " }
    else {return ;}
    
    var msgExp= confirm("ESTA SEGURO QUE DESEA "+titulo +" EL REGISTRO"); 
      if(msgExp )
      {
                var dataString = { 'prTipo':ope  ,'prItem':item  ,'prID': $("#OC").attr("ocID"), 'prAnio': $("#txExpAnio").val() , 'prExp': $("#txExpCod").val()  ,'_token':$('#tokenBtn').val() } ;
                $.ajax({
                    type: "POST",
                    url: "logistica/spLogSetOC_Expediente",
                    data: dataString,
                    error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
                    success: function(VR) {                 
                    $('#modalExp').html(VR);

                        var dataStringRow = { 'prID': $("#OC").attr("ocID") ,'_token':$('#tokenBtn').val() } ;
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


