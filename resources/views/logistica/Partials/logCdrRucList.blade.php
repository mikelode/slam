
            <table    id="tbRUCs" class="suggest-element table table-striped table-hover" style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
                 <thead align="center">
                 <tr CLASS="gsTh" >
                     <th WIDTH="0px" style="display: none" ></th>
                     <th WIDTH="100px" align="left"     valign="center">RUC</th>
                     <th WIDTH="750px"  align="center"   valign="center">Razon Social</th>
                     <th WIDTH="100px" align="left"     valign="center">Monto</th>
                     <th WIDTH="100px" align="left"     valign="center">IGV</th>
                     <th WIDTH="100px" align="left"     valign="center">Plazo</th>
                     <th WIDTH="100px" align="left"     valign="center">Garantia</th>
                     <th valign="right" ><SPAN id="btnLogRucShow" ></SPAN></th>
                     <th valign="right" ><SPAN id="" ></SPAN></th>
                     <th valign="right" ><SPAN id="btnLogRucEdit" ></SPAN></th>
                     <th align="right"><SPAN id="btnLogRucDel" >Borrar</SPAN></th>
                 </tr>
                 </thead>
                 <tbody>

                  @foreach($result as $key=>$nom)
                         <tr >
                             <td name="tdID"  style="display: none" >{{ $nom->fteID }}</td>
                             <td name="tbRuc"  align="center" >{{  $nom->fteRuc }}</td>
                             <td name="tbRSocial"  align="left"   >{{ $nom->fteRazon }} </td>
                             <td name="tbMonto"  align="center"  >{{ $nom->fteTotal }} </td>
                             <td name="tbIGV"  align="left"   > {{  $nom->fteIgv  }} </td>
                             <td name="tbPlazo"  align="left"   > {{  $nom->ftePlazo }} </td>
                             <td name="tbGarantia"  align="left"   > {{  $nom->fteGarantia  }} </td>
                             <td BGCOLOR="#d9edf7"><button  id="btnCCRucVER" class="btn btn-default " style="width:   65Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button" >PROPUESTA</button> </td>
                             <td BGCOLOR="#d9edf7"><button  id="btnCCRucEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button" >BIENES</button> </td>
                             <td BGCOLOR="#d9edf7"><button  id="btnCCRucBUENAPRO" class="btn btn-success " style="width:   65Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button" >BUENA PRO</button> </td>
                             <td BGCOLOR="#d9edf7" ><button  id="btnCCRucDEL"  class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button" >X</button> </td>
                         </tr>
                         @endforeach
       </tbody>
       </table>

