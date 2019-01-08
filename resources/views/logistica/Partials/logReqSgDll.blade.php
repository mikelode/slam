

        <table    id="tbProdBienes" class="suggest-element table table-striped table-hover" style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px" >
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th>
            <th WIDTH="600px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="60px"  align="center"   valign="center">Unidad</th>
            <th WIDTH="200px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="100px" align="center"    valign="center">Precio   </th>
            <th WIDTH="100px" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right">Borrar</th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdID"  style="display: none" >{{ $nom->dllRqItm }}</td>
            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdClasf" align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdPrecio" align="center"> {{  $nom->dllPrecio  }} </td>
            <td name="tdTotal"  align="center"> {{  $nom->dllTotal  }} </td>
            <td BGCOLOR="#d9edf7"><button id="btnLogItemEDIT" class="btn btn-warning editRow" style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7" ><button id="btnLogItemDEL" class="btn btn-danger deleteRow" style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
        

        </tbody>
        </table>
