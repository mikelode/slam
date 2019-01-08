
<?php

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
    <tr style="height: 20px;background:#ffffff" >  <td valign="center" COLSPAN="15" > <h4>REPORTE GENERAL DE ORDENES</h4></td>        </tr>
    </table>

            <table  style="border-collapse: separate;border-spacing:0px;" class=" table table-striped gs-table-item gs-table-hover">
            <thead align="center">
            <tr CLASS="gsTh" style="background: #dedede;" >

                <th WIDTH="55px"  align="center"   valign="center">Cant</th>
                <th WIDTH="50px"  align="center"   valign="center">Anio</th>
                <th WIDTH="50px" align="center"    valign="center">Nro_Orden</th>
                <th WIDTH="50px" align="center"    valign="center">Estado</th>

                <th WIDTH="50px" align="left"     valign="center">Ruc</th>
                <th WIDTH="50px"  align="center"   valign="center">RazonSocial</th>
                <th WIDTH="50px" align="left"    valign="center">Fecha_Orden</th>
                <th WIDTH="50px" align="left"    valign="center">Monto_Orden</th>

                <th WIDTH="50px"  align="right"   valign="center">Expediente_SIAF</th>
                <th WIDTH="50px"  align="right"   valign="center">Compromiso_Fecha</th>
                <th WIDTH="50px"  align="right"   valign="center">Compromiso_Monto</th>
                

                <th WIDTH="50px" align="center"   valign="center">Codigo_Proceso</th>
                <th WIDTH="50px" align="left"     valign="center">Tipo_Proceso</th>
          
                <th WIDTH="50px" align="center"   valign="center">Glosa</th>
                <th width="50px" align="left"    valign="center">Codigo_Dep</th>
                <th WIDTH="50px" align="center"    valign="center">Dependencia</th>

            </tr>
            </thead>
            <tbody>

            @foreach($result["Seace"] as $key=>$nom)
            <tr style="height: 20px;" >
                   <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td  align="center" >2016</td>
                          <td  align="left" >{{ $nom->Codigo}}</td>
                          <td  align="left" >{{ $nom->Etapa}}</td>

                          <td  style="mso-number-format:'@'" >{{ $nom->RUC}}</td>
                          <td   >{{ $nom->Razon}}</td>
                          <td   >{{ $nom->Fecha}}</td>                          
                          <td   style="mso-number-format:'0.00'">0</td>
                          
                          <td   >{{ $nom->expExp}}</td>
                          <td   >{{ $nom->expComFecha}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->expComMonto}}</td>

                          <td    style="mso-number-format:'@'">{{ $nom->TipoProcCod}}</td>
                          <td   >{{ $nom->TipoProcDsc}}</td>

                                                   
                          <td   >{{ $nom->Glosa}}</td>
                          <td    style="mso-number-format:'@'">{{ $nom->DepCod}}</td>
                          <td   >{{ $nom->DepDsc}}</td>

            </tr>
            @endforeach

            </tbody>
            </table>
