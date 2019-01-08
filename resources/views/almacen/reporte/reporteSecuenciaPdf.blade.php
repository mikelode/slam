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
                    <td colspan="15">
                        <h1>REPORTE DE ALMACEN SEGUN SECUENCIA FUNCIONAL</h1>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">SECUENCIA FUNCIONAL</th>
                    <th colspan="3"></th>
                    <th colspan="3">ENTRADA</th>
                    <th colspan="3">SALIDA</th>
                    <th colspan="3">SALDO FINAL</th>
                </tr>
                <tr>
                    <th>N°</th>
                    <th>SECUENCIA</th>
                    <th>FECHA</th>
                    <th>DOCUMENTO</th>
                    <th>ORDEN DE COMPRA</th>
                    <th>PRODUCTO</th>
                    <th>CANT</th>
                    <th>C.U</th>
                    <th>C.T.</th>
                    <th>CANT</th>
                    <th>C.U</th>
                    <th>C.T.</th>
                    <th>CANT</th>
                    <th>C.U</th>
                    <th>C.T.</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->Secuencia }}</td>
                    <td>{{ $item->Fecha }}</td>
                    <td>{{ $item->Internamiento }}</td>
                    <td>{{ $item->Orden }}</td>
                    <td style="text-align: left">{{ $item->Producto }}</td>
                    <td>{{ $item->Ingresado }}</td>
                    <td>{{ $item->Precio }}</td>
                    <td>{{ $item->Costo }}</td>
                    <td>{{ $item->Distribuido }}</td>
                    <td>{{ $item->Precio }}</td>
                    <td>{{ $item->costoDistrib }}</td>
                    <td>{{ $item->Stock }}</td>
                    <td>{{ $item->Precio }}</td>
                    <td>{{ $item->costoSaldo }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
 </html>