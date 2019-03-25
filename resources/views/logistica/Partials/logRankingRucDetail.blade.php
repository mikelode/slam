<div style="padding-left: 45px; background-color: #ffe1b4d9">
    <table class="table table-condensed" cellpadding="0" cellspacing="0" width="100%" style="font-size: smaller; table-layout: fixed;">
        <caption>
            DETALLE DE DOCUMENTOS QUE ACUMULAN EL MONTO PROVEIDO
        </caption>
        <thead>
        <tr>
            <th width="5%">ORDEN</th>
            <th width="6%">FECHA</th>
            <th width="15%">GLOSA</th>
            <th width="10%">PROCESO</th>
            <th>META USUARIA</th>
            <th width="5%">MONTO</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ordenes as $orden)
            <tr>
                <td>{{ substr($orden->rucDoc,0,2) . '-' . substr($orden->rucDoc,-5) }}</td>
                <td>{{ $orden->rucDocfecha }}</td>
                <td>{{ $orden->rucGlosa }}</td>
                <td>{{ $orden->rucProcesodsc }}</td>
                <td>{{ '(' . substr($orden->rucSfid,-3) . ') ' . $orden->rucSfdsc }}</td>
                <td align="right">{{ number_format($orden->rucDocmonto, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>