
<table    id="tbAUDll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:5px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">

        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="20px"  align="center"   valign="center">Item</th>
            <th WIDTH="20px"  align="center"   valign="center">-</th>
            <th WIDTH="60px"  align="center"   valign="center">Año</th>
            
            <th WIDTH="120px"  align="center"   valign="center">Estado</th>
            <th WIDTH="90px"  align="center"   valign="center">Codigo</th>
            <th WIDTH="80px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="450px"  align="center"   valign="center">Glosa</th>
            
            <th valign="right" ><SPAN id="EDIT" >Usuario<br> Actual </SPAN></th>  
            <th valign="right" ><SPAN id="EDIT" >Resultado </SPAN></th>            
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
           <td name="tdAdCheck"  align="center"  codID="{{$nom->adID}}" style=" height:30px;"> 
              @if( $nom->adEstado<> '** ANULADO **' )
              <input type="checkbox" class="chxAUDll" style="width:20px; height:20px;" > 
              @endif
            </td>
           <td name="tdAdAnio"  align="center"  >{{ $nom->adAnio }}</td>
           
           <td name="tdAdEstado"   align="center"     >{{ $nom->adEstado }}</td>
           <td name="tdAdCodigo"    align="center"    >{{ $nom->adCodigo }}</td>
           <td name="tdAdFecha"    align="center"    >{{ $nom->adFecha }}</td>
           <td name="tdAdGlosa"    align="left"    >{{ $nom->adGlosa }}</td>
           
           <td name="tdAdUsuario"    >{{ $nom->adUsuario }}</td>
           <td name="tdAdResult"    ></td>
           
        </tr>
        @endforeach

      <?php
      }
      if(isset($resultRow))
      {
      ?>
       <tr >
       <td colspan="11"><br> <h4>@foreach($resultRow as $key=>$nom)  {{ $nom->Mensaje }}   @endforeach  </h4>       </td>
       </tr>

      <?php
      }
      if ($i==0 && isset($result) )
      {
      ?>
       <tr >
       <td colspan="11"><br> <h4> NO se encontro resultados, es posible que el documento  No existe</h4>       </td>
       </tr>
      <?php       
       }
       ?>

        </tbody>

       
</table>


