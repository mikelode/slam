   <div class="modal fade"  id="modalReqSg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
   <div class="modal-dialog"  style="width: 1300px" >
   <div class="modal-content" >
        <div class="modal-header" >
         <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #338Bb7 ; COLOR:#ffffff;" >
         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> SEGUIMIENTO DE DOCUMENTOS </span>
         </div></div>


           <table style="margin-top:-15px;" >
                       <tr>
                        <td > <span  style ="font-size: 10px;">TIPO DE BUSQUEDA :</span> </td>
                        <td WIDTH="5"> </td>
                       <td>
                                                  <div class="btn-group btn-input clearfix" >
                                                     <button type="button" id="btnReqSgBusq" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:200px; height: 40px;font-size: 12px;  ">    <span  id="txReqSgBuq"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                     <ul class="dropdown-menu menu-ReqSgBusq" role="menu" style="font-size: 12px; ">
                                                        <li  psrId="RQ"><a href="#">NRO DE REQUERIMIENTO</a></li>
                                                        <li psrId="CZ"><a href="#">COTIZACION</a></li>
                                                        <li  psrId="DP"><a href="#">DEPENDENCIA</a></li>
                                                        <li  psrId="SF"><a href="#">SEC. FUNCIONAL</a></li>
                                                     </ul>
                                                  </div>
                       </td>
                       <td WIDTH="5"> </td>
                       <td >     <input id="txReqSgNro" class="form-control gs-input autoFindReq" style="width:130px;font-size: 18px;height: 40px; font-weight: bold; " />   </td>
                       <td WIDTH="3"> </td>
                       <td> {!! Form::button('BUSCAR',['class'=>'btn btn-primary','id'=>'btnLogReqSgSearch','placeholder'=>'Codigo','style'=>'font-size:11px; width:90px; height:40px; text-align:center;' ]) !!}  </td>

                        <td WIDTH="10"> </td>
                            <td > <span id="titleBusq" style ="font-size: 10px;font-weight: bold;"></span> </td>
                       <td> {!! Form::button('EXCEL (*.xls)',['class'=>'btn btn-danger','id'=>'btnLogReqSgExcel','placeholder'=>'Codigo','style'=>'font-size:11px; width:100px; height:40px; text-align:center;margin-left:600px' ]) !!}  </td>
                    </tr>




                  </table>

        <hr style="width: auto;margin:2px; " >

    <br>
    
  <div style="overflow: scroll;    height: 550px; ">  
  <div style=" width: 2800px;">


      <ul id = "myTab" class = "nav nav-tabs">
      <li class = "active liRucList" id="liRucList">    <a href = "#tabRucList" data-toggle = "tab">RESULTADO DE LA BUSQUEDA  </a>   </li>
      <li><a id="liAdj" href = "#tabAdj" data-toggle = "tab">DETALLES</a></li>
      </ul>    
      <div id = "myTabContent" class = "tab-content">
            <div class = "tab-pane fade in active" id = "tabRucList">

                      <table     class=" table table-striped gs-table-item gs-table-hover " style=" margin-left: 0px;font-size:11px; padding:0px; margin-top:0px; padding-right: 0px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px"    >
                      <thead align="center">
                      <tr CLASS="gsTh" >
                          
                          <th WIDTH="10px"  align="center"   valign="center" >Item</th>
                          <th WIDTH="70px"  align="left"   valign="center">Req</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                          <th WIDTH="60px"  align="left"   valign="center">Monto</th>
                    
                          <th WIDTH="40px"  align="center"   valign="center">Usuario</th>
                          <th WIDTH="40px"  align="center"   valign="center">Estado</th>
                          <th WIDTH="20px"  align="center"   valign="center">Dep</th>
                          <th WIDTH="45px"  align="center"   valign="center">SecFun</th>
                        
                          <th WIDTH="60px"  align="left"   valign="center">Cotz</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

                          <th WIDTH="60px"  align="left"   valign="center">Cuad.C.</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

                          <th WIDTH="80px"  align="left"   valign="center">Ruc</th>
                          <th WIDTH="250px"  align="left"   valign="center">Razon</th>

                          <th WIDTH="60px"  align="center"   valign="center">Nro_OC</th>
                          <th WIDTH="60px"  align="center"   valign="center">Fecha_OC</th>

                          <th WIDTH="60px"  align="center"   valign="center">Nro_OS</th>
                          <th WIDTH="60px"  align="center"   valign="center">Fecha_OS</th>
                    
                          <th WIDTH="60px"  align="left"   valign="center">Internamiento</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                    
                          <th WIDTH="60px"  align="left"   valign="center">Pecosa</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                    
                          <th WIDTH="70px"  align="left"   valign="center">Expediente SIAF</th>
                          <th WIDTH="70px"  align="left"   valign="center">Compromiso Documento</th>
                          <th WIDTH="70px"  align="left"   valign="center">Compromiso Fecha</th>
                          <th WIDTH="70px"  align="left"   valign="center">Compromiso Monto</th>
                    
                          <th WIDTH="70px"  align="left"   valign="center">Devengado Documento</th>
                          <th WIDTH="70px"  align="left"   valign="center">Devengado Fecha</th>            
                          <th WIDTH="70px"  align="left"   valign="center">Devengado Monto</th>            
                    
                          <th WIDTH="70px"  align="left"   valign="center">Girado Nro ComPago</th>
                          <th WIDTH="70px"  align="left"   valign="center">Girado Fecha</th>
                          <th WIDTH="70px"  align="left"   valign="center">Girado Monto</th>
                      </tr>
                      </thead>
                      <tbody id="TblBodyReqSeg">

                      </tbody>
                      </table>

            </div>

            <div class = "tab-pane fade" id = "tabAdj">

            <div id="lbLogReqSegDllTitle" codID="">
            </div>
                  <div style=" width: 1000px;"id="divReqSegDll">
   
                  </div>
                 
            </div>
      </div>


 </div>
 </div>


</div>
</div>
</div>
</div>

    <!--
    <div style="overflow-x:hidden; overflow-y:scroll;  height: 130px; ">
  
      
    </div>
   -->
