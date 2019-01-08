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



    

  <h4 style="">REPORTE DETALLADO DE CUADRO COMPARATIVO</h4>    

            <table  style="border-spacing:0px; width: 3500px;" class="suggest-element table table-striped  gs-table-hover "  >
            <thead align="center">
            <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;" >

              <th WIDTH="15px"  align="center"   valign="center">Nº</th>
                <th WIDTH="20px"  align="center"   valign="center">Anio</th>
                <th WIDTH="50px" align="center"    valign="center">Etapa</th>                
                <th WIDTH="50px" align="left"     valign="center">TipoReq </th>
                <th WIDTH="75px" align="left"     valign="center">Nro CDR</th>
                <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
               
              


                <th WIDTH="50px" align="center"    valign="center">Ruc</th>
                <th WIDTH="250px" align="left"    valign="center">RazonSocial</th>
                  

                
                <th WIDTH="60px"  align="right"   valign="center">Nro_Req</th>
                <th WIDTH="50px"  align="right"   valign="center">Nro_Cotz</th>
                <th WIDTH="200px" align="left"    valign="center">GLosa</th>

                 <th WIDTH="50px" align="center"   valign="center">DNI</th>
                <th width="200px" align="left"    valign="center">Solicitante</th>

                <th WIDTH="50px" align="center"   valign="center">Dep</th>
                <th WIDTH="250px" align="left"     valign="center">DepDsc</th>                
                

                <th WIDTH="50px" align="center"   valign="center">SecFun</th>
                <th width="800px" align="left"    valign="center">SecFunDsc</th>

                <th WIDTH="50px" align="center"    valign="center">Rubro</th>
                <th WIDTH="500px" align="left"    valign="center">RubroDsc</th>


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

        @foreach($result["CDR"] as $key=>$nom)
        <tr style="height: 20px;" >
                          <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >{{ $nom->cdrAnio}}</td>
                          <td  align="left" >{{ $nom->cdrEtapa}}</td>
                          
                          <td   >{{ $nom->cdrTipoReqDsc}}</td>
                          <td   >{{ $nom->cdrCodigo}}</td>
                          <td   >{{ $nom->cdrFecha}}</td>   

                          <td   style="mso-number-format:'@'">{{ $nom->Ruc}}</td>
                          <td   >{{ $nom->Razon}}</td>
                      
                          
                          <td   >{{ $nom->cdrReq}}</td>
                          <td   >{{ $nom->cdrCtzCod}}</td>
                          <td   >{{ $nom->cdrGlosa}}</td>

                           <td    style="mso-number-format:'@'">{{ $nom->cdrSolID}}</td>
                          <td   >{{ $nom->cdrSolDsc}}</td>

                          <td    style="mso-number-format:'@'">{{ $nom->cdrDepCod}}</td>
                          <td   >{{ $nom->cdrDepDsc}}</td>

                        

                          <td  style="mso-number-format:'@'" >{{ $nom->cdrSecFunCod}}</td>
                          <td  >{{ $nom->cdrSecFunDsc}}</td>

                          <td  style="mso-number-format:'@'"  >{{ $nom->cdrRubroCod}}</td>
                          <td   >{{ $nom->cdrRubroDsc}}</td>

                        <td   >{{ $nom->dllClasfCod}}</td>
                        <td   >{{ $nom->dllProdDsc}}</td>
                        <td   >{{ $nom->dllProdDsc}}</td>
                        <td   >{{ $nom->dllUndAbrv}}</td>

                        <td   >{{ $nom->dllUndDsc}}</td>
                        <td   >{{ $nom->dllMarca}}</td>
                        <td  style="mso-number-format:'0.00'">{{ $nom->dllCant}}</td>
                        <td  style="mso-number-format:'0.00'">{{ $nom->dllPrecio}}</td>

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
  <td><DIV style="background:#f2f2f2;width: 850px;padding:2px;border-radius:5px;"   >  <h4 style="">REPORTE DETALLADO DE CUADRO COMPARATIVO</h4>       </DIV> </td>
 <!--<td  align="left"> {!! Form::button('PDF (*.pdf)'        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:0px; ']) !!} </td>-->
  <td  align="left"> {!! Form::button('EXCEL (*.xls) '        ,['id'=>'btnLogRptXls' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:160px; ']) !!} </td>
               
</tr>
</table>

</div>


            <table  style="border-spacing:0px; width: 3500px;" class="suggest-element table table-striped  gs-table-hover "  >
            <thead align="center">
            <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;" >

              <th WIDTH="15px"  align="center"   valign="center">Nº</th>
                <th WIDTH="20px"  align="center"   valign="center">Anio</th>
                <th WIDTH="50px" align="center"    valign="center">Etapa</th>                
                <th WIDTH="50px" align="left"     valign="center">TipoReq </th>
                <th WIDTH="75px" align="left"     valign="center">Nro CDR</th>
                <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
               
              


                <th WIDTH="50px" align="center"    valign="center">Ruc</th>
                <th WIDTH="250px" align="left"    valign="center">RazonSocial</th>
                  

                
                <th WIDTH="60px"  align="right"   valign="center">Nro_Req</th>
                <th WIDTH="50px"  align="right"   valign="center">Nro_Cotz</th>
                <th WIDTH="200px" align="left"    valign="center">GLosa</th>

                 <th WIDTH="50px" align="center"   valign="center">DNI</th>
                <th width="200px" align="left"    valign="center">Solicitante</th>

                <th WIDTH="50px" align="center"   valign="center">Dep</th>
                <th WIDTH="250px" align="left"     valign="center">DepDsc</th>                
                

                <th WIDTH="50px" align="center"   valign="center">SecFun</th>
                <th width="800px" align="left"    valign="center">SecFunDsc</th>

                <th WIDTH="50px" align="center"    valign="center">Rubro</th>
                <th WIDTH="500px" align="left"    valign="center">RubroDsc</th>


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

        @foreach($result["CDR"] as $key=>$nom)
        <tr style="height: 20px;" >
                          <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >{{ $nom->cdrAnio}}</td>
                          <td  align="left" >{{ $nom->cdrEtapa}}</td>
                          
                          <td   >{{ $nom->cdrTipoReqDsc}}</td>
                          <td   >{{ $nom->cdrCodigo}}</td>
                          <td   >{{ $nom->cdrFecha}}</td>   

                          <td   style="mso-number-format:'@'">{{ $nom->Ruc}}</td>
                          <td   >{{ $nom->Razon}}</td>
                      
                          
                          <td   >{{ $nom->cdrReq}}</td>
                          <td   >{{ $nom->cdrCtzCod}}</td>
                          <td   >{{ $nom->cdrGlosa}}</td>

                           <td    style="mso-number-format:'@'">{{ $nom->cdrSolID}}</td>
                          <td   >{{ $nom->cdrSolDsc}}</td>

                          <td    style="mso-number-format:'@'">{{ $nom->cdrDepCod}}</td>
                          <td   >{{ $nom->cdrDepDsc}}</td>

                        

                          <td  style="mso-number-format:'@'" >{{ $nom->cdrSecFunCod}}</td>
                          <td  >{{ $nom->cdrSecFunDsc}}</td>

                          <td  style="mso-number-format:'@'"  >{{ $nom->cdrRubroCod}}</td>
                          <td   >{{ $nom->cdrRubroDsc}}</td>

                        <td   >{{ $nom->dllClasfCod}}</td>
                        <td   >{{ $nom->dllProdDsc}}</td>
                        <td   >{{ $nom->dllProdDsc}}</td>
                        <td   >{{ $nom->dllUndAbrv}}</td>

                        <td   >{{ $nom->dllUndDsc}}</td>
                        <td   >{{ $nom->dllMarca}}</td>
                        <td  style="mso-number-format:'0.00'">{{ $nom->dllCant}}</td>
                        <td  style="mso-number-format:'0.00'">{{ $nom->dllPrecio}}</td>

        </tr>
        @endforeach

        </tbody>
        </table>

<?php
}
?>
