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
        <td valign="center" colspan="32"> <h4>REPORTE PROCESO DE TRAMITE DE REQUERIMIENTOS</h4></td>        </tr>
</table>

        <table  style="border-collapse: collapse;border-spacing:  0px;">
         <thead align="center">
                      <tr CLASS="gsTh" >
                          
                          <th WIDTH="5px"  align="center"   valign="center" >Item</th>
                          <th WIDTH="5px"  align="left"   valign="center">Tipo</th>
                          <th WIDTH="70px"  align="left"   valign="center">Req</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                          <th WIDTH="60px"  align="left"   valign="center">Monto Req.</th>

                          <th WIDTH="40px"  align="center"   valign="center">Usuario</th>
                          <th WIDTH="40px"  align="center"   valign="center">Estado</th>
                          <th WIDTH="20px"  align="center"   valign="center">Dep</th>
                          <th WIDTH="45px"  align="center"   valign="center">SecFun</th>
                        
                          <th WIDTH="60px"  align="left"   valign="center">Cotz</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

                          <th WIDTH="60px"  align="left"   valign="center">Cuad.C.</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

                          <th WIDTH="80px"  align="left"   valign="center">Ruc</th>
                          <th WIDTH="250px"  align="left"   valign="center">Razon</th>

                          <th WIDTH="60px"  align="center"   valign="center">Orden</th>
                          <th WIDTH="60px"  align="center"   valign="center">Fecha</th>
                    
                          <th WIDTH="60px"  align="left"   valign="center">Internamiento</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                    
                          <th WIDTH="60px"  align="left"   valign="center">Pecosa</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                      </tr>
          </thead>
          <tbody>

        @foreach($result["RQP"] as $key=>$nom)
        <tr style="height: 23px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >

            <td name="tdCant"  align="center" ><strong>{{ $key + 1 }}</strong></td>

            <td align="center" bgcolor="#f7f7f7">{{ $nom->Tipo }}</td>

            <td  align="center" bgcolor="#f7f7f7"  valign="center"> {{  $nom->NroReq }} </td>
            <td  align="center" bgcolor="#f7f7f7">{{  $nom->Fecha_Req }}</td>
            <td  align="center" bgcolor="#f7f7f7">{{ $nom->reqMonto }}</td>

            <td  align="center" >{{  $nom->Usr }}</td>
            <td  align="center" >{{  $nom->Estado }}</td>
            <td  align="center" >{{  $nom->NroDep }}</td>
            <td  align="center" >{{  $nom->NroSecFun }}</td>

            <td  align="center" >{{  $nom->NroCot }}</td>
            <td  align="center" >{{  $nom->Fecha_Cot }}</td>

            <td  align="center" bgcolor="#f7f7f7">{{  $nom->NroCC }}</td>
            <td  align="center" bgcolor="#f7f7f7">{{  $nom->Fecha_Adj }}</td>

            <td  align="left" >{{  $nom->Ruc }}</td>
            <td  align="left" >{{  $nom->RazonSocial }}</td>

            <td  align="center" > {{  $nom->ORDEN }} </td>
            <td  align="center" >{{  $nom->FECHA_ORDEN }}</td>

            <td  align="center" >{{  $nom->GUI_Nro }}</td>
            <td  align="center" >{{  $nom->GUI_Fecha }}</td>

            <td  align="center" >{{  $nom->PCS_Nro }}</td>
            <td  align="center" >{{  $nom->PCS_Fecha }}</td>
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
            <td><DIV style="background:#f2f2f2;width: 850px;padding:2px;border-radius:5px;"   >  <h4 style="">REPORTE PROCESO DE TRAMITE DE REQUERIMIENTOS</h4>       </DIV> </td>
        {{--<!--<td  align="left"> {!! Form::button('PDF (*.pdf)'        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:0px; ']) !!} </td>-->--}}
            <td  align="left"> {!! Form::button('EXCEL (*.xls) '        ,['id'=>'btnLogRptXls' ,'class'=>'btn btn-primary','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:40px; ']) !!} </td>
            <td  align="left"> {!! Form::button('PDF (*.pdf) '        ,['id'=>'btnLogRptPdf' ,'class'=>'btn btn-danger','style'=> 'width: 100Px  ;height: 35px ; padding=0; font-size:11px; margin-left:20px; ']) !!} </td>

        </tr>
    </table>
</div>

<table  style="border-spacing:0px; width: 4000px;" class="suggest-element table table-striped  gs-table-hover "  >
    <thead align="center">
    <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;" >

        <th WIDTH="5px"  align="center"   valign="center" >Item</th>
        <th WIDTH="5px"  align="center"   valign="center" >Tipo</th>
        <th WIDTH="70px"  align="left"   valign="center">Req</th>
        <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
        <th WIDTH="60px"  align="left"   valign="center">Monto Req.</th>

        <th WIDTH="40px"  align="center"   valign="center">Usuario</th>
        <th WIDTH="40px"  align="center"   valign="center">Estado</th>
        <th WIDTH="20px"  align="center"   valign="center">Dep</th>
        <th WIDTH="45px"  align="center"   valign="center">SecFun</th>

        <th WIDTH="60px"  align="left"   valign="center">Cotz</th>
        <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

        <th WIDTH="60px"  align="left"   valign="center">Cuad.C.</th>
        <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

        <th WIDTH="80px"  align="left"   valign="center">Ruc</th>
        <th WIDTH="250px"  align="left"   valign="center">Razon</th>

        <th WIDTH="60px"  align="center"   valign="center">Orden</th>
        <th WIDTH="60px"  align="center"   valign="center">Fecha</th>

        <th WIDTH="60px"  align="left"   valign="center">Internamiento</th>
        <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

        <th WIDTH="60px"  align="left"   valign="center">Pecosa</th>
        <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
    </tr>
    </thead>
    <tbody>

    @foreach($result["RQP"] as $key=>$nom)
        <tr style="height: 20px;" >
            <td name="tdCant"  align="center" ><strong>{{ $key + 1 }}</strong></td>
            <td align="center">{{ $nom->Tipo }}</td>
            <td  align="center" valign="center"> {{  $nom->NroReq }} </td>
            <td  align="center">{{  $nom->Fecha_Req }}</td>
            <td  align="center">{{ number_format($nom->reqMonto,2) }}</td>

            <td  align="center" >{{  $nom->Usr }}</td>
            <td  align="center" >{{  $nom->Estado }}</td>
            <td  align="center" >{{  $nom->NroDep }}</td>
            <td  align="center" >{{  $nom->NroSecFun }}</td>

            <td  align="center" >{{  $nom->NroCot }}</td>
            <td  align="center" >{{  $nom->Fecha_Cot }}</td>

            <td  align="center" bgcolor="#f7f7f7">{{  $nom->NroCC }}</td>
            <td  align="center" bgcolor="#f7f7f7">{{  $nom->Fecha_Adj }}</td>

            <td  align="left" >{{  $nom->Ruc }}</td>
            <td  align="left" >{{  $nom->RazonSocial }}</td>

            <td  align="center" > {{  $nom->ORDEN }} </td>
            <td  align="center" >{{  $nom->FECHA_ORDEN }}</td>

            <td  align="center" >{{  $nom->GUI_Nro }}</td>
            <td  align="center" >{{  $nom->GUI_Fecha }}</td>

            <td  align="center" >{{  $nom->PCS_Nro }}</td>
            <td  align="center" >{{  $nom->PCS_Fecha }}</td>


        </tr>
    @endforeach

    </tbody>
</table>

<?php
}
?>

