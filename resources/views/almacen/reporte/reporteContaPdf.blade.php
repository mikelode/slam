<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 30px 50px 50px 50px; }
        .header {
            height: 220px;
            position: fixed;
            left: 0px;
            top: 0px;
            right: 0px;
            height: auto;
        }
        .info{
            font-size: 8px;
            border: solid 1px #000000;
            border-radius: 5px;
            line-height: 10px;
            padding: 3px 10px 3px 10px;
        }
        body{
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            /*page-break-inside: avoid !important;*/
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            /*height: 40px;*/
        }
        thead{
            display: table-header-group;

        }
        thead th{
            background-color: #eaeaea;
            font-size: 10px;
            background-color: rgba(0, 244, 234, 0.33);
        }
        thead td{
            border-top: hidden;
            border-left: hidden;
            border-right: hidden;
            color: white;
            background-color: #00a7d0;
        }
        tbody td{
            font-size: 10px;
        }
        tfoot{
            display: table-row-group
        }
        tfoot td{
            font-size: 10px;
            font-weight: bold;
            color: blue;
            text-transform: uppercase;
        }
        tr{
            page-break-inside: avoid
        }
        label{
            display: inline-block;
            width: 90px;
            margin-right: 20px;
            /*font-weight: bold;*/
        }
        .logo{
            width: 100px;
            float: left;
            display: inline-block;
        }
        .sign{
            font-size: 8px;
            font-family: Arial, Helvetica, sans-serif;
            width: 23%;
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
        }
        .footer {
            position: fixed;
            bottom: 0;
            border-top: solid 1px;
            width: 100%;
            font-family: "Courier New", Courier, monospace;
            font-size: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div style="position: fixed; top: 10px">
    <div style="display: inline-block; text-align: center;">
        {{ config('slam.ENTIDAD_PROV') }}<br>
        {{ config('slam.APP_ENTIDAD') }}<bR>
        {{ config('slam.ENTIDAD_RUC') }}<br>
    </div>
</div>
<div style="position: absolute; right: 10px;">
    <img src="{{ asset(config('slam.APP_LOGO')) }}" alt="">
</div>
<table style="width:100%">
    <thead>
    <tr>
        <td>
            <h1>REPORTE DE CONCILIACIÓN - DETALLADO</h1>
            <h3>DEL {{ $dateFrom }} AL {{ $dateTo }}</h3>
        </td>
    </tr>
    </thead>
</table>


@foreach($cuentas as $i => $cuenta)

    @if(!is_null($cuenta->rptCta))
    <table class="table" style="table-layout: fixed; width:100%">
        <caption style="padding-top: 5px">
            <h5 style="text-align: left; font-size: 1.2em;">
                {{ substr($cuenta->rptCta,0,4) . '.' . substr($cuenta->rptCta,4) }} -
                {{ strtoupper( $cuenta->rptCtadsc ) }}
            </h5>
        </caption>
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th width="50%"></th>
            <th colspan="4">ENTRADA</th>
            <th colspan="3">SALIDA</th>
            <th></th>
        </tr>
        <tr>
            <th>N°</th>
            <th>META</th>
            <th>EXP SIAF</th>
            <th>DESCRIPCION PRODUCTO</th>
            <th>GI</th>
            <th>OC</th>
            <th>CANT</th>
            <th>C.T.</th>
            <th>PECOSA</th>
            <th>CANT</th>
            <th>C.T.</th>
            <th>SALDO TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $totali = 0;
            $totals = 0;
        ?>
        @foreach($data[$cuenta->rptCta] as $key=>$item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->rptSf }}</td>
                <td>{{ $item->rptSiaf }}</td>
                <td style="text-align: left">{{ $item->rptDscprod }}</td>
                <td>{{ $item->rptIngreso }}</td>
                <td>{{ $item->rptOC }}</td>
                <td>{{ $item->rptCantI }}</td>
                <td>{{ number_format($item->rptMontoI,2) }}</td>
                <td>{{ $item->rptSalida }}</td>
                <td>{{ $item->rptCantS }}</td>
                <td>{{ number_format($item->rptMontoS,2) }}</td>
                <td>{{ $item->rptMontoI - $item->rptMontoS }}</td>
            </tr>
            <?php
            $totali = $totali + $item->rptMontoI;
            $totals = $totals + $item->rptMontoS;
            ?>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6"></td>
            <td>Total:</td>
            <td>{{ number_format($totali,2) }}</td>
            <td></td>
            <td>Total:</td>
            <td>{{ number_format($totals,2) }}</td>
            <td></td>
        </tr>
        </tfoot>
    </table>
    @endif
@endforeach
</body>
</html>