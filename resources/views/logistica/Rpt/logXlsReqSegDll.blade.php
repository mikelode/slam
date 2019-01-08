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
        <table    id="tbProdBienes" class=" table  table-hover  table-border" style="font-size:12px; padding:0px; margin-top:5px; line-height:8px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px" >
        <thead align="center">
        <tr CLASS="gsTh"  style="height: 30px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse; background:#ccc;"   >
             <th WIDTH="80px"  align="center"   valign="center">Item</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            
            
            <th WIDTH="60px"  align="center"   valign="center">Abrv</th>
            <th WIDTH="60px"  align="center"   valign="center">Unidad</th>
            <th WIDTH="600px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="200px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="100px" align="center"    valign="center">Precio   </th>
            <th WIDTH="100px" align="right"    valign="center">Total</th>
            
        </tr>
        </thead>
        <tbody>
       <?php  $i=1; ?>
        @foreach($result as $key=>$nom)
        <tr   style="height: 35px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse; font-size:13px;" valign="center"  >
            
            <td name="tdItem" align="center"  > <strong> <?php  echo $i++;?></strong> </td>
            <td name="tdClasf" align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            
            
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndDsc }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }} </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdPrecio" align="center"  style="mso-number-format:'0.00'" >  <?php  echo floatval( $nom->dllPrecio ) ;?>  </td>
            <td name="tdTotal"  align="center"  style="mso-number-format:'0.00'" >  <?php  echo floatval( $nom->dllTotal ) ;?>   </td>
            </tr>
        
        @endforeach
      
        </tbody>
        </table>

 <?php


?>
       