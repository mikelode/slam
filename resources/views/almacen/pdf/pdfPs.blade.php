<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page { margin: 10px 20px 40px 20px; }
            .header {
                height: 220px;
                position: fixed;
                left: 0px;
                top: 0px;
                right: 0px;
            }
            .content{
                top: 215px;
                margin-bottom: 30px;
            }
            .footer {
                position: fixed;
                bottom: 0;
                /*border-top: solid 1px;*/
                width: 100%;
                font-family: "Courier New", Courier, monospace;
                font-size: 12px;
                display: inline-block;
                height: 60px;

            }
            body{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-weight: bold;
            }
            table, th, td {
                border: 1px solid black;
                font-size: 13px;
                border-collapse: collapse;
                text-align: center;
                font-family: monospace, serif;
                font-weight:bold;
                /*height: 90px;*/
            }
            thead{
                background-color: #eaeaea;
            }
            label{
                display: inline-block;
                width: 180px;
                margin-right: 20px;
                /*font-weight: bold;*/
            }
            .slogan{
                position: absolute;
                height: auto;
                top: 0;
                left: 0;
            }
            .logo{
                width: 100px;
                float: left;
                display: inline-block;
            }
            .sign{
                font-size: 12px;
                font-family: Courier, "Courier new", monospace;
                width: 200px;
                text-align: center;
                float: left;
                display: inline-block;
            }
            .title{
                float: left;
                height: 70px;
                margin-top: 20px;
                margin-bottom: 20px;
                padding-left: 320px;
            }
            .title h3{
                box-shadow: 10px 1px 5px #aaa;
                border: solid 1px #000000;
                border-radius: 15px;
                width: 400px;
                height: 50px;
                background-color: #eaeaea;
            }
            .info{
                display: inline-block;
                float: left;
                width: 75%;
                height: auto;
                font-size: 12px;
                border: solid 1px #000000;
                border-radius: 5px;
                line-height: 12px;
                padding: 3px 10px 3px 10px;
            }
            .infoitem{
                font-weight: bold;
                padding: 1px 0 1px 0;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                border-bottom: 1px dotted;
                margin: 1px 0 2px 0;
            }
            .infob{
                display: inline-block;
                width: 19%;
                font-size: 12px;
                font-weight: bold;
                border: solid 1px #000000;
                border-radius: 5px;
                line-height: 15px;
                padding: 3px 10px 3px 10px;
            }
            label.fecha{
                display: inline-block;
                width: 150px;
                /*margin-right: 10px;*/
                /*font-weight: bold;*/
            }
            .date{
                font-size: 14px;
                font-weight: bold;
                padding-top: 5px;
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
                margin-top: 0px;
            }

            .firmas table thead tr td{
                height: 20px;
                width: 25%;
                font-size: 12px;
            }
            .firmas table tbody tr td{
                height: 50px;
            }

        </style>
    </head>
    <body style="margin-top: 215px; margin-bottom: 20px;">
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
            <div class="title">
                <h3 style="text-align: center;">PEDIDO - COMPROBANTE DE SALIDA <br> {{ $proceso[0]->psal_pecosa }}</h3>
            </div>
            <h6 style="padding: 0; margin: 0; clear: both;">DATOS GENERALES</h6>
            <div class="info">
                <div class="infoitem"><label>DEPENDENCIA SOLIC.</label>: {{ $proceso[0]->dependencia_solic }}<br></div>
                <div class="infoitem"><label>NOMBRE DEL SOLICITANTE </label>: {{ $proceso[0]->psal_solicitante }}<br></div>
                <div class="infoitem"><label>SOLICITO ENTREGAR A</label>: {{ $proceso[0]->psal_receptor }}<br></div>
                <div class="infoitem"><label>CON DESTINO HACIA</label>: {{ $proceso[0]->psal_destino }}<br></div>
            </div>
            <div class="infob">
                <label class="fecha">Lugar y Fecha:</label><br>
                    <div class="date">VILCABAMBA, {{ date("d-m-Y",strtotime($proceso[0]->psal_fecha)) }}</div>
                <label class="fecha">-</label><br>
                <label class="fecha">-</label><br>
                <!--<label class="fecha">S. Prog:</label>-->
            </div>
        </div>
        <div class="footer">

        <div class="firmas">
            <table>
                <thead>
                    <tr>
                        <td>Solicitante</td>
                        <td>Jefe de Logística</td>
                        <td>Jefe de Almacén</td>
                        <td>Recibi Conforme</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>


         <!--   <div style="float: left; display: inline-block; width: 90%;">  -->
              
            </div>
          
            <script type='text/php'>
                if ( isset($pdf) ) {
                    $font = Font_Metrics::get_font('helvetica', 'normal');
                    $size = 12;
                    $y = $pdf->get_height() - 19;
                    $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width('1/1', $font, $size);
                    $pdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);
                }
            </script>
        </div>
        <div class="content">
            <h6 style="padding: 0; margin: 0;">LOS SIGUIENTES BIENES</h6>
            <table width="100%">
                <thead>
                    <tr>
                        <td width="2%">N°</td>
                        <td width="33%">DESCRIPCION</td>
                        <td width="3%">CANT ATENDIDA</td>
                        <td width="5%">UND</td>
                        <td width="7%">MARCA</td>
                        <td width="5%">PRECIO</td>
                        <td width="5%">OBSV</td>
                        <td width="5%">COSTO</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $suma = 0; ?>
                    @foreach($proceso[0]->productos_distribuidos as $key=>$b)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td style="text-align: left; padding-left: 5px;">{{ $b->psalp_desc }}</td>
                        <td>{{ $b->psalp_cant_atend }}</td>
                        <td>{{ $b->psalp_umedida }}</td>
                        <td>{{ $b->psalp_marca }}</td>
                        <td>  <?php  echo floatval( $b->psalp_precio ) ;?></td>
                        <td style="font-size:8px" >{{ $b->psalp_observacion }}</td>
                      <!--  <td>{{ number_format($b->psalp_cant_atend * $b->psalp_precio,2,'.',',')}}</td>-->
                        <td>{{ number_format($b->psalp_costo,2,'.',',')}}</td>
                    </tr>
                    <?php
                        $convert = new \Logistica\Custom\NumberToLetterConverter();
                       //$suma += ($b->psalp_cant_atend * $b->psalp_precio)
                        $suma += ($b->psalp_costo)
                    ?>
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
                                <td>{{ number_format($igv,2,'.',',') }}</td>
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
                                    <td>{{ number_format($igv,2,'.',',') }}</td>
                                </tr>
                            @endif
                        @endif
                        <tr>
                            <td style="text-align: left" colspan="7">TOTAL PECOSA: SON {{ $convert->to_word(number_format((float)($suma - $descuento +$envio + $igv),2,'.',''),'PEN') }}</td>
                            <td>{{ number_format($suma - $descuento +$envio + $igv,2,'.',',') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: left" colspan="7">TOTAL PECOSA: SON {{ $convert->to_word(number_format((float)$suma,2,'.',''),'PEN') }}</td>
                            <td>{{ number_format((float)$suma,2,'.',',') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="7" style="text-align: left; padding-left: 5px;">
                            {{ 'Referencia: '.$guia[0]->oc_docRef.' - Proviene de la OC N°: '.$guia[0]->oc_cod.' - Entregado por: '.$proceso[0]->psal_usu_despachador.' - Guía de Internamiento: '.$guia[0]->ing_giu.' - Guía de Remisión N°: '.$proceso[0]->psal_guiarem.' - Factura N°: '.$proceso[0]->psal_factura.' - Obs: '.$proceso[0]->psal_observacion }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="8"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        




    </body>
 </html>