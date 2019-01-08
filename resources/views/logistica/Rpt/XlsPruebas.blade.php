<?php
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Transfer-Encoding: none');
header('Content-Type: application/vnd.ms-excel'); // This should work for IE & Opera
header('Content-type: application/x-msexcel'); // This should work for the rest
header('Content-Disposition: attachment; filename="nombre36333.xls"');
?>

        <table  >
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="600px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="60px"  align="center"   valign="center">Unidad</th>
            <th WIDTH="200px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="100px" align="center"    valign="center">Precio   </th>
            <th WIDTH="100px" align="right"    valign="center">Total</th>

        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td   >{{ $nom->dllOCID }}</td>
            <td    >{{ $nom->dllProdDsc }}</td>
            <td  ></td>
            <td   >{{ $nom->dllOCID }}</td>
            <td >{{ $nom->dllOCID }}</td>
            <td  >{{ $nom->dllOCID }}</td>
            <td  >{{ $nom->dllOCID }}</td>
            <td >{{ $nom->dllOCID }}</td>

        </tr>
        @endforeach

        </tbody>
        </table>