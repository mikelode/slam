<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - PECOSAS
    </div>
    <div class="table-responsive">
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th colspan="4">SECUENCIA FUNCIONAL</th>
                <th colspan="10">{{ !$data->isEmpty()?$data[0]->secDsc:'SIN PECOSAS'  }}</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>SF</th>
                <th>PECOSA</th>
                <th>FECHA PECOSA</th>
                <th>GI</th>
                <th>OC</th>
                <th>CODIGO PRODUCTO</th>
                <th>PRODUCTO</th>
                <th>CANT</th>
                <th>CANT ATEND.</th>
                <th>MEDIDA</th>
                <th>PRECIO</th>
                <th>COSTO</th>
                <th>CLASIF</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->SF }}</td>
                    <td>{{ $item->PECOSA }}</td>
                    <td>{{ $item->Fecha }}</td>
                    <td>{{ $item->GI }}</td>
                    <td>{{ $item->OC }}</td>
                    <td style="text-align: left">{{ $item->Codigo }}</td>
                    <td>{{ $item->Producto }}</td>
                    <td>{{ $item->Cantidad }}</td>
                    <td>{{ $item->Atendido }}</td>
                    <td>{{ $item->Medida }}</td>
                    <td>{{ $item->Precio }}</td>
                    <td>{{ $item->Costo }}</td>
                    <td>{{ $item->Clasificador }}</td>
                </tr>
                <?php $total = $total + $item->Costo; ?>
            @endforeach
            <tr>
                <td colspan="12" style="text-align: right">TOTAL</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>