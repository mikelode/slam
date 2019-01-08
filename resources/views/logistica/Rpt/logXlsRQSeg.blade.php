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
header('Content-Disposition: attachment; filename="rptSeguimiento.xls"');
?>

<table>
<tr style="height: 20px;background:#c0c0dd" >
        <td valign="center" colspan="32"> <h4>REPORTE GENERAL DE REQUERIMIENTOS</h4></td>        </tr>
</table>

        <table  style="border-collapse: collapse;border-spacing:  0px;">
         <thead align="center">
                      <tr CLASS="gsTh" >
                          
                          <th WIDTH="10px"  align="center"   valign="center" >Item</th>
                          <th WIDTH="70px"  align="left"   valign="center">Req</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                          <th WIDTH="60px"  align="left"   valign="center">Monto</th>
                    
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

                          <th WIDTH="60px"  align="center"   valign="center">Nro_OC</th>
                          <th WIDTH="60px"  align="center"   valign="center">Fecha_OC</th>

                          <th WIDTH="60px"  align="center"   valign="center">Nro_OS</th>
                          <th WIDTH="60px"  align="center"   valign="center">Fecha_OS</th>
                    
                          <th WIDTH="60px"  align="left"   valign="center">Internamiento</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                    
                          <th WIDTH="60px"  align="left"   valign="center">Pecosa</th>
                          <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
                    
                          <th WIDTH="70px"  align="left"   valign="center">Expediente SIAF</th>
                          <th WIDTH="70px"  align="left"   valign="center">Compromiso Documento</th>
                          <th WIDTH="70px"  align="left"   valign="center">Compromiso Fecha</th>
                          <th WIDTH="70px"  align="left"   valign="center">Compromiso Monto</th>
                    
                          <th WIDTH="70px"  align="left"   valign="center">Devengado Documento</th>
                          <th WIDTH="70px"  align="left"   valign="center">Devengado Fecha</th>            
                          <th WIDTH="70px"  align="left"   valign="center">Devengado Monto</th>            
                    
                          <th WIDTH="70px"  align="left"   valign="center">Girado Nro ComPago</th>
                          <th WIDTH="70px"  align="left"   valign="center">Girado Fecha</th>
                          <th WIDTH="70px"  align="left"   valign="center">Girado Monto</th>
                      </tr>
          </thead>
          <tbody>


        <?php if (isset($result["Dll"]))
        {?>
        <?php $i=1;?>
        @foreach($result["Dll"] as $key=>$nom)
        <tr style="height: 23px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >            
            
            <td name="tdCant"  align="center" ><strong><?php echo "0".$i++;?></strong></td>
      
            <td  align="center" bgcolor="#f7f7f7"  valign="center"> {{  $nom->NroReq }} </td>
            <td  align="center" bgcolor="#f7f7f7">{{  $nom->Fecha_Req }}</td>
            <td  align="center" bgcolor="#f7f7f7">{{  $nom->reqMonto }}</td>

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

            <td  align="center" > {{  $nom->NroOC }} </td>
            <td  align="center" >{{  $nom->Fecha_OC }}</td>

            <td  align="center" > {{  $nom->NroOS }}</td>
            <td  align="center" >{{  $nom->Fecha_OS }}</td>
      
            <td  align="center" >{{  $nom->GUI_Nro }}</td>
            <td  align="center" >{{  $nom->GUI_Fecha }}</td>
            
            <td  align="center" >{{  $nom->PCS_Nro }}</td>
            <td  align="center" >{{  $nom->PCS_Fecha }}</td>
            
            <td  align="center" >{{$nom->expExp}}</td>            
            <td  align="center" > {{$nom->expComNumDoc}}</td>
            <td  align="center" >{{$nom->expComFecha}}</td>
            <td  align="center"  style="mso-number-format:'0.00'" > <?php  echo floatval( $nom->expComMonto ) ;?>  </td>
            
            <td  align="center" >{{$nom->expDevNumDoc}}</td>
            <td  align="center" >{{$nom->expDevFechaDoc}}</td> 
            <td  align="center"  style="mso-number-format:'0.00'" > <?php  echo floatval( $nom->expDevMonto ) ;?>  </td>         
        
            <td  align="center" >{{$nom->expGirNumDoc}}</td>
            <td  align="center" >{{$nom->expGirFechaDoc}}</td>
            <td  align="center"  style="mso-number-format:'0.00'" > <?php  echo floatval( $nom->expGirMonto ) ;?>  </td>
    
      
        </tr>
        @endforeach
        <?php
        }
        ?>

        </tbody>
         
        </table>



