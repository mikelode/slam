<?php
if(isset($Ftes["Fte"]))
{
?>

     @foreach($Ftes["Fte"] as $key=>$nom)
    <div style="margin: 20px;">
      <h4 ><strong>ADJUDICACION : SE LE OTORGA LA BUENA PRO</strong></h4>
      <table id="tbCC_Adjudicacion" style="font-size: 13px;" >
      <tr name="ruc"> <td> RUC  </td>              <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td style="font-weight: bold; font-size: 14px;"  id="tbAdjRuc"  name="tbAdjRuc" >  <input style="font-weight: bold;width: 100px;" disabled="true" class="form-control  gs-input"  value="{{ $nom->fteRuc }}" > </td> </tr>
      <tr> <td> Razon Social  </td>     <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjRSocial"  width="600px"> <input style="width: 900px;" disabled="true" class="form-control  gs-input"  value="{{ $nom->fteRazon }}" > </td> </tr>
      <tr> <td> Monto  </td>            <td  ALIGN="CENTER"> : </td> <td id="tbAdjMonto"> <input disabled="true" style="width: 100px;" class="form-control  gs-input"  value="{{ $nom->fteTotal }}" > </td> </tr>
      <tr> <td> Plazo de Entrega</td>   <td  ALIGN="CENTER"> : </td> <td id="tbAdjPlazo" > <input   id="txAdjPlazo"  style="width: 900px;" class="form-control  gs-input"  value="{{ $Ent }}" > </td> </tr>

      <tr> <td> Garantia  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjGarantia" >  <input   disabled="true" style="width: 900px;" class="form-control  gs-input"  value="{{ $nom->fteGarantia }}" >  </td> </tr>
	    <tr> <td> Plazo de Ejecucion  </td>         <td ALIGN="CENTER"> : </td> <td id="tbAdjEje" >  <input id="txAdjEje"  style="width: 900px;" class="form-control  gs-input"  value="{{ $Eje  }}" > </td> </tr>
      <tr> <td> Justificacion  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjJustf" >  <input id="txAdjJustf"  style="width: 900px;" class="form-control  gs-input"  value="{{ $Just  }}" > </td> </tr>
      
     <tr> <td> Lugar Entrega  </td>         <td ALIGN="CENTER"> : </td> <td  id="tbAdjLugarEnt">  <input  id="txAdjLugarEnt" style="width: 900px;"  class="form-control  gs-input"  value="{{ $LugarEnt  }}" > <br></td> </tr>
    @if ($nom->fteIgv =="RH")     
	 <tr> <td colspan="3" id="tbAdjIGV" > =========== {{ $nom->fteIgv }}  ================= </td> </tr>
    @else 
	<tr> <td colspan="3" id="tbAdjIGV" > =========== {{ $nom->fteIgv }} INCLUYE IGV ================= </td> </tr>
    @endif
 


      </table>

      </div>
      @endforeach

<?php
}
else
{
?>
 <div style="margin: 20px;">
      <h4 ><strong>ADJUDICACION </strong></h4>
      <table id="tbCC_Adjudicacion" style="font-size: 13px;">
      <tr> <td> RUC  </td>              <td  ALIGN="CENTER"> : </td> <td style="font-weight: bold; font-size: 14px;"  id="tbAdjRuc" > </td> </tr>
      <tr> <td> Razon Social  </td>     <td  ALIGN="CENTER"> : </td> <td id="tbAdjRSocial" > - </td> </tr>
      <tr> <td> Monto  </td>            <td  ALIGN="CENTER"> : </td> <td id="tbAdjMonto"> - </td> </tr>
      <tr> <td> Plazo de Entrega</td>   <td  ALIGN="CENTER"> : </td> <td id="tbAdjPlazo" >  <input  id="txAdjPlazo" style="width: 900px;" class="form-control  gs-input"  value="" > </td> </td> </tr>
      <tr> <td> Justificacion  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjJust" > <input id="txAdjJustf"  class="form-control  gs-input" width="900px" value="" > </td>   </td> </tr>
      <tr> <td> Plazo de Ejecucion  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjEje" > <input id="txAdjEje"  class="form-control  gs-input" width="900px" value="" > </td>   </td> </tr>
      <tr> <td> Lugar Entrega  </td>         <td  ALIGN="CENTER"> : </td> <td id="tbAdjLugarEnt" > <input id="txAdjLugarEnt"  class="form-control  gs-input" width="900px" value="" > <br></td>   </td> </tr>
      <tr> <td> Garantia  </td>         <td ALIGN="CENTER"> : </td> <td id="tbAdjGarantia" >   </td> </tr>

	  <tr> <td colspan="3" id="tbAdjIGV" > =========== === ================= </td> </tr>
      </table>

      </div>
 <?php
 }
 ?>

