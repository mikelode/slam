<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">




 <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 58px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="165px">
        <span style="font-size: 16px;font-weight:bold;"> REQUERIMIENTOS :</span>
        </td>
        <td width="10"></td>
        <td> {!! Form::text('txAnio', 2016, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:55px; height:40px ; padding:6px; font-weight:bold;','id'=>'txAnio'  ))  !!}</td>
        <td>
            <div class="input-group" >
               <input id="txReqNo" type="text" class="form-control" placeholder="Nro Req"  style="width: 100px; height:40px;padding-top: 5px;font-weight:bold; font-size: 15px;">
               <span class="input-group-btn">
                     <!-- <button class="btn btn-primary" id="btnLogReqSearch">
                            <span class="glyphicon glyphicon-search" aria-hidden="true" style="width: 30px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span> -->
                      </button>
               </span>
            </div>

        </td>

        <td width="10px">
        </td>

        <td>
                <button class="btn btn-primary" id="btnLogReqLeft">
                   <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                </button>

        </td>

        <td>
                <button class="btn btn-primary" id="btnLogReqRight">
                     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                </button>
        </td>

        <td align="right" width="715px">

          {!! Form::button('GUARDAR',['class'=>'btn btn-default','id'=>'btnLogReqSave','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'GUARDAR','style'=>' margin-left:2px;font-weight: bold; padding-left:2px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconSAVE2.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('CANCEL',['class'=>'btn btn-default','id'=>'btnLogReqCancel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CANCELAR','style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconCANCEL.png) no-repeat; background-position:top;' ]) !!}

          {!! Form::button('NUEVO',['class'=>'btn btn-default','id'=>'btnLogReqNew','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'NUEVO',       'style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconADD.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('EDITAR',['class'=>'btn btn-default','id'=>'btnLogReqUpd','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'MODIFICAR',  'style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconUPD.png) no-repeat; background-position:top;']) !!}
          {!! Form::button('ANULAR',['class'=>'btn btn-default','id'=>'btnLogReqDel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'ELIMINAR',   'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconDEL.png) no-repeat; background-position:top;' ]) !!}
          {!! Form::button('IMPRIMIR',['class'=>'btn btn-default','id'=>'btnLogReqPrint','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'IMPRIMIR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconPRINT.png) no-repeat; background-position:top;' ]) !!}
          <!-- {!! Form::button('BORRAR',['class'=>'btn btn-default','id'=>'btnLogReqTrsh','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'TRASH',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconTRASH.png) no-repeat; background-position:top;' ]) !!} -->
          {!! Form::button('CERRAR',['class'=>'btn btn-default btn-cerrar','id'=>'a','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CERRAR',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconClose.png) no-repeat; background-position:top;' ]) !!}



        </td>
    </tr>
    </table>
</div>

<div class="panel-heading gs-panel-heading"  style=" border-radius: 5px; width: 1140px ;  height: 300px; border: 1px solid #ddd ; padding-top: 0px; margin-top: 0px ; margin-bottom:5px; background: #f9f9f9 ;   " >


               <table class="gs-table" style=" border-spacing:  0px;border-collapse: separate; ">
               <tr>
               <td>

                <table  class="gs-table">
                        <tr>
                        <td align="right"> {!! Form::label('first_name','Tipo de Req :', array('class'=> 'gs-label'))!!}  </td>
                        <td colspan="2">

                              <table>
                              <tr>
                              <td>
                                 <div class="btn-group btn-input clearfix" id="txCodTipoReq">
                                    <button type="button" id="btnTipoReq" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:130px; height: 30px;font-size: 12px;  ">    <span  id="txTipoReq"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-TipoReq" role="menu" style="font-size: 12px; ">
                                       <li  psrId="BB"><a href="#">BIENES</a></li>
                                       <li  psrId="SS"><a href="#">SERVICIOS</a></li>
                                    </ul>
                                 </div>
                              </td>
                              <td width="175">

                              </td>
                              <td>

                              </td>
                              </tr>
                              </table>

                        </td>
                       </tr>

                        <tr>
                       <td align="right"> <label class="gs-label">Fecha :  </label></td>
                       <td align="left" colspan="2">  <input type="date" name="fecha" id="txFecha" class="form-control  gs-input" style="width: 130px;">   </td>
                        </tr>


                        <tr >
                        <td align="right"> {!! Form::label('first_name','Dependencia :', array('class'=> 'gs-label'))!!}  </td>
                        <td>{!! Form::text('txCodDep', null, array('class' => 'form-control  gs-input  ', 'placeholder'=>'Codigo', 'style'=>'width:55px','id'=>'txCodDep'))  !!}</td>
                        <td>{!! Form::text('txDep', null, array( 'class' => 'form-control gs-input Corner-Items-Small', 'placeholder'=>'Dependencia', 'style'=>'width:350px','id'=>'txDep'))  !!}</td>
                        </tr>

                        <tr valign="top">
            			<td align="right"> {!! Form::label('first_name','Sec Funcional :', array('class'=> 'gs-label'))!!}  </td>
            			<td>{!! Form::text('txCodSecFun', null, array('ID'=>'txCodSecFun' ,'class' => 'form-control gs-input', 'placeholder'=>'Codigo', 'style'=>'width:55px'))  !!}</td>
            			<td>{!! Form::textarea('txSecFun', null, array('ID'=>'txSecFun' , 'class' => 'form-control gs-input', 'placeholder'=>'Secuencia Funcional', 'style'=>'width:350px' , 'rows'=>'2'))  !!}</td>
                        </tr>
                        {{--<tr >--}}
                        {{--<td align="right"> {!! Form::label('first_name','Sub Sec :', array('class'=> 'gs-label'))!!}  </td>--}}
                        {{--<td>{!! Form::text('txCodSubSec', null, array('ID'=>'txCodSubSec' ,'class' => 'form-control gs-input', 'placeholder'=>'Codigo', 'style'=>'width:55px'))  !!}</td>--}}
                        {{--<td>{!! Form::text('txSubSec', null, array('ID'=>'txSubSec' , 'class' => 'form-control gs-input', 'placeholder'=>'Sub Secuencia', 'style'=>'width:350px'))  !!}</td>--}}
                        {{--</tr>--}}
                        <tr>
            			<td  align="right" > {!! Form::label('first_name','Rubro :', array('class'=> 'gs-label'))!!}  </td>
                        <td>{!! Form::text('txCodRubro', null,array('ID'=>'txCodRubro', 'class' => 'form-control gs-input', 'placeholder'=>'Codigo', 'style'=>'width:55px')) !!}</td>
                        <td>{!! Form::text('txRubro', null, array('ID'=>'txRubro', 'class' => 'form-control gs-input', 'placeholder'=>'Rubro', 'style'=>'width:350px')) !!}</td>
            			</tr>
            			<tr>
                        <td  align="right" > {!! Form::label('first_name','Glosa :', array('class'=> 'gs-label'))!!}  </td>
                        <td colspan="2"> {!! Form::text('txGLosa', null, array('ID'=>'txGlosa', 'class' => 'form-control gs-input', 'placeholder'=>'Glosa', 'style'=>'width:409px')) !!}</td>
                        </tr>
                        <tr>
                         <td  align="right" > {!! Form::label('first_name','Lugar Entrega :', array('class'=> 'gs-label'))!!}  </td>
                         <td colspan="2" >{!! Form::text('txLugarEnt', null, array('ID'=>'txLugarEnt' ,'class' => 'form-control gs-input', 'placeholder'=>'Entrega', 'style'=>'width:409px')) !!}</td>
                        </tr>
                     </table>



                 </td>
                  <td width="40px">
                                  </td>
                 <td>

                         <table  class="gs-table" >
                         <tr>

                         <td colspan="3" align="right">
                         <br>
                         <label  id="txEtapa"  style="margin-top: 0px;border-radius: 3px; padding: 2px; border: 1px #ddd dashed; ; height: 25px; font-size: 15px; width:100px; font-weight: bold; text-align: center; margin-bottom: -4px"></label>
                         </td>
                         </tr>

                         <tr>


                        <td  align="right" > {!! Form::label('first_name','Solicitante :', array('class'=> 'gs-label'))!!}  </td>
                        <td>{!! Form::text('txDNI', null, array('ID'=>'txDNI','class' => 'form-control gs-input', 'placeholder'=>'DNI', 'style'=>'width:75px')) !!}</td>
                        <td>{!! Form::text('txSolicitante', null, array('ID'=>'txSolicitante', 'class' => 'form-control gs-input', 'placeholder'=>'Nombre', 'style'=>'width:345px')) !!}</td>
                        </tr><tr>
                        <td  align="right" > {!! Form::label('first_name','Condicion :', array('class'=> 'gs-label'))!!}  </td>
                        <td colspan="2">{!! Form::text('txCondicion', null, array('ID'=>'txCondicion', 'class' => 'form-control gs-input', 'placeholder'=>'Condicion', 'style'=>'width:424px')) !!}</td>
                        </tr><tr valign="top">

                         <td  align="right" > {!! Form::label('first_name','Observaciones :', array('class'=> 'gs-label'))!!}  </td>
                         <td colspan="2" >{!! Form::textarea('txObsv', null, array('ID'=>'txObsv', 'class' => 'form-control gs-input', 'placeholder'=>'Observaciones', 'style'=>'width:424px','rows'=>'7')) !!}</td>
                         </tr>
                      </table>
                 </td>
                 </tr>
                 <tr>
                 <td>
                     <table>
                     <tr>
                         <td><div id="txTipoGto"></div>{!! Form::label('first_name','Tipo Solicitante :', array('class'=> 'gs-label'))!!}</td>
                         <td width="10"></td>
                         <td><div class="radio"> <label><input type="radio" id="r1" name="optradio">Jefe de Area</label>  </div></td>
                         <td width="20"></td>
                         <td><div class="radio"> <label><input type="radio" id="r2" name="optradio">Residente</label>  </div></td>
                     </tr>
                     </table>
                 </td>
                 <td  align="right"> </td>
                 <td  align="left"> {!! Form::button('NUEVO ITEM '        ,['id'=>'btnLogItem' ,'class'=>'btn btn-primary','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:90px; ']) !!} </td>
                 </table>


</div>



</div>
</div>


<div class="panel panel-default" style="margin-top: -15px" >
<div class="panel-heading gs-panel-heading" > :::  Lista de Bienes o Servicios  </div>
<div id="dvBarraAdd" class="panel-heading gs-panel-heading" style="display: none;" >
     <table id="tbBarraBienes" style="height: 50px;" >

     </table>
</div>
<div class="panel-body" id="divProdBienes">


                 <table    id="tbProdBienes" class="suggest-element table table-striped gs-table-item gs-table-hover" style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px" width="100%">
                     <thead align="center">
                      <tr CLASS="gsTh">
                         <th WIDTH="0px" style="display: none" ></th>
                         <th WIDTH="55px"  align="center"   valign="center">Cant</th>
                         <th WIDTH="60px"  align="center"   valign="center">Unidad</th>
                         <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
                         <th WIDTH="600px" align="left"     valign="center">Descripcion</th>
                         
                         <th WIDTH="200px" align="left"     valign="center">Especificaciones</th>
                         <th WIDTH="100px" align="center"    valign="center">Precio   </th>
                         <th WIDTH="100px" align="right"    valign="center">Total</th>
                         <th valign="right" >Editar</th>
                         <th align="right">Borrar</th>
                      </tr>
                     </thead>
                     <tbody>
                              <tr class="fila-Hide">
                                     <td name="tdID"  style="display: none" >1</td>
                                     <td name="tdCant"  align="center" >2</td>
                                     <td name="tdUnd"  align="center"  >5</td>
                                     <td name="tdClasf" align="center" >3</td>
                                     <td name="tdProd"  align="left"   >4</td>
                                     
                                     <td name="tdEspf"  align="left"   >6</td>
                                     <td name="tdPrecio" align="center">7</td>
                                     <td name="tdTotal"  align="center">8</td>
                                     <td BGCOLOR="#d9edf7"><button id="btnLogItemEDIT" class="btn btn-warning editRow" style="width:   45Px  ;height: 25px ; padding=0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                                     <td BGCOLOR="#d9edf7" ><button id="btnLogItemDEL" class="btn btn-danger deleteRow" style="width: 30px  ;height: 25px ; padding=0; font-size:10px;  " type="button">X</button> </td>
                             </tr>
                </tbody>
                </table>


                </div>
                </div>

</div>

<div id = "REQ" opeID="NN" anioID = "NN" reqID="NN" reqEtapa="NN" reqUsr="NN" > </div>
<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div style="height: 56px"></div>

<div id="divDialog">
<div id="divDialogCont">

</div>
</div>



