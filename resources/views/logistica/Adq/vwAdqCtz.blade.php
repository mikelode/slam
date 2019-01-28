<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">




 <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 55px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 15px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/tabCtz.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="130px">
        <span style="font-size: 16px; font-size: 15px ; font-weight: bold;"> COTIZACIONES :</span>
        </td>
        <td width="10"></td>
        <td> {!! Form::text('txAnio', 2016, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:55px; height:40px ; padding:6px;','id'=>'txAnio'  ))  !!}</td>


        <td>
            <div class="input-group" >
               <input id="txCtzNo" type="text" class="form-control" placeholder="Nro Ctz"  style="width: 110px; height:40px;padding-top: 5px;font-weight:bold; font-size: 15px;">
               <span class="input-group-btn">
                      <button class="btn btn-primary" id="btnLogCtzSearch">
                            <span class="glyphicon glyphicon-search" aria-hidden="true" style="width: 30px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                      </button>
               </span>
            </div>

        </td>

        <td width="10px">
        </td>

        <td>
                <button class="btn btn-primary" id="btnLogCtzLeft">
                   <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                </button>

        </td>

        <td>
                <button class="btn btn-primary" id="btnLogCtzRight">
                     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                </button>
        </td>



         <td align="right" width="580px">
          {!! Form::button('GUARDAR',['class'=>'btn btn-default','id'=>'btnLogCtzSave','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'GUARDAR','style'=>' margin-left:2px;font-weight: bold; padding-left:2px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconSAVE2.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('CANCEL',['class'=>'btn btn-default','id'=>'btnLogCtzCancel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CANCELAR','style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconCANCEL.png) no-repeat; background-position:top;' ]) !!}

         
          {!! Form::button('NUEVO',['class'=>'btn btn-default','id'=>'btnLogCtzNew','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'NUEVO',       'style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconADD.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('EDITAR',['class'=>'btn btn-default','id'=>'btnLogCtzUpd','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'MODIFICAR',  'style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconUPD.png) no-repeat; background-position:top;']) !!}
          {!! Form::button('ANULAR',['class'=>'btn btn-default','id'=>'btnLogCtzDel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'ELIMINAR',   'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconDEL.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('RESERVAR',['class'=>'btn btn-default','id'=>'btnLogCtzBusy','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'RESERVAR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconBusy.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('IMPRIMIR',['class'=>'btn btn-default','id'=>'btnLogCtzPrint','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'IMPRIMIR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconPRINT.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('BORRAR',['class'=>'btn btn-default','id'=>'btnLogCtzTrsh','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'TRASH',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconTRASH.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('CERRAR',['class'=>'btn btn-default btn-cerrar','id'=>'a','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CERRAR',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconClose.png) no-repeat; background-position:top;' ]) !!}
          {{--{!! Form::button('RESERVA',['class'=>'btn btn-default','id'=>'btnLogCtzBusy','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'RESERVAR','style'=>' margin-left:2px;font-weight: bold; padding-left:3px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/Cancel2.png) no-repeat; background-position:top;' ]) !!}--}}

         

         </td>
    </tr>
    </table>
</div>

<div class="panel-heading gs-panel-heading"  style=" border-radius: 5px; width: 1140px ;  height: 210px; border: 1px solid #ddd ; padding-top: 0px; margin-top: 0px ; margin-bottom:5px; background: #f9f9f9 ;   " >


               <table class="gs-table" style=" border-spacing:  0px;border-collapse: separate; ">
               <tr valign="top">
               <td>

                <table  class="gs-table">

                <tr>
                <td align="right"> <label class="gs-label">  </label></td>
                <td  align="right">            
                <label  id="txEtapa"  style="margin-top: 0px;border-radius: 3px; padding: 2px; border: 1px #ddd dashed; ; height: 25px; font-size: 15px; width:100px; font-weight: bold; text-align: center; margin-bottom: -4px"></label>
                </td>

                </tr>
                        <tr>
                            <td align="right"> <label class="gs-label">Fecha :  </label></td>
                            <td align="left" colspan="2">  <input type="date" name="fecha" id="txFecha" class="form-control  gs-input" style="width: 130px; ">   </td>
                        </tr>
                        
                        <tr>
                            <td align="right"> <label class="gs-label"> Origen Doc :  </label></td>
                            <td align="left" colspan="2">  
                                    <div class="btn-group btn-input clearfix" id="txCodTipoCzDoc">
                                    <button type="button" id="btnTipoCzDoc" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:130px; height: 30px;font-size: 11px;  ">    <span  id="txTipoCzDoc"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-TipoCzDoc" role="menu" style="font-size: 11px; ">
                                       <li  psrId="**"><a href="#">OTROS</a></li>
                                       <li  psrId="RQ"><a href="#">REQUERIMIENTO</a></li>
                                    </ul>
                                 </div>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"> <label class="gs-label">Nro Req :  </label></td>
                            <td align="left" colspan="2">  <input type="text" placeholder='Cod Req.' id="txCodReq" class="form-control  gs-input" style="width: 130px; ">   </td>
                        </tr>


            			<tr valign="top">
                        <td  align="right" > {!! Form::label('first_name','Glosa :', array('class'=> 'gs-label'))!!}  </td>
                        <td colspan="2"> {!! Form::text('txGLosa', null, array('ID'=>'txGlosa', 'class' => 'form-control gs-input', 'placeholder'=>'Glosa', 'style'=>'width:700px')) !!}</td>
                        </tr>
                        <tr>
                         <td  align="right" > {!! Form::label('first_name','Lugar Entrega :', array('class'=> 'gs-label'))!!}  </td>
                         <td colspan="2" >{!! Form::text('txLugarEnt', null, array('ID'=>'txLugarEnt' ,'class' => 'form-control gs-input', 'placeholder'=>'Entrega', 'style'=>'width:700px')) !!}</td>
                        </tr>

                         </tr>
                         <tr valign="top">
                         <td  align="right" > {!! Form::label('first_name','Observaciones :', array('class'=> 'gs-label'))!!}  </td>
                         <td colspan="2" >{!! Form::textarea('txObsv', null, array('ID'=>'txObsv', 'class' => 'form-control gs-input', 'placeholder'=>'Observaciones', 'style'=>'width:700px','rows'=>'2')) !!}</td>
                         </tr>

                     </table>
               
                 </td>
                 <td width="40px"> .
                 </td>

                 <td valign="bottom" >                 
                    {{--{!! Form::button(' Catalogo de Bienes ' ,['id'=>'btnLogCtzCatalogo' ,'class'=>'btn btn-primary','style'=> 'width: 120Px  ;height: 30px ; padding:0;margin-top:0px; font-size:10px; margin-left:30px; ']) !!} --}}
                    {!! Form::button(' Nuevo Bien '        ,['id'=>'btnLogCtzItem' ,'class'=>'btn btn-primary','style'=> 'width: 120Px  ;height: 30px ; padding:0;margin-top:0px; font-size:10px; margin-left:5px; ']) !!}
                  </td>
                 </tr>
                 </table>

</div>



</div>
</div>


<div class="panel panel-default" style="margin-top: -15px" >
<div class="panel-heading gs-panel-heading" > :::  Lista de Bienes o Servicios </div>
<div id="dvCtzBarraAdd" class="panel-heading gs-panel-heading" style="display: none;" >
     <table id="tbCtzBarraBienes" style="height: 50px;" >

     </table>
</div>
<div class="panel-body" id="divCtzProdBienes">

                 <!--<table    id="tbCtzDll" class="table suggest-element  table-striped table-hover" style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px"> -->
                 <table    id="tbCtzDll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; line-height:12px; border-spacing: 0px; table-layout: fixed" width="100%" cellpadding="0px" cellspacing="0px">
                     <thead align="center">
                      <tr CLASS="gsTh">
                         <th WIDTH="0%" style="display: none" ></th>
                         <th WIDTH="0%" style="display: none" ></th>

                          <th width="5%" align="center" valign="middle">Sec.Fun</th>
                          <th width="5%" align="center" valign="middle">Rubro</th>

                         <th WIDTH="10%"  align="center"   valign="center">Cant</th>
                          <th WIDTH="10%"  align="center"   valign="center">Unidad</th>
                         <th WIDTH="30%" align="left"     valign="center">Descripcion</th>
                        
                         <th WIDTH="30%" align="left"     valign="center">Especificaciones</th>
                         <th width="5%" valign="right"  ><span  id="EDIT">Editar</span></th>
                         <th width="5%" align="right"> <span id="DEL"> Borrar</span></th>
                      </tr>
                     </thead>
                     <tbody>
                          
                </tbody>
                <tfoot>
                        <tr class="fila-Hide">
                                 <td name="tdCzItm"  style="display: none" >0</td>
                                 <td name="tdRqItm"  style="display: none" >0</td>

                            <td name="tdSF" align="center"></td>
                            <td name="tdRubro" align="center"></td>

                                 <td name="tdCant"  align="center" >2</td>
                                 <td name="tdUnd"  align="center"  >5</td>
                                 <td name="tdProd"  align="left"   >4</td>
                                 <td name="tdEspf"  align="left"   >6</td>                                 
                                 
                                 <td BGCOLOR="#d9edf7"><button id="EDIT" class="btn btn-warning btnCtzRowEDIT" style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                                 <td BGCOLOR="#d9edf7" ><button id="DEL" class="btn btn-danger btnCtzRowDEL" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                        </tr>
                </tfoot>
                </table>


                </div>
                </div>

</div>

<div id = "CTZ" opeID="NN" anioID = "NN" ctzID="NN" reqID="NN" ctzEtapa="NN" > </div>
<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div style="height: 56px"></div>

<div id="divDialog">
<div id="divDialogCont"></div>
</div>



