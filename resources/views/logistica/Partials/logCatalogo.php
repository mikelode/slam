    <div class="modal fade"  id="modalCatalogo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
       <div class="modal-dialog"  style="width: 500px" >
       <div class="modal-content">
            <div class="modal-header" >
                             <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #338Bb7 ; COLOR:#ffffff;" >
                             <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
                             <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> REGISTRO DE PERSONAL </span>
                             </div></div>

									 
											  <table class="gs-table" style="margin-left: 5px ; margin-top: 2px;" >
									<tr valign="center" >

										<td ALIGN="RIGHT" width="100px">
										<span style="font-size: 12px;"> DESCRIPCION :</span>
										</td>

										<td> {!! Form::text('txDsc', null, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:750px; height:40px','id'=>'txDsc'    ))  !!} </td>
										<td align="LEFT" width="215px">

										 <span id="btnLogCat_Save" class="btn btn-primary" STYLE="WIDTH:100PX;height: 40px; padding-top: 10px; font-weight: bold;"> GUARDAR </span>
										 <span id="btnLogCat_Cancel" class="btn btn-default" STYLE="WIDTH:100PX;height: 40px; padding-top: 10px; font-weight: bold;"> CANCELAR </span>

										</td>
									</tr>
									</table>
								<br>
								<span id="btnLogCat_New" class="btn btn-info" STYLE="WIDTH:150PX;height: 40px; padding-top: 10px; font-weight: bold;"> Nuevo Registro</span>
								<BR>
								<BR>
									<div id="CatDll">
									</div>
	
	 
            </div>

       </div>
       </div>
       </div>
