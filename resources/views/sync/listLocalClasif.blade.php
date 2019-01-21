<table class="table table-condensed">
    <thead>
    <tr>
        <th>SF</th>
        <th>FF</th>
        <th>CG</th>
        <th>PIM</th>
        <th>CERT</th>
        <th>SALDO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $dt)
        <tr>
            <td>{{ $dt->ptoSecFun }}</td>
            <td>{{ $dt->ptoRubro }}</td>
            <td>{{ $dt->ptoClasificador }}</td>
            <td align="right">{{ number_format($dt->ptoPim,2,'.',',') }}</td>
            <td align="right">{{ number_format($dt->ptoCertif,2,'.',',') }}</td>
            <td align="right">{{ number_format($dt->ptoPim - $dt->ptoCertif,2,'.',',') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>