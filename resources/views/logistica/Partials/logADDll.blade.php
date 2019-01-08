<br>
<table    id="tbADDll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:5px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">

        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="20px"  align="center"   valign="center">Item</th>
            <th WIDTH="40px"  align="center"   valign="center">Año</th>
            <th WIDTH="100px"  align="center"   valign="center">Tipo</th>
            <th WIDTH="70px"  align="center"   valign="center">Estado</th>
            <th WIDTH="80px"  align="center"   valign="center">Codigo</th>
            <th WIDTH="80px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="400px"  align="center"   valign="center">Glosa</th>
            <th WIDTH="300px"  align="center"   valign="center">Motivo</th>
            <th valign="right" ><SPAN id="EDIT" >Activar</SPAN></th>            
        </tr>
        </thead>
        <tbody>

        <?php
        $i=0;
        if(isset($result))
        {
            
        ?>

         @foreach($result as $key=>$nom)
        <tr >
           <td name="tdAdNro"  align="center"  >  <?php  echo ++$i; ?> </td>
           <td name="tdAdAnio"  align="center"  >{{ $nom->adAnio }}</td>
           <td name="tdAdTipo"   align="center"     >{{ $nom->adTipo }}</td>
           <td name="tdAdEstado"   align="center"     >{{ $nom->adEstado }}</td>
           <td name="tdAdCodigo"    align="center"    >{{ $nom->adCodigo }}</td>
           <td name="tdAdFecha"    align="center"    >{{ $nom->adFecha }}</td>
           <td name="tdAdGlosa"    align="left"    >{{ $nom->adGlosa }}</td>
           <td name="tdAdMotivo"    >{{ $nom->adMotivo }}</td>
           <td BGCOLOR="#d9edf7"><button   codID ="{{$nom->adID }}" class="btn btn-primary btnADActivar " style="width:   95Px  ;height: 30px ; padding:0px; padding-left: -10px; font-size:9px; MARGIN-RIGHT:20px; " type="button">ACTIVAR</button> </td>
           
        </tr>
        @endforeach

      <?php
      }
      if(isset($resultRow))
      {
      ?>
       <tr >
       <td colspan="8"><br> <h4>@foreach($resultRow as $key=>$nom)  {{ $nom->Mensaje }}   @endforeach  </h4>       </td>
       </tr>

      <?php
      }
      if ($i==0 && isset($result) )
      {
      ?>
       <tr >
       <td colspan="8"><br> <h4> NO se encontro resultados, es posible que el documento no esta Anulado o No existe</h4>       </td>
       </tr>
      <?php       
       }
       ?>

        </tbody>

        <tfoot>
                    <tr class="fila-Hide">                   
                    <td name="tdAdItem"  align="center" >1</td>                   
                    <td name="tdAdAnio"  align="center" >1</td>                   
                    <td name="tdAdTipo"  align="left"   >4</td>                    
                    <td name="tdAdEstado"  align="left"   >4</td>                    
                    <td name="tdAdCodigo"  align="left"   >4</td>                    
                    <td name="tdAdFecha"  align="left"   >4</td>                    
                    <td name="tdAdGlosa"  align="left"   >4</td>                    
                    <td name="tdAdMotivo"  align="left"   >6</td>
                    <td BGCOLOR="#d9edf7"><button  class="btn btn-default btnADActivar" style="width:   55Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDITAR</button> </td>                    
                    </tr>
        </tfoot>
</table>


