<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">


     <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 55px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

        <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
        <tr valign="center" >
        <TD>
        <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
        </TD>
            <td ALIGN="LEFT">
            <span style="font-size: 16px;">Activar Documentos </span>
            </td>

        </tr>
        </table>
    </div>

<br>


    <table class="gs-table" style="margin-left: 5px ; margin-top: 1px;" >
    <tr valign="center">
         <td> 
             <div class="btn-group btn-input clearfix"  style="margin-left: 1px;"  >
                    <button type="button" id="txAD_CodTipoDoc" codID="NN" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:200px; height: 35px; border: 1px dotted #aaa; font-size: 12px; ">    <span  id="txAD_TipoDoc"  data-bind="label" style="font-weight: bold; ">Seleccione el Documento...</span> <span style="margin-left:10px" class="caret"></span></button>
                    <ul class="dropdown-menu menu-TipoReqAD" role="menu" style="font-size: 12px; width:200px; ">
                       <li  psrId="RQ"><a href="#">REQUERIMIENTO</a></li>
                       <li  psrId="CZ"><a href="#">COTIZACION</a></li>
                       <li  psrId="CC"><a href="#">CUADRO COMPARATIVO</a></li>
                       <li  psrId="OC"><a href="#">ORDEN DE COMPRA</a></li>
                       <li  psrId="OS"><a href="#">ORDEN DE SERVICIO</a></li>                       
                    </ul>
              </div>

        </td>        
        <td> {!! Form::text('txADAutoDsc', null, array('class' => 'form-control ', 'placeholder'=>'Ingrese el Codigo . . . ', 'style'=>'width:150px; height:35px ; ','id'=>'txADAutoDsc'    ))  !!} </td>
        <td align="LEFT" >   <span id="btnADRowSEARCH" class="btn btn-primary" STYLE="WIDTH:100PX;height: 35px; padding-top: 10px; font-weight: normal; margin-left:0px;"> BUSCAR</span>     </td>
        <td align="LEFT" >   <span id="btnADRowALL" class="btn btn-danger" STYLE="WIDTH:150PX;height: 35px; padding-top: 10px; font-weight: normal; margin-left:520px;"> Todos los Registros</span>     </td>
    </tr>
    </table>
   <hr >
    <div id="divADDll">

    </div>

</div>


<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div style="height: 56px"></div>

<div id="divDialog">
<div id="divDialogCont"></div>
</div>

</div></div>


<script>
  $( document ).on( 'click', '.menu-TipoReqAD li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );    
    var TipoReq= $target.attr("psrId") ;    
    $("#txAD_CodTipoDoc").attr("codID",TipoReq);
    $("#divADDll").html("");
    $("#txADAutoDsc").val("");
    $("#txADAutoDsc").focus();
    return false;
});


   $('#btnADRowALL').click(function(e){
        e.preventDefault();
        cod= $("#txAD_CodTipoDoc").attr("codID");
        if(cod=="NN") { 
            jsFnDialogBox(400,145, "WARNING",parent,"FALTA INFORMACION","Seleccione un Tipo de Documento <br>") ;
            return ;
         }
        $("#txADAutoDsc").val("");
        $.ajax({
                type: "POST",
                url: "logistica/spLogGetActDll",
                data: { prAnio:$(".txVarAnioEjec").val(), prAll:'Y', prTipo: $("#txAD_CodTipoDoc").attr("codID"),prQry:'','_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#divADDll").html( VR); }
            });

    });

    $('#btnADRowSEARCH').click(function(e){
        e.preventDefault();
         cod= $("#txAD_CodTipoDoc").attr("codID");
        if(cod=="NN") { 
            jsFnDialogBox(400,145, "WARNING",parent,"FALTA INFORMACION","Seleccione un Tipo de Documento <br>") ;
            return ;
         }
        $.ajax({
                type: "POST",
                url: "logistica/spLogGetActDll",
                data: { prAnio:$(".txVarAnioEjec").val(),prAll:'N', prTipo: $("#txAD_CodTipoDoc").attr("codID") , prQry:$("#txADAutoDsc").val(),'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#divADDll").html( VR); }
            });
    });

   

       
   

    $( document ).on( 'click' ,'.btnADActivar',function(e) {
    e.preventDefault();
        cod= $("#txAD_CodTipoDoc").attr("codID");
        dsc =$("#txAD_TipoDoc").html();  
        if(cod=="NN") { 
            jsFnDialogBox(400,145, "WARNING",parent,"FALTA INFORMACION","Seleccione un Tipo de Documento <br>") ;
            return ;
        }
        trCodID = $(this).attr("codID");
        b = $(this).parent().parent().clone().find("td[name=tdAdCodigo]").html();
        $("#divDialog").dialog(opt);
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").css("display","block");
        $("#divDialog").dialog(opt).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("gs-ui-state-primary");
        $("#divDialog").dialog("open");
        $("#divDialog").dialog({ width:400 ,height: 125, title: "CONFIRMAR PROCESOS"});
        $("#divDialogCont").html("Esta Seguro de Activar  - "+dsc+ " Nro =  <strong>" +b+"</strong>");
        $("#divDialog").dialog({
        buttons: {
            "Aceptar": function () {
                 $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetActDll",
                        data: {  prTipo: $("#txAD_CodTipoDoc").attr("codID") , prID:trCodID,'_token': $('#tokenBtnMain').val() },
                        error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                        success: function (VR) {$("#divDialog").dialog("close");    $("#divADDll").html( VR); }                     
                    });            
            },
            "Cancel": function () {  $(this).dialog("close"); }    }
        });

    });


</script>