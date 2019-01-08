<table class="table table-striped alm-table">
    <caption><h4>RESULTADOS DE SU CONSULTA:</h4></caption>
    <thead>
        <tr>
            <th></th>
            <th class="info" colspan="2">DATOS DE ENVIO</th>
            <th class="success" colspan="2">DATOS DE VERIFICACIÓN</th>
            <th class="warning" colspan="2">DATOS DE RECEPCIÓN</th>
            <th></th>
        </tr>
        <tr>
            <th>Documento</th>
            <th class="info"><span style="font-size: 15px;" class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
            <th class="info">Fecha y Hora</th>
            <th class="success"><span style="font-size: 15px;" class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
            <th class="success">Fecha y Hora</th>
            <th class="warning"><span style="font-size: 15px;" class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
            <th class="warning">Fecha y Hora</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $item)
            <tr>
                <td>{{ $item['tlbTypeDoc'] }} {{ $item['shortID'] }}</td>
                <td class="info">{{ $item['remitente']['tlsNombre'].' '.$item['remitente']['tlsAPaterno'].' '.$item['remitente']['tlsAMaterno'] }}</td>
                <td class="info">{{ \Carbon\Carbon::parse($item['remitente']['tlsFecha']) }}</td>
                @if($item['tlbTypeDoc'] == 'REQUERIMIENTO')
                    <td class="success">{{ $item['verificador']['tlvNombre'].' '.$item['verificador']['tlvAPaterno'].' '.$item['verificador']['tlvAMaterno'] }}</td>
                    <td class="success">{{ \Carbon\Carbon::parse($item['verificador']['tlvFecha']) }}</td>
                @else
                    <td class="success">::::</td>
                    <td class="success">::::</td>
                @endif
                <td class="warning">{{ $item['receptor']['tleNombre'].' '.$item['receptor']['tleAPaterno'].' '.$item['receptor']['tleAMaterno'] }}</td>
                <td class="warning">{{ \Carbon\Carbon::parse($item['receptor']['tleFecha']) }}</td>
                <td>{{ $item['tlbSituacion'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>