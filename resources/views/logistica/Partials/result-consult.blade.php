<?php
if(isset($result))
{
?>

        <table    id="tbOC_Dll" doc ="Odc" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >


            <th WIDTH="55px"  align="center"   valign="center">REQUERIMIENTO</th>
            <th WIDTH="80px"  align="center"   valign="center">COTIZACION</th>
            <th WIDTH="80px"  align="center"   valign="center">CUADRO COMP</th>
            <th WIDTH="80px" align="left"     valign="center">Nº ORDEN</th>
           
            <th WIDTH="80px" align="left"     valign="center">REG SIAF</th>
            <th WIDTH="80px" align="left"     valign="center">COMPROMISO</th>
            <th WIDTH="80px" align="center"    valign="center">DEVENGADO </th>
            <th WIDTH="80px" align="right"    valign="center">GIRADO</th>

        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr style= "font-size:14px;  font-weight:bold;"  >
            <td name="tdCant"  align="center"   >{{  $nom->Req }}</td>
            <td name="tdClasf"  align="center"   >{{ $nom->Ctz }} </td>
            <td name="tdUnd"  align="center"  >{{ $nom->Cdr }} </td>

            <td name="tdProd"  align="center"   >{{ $nom->Cod }}  </td>           

            <td name="tdMarca"  align="center"   > {{  $nom->expExp }} </td>
            <td name="tdMarca"  align="center"   > {{  $nom->expComNum }} </td>
            <td name="tdPrecio" align="center"> {{  $nom->expDevNumDoc  }} </td>
            <td name="tdTotal"  align="center"> {{  $nom->expGirNumDoc  }} </td>
        </tr>


        <tr >
                    <td name="tdCant"  align="center" >{{  $nom->orcReqFecha }}</td>
                    <td name="tdClasf"  align="center" >{{ $nom->orcCtzFecha }} </td>
                    <td name="tdUnd"  align="center"  >{{ $nom->orcCdrFecha }} </td>
                    
                    @if ($nom->Tipo =='OC')
                     <td name="tdProd"  align="center"   >{{ $nom->orcFecha }}  </td>
                    @else                    
                    <td name="tdEspf"  align="center"   > {{  $nom->orsFecha  }} </td>
                    @endif
                    <td name="tdEspf"  align="center"   > {{  $nom->expComFecha }}  </td>
                    <td name="tdMarca"  align="center"   > {{  $nom->expComFecha }} </td>
                    <td name="tdPrecio" align="center"> {{  $nom->expDevFecha  }} </td>
                    <td name="tdTotal"  align="center"> {{  $nom->expGirFecha  }} </td>
         </tr>
         <tr >

                             <td colspan="9">-------------------------------------------------------------------------------------------------------------------</td>

                  </tr>
        @endforeach
        </tbody>

        </table>
<?php
}
?>