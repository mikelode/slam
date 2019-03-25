
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
    header('Content-Disposition: attachment; filename="rptRanking.xls"');
  ?>
  
    <table >
     <tr  style="height: 10px;background:#f6f6f6" >            
     <td valign="center" COLSPAN="7" > <h5>{{ config('slam.APP_ENTIDAD')}}</h5></td>
     </tr>  

     <tr  style="height: 15px;background:#f6f6f6" >            
     <td valign="center" COLSPAN="7" > <h4>REPORTE RANKING DE PROVEEDORES</h4></td>
     </tr>

    </table>
<table  style="border-collapse: separate;border-spacing:0px;" class=" table table-striped gs-table-item gs-table-hover">
    <thead>
    <tr CLASS="gsTh" style="background: #dedede;" >

        <th align="center"   valign="center">RUC</th>
        <th align="center"    valign="center">DOCUMENTO</th>
        <th align="center"    valign="center">FECHA</th>
        <th align="center"    valign="center">GLOSA</th>
        <th align="center"    valign="center">PROCESO</th>
        <th align="center"    valign="center">SECUENCIA FUNCIONAL</th>
        <th align="center"    valign="center">MONTO</th>
    </tr>
    </thead>
    @foreach($result as $key => $item)
        <thead align="center">
        <tr CLASS="gsTh" style="background: #dedede;" >

            <th align="center"   valign="center">{{ $item[0]->rucID }}</th>
            <th align="center"    valign="center">{{ $item[0]->rucTipo }}</th>
            <th colspan="4" WIDTH="300px" align="center"    valign="center">{{ $item[0]->rucDsc }}</th>
            <th align="center"    valign="center" style="mso-number-format:'0.00'">{{ $item[0]->rucMonto }}</th>

        </tr>
        </thead>
        <tbody>

        @foreach($item as $i=>$orden)
            <tr style="height: 28px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >
                <td></td>
                <td   style="mso-number-format:'@'" align="center" >{{ substr($orden->rucDoc,0,2) . '-' . substr($orden->rucDoc,-5) }}</td>
                <td  align="left" style="mso-number-format:'@'" >{{ $orden->rucDocfecha}}</td>
                <td  align="left" >{{ $orden->rucGlosa }}</td>
                <td  align="left">{{ $orden->rucProcesodsc }}</td>
                <td  align="left">{{ $orden->rucSfdsc }}</td>
                <td  style="mso-number-format:'0.00'">{{ $orden->rucDocmonto }}</td>
            </tr>
        @endforeach

        </tbody>
    @endforeach
</table>
