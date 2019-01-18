
$(document).on('click','#btnLogRptPdf',function(e){
    e.preventDefault();

    var prAnio   = $(".txVarAnioEjec").val();    
    var prTipoRpt   = $("#txRpt_CodTipoRpt").attr("codID");    
    var prFecIni    = $("#txRpt_FechaIni").val();
    var prFecFin  = $("#txRpt_FechaFin").val();
    var prSecFun    = $("#txRpt_CodSecFun").attr("codID");
    var prRubro     =  $("#txRpt_CodRubro").attr("codID");
    var prTipoProc  =$ ("#txRpt_CodTipoProc").attr("codID");
    var prRuc       = $("#txRpt_Ruc").attr("codID");
    var prNivel     = $("#txRpt_CodNivel").attr("codID");
    if (typeof prRubro == "undefined"){ prRubro  ="NN";   }
    if (typeof prTipoProc == "undefined"){ prTipoProc="NN";}
    if (typeof prRuc == "undefined"){ prRuc="NN"; }
    window.open("logistica/rptPrueba/"+prAnio+"/"+prTipoRpt+"/"+prFecIni+"/"+prFecFin+"/"+prSecFun+"/"+prRubro+"/"+prTipoProc+"/"+prRuc+"/"+prNivel, 'width=275,height=340,scrollbars=NO,location=no');
});



$(document).on('click','#btnLogRankingPdf',function(e){
    e.preventDefault();
    var FecIni  = $("#txRpt_RankingFechaIni").val();
    var FecFin  = $("#txRpt_RankingFechaFin").val();   
    var Doc = "XLS";
    window.open("logistica/rptRankingPdf/"+Doc+"/"+FecIni+"/"+FecFin, 'width=275,height=340,scrollbars=NO,location=no');


});



$(document).on('click','#btnLogRankingExcel',function(e){
    e.preventDefault();
    var FecIni  = $("#txRpt_RankingFechaIni").val();
    var FecFin  = $("#txRpt_RankingFechaFin").val();
    //var TipoRpt = $("#txRptSeace_CodTipoRpt").attr("codID");
    //  if (typeof TipoRpt != "undefined"){  if(TipoRpt=="NN" ) { return ; } }else { return;  }  

    var Doc = "XLS";
    window.open("logistica/rptRankingExcel/"+Doc+"/"+FecIni+"/"+FecFin, "rpt");
});


$(document).on('click','#btnLogSeaceExport',function(e){
    e.preventDefault();
    var FecIni  = $("#txRpt_SeaceFechaIni").val();
    var FecFin  = $("#txRpt_SeaceFechaFin").val();
    var TipoRpt = $("#txRptSeace_CodTipoRpt").attr("codID");
     if (typeof TipoRpt != "undefined"){  if(TipoRpt=="NN" ) { return ; } }else { return;  }  

    var Doc = "XLS";
    window.open("logistica/rptSeaceExcel/"+Doc+"/"+TipoRpt+"/"+FecIni+"/"+FecFin, "rpt");
});

$(document).on('click','#btnLogPriceExport',function(e){
    e.preventDefault();
    var FecIni  = $("#txRpt_PriceFechaIni").val();
    var FecFin  = $("#txRpt_PriceFechaFin").val();
    var TipoRpt = $("#txRptPrice_CodTipoRpt").attr("codID");
     if (typeof TipoRpt != "undefined"){  if(TipoRpt=="NN" ) { return ; } }else { return;  }
   

    var Doc = "XLS";
    window.open("logistica/rptPriceExcel/"+TipoRpt+"/"+FecIni+"/"+FecFin, "rpt");
});



$( document ).on( 'keydown','#txRpt_CodDep, #txRpt_CodTipoProc,#txRpt_CodSecFun , #txRpt_CodRubro , #txRpt_Ruc  ',function(event) {
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

        if(Evento=='txRpt_CodDep' )   {  obj='DEP'; tipo='COD';  }
        else if(Evento=='txRpt_CodSecFun'){  obj='SECFUN'; tipo='COD'; }
        else if(Evento=='txRpt_CodRubro') {  obj='RUBRO';  tipo='COD';}
        else if(Evento=='txRpt_CodTipoProc')      {  obj='TPROC';  tipo='COD';}
		else if(Evento=='txRpt_Ruc')      {  obj='RUC';  tipo='STR';}
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
                    if (Flg==false) {   $('#txRpt_CodDep').attr('codID','NN');  $('#txOC_CodDep').val('');  $('#txRpt_Dep').val('');    $( "#txRpt_CodDep" ).focus(); }
                    else      {   $('#txRpt_CodDep').attr('codID',id);    $('#txRpt_CodDep').val(cod); $('#txRpt_Dep').val(dsc);   $( "#txRpt_CodSecFun" ).focus();  }
                }
                else if(Evento=='txRpt_CodSecFun')
                {
                    if (Flg==false) {  $('#txRpt_CodSecFun').attr('codID','NN');  $('#txRpt_CodSecFun').val('');  $('#txRpt_SecFun').val('');    $( "#txRpt_CodSecFun" ).focus(); }
                    else      {  $('#txRpt_CodSecFun').attr('codID',id);    $('#txRpt_CodSecFun').val(cod); $('#txRpt_SecFun').val(dsc);   $( "#txRpt_CodRubro" ).focus();  }
                }
                else if(Evento=='txRpt_CodRubro')
                {
                    if (Flg==false) {  $('#txRpt_CodRubro').attr('codID','NN');  $('#txRpt_CodRubro').val('');  $('#txRpt_Rubro').val('');    $( "#txRpt_CodRubro" ).focus(); }
                    else      {  $('#txRpt_CodRubro').attr('codID',id);    $('#txRpt_CodRubro').val(cod); $('#txRpt_Rubro').val(dsc);   $( "#txRpt_LugarEnt" ).focus();  }
                }
                else if(Evento=='txRpt_CodTipoProc')
                {
                    if (Flg==false) {  $('#txRpt_CodTipoProc').attr('codID','NN');  $('#txRpt_CodTipoProc').val('');  $('#txRpt_TipoProc').val('');    $( "#txRpt_CodTipoProc" ).focus(); }
                    else      {  $('#txRpt_CodTipoProc').attr('codID',id);    $('#txRpt_CodTipoProc').val(cod); $('#txRpt_TipoProc').val(dsc);   $( "#txObsv" ).focus();  }
                }
				else if(Evento=='txRpt_Ruc')
                {
                    if (Flg==false) {  $('#txRpt_Ruc').attr('codID','NN');  $('#txRpt_Ruc').val('');  $('#txRpt_Ruc').val('');    $( "#txRpt_Ruc" ).focus(); }
                    else      {  $('#txRpt_Ruc').attr('codID',id);    $('#txRpt_Ruc').val(cod); $('#txRpt_RSocial').val(dsc);   $( "#txObsv" ).focus();  }
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



/***************************************************************************************************************/

$(document).on('click','#btnLogRptShow,#btnLogRptXls',function(e){
    e.preventDefault();

    //var url = $(this).attr("href");
    var btn = $(this).attr("id");

    var TipoRpt = $("#txRpt_CodTipoRpt").attr("codID");
    var Nivel   = $("#txRpt_CodNivel").attr("codID");
    var FecIni  = $("#txRpt_FechaIni").val();
    var FecFin  = $("#txRpt_FechaFin").val();
    var SecFun  = $("#txRpt_CodSecFun").attr("codID");
    var Rubro   =  $("#txRpt_CodRubro").attr("codID");
    var TipoProc =$ ("#txRpt_CodTipoProc").attr("codID");
    var Ruc     = $("#txRpt_Ruc").attr("codID");


    var reqErrores="<p>";
    if (typeof SecFun == "undefined")
    {
        SecFun="NN";
    }
   //if (typeof SecFun != "undefined"){  if(SecFun=="NN" ) { reqErrores+="<br> * Seleccione una Secuencia Funcional ";  } }else { reqErrores+=" <br> * Seleccione una Secuencia Funcional ";  }
    if (typeof TipoRpt != "undefined"){  if(TipoRpt=="NN" ) { reqErrores+="<br> * Seleccione el Tipo de Reporte ";  } }else { reqErrores+="<br> * Seleccione el Tipo de Reporte ";  }
    if (typeof Nivel != "undefined"){  if(Nivel=="NN" ) { reqErrores+="<br> * Seleccione el Nivel de Detalle del Reporte ";  } }else { reqErrores+="<br> * Seleccione el Nivel de Detalle del Reporte ";  }

    if (typeof Rubro == "undefined"){ Rubro  ="NN";   }
    if (typeof TipoProc == "undefined"){ TipoProc="NN";}
    if (typeof Ruc == "undefined"){ Ruc="NN"; }
    reqErrores+="</p>";
    if(reqErrores.length>10){   $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS SIGUIENTES DATOS',reqErrores));  $('#dvAviso').modal('show');   return false ; }

    if(btn=='btnLogRptXls') {
        var Doc = "XLS";
        window.open("logistica/rptExcel/"+$(".txVarAnioEjec").val()+ "/"+Doc+"/"+TipoRpt+"/"+Nivel+"/"+FecIni+"/"+FecFin+"/"+SecFun+"/"+Rubro+"/"+TipoProc+"/"+Ruc, "rpt");
    }
    else if(btn=='btnLogRptShow') {

        var token= $('#tokenBtnMain').val();
        var dataString = {Anio:$(".txVarAnioEjec").val() ,'Doc':Doc,TipoRpt:TipoRpt ,Nivel:Nivel,FecIni:FecIni ,FecFin:FecFin,SecFun:SecFun ,Rubro:Rubro,TipoProc:TipoProc,Ruc:Ruc,'_token':token } ;
        $.ajax({
            type: "POST",
            url: "logistica/spLogRptView",
            data: dataString,
            beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
            error: function () {   jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR)
            {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                $("#divOC_Dll").html(VR);
            }
        });

    }
});

/***************************************/



$( document ).on( 'keydown','#txLiqCodSecFun   ',function(event) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 )
    {

        $("#divTarDll").html("");
        var dataString = {'prAnio':$("#txRptLiqFrmtoAnio").attr("codID"),'prCodSecFun': $("#txLiqCodSecFun").val() ,'_token':$('#tokenBtn').val() } ;
        $.ajax({
            type: "POST",
            url: "logistica/spLiqGetSecFun",
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
                    id = data[0].id;
                    cod = data[0].cod;
                    dsc = data[0].dsc;
                    if (id == null) {  Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor 1'));  $('#dvAviso').modal('show');   }
                }
                else { Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show'); }

                if (Flg==false) {  $('#txLiqCodSecFun').attr('secFunID','NN');  $('#txLiqCodSecFun').val('');  $('#txLiqSecFun').val('');   }
                else            {  $('#txLiqCodSecFun').attr('secFunID',id);    $('#txLiqCodSecFun').val(cod); $('#txLiqSecFun').val(dsc);    }
            
            }
            }) ;
}
});

/******************************/

$(document).on('click','#btn-consultar-doc',function(e){
    e.preventDefault();

     
    var idTipo = $("#searchTipo").val();
    var Codigo = $("#searchDocSeg").val();
    var Anio = $("#searchPeriodo").val();
    var token= $('#tokenBtn').val();

    if(idTipo.length!=2) { alert("Seleccione el Tipo de Documento");return ; }
    if(Codigo.length==0) {  alert("Ingrese el Numero de Documento");return ;   }
    var dataString = {'Anio':Anio,'Tipo':idTipo ,'Codigo':Codigo ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "consulta",
        data: dataString,        
        error: function (e) {      $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();    },
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Espere proceso demorara unos segundos..."); },
        success: function (VR)
        {           
          $("#divDialog").dialog("close");
          $("#idResult").html(VR);  
        }
    });

    
});


  $( document ).on( 'click', '.menu-RptLiqFrmtoAnio li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    
    var TipoReq= $target.attr("psrId") ;    
    $("#txRptLiqFrmtoAnio").attr("codID",TipoReq);
    $("#txLiqCodSecFun").attr("codID",'NN');
    $("#txLiqCodSecFun").val("");
    $("#txLiqSecFun").val("");
    $("#divTarDll").html("");

    return false;
});


$( document ).on( 'click',  '#btnLiqCSMostrar',function(e) {
    e.preventDefault();
    var token= $('#tokenBtnMain').val();
    var ordn = $(this).data('ordn');

    var dataString = {'prAnio': $("#txRptLiqCSAnio").attr("codID"),'prCodSecFun':$("#txLiqCSCodSecFun").attr("secFunID") , 'prTipo': $("#txRptLiqCSTipo").attr("codID") , 'orden': ordn, '_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLiqGetCS",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", $(this), "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (VR)
        {

            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#divTarDll").html(VR["liqCSDll"]);
        }
    });

});




$( document ).on( 'click',  '#btnLiqFrmtoMostrar',function(e) {
    e.preventDefault();
    var token= $('#tokenBtnMain').val();  

    var dataString = {'prAnio': $("#txRptLiqFrmtoAnio").attr("codID"),'prCodSecFun':$("#txLiqCodSecFun").attr("secFunID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLiqGetFrmto",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", $(this), "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (VR)
        {

            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#divTarDll").html(VR["liqTarDll"]);         
        }
    });

});

$(document).on('click','#btnLiqFrmtoExcel',function(e){
    e.preventDefault();   

     prAnio= $("#txRptLiqFrmtoAnio").attr("codID") ;
     prCodSecFun=$("#txLiqCodSecFun").attr("secFunID");
     prSecFun=$("#txLiqCodSecFun").val();
    window.open("logistica/rptLiqGetFrmtoExcel/"+prAnio+"/"+prCodSecFun+"/"+prSecFun, "rpt");
});

$(document).on('click','#btnLiqTFinExcel',function(e){
    e.preventDefault();   

     prAnio= $("#txRptLiqTFinAnio").attr("codID") ;
     prCodSecFun=$("#txLiqTFinCodSecFun").attr("secFunID");
     prNombre=$("#txLiqTFinSecFun").val();
    window.open("logistica/rptLiqGetTFinExcel/"+prAnio+"/"+prCodSecFun+"/"+prNombre, "rpt");
});


$(document).on('click','#btnConRenExcel',function(e){
    e.preventDefault();   
    cod= $("#txRptConRenAnio").attr("codID");
    if(cod=="NN") { 
          jsFnDialogBox(400,145, "WARNING",parent,"FALTA INFORMACION","Seleccione el Año de Ejecucion <br>") ;
         return ;
    }
     var Doc = "XLS";
     window.open("logistica/rptConRenGetExcel/"+cod, "rpt");
});




/***********************/

   $( document ).on( 'click', '.menu-RptLiqCSAnio li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    
    var TipoReq= $target.attr("psrId") ;    
    $("#txRptLiqCSAnio").attr("codID",TipoReq);
    $("#txLiqCSCodSecFun").attr("codID",'NN');
    $("#txLiqCSCodSecFun").val("");
    $("#txLiqCSSecFun").val("");
    $('#txRptLiqCSTipo').attr("codID","NN");
    $('#txRptLiqCSTipo').text("");
    $("#divTarDll").html("");
    return false;
});


$( document ).on( 'click', '.menu-RptLiqCSTipo li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ; 
    $("#txRptLiqCSTipo").attr("codID",TipoReq);      
    $("#divTarDll").html("");
    return false;
});


$( document ).on( 'keydown','#txLiqCSCodSecFun',function(event) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 )
    {

    $("#divTarDll").html("");
        var dataString = {'prAnio':$("#txRptLiqCSAnio").attr("codID"),'prCodSecFun': $("#txLiqCSCodSecFun").val() ,'_token':$('#tokenBtn').val() } ;
        $.ajax({
            type: "POST",
            url: "logistica/spLiqGetSecFun",
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
                    id = data[0].id;
                    cod = data[0].cod;
                    dsc = data[0].dsc;
                    if (id == null) {  Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor 1'));  $('#dvAviso').modal('show');   }
                }
                else { Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show'); }

                if (Flg==false) {  $('#txLiqCSCodSecFun').attr('secFunID','NN');  $('#txLiqCSCodSecFun').val('');  $('#txLiqCSSecFun').val('');   }
                else            {  $('#txLiqCSCodSecFun').attr('secFunID',id);    $('#txLiqCSCodSecFun').val(cod); $('#txLiqCSSecFun').val(dsc);    }
            
            }
            }) ;

}
});


$(document).on('click','#btnLiqCSExcel',function(e){
    e.preventDefault();  

     prAnio= $("#txRptLiqCSAnio").attr("codID") ;
     prCodSecFun=$("#txLiqCSCodSecFun").attr("secFunID");
     prTipo= $("#txRptLiqCSTipo").attr("codID") ;
    window.open("logistica/rptLiqCSExcel/"+prAnio+"/"+prCodSecFun+"/"+prTipo, "rpt");
});







/********************/

  $( document ).on( 'click', '.menu-RptLiqTFinAnio li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    
    var TipoReq= $target.attr("psrId") ;    
    $("#txRptLiqTFinAnio").attr("codID",TipoReq);
    $("#txLiqTFinCodSecFun").attr("codID",'NN');
    $("#txLiqTFinCodSecFun").val("");
    $("#txLiqTFinSecFun").val("");
    $("#divTarDll").html("");

    return false;
});

  $( document ).on( 'keydown','#txLiqTFinCodSecFun   ',function(event) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 )
    {

        $("#divTarDll").html("");
        var dataString = {'prAnio':$("#txRptLiqTFinAnio").attr("codID"),'prCodSecFun': $("#txLiqTFinCodSecFun").val() ,'_token':$('#tokenBtn').val() } ;
        $.ajax({
            type: "POST",
            url: "logistica/spLiqGetSecFun",
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
                    id = data[0].id;
                    cod = data[0].cod;
                    dsc = data[0].dsc;
                    if (id == null) {  Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor 1'));  $('#dvAviso').modal('show');   }
                }
                else { Flg = false;   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show'); }

                if (Flg==false) {  $('#txLiqTFinCodSecFun').attr('secFunID','NN');  $('#txLiqTFinCodSecFun').val('');  $('#txLiqTFinSecFun').val('');   }
                else            {  $('#txLiqTFinCodSecFun').attr('secFunID',id);    $('#txLiqTFinCodSecFun').val(cod); $('#txLiqTFinSecFun').val(dsc);    }
            
            }
            }) ;
}
});



$( document ).on( 'click',  '#btnLiqTFinMostrar',function(e) {
    e.preventDefault();
    var token= $('#tokenBtnMain').val();  

    var dataString = {'prAnio': $("#txRptLiqTFinAnio").attr("codID"),'prCodSecFun':$("#txLiqTFinCodSecFun").attr("secFunID") ,'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLiqGetTFin",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0, 0, "LOAD", $(this), "PETICION EN PROCESO", "Cargando, Espere un momento..."); },
        error: function () {  jsFunReqClear(); jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>"); },
        success: function (VR)
        {

            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#divTarDll").html(VR["liqFinDll"]);         
        }
    });

});


