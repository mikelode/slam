<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - PRODUCTOS
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th colspan="3">Fecha Internamiento</th>
                <th colspan="2"></th>
                <th colspan="3">ENTRADA</th>
                <th colspan="3">SALIDA</th>
                <th colspan="3">SALDO FINAL</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>Fecha</th>
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
                    <td>{{ $item->Fecha }}</td>
                    <td>{{ $item->Internamiento }}</td>
                    <td>{{ $item->Orden }}</td>
                    <td>{{ $item->Producto }}</td>
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

</div>