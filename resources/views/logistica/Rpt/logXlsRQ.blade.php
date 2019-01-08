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

<table>
<tr style="height: 20px;background:#c0c0dd" >
        <td valign="center" colspan="24"> <h4>REPORTE GENERAL DE REQUERIMIENTOS</h4></td>        </tr>
</table>

        <table  style="border-collapse: separate;border-spacing:  3px;">
        <thead align="center">
        <tr CLASS="gsTh" style="background: #c0c0ff;" >

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="80px"  align="center"   valign="center">Anio</th>
            <th WIDTH="100px" align="center"    valign="center">Etapa</th>
            <th WIDTH="100px" align="center"    valign="center">TipoOrden</th>

            <th WIDTH="100px" align="left"     valign="center">Req_No</th>
            <th WIDTH="80px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="90px" align="left"    valign="center">Glosa</th>
            <th WIDTH="150px"  align="right"   valign="center">Monto</th>

            <th WIDTH="150px"  align="center"   valign="center">DNI</th>
            <th WIDTH="150px"  align="left"   valign="center">Solicitante</th>
            <th WIDTH="150px"  align="left"   valign="center">Condicion</th>

            <th WIDTH="80px" align="center"    valign="center">Dep</th>
            <th WIDTH="200px" align="left"    valign="center">DepDsc</th>

            <th WIDTH="100px" align="center"    valign="center">SecFun</th>
            <th WIDTH="500px" align="left"    valign="center">SecFunDsc</th>

            <th WIDTH="100px" align="center"    valign="center">Rubro</th>
            <th WIDTH="100px" align="left"    valign="center">RubroDsc</th>
            <th WIDTH="100px" align="left"    valign="center">LugarEntrega</th>
        </tr>
        </thead>
        <tbody>

        @foreach($result["RQ"] as $key=>$nom)
        <tr style="height: 20px;" >
               <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
               <td   >{{ $nom->reqAnio}}</td>
               <td   >{{ $nom->reqEtapa}}</td>
               <td   >{{ $nom->reqTipoReqDsc}}</td>

               <td   >{{ $nom->reqCodigo}}</td>
               <td style="mso-number-format:'@'"  >{{ $nom->reqFecha}}</td>
               <td   >{{ $nom->reqGlosa}}</td>
               <td style="mso-number-format:'0.00'"  >{{$nom->reqMonto}}</td>
               <td style="mso-number-format:'@'"  >{{ $nom->reqSolID}}</td>
               <td   >{{ $nom->reqSolDsc}}</td>
               <td   >{{ $nom->reqSolCond}}</td>

               <td  style="mso-number-format:'@'" >{{ $nom->reqDepCod}}</td>
               <td   >{{ $nom->reqDepDsc}}</td>

               <td  style="mso-number-format:'@'" >{{ $nom->reqSecFunCod}}</td>
               <td   >{{ $nom->reqSecFunDsc}}</td>

               <td  style="mso-number-format:'@'" >{{ $nom->reqRubroCod}}</td>
               <td   >{{ $nom->reqRubroDsc}}</td>
                <td   >{{ $nom->reqLugarEnt}}</td>


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
    <td><DIV style="background:#f2f2f2;width: 850px;padding:2px;border-radius:5px;"   >  <h4 style="">REPORTE GENERAL DE DE REQUERIMIENTOS</h4>       </DIV> </td>
   <!--<td  align="left"> {!! Form::button('PDF (*.pdf)'        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:0px; ']) !!} </td>-->
    <td  align="left"> {!! Form::button('EXCEL (*.xls) '        ,['id'=>'btnLogRptXls' ,'class'=>'btn btn-primary','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:40px; ']) !!} </td>
    <td  align="left"> {!! Form::button('PDF (*.pdf) '        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:20px; ']) !!} </td>
                 
  </tr>
  </table>
</div>

  <table  style="border-spacing:0px; width: 4000px;" class="suggest-element table table-striped  gs-table-hover "  >
            <thead align="center">
            <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;" >

            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="80px"  align="center"   valign="center">Anio</th>
            <th WIDTH="100px" align="center"    valign="center">Etapa</th>
            <th WIDTH="100px" align="center"    valign="center">TipoOrden</th>

            <th WIDTH="100px" align="left"     valign="center">Req_No</th>
            <th WIDTH="80px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="90px" align="left"    valign="center">Glosa</th>
            <th WIDTH="150px"  align="right"   valign="center">Monto</th>

            <th WIDTH="150px"  align="center"   valign="center">DNI</th>
            <th WIDTH="150px"  align="left"   valign="center">Solicitante</th>
            <th WIDTH="150px"  align="left"   valign="center">Condicion</th>

            <th WIDTH="80px" align="center"    valign="center">Dep</th>
            <th WIDTH="200px" align="left"    valign="center">DepDsc</th>

            <th WIDTH="100px" align="center"    valign="center">SecFun</th>
            <th WIDTH="500px" align="left"    valign="center">SecFunDsc</th>

            <th WIDTH="100px" align="center"    valign="center">Rubro</th>
            <th WIDTH="100px" align="left"    valign="center">RubroDsc</th>
            <th WIDTH="100px" align="left"    valign="center">LugarEntrega</th>
        </tr>
        </thead>
        <tbody>

        @foreach($result["RQ"] as $key=>$nom)
        <tr style="height: 20px;" >
               <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
               <td   >{{ $nom->reqAnio}}</td>
               <td   >{{ $nom->reqEtapa}}</td>
               <td   >{{ $nom->reqTipoReqDsc}}</td>

               <td   >{{ $nom->reqCodigo}}</td>
               <td style="mso-number-format:'@'"  >{{ $nom->reqFecha}}</td>
               <td   >{{ $nom->reqGlosa}}</td>
                <td style="mso-number-format:'0.00'"  >{{$nom->reqMonto}}</td>
               <td style="mso-number-format:'@'"  >{{ $nom->reqSolID}}</td>
               <td   >{{ $nom->reqSolDsc}}</td>
               <td   >{{ $nom->reqSolCond}}</td>

               <td  style="mso-number-format:'@'" >{{ $nom->reqDepCod}}</td>
               <td   >{{ $nom->reqDepDsc}}</td>

               <td  style="mso-number-format:'@'" >{{ $nom->reqSecFunCod}}</td>
               <td   >{{ $nom->reqSecFunDsc}}</td>

               <td  style="mso-number-format:'@'" >{{ $nom->reqRubroCod}}</td>
               <td   >{{ $nom->reqRubroDsc}}</td>
                <td   >{{ $nom->reqLugarEnt}}</td>


        </tr>
        @endforeach

        </tbody>
        </table>

<?php
}
?>
