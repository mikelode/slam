 <?php if (isset($result["Dll"]))
        {?>
        <?php $i=1;?>
        @foreach($result["Dll"] as $key=>$nom)
        <tr style="height: 40px" >            
            
            <td name="tdCant"  align="center" ><strong><?php echo "0".$i++;?></strong></td>      
      

            <td  align="center" bgcolor="#f7f7f7"  valign="center"> <span class="btn btn-primary btnLogReqSegVer " reqID ='{{  $nom->ReqID }}'  reqCodigo ='{{  $nom->NroReq }}' style="width:   70Px  ;height: 30px ; padding-left: 7px; font-size:12px; font-weight:bold; " > {{  $nom->NroReq }} </span></td>
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
            <td  align="center" >{{$nom->expComMonto}}</td>

            
            <td  align="center" >{{$nom->expDevNumDoc}}</td>
            <td  align="center" >{{$nom->expDevFechaDoc}}</td>     
            <td  align="center" >{{$nom->expDevMonto}}</td>     
        
            <td  align="center" >{{$nom->expGirNumDoc}}</td>
            <td  align="center" >{{$nom->expGirFechaDoc}}</td>
            <td  align="center" >{{$nom->expGirMonto}}</td>
    
      
        </tr>
        @endforeach
        <?php
        }
        ?>