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
            <td name="tdDepDsc"    >{{ $nom->depDsc }}</td>
            <td BGCOLOR="#d9edf7"><button id="btnDepRowEDIT" class="btn btn-default " style="width:   55Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px; MARGIN-RIGHT:20px; " type="button">EDITAR</button> </td>
            <td BGCOLOR="#d9edf7" ><button  id="btnDepRowDEL" class="btn btn-danger " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
  <?php
      }
        ?>

        </tbody>

        <tfoot>
                    <tr class="fila-Hide">                   
                    <td name="tdDepItm"  style="display: none" >1</td>                   
                    <td name="tdDepAnio"  align="left"   >4</td>                    
                    <td name="tdDepCod"  align="left"   >4</td>                    
                    <td name="tdDepDsc"  align="left"   >6</td>
                    <td BGCOLOR="#d9edf7"><button id="btnDepRowEDIT" class="btn btn-default btnDepRowSAVE" style="width:   55Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDITAR</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnDepRowDEL" class="btn btn-danger btnDepRowATRAS" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                    </tr>
        </tfoot>
</table>


