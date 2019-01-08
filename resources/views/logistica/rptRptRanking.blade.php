
    
    <div class="panel-heading alm-panel-heading" style=" font-family:  'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;" >
    <span style ="font-size:17px;"> <strong> {{ config('slam.APP_ENTIDAD') }}  </strong>  </span><BR>
    <span style ="font-size:17px;"> <strong> {{ config('slam.ENTIDAD_PROV') }}  </strong>  </span><BR>
    <span style ="font-size:17px;"> <strong> RUC: {{ config('slam.ENTIDAD_RUC') }}  </strong>  </span>
    <br>
     <h2 style ="font-size:25px;" align="center">  <strong> REPORTE RANKING DE PROVEEDORES </strong> </h2>
    </div>
    

 <div class = "content"  style=" font-family:  'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
 
             <table  style="font-size: 14px; margin-left:5px width:auto" cellpadding="3" cellspacing="0" >
            
              <tr  class="dll" >
                    <th ALIGN="center"  width="40px" style="background:#bbb;border:1px solid #888;">Nro</th>
                    <th ALIGN="center"  width="150px" style="background:#bbb;border:1px solid #888;">Ruc</th>
                    <th ALIGN="left" width="500px" style="background:#bbb;border:1px solid #888;">Razon Social</th>
                    <th ALIGN="center"  width="150px" style="background:#bbb;border:1px solid #888;">Monto</th>              
             </tr>
            
              <tbody>
              <?php $Total=0; $Item =1 ;?>
              @foreach($ReturnData["Ranking"] as $key=>$Detalles)
              <tr style = "font-size:12px" >
                   <td ALIGN="center" style = "border:1px solid #888;" ><?php echo $Item++ ;?></td>
                   <td ALIGN="center" style = "font-size:16px;border:1px solid #888;" >  <strong> {{ $Detalles->Ruc     }} </strong></td>
                   <td  class="dllsss lefts" ALIGN="left"  style = "border:1px solid #888;">  {{ $Detalles->Razon  }}</td>
                   <td ALIGN="right" style = "font-size:16px;border:1px solid #888;"> <?php echo  number_format ($Detalles->Monto  ,2);?>  </td>
              </tr>
            
              @endforeach

			 

          </tbody>
          </table>
  </div>
