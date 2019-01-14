<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">


 <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 55px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/tabOc.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="220px">
        <span style="font-size: 15px; font-weight: bold; "> ORDEN DE COMPRA :</span>
        </td>
        <td width="10"></td>
        <td> {!! Form::text('txAnio', 2016, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:55px; height:40px ; padding:6px;','id'=>'txAnio'  ))  !!}</td>

         <td>
              <div class="input-group" >
                <input id="txOC_No" type="text" class="form-control" placeholder="Nro OC"  style="width: 120px; height:40px;padding-top: 5px;font-weight:bold; font-size: 15px;">
                   <span class="input-group-btn">
                   <button class="btn btn-primary" id="btnLogOCSearch">
                   <span class="glyphicon glyphicon-search" aria-hidden="true" style="width: 30px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                   </button>
                   </span>
              </div>
         </td>

         <td width="10px">
         </td>

         <td>
               <button class="btn btn-primary" id="btnLogOCLeft">
               <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
               </button>
         </td>

         <td>
               <button class="btn btn-primary" id="btnLogOCRight">
               <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
               </button>
         </td>
        <td align="right" width="715px">

        @if (   Auth::user()->usrID=='43720736' || Auth::user()->usrID=='23974416' || Auth::user()->usrID=='40897950' || Auth::user()->usrID=='41130020' || Auth::user()->usrID=='47844622' || Auth::user()->usrID=='42469504' )
         

            {!! Form::button('IMPRIMIR',['class'=>'btn btn-default','id'=>'btnLogOCPrint','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'IMPRIMIR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconPRINT.png) no-repeat; background-position:top;' ]) !!}
         @else
         
          {!! Form::button('GUARDAR',['class'=>'btn btn-default','id'=>'btnLogOCSave','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'GUARDAR','style'=>' margin-left:2px;font-weight: bold; padding-left:2px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconSAVE2.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('CANCEL',['class'=>'btn btn-default','id'=>'btnLogOCCancel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CANCELAR','style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconCANCEL.png) no-repeat; background-position:top;' ]) !!}


          {!! Form::button('NUEVO',['class'=>'btn btn-default','id'=>'btnLogOCNew','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'NUEVO','style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconADD.png) no-repeat; background-position:top;']) !!}
          {!! Form::button('EDITAR',['class'=>'btn btn-default','id'=>'btnLogOCUpd','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'MODIFICAR','style'=>' margin-left:2px;font-weight: bold; padding-left:6px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconUPD.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('ANULAR',['class'=>'btn btn-default','id'=>'btnLogOCDel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'ELIMINAR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconDEL.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('RESERVAR',['class'=>'btn btn-default','id'=>'btnLogOCBusy','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'RESERVAR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconBusy.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('IMPRIMIR',['class'=>'btn btn-default','id'=>'btnLogOCPrint','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'IMPRIMIR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconPRINT.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('SIAF',['class'=>'btn btn-default','id'=>'btnLogOCSiaf','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'SIAF','style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconADD.png) no-repeat; background-position:top;']) !!}

          {!! Form::button('CERRAR',['class'=>'btn btn-default btn-cerrar','id'=>'a','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CERRAR',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconClose.png) no-repeat; background-position:top;' ]) !!}
       
        @endif
        <!--  {!! Form::button('BORRAR',['class'=>'btn btn-default','id'=>'btnLogOCTrsh','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'TRASH','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconTRASH.png) no-repeat; background-position:top;' ]) !!}  -->
        <!--  {!! Form::button('RESERVA',['class'=>'btn btn-default','id'=>'btnLogOCBusy','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'RESERVAR','style'=>' margin-left:2px;font-weight: bold; padding-left:2px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/cancel2.png) no-repeat; background-position:top;' ]) !!} -->

        </td>
    </tr>
    </table>
</div>


<div class="panel panel-default" style="margin-top: 5px; padding-bottom: 5px;" >
<div class="panel-heading gs-panel-heading"  style="padding: 5px" > ::: Datos Principales </div>
<table style ="margin-top: 5px;">
<tr >
<td >
        <table class="gs-table" style=" border-spacing:  0px;border-collapse: separate; ">
            <tr>
                <td align="right"> <label class="gs-label">Fecha :  </label></td>
                <td>
                     <table class="gs-table">
                     <tr>
                     <td align="left" colspan="2">  <input type="date" name="fecha" id="txOC_Fecha" class="form-control  gs-input" style="width: 130px;">   </td>
                     </tr>
                     </table>
                </td>
            </tr>

            <tr>
            <td  align="right" > {!! Form::label('first_name','Origen :', array('class'=> 'gs-label'))!!}  </td>
            <td>
                <table>
                <tr>
                <td>
                 <div class="btn-group btn-input clearfix"  style="margin-left: 1px;"  >
                    <button type="button" id="txOC_CodTipoDoc" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:130px; height: 30px; border: 1px dotted #aaa; font-size: 12px; ">    <span  id="txOC_TipoDoc"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                    <ul class="dropdown-menu menu-TipoReqOC" role="menu" style="font-size: 12px;">
                       <li  psrId="RQ"><a href="#">Requerimiento</a></li>
                       <li  psrId="CC"><a href="#">Cuadro Comp.</a></li>
					   <li  psrId="NN"><a href="#">Sin origen</a></li>
                    </ul>
                 </div>
                 </td>
                 <td>{!! Form::text('txOC_NroDoc', null, array('ID'=>'txOC_NroDoc', 'class' => 'form-control gs-input', 'placeholder'=>'Nro Doc ', 'style'=>'width:100px; margin-left:2px; height:29px; ', 'codID'=>'NN')) !!}</td>
                 </tr>
                 </table>
            </td>
            </tr>



            <tr>
                 <td  align="right" > {!! Form::label('first_name','Dependencia :', array('class'=> 'gs-label'))!!}  </td>
                 <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td>{!! Form::text('txOC_CodDep', null, array('ID'=>'txOC_CodDep','class' => 'form-control gs-input', 'placeholder'=>'Cod', 'style'=>'width:60px')) !!}</td>
                      <td>{!! Form::text('txOC_Dep', null, array('ID'=>'txOC_Dep', 'class' => 'form-control gs-input', 'placeholder'=>'Dependencia', 'style'=>'width:345px')) !!}</td>
                      </tr>
                      </TABLE>
                 </td>
            </tr>

            <tr>
                   <td  align="right" > {!! Form::label('first_name','Sec Fun :', array('class'=> 'gs-label'))!!}  </td>
                   <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td>{!! Form::text('txOC_CodSecFun', null, array('ID'=>'txOC_CodSecFun','class' => 'form-control gs-input', 'placeholder'=>'Cod', 'style'=>'width:60px')) !!}</td>
                      <td>{!! Form::text('txOC_SecFun', null, array('ID'=>'txOC_SecFun', 'class' => 'form-control gs-input', 'placeholder'=>'Secuencia Funcional', 'style'=>'width:345px')) !!}</td>
                      </tr>
                      </TABLE>
                   </td>
            </tr>


            <tr>
                   <td  align="right" > {!! Form::label('first_name', 'Rubro :', array('class'=> 'gs-label'))!!}  </td>
                   <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td>{!! Form::text('txOC_CodRubro', null, array('ID'=>'txOC_CodRubro','class' => 'form-control gs-input', 'placeholder'=>'Cod', 'style'=>'width:60px')) !!}</td>
                      <td>{!! Form::text('txOC_Rubro', null, array('ID'=>'txOC_Rubro', 'class' => 'form-control gs-input', 'placeholder'=>'Rubro', 'style'=>'width:345px')) !!}</td>
                      </tr>
                      </TABLE>
                   </td>
            </tr>
            <tr>
                               <td  align="right" > {!! Form::label('first_name', 'Glosa  :', array('class'=> 'gs-label'))!!}  </td>
                               <td>
                                  <TABLE class="gs-table" >
                                  <tr>
                                  <td>{!! Form::text('txOC_Glosa', null, array('ID'=>'txOC_Glosa', 'class' => 'form-control gs-input', 'placeholder'=>'Glosa', 'style'=>'width:407px')) !!}</td>
                                  </tr>
                                  </TABLE>
                               </td>
            </tr>

            <tr>
                    <td  align="right" > {!! Form::label('first_name','Lugar Entrg :', array('class'=> 'gs-label'))!!}  </td>
                    <td>
                          <TABLE class="gs-table" >
                          <tr>
                          <td>{!! Form::text('txOC_LugarEnt', null, array('ID'=>'txOC_LugarEnt', 'class' => 'form-control gs-input', 'placeholder'=>'Lugar de Entrega', 'style'=>'width:407px')) !!}</td>
                          </tr>
                          </TABLE>
                    </td>
            </tr>

            <tr>
                <td  align="right" > {!! Form::label('first_name','Referencia :', array('class'=> 'gs-label'))!!}  </td>
                <td>
                      <TABLE class="gs-table" >
                      <tr>
                      <td>{!! Form::text('txOC_Ref', null, array('ID'=>'txOC_Ref', 'class' => 'form-control gs-input', 'placeholder'=>'Referencia', 'style'=>'width:407px')) !!}</td>
                      </tr>
                      </TABLE>
                </td>
            </tr>


             <tr>
                    <td  align="right" > {!! Form::label('first_name','Tipo Proc :', array('class'=> 'gs-label'))!!}  </td>
                    <td>
                          <TABLE class="gs-table" >
                          <tr>
                          <td>{!! Form::text('txOC_CodTipoProc', null, array('ID'=>'txOC_CodTipoProc','class' => 'form-control gs-input', 'placeholder'=>'Cod', 'style'=>'width:60px')) !!}</td>
                          <td>{!! Form::text('txOC_TipoProc', null, array('ID'=>'txOC_TipoProc', 'class' => 'form-control gs-input', 'placeholder'=>'Tipo de Proceso', 'style'=>'width:345px')) !!}</td>
                          </tr>
                          </TABLE>
                    </td>
             </tr>

            <tr>      
              <td  align="right" > {!! Form::label('first_name','Observ :', array('class'=> 'gs-label'))!!}  </td>
              <td>
                   <TABLE class="gs-table" >
                   <tr>                    
                    <td >{!! Form::textarea('txOC_Obsv', null, array('ID'=>'txOC_Obsv', 'class' => 'form-control gs-input', 'placeholder'=>'Observaciones', 'style'=>'width:405px','rows'=>'3')) !!}</td>
                   </tr>
                   </TABLE>
            </td>
            </tr>

      </table>

</td>
<td width="10px">

</td>
<td valign="top">
      <table>

		    <tr>
            <td >Expdiente SIAF : <span style="margin-left:0px; font-size:13px; font-weight:bold: " id="lblExp">  </span> </td>
            <td  align="right">            
            <label  id="txOC_Etapa"  style="margin-top: 0px;border-radius: 3px; padding: 2px; border: 1px #ddd dashed; ; height: 25px; font-size: 15px; width:100px; font-weight: bold; text-align: center; margin-bottom: -4px"></label>
            </td>
        </tr>    
	  
	    <tr>		
		<td colspan="2" >
             <TABLE class="gs-table" >
             <tr>
             <td >{!! Form::textarea('txOC_Condicion', null, array('ID'=>'txOC_Condicion', 'class' => 'form-control gs-input', 'placeholder'=>'Condicion', 'style'=>'width:524px','rows'=>'8')) !!}</td>
             </tr>

             </TABLE>
      </td>
      </tr>
   

      
      </table>

</td>
</tr>
</table>

</div>



<div class="panel panel-default" style="margin-top: -15px; " >

   <div style="margin:5px;">
     <table>
          <tr>
          <td  align="right"  width="70px;"> {!! Form::label('first_name','RUC :', array('class'=> 'gs-label'))!!}  </td>
          <td>{!! Form::text('txOC_Ruc', null, array('ID'=>'txOC_Ruc','class' => 'form-control gs-input', 'placeholder'=>'Ruc', 'style'=>'width:100px; FONT-WEIGHT:BOLD;')) !!}</td>
          <td  width="5px"> </td>
          <td>{!! Form::text('txOC_RSocial', null, array('ID'=>'txOC_RSocial','class' => 'form-control gs-input', 'placeholder'=>'Razon Social', 'style'=>'width:300px')) !!}</td>
          <td  width="35px"> </td>
          <td  align="right"  > {!! Form::label('first_name','Plazo :', array('class'=> 'gs-label'))!!}  </td>
          <td>{!! Form::text('txOC_Plazo', null, array('ID'=>'txOC_Plazo','class' => 'form-control gs-input', 'placeholder'=>'Cod', 'style'=>'width:250px')) !!}</td>

          <td  width="10px"> </td>
          <td  align="right"  > {!! Form::label('first_name','IGV :', array('class'=> 'gs-label'))!!}  </td>
          <td>{!! Form::text('txOC_IGV', null, array('ID'=>'txOC_IGV','class' => 'form-control gs-input', 'placeholder'=>'IGV', 'style'=>'width:50px')) !!}</td>

          <td  width="10px"> </td>
          <td  align="right"  > {!! Form::label('first_name','Garantia :', array('class'=> 'gs-label'))!!}  </td>
          <td>{!! Form::text('txOC_Garantia', null, array('ID'=>'txOC_Garantia','class' => 'form-control gs-input', 'placeholder'=>'Garantia', 'style'=>'width:100px')) !!}</td>
           <!--
          <td  width="18px"> </td>
          <td  width="10px"> <span id="btnLogOC_Ruc" class="btn btn-info" STYLE="height: 25px; padding-top: 2px; font-weight: bold;"> RUC </span> </td>
		  -->
          </tr>
     </table>
   </div>
</div>



</div>
</div>


<div class="panel panel-default" style="margin-top: -15px" >
<div class="panel-heading gs-panel-heading" > :::  Lista de Bienes     <TABLE><TR> <TD> {!! Form::button('Catalogo '     ,['id'=>'btnLogOCCatalogo' ,'class'=>'btn btn-default','style'=> 'width: 100Px  ;height: 25px ; padding=0;margin-top:-5px; font-size:10px; margin-left:105px; ']) !!} </TD> <TD> {!! Form::button(' - LIMPIAR '     ,['id'=>'btnLogOCLimpiar' ,'class'=>'btn btn-default','style'=> 'width: 100Px  ;height: 25px ; padding=0;margin-top:-5px; font-size:10px; margin-left:175px; ']) !!} </TD><!--<TD>   {!! Form::button(' % Cal IGV '        ,['id'=>'btnLogOCIgv' ,'class'=>'btn btn-default','style'=> 'width: 100Px  ;height: 25px ; padding=0;margin-top:-5px; font-size:10px; margin-left:200px; ']) !!} </TD>--><TD>   {!! Form::button(' + ITEM '        ,['id'=>'btnLogOCItem' ,'class'=>'btn btn-default','style'=> 'width: 60Px  ;height: 25px ; padding=0;margin-top:-5px; font-size:10px; margin-left:300px; ']) !!} </TD></TR></TABLE></div>
<div id="dvBarraOCAdd" class="panel-heading gs-panel-heading" style="display: none;" >
     <table id="tbBarraBienes" style="height: 50px;" >

     </table>
</div>
<div class="panel-body" id="divOC_Dll">


</div>


<div class="panel panel-default" style="margin-top: -15px; " id="CONVMARCO" >

   <div style="margin:5px; margin-left:900px;">
     <table>
          <tr>
          <td  align="right"  > {!! Form::label('first_name','DESCUENTO : ', array('class'=> 'gs-label'))!!}  </td>
          <td>{!! Form::text('txOC_tDesc', null, array('ID'=>'txOC_tDesc','class' => 'form-control gs-input', 'placeholder'=>'Descuento', 'style'=>'width:80px')) !!}</td>
          </tr>
          <tr>

          <td  align="right"  > {!! Form::label('first_name','COSTO DE ENVIO : ', array('class'=> 'gs-label'))!!}  </td>
          <td>{!! Form::text('txOC_tEnvio', null, array('ID'=>'txOC_tEnvio','class' => 'form-control gs-input', 'placeholder'=>'Costo Envio', 'style'=>'width:80px')) !!}</td>


          </tr>
     </table>
   </div>
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

<div id="modalOC"></div> 



<script type="text/javascript">


function  jsFunModalExpediente (parmTitulo, parmHtml)
{
    $(".modal-backdrop").remove();
    t='';
    t+=' <div class="modal fade"  id="modalVentExpediente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >';
    t+=' <div class="modal-dialog"  >';
    t+=' <div class="modal-content" > ';
    t+='            <div class="modal-header"  >';
    t+='                    <div class="panel" style="margin-bottom:-15px;" > <div class="panel-heading gs-panel-heading"  style="background: #2F3414 ; COLOR:#ffffff;" >';
    t+='                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>';
    t+='                    <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 12px;  font-family:  Arial, Helvetica, Verdana  "> Orden de Compra : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
    t+= '                   <span style="font-size:22px;"> '+ parmTitulo +'  </span> ';
    t+='                     </span>' ;
    t+='                    </div></div>';

    t+='            </div>';
    t+='            <div class="modal-body"  id="modalContExpediente"  >  '+jsFunModalExpedientePanel(parmHtml)+' </div> ';

t+='<table style="margin-left:30px; "> ';
t+=' ';
t+='<tr ><td align="right"> &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp; &nbsp;  &nbsp; &nbsp; Año : </td> <td > <input id="txExpAnio" value=""  class="form-control"style="width:65px; font-size:15px;" maxlength="4" /> </td> ';
t+='<td align="right"> &nbsp; &nbsp;  &nbsp; Expediente : </td> <td  >  <input id="txExpCod"  value="0000"  class="form-control" style="width:75px ; font-size:15px;" maxlength="4" />  </td> ';
t+='<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp; &nbsp; <button id ="btnLogOCSiaf_ADD" name="btnLogOCSiaf_ADD" class="btn btn-primary " style="font-size:10px;margin:10px; width: 80px;height: 35px; " idItem="0" align="right"> GUARDAR  </button> </td><td> <button class="btn btn-default" id=" " style="width: 80px;height: 35px;" data-dismiss="modal"> Cancelar</button>  </td>';
t+='</table> ';

    t+=' ';
    t+=' </div>';       
    t+=' </div>';
    t+=' </div> ';
    return t;
}


function  jsFunModalExpedientePanel (prmHtml)
{
  t='';


t+='<div class="panel panel-default" style="margin-top: 0px; padding-bottom: 0px; width:550px; height:175px;" > ';
t+='<div class="panel-heading gs-panel-heading"  style="padding: 5px" > ::: Expediente SIAF  </div> ';
t+='<div id="modalExp" style="overflow: scroll;    height: 140px; ">  '+prmHtml+' </div>';
t+='</div>';


  return t;
}




$("#txOC_Condicion").summernote(
  {
     width:630,
     height:250,
 styleWithSpan: false,
                        toolbar: [
                        ]     
}
  );
</script>>



