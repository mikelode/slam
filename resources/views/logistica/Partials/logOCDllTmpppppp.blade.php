<?php
if(isset($result))
{
?>
        <table    id="tbOC_Dll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="350px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="300px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" align="center"    valign="center">Precio </th>
			<th WIDTH="80px" align="center"    valign="center" style="display: none">Envio </th>
            <th WIDTH="80px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdID"  style="display: none" ocID="{{  $nom->dllOCID  }}"  >{{ $nom->dllID }}</td>
            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdClasf"  align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  align="center"   > {{  $nom->dllMarca }} </td>
            <td name="tdPrecio" align="center"> {{  $nom->dllPrecio  }} </td>
			<td name="tdEnvio" align="center" style="display: none" > {{  $nom->dllEnvio  }} </td>
            <td name="tdTotal"  align="center"> {{  $nom->dllTotal  }} </td>
            <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7" ><button  id="btnLogOC_dllDEL" class="btn btn-default " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
          <tr class="fila-Hide">
                    <td name="tdID"  style="display: none" ></td>
                    <td name="tdCant"  align="center" ></td>
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

        </tbody>
        </table>
<?php
}

else
{
?>
        <table    id="tbCC_Bienes" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
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

        @foreach($req as $key=>$nom)
        <tr >
            <td name="tdID"  style="display: none" reqID="{{  $nom->dllReqCod  }}"  >{{ $nom->dllID }}</td>
            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdClasf"  align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  align="center"   >  </td>
            <td name="tdPrecio" align="center">0  </td>
			<td name="tdEnvio" align="center">0  </td>
            <td name="tdTotal"  align="center">0 </td>
            <td BGCOLOR="#d9edf7"><button id="btnLogReq_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7" ><button  id="btnLogReq_dllDEL" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
          <tr class="fila-Hide">
                    <td name="tdID"  style="display: none" ></td>
                    <td name="tdCant"  align="center" ></td>
                    <td name="tdClasf"  align="center" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
					<td name="tdEnvio" align="center">8</td>
                    <td name="tdTotal"  align="center">9</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogReq_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogReq_dllDEL" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tbody>
        </table>
<?php
}
?>