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
                border: 0.5px solid black;
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
        <div style="display: inline-block; text-align: center; font-size: 10px;">
            {{ config('slam.ENTIDAD_PROV') }}<br>
            {{ config('slam.APP_ENTIDAD') }}<bR>
            {{ config('slam.ENTIDAD_RUC') }}<br>
        </div>
    </div>
    <div style="position: absolute; right: 10px;">
        <img src="{{ asset(config('slam.APP_LOGO')) }}" alt="" width="80">
    </div>
    <table style="width:100%">
        <thead>
        <tr>
            <td>
                <h2>REPORTE DE PECOSAS <BR> POR SECUENCIA FUNCIONAL</h2>
            </td>
        </tr>
        </thead>
    </table>

    @foreach($data as $key => $sf)

        <table class="table" style="table-layout: fixed" width="100%" cellspacing="5" cellpadding="5">
            <caption style="padding-top: 15px;">
                <div style="text-align: left; font-family: 'Bree Serif', serif; font-size: 0.75em;">
                    {{ substr($key,-3) }} -
                    {{ strtoupper( $sf[0]->rptSf ) }}
                </div>
            </caption>
            <thead>
            <tr>
                <th width="2%">N°</th>
                <th width="5%">SIAF</th>
                <th width="5%">META</th>
                <th>PROVEEDOR</th>
                <th width="8%">NRO O/C</th>
                <th width="8%">FECHA O/C</th>
                <th width="8%">IMPORTE</th>
                <th width="8%">INTERNAMIENTO</th>
                <th width="8%">NRO PECOSA</th>
                <th width="8%">FECHA PECOSA</th>
                <th width="18%">RECEPCIONADO POR</th>
                <th width="7%">IMPORTE</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sf as $i=>$item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->rptSiaf }}</td>
                    <td>{{ substr($item->rptSfID,-3) }}</td>
                    <td>{{ $item->rptRuc }}</td>
                    <td>{{ $item->rptOcid }}</td>
                    <td>{{ $item->rptOcfecha }}</td>
                    <td style="text-align: right">{{ number_format($item->rptOcmonto,2) }}</td>
                    <td>{{ $item->rptInternamiento }}</td>
                    <td>{{ $item->rptPcs }}</td>
                    <td>{{ $item->rptPcsfecha }}</td>
                    <td>{{ $item->rptSolicitante }}</td>
                    <td style="text-align: right">{{ number_format($item->rptPcsmonto,2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endforeach
    </body>
 </html>