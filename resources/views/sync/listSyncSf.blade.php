<table class="table table-condensed">
    <thead>
    <tr>
        <th>Año</th>
        <th>Ejecutora</th>
        <th>Sec.Fun</th>
        <th>Programa</th>
        <th>Subprograma</th>
        <th>Act/Proy</th>
        <th>Finalidad</th>
        <th>Nombre</th>
    </tr>
    </thead>
    <tbody>
    @foreach($result as $rs)
        <tr>
            <td>{{ $rs['year'] }}</td>
            <td>{{ $rs['ejec'] }}</td>
            <td>{{ $rs['sf'] }}</td>
            <td>{{ $rs['prog'] }}</td>
            <td>{{ $rs['subprg'] }}</td>
            <td>{{ $rs['actpry'] }}</td>
            <td>{{ $rs['fin'] }}</td>
            <td>{{ $rs['name'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>