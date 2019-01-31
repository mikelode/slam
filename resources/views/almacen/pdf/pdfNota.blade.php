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
                height: 50px;
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
                        {{ config('slam.ENTIDAD_PROV') }} <br>
                        RUC: {{ config('slam.ENTIDAD_RUC') }}
                    </div>
                </div>
                <div class="title">
                    <h5 style="text-align: center;">ACTA DE RECEPCION Y CONFORMIDAD DE BIENES <br> NOTA DE ENTRADA <br> {{ $data[0]->ing_giu }}</h5>
                </div>
            </div>
            <div class="content">
                <?php
                    //$date = new DateTime($data[0]->ingresos[0]->pint_hora);
                    $date = new DateTime($data[0]->ing_hora);
                ?>
                <div class="parrafo">
                    En <a href="#" class="modificar">LUGAR DE ENTREGA</a>, del {{ config('slam.ENTIDAD_PIE') }} provincia de La Convención, Departamento de Cusco,
                    siendo las horas <a href="#" class="modificar">{{ $date->format('H:i a')  }}</a>
                    del día <a href="#" class="modificar">{{ date("d-m-Y",strtotime($data[0]->ing_fecha)) }}</a>,
                    estando presente ante el suscrito las siguientes personas:
                    {{ $data[0]->jefe_profesion.' - '.$data[0]->jefe_nombres.' '.$data[0]->jefe_apaterno.' '.$data[0]->jefe_amaterno }} identificado con
                    DNI N° {{ $data[0]->jefe_dni }} (Jefe de {{ $data[0]->nombre }}),
                    <a href="#" class="modificar"> {{ !$nea->isEmpty()?$nea[0]->nea_dador:'NOMBRE DEL QUE ENTREGA' }} </a>
                    identificado con DNI N° <a href="#" class="modificar"> {{ !$nea->isEmpty()?$nea[0]->nea_dniDador:'DNI DEL QUE ENTREGA' }} </a>,
                    se procede a la conformidad de entrega de materiales con el detalle siguiente.
                    <br>
                    <b>PRIMERO.-</b> Se hizo la entrega de los siguientes bienes:
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
                    @foreach($data[0]->inventario as $key=>$b)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <!--<td> $b->pintp_cant }}</td>-->
                            <td>{{ $b->prod_recep }}</td>
                            <td>{{ $b->prod_medida }}</td>
                            <td style="text-align: left; padding-left: 5px;">{{ $b->prod_desc }}</td>
                            <td>{{ $b->prod_marca }}</td>
                            <td>{{ number_format((float)$b->prod_precio,4,'.',',') }}</td>
                            <td>{{ number_format((float)$b->prod_costo,2,'.',',') }}</td>
                        </tr>
                        <?php $suma += ($b->prod_costo)  ?>
                    @endforeach
                        <tr>
                            <td colspan="6">TOTAL INGRESADO:</td>
                            <td>{{ number_format($suma,2,'.',',') }}</td>
                        </tr>
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