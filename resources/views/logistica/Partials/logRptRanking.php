   <div class="modal fade"  id="modalRptRanking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
   <div class="modal-dialog"  style="width: 600px" >
   <div class="modal-content">
        <div class="modal-header" >
		
		<div class="panel" > <div class="panel-heading gs-panel-heading"   >
         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> Reporte Ranking de Proveedores </span>
         </div></div>
		 
                      <TABLE class="gs-table" >
                      <tr> <TD> <strong>Inicio :</strong><br><input type="date" name="fecha" id="txRpt_RankingFechaIni" class="form-control  gs-input" style="width: 130px;">   </td>
					  
					  
					             <td  width="35px"> &nbsp; &nbsp; </td>
                      <TD> <strong>Final : </strong><br> <input type="date" name="fecha" id="txRpt_RankingFechaFin" class="form-control  gs-input" style="width: 130px;">   </td></tr>
                      
            </TABLE>  
					  <br>
					
     
    <!-- <table>
     <tr>
    
          <td> <input type="text" name="txOC_Ruc"  id='txRng_Ruc' class = 'form-control gs-input' placeholder='Ruc' style = "width:130px; FONT-WEIGHT:BOLD;">  </td>
          <td  width="35px"> </td>
          <td> <input disabled='true' type="text" name="txRng_Razon"  id='txOC_Ruc' class = 'form-control gs-input' placeholder='Razon Social' style = "width:400px; FONT-WEIGHT:BOLD;">  </td> 
          
        

     </tr>
     </table>-->
					 
  <hr width="auto">
		<TABLE class="gs-table" >					  
		<tr>
    <td><button class="btn btn-primary" id = "btnLogRankingPdf"> Mostrar ( *.pdf)</button> 
    <td width="20px"> &nbsp;</td>
    <td><button class="btn btn-warning" id = "btnLogRankingExcel"> Exportar ( *.xls)</button> </td>
		<td width="300px"> &nbsp;</td>
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
3