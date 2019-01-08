   <div class="modal fade"  id="modalRptSeace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
   <div class="modal-dialog"  style="width: 350px" >
   <div class="modal-content">
        <div class="modal-header" >
		
		<div class="panel" > <div class="panel-heading gs-panel-heading"   >
         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> Reporte Seace </span>
         </div></div>
		 
                      <TABLE class="gs-table" >
                      <tr> <TD> <strong>Inicio :</strong><br><input type="date" name="fecha" id="txRpt_SeaceFechaIni" class="form-control  gs-input" style="width: 130px;">   </td>
					  
					  
					  <td  width="35px"> &nbsp; &nbsp; </td>
                      <TD> <strong>Final : </strong><br> <input type="date" name="fecha" id="txRpt_SeaceFechaFin" class="form-control  gs-input" style="width: 130px;">   </td></tr>
                      
                      </TABLE>  
					  <br>
					

					  <TABLE class="gs-table" >
                          <tr>
						  <td>
						   <div class="btn-group btn-input clearfix" id="txRptSeace_CodTipoRpt" style="margin-top:-2px;">
                                    <button type="button" id="btnRptSeaceTipoRpt" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:300px; height: 30px;font-size: 12px;  ">    <span  id="txRptSeace_TipoRpt"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-RptSeaceTipoRpt" role="menu" style="font-size: 12px; margin-top:-2px;  width:300px;">                                      
                                       <li  psrId="OC"><a href="#">Orden de Compra</a></li>
									   <li  psrId="OS"><a href="#">Orden de Servicio</a></li>
									 <!--  <li  psrId="CS"><a href="#">Orden de Compra y Servicio</a></li>-->
                                    </ul>
                                 </div>
						  </td>
						  </tr>
                          </TABLE>

  <hr width="auto">
		<TABLE class="gs-table" >					  
		<tr><td><button class="btn btn-primary" id = "btnLogSeaceExport"> Exportar ( *.xls)</button> </td>
		<td width="50px"> &nbsp;</td>
		<td><button class="btn btn-default" style="width:120px;" data-dismiss="modal"> Cancelar </button></td>
		</tr>
		</table>
  
 </div>
   </div>
   </div>
   </div>

<script type="text/javascript">
	
	 $( document ).on( 'click', '.menu-RptSeaceTipoRpt li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txRptSeace_CodTipoRpt").attr("codID",TipoReq);
    return false;
});

   

</script>
