<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px; margin-bottom:20px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">


<!--
 <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 48px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="100px">
        <span style="font-size: 15px; font-weight: bold; "> REPORTES :</span>
        </td>
        <td width="10"></td>
        <td> {!! Form::text('txAnio', 2016, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:55px; height:40px ; padding:6px;','id'=>'txAnio'  ))  !!}</td>

       
       
    </tr>
    </table>
</div>
-->

<div class="panel panel-default" style="margin-top: 5px; margin-bottom: -5px; " >
<div class="panel-heading gs-panel-heading"  style="padding: 5px" > ::: DATOS PARA GENERAR EL REPORTE </div>

        <table class="gs-table" style=" border-spacing:  0px;border-collapse: separate; ">
           
		     <tr>
                   <td  align="right" > {!! Form::label('first_name','Desde :', array('class'=> 'gs-label'))!!}  </td>
                   <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td> <input type="date" name="fecha" id="txRpt_FechaIni" class="form-control  gs-input" style="width: 125px;">   </td>
					  <td width="55px"> &nbsp; - hasta -  &nbsp; </td>
                      <td> <input type="date" name="fecha" id="txRpt_FechaFin" class="form-control  gs-input" style="width: 125px;">   </td>
                      </tr>
                      </TABLE>
                   </td>
            </tr>
           

            <tr>
                   <td  align="right" > {!! Form::label('first_name','Sec Fun :', array('class'=> 'gs-label'))!!}  </td>
                   <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td>{!! Form::text('txRpt_CodSecFun', null, array('ID'=>'txRpt_CodSecFun','class' => 'form-control gs-input', 'placeholder'=>'Todos', 'style'=>'width:100px')) !!}</td>
                      <td>{!! Form::text('txRpt_SecFun', null, array('ID'=>'txRpt_SecFun', 'class' => 'form-control gs-input', 'placeholder'=>'Secuencia Funcional', 'style'=>'width:900px')) !!}</td>
                      </tr>
                      </TABLE>
                   </td>
            </tr>


            <tr>
                   <td  align="right" > {!! Form::label('first_name', 'Rubro :', array('class'=> 'gs-label'))!!}  </td>
                   <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td>{!! Form::text('txRpt_CodRubro', null, array('ID'=>'txRpt_CodRubro','class' => 'form-control gs-input', 'placeholder'=>'Todos', 'style'=>'width:100px')) !!}</td>
                      <td>{!! Form::text('txRpt_Rubro', null, array('ID'=>'txRpt_Rubro', 'class' => 'form-control gs-input', 'placeholder'=>'Rubro', 'style'=>'width:900px')) !!}</td>
                      </tr>
                      </TABLE>
                   </td>
            </tr>
           

             <tr>
                    <td  align="right" > {!! Form::label('first_name','Tipo Proc :', array('class'=> 'gs-label'))!!}  </td>
                    <td>
                          <TABLE class="gs-table" >
                          <tr>
                          <td>{!! Form::text('txRpt_CodTipoProc', null, array('ID'=>'txRpt_CodTipoProc','class' => 'form-control gs-input', 'placeholder'=>'Todos', 'style'=>'width:100px')) !!}</td>
                          <td>{!! Form::text('txRpt_TipoProc', null, array('ID'=>'txRpt_TipoProc', 'class' => 'form-control gs-input', 'placeholder'=>'Tipo de Proceso', 'style'=>'width:900px')) !!}</td>
                          </tr>
                          </TABLE>
                    </td>
             </tr>
			     <tr >
                    <td  align="right" > {!! Form::label('first_name','RUC:', array('class'=> 'gs-label'))!!}  </td>
                    <td>
                          <TABLE class="gs-table" >
                          <tr>
                          <td>{!! Form::text('txRpt_Ruc', null, array('ID'=>'txRpt_Ruc','class' => 'form-control gs-input', 'placeholder'=>'Todos', 'style'=>'width:100px')) !!}</td>
                          <td>{!! Form::text('txRpt_RSocial', null, array('ID'=>'txRpt_RSocial', 'class' => 'form-control gs-input', 'placeholder'=>'Razon Social', 'style'=>'width:900px')) !!}</td>
                          </tr>
                          </TABLE>
                    </td>
             </tr>
			 
			   <tr>
              
                                  <td  align="right" > {!! Form::label('first_name','Tipo de Reporte:', array('class'=> 'gs-label'))!!}  </td>
                                  <td>
                                        <TABLE class="gs-table" >
                                        <tr>
                      						        <td>
                      						                      <div class="btn-group btn-input clearfix" id="txRpt_CodTipoRpt" style="margin-top:-2px;">
                                                          <button type="button" id="btnRptTipoRpt" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:200px; height: 30px;font-size: 12px;  ">    <span  id="txRpt_TipoRpt"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                          <ul class="dropdown-menu menu-RptTipoRpt" role="menu" style="font-size: 12px; margin-top:-2px;  width:200px;">
                                                             <li  psrId="RQ"><a href="#">Requerimientos</a></li>
                                                              <li psrID="RQP"><a href="#">Requerimientos Proceso</a></li>
                                                             <li  psrId="CTZ"><a href="#">Cotizaciones</a></li>
                                                             <li  psrId="CDR"><a href="#">Cuadro Comparativo</a></li>
                                                             <li  psrId="OC"><a href="#">Orden de Compra</a></li>
                                        									   <li  psrId="OS"><a href="#">Orden de Servicio</a></li>
                                        									  <!-- <li  psrId="CS"><a href="#">Orden de Compra y Servicio</a></li>-->
                                                          </ul>
                                                       </div>
                      						      </td>
                      						      </tr>
                                      </TABLE>
                                  </td>
          </tr>
           <tr>
                                  <td  align="right" > {!! Form::label('first_name','Nivel :', array('class'=> 'gs-label'))!!}  </td>
                                  <td>
                                        <TABLE class="gs-table" border="0" >
                                        <tr>
                          						  <td>
                          						                    <div class="btn-group btn-input clearfix" id="txRpt_CodNivel" style="margin-top:-4px;">
                                                              <button type="button" id="btnRptNivel" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:200px; height: 30px;font-size: 12px;  ">    <span  id="txRpt_Nivel"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                              <ul class="dropdown-menu menu-RptNivel" role="menu" style="font-size: 12px; margin-top:-2px; width:200px; ">
                                                                 <li  psrId="GRL"><a href="#"> Reporte por Registros </a></li>
                                                                 <li  psrId="DLL"><a href="#"> Reporte en Detalle </a></li>
                                                              </ul>
                                                           </div>
                          						  </td>

                                        
                          						  </tr>
                                        </TABLE>
                       
                                  </td>
           </tr>
           
           <tr>
            <td>
            </td>

            <td>
           <br>
             {!! Form::button('MOSTRAR '        ,['id'=>'btnLogRptShow' ,'class'=>'btn btn-primary','style'=> 'font-weight:bold; width: 200Px  ;height: 40px ; padding=0; font-size:11px; margin-top:-5px; margin-left:0px; margin-bottom:5px; ','href','www.google.com']) !!} 
            </td>
            </tr>
     </table>

</div>



</div>
</div>


<div class="panel panel-default" style="margin-top: -15px" >
<div class="panel-body" id="divOC_Dll" style="overflow: scroll;    height: 500px;" >

</div>
</div>
</div>

<div id = "OC" opeID="NN" anioID = "NN" reqID="NN" fteID="NN" ctzID = "" cdrID ="NN" ocID=""  reqEtapa="NN" > </div>
<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div style="height: 56px"></div>

<div id="divDialog">
<div id="divDialogCont"></div>
</div>


<script type="text/javascript">
  
  $( document ).on( 'keydown','#txRpt_CodSecFun, #txRpt_CodRubro, #txRpt_CodTipoProc, #txRpt_Ruc',function(event) {
    if(event.shiftKey)     {        event.preventDefault();      }
    if( event.keyCode == 8 )
    {
      var Evento = $(this).attr('id');
     // alert(Evento);

      if(Evento =="txRpt_CodSecFun")
      {
         $("#txRpt_CodSecFun").attr("codID","NN");
         $("#txRpt_CodSecFun").val("");
         $("#txRpt_SecFun").val("");
      }
       else if(Evento =="txRpt_CodRubro")
      {
         $("#txRpt_CodRubro").attr("codID","NN");
         $("#txRpt_CodRubro").val("");
         $("#txRpt_Rubro").val("");
      }
      else if(Evento =="txRpt_CodTipoProc")
      {
         $("#txRpt_CodTipoProc").attr("codID","NN");
         $("#txRpt_CodTipoProc").val("");
         $("#txRpt_TipoProc").val("");
      }
      else  if(Evento =="txRpt_Ruc")
      {
         $("#txRpt_Ruc").attr("codID","NN");
         $("#txRpt_Ruc").val("");
         $("#txRpt_RSocial").val("");
      }
    }
  });
</script>


  <!--
              <tr>
                    <td  align="right" > {!! Form::label('first_name','Etapa :', array('class'=> 'gs-label'))!!}  </td>
                    <td>
                          <TABLE class="gs-table" >
                          <tr>
              <td>
               <div class="btn-group btn-input clearfix" id="txRpt_CodEtapa" style="margin-top:-4px;">
                                    <button type="button" id="btnRptEtapa" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:200px; height: 30px;font-size: 12px;  ">    <span  id="txRpt_Etapa"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-RptEtapa" role="menu" style="font-size: 12px; margin-top:-2px; width:200px; ">
                                       <li  psrId="T"><a href="#"> TODOS </a></li>
                                       <li  psrId="O"><a href="#"> PROCESADOS </a></li>
                                       <li  psrId="P"><a href="#"> PENDIENTES </a></li>
                                       <li  psrId="A"><a href="#"> ANULADOS </a></li>

                                    </ul>
                                 </div>
              </td>
              </tr>
              -->