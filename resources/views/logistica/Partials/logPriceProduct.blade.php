<TABLE class="suggest-element table table-striped gs-table-item gs-table-hover " id="tabPriceFilter" style="table-layout: fixed" width="100%">
<thead>
<tr>
    <th width="5%"  align="center"></th>
    <th align="left" >Descripcion</th>
    <th width="5%">Und</th>
    <th width="10%"  align="center">Precio Mín</th>
    <th width="10%"  align="center">Precio Máx</th>
    <th width="10%"  align="center">Promedio</th>
</tr>
</thead>
<tbody>
@foreach($productos as $prod)
    <tr>
        <td class="details-control" onclick="detalle_producto(this, '{{ $prod->prcProdCod }}','{{ $prod->prcDocumento }}','{{ $prod->prcProdUndCod }}')"></td>
        <td>{{ $prod->prcProdDsc }}</td>
        <td>{{ $prod->prcProdUnd }}</td>
        <td align="right">{{ number_format($prod->prcMinPrice,2) }}</td>
        <td align="right">{{ number_format($prod->prcMaxPrice,2) }}</td>
        <td align="right">{{ number_format($prod->prcAvgPrice,2) }}</td>
    </tr>
@endforeach
</tbody>
</TABLE>

<script type="text/javascript">
    $(document).ready(function(){

        $('#tabPriceFilter').dataTable({
            "language":{
                "url": "plugins/DataTables/Spanish.json"
            }
        });

    });
</script>