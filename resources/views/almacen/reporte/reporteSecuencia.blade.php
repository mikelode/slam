<div class="panel panel-default alm-panel">
    <div class="panel-heading alm-panel-heading">
        REPORTE DE ALMACEN - PRODUCTOS
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th colspan="3">SECUENCIA FUNCIONAL</th>
                <th colspan="3"></th>
                <th colspan="3">ENTRADA</th>
                <th colspan="3">SALIDA</th>
                <th colspan="3">SALDO FINAL</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>SECUENCIA</th>
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
            <?php
            $totali = 0;
            $totals = 0;
            ?>
            @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->Secuencia }}</td>
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
                <?php
                $totali = $totali + $item->Costo;
                $totals = $totals + $item->costoDistrib;
                ?>
            @endforeach
            <tr>
                <td colspan="8" style="text-align: right">TOTAL</td>
                <td>{{ $totali }}</td>
                <td colspan="2"></td>
                <td>{{ $totals }}</td>
                <td colspan="3"></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>