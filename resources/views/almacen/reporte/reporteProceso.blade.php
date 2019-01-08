<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - PRODUCTOS
    </div>
    <table class="table" style="font-size: 8px">
        <thead>
            <tr>
                <th colspan="3">TIPO DE PROCESO</th>
                <th colspan="3"></th>
                <th colspan="3">ENTRADA</th>
                <th colspan="3">SALIDA</th>
                <th colspan="3">SALDO FINAL</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>PROCESO</th>
                <th>FECHA</th>
                <th>DOCUMENTO</th>
                <th>ORDEN DE COMPRA</th>
                <th>PRODUCTO</th>
                <th>CANT</th>
                <th>C.U</th>
                <th>C.T.</th>
                <th>CANT</th>
                <th>C.U</th>
                <th>C.T.</th>
                <th>CANT</th>
                <th>C.U</th>
                <th>C.T.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key=>$item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->Proceso }}</td>
                <td>{{ $item->Fecha }}</td>
                <td>{{ $item->Internamiento }}</td>
                <td>{{ $item->Orden }}</td>
                <td style="text-align: left">{{ $item->Producto }}</td>
                <td>{{ $item->Ingresado }}</td>
                <td>{{ $item->Precio }}</td>
                <td>{{ $item->Costo }}</td>
                <td>{{ $item->Distribuido }}</td>
                <td>{{ $item->Precio }}</td>
                <td>{{ $item->costoDistrib }}</td>
                <td>{{ $item->Stock }}</td>
                <td>{{ $item->Precio }}</td>
                <td>{{ $item->costoSaldo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>