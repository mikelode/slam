        <br>
        <br>

        <table    class="suggest-element table table-striped gs-table-item gs-table-hover " style=" margin-left: 0px;font-size:11px; padding:0px; margin-top:-15px; padding-right: 0px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="35px"  align="center"   valign="center">Item</th>
            <th WIDTH="130px"  align="center"   valign="center">Codigo</th>
            <th WIDTH=850px"  align="left"   valign="center">Denominacion</th>
            <th WIDTH="60px"  valign="right" >Editar</th>
            <th WIDTH="60px"  valign="right" >Borrar</th>

        </tr>
        </thead>
        <tbody>
        <?php $i=1;?>
        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdCant"  align="center" ><?php echo "00".$i++;?></td>
            <td name="a"  align="center" >{{  $nom->Cod }}</td>
            <td name="tadCant"  align="left" >{{  $nom->Dsc }}</td>
            <td ><button id="btnLogCat_ItemEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: 0px; font-size:9px;  " type="button">EDIT</button> </td>
            <td ><button id="btnLogCat_ItemDEL" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: 0px; font-size:9px;  " type="button">Borrar</button> </td>
        </tr>
        @endforeach


        </tbody>
        </table>