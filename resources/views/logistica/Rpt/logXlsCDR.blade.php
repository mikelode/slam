
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
            <td valign="center" COLSPAN="15" > <h4>REPORTE GENERAL DE CUADROS COMPARATIVOS </h4></td>        </tr>
    </table>
            <table  style="border-collapse: separate;border-spacing:0px;" class=" table table-striped gs-table-item gs-table-hover">
            <thead align="center">
            <tr CLASS="gsTh" style="background: #dedede;" >

                <th WIDTH="55px"  align="center"   valign="center">Cant</th>
                <th WIDTH="50px"  align="center"   valign="center">Anio</th>
                <th WIDTH="50px" align="center"    valign="center">Etapa</th>                
                <th WIDTH="50px" align="left"     valign="center">TipoReq </th>
                <th WIDTH="50px" align="left"     valign="center">Nro CDR</th>
                <th WIDTH="50px"  align="center"   valign="center">Fecha</th>

                <th WIDTH="50px" align="center"    valign="center">Ruc</th>
                <th WIDTH="50px" align="left"    valign="center">RazonSocial</th>
              <th WIDTH="50px"  align="right"   valign="center">Monto</th>
                <th WIDTH="50px"  align="center"   valign="center">Justificacion</th>

                
                <th WIDTH="50px"  align="right"   valign="center">Nro_Req</th>
                <th WIDTH="50px"  align="right"   valign="center">Nro_Cotz</th>
                <th WIDTH="50px" align="left"    valign="center">GLosa</th>

                 <th WIDTH="50px" align="center"   valign="center">DNI</th>
                <th width="50px" align="left"    valign="center">Solicitante</th>

                <th WIDTH="50px" align="center"   valign="center">Dep</th>
                <th WIDTH="50px" align="left"     valign="center">DepDsc</th>                
                

                <th WIDTH="50px" align="center"   valign="center">SecFun</th>
                <th width="50px" align="left"    valign="center">SecFunDsc</th>

                <th WIDTH="50px" align="center"    valign="center">Rubro</th>
                <th WIDTH="50px" align="left"    valign="center">RubroDsc</th>
                <th WIDTH="50px" align="left"    valign="center">Motivo</th>

              


            </tr>
            </thead>
            <tbody>

            @foreach($result["CDR"] as $key=>$nom)
            <tr style="height: 23px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >
                   <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >{{ $nom->cdrAnio}}</td>
                          <td  align="left" >{{ $nom->cdrEtapa}}</td>
                          
                          <td   >{{ $nom->cdrTipoReqDsc}}</td>
                          <td   >{{ $nom->cdrCodigo}}</td>                         
                          <td   >{{ $nom->cdrFecha}}</td>                                                
                          
                          <td   style="mso-number-format:'@'">{{ $nom->Ruc}}</td>
                          <td   >{{ $nom->Razon}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->cdrMonto}}</td>
                          <td   >{{ $nom->cdrJustf}}</td>    
                         
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
                          <td   >{{ $nom->cdrMotivo}}</td>

                          


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
    <td><DIV style="background:#f2f2f2;width: 850px;padding:2px;border-radius:5px;"   >  <h4 style="">REPORTE GENERAL DE CUADRO COMPARATIVO</h4>       </DIV> </td>
   <!--<td  align="left"> {!! Form::button('PDF (*.pdf)'        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:0px; ']) !!} </td>-->
    <td  align="left"> {!! Form::button('EXCEL (*.xls) '        ,['id'=>'btnLogRptXls' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:160px; ']) !!} </td>
                 
  </tr>
  </table>
</div>

            <table  style="border-spacing:0px; width: 4000px;" class="suggest-element table table-striped  gs-table-hover "  >
            <thead align="center">
            <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;" >

                   <th WIDTH="15px"  align="center"   valign="center">Nº</th>
                <th WIDTH="20px"  align="center"   valign="center">Anio</th>
                <th WIDTH="50px" align="center"    valign="center">Etapa</th>                
                <th WIDTH="50px" align="left"     valign="center">TipoReq </th>
                <th WIDTH="70px" align="left"     valign="center">Nro CDR</th>
                <th WIDTH="50px"  align="center"   valign="center">Fecha</th>
               
              


                <th WIDTH="50px" align="center"    valign="center">Ruc</th>
                <th WIDTH="50px" align="left"    valign="center">RazonSocial</th>
                  <th WIDTH="50px"  align="right"   valign="center">Monto</th>

                 <th WIDTH="400px"  align="center"   valign="center">Justificacion</th>
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





            </tr>
            </thead>
            <tbody>

            @foreach($result["CDR"] as $key=>$nom)
            <tr  >
                <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >{{ $nom->cdrAnio}}</td>
                          <td  align="left" >{{ $nom->cdrEtapa}}</td>
                          
                          <td   >{{ $nom->cdrTipoReqDsc}}</td>
                          <td   >{{ $nom->cdrCodigo}}</td>
                          <td   >{{ $nom->cdrFecha}}</td>   

                          <td   style="mso-number-format:'@'">{{ $nom->Ruc}}</td>
                          <td   >{{ $nom->Razon}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->cdrMonto}}</td>
                          <td   >{{ $nom->cdrJustf}}</td> 
                          
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



            </tr>
            @endforeach

            </tbody>
            </table>


<?php
}
?>
