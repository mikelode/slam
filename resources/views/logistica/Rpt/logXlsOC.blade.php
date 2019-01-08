
<?php
if ($Doc=="XLS")
{
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
    header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
    header('Pragma: no-cache');
    header('Expires: 0');
    header('Cache-Control: max-age=0');
    header('Content-Transfer-Encoding: none');
    header('Content-Type: application/vnd.ms-excel'); // This should work for IE & Opera
    header('Content-type: application/x-msexcel'); // This should work for the rest
    header('Content-Disposition: attachment; filename="rptGeneral.xls"');
  ?>
    <table >
    <tr style="height: 20px;background:#ffffff" >
            <td valign="center" COLSPAN="15" > <h4>REPORTE GENERAL DE ORDENES DE COMPRA</h4></td>        </tr>
    </table>
            <table  style="border-collapse: separate;border-spacing:0px;" class=" table table-striped gs-table-item gs-table-hover">
            <thead align="center">
            <tr CLASS="gsTh" style="background: #dedede;" >

                <th WIDTH="55px"  align="center"   valign="center">Cant</th>
                <th WIDTH="50px"  align="center"   valign="center">Anio</th>
                <th WIDTH="50px" align="center"    valign="center">Etapa</th>
                <th WIDTH="50px" align="center"    valign="center">TipoOrden</th>

                <th WIDTH="50px" align="left"     valign="center">Nro OC</th>
                <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
                <th WIDTH="50px" align="left"    valign="center">Glosa</th>

                <th WIDTH="50px"  align="center"   valign="center">IGV ?</th>      
                <th WIDTH="50px"  align="center"   valign="center">SubTotal</th>
                <th WIDTH="50px"  align="center"   valign="center">Envio</th>
                <th WIDTH="50px"  align="center"   valign="center">Descuento</th>
                <th WIDTH="50px"  align="center"   valign="center">Monto_IGV</th>      
                <th WIDTH="50px"  align="center"   valign="center">Total</th>     

               <!-- <th WIDTH="50px"  align="right"   valign="center">Nro_Req</th>-->
                <th WIDTH="50px" align="center"   valign="center">Dep</th>
                <th WIDTH="50px" align="left"     valign="center">DepDsc</th>
                <th WIDTH="50px" align="center"   valign="center">TipoProc</th>
                <th WIDTH="50px" align="left"     valign="center">TipoProcDsc  </th>

                <th WIDTH="50px" align="center"   valign="center">SecFun</th>
                <th width="50px" align="left"    valign="center">SecFunDsc</th>

                <th WIDTH="50px" align="center"    valign="center">Rubro</th>
                <th WIDTH="50px" align="left"    valign="center">RubroDsc</th>

                <th WIDTH="50px" align="center"    valign="center">Ruc</th>
                <th WIDTH="50px" align="left"    valign="center">RazonSocial</th>
                <th WIDTH="50px" align="left"    valign="center">LugarEntrega</th>

                <th WIDTH="100px" align="center"    valign="center">Gui_Nro</th>
                <th WIDTH="100px" align="center"    valign="center">Gui_Fecha</th>

                <th WIDTH="100px" align="center"    valign="center">Pcs_Nro</th>
                <th WIDTH="100px" align="center"    valign="center">Pcs_Fecha</th>

                <th WIDTH="50px" align="left"    valign="center">Referencia</th>




            </tr>
            </thead>
            <tbody>

            @foreach($result["OC"] as $key=>$nom)
            <tr style="height: 20px;" >
                   <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >{{ $nom->ocAnio}}</td>
                          <td  align="left" >{{ $nom->ocEtapa}}</td>
                          <td  align="left" >{{ $nom->TipoOrden}}</td>

                          <td   >{{ $nom->ocCodigo}}</td>
                          <td   >{{ $nom->ocFecha}}</td>
                          <td   >{{ $nom->ocGlosa}}</td>

                          <td   >{{ $nom->ocIGV}}</td>                          
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocSubTotal}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocEnvio}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocDescuento}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocTotalIGV}}</td>
                          <td   style="mso-number-format:'0.00' ; background:#d2d2d2;">{{ $nom->ocTotalSuper}}</td>

                          <td    style="mso-number-format:'@'">{{ $nom->ocDepCod}}</td>
                          <td   >{{ $nom->ocDepDsc}}</td>
                          <td   style="mso-number-format:'@'">{{ $nom->ocTipoProcCod}}</td>
                          <td   >{{ $nom->ocTipoProcDsc}}</td>

                          <td  style="mso-number-format:'@'" >{{ $nom->ocSecFunCod}}</td>
                          <td  >{{ $nom->ocSecFunDsc}}</td>
                          <td  style="mso-number-format:'@'"  >{{ $nom->ocRubroCod}}</td>
                          <td   >{{ $nom->ocRubroDsc}}</td>

                          <td   style="mso-number-format:'@'">{{ $nom->ocRUC}}</td>
                          <td   >{{ $nom->ocRazon}}</td>
                          <td   >{{ $nom->ocLugar}}</td>

                          <td   >{{ $nom->GUI_Nro}}</td>
                          <td   >{{ $nom->GUI_Fecha}}</td>

                          <td   >{{ $nom->PCS_Nro}}</td>
                          <td   >{{ $nom->PCS_Fecha}}</td>
                          <td   >{{ $nom->ocRef}}</td>


            </tr>
            @endforeach

            </tbody>
            </table>
 <?php
}
else
{
?>

 <div class="panel panel-default" style="margin-top: -10px; margin-bottom: -5px; padding: 2px; " >
  <table>
  <tr>
    <td><DIV style="background:#f2f2f2;width: 850px;padding:2px;border-radius:5px;"   >  <h4 style="">REPORTE GENERAL DE ORDENES DE COMPRA</h4>       </DIV> </td>
   <!--<td  align="left"> {!! Form::button('PDF (*.pdf)'        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:0px; ']) !!} </td>-->
    <td  align="left"> {!! Form::button('EXCEL (*.xls) '        ,['id'=>'btnLogRptXls' ,'class'=>'btn btn-primary','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:40px; ']) !!} </td>
    <td  align="left"> {!! Form::button('PDF (*.pdf) '        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:20px; ']) !!} </td>
                 
  </tr>
  </table>
</div>


 
            <table  style="border-spacing:0px; width: 2000px;" class="suggest-element table table-striped  gs-table-hover "  >
            <thead align="center">
            <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;" >

                <th  width="20px" align="center"   valign="center">Cant</th>
                <th  width="40px"align="center"   valign="center">Anio</th>
                <th  width="60px"    valign="center">Etapa</th>
                <th  width="40px" align="center"    valign="center">Tipo Orden</th>

                <th width="70px" align="left"     valign="center">Nro OC</th>
                <th width="60px" align="center"   valign="center">Fecha</th>
                <th width="300px" align="left"    valign="center">Glosa</th>

                <th WIDTH="50px"  align="center"   valign="center">IGV ?</th>      
                <th WIDTH="50px"  align="right"   valign="center">SubTotal</th>
                <th WIDTH="50px"  align="right"   valign="center">Envio</th>
                <th WIDTH="50px"  align="right"   valign="center">Descuento</th>
                <th WIDTH="50px"  align="right"   valign="center">Monto_IGV</th>      
                <th WIDTH="50px"  align="right"   valign="center">Total</th>                

                <th width="70px" align="right"   valign="center">Nro_Req</th>

                <th width="40px" align="center"   valign="center">Dep</th>
                <th width="50px" align="center"   valign="center">Tipo Proc</th>
                <th width="40px" align="center"   valign="center">SecFun</th>

                <th width="40px" align="center"    valign="center">Rubro</th>

                <th width="80px" align="center"    valign="center">Ruc</th>
                <th align="left"    valign="center">RazonSocial</th>

                <th align="center"    valign="center">Gui_Nro</th>
                <th align="center"    valign="center">Gui_Fecha</th>

                <th align="center"    valign="center">Pcs_Nro</th>
                <th align="center"    valign="center">Pcs_Fecha</th>

                <th align="left"    valign="center">Referencia</th>




            </tr>
            </thead>
            <tbody>

            @foreach($result["OC"] as $key=>$nom)
            <tr  >
                   <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >{{ $nom->ocAnio}}</td>
                          <td  align="left" >{{ $nom->ocEtapa}}</td>
                          <td  align="left" >{{ $nom->TipoOrden}}</td>

                          <td   >{{ $nom->ocCodigo}}</td>
                          <td   >{{ $nom->ocFecha}}</td>
                          <td   >{{ $nom->ocGlosa}}</td>

                          <td   >{{ $nom->ocIGV}}</td>                          
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocSubTotal}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocEnvio}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocDescuento}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocTotalIGV}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->ocTotalSuper}}</td>


                          <td   >{{ $nom->ocReqCod}}</td>

                          <td    style="mso-number-format:'@'">{{ $nom->ocDepCod}}</td>
                          <td   style="mso-number-format:'@'">{{ $nom->ocTipoProcCod}}</td>
                          <td  style="mso-number-format:'@'" >{{ $nom->ocSecFunCod}}</td>
                          <td  style="mso-number-format:'@'"  >{{ $nom->ocRubroCod}}</td>

                          <td   style="mso-number-format:'@'">{{ $nom->ocRUC}}</td>
                          <td   >{{ $nom->ocRazon}}</td>

                          <td   >{{ $nom->GUI_Nro}}</td>
                          <td   >{{ $nom->GUI_Fecha}}</td>

                          <td   >{{ $nom->PCS_Nro}}</td>
                          <td   >{{ $nom->PCS_Fecha}}</td>
                          <td   >{{ $nom->ocRef}}</td>


            </tr>
            @endforeach

            </tbody>
            </table>


<?php
}
?>
