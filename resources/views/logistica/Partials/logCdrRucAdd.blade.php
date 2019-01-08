
<H4> <STRONG>REGISTRO DEL PROVEEDOR: </STRONG></H4>
<table  class="gs-table" style=" border-spacing:  5px;border-collapse: separate; " cellpadding="5" id="tbCCRuc"  fteID="NN" fteOPE="ADD">
<tr><td> RUC           </td>    <td WIDTH="20PX" ALIGN="CENTER" > : </td> <td> <table><tr><td><input id="txRUC" name="txRUC" class="form-control gs-input" placeholder="Nro de RUC" style="width: 110px; font-weight: bold; font-size: 14px; HEIGHT:35PX;"  /> </td>    <td> <button id="btnLogCCRucSUNAT" class="btn btn-primary" style=" margin-left: 5px; ; width:  120px;font-size: 12px; font-weight: bold; height: 28px; "> BUSCAR</button> </td></tr></table> </td></tr>
<tr><td> Razon Social  </td>    <td WIDTH="20PX" ALIGN="CENTER" > : </td> <td><input id="txRSocial" class="form-control gs-input" placeholder="Razon Social" style="width: 500px;" /> </td></tr>
<tr><td> Plazo Entrega</td>     <td WIDTH="20PX" ALIGN="CENTER" > : </td> <td><input id="txPlazo" class="form-control gs-input" placeholder="Plazo de Entrega" style="width: 110px;" /> </td></tr>
<tr><td> Garantia</td>          <td WIDTH="20PX" ALIGN="CENTER" > : </td> <td><input id="txGarantia" class="form-control gs-input" placeholder="Garantia" style="width: 110px;" /> </td></tr>
<tr><td> Observaciones</td>     <td WIDTH="20PX" ALIGN="CENTER" > : </td> <td><input id="txRucObsv" class="form-control gs-input" placeholder="Observaciones" style="width: 300px;" /> </td></tr>
<tr><td> ¿ Incluye IGV.? </td>  <td WIDTH="20PX" ALIGN="CENTER" > : </td> <td>
    <table>
    <tr>
        <div id="txCC_IGV" IGV="NN"> </div>
        <td width="10"></td>
        <td><div class="radio"> <label><input type="radio" id="rIgvSI" name="optradioIGV">SI</label>  </div></td>
        <td width="20"></td>
        <td><div class="radio"> <label><input type="radio" id="rIgvNO" name="optradioIGV">NO</label>  </div></td>
		<td width="20"></td>
        <td><div class="radio"> <label><input type="radio" id="rIgvRH" name="optradioIGV">RH</label>  </div></td>
    </tr>
    </table>
</td>
</tr>
<tr ALIGN="left"><td colspan="3"> <button id="btnLogCdrRucSave" class="btn btn-primary" style="width:  100px;font-size: 12px; margin-top: 10px; margin-left: 10px;"> GUARDAR </button>   <button id="btnLogCdrRucCancel" class="btn btn-default" style="width:  100px;font-size: 12px;margin-top: 10px; margin-left: 10px; "> CANCELAR </button>   </td><td></td> </tr>
</table>

<?php



