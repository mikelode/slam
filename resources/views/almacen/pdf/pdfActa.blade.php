<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- BOOTSTRAP -->
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!-- JQUERY -->
        <script type="text/javascript" src="{{ asset('plugins/jquery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- x-editable field -->
        <link href="{{ asset('plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js') }}" type="text/javascript"></script>

        <style>
            @page {
               margin: 15mm 16mm 27mm 16mm;
            }
            .page {
                border: 1px solid #a4a4a4;
                padding: 15px;
                -webkit-box-shadow: #000000 0px 0px 8px;
                -moz-box-shadow: #000000 0px 0px 8px;
                box-shadow: #000000 0px 0px 8px;
                background: #FFF;
                width: 180mm;
                margin: 20px;
            }
            .header {
                height: 70px;
                /*position: fixed;*/
                left: 0px;
                top: 0px;
                right: 0px;
            }
            body{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
            table.stable, th, td {
                border: 1px solid black;
                font-size: 8px;
                border-collapse: collapse;
                text-align: center;
                /*height: 40px;*/
            }
            table tbody tr{

            }
            thead{
                background-color: #eaeaea;
            }
            label{
                display: inline-block;
                width: 90px;
                margin-right: 20px;
                /*font-weight: bold;*/
            }
            .logo{
                float: left;
                display: inline-block;
            }
            .sign{
                font-size: 8px;
                font-family: Arial, Helvetica, sans-serif;
                width: 150px;
                text-align: center;
                float: left;
                display: inline-block;
            }
            .slogan{
                position: absolute;
                height: auto;
                top: 40px;
                left: 50px;
            }
            .title{
                height: 50px;
                margin-top: 50px;
                padding-left: 180px;
            }
            .title h5{
                /*box-shadow: 30px 10px 20px #aaa;*/
                border: solid 1px #000000;
                border-radius: 15px;
                width: 380px;
                height: 35px;
            }
            .parrafo{
                font-family: arial, sans-serif;
                font-size: 12px;
                line-height: 25px;
                text-align: justify;
                margin-bottom: 15px;
            }
            .firmas{
                width: 100%;
            }
            .firmas table{
                width: 100%;
                margin-top: 20px;
            }

            .firmas table thead tr td{
                height: 20px;
                width: 25%;
                font-size: 10px;
            }
            .firmas table tbody tr td{
                height: 50px;
            }
            a.modificar{
                border-bottom: none;
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="header">
                <div class="slogan">
                    <div class="logo">
                        <img src="{{ asset(config('slam.APP_LOGO')) }}" style="height: 70px; width: 70px;">
                    </div>
                    <div class="sign">
                        {{ config('slam.ENTIDAD_PIE') }}
                        {{ config('slam.ENTIDAD_PROV') }}
                        RUC: {{ config('slam.ENTIDAD_RUC') }}
                    </div>
                </div>
                <div class="title">
                    <h5 style="text-align: center;">ACTA DE RECEPCION Y CONFORMIDAD DE BIENES <br> {{ 'GI - '. substr ($data[0]->ing_giu,-4).'-'.substr($proceso->pint_cpi,-3) }}</h5>
                </div>
            </div>

           
            
            <div class="content">
                <?php
                    //$date = new DateTime($data[0]->ingresos[0]->pint_hora);
                    $date = new DateTime($proceso->pint_hora);
                ?>
                <div class="parrafo">
                    En <a href="#" class="modificar">LUGAR DE ENTREGA</a>, del Distrito de Vilcabamba, provincia de La Convención, Departamento de Cusco, siendo las horas
                    <a href="#" class="modificar">{{ $date->format('H:i a')  }}</a> del día <a href="#" class="modificar">{{ date("d-m-Y",strtotime($proceso->pint_fecha)) }}</a>,  estando presente ante el suscrito las siguientes personas:
                    {{ $data[0]->jefe_profesion.' - '.$data[0]->jefe_nombres.' '.$data[0]->jefe_apaterno.' '.$data[0]->jefe_amaterno }} identificado con DNI N° {{ $data[0]->jefe_dni }}
                    (Jefe de {{ $data[0]->nombre }}), <a href="#" class="modificar"> {{ !$applicant->isEmpty()?$applicant[0]->perNombres.' '.$applicant[0]->perAPaterno.' '.$applicant[0]->perAMaterno:'NOMBRE SOLICITANTE' }} </a>
                    identificado con DNI N° <a href="#" class="modificar"> {{ !$applicant->isEmpty()?$applicant[0]->reqSolicitante:'SOLICITANTE' }} </a> (<a href="#" class="modificar">Residente de Obra/Proyecto</a> - {{ $data[0]->oc_obra_destino }}), 
                    se procede a la conformidad de entrega de materiales con el detalle siguiente.
                    <br>
                    <b>PRIMERO.-</b> Se hizo la entrega de los bienes especificados  <a href="#" class="modificar"> en la orden de Compra N°  {{ substr (  $data[0]->oc_cod,-4) }} </a> , en beneficio del Obra/Proyecto : {{ $data[0]->oc_obra_destino }}. 
                    Materiales y/o Bienes entregados están conforme a la Orden de Compra que cumple con las características técnicas solicitadas.
                </div>
                <table class="stable" style="width:100%">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <!--<th>CANT</th>-->
                        <th>RECIBIDO</th>
                        <th>UND</th>
                        <th>DESCRIPCION</th>
                        <th>MARCA</th>
                        <th>PRECIO</th>
                        <th>TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $suma = 0; ?>
                    <!--foreach($data[0]->inventario as $key=>$b)-->
                    @foreach($bienes as $key=>$b)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <!--<td>{{ $b->pintp_cant }}</td>-->
                            <td>{{ $b->pintp_cantr }}</td>
                            <td>{{ $b->pintp_umedida }}</td>
                            <td style="text-align: left; padding-left: 5px;">{{ $b->pintp_desc }}</td>
                            <td>{{ $b->pintp_marca }}</td>
                            <td><?php  echo floatval( $b->pintp_precio) ;?></td>
                            <td>{{ number_format((float)$b->pintp_costo,2,'.',',') }}</td>
                        </tr>
                        <?php $suma += ($b->pintp_costo)  ?>
                    @endforeach


                    @if(!is_null($orden))
                        <tr>
                            <td colspan="6" style="text-align: right">SubTotal:</td>
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
                            //$igv = $suma
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: right">Descuento:</td>
                                <td>{{ number_format($orden->orcDescuento,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right">Envío:</td>
                                <td>{{ number_format($orden->orcEnvio,2,'.',',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right">IGV(%):</td>
                                <td>{{ number_format($igv ,2,'.',',') }}</td>
                            </tr>
                    @elseif($orden->orcIGV == 'NO')
                            <?php $igv = 0; ?>
                            @if($sumDetail > 0)
                                <tr>
                                    <td colspan="6" style="text-align: right">Descuento:</td>
                                    <td>{{ number_format($orden->orcDescuento,2,'.',',') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right">Envío:</td>
                                    <td>{{ number_format($orden->orcEnvio,2,'.',',') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right">IGV(%):</td>
                                    <td>{{ number_format($igv ,2,'.',',') }}
                                    </td>
                                </tr>
                            @endif
                        @endif
                        <tr>
                            <td colspan="6">TOTAL INGRESADO:</td>
                            <td>{{ number_format($suma - $descuento + $envio + $igv,2,'.',',') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6">TOTAL INGRESADO:</td>
                            <td>{{ number_format($suma,2,'.',',') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="parrafo">
                    <br>
                    <b>SEGUNDO.-</b> la presente se da por concluido a horas <a href="#" class="modificar">HORA (HH:MM am/pm)</a> del mismo día, firmando a continuación los presentes dando fe de lo entregado y conformidad a las caracteristicas Tecnicas del Requerimiento.
                </div>
                <div class="firmas">
                    <table>
                        <tbody>
                        <tr>
                            <td style="height: 10px;">Jefe Almacen</td>
                            <td style="height: 10px;">Rep. Área Usuaria</td>
                            <td style="height: 10px;">Supervisor</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $.fn.editable.defaults.mode = 'inline';
            $('.modificar').editable();
        </script>
    </body>
 </html>