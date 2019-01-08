        <table    id="tbProdBienes" class=" table  table-hover .table-bordered " style="font-size:11px; padding:0px; margin-top:5px; line-height:8px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px" >
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
            
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr  style="height: 23px" style="border: 1px solid #ddd;border-spacing:  0px ;border-collapse: collapse;" >
            <td name="tdID"  style="display: none" >{{ $nom->dllRqItm }}</td>
            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdClasf" align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }} </td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdPrecio" align="center"> {{  $nom->dllPrecio  }} </td>
            <td name="tdTotal"  align="center"> {{  $nom->dllTotal  }} </td>
            </tr>
        @endforeach
      
        </tbody>
        </table>


         {!! Form::button('EXCEL ( *.xls )',['class'=>'btn btn-success','id'=>'btnLogReqSgSearchDllXls','placeholder'=>'Codigo','style'=>'font-size:11px; width:120px; height:40px; text-align:center;' ]) !!}  