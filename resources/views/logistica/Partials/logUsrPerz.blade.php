<br>
<table    id="tbPerzDll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:5px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">

        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="20px"  align="center"   valign="center">Item</th>
            <th WIDTH="60px"  align="center"   valign="center">Descripcion</th>
            <th WIDTH="30px"  align="center"   valign="center">Crear</th>
            <th WIDTH="30px"  align="center"   valign="center">Modificar</th>
            <th WIDTH="30px"  align="center"   valign="center">Borrar</th>
            <th WIDTH="30px"  align="center"   valign="center">Imprimir</th>
            <th width="30px"  align="center" valign="middle">Ver</th>
                   
        </tr>
        </thead>
        <tbody>

        <?php
        $i=0;
        if(isset($result))
        {
           $brak='0'; 
        ?>
           
         @foreach($result as $key=>$nom)
             @if ($brak<> $nom->modCat)
                <tr  style="height:10px;" class="tRow">
                    <td colspan="7">
                        <strong> ==================================================================================================== </strong>
                    </td>
                </tr >
             @endif
             <?php  $brak = $nom->modCat ;  ?>
            <tr style="height:10px;padding:0px;margin:0px;" cellpadding="0px"  >
               <td name="tdAdNro"     align="center"  >
                   <?php  echo ++$i; ?>
               </td>
               <td name="tdModDsc"    align="Left"  codID="{{$nom->modID }}">
                   {{$nom->modDsc }}
               </td>
               <td name="tdModAdd"    align="center"  >
                   @if ( $nom->modAdd == '1' )
                       <input type="checkbox" class="chxAdd" style="width:14px; height:14px;margin:0px;padding:0px;" <?php if ( $nom->mdlCre == '1' )  echo "checked"  ?> >
                   @endif
               </td>
               <td name="tdModUpd"    align="center"  >
                   @if ( $nom->modUpd == '1' )
                       <input type="checkbox" class="chxUpd" style="width:14px; height:14px;margin:0px;padding:0px;"   <?php if ( $nom->mdlMod == '1' )  echo "checked"  ?> >
                   @endif
               </td>
               <td name="tdModDel"    align="center"  >
                   @if ( $nom->modDel == '1' )
                       <input type="checkbox" class="chxDel" style="width:14px; height:14px;margin:0px;padding:0px;"   <?php if ( $nom->mdlEli == '1' )  echo "checked"  ?> >
                   @endif
               </td>
               <td name="tdModPrint"  align="center"  >
                   @if ( $nom->modPrint == '1' )
                       <input type="checkbox" class="chxPrint" style="width:14px; height:14px;margin:0px;padding:0px;" <?php if ( $nom->mdlImp == '1' )  echo "checked"  ?> >
                   @endif
               </td>
                <td name="tdModShow" align="center">
                    @if( $nom->modShow == '1' )
                        <input type="checkbox" class="chxShow" style="width:14px; height:14px;margin:0px;padding:0px;" <?php if($nom->mdlVer == '1') echo "checked" ?>>
                    @endif
                </td>
            </tr>
        @endforeach
    
      <?php       
       }
       ?>

        </tbody>
       
</table>


