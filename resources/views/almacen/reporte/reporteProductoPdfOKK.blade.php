<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <style>
        @media print {
            body {
                overflow: visible !important;
            }
        }

        thead { display: table-header-group }
        tfoot { display: table-row-group }
        tr { page-break-inside: avoid }
    </style>
    <body>
            <table>
                <thead>
                    <tr>
                        <th colspan="14">
                            <h1>DETALLE DE LOS BIENES A SER INTERNADOS</h1>
                        </th>
                    </tr>
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
    </body>
 </html>