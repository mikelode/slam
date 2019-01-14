<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">




 <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 55px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 5px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/tabCdr.png" width="40px" height="40px" style="margin-right: 5px">
    </TD>
        <td ALIGN="RIGHT" width="250px">
        <span style="font-size: 16px; font-weight: bold;"> CUADRO COMPARATIVO :</span>
        </td>
        <td width="10"></td>
        <td> {!! Form::text('txAnio', 2016, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:55px; height:40px ; padding:6px;','id'=>'txAnio'  ))  !!}</td>

        <td>
                    <div class="input-group" >
                       <input id="txCCNo" type="text" class="form-control " placeholder="Nro de Cuadro"  style="width: 130px; height:40px;padding-top: 5px;font-weight:bold; font-size: 15px;">
                       <span class="input-group-btn btn-search ">
                              <button class="btn btn-primary" id="btnLogCCSearch">
                                    <span class="glyphicon glyphicon-search " aria-hidden="true" style="width: 30px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                              </button>
                       </span>
                    </div>

        </td>

        <td width="10px">
        </td>

        <td>
                        <button class="btn btn-primary" id="btnLogCCLeft">
                           <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                        </button>

        </td>

        <td>
                        <button class="btn btn-primary" id="btnLogCCRight">
                             <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="width: 20px; height:25px; margin-top: 5px; margin-bottom: -5px;"></span>
                        </button>
        </td>

       <td align="right" width="715px">

            {!! Form::button('GUARDAR',['class'=>'btn btn-default','id'=>'btnLogCCSave','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'GUARDAR','style'=>' margin-left:2px;font-weight: bold; padding-left:2px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconSAVE2.png) no-repeat; background-position:top;' ]) !!}
            {!! Form::button('CANCEL',['class'=>'btn btn-default','id'=>'btnLogCCCancel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CANCELAR','style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconCANCEL.png) no-repeat; background-position:top;' ]) !!}

            {!! Form::button('NUEVO',['class'=>'btn btn-default','id'=>'btnLogCCNew','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'NUEVO',       'style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconADD.png) no-repeat; background-position:top;' ]) !!}
            {!! Form::button('EDITAR',['class'=>'btn btn-default','id'=>'btnLogCCUpd','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'MODIFICAR',  'style'=>' margin-left:2px;font-weight: bold; padding-left:8px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconUPD.png) no-repeat; background-position:top;']) !!}
            {!! Form::button('ANULAR',['class'=>'btn btn-default','id'=>'btnLogCCDel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'ELIMINAR',   'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconDEL.png) no-repeat; background-position:top;' ]) !!}
            {!! Form::button('RESERVAR',['class'=>'btn btn-default','id'=>'btnLogCCBusy','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'RESERVAR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconBusy.png) no-repeat; background-position:top;' ]) !!}
            {!! Form::button('IMPRIMIR',['class'=>'btn btn-default','id'=>'btnLogCCPrint','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'IMPRIMIR','style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/iconPRINT.png) no-repeat; background-position:top;' ]) !!}
            {!! Form::button('CERRAR',['class'=>'btn btn-default btn-cerrar','id'=>'a','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'CERRAR',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconClose.png) no-repeat; background-position:top;' ]) !!}
           <!-- {!! Form::button('BORRAR',['class'=>'btn btn-default','id'=>'btnLogCCTrsh','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'TRASH',     'style'=>' margin-left:2px;font-weight: bold; padding-left:4px; ;padding-top:35px; font-size:9px;;width:50px; height:50px;background: url(img/iconTRASH.png) no-repeat; background-position:top;' ]) !!} -->
           <!-- {!! Form::button('RESERVA',['class'=>'btn btn-default','id'=>'btnLogCCBusy','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'RESERVAR','style'=>' margin-left:2px;font-weight: bold; padding-left:3px; ;padding-top:35px; font-size:9px;;width:50px; height:50px; background: url(img/Cancel2.png) no-repeat; background-position:top;' ]) !!} -->
        </td>
    </tr>
    </table>
</div>

<div class="panel-heading gs-panel-heading"  style=" border-radius: 5px; width: 1140px ;  height: 130px; border: 1px solid #ddd ; padding-top: 0px; margin-top: 0px ; margin-bottom:5px; background: #f9f9f9 ;   " >


               <table class="gs-table" style=" border-spacing:  0px;border-collapse: separate; ">
               <tr valign="top">
               <td>

                    <table  class="gs-table">
                        <tr>
                            <td align="right"> <label class="gs-label">Fecha :  </label></td>
                            <td align="left" colspan="2">  <input type="date" name="fecha" id="txFecha" class="form-control  gs-input" style="width: 130px; ">   </td>
                        </tr>

                         <tr>
                            <td align="right"> <label class="gs-label"> Origen Doc :  </label></td>
                            <td align="left" colspan="2">  
                                    <div class="btn-group btn-input clearfix" id="txCodTipoCdDoc">
                                    <button type="button" id="btnTipoCdDoc" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:130px; height: 30px;font-size: 11px;  ">    <span  id="txTipoCdDoc"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-TipoCdDoc" role="menu" style="font-size: 11px; ">
                                       <li  psrId="**"><a href="#">OTROS</a></li>
                                       <li  psrId="RQ"><a href="#">REQUERIMIENTO</a></li>
                                       <li  psrId="CZ"><a href="#">COTIZACION</a></li>
                                    </ul>
                                 </div>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"> <label class="gs-label">Nro Doc :  </label></td>
                            <td align="left" colspan="2">  <input type="text" placeholder='Numero Doc' id="txCC_CtzNo" class="form-control  gs-input" style="width: 130px; ">   </td>
                        </tr>
                        <tr valign="top">
                           <td  align="right" > {!! Form::label('first_name','Observaciones :', array('class'=> 'gs-label'))!!}  </td>
                           <td colspan="2" >{!! Form::textarea('txObsv', null, array('ID'=>'txObsv', 'class' => 'form-control gs-input', 'placeholder'=>'Observaciones', 'style'=>'width:534px','rows'=>'2')) !!}</td>
                        </tr>

                     </table>

                 </td>

                 <td width="10px"> .
                 </td>

                <td valign="bottom">
                  <table >
                  <tr  >
                     <td valign="top" height="80px">
                      <label  id="txEtapa"  style="margin-top: 0px;border-radius: 3px; padding: 2px; border: 1px #ddd dashed; ; height: 25px; font-size: 15px; width:100px; font-weight: bold; text-align: center; margin-bottom: -4px;"></label>

                    </td>
                  </tr>

                  <tr valign="bottom">
                     <td>

                        <button class="btn btn-danger" style="font-size: 10px;" id="btnLogCdrRucADD">
                            <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                            AGREGAR <BR> PROPUESTA
                        </button>
                    {{--{!! Form::button(' Catalogo de Bienes ' ,['id'=>'btnLogCdrCtgo' ,'class'=>'btn btn-primary','style'=> 'width: 110Px  ;height: 30px ; padding:0;margin-top:0px; font-size:10px; margin-left:5px; ']) !!} --}}
                    {!! Form::button(' Nuevo Bien '        ,['id'=>'btnLogCdrItem' ,'class'=>'btn btn-primary','style'=> 'width: 110Px  ;height: 30px ; padding:0;margin-top:0px; font-size:10px; margin-left:5px; ']) !!}
                    {!! Form::button(' Borrar Bienes '        ,['id'=>'btnLogCdrItemClear' ,'class'=>'btn btn-primary','style'=> 'width: 110Px  ;height: 30px ; padding:0;margin-top:0px; font-size:10px; margin-left:5px; ']) !!}
        

                   <!--   <div style="height: 33px">  </div>
                      <span id="btnLogCCRucADD" class="btn btn-primary" style="height: 40px; width: 120px; vert-align:auto;" > Añadir RUC</span>
                      -->
                     </td>
                  </tr>
                  </table>
                </td>
                 </tr>
                 </table>

</div>



</div>
</div>





<div class="panel panel-default" style="margin-top: -15px" >
<div class="panel-heading gs-panel-heading"  > :::  Lista de Bienes o Servicios     {!! Form::button(' <= Atras '        ,['id'=>'btnLogCdrRucBack' ,'class'=>'btn btn-default','style'=> 'width: 90Px  ;height: 30px ; padding=0;margin-top:-5px; font-size:10px; margin-left:890px; ']) !!} </div>
<div id="dvCdrBarraAdd" class="panel-heading gs-panel-heading" style="display: none;" >
     <table id="tbCdrBarraBienes" style="height: 50px;" >

     </table>
</div>

<div id="divCCDll"  class="panel-body" >  

                 <ul id = "myTab" class = "nav nav-tabs">
                    <li  id="liBns"   class = "active" >    <a   id="aBns"  href = "#tabBienesList" data-toggle = "tab">LISTA DE BIENES  </a>   </li>
                    <li  id="liRucAdd" >  <a id="aRucAdd" href = "#tabRucAdd" data-toggle = "tab"><STRONG>REGISTRO DEL PROVEEDOR: </STRONG>  </a>   </li>
                    <li  id="liRucList">  <a id="aRucList" href = "#tabRucList" data-toggle = "tab">PROPUESTAS  </a>   </li>
                    <li  id="liAdj" >     <a id="aAdj" href = "#tabAdj" data-toggle = "tab">PROVEEDOR ADJUDICADO</a></li>
                    <li  id="liRucBns" >     <a id="aRucBns" href = "#tabRucBns" data-toggle = "tab">Lista de Bienes</a></li>
                 </ul>
                 <div id = "myTabContent" class = "tab-content">

                 <div class = "tab-pane fade in active" id = "tabBienesList">
                            <table    id="tbCdr_Dll" class="suggest-element table table-striped table-hover" style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
                               <thead align="center">
                               <tr CLASS="gsTh" >
                                    <th WIDTH="0px" style="display: none" ></th>
                                    <th WIDTH="0px" style="display: none" ></th>
                                    <th WIDTH="0px" style="display: none" ></th>
                                    <th WIDTH="55px"  align="center"   valign="center">Cant</th>
                                     <th WIDTH="60px"  align="center"   valign="center">Unidad</th>
                                    <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
                                    <th WIDTH="600px" align="left"     valign="center">Descripcion</th>                                   
                                    <th WIDTH="200px" align="left"     valign="center">Especificaciones</th>                     
                                    <th valign="right" >Editar</th>
                                    <th align="right">Borrar</th>
                               </tr>
                               </thead>
                               <tbody>
                               <tfoot>
                                <tr class="fila-Hide">
                                <td name="tdCdItm" style="display: none" > 0 </td> ';
                                <td name="tdCzItm" style="display: none" > 0 </td> ';
                                <td name="tdRqItm" style="display: none" > 0</td> ';
                                <td name="tdCant"  > </td> ';
                                <td name="tdUnd"   > </td>';
                                <td name="tdClasf" > </td> ';
                                <td name="tdProd"  > </td>';
                                <td name="tdEspf"  > </td>';
                                <td> <button class="btn btn-primary btnCdrRowEDIT" style="width: 70Px  ;height: 35px ; padding:0; margin-left:5px; font-size:11px;  " type="button">EDIT</button> </td>';
                                <td> <button   class="btn btn-primary btnCdrRowDEL" style="width: 30px  ;height: 35px ; padding:0 ; margin-left:5px; font-size:10px;  " type="button"> X </button> </td>';
    
                                 </tr>
                               </tfoot>

                              
                     </tbody>
                     </table>
                 </div>

                 <div class = "tab-pane fade" id = "tabRucAdd"  >

                    

                 </div>

                <div class = "tab-pane fade" id = "tabRucBns"  >

                    

                </div>

                 <div class = "tab-pane fade" id = "tabRucList">
                 </div>

                 <div class = "tab-pane fade" id = "tabAdj">

                    <div style="margin: 20px;">
                    <table class="table table-condensed" id="tbCC_Adjudicacion" style="font-size: 13px;">
                        <tr>
                            <td align="center" colspan="3"><strong>DATOS DE ADJUDICACION DE LA BUENA PRO </strong></td>
                        </tr>
                    <tr> <td> RUC  </td>              <td  ALIGN="CENTER"> : </td> <td style="font-weight: bold; font-size: 14px;"  id="tbAdjRuc" > </td> </tr>
                    <tr> <td> Razon Social  </td>     <td  ALIGN="CENTER"> : </td> <td id="tbAdjRSocial" > - </td> </tr>
                    <tr> <td> Monto  </td>            <td  ALIGN="CENTER"> : </td> <td id="tbAdjMonto"> - </td> </tr>
                    <tr> <td> Plazo de Entrega</td>   <td  ALIGN="CENTER"> : </td> <td id="tbAdjPlazo" >  <input  id="txAdjPlazo" style="width: 900px;" class="form-control  gs-input"  value="" > </td> </td> </tr>
                    <tr> <td> Justificacion  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjJust" > <input id="txAdjJustf"  class="form-control  gs-input" width="900px" value="" > </td>   </td> </tr>
                    <tr> <td> Plazo de Ejecucion  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjEje" > <input id="txAdjEje"  class="form-control  gs-input" width="900px" value="" > </td>   </td> </tr>
                    <tr> <td> Lugar Entrega  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjLugarEnt" > <input id="txAdjLugarEnt"  class="form-control  gs-input" width="900px" value="" > <br></td>   </td> </tr>
                    <tr> <td> Garantia  </td>         <td ALIGN="CENTER"> : </td> <td id="tbAdjGarantia" >   </td> </tr>

                    <tr> <td colspan="3" id="tbAdjIGV" > =========== === ================= </td> </tr>
                    </table>
                    </div>

                 </div>


              </div>
</div>

</div>

</div>

<div    id="CDR" opeID="NN"  cdrID="NN"  orgID="NN"   anioID="NN" fteID="NN" cdrEtapa="NN" > </div>
<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div style="height: 0px"></div>

<div id="divDialog">
<div id="divDialogCont"></div>
</div>





<script>




// $( document ).on( 'keydown' ,'#txProdMarca ',function(e) {
// if(e.keyCode == 39  ||   e.keyCode == 13 ) {
//    $( "#txProdPrecio" ).focus();
// }
// });
//
//
//
// $( document ).on( 'keydown' ,'#txProdPrecio ',function(e) {
// if(e.keyCode == 13 ) {
//    $( "#btnLogCC_ItemSave" ).click();
//
// }
//
// });



</script>