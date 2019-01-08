 <?php if (isset($result["Dll"]))
        {?>
        
        <table class="suggest-element table table-striped  gs-table-hover" style="font-size:11px; padding:0px; margin-top:0px; line-height:12px; border-spacing: 0px; "  cellpadding="0px" cellspacing="0px">
       
        <?php $i=1;?>

        @foreach($result["Dll"] as $key=>$nom)
        <tr>
            <td  align="center" style="display:none" >{{$nom->expItem}}</td>           
            <td  align="right"   style="width:40px">{{$nom->expExpAnio}}</td>
            <td  align="center"   style="width:5px">-</td>
            <td  align="left"  style="width:100px" ><strong style="font-size:13px;">{{$nom->expExpCod}}</strong></td>
            <td  align="center"  style="width:100px" ><button   name="btnLogOCSiaf_DEL" class="btn btn-danger btnLogOCSiaf_DEL  btnLogOSSiaf_DEL" style="padding:5px 15px; margin:0px; font-size:9px;" idItem="{{  $nom->expItem  }}" > ELIMINAR</button></td>
        </tr>
        @endforeach
        </table>
        <?php
        }
        ?>
        