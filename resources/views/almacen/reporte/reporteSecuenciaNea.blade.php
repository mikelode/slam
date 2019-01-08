<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - NOTAS DE ENTRADA
    </div>
    <table class="table" style="font-size: 8px">
        <thead>
            <tr>
                <th colspan="4">SECUENCIA FUNCIONAL</th>
                <th colspan="10">{{ !$data->isEmpty()?$data[0]->secDsc:'SIN NOTAS DE ENTRADA'  }}</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>SF</th>
                <th>NEA</th>
                <th>FECHA NEA</th>
                <th>CODIGO PRODUCTO</th>
                <th>PRODUCTO</th>
                <th>CANT RECIB.</th>
                <th>MEDIDA</th>
                <th>PRECIO</th>
                <th>COSTO</th>
            </tr>
        </thead>
        <tbody>
        <?php $total = 0; ?>
            @foreach($data as $key=>$item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->SF }}</td>
                <td>{{ $item->ing_giu }}</td>
                <td>{{ $item->conf_fecha }}</td>
                <td style="text-align: left">{{ $item->prod_cod }}</td>
                <td>{{ $item->prod_desc }}</td>
                <td>{{ $item->prod_recep }}</td>
                <td>{{ $item->prod_medida }}</td>
                <td>{{ $item->prod_precio }}</td>
                <td>{{ $item->prod_costo }}</td>
            </tr>
                <?php $total = $total + $item->prod_costo; ?>
            @endforeach
            <tr>
                <td colspan="9" style="text-align: right">TOTAL</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>