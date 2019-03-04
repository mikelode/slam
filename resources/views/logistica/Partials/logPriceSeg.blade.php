<table class="table table-condensed" cellpadding="0" cellspacing="0" width="100%" style="font-size: smaller;">
    <tbody>
    <tr>
        <td>
            <table class="table table-condensed" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="5">REQUERIMIENTOS</th>
                </tr>
                <tr>
                    <th>RQ</th>
                    <th>PROD</th>
                    <th>ESPECIF</th>
                    <th>UND</th>
                    <th>PRECIO</th>
                    <th>META</th>
                </tr>
                </thead>
                <tbody>
                @foreach($precios["RQ"] as $prod)
                    <tr>
                        <td>{{ $prod->prodDoc }}</td>
                        <td>{{ $prod->prodDsc }}</td>
                        <td>{{ $prod->prodEsp }}</td>
                        <td>{{ $prod->prodUnd }}</td>
                        <td>{{ $prod->prodPrecio }}</td>
                        <td>{{ $prod->prodSf }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-condensed" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="5">CUADRO COMPARATIVO</th>
                </tr>
                <tr>
                    <th>CC</th>
                    <th>PROD</th>
                    <th>ESPECIF</th>
                    <th>MARCA</th>
                    <th>UND</th>
                    <th>PRECIO</th>
                    <th>META</th>
                    <th>RUC</th>
                </tr>
                </thead>
                <tbody>
                @foreach($precios["CC"] as $prod)
                    <tr>
                        <td>{{ $prod->prodDoc }}</td>
                        <td>{{ $prod->prodDsc }}</td>
                        <td>{{ $prod->prodEsp }}</td>
                        <td>{{ $prod->prodMarca }}</td>
                        <td>{{ $prod->prodUnd }}</td>
                        <td>{{ $prod->prodPrecio }}</td>
                        <td>{{ $prod->prodSf }}</td>
                        <td>{{ $prod->prodProveedor }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-condensed" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="5">ORDEN DE COMPRA</th>
                </tr>
                <tr>
                    <th>OC</th>
                    <th>PROD</th>
                    <th>ESPECIF</th>
                    <th>MARCA</th>
                    <th>UND</th>
                    <th>PRECIO</th>
                    <th>META</th>
                    <th>RUC</th>
                </tr>
                </thead>
                <tbody>
                @foreach($precios["OC"] as $prod)
                    <tr>
                        <td>{{ $prod->prodDoc }}</td>
                        <td>{{ $prod->prodDsc }}</td>
                        <td>{{ $prod->prodEsp }}</td>
                        <td>{{ $prod->prodMarca }}</td>
                        <td>{{ $prod->prodUnd }}</td>
                        <td>{{ $prod->prodPrecio }}</td>
                        <td>{{ $prod->prodSf }}</td>
                        <td>{{ $prod->prodProveedor }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>