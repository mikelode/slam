<TABLE class="suggest-element table table-striped gs-table-item gs-table-hover " id="tabRankingFilter" style="table-layout: fixed" width="100%">
<thead>
<tr>
    <th width="5%"  align="center"></th>
    <th width="5%">Nro</th>
    <th width="10%">RUC</th>
    <th align="left" >Proveedor</th>
    <th width="5%">Tipo</th>
    <th width="10%" align="center">Monto Proveido</th>
    <th width="2%"></th>
</tr>
</thead>
<tbody>
@foreach($ranking as $i => $ruc)
    <tr>
        <td class="details-control" onclick="detalle_ruc(this, '{{ $ruc->rucID }}','{{ $ruc->rucTipo == 'BIENES' ? 'oc' : 'os' }}')"></td>
        <td>{{ $i + 1 }}</td>
        <td>{{ $ruc->rucID }}</td>
        <td>{{ $ruc->rucDsc }}</td>
        <td>{{ $ruc->rucTipo }}</td>
        <td align="right" style="padding-right: 5px;">{{ number_format($ruc->rucMonto,2) }}</td>
        <td></td>
    </tr>
@endforeach
</tbody>
</TABLE>

<script type="text/javascript">
    $(document).ready(function(){

        $('#tabRankingFilter').dataTable({
            "language":{
                "url": "plugins/DataTables/Spanish.json"
            }
        });

    });
</script>