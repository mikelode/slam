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
header('Content-Disposition: attachment; filename="nombre.xls"');

 echo  '
 <html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
<title>comolohago.clt</title>
<style type=”text/css”>
.style1 {
font-size:14px;
font-family: Verdana, Arial, Helvetica, sans-serif;
font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
</style>
</head>
<body>
';
?>

		
		
        <table     class=" table table-striped gs-table-item gs-table-hover " style=" margin-left: 0px;font-size:11px; padding:0px; margin-top:0px; padding-right: 0px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px"    >
        <thead align="center">
        <tr CLASS="gsTh" >
<th WIDTH="15px"  align="center"   valign="center" >VER</th>
		<th WIDTH="10px"  align="center"   valign="center" >Item</th>
			  <th WIDTH="60px"  align="left"   valign="center">Req</th>
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

            <th WIDTH="60px"  align="left"   valign="center">OC</th>
            <th WIDTH="60px"  align="left"   valign="center">Fecha</th>

            <th WIDTH="60px"  align="left"   valign="center">OS</th>
            <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
			
			  <th WIDTH="60px"  align="left"   valign="center">Pecosa</th>
            <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
			
			<th WIDTH="60px"  align="left"   valign="center">NroSIAF</th>
			<th WIDTH="60px"  align="left"   valign="center">Compromiso</th>
            <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
			
			<th WIDTH="60px"  align="left"   valign="center">Devengado</th>
            <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
			
			<th WIDTH="60px"  align="left"   valign="center">Girado</th>
            <th WIDTH="60px"  align="left"   valign="center">Fecha</th>
			

        </tr>
        </thead>
        <tbody id="TblBody">
        <?php if (isset($result["Dll"]))
        {?>
        <?php $i=1;?>
        @foreach($result["Dll"] as $key=>$nom)
        <tr style="height: 40px" >
            
			<td  align="center" ><button class="btn btn-info btnLogReqSegVer " reqID ='{{  $nom->ReqID }}' style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  "   > VER </button></TD>
			<td name="tdCant"  align="center" ><?php echo "0".$i++;?></td>

			
              <td  align="center" bgcolor="#f7f7f7"  valign="center"><strong style="font-size:12px;">{{  $nom->NroReq }}</strong></td>
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
            <td  align="center" >{{  $nom->RazonSocial }}</td>

            <td  align="center" >{{  $nom->NroOC }}</td>
            <td  align="center" >{{  $nom->Fecha_OC }}</td>

            <td  align="center" >{{  $nom->NroOS }}</td>
            <td  align="center" >{{  $nom->Fecha_OS }}</td>
			
			<td  align="center" >-</td>
			<td  align="center" >-</td>
			<td  align="center" >-</td>
			
			<td  align="center" >-</td>
			<td  align="center" >-</td>
			
			<td  align="center" >-</td>
			<td  align="center" >-</td>
			
			<td  align="center" >-</td>
			<td  align="center" >-</td>
			
        </tr>
        @endforeach
        <?php
        }
        ?>
        </tbody>
        </table>
<?php		
echo '
</body>
</html>
';
?>