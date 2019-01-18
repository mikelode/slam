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
    header('Content-Disposition: attachment; filename="rptCSDetallado.xls"');
    $i=1;
 ?>   
  

       <table>
                <tr style="height: 20px;background:#c0c0dd" >
                <td valign="center" COLSPAN="19" > <h4>REPORTE DETALLADO : DE ORDENES DE COMPRA</h4></td>        </tr>
        </table>

       <table  style="border-collapse: separate;border-spacing:  3px;">
        <thead align="center">
        <tr style="height: 28px" style="BACKGROUND:#ddd;border: 1px solid #999;border-spacing:  0px ;border-collapse: collapse;" > 
           <th WIDTH="40px"  align="center"   valign="center">Item</th>
                <th WIDTH="50px"  align="center"   valign="center">Estado</th>
                <th WIDTH="40px"  align="center"   valign="center">Año</th>
                <th WIDTH="40px" align="center"     valign="center">Tipo </th>

                <th WIDTH="40px" align="left"     valign="center">Orden</th>
                <th WIDTH="90px" align="center"     valign="center">Fecha</th>
                <th WIDTH="120px" align="center"     valign="center">RUC</th>

                <th WIDTH="250px" align="CENTER"     valign="center">RSocial</th>

                
                <th WIDTH="80px" align="CENTER"     valign="center">SecFunCod</th>
                <th WIDTH="200px" align="left"  valign="center">SecFun</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Codigo</th>
                <th WIDTH="300px" align="CENTER"     valign="center">Descripcion</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Und</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Marca</th>
                <th WIDTH="60px" align="CENTER"     valign="center">Cant</th>
                <th WIDTH="50px" align="CENTER"     valign="center">Precio</th>
                <th WIDTH="50px" align="CENTER"     valign="center">Total</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Clasificador</th>
                <th WIDTH="400px" align="CENTER"     valign="center">Referencia</th>

        </tr>
        </thead>
        <tbody>

        @foreach($resultTar as $key=>$nom)
         <tr style="height: 23px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >     
              <td name="tdCant"  align="center" ><?php echo "0".$i++;?></td>
                <td name="tdCant"  align="center"  >{{  $nom->Estado }}</td>
                <td name="tdClasf"  align="center" >{{  $nom->Anio }} </td>
                <td name="tdUnd"  align="center"   >{{  $nom->Tipo }} </td>

                <td   style="mso-number-format:'@'"    >{{  $nom->Nro_Orden }}  </td>
                <td name="tdEspf"  align="center"    >{{  $nom->Fecha  }} </td>
                <td  style="mso-number-format:'@'" >{{  $nom->RUC }} </td>
                <td name="tdMarca"  align="left" >{{  $nom->RSocial }} </td>

                
                <td  style="mso-number-format:'@'" >{{  $nom->secFunCod }} </td>               
               <td  style="mso-number-format:'@'" >{{  $nom->secFun }} </td>  
                <td   align="center" >{{  $nom->Codigo }} </td>
                <td   align="left" >{{  $nom->Descripcion   }} </td>
                <td   align="center" >{{  $nom->Und }} </td>
                <td  align="center" >{{  $nom->Marca }} </td>
                <td   style="mso-number-format:'0.00'" >{{  $nom->Cantidad }} </td>
                <td   style="mso-number-format:'0.00'" >{{  $nom->Precio }} </td>
                <td   style="mso-number-format:'0.00'" >{{  $nom->Total }} </td>
                <td   align="center" >{{  $nom->Clasificador }} </td>
                <td   align="left" >{{  $nom->Ref }} </td>
      </tr>
        @endforeach
        
        </tbody>
        </table>
 
    <?php
    }
    else 
    {
         $i=1;
    ?>


      <DIV style ="width:1850px">

      <div class="panel panel-default" style="margin-top: -10px; margin-bottom: -5px; padding: 2px; " >
          <table>
          <tr>
            <td><DIV style="background:#f2f2f2;width: 840px; padding:2px ;padding-left:10px;border-radius:5px;"   >  <h5 style="">RESULTADOS DE LA BUSQUEDA </h5>       </DIV> </td>
            <td  align="left">
                <button id="btnLiqCSExcel" class="btn btn-danger" data-ordn="{{ $tipoOrd }}" style="width: 100Px  ;height: 35px ; padding:0; font-size:11px; margin-left:150px;">
                    EXCEL (*.xls)
                </button>
            </td>
          </tr>
          </table>
      </div>

            <table   class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:12px; padding:0px; margin-top:5px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
            <thead align="center" >
            <tr CLASS="gsTh  btn-primary"  style="border-radius: 4px;">
               
                <th WIDTH="40px"  align="center"   valign="center">Item</th>
                <th WIDTH="50px"  align="center"   valign="center">Estado</th>
                <th WIDTH="40px"  align="center"   valign="center">Año</th>
                <th WIDTH="40px" align="center"     valign="center">Tipo </th>

                <th WIDTH="40px" align="left"     valign="center">Orden</th>
                <th WIDTH="90px" align="center"     valign="center">Fecha</th>
                <th WIDTH="120px" align="center"     valign="center">RUC</th>

                <th WIDTH="280px" align="CENTER"     valign="center">RSocial</th>

                
                <th WIDTH="80px" align="CENTER"     valign="center">SecFunCod</th>
               <!-- <th WIDTH="0px" align="left"  valign="center">SecFun</th> -->
                <th WIDTH="150px" align="CENTER"     valign="center">Codigo</th>
                <th WIDTH="350px" align="CENTER"     valign="center">Descripcion</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Und</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Marca</th>
                <th WIDTH="60px" align="CENTER"     valign="center">Cant</th>
                <th WIDTH="80px" align="RIGHT"     valign="center">Precio</th>
                <th WIDTH="80px" align="RIGHT"     valign="center">Total</th>
                <th WIDTH="100px" align="CENTER"     valign="center">Clasificador</th>
                <th WIDTH="400px" align="CENTER"     valign="center">Referencia</th>

              
                
            </tr>
            </thead>
            <tbody>

            @foreach($resultTar as $key=>$nom)
            <tr >            
              <td name="tdCant"  align="center" ><?php echo "0".$i++;?></td>
                <td name="tdCant"  align="center"  >{{  $nom->Estado }}</td>
                <td name="tdClasf"  align="center" >{{  $nom->Anio }} </td>
                <td name="tdUnd"  align="center"   >{{  $nom->Tipo }} </td>

                <td  name="tdProd"  align="center"    >{{  $nom->Nro_Orden }}  </td>
                <td name="tdEspf"  align="center"    >{{  $nom->Fecha  }} </td>
                <td  style="mso-number-format:'@'" name="tdMarca"  align="center" >{{  $nom->RUC }} </td>
                <td name="tdMarca"  align="left" >{{  $nom->RSocial }} </td>

                
                <td name="tdMarca"  align="center" >{{  $nom->secFunCod }} </td>               
              <!--  <td name="tdMarca"  align="center" >{{  $nom->secFun }} </td>   -->
                <td   align="center" >{{  $nom->Codigo }} </td>
                <td   align="left" >{{  $nom->Descripcion   }} </td>
                <td   align="center" >{{  $nom->Und }} </td>
                <td  align="center" >{{  $nom->Marca }} </td>
                <td   align="center" >{{  $nom->Cantidad }} </td>
                <td   align="right" >{{  $nom->Precio }} </td>
                <td   align="right" >{{  $nom->Total }} </td>
                <td   align="center" >{{  $nom->Clasificador }} </td>
                <td   align="left" >{{  $nom->Ref }} </td>
            </tr>
            @endforeach
            
            </tbody>
            </table>
        </DIV>

    <?php
    
}
?>



