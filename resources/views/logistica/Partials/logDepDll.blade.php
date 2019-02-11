<br>
<table    id="tbDepDll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:5px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">

        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>            
            <th WIDTH="50px"  align="center"   valign="center">Año</th>
            <th WIDTH="80px"  align="center"   valign="center">Codigo</th>
            <th WIDTH="900px"  align="center"   valign="center">Dependencia</th>
            <th valign="right" ><SPAN id="EDIT" >Editar</SPAN></th>
            <th align="right"><SPAN id="DEL" >Borrar</SPAN></th>
        </tr>
        </thead>
        <tbody>

        <?php
        if(isset($result))
        {
        ?>
         @foreach($result as $key=>$nom)
        <tr >
           <td name="tdDepItm"  style="display: none"  >{{ $nom->depID }}</td>
           <td name="tdDepAnio"   align="center"     >{{ $nom->depAnio }}</td>
           <td name="tdDepCod"    align="center"    >{{ $nom->depCod }}</td>
            <td name="tdDepDsc" class="txEditDep"   >{{ $nom->depDsc }}</td>
            <td name="tdDepBtnOne" BGCOLOR="#d9edf7" data-ope="edit" class="txEditDep"><button class="btn btn-default btnDepRowEDIT" style="width:   55Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px; MARGIN-RIGHT:20px; " type="button">EDITAR</button> </td>
            <td name="tdDepBtnTwo" BGCOLOR="#d9edf7" data-ope="delete" class="txEditDep" ><button  class="btn btn-danger btnDepRowDEL" style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
  <?php
      }
        ?>

        </tbody>

        <tfoot>
                    <tr class="fila-Hide">                   
                    <td name="tdDepItm"  style="display: none" >1</td>                   
                    <td name="tdDepAnio"  align="center"   >4</td>
                    <td name="tdDepCod"  align="center"   >4</td>
                    <td name="tdDepDsc"  class="txEditDep" >6</td>
                    <td name="tdDepBtnOne" data-ope="edit" class="txEditDep" BGCOLOR="#d9edf7"><button class="btn btn-default btnDepRowEDIT" style="width:   55Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDITAR</button> </td>
                    <td name="tdDepBtnTwo" data-ope="delete" class="txEditDep" BGCOLOR="#d9edf7" ><button class="btn btn-danger btnDepRowDEL" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                    </tr>
        </tfoot>
</table>


