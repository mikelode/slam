<table class="table">
    <thead>
        <tr>
            <th style="width: 15px">Nro</th>
            <th>Producto</th>
            <th>Cant</th>
            <th>Und</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Costo</th>
            <th>Clasif</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key=>$item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ trim($item->ocdProd).': '.trim($item->cdtEspecif) }}</td>
                <td>{{ $item->cdtCant }}</td>
                <td>{{ $item->ocdUnd }}</td>
                <td>{{ $item->cdtMarca }}</td>
                <td>{{ $item->cdtPrecio }}</td>
                <td>{{ $item->cdtCant * $item->cdtPrecio }}</td>
                <td>{{ trim($item->ocdClsf) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>