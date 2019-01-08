
<!--        <table    id="tbCtzDll" class="suggest-element table table-striped table-hover" style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
  -->

<table    id="tbCtzDll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">

        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="60px"  align="center"   valign="center">Unidad</th>
            <th WIDTH="600px" align="left"     valign="center">Descripcion</th>
            
            <th WIDTH="400px" align="left"     valign="center">Especificaciones</th>

            <th valign="right" ><SPAN id="EDIT" >Editar</SPAN></th>
            <th align="right"><SPAN id="DEL" >Borrar</SPAN></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdCzItm"  style="display: none" >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none" >{{ $nom->dllRqItm }}</td>
            <td name="tdCant"  align="center" >{{  $nom->dllCant }}</td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }} </td>
            
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>

            <td BGCOLOR="#d9edf7"><button  id="EDIT" class="btn btn-default btnCtzRowEDIT" style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7" ><button  id="DEL"  class="btn btn-danger btnCtzRowDEL" style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach       

        </tbody>

        <tfoot>
                    <tr class="fila-Hide">
                    <td name="tdCzItm"  style="display: none" >1</td>
                    <td name="tdRqItm"  style="display: none" >1</td>
                    <td name="tdCant"  align="center" >2</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdProd"  align="left"   >4</td>                    
                    <td name="tdEspf"  align="left"   >6</td>
                    <td BGCOLOR="#d9edf7"><button id="EDIT" class="btn btn-default btnCtzRowEDIT" style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="DEL" class="btn btn-danger btnCtzRowDEL" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                    </tr>
        </tfoot>

        </table>