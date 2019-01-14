<?php
if(isset($Ftes["Fte"]))
{
?>

     @foreach($Ftes["Fte"] as $key=>$nom)
    <div style="margin: 20px;">
      <table class="table table-condensed" id="tbCC_Adjudicacion" style="font-size: 13px;" >
          <tr>
              <td align="center" colspan="3"><strong>SE LE OTORGA LA BUENA PRO A:</strong></td>
          </tr>
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
      <table class="table table-condensed" id="tbCC_Adjudicacion" style="font-size: 13px; table-layout: fixed;" width="100%">
          <tr>
              <td align="center" colspan="3"><strong>DATOS DE ADJUDICACION DE LA BUENA PRO </strong></td>
          </tr>
      <tr>
          <td width="15%" style="font-weight: bold"> RUC  </td>
          <td width="1%" ALIGN="CENTER"> : </td>
          <td style="font-weight: bold; font-size: 14px;"  id="tbAdjRuc" > </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Razón Social  </td>
          <td  ALIGN="CENTER"> : </td>
          <td id="tbAdjRSocial" > - </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Monto  </td>
          <td  ALIGN="CENTER"> : </td>
          <td id="tbAdjMonto"> - </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Plazo de Entrega</td>
          <td  ALIGN="CENTER"> : </td>
          <td id="tbAdjPlazo" >
              <input  id="txAdjPlazo" class="form-control  gs-input"  value="" >
          </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Justificación  </td>
          <td  ALIGN="CENTER"> : </td>
          <td id="tbAdjJust" >
              <textarea id="txAdjJustf" class="form-control  gs-input" rows="3"></textarea>
          </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Plazo de Ejecución  </td>
          <td  ALIGN="CENTER"> : </td>
          <td id="tbAdjEje" >
              <input id="txAdjEje"  class="form-control  gs-input" value="" >
          </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Lugar Entrega  </td>
          <td  ALIGN="CENTER"> : </td>
          <td id="tbAdjLugarEnt" >
              <input id="txAdjLugarEnt"  class="form-control  gs-input" value="" > <br>
          </td>
      </tr>
      <tr>
          <td style="font-weight: bold"> Garantía  </td>
          <td ALIGN="CENTER"> : </td>
          <td id="tbAdjGarantia" >   </td>
      </tr>

	  <tr> <td colspan="3" id="tbAdjIGV" > =========== === ================= </td> </tr>
      </table>

      </div>
 <?php
 }
 ?>

