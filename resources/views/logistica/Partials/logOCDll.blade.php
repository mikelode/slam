<?php
if($Doc=="Odc")
{
?>
        <table    id="tbOC_Dll" doc ="Odc" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="55px"  align="center"   valign="center">SecFun</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="350px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="300px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" align="center"    valign="center">Precio </th>
			<th WIDTH="80px" align="center"    valign="center" >Envio </th>
            <th WIDTH="50px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdOcItm"  style="display: none" ocID="{{  $nom->dllOCID  }}"  >{{ $nom->dllOcItm }}</td>
            <td name="tdCdItm"  style="display: none"   >{{ $nom->dllCdItm }}</td>
            <td name="tdCzItm"  style="display: none"   >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>

            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdSecFun"  align="center" codID="{{  $nom->dllSecFunID  }}"  > {{  $nom->dllSecFunCod }} </td>
            <td name="tdClasf"  align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  align="center"   > {{  $nom->dllMarca }} </td>
            <td name="tdPrecio" align="center"> {{  $nom->dllPrecio  }} </td>
			<td name="tdEnvio" align="center"  > {{  $nom->dllEnvio  }} </td>
            <td name="tdTotal"  align="center"> {{  $nom->dllTotal  }} </td>
            <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7" ><button  id="btnLogOC_dllDEL" class="btn btn-default " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdOcItm"  style="display: none" ></td>
                    <td name="tdCdItm"  style="display: none" ></td>
                    <td name="tdCzItm"  style="display: none" ></td>
                    <td name="tdRqItm"  style="display: none" ></td>

                    <td name="tdCant"  align="center" ></td>
                    <td name="tdSecFun"  align="center"  >5</td>
                    <td name="tdClasf" style="display: none" align="center" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
					<td name="tdEnvio" align="center" style="display: none">8</td>
                    <td name="tdTotal"  align="center">9</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogOC_dllDEL" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>
        </table>
<?php
}

else if($Doc=="Cdr")
{
?>
        <table    id="tbOC_Dll"  doc ="Cdr" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="55px"  align="center"   valign="center">SecFun</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="350px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="300px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" align="center"    valign="center">Precio </th>
			<th WIDTH="80px" align="center"    valign="center">Envio</th>
            <th WIDTH="80px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            
            <td name="tdOcItm"  style="display: none"   >0</td>
            <td name="tdCdItm"  style="display: none"   >{{ $nom->dllCdItm }}</td>
            <td name="tdCzItm"  style="display: none"   >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>


            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdSecFun"  align="center" codID= "{{  $reqTmpID }}" >  <?php echo substr( $reqTmpID, -4)   ?> </td>
            <td name="tdClasf"  align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  align="center"   > {{  $nom->dllMarca  }} </td>
            <td name="tdPrecio" align="center">{{  $nom->dllPrecio  }}  </td>
			<td name="tdEnvio" align="center">0  </td>
            <td name="tdTotal"  align="center">{{  $nom->dllTotal }} </td>
            <td BGCOLOR="#d9edf7"><button  id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7"><button  id="btnLogOC_dllX" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdOcItm"  style="display: none" ></td>
                    <td name="tdCdItm"  style="display: none" ></td>
                    <td name="tdCzItm"  style="display: none" ></td>
                    <td name="tdRqItm"  style="display: none" ></td>

                    <td name="tdCant"  align="center" ></td>
                    <td name="tdSecFun"  align="center" ></td>
                    <td name="tdClasf"  align="center" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
					<td name="tdEnvio" align="center">8</td>
                    <td name="tdTotal"  align="center">9</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogOC_dllX" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>
        </table>
<?php
}


else if($Doc=="Req")
{
?>
        <table    id="tbOC_Dll" doc ="Req" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="55px"  align="center"   valign="center">SecFun</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="350px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="300px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" align="center"    valign="center">Precio </th>
            <th WIDTH="80px" align="center"    valign="center">Envio</th>
            <th WIDTH="80px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            
            <td name="tdOcItm"  style="display: none"   >0</td>
            <td name="tdCdItm"  style="display: none"   >0</td>
            <td name="tdCzItm"  style="display: none"   >0</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>


            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdSecFun"  align="center" codID= "{{  $reqTmpID }}" >  <?php echo substr( $reqTmpID, -4)   ?> </td>
            <td name="tdClasf"  align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  align="center"   >  </td>
            <td name="tdPrecio" align="center">0  </td>
            <td name="tdEnvio" align="center">0  </td>
            <td name="tdTotal"  align="center">0 </td>
            <td BGCOLOR="#d9edf7"><button  id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7"><button  id="btnLogOC_dllX" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdOcItm"  style="display: none" ></td>
                    <td name="tdCdItm"  style="display: none" ></td>
                    <td name="tdCzItm"  style="display: none" ></td>
                    <td name="tdRqItm"  style="display: none" ></td>

                    <td name="tdCant"  align="center" ></td>
                    <td name="tdSecFun"  align="center" >3</td>
                    <td name="tdClasf"  align="center" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
                    <td name="tdEnvio" align="center">8</td>
                    <td name="tdTotal"  align="center">9</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogOC_dllX" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>
        </table>
<?php
}

else if($Doc=="Null")
{
?>
        <table    id="tbOC_Dll" doc ="Null" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="55px"  align="center"   valign="center">SecFun</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="350px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="300px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" align="center"    valign="center">Precio </th>
            <th WIDTH="80px" align="center"    valign="center">Envio </th>
            <th WIDTH="80px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>

        <tbody
      
        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdOcItm"  style="display: none" ></td>
                    <td name="tdCdItm"  style="display: none" ></td>
                    <td name="tdCzItm"  style="display: none" ></td>
                    <td name="tdRqItm"  style="display: none" ></td>

                    <td name="tdCant"  align="center" ></td>
                    <td name="tdSecFun"  align="center" ></td>
                    <td name="tdClasf" align="center" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
                    <td name="tdEnvio" >0</td>
                    <td name="tdTotal"  align="center">9</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogOC_dllX" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>
        </table>
<?php
}




?>