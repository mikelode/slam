<p style="margin: 0 0 4px"><label class="control-label alm-label">Plazo de Entrega</label>: {{ $data[0]->orcPlazo }} </p>
<p style="margin: 0 0 4px"><label class="control-label alm-label">Glosa de OC</label>: {{ $data[0]->orcGlosa }} </p>
<p style="margin: 0 0 4px"><label class="control-label alm-label">Doc. de Ref.</label>: {{ $data[0]->orcRef }} </p>
<p style="margin: 0 0 4px"><label class="control-label alm-label">Proveedor</label>: {{ $data[0]->orcRuc.': '.$data[0]->ocProv }} </p>
<p style="margin: 0 0 4px"><label class="control-label alm-label">Tipo de Proceso</label>: {{ $data[0]->orcProcTip.': '.$data[0]->ocProcTipo }} </p>
<p style="margin: 0 0 4px;">
    <label class="control-label alm-label">Secuencia Funcional</label>:{{ $data[0]->orcSecFun }}
    <label class="control-label">Proy/Activ: </label> {{ $data[0]->ocSecFuncDesc }}
</p>
<p style="margin: 0 0 4px"><label class="control-label alm-label">Dependencia</label>: {{ $data[0]->orcDep.': '.$data[0]->ocDepdesc }} </p>
<p style="margin: 0 0 4px"><label class="control-label alm-label">Costo Total</label>: {{ $ct[0]->ocTotalCosto }} </p>
