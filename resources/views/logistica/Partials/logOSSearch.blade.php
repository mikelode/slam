 <div class="modal fade"  id="modalOSSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
   <div class="modal-dialog"  style="width: 1100px" >
   <div class="modal-content">
        <div class="modal-header" >
         <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #338Bb7 ; COLOR:#ffffff;" >
         <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
         <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> LISTA DE ORDENES DE COMPRA </span>
         </div></div>


        <hr style="width: auto">



        <table    class="suggest-element table table-striped gs-table-item gs-table-hover " style=" margin-left: 0px;font-size:11px; padding:0px; margin-top:5px; padding-right: 0px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px" >
        <thead align="center">
        <tr CLASS="gsTh" >

            <th WIDTH="15px"  align="center"   valign="center" >Item</th>
            <th WIDTH="70px"  align="left"   valign="center">No O/C</th>
            <th WIDTH="60px"  align="center"   valign="center">Fecha</th>
            <th WIDTH="200px"  align="center"   valign="center">Referencia</th>
            <th WIDTH="30px"  align="left"   valign="center">Dep</th>
            <th WIDTH="30px"  align="left"   valign="center">Sec Fun</th>
            <th WIDTH="30px"  align="right"   valign="center">Rubro</th>
            <th WIDTH="80px"  align="center"   valign="center">Ruc</th>
            <th WIDTH="120px"  align="center"   valign="center">RSocial</th>
            <th WIDTH="80px"  align="center"   valign="center">Estado</th>
            <th WIDTH="80px"  align="center"   valign="center">Usuario</th>

            <th WIDTH="40px"  align="center"   valign="center">-</th>




        </tr>
        </thead>
        <tbody >
        <?php if (isset($result))
        {?>
        <?php $i=1;?>
        @foreach($result as $key=>$nom)
        <tr style="height: 40px" >
        <td name="tdCant"  align="center" ><?php echo "0".$i++;?></td>
        <td  align="center" style="font-size: 12px" > <strong>{{  $nom->osCodigo}}</strong></td>
        <td  align="center" >{{  $nom->osFecha}}</td>
        <td  align="center" >{{  $nom->osRef}}</td>
        <td  align="center" >{{  $nom->osDepCod}}</td>
        <td  align="center" >{{  $nom->osSecFunCod}}</td>
        <td  align="center" >{{  $nom->osRubroCod}}</td>
        <td  align="center" >{{  $nom->osRUC}}</td>
        <td  align="left" >{{  $nom->osRazon}}</td>
        <td  align="center" >-</td>
        <td  align="left" >{{  $nom->osUsrID}}</td>

        <td  align="center">
            <button class="btn btn-info  btn-osSelect" codID="{{  $nom->osID }}" >
                 <span class="glyphicon glyphicon-hand-down" aria-hidden="true" style="width: 10px; height:20px; margin-top: 0px; margin-bottom: 0px;"></span>
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
