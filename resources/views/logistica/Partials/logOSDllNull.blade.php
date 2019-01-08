<?php
if(isset($result))
{
?>
        <table    id="tbOS_Dll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
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
            <th WIDTH="80px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

      
          <tr class="fila-Hide">
                    <td name="tdID"  style="display: none" ></td>
                    <td name="tdCant"  align="center" ></td>
                    <td name="tdClasf" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
                    <td name="tdTotal"  align="center">8</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogOS_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogOS_dllDEL" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
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
            <th WIDTH="80px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

      
          <tr class="fila-Hide">
                    <td name="tdID"  style="display: none" ></td>
                    <td name="tdCant"  align="center" ></td>
                    <td name="tdClasf" align="center" >3</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center">6</td>
                    <td name="tdPrecio" align="center">7</td>
                    <td name="tdTotal"  align="center">8</td>
                    <td BGCOLOR="#d9edf7"><button id="btnLogOSReq_dllEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnLogOSReq_dllDEL" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tbody>
        </table>
<?php
}

?>