<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            size: 21.59cm 27.94cm;
        }
        .header {
            position: fixed;
            left: 0px;
            top: 0px;
            right: 0px;
        }
        .info{
            font-size: 12px;
            border: solid 1px #000000;
            border-radius: 5px;
            line-height: 10px;
            padding: 3px 10px 3px 10px;
            font-weight: bold;
            font-family: Courier, "Courier new", monospace;
        }
        .info label{
            float: left;
            display: inline-block;
        }
        .infoitem{
            padding: 1px 0 1px 0;
            border-bottom: 1px dotted;
            font-weight: bold;
        }
        body{
            font-family: Courier, "Courier new", monospace;
            font-weight: bold;
        }
        table, th, td {
            border: 1px solid black;
            font-size: 12px;
            border-collapse: collapse;
            text-align: center;
            height: 25px;
        }
        thead{
            background-color: #eaeaea;
        }
        label{
            display: inline-block;
            width: 110px;
            margin-right: 20px;
            /*font-weight: bold;*/
        }
        .logo{
            width: 100px;
            float: left;
            display: inline-block;
        }
        .sign{
            font-size: 10px;
            font-family: Courier, "Courier new", monospace;
            width: 35%;
            text-align: center;
            float: left;
            display: inline-block;
        }
        .slogan{
            position: absolute;
            height: auto;
            top: 0;
            left: 0;
        }
        .datehead{
            position: absolute;
            height: auto;
            top: 50px;
            right: 90px;
        }
        .datehead thead tr td, .datehead tbody tr td{
            font-size: 12px;
            padding: 0 2px 0 2px;
        }
        .title{
            height: 70px;
            margin-top: 30px;
            padding-left: 190px;
        }
        .title h3{
            box-shadow: 30px 10px 20px #aaa;
            border: solid 1px #000000;
            border-radius: 15px;
            width: 380px;
            height: 48px;
            background-color: #eaeaea;
        }
        .footer {
            position: fixed;
            bottom: 0;
            border-top: solid 1px;
            width: 100%;
            font-family: "Courier New", Courier, monospace;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }
        .pagenum:before {
            content: counter(page);
        }
        .firmas{
            width: 100%;
            page-break-inside: avoid;
        }
        .firmas table{
            width: 100%;
            margin-top: 20px;
        }

        .firmas table thead tr td{
            height: 8px;
            width: 25%;
            font-size: 12px;
        }
        .firmas table tbody tr td{
            height: 80px;
            font-weight: bold;
        }
    </style>
</head>
<body style="padding-top: 220px;">
<div class="header">
    <div class="slogan">
        <div class="logo">
            <img src="{{ asset(config('slam.APP_LOGO')) }}" style="height: 100px; width: 100px;">
        </div>
        <div class="sign">
            {{ config('slam.ENTIDAD_PIE') }}
            {{ config('slam.ENTIDAD_PROV') }} <br>
            RUC: {{ config('slam.ENTIDAD_RUC') }}
        </div>
    </div>
    <table class="datehead" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <td>Día</td>
            <td>Mes</td>
            <td>Año</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ \Carbon\Carbon::parse($operacion->topFecha)->day }}</td>
            <td>{{ \Carbon\Carbon::parse($operacion->topFecha)->month }}</td>
            <td>{{ \Carbon\Carbon::parse($operacion->topFecha)->year }}</td>
        </tr>
        </tbody>
    </table>
    <div class="title">
        <h3 style="text-align: center;">CONSTANCIA TRÁMITE INTERNO <br> {{  substr($operacion->topId, -4)  }}</h3>
    </div>
    <h6 style="padding: 0; margin: 10px 0 0 0;">DATOS GENERALES</h6>
    <div class="info">
        <div class="infoitem">
            <label>REMITENTE</label>:
            {{ $emisor->tlsDni . ' - ' . $emisor->tlsNombre . ' ' . $emisor->tlsAPaterno . ' ' . $emisor->tlsAMaterno }}
            <br>
        </div>
        <div class="infoitem"><label>ENVIADO A</label>: {{ $operacion->topUsrTarget . ' - ' . $operacion->topTargetName }}<br></div>
        <div class="infoitem"><label></label>&nbsp; {{ $operacion->topTargetDepdsc }}<br></div>
        <div class="infoitem"><label>ASUNTO</label>: {{ $operacion->topMensaje }}<br></div>
        <label><!-- fix --></label>
    </div>
</div>
<div class="footer">
    <div style="float: left; display: inline-block; width: 90%;">
        {{ config('slam.ENTIDAD_PIE') }}, {{ \Carbon\Carbon::now()->toDateTimeString() }}
    </div>
    Página <span class="pagenum"></span>
</div>
<div class="content">
    <h6 style="padding: 0; margin: 0;">DOCUMENTOS A SER TRAMITADOS</h6>
    <table class="table" style="table-layout: fixed;" width="100%">
        <thead>
        <tr>
            <td width="5%">N°</td>
            <td width="15%">DOCUMENTO</td>
            <td width="15%">CODIGO</td>
            <td width="50%">NOTA</td>
            <td width="15%">OTROS: _______</td>
        </tr>
        </thead>
        <tbody>
        @foreach($documentos as $key=>$doc)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $doc->tlbTypeDoc }}</td>
                <td>{{ $doc->tlbCodDoc }}</td>
                <td>{{ $doc->tlbSituacion }}</td>
                <td> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="firmas">
    <table>
        <tbody>
        <tr>
            <td style="vertical-align: bottom">
                Fecha envío: ......./....../.......
            </td>
            <td style="vertical-align: bottom">
                Fecha recepción: ......./....../.......
            </td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <td>REMITENTE</td>
            <td>
                RECEPTOR
            </td>
        </tr>
        </thead>
    </table>
</div>
</body>
</html>