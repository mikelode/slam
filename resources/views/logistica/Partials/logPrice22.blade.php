   <div class="modal fade"  id="modalPrice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="  overflow-x:scroll" >
   <div class="modal-dialog"  style="width: 1100px" >
   <div class="modal-content">
        <div class="modal-header" id = "divScroll">
         <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #338Bb7 ; COLOR:#ffffff;" >
         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> PRECIOS REFERENCIALES </span>
         </div></div>


           <table>
                       <tr>
                        <td > <span  style ="font-size: 10px;">TIPO DE BUSQUEDA :</span> </td>
                        <td WIDTH="5"> </td>
                       <td>
                                                  <div class="btn-group btn-input clearfix" >
                                                     <button type="button" id="btnReqSgBusq" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:200px; height: 40px;font-size: 12px;  ">    <span  id="txReqSgBuq"  data-bind="label">Seleccione...</span> <span class="caret"></span></button>
                                                     <ul class="dropdown-menu menu-ReqSgBusq" role="menu" style="font-size: 12px; ">
                                                        <li  psrId="RQ"><a href="#">NRO DE REQUERIMIENTO</a></li>
                                                        <li  psrId="DP"><a href="#">DEPENDENCIA</a></li>
                                                        <li  psrId="SF"><a href="#">SEC. FUNCIONAL</a></li>
                                                     </ul>
                                                  </div>
                       </td>
                       <td WIDTH="5"> </td>
                       <td >     <input id="txReqSgNro" class="form-control gs-input" style="width:80px;font-size: 18px;height: 40px; font-weight: bold; " />   </td>
                       <td WIDTH="3"> </td>
                       <td> {!! Form::button('BUSCAR',['class'=>'btn btn-info','id'=>'btnLogPriceSearch','placeholder'=>'Codigo','style'=>'font-size:11px; width:80px; height:40px; text-align:center;' ]) !!}  </td>

                        <td WIDTH="10"> </td>
                            <td > <span id="titleBusq" style ="font-size: 10px;font-weight: bold;"></span> </td>
                    </tr>




                  </table>

        <hr style="width: auto">



        <table    class="suggest-element table table-striped gs-table-item gs-table-hover " style=" margin-left: 0px;font-size:11px; padding:0px; margin-top:5px; padding-right: 0px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="15px"  align="center"   valign="center" >Item</th>
            <th WIDTH="300px"  align="left"   valign="center">Producto</th>
            <th WIDTH="50px"  align="center"   valign="center">Unidad</th>
            <th WIDTH="80px"  align="center"   valign="center">Marca</th>
            <th WIDTH="40px"  align="right"   valign="center">Cant</th>
            <th WIDTH="60px"  align="right"   valign="center">Precio Unt</th>
            <th WIDTH="60px"  align="right"   valign="center">Total</th>
            <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="80px"  align="center"   valign="center">Ruc</th>
            <th WIDTH="100px"  align="center"   valign="center">RSocial</th>


        </tr>
        </thead>
        <tbody id="TblBody">
        <?php if (isset($result["Dll"]))
        {?>
        <?php $i=1;?>
        @foreach($result["Dll"] as $key=>$nom)
        <tr style="height: 40px" >
            <td name="tdCant"  align="center" ><?php echo "0".$i++;?></td>

            <td  >{{  $nom->prodDsc }}</td>
            <td  align="center" >{{  $nom->Unidad}}</td>
            <td  align="center" >{{  $nom->Marca }}</td>
            <td  align="center" >{{  $nom->Cant}}</td>
            <td  >{{  $nom->Precio}}</td>
            <td  >{{  $nom->Total}}</td>
            <td  align="center" >{{  $nom->Fecha}}</td>
            <td  align="center" >{{  $nom->RUC}}</td>
            <td  align="left" >{{  $nom->RSocial}}</td>
        </tr>
        @endforeach
        <?php
        }
        ?>
        </tbody>
        </table>






        </div>


   </div>
   </div>
   </div>

