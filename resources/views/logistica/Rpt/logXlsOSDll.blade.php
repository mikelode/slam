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
header('Content-Disposition: attachment; filename="rptDetallado.xls"');
?>

<table>
<tr style="height: 20px;background:#c0c0dd" >
        <td valign="center" COLSPAN="15" > <h4>REPORTE DETALLADO DE ORDENES DE SERVICIO</h4></td>        </tr>
</table>
        <table  style="border-collapse: separate;border-spacing:  3px;">
        <thead align="center">
        <tr CLASS="gsTh" style="background: #c0c0ff;" >

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="50px"  align="center"   valign="center">Anio</th>
            <th WIDTH="50px" align="center"    valign="center">Etapa</th>
             <th WIDTH="50px" align="center"    valign="center">TipoOrden</th>

            <th WIDTH="50px" align="left"     valign="center">Nro OS</th>
            <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="50px" align="left"    valign="center">Glosa</th>
            <th WIDTH="50px"  align="right"   valign="center">Monto</th>
            <th WIDTH="50px"  align="right"   valign="center">Nro_Req</th>

            <th WIDTH="50px" align="center"    valign="center">Dep</th>
            <th WIDTH="50px" align="left"    valign="center">DepDsc</th>
            <th WIDTH="50px" align="center"     valign="center">TipoProc</th>
            <th WIDTH="50px" align="left"    valign="center">TipoProcDsc  </th>

             <th WIDTH="50px" align="center"    valign="center">SecFun</th>
             <th WIDTH="50px" align="left"    valign="center">SecFunDsc</th>
            <th WIDTH="50px" align="center"    valign="center">Rubro</th>
            <th WIDTH="50px" align="left"    valign="center">RubroDsc</th>

            <th WIDTH="50px" align="center"    valign="center">Ruc</th>
            <th WIDTH="50px" align="left"    valign="center">RazonSocial</th>
            <th WIDTH="50px" align="left"    valign="center">LugarEntrega</th>
            <th WIDTH="50px" align="left"    valign="center">Referencia</th>

            <th WIDTH="50px" align="left"    valign="center">Clasificador</th>
            <th WIDTH="50px" align="left"    valign="center">Descripcion</th>
            <th WIDTH="50px" align="left"    valign="center">Especificaciones</th>
            <th WIDTH="50px" align="left"    valign="center">UndAbrv</th>

            <th WIDTH="50px" align="left"    valign="center">UndDsc</th>
            <th WIDTH="50px" align="left"    valign="center">Marca</th>
            <th WIDTH="50px" align="left"    valign="center">Cant</th>
            <th WIDTH="50px" align="left"    valign="center">PrecioUnt</th>


        </tr>
        </thead>
        <tbody>

        @foreach($result["OS"] as $key=>$nom)
        <tr style="height: 20px;" >

                <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                     <td  align="center" >{{ $nom->osAnio}}</td>
                     <td  align="left" >{{ $nom->osEtapa}}</td>
                     <td  align="left" >{{ $nom->TipoOrden}}</td>
                     <td   >{{ $nom->osCodigo}}</td>
                     <td   >{{ $nom->osFecha}}</td>
                     <td   >{{ $nom->osGlosa}}</td>
                     <td  WIDTH="150px" style="mso-number-format:'0.00'">{{ $nom->osMonto}}</td>
                     <td   >{{ $nom->osReqCod}}</td>
                     <td    style="mso-number-format:'@'">{{ $nom->osDepCod}}</td>
                     <td   >{{ $nom->osDepDsc}}</td>

                     <td   style="mso-number-format:'@'">{{ $nom->osTipoProcCod}}</td>
                     <td   >{{ $nom->osTipoProcDsc}}</td>

                     <td  style="mso-number-format:'@'" >{{ $nom->osSecFunCod}}</td>
                     <td  >{{ $nom->osSecFunDsc}}</td>

                     <td  style="mso-number-format:'@'"  >{{ $nom->osRubroCod}}</td>
                     <td   >{{ $nom->osRubroDsc}}</td>

                     <td   style="mso-number-format:'@'">{{ $nom->osRUC}}</td>
                     <td   >{{ $nom->osRazon}}</td>
                     <td   >{{ $nom->osLugar}}</td>

                     <td   >{{ $nom->osRef}}</td>

                      <td   >{{ $nom->dllClasfCod}}</td>
                      <td   >{{ $nom->dllProdDsc}}</td>
                      <td   >{{ $nom->dllProdEspf}}</td>
                      <td   >{{ $nom->dllUndAbrv}}</td>

                      <td   >{{ $nom->dllUndDsc}}</td>
                      <td   >{{ $nom->dllMarca}}</td>
                      <td  style="mso-number-format:'0.00'">{{ $nom->dllCant}}</td>
                      <td  style="mso-number-format:'0.00'">{{ $nom->dllPrecioUnt}}</td>

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
    <td><DIV style="background:#f2f2f2;width: 850px;padding:2px;border-radius:5px;"   >  <h4 style="">REPORTE DETALLADO DE ORDENES SERVICIO</h4>       </DIV> </td>
   <!--<td  align="left"> {!! Form::button('PDF (*.pdf)'        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:0px; ']) !!} </td>-->
    <td  align="left"> {!! Form::button('EXCEL (*.xls) '        ,['id'=>'btnLogRptXls' ,'class'=>'btn btn-primary','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:40px; ']) !!} </td>
    <td  align="left"> {!! Form::button('PDF (*.pdf) '        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:20px; ']) !!} </td>
                 
  </tr>
  </table>
</div>

        <table  style="border-collapse: separate;border-spacing:  3px;">
        <thead align="center">
        <tr CLASS="gsTh" style="background: #c0c0ff;" >

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="50px"  align="center"   valign="center">Anio</th>
            <th WIDTH="50px" align="center"    valign="center">Etapa</th>
             <th WIDTH="50px" align="center"    valign="center">TipoOrden</th>

            <th WIDTH="50px" align="left"     valign="center">Nro OS</th>
            <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="50px" align="left"    valign="center">Glosa</th>
            <th WIDTH="50px"  align="right"   valign="center">Monto</th>
            <th WIDTH="50px"  align="right"   valign="center">Nro_Req</th>

            <th WIDTH="50px" align="center"    valign="center">Dep</th>
            <th WIDTH="50px" align="left"    valign="center">DepDsc</th>
            <th WIDTH="50px" align="center"     valign="center">TipoProc</th>
            <th WIDTH="50px" align="left"    valign="center">TipoProcDsc  </th>

             <th WIDTH="50px" align="center"    valign="center">SecFun</th>
             <th WIDTH="50px" align="left"    valign="center">SecFunDsc</th>
            <th WIDTH="50px" align="center"    valign="center">Rubro</th>
            <th WIDTH="50px" align="left"    valign="center">RubroDsc</th>

            <th WIDTH="50px" align="center"    valign="center">Ruc</th>
            <th WIDTH="50px" align="left"    valign="center">RazonSocial</th>
            <th WIDTH="50px" align="left"    valign="center">LugarEntrega</th>
            <th WIDTH="50px" align="left"    valign="center">Referencia</th>

            <th WIDTH="50px" align="left"    valign="center">Clasificador</th>
            <th WIDTH="50px" align="left"    valign="center">Descripcion</th>
            <th WIDTH="50px" align="left"    valign="center">Especificaciones</th>
            <th WIDTH="50px" align="left"    valign="center">UndAbrv</th>

            <th WIDTH="50px" align="left"    valign="center">UndDsc</th>
            <th WIDTH="50px" align="left"    valign="center">Marca</th>
            <th WIDTH="50px" align="left"    valign="center">Cant</th>
            <th WIDTH="50px" align="left"    valign="center">PrecioUnt</th>


        </tr>
        </thead>
        <tbody>

        @foreach($result["OS"] as $key=>$nom)
        <tr style="height: 20px;" >

                <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                                     <td  align="center" >{{ $nom->osAnio}}</td>
                                     <td  align="left" >{{ $nom->osEtapa}}</td>
                                    <td  align="left" >{{ $nom->TipoOrden}}</td>
                                     <td   >{{ $nom->osCodigo}}</td>
                                     <td   >{{ $nom->osFecha}}</td>
                                     <td   >{{ $nom->osGlosa}}</td>
                                     <td  WIDTH="150px" style="mso-number-format:'0.00'">{{ $nom->osMonto}}</td>
                                     <td   >{{ $nom->osReqCod}}</td>
                                     <td    style="mso-number-format:'@'">{{ $nom->osDepCod}}</td>
                                     <td   >{{ $nom->osDepDsc}}</td>

                                     <td   style="mso-number-format:'@'">{{ $nom->osTipoProcCod}}</td>
                                     <td   >{{ $nom->osTipoProcDsc}}</td>

                                     <td  style="mso-number-format:'@'" >{{ $nom->osSecFunCod}}</td>
                                     <td  >{{ $nom->osSecFunDsc}}</td>

                                     <td  style="mso-number-format:'@'"  >{{ $nom->osRubroCod}}</td>
                                     <td   >{{ $nom->osRubroDsc}}</td>

                                     <td   style="mso-number-format:'@'">{{ $nom->osRUC}}</td>
                                     <td   >{{ $nom->osRazon}}</td>
                                     <td   >{{ $nom->osLugar}}</td>


                                     <td   >{{ $nom->osRef}}</td>

                      <td   >{{ $nom->dllClasfCod}}</td>
                      <td   >{{ $nom->dllProdDsc}}</td>
                      <td   >{{ $nom->dllProdEspf}}</td>
                      <td   >{{ $nom->dllUndAbrv}}</td>

                      <td   >{{ $nom->dllUndDsc}}</td>
                      <td   >{{ $nom->dllMarca}}</td>
                      <td  style="mso-number-format:'0.00'">{{ $nom->dllCant}}</td>
                      <td  style="mso-number-format:'0.00'">{{ $nom->dllPrecioUnt}}</td>

        </tr>
        @endforeach

        </tbody>
        </table>

<?php
}
?>