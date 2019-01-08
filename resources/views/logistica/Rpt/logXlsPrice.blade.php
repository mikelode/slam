
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
    header('Content-Disposition: attachment; filename="rptPrecioUnt.xls"');
  ?>
    <table >
    <tr style="height: 20px;background:#ffffff" >
            <td valign="center" COLSPAN="15" > <h4>REPORTE GENERAL DE PRECIOS UNITARIOS</h4></td>        </tr>
    </table>
            <table  style="border-collapse: separate;border-spacing:0px;" class=" table table-striped gs-table-item gs-table-hover">
            <thead align="center">
            <tr CLASS="gsTh" style="background: #dedede;" >

                <th WIDTH="55px"  align="center"   valign="center">Cant</th>
             
                <th WIDTH="50px" align="center"    valign="center">Fecha</th>
                <th WIDTH="50px" align="center"    valign="center">Doc</th>
                <th WIDTH="50px" align="left"    valign="center">Ruc</th>
                <th WIDTH="50px" align="left"    valign="center">Razon</th>
                <th WIDTH="50px" align="left"    valign="center">Producto </th>               

                <th WIDTH="50px" align="left"     valign="center">Especificaciones</th>
                <th WIDTH="50px"  align="center"   valign="center">Unidad</th>
               
                <th WIDTH="50px"  align="right"   valign="center">Cantidad</th>
                <th WIDTH="50px"  align="right"   valign="center">Precio</th>
                <th WIDTH="50px"  align="right"   valign="center">Total</th>
                <th WIDTH="50px" align="center"   valign="center">Marca</th>
               

            </tr>
            </thead>
            <tbody>

             @foreach($result["Seace"] as $key=>$nom)
            <tr style="height: 23px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >  
            
                   <td   style="mso-number-format:'@'" align="center" >{{$key+1}}</td>
                          <td   >{{ $nom->Fecha}}</td>
                          <td  style="mso-number-format:'@'" >{{ $nom->Codigo}}</td>
                          <td  style="mso-number-format:'@'" >{{ $nom->RUC}}</td>
                          <td   >{{ $nom->Razon}}</td>    
                          <td   >{{ $nom->Producto}}</td>      
                          <td   >{{ $nom->Especificaciones}}</td>
                          <td   >{{ $nom->Unidad}}</td>                          
                          <td   style="mso-number-format:'0.00'">{{ $nom->Cantidad}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->PrecioUnt}}</td>
                          <td   style="mso-number-format:'0.00'">{{ $nom->Total}}</td>
                          <td   >{{ $nom->Marca}}</td>    

            </tr>
            @endforeach

            </tbody>
            </table>
