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
                font-size: 8px;
                border-collapse: collapse;
                text-align: center;
                /*height: 40px;*/
            }
            thead{
                display: table-header-group;

            }
            thead th{
                background-color: #eaeaea;
            }
            thead td{
                border-top: hidden;
                border-left: hidden;
                border-right: hidden;
            }
            tfoot{
                display: table-row-group
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
        <table class="table" style="width:100%">
            <thead>
                <tr>
                    <td colspan="14">
                        <h1>REPORTE DE ALMACEN SEGUN SECUENCIA FUNCIONAL - NOTAS DE ENTRADA</h1>
                    </td>
                </tr>
                <tr>
                    <th colspan="4">SECUENCIA FUNCIONAL</th>
                    <th colspan="10">{{ !$data->isEmpty()?$data[0]->secDsc:'SIN NOTAS DE ENTRADA' }}</th>
                </tr>
                <tr>
                    <th>N°</th>
                    <th>SF</th>
                    <th>NEA</th>
                    <th>FECHA NEA</th>
                    <th>CODIGO PRODUCTO</th>
                    <th>PRODUCTO</th>
                    <th>CANT RECIB.</th>
                    <th>MEDIDA</th>
                    <th>PRECIO</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
                @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->SF }}</td>
                    <td>{{ $item->ing_giu }}</td>
                    <td>{{ $item->conf_fecha }}</td>
                    <td style="text-align: left">{{ $item->prod_cod }}</td>
                    <td>{{ $item->prod_desc }}</td>
                    <td>{{ $item->prod_recep }}</td>
                    <td>{{ $item->prod_medida }}</td>
                    <td>{{ $item->prod_precio }}</td>
                    <td>{{ $item->prod_costo }}</td>
                </tr>
                    <?php $total = $total + $item->prod_costo; ?>
                @endforeach
                <tr>
                    <td colspan="9" style="text-align: right">TOTAL</td>
                    <td>{{ $total }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </body>
 </html>