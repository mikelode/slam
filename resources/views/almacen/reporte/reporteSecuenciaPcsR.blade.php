<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - PECOSAS RESUMEN
    </div>
    <div class="table-responsive">
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th colspan="4">SECUENCIA FUNCIONAL</th>
                <th colspan="7">{{ !$data->isEmpty()?$data[0]->secDsc:'SIN PECOSAS'  }}</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>SIAF</th>
                <th>META</th>
                <th>PROVEEDOR</th>
                <th>NRO O/C</th>
                <th>FECHA O/C</th>
                <th>IMPORTE</th>
                <th>INTERNAMIENTO</th>
                <th>NRO PECOSA</th>
                <th>FECHA PECOSA</th>
                <th>RECEPCIONADO POR</th>
                <th>IMPORTE</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->rptSiaf }}</td>
                    <td>{{ substr($item->rptSfID,-3) }}</td>
                    <td>{{ $item->rptRuc }}</td>
                    <td>{{ $item->rptOcid }}</td>
                    <td>{{ $item->rptOcfecha }}</td>
                    <td style="text-align: right">{{ number_format($item->rptOcmonto,2) }}</td>
                    <td>{{ $item->rptInternamiento }}</td>
                    <td>{{ $item->rptPcs }}</td>
                    <td>{{ $item->rptPcsfecha }}</td>
                    <td>{{ $item->rptSolicitante }}</td>
                    <td style="text-align: right">{{ number_format($item->rptPcsmonto,2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="9" style="text-align: right">TOTAL</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>