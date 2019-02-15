<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE CONCILIACIÓN - SUBCUENTA: {{ $subcta == 'ALL' ? 'TODOS' : $subcta }}
    </div>
    <div class="table-responsive">
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="4">ENTRADA</th>
                <th colspan="3">SALIDA</th>
                <th></th>
            </tr>
            <tr>
                <th>N°</th>
                <th>SUBCUENTA</th>
                <th>META</th>
                <th>EXP SIAF</th>
                <th>DESCRIPCION PRODUCTO</th>
                <th>GI</th>
                <th>OC</th>
                <th>CANT</th>
                <th>C.T.</th>
                <th>PECOSA</th>
                <th>CANT</th>
                <th>C.T.</th>
                <th>SALDO TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ substr($item->rptCta,0,4) . '.' . substr($item->rptCta,4)  }}</td>
                    <td>{{ $item->rptSf }}</td>
                    <td>{{ $item->rptSiaf }}</td>
                    <td>{{ $item->rptDscprod }}</td>
                    <td>{{ $item->rptIngreso }}</td>
                    <td>{{ $item->rptOC }}</td>
                    <td>{{ $item->rptCantI }}</td>
                    <td>{{ number_format($item->rptMontoI,2) }}</td>
                    <td>{{ $item->rptSalida }}</td>
                    <td>{{ $item->rptCantS }}</td>
                    <td>{{ number_format($item->rptMontoS,2) }}</td>
                    <td>{{ $item->rptMontoI - $item->rptMontoS }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>