 <div class="modal fade"  id="modalCtzSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="  overflow-x:scroll" >
   <div class="modal-dialog"  style="width: 1100px" >
   <div class="modal-content">
        <div class="modal-header" id = "divScroll">
         <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #338Bb7 ; COLOR:#ffffff;" >
         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> LISTA DE COTIZACIONES </span>
         </div></div>


        <hr style="width: auto">



        <table    class="suggest-element table table-striped gs-table-item gs-table-hover " style=" margin-left: 0px;font-size:11px; padding:0px; margin-top:5px; padding-right: 0px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px" width="100%">
        <thead align="center">
        <tr CLASS="gsTh" >

            <th WIDTH="15px"  align="center"   valign="center" >Item</th>
            <th WIDTH="70px"  align="left"   valign="center">Nro Cotiz</th>
            <th WIDTH="60px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="80px"  align="center"   valign="center">Requerimiento</th>
            <th WIDTH="100px"  align="right"   valign="center">Glosa</th>
            <th WIDTH="100px"  align="center"   valign="center">Lugar de Ent</th>
            <th WIDTH="60px"  align="center"   valign="center">Estado</th>
            <th WIDTH="60px"  align="center"   valign="center">Usuario</th>
            <th WIDTH="60px"  align="center"   valign="center">-</th>

        </tr>
        </thead>
        <tbody id="TblBody">
        <?php if (isset($result))
        {?>
        <?php $i=1;?>
        @foreach($result as $key=>$nom)
        <tr style="height: 40px" >
        <td name="tdCant"  align="center" ><?php echo "0".$i++;?></td>
        <td  align="center" style="font-size: 12px" > <strong>{{  $nom->ctzCodigo}}</strong></td>
        <td  align="center" >{{  $nom->ctzFecha}}</td>
        <td  align="center" >{{  $nom->ctzRef}}</td>
        <td  align="left" >{{  $nom->ctzGlosa}}</td>
        <td  align="left" >{{  $nom->ctzLugarEnt}} </td>
        <td  align="center" >{{  $nom->ctzEtapa}}</td>
        <td  align="center" >{{  $nom->ctzUsrID}}</td>

        <td  align="center">
            <button class="btn btn-info  btn-ctzSelect" codID="{{  $nom->ctzID }}" >
                 <span class="glyphicon glyphicon-hand-down" aria-hidden="true" style="width: 10px; height:15px; margin-top: 0px; margin-bottom: 0px;"></span>
            </button>

        </td>
        </tr>
        @endforeach
        <?php
        }
        ?>
        </tbody>
        </table>






        </div>


   </div>
   </div>
   </div>
