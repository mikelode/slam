<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page { margin: 10px 50px 50px 50px; }
            .header {
                height: 225px;
                position: fixed;
                left: 0px;
                top: 0px;
                right: 0px;
                height: auto;
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
                /*height: 40px;*/
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
                font-size: 11px;
                font-family: Courier, "Courier new", monospace;
                width: 28%;
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
                padding: 2px;
            }
            .title{
                height: 70px;
                margin-top: 30px;
                padding-left: 300px;
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
    <body style="margin-top: 245px;">
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
            <table class="datehead">
                <thead>
                    <tr>
                        <td>Día</td>
                        <td>Mes</td>
                        <td>Año</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($proceso[0]->pint_fecha)->day }}</td>
                        <td>{{ \Carbon\Carbon::parse($proceso[0]->pint_fecha)->month }}</td>
                        <td>{{ \Carbon\Carbon::parse($proceso[0]->pint_fecha)->year }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="title">
                <h3 style="text-align: center;">GUIA DE INTERNAMIENTO DE BIENES <br> {{ $guia->ing_giu }}</h3>
            </div>
            <h6 style="padding: 0; margin: 0;">DATOS GENERALES</h6>
            <div class="info">
                <div class="infoitem"><label>NRO CPI</label>: {{ $proceso[0]->pint_cpi }}<br></div>
                <div class="infoitem"><label>DEPEND. SOLIC.</label>: {{ $guia->oc_dep_destino }}<br></div>
                <div class="infoitem"><label>PROVEEDOR</label>: {{ $guia->oc_rucprovee.' : '.$guia->oc_proveedor }}<br></div>
                <div class="infoitem"><label>DOC. REF.</label>: {{ $guia->oc_docRef }}<br></div>
                <div class="infoitem"><label>ORDEN DE COMPRA</label>: {{ $guia->oc_cod }}<br></div>
                <div class="infoitem"><label>SECUENCIA FUNC.</label>: {{ $guia->oc_obra_destino }} <br></div>
                <div class="infoitem"><label>GUIA REMISION</label>: {{ $proceso[0]->pint_guiaremision }}<br></div>
                <div class="infoitem"><label>FACTURA</label>: {{ $guia->ing_factura }}<br></div>
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
            <h6 style="padding: 0; margin: 0;">DETALLE DE LOS BIENES A SER INTERNADOS</h6>
            <table class="table" style="width:100%">
                <thead>
                    <tr>
                        <td>N°</td>
                        <td>DESCRIPCION</td>
                        <td>CANT</td>
                        <td>UND</td>
                        <td>MARCA</td>
                        <td>PRECIO</td>
                        <td>CANT RECIBIDA</td>
                        <td>COSTO</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $convert = new \Logistica\Custom\NumberToLetterConverter();
                        $suma = 0;
                    ?>
                    @foreach($bienes as $key=>$b)
                    <tr>
                        <td style="width: 3%">{{ $key + 1 }}</td>
                        <td style="width: 52%; text-align: left; padding-left: 5px;">{{ $b->pintp_desc }}</td>
                        <td style="width: 5%">{{ $b->pintp_cant }}</td>
                        <td style="width: 5%">{{ $b->pintp_umedida }}</td>
                        <td style="width: 15%">{{ $b->pintp_marca }}</td>
                        <td style="width: 5%">{{ $b->pintp_precio }}</td>
                        <td style="width: 5%">{{ $b->pintp_cantr }}</td>
                        <td style="width: 10%"><?php echo  number_format ( $b->pintp_cantr * $b->pintp_precio  ,2) ?></td>
                    </tr>
                    <?php $suma += ($b->pintp_cantr * $b->pintp_precio)  ?>
                    @endforeach
                    @if(!is_null($orden))
                        <tr>
                            <td colspan="7" style="text-align: right">SUBTOTAL:</td>
                            <td>{{ number_format($suma,2,'.',',') }}</td>
                        </tr>
                        <?php
                            $envio = $orden->orcEnvio;
                            $descuento = $orden->orcDescuento;
                            $sumDetail = $orden->orcDescuento + $orden->orcEnvio;
                        ?>
                        @if($orden->orcIGV == 'SI')
                            <?php
                                $igv = ($suma + $envio - $descuento) * 0.18;
                            ?>
                            <tr>
                                <td colspan="7" style="text-align: right">DESCUENTO:</td>
                                <td>{{ number_format($orden->orcDescuento,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: right">ENVIO:</td>
                                <td>{{ number_format($orden->orcEnvio,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: right">IGV(%)</td>
                                <td>{{ number_format($igv * 0.18,2,'.',',') }}</td>
                            </tr>
                        @elseif($orden->orcIGV == 'NO')
                            <?php $igv = 0; ?>
                            @if($sumDetail > 0)
                                <tr>
                                    <td colspan="7" style="text-align: right">DESCUENTO:</td>
                                    <td>{{ number_format($orden->orcDescuento,2,'.',',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="text-align: right">ENVIO:</td>
                                    <td>{{ number_format($orden->orcEnvio,2,'.',',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="text-align: right">IGV(%)</td>
                                    <td>{{ number_format($igv * 0.18,2,'.',',') }}</td>
                                </tr>
                            @endif
                        @endif
                        <tr>
                            <td style="text-align: left" colspan="7">TOTAL GI: SON {{ $convert->to_word(number_format((float)($suma - $descuento +$envio + $igv),2,'.',''),'PEN') }}</td>
                            <td>{{ number_format($suma - $descuento +$envio + $igv,2,'.',',') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: left" colspan="7">TOTAL GI: SON {{ $convert->to_word(number_format((float)$suma,2,'.',''),'PEN') }}</td>
                            <td>{{ number_format((float)$suma,2,'.',',') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="8"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="firmas">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <thead>
                <tr>
                    <td>V°B° Almacén Central</td>
                    <td>Entregado por</td>
                    <td>Recibido por</td>
                    <td>Trasladado por</td>
                </tr>
                </thead>
            </table>
        </div>
    </body>
 </html>