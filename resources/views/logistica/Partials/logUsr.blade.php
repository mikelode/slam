   <div class="modal fade"  id="modalUsr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
   <div class="modal-dialog"  style="width: 700px" >
   <div class="modal-content">
        <div class="modal-header" >
                         <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #338Bb7 ; COLOR:#ffffff;" >
                         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button> 
                         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> REGISTRO DE CUENTAS DE USUARIO </span>
                         </div></div> 

    <div id="dvUsrCont">
                <div class="panel panel-default" style=" border-radius: 8px;padding-left: 10px; padding-top: 10px; ;margin-top: -5px;  background: #FCFCFC; border-top-width: 1px; border-top-color: #E2E2E2;  " >

<?php
if(isset( $Usr["Usr"] ))
{
?>
                <table>
                <tr>
                <td>
                @foreach( $Usr["Usr"] as $keyMain=>$nomMain)
                 <table class="gs-table" border="0">
                 <tr><td> <label class="gs-label">DNI:          </label> </td> <td width="100px;">  <input id="txUSR_DNI" OPE="UPD" name="" class="form-control gs-input" style="width: 120px;  font-weight: bold; font-size: 16px;  "  type="text" placeholder="DNI"  VALUE="{{$nomMain->ID}}" usrID="{{$nomMain->ID}}" > </td> <td align="left"> <SPAN class="btn btn-primary" id="btnLogUSR_SEARCH" style=" width: 60px;height: 26px; padding-top:6px; padding-left: 6px; font-size: 11px;"> BUSCAR </span></td> </tr>
                 <tr><td></td> <td colspan="2">     <span id="snResult" style="font-size: 12px; color:#777777; font-family:  Courier, monospace "></span> </td> </tr>
                 <tr><td> <label class="gs-label">Nombres:   </label> </td> <td colspan="2">     <input id="txUSR_Nombres" codID="CID"  class="form-control gs-input" style="width: 410px;  font-size: 11px;  "  type="text"  VALUE="{{$nomMain->Nombres}}" > </td> </tr>
                 <tr><td> <label class="gs-label">Abrv:        </label> </td> <td colspan="2">      <input id="txUSR_Abrv"  class="form-control gs-input" style="width: 120px;  font-size: 11px;  "  type="text" placeholder="Abrv"  VALUE="{{$nomMain->Abrv}}" > </td> </tr>
                 <tr><td> <label class="gs-label">Fecha Fin:   </label> </td> <td colspan="2">      <input id="txUSR_FFin"  type="date" class="form-control gs-input" style="width: 120px;  font-size: 11px;  "    VALUE="{{$nomMain->FecFin}}" > </td> </tr>
                 <tr><td> <label class="gs-label">Estado:       </label> </td> <td colspan="2">
                                                <div class="btn-group btn-input clearfix" >
                                                     <button type="button" id="btnEstado" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:120px; height: 30px;font-size: 11px;  ">    <span  id="txEstado"  data-bind="label" codID="NN">Seleccione...</span> <span class="caret"></span></button>
                                                     <ul class="dropdown-menu menu-Estado" role="menu" style="font-size: 11px; margin-top: -2px; width: 100px; ">
                                                        <li  psrId="1"><a href="#">ACTIVO </a></li>
                                                        <li  psrId="0"><a href="#">BAJA</a></li>
                                                     </ul>
                                                </div>
                 </td> </tr>

                 <tr><td> <label class="gs-label">Acceso:       </label> </td> <td colspan="2">
                                                                 <div class="btn-group btn-input clearfix" >
                                                                      <button type="button" id="btnAcceso" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:230px; height: 30px;font-size: 11px;  ">    <span  id="txAcceso"  data-bind="label" codID="NN">Seleccione...</span> <span class="caret"></span></button>
                                                                      <ul class="dropdown-menu menu-Acceso" role="menu" style="font-size: 11px; width: 230px; margin-top: -2px;">
                                                                         @foreach($Usr["PFL"] as $key=>$nom)
                                                                         <li  psrId="{{$nom->ID}}"><a href="#">{{$nom->Dsc }}</a></li>
                                                                        @endforeach

                                                                      </ul>
                                                                 </div>

                        <button class="btn btn-default" id="btnLogUSR_PERS" style=" padding-top: 6px; padding-left: 6px; width: 70px;height: 28px; font-size: 10px;"> Personalizar</button>
                 </td> </tr>

                 <tr ><td colspan="3" style=" height: 10px;">  </td> </tr> 
                 </table>
                 @endforeach
                </td>
                <TD width="10px">
                </TD>
                <TD valign="top">
                <img src="img/logoUsr2.jpg" width="160px" height="160px">
                <button class="btn  btn-danger" id="btnLogUSR_RESET" style=" padding:10px; height: 28px; font-size: 10px;margin-left : 5px; width:150px; "> RESET PASSWORD  </button>
                </TD>
                </tr>
                </table>

                 <div id="pnlLogUserPerz">
                 </div>
 
<br>
<br>


<?php
}
else if(isset ($Usr["Prs"] ))
{
?>



                <table>
                <tr>
                <td>
                 <table class="gs-table" border="0">
                 <tr><td> <label class="gs-label">DNI:          </label> </td> <td width="100px;">  <input id="txUSR_DNI" OPE="ADD" name="txRUC_Ruc" class="form-control gs-input" style="width: 120px;  font-weight: bold; font-size: 16px;  "  type="text" placeholder="DNI" > </td> <td align="left"> <SPAN class="btn btn-primary" id="btnLogUSR_SEARCH" style=" width: 60px;height: 26px; padding-top:6px; padding-left: 6px; font-size: 11px;"> BUSCAR </span></td> </tr>
                 <tr><td></td> <td colspan="2">     <span id="snResult" style="font-size: 12px; color:#777777; font-family:  Courier, monospace "></span> </td> </tr>
                 @foreach( $Usr["Prs"] as $keyPrs=>$nomPrs)
                 <tr><td> <label class="gs-label">Nombres:   </label> </td> <td colspan="2">     <input id="txUSR_Nombres" codID="CID"  class="form-control gs-input" style="width: 410px;  font-size: 11px;  "  type="text" placeholder="Nombres"  VALUE="{{$nomPrs->Completo}}" > </td> </tr>
                 @endforeach
                 <tr><td> <label class="gs-label">Abrv:        </label> </td> <td colspan="2">      <input id="txUSR_Abrv"  class="form-control gs-input" style="width: 120px;  font-size: 11px;  "  type="text" placeholder="Abrv" > </td> </tr>
                 <tr><td> <label class="gs-label">Fecha Fin:   </label> </td> <td colspan="2">      <input id="txUSR_FFin"  type="date" class="form-control gs-input" style="width: 120px;  font-size: 11px;  "   > </td> </tr>
                 <tr><td> <label class="gs-label">Estado:       </label> </td> <td colspan="2">
                                                <div class="btn-group btn-input clearfix" >
                                                     <button type="button" id="btnEstado" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:120px; height: 30px;font-size: 11px;  ">    <span  id="txEstado"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                     <ul class="dropdown-menu menu-Estado" role="menu" style="font-size: 11px; margin-top: -2px; width: 100px; ">
                                                        <li  psrId="1"><a href="#">ACTIVO </a></li>
                                                        <li  psrId="0"><a href="#">BAJA</a></li>
                                                     </ul>
                                                </div>
                 </td> </tr>

                 <tr><td> <label class="gs-label">Acceso:       </label> </td> <td colspan="2">
                                                                 <div class="btn-group btn-input clearfix" >
                                                                      <button type="button" id="btnAcceso" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:330px; height: 30px;font-size: 11px;  ">    <span  id="txAcceso"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                                      <ul class="dropdown-menu menu-Acceso" role="menu" style="font-size: 11px; width: 330px; margin-top: -2px;">
                                                                         @foreach($Usr["PFL"] as $key=>$nom)
                                                                         <li  psrId="{{$nom->ID}}"><a href="#">{{$nom->Dsc }}</a></li>
                                                                        @endforeach

                                                                      </ul>
                                                                 </div>

                        <button class="btn btn-default" id="btnLogUSR_PERS" style=" padding-top: 6px; padding-left: 6px; width: 70px;height: 28px; font-size: 10px;"> Personalizar</button>
                 </td> </tr>

                 <tr ><td colspan="3" style=" height: 10px;">  </td> </tr>
                 </table>
                </td>
                <TD width="10px">
                </TD>
                <TD valign="top">
                <img src="img/logoUsr2.jpg" width="160px" height="160px">
                </TD>
                </tr>
                </table>
                  <div id="pnlLogUserPerz">
                 </div>


<?php
}
else
{
?>



                <table>
                <tr>
                <td>
                 <table class="gs-table" border="0">
                 <tr><td> <label class="gs-label">DNI:          </label> </td> <td width="100px;">  <input id="txUSR_DNI" OPE="ADD" name="txRUC_Ruc" class="form-control gs-input" style="width: 120px;  font-weight: bold; font-size: 16px;  "  type="text" placeholder="DNI" > </td> <td align="left"> <SPAN class="btn btn-primary" id="btnLogUSR_SEARCH" style=" width: 60px;height: 26px; padding-top:6px; padding-left: 6px; font-size: 11px;"> BUSCAR </span></td> </tr>
                 <tr><td></td> <td colspan="2">     <span id="snResult" style="font-size: 12px; color:#777777; font-family:  Courier, monospace "></span> </td> </tr>
                 <tr><td> <label class="gs-label">Nombres:   </label> </td> <td colspan="2">     <input id="txUSR_Nombres" codID="CID"  class="form-control gs-input" style="width: 410px;  font-size: 11px;  "  type="text" placeholder="Apellido Paterno" > </td> </tr>
                 <tr><td> <label class="gs-label">Abrv:        </label> </td> <td colspan="2">      <input id="txUSR_Abrv"  class="form-control gs-input" style="width: 120px;  font-size: 11px;  "  type="text" placeholder="Abrv" > </td> </tr>
                 <tr><td> <label class="gs-label">Fecha Fin:   </label> </td> <td colspan="2">      <input id="txUSR_FFin"  type="date" class="form-control gs-input" style="width: 120px;  font-size: 11px;  "   > </td> </tr>
                 <tr><td> <label class="gs-label">Estado:       </label> </td> <td colspan="2">
                                                <div class="btn-group btn-input clearfix" >
                                                     <button type="button" id="btnEstado" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:120px; height: 30px;font-size: 11px;  ">    <span  id="txEstado"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                     <ul class="dropdown-menu menu-Estado" role="menu" style="font-size: 11px; margin-top: -2px; width: 100px; ">
                                                        <li  psrId="1"><a href="#">ACTIVO </a></li>
                                                        <li  psrId="0"><a href="#">BAJA</a></li>
                                                     </ul>
                                                </div>
                 </td> </tr>

                 <tr><td> <label class="gs-label">Acceso:       </label> </td> <td colspan="2">
                                                                 <div class="btn-group btn-input clearfix" >
                                                                      <button type="button" id="btnAcceso" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:330px; height: 30px;font-size: 11px;  ">    <span  id="txAcceso"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                                      <ul class="dropdown-menu menu-Acceso" role="menu" style="font-size: 11px; width: 330px; margin-top: -2px;">
                                                                         @foreach($Usr["PFL"] as $key=>$nom)
                                                                         <li  psrId="{{$nom->ID}}"><a href="#">{{$nom->Dsc }}</a></li>
                                                                        @endforeach

                                                                      </ul>
                                                                 </div>

                        <button class="btn btn-default" id="btnLogUSR_PERS" style=" padding-top: 6px; padding-left: 6px; width: 70px;height: 28px; font-size: 10px;"> Personalizar</button>
                 </td> </tr>

                 <tr ><td colspan="3" style=" height: 10px;">  </td> </tr>
                 </table>
                </td>
                <TD width="10px">
                </TD>
                <TD valign="top">
                <img src="img/logoUsr2.jpg" width="160px" height="160px">
                </TD>
                </tr>
                </table>
                  <div id="pnlLogUserPerz">
                 </div>


<?php
}
?>


             </div>
               
                <div id="pnlUsrReset" style="margin-left:-25px" align="center">
                <H5 style="margin-left:55px">  Esta seguro de cambiar la contraseña del Usuario ?</H5>
                <P style="margin-left:55px">  
                <button class="btn  btn-primary" id="btnLogUSR_ResetSI" style=" padding:10px; height: 28px; font-size: 10px;margin-left : 5px; width:80px; "> SI  </button>
                <button class="btn  btn-default" id="btnLogUSR_ResetNO" style=" padding:10px; height: 28px; font-size: 10px;margin-left : 5px; width:80px; "> NO  </button>
                </P>
                </div>


                 <table id="pnlUsrAction">
                 <tr align="right"><td colspan="3"> <button class="btn btn-primary" id="btnLogUSR_SAVE" style="width: 120px;height: 35px;"> GUARDAR </button> <button class="btn btn-default" id=" " style=" margin-left:15px ;width: 100px;height: 35px;" data-dismiss="modal"> Cancelar</button> </td> </tr>
                 <tr ><td colspan="3" style=" height: 10px;">  </td> </tr> 
                 </table> 
        </div>
        </div>

   </div>
   </div>
   </div>


<script type="text/javascript">
    
$( document ).on( 'click', '.menu-Acceso li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;    
    $("#txAcceso").attr("codID",TipoReq); 

    $("#pnlLogUserPerz").html("");
    $("#pnlLogUserPerz").fadeOut(0);
    var dataString = {'prCodPerfil':TipoReq,'_token':$('#tokenBtn').val() } ;
    $.ajax({
                type: "POST",
                url: "logistica/spLogGetUsrAcs",
                data: dataString,
                //beforeSend: function () {  $("#pnlUsrAction").html('<p>  Espere un momento.... Cargando.... </p>');    },
                error: function () { $("#pnlUsrAction").html('<p> Se Produjo un ERROR en el proceso </p>');    },
                success: function (datos) { 
                $("#pnlLogUserPerz").fadeIn(500); 
                $("#pnlLogUserPerz").html(datos);                        }
        });
  //  return false;
});

$(document).ready(function(){    
    $("#pnlUsrReset").hide();
    $("#btnLogUSR_RESET").click(function(){
        $("#pnlLogUserPerz").html("");
        $("#pnlUsrAction").hide();
        $("#pnlUsrReset").fadeIn(600);
    });

    $("#btnLogUSR_ResetNO").click(function(){
        $("#pnlUsrAction").fadeIn(600);
        $("#pnlUsrReset").hide();
    });

    $("#btnLogUSR_ResetSI").click(function(){
        $("#pnlUsrAction").fadeIn(600);
        $("#pnlUsrReset").hide();
        var dataString = {'idUser':$("#txUSR_DNI").attr('usrID'),'_token':$('#tokenBtn').val() } ;
        $.ajax({
                        type: "POST",
                        url: "logistica/spLogSetUsrPssReset",
                        data: dataString,
                        //beforeSend: function () {  $("#pnlUsrAction").html('<p>  Espere un momento.... Cargando.... </p>');    },
                        error: function () { $("#pnlUsrAction").html('<p> Se Produjo un ERROR en el proceso </p>');    },
                        success: function (datos) {
                            alert(datos.Result[0].Mensaje);
                        }
        });
    });

    $("#btnLogUSR_PERS").click(function(){
        $("#pnlLogUserPerz").html("");
        $("#pnlLogUserPerz").fadeOut(0);
        var dataString = {'prCodUser':$("#txUSR_DNI").attr('usrID'),'_token':$('#tokenBtn').val() } ;
        $.ajax({
                        type: "POST",
                        url: "logistica/spLogGetUsrPerz",
                        data: dataString,
                        //beforeSend: function () {  $("#pnlUsrAction").html('<p>  Espere un momento.... Cargando.... </p>');    },
                        error: function () { $("#pnlUsrAction").html('<p> Se Produjo un ERROR en el proceso </p>');    },
                        success: function (datos) { 
                        $("#pnlLogUserPerz").fadeIn(2000); 
                        $("#pnlLogUserPerz").html(datos);
                        }
        });
    });

});

</script>
