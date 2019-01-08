<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - INTERNAMIENTO DE BIENES
    </div>
    <table class="table" style="font-size: 8px">
        <thead>
            <tr>
                <th colspan="4">SECUENCIA FUNCIONAL</th>
                <th colspan="10">{{ !$data->isEmpty()?$data[0]->secDsc:'SIN INTERNAMIENTOS'  }}</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>SF</th>
                <th>GUIA DE INTERNAMIENTO</th>
                <th>PROCESO DE INTERNAMIENTO</th>
                <th>FECHA INTERNAMIENTO</th>
                <th>ORDEN DE COMPRA</th>
                <th>CODIGO PRODUCTO</th>
                <th>PRODUCTO</th>
                <th>CANT</th>
                <th>CANT RECIB.</th>
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
                <td>{{ $item->ing_giu }}</td>
                <td>{{ $item->pint_cpi }}</td>
                <td>{{ $item->pint_fecha }}</td>
                <td>{{ $item->oc_cod }}</td>
                <td style="text-align: left">{{ $item->pintp_cod }}</td>
                <td>{{ $item->pintp_desc }}</td>
                <td>{{ $item->pintp_cant }}</td>
                <td>{{ $item->pintp_cantr }}</td>
                <td>{{ $item->pintp_umedida }}</td>
                <td>{{ $item->pintp_precio }}</td>
                <td>{{ $item->pintp_costo }}</td>
                <td>{{ $item->Clasificador }}</td>
            </tr>
                <?php $total = $total + $item->pintp_costo; ?>
            @endforeach
            <tr>
                <td colspan="12" style="text-align: right">TOTAL</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>