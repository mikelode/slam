<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>

        @page { margin: 40px 25px 100px 35px; padding-bottom:80px;  }

        .header {
            height: 285px;
            position: fixed;
            left: 0px;
            top: 0px;
            right: 0px;
            margin-bottom: 50px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            /*font-family: "Times New Roman";*/
        }

        .footer {
            position: fixed;
            bottom: -1cm;
            width: 100%;
            font-size: 10px;
            display: inline-block;
            height: 3cm;
            align: center;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .logo{
            width: 90px;
            float: left;
            display: inline-block;
            margin-top: -30px;
        }

        .version{
            width: 170px;
            float: right;
            text-align: right;
            font-size: 7px;
        }
        hr{height: 0px;border: 1px solid #666;}
        table {
            border-collapse: collapse;
            padding: 0px;
            margin: 0px;
        }

        th.dll {
            border-style:solid;
            border-width:1px;
            border-color:#000000;
            padding: 5px 0px;
            font-size: 12px;
            background: #e2e2e2;
        }

        td.dll {
            border-style:solid;
            border-width:1px;
            border-color:#444444;
            padding: 0px;
            font-size: 12px;
            text-align: center;
            font-family:  Arial, sans-serif;
            /*font-family: "Times New Roman"*/
            width: 10px;
        }

        td.dll-wow{
            border-style:solid;
            border-width:1px;
            border-color:#444444;
            padding: 0px;
            font-size: 12px;
            text-align: center;
            font-family:  Arial, sans-serif;
        }

        td.lefts {
            text-align: left;
            padding-left: 2px;;
        }
        td.rights  {
            text-align: right;
            padding-right: 2px;;
        }
        td.centers  {
            text-align: center;
            align-content: center;
            align:center ;

        }
        table.entidad {
            text-align: center;
            align:center;
        }
        .entidadMuni {
            font-size: 15px;
            font-weight: bold;
            align:center;
        }

        td.line {
            border-bottom: 0px #000000 dashed;
            padding: 2px 0px;
            width: 690px;
            padding-bottom: 0px;
        }

        td.lineB {
            border-bottom: 1px #000000 dashed;
            padding: 2px 0px;
            width: 600px;
            padding-bottom: 0px;
        }

        .pagenum:before {
            content: counter(page);
        }

        .titulo{
            font-size: 18px;
            border: 3px #444 solid;
            padding: 3px;
            margin: 2px;;
            background: #efefef;
            border-radius: 15px;
            font-family:  Helvetica;
            text-align: center;
            width: 270;
        }
        .pp > p
        {
            margin: 0px;
        }


        .info {
            font-size: 12px;
            border: 1px #444 solid;
            padding: 0px 0px 0px 10px;
            margin: 2px;;
            background: #FEFEFE;
            border-radius: 10px;
            font-family: Arial, sans-serif;
            /*font-family: "Times New Roman";*/
            text-align: center;
            font-weight:normal;
        }

        .labels{
            font-size: 11px;
            font-weight: bold;
        }
    </style>

    <title>Orden de Servicio</title>
</head>

<body style="margin-top: 275px;">

<div class="header" style="font-size: 11px ; ">


    <table style="table-layout: fixed;" width="100%">
        <tr valign="top">
            <td width="23%">
                <div class="logo">
                    <img src="{{ config('slam.APP_LOGO') }}" width="120px" height="120" style="margin-left: 0px;">
                </div>
            </td>
            <td width="54%">
                <table class="entidad" style="table-layout: fixed;" width="100%"  >
                    <tr>
                        <td width="100%" class="entidadMuni"  align="center" style="font-size:18px; font-family: Helvetica, Arial , sans-serif ; font-weight: normal">{{ config('slam.APP_ENTIDAD') }}<td>
                    </tr>
                    <tr>
                        <td class="entidadMuni" style="font-size: 12px;"  align="center">RUC:  {{ config('slam.ENTIDAD_RUC') }}  </td>
                    </tr>
                    <tr>
                        <td align="center" class="centers">
                            <div class="titulo entidadMuni" style="margin: 0 auto; border-radius: 15px;font-size:20px;font-weight: bold; font-family: Helvetica, Arial , sans-serif ; margin-top:2px; MARGIN-bottom:-10px;">
                                ORDEN DE SERVICIO
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="23%">
                <table border="1" cellpadding="5px" style="margin: -15px 0 0 0;">
                    <tr>
                        <td align="center">Nro</td>
                        <td align="center">Fecha</td>
                    </tr>
                    <tr>
                        <td align="center">
                            <div style="font-weight: bold; font-size: 20px; margin-top:-5px;"  >
                                {{ explode('-',$ReturnData["OS"][0]->osCodigo)[1]  }}
                            </div>
                        </td>
                        <td align="center">
                            {{ $ReturnData["OS"][0]->osFecha }}
                        </td>
                    </tr>
                </table>
                <table style="margin-top: 10px;" cellpadding="4px">
                    <tr>
                        <td> REG.SIAF:</td>
                        @if(count($ReturnData['SIAF']) == 0)
                            <td> .......................  </td>
                        @else
                            <td> {{ substr($ReturnData['SIAF'][0]->expExpCod,-5) }}  </td>
                        @endif
                    </tr>
                    <tr>
                        <td> CERTIFIC:</td>
                        <td>   .......................  </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="info">
        <table style="table-layout: fixed;" width="100%">
            <tr ><td colspan="6">   {{  $ReturnData["OS"][0]->osMotivo   }}</td></tr>
            <tr>
                <td width="15%" style="font-size:12px;">
                    <label class="labels"> RAZON SOCIAL </label>
                </td>
                <td width="1%">:</td>
                <td style="overflow: hidden;">
                    <label class="labels" style="font-size: 14px; font-weight:bold; white-space: nowrap;">
                    {{  $ReturnData["OS"][0]->osRazon    }}
                    </label>
                </td>
                <td width="5%" align="right"> <label class="labels" > RUC </label>
                </td>
                <td width="1%">:</td>
                <td width="15%"><label CLASS="labels" style="font-size: 16px;">   {{  $ReturnData["OS"][0]->osRUC    }}   </label></td>
            </tr>
            <tr>
                <td style="font-size:11px; font-weight:normal;">
                    <label class="labels" >  DIRECCION </label>
                </td>
                <td>:</td>
                <td colspan="4" style="white-space: nowrap; overflow: hidden;">{{  $ReturnData["RUC"][0]->Direccion    }}</td>
            </tr>
            <tr>
                <td style="font-size:11px; font-weight:normal;">
                    <label class="labels" >  GLOSA </label>
                </td>
                <td>:</td>
                <td colspan="4">
                    {{  $ReturnData["OS"][0]->osGlosa   }}
                </td>
            </tr>
            @if (strlen(  $ReturnData["OS"][0]->osMotivo ) < 4 	)
                <tr >
                    <td style="border-bottom: solid #0f0f0f"> <label class="labels">  LUGAR ENTREGA</label>    </td>
                    <td style="border-bottom: solid #0f0f0f">:</td>
                    <td style="border-bottom: solid #0f0f0f; white-space: nowrap; overflow: hidden;">{{  $ReturnData["OS"][0]->osLugar  }}</td>
                    <td style="border-bottom: solid #0f0f0f" align="right"> <label class="labels"> TEL. </label>   </td>
                    <td style="border-bottom: solid #0f0f0f">:</td>
                    <td style="border-bottom: solid #0f0f0f; white-space: nowrap; overflow: hidden;">{{  $ReturnData["RUC"][0]->Telefono   }}</td>
                </tr>
            @endif

            <tr>
                <td colspan="6">
                    <label class="labels">  FACTURAR A NOMBRE DE LA </label>
                    {{ config('slam.APP_ENTIDAD') }} CON RUC:
                    <strong>{{ config('slam.ENTIDAD_RUC') }}</strong>
                </td>
            </tr>
        </table>
    </div>
    <div class="info">
        <table width="100%" style="table-layout: fixed;">
            <tr >
                <td width="14.8%">
                    <label class="labels"> DEPENDENCIA </label>

                </td>
                <td width="1%">:</td>
                <td style="white-space: nowrap; overflow: hidden;">( {{  $ReturnData["OS"][0]->osDepCod    }}  ) {{  $ReturnData["OS"][0]->osDepDsc    }}</td>
            </tr>
            <tr >
                <td class="line" STYLE="font-size:11px;">
                    <label class="labels"> SEC FUN </label>

                </td>
                <td>:</td>
                <td style="white-space: nowrap; overflow: hidden;">
                    @if(substr($ReturnData["OS"][0]->osSecFunCod,-1) == 'M')
                        @foreach($ReturnData["OSAbsClasf"] as $key=>$ReqDll)
                            Sec.Fun. ({{ $ReqDll->secfun }}) - Rubro: {{ $ReqDll->rubro }},
                        @endforeach
                    @else
                        {{ '(' . $ReturnData["OS"][0]->osSecFunCod  . ') '  }} {{  $ReturnData["OS"][0]->osSecFunDsc    }}
                    @endif
                </td>
            </tr>
            <tr >
                <td class="line" STYLE="font-size:11px;">
                <label class="labels"> RUBRO </label>

                </td>
                <td>:</td>
                <td style="white-space: nowrap; overflow: hidden;">( {{  $ReturnData["OS"][0]->osRubroCod    }} ) {{  $ReturnData["OS"][0]->osRubroDsc    }}</td>
            </tr>
            <tr >
                <td class="line" STYLE="font-size:11px;">
                <label class="labels"> REFERENCIA </label>

                </td>
                <td>:</td>
                <td style="white-space: nowrap; overflow: hidden;">{{  $ReturnData["OS"][0]->osRef    }}</td>
            </tr>
        </table>
    </div>

</div>
<div class="footer" align="center"  style="font-size: 11px;">   <!-- ** DATOS FIRMAS ****************************************** -->
    <table border="1">
        <thead>
        <tr style="background: #eee; font-size:12px;"> <th width="210px" align="center"> JEFE DE ADQUISICIONES </th> <th width="210px"  align="center"> JEFE DE LOGISTICA </th>  <th width="270px" align="center">    CONFORMIDAD DEL SERVICIO </th>  </tr>
        </thead>
        <tbody>
        <tr valign="bottom"> <td height="60px" align="center"> </td> <td   align="center"> </td>  <td align="center">
                <table>
                    <tr ><td width="15px"> </td>     <td  style="height: 40px;"> <strong>LOS TRABAJOS SON CONFORMES</strong></td> <td >  </td></tr>
                    <tr> <td width="15px"> </td>    <td > ......../........../.............. </td>  <td >    ............................................. </td></tr>
                </table>
            </td>  </tr>
        <tr><td colspan="3" style="font-size: 10px;">
                NOTA: Esta Orden es nula sin la firma del Jefe de Logística y Jefe de Adquisiciones.
                La Orden de Servicio debe tener su informe y comprobante de pago válido por la SUNAT en original y copia. Nos reservamos el derecho de no
                reconocer los trabajos que no esten de acuerdo a nuestros requerimientos, de conformidad a la ley 30225 y su Reglamento.
            </td></tr>
        </tbody>
    </table>
    <hr style="width: auto; " >
    <span style="font-size: 9px;"> {{ config('slam.ENTIDAD_PIE') }}  -    Página <span class="pagenum"></span></span>
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




<table  style="table-layout: fixed;" width="100%">
    <thead>
    <tr>
        <th ALIGN="center" class="dll" width="3%">Nro</th>
        <th ALIGN="center" class="dll" width="5%">Cant.</th>
        <th ALIGN="center" class="dll" width="6%">Und.</th>
        <th ALIGN="center" class="dll" width="10%">Clasf.</th>
        <th class="dll"  width="370px"  > Descripción </th>
        <th ALIGN="center" class="dll" width="10%">Marca</th>
        <th ALIGN="center" class="dll" width="8%">P.Unit.</th>
        <th ALIGN="center" class="dll" width="8%">Sub-total</th>
    </tr>
    </thead>
    <tbody>
    <?php  $Total=0; $Item =1 ;?>
    @foreach($ReturnData["OSDll"] as $key=>$OSDll)
        <tr class="dll">
            <td ALIGN="center" class="dll-wow"><?php echo $Item++ ;?></td>
            <td ALIGN="center" class="dll-wow">  {{ $OSDll->dllCant     }}</td>
            <td ALIGN="center" class="dll-wow">  {{ $OSDll->dllUndAbrv  }}</td>
            <td ALIGN="center" class="dll-wow">  {{ $OSDll->dllClasfCod }}</td>
            <td ALIGN="left" class="dll-wow lefts" style="padding-left: 6px; "  >   <?php echo strtoupper ($OSDll->dllProdDsc )." --:".  strtoupper ($OSDll->dllProdEspf ) ?></td>
            <td ALIGN="center" class="dll-wow" >   {{ $OSDll->dllMarca   }}</td>
            <td align="center" class="dll-wow">  <?php  echo number_format(floatval( $OSDll->dllPrecio ),2,'.',',') ;?></td>
            <td ALIGN="right" class="dll-wow rights">   {{ number_format($OSDll->dllTotal,2,'.',',')     }}</td>
        </tr>
        <?php  $Condicion=$OSDll->dllTotal;  ?>
        <?php  $Total+=$OSDll->dllTotal;  ?>
    @endforeach

    <!--  <tr class="dll">
                   <td ALIGN="center" class="dll" colspan="4"></td>
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  > =============== ============= ==========</td>
                   <td ALIGN="center" class="dll" colspan="3">  </td>
              </tr>
-->
    </tbody>
</table>


<div  style=" padding-left:55px; padding-right:10px ;font-size:11px; font-family: Helvetica, Arial, sans-serif; border:1px solid #000000;" >
    {!! $ReturnData["OS"][0]->osCondicion !!}
</div>

<table style="table-layout: fixed;" width="100%" border="1">
    <tbody>
    <!-- <tr class="dll">
                   <td ALIGN="center" class="dll" colspan="4"></td>
                   <td ALIGN="left" colspan="4" class="dll lefts pp" style="padding-left: 6px; font-size:9.5px; font-weight:bold;  "  >  {!! $ReturnData["OS"][0]->osCondicion !!} </td>

              </tr>
        -->

    <!--  @for ($i = 0; $i < 1-$Item ; $i++)
        <tr class="dll">
             <td ALIGN="center" class="dll" colspan="4" > &nbsp;&nbsp; </td>
                   <td ALIGN="left " class=" lefts dll" style="padding-left: 6px;"  > </td>
				   <td ALIGN="center" colspan="3" class="dll">  </td>

                            </tr>
         @endfor
            -->

    <tr style="text-align:left;">
        <td  class="dll-wow" colspan="1" width="80%" align="left" style="font-size: 12px; font-weight: bold;text-align:left; padding-left: 3px;" > Son: {{ numtoletras($Total) }}  </td>
        <td colspan="3" class="dll-wow rights" align="right" style="font-size: 13px; font-weight: bold;" > TOTAL S/. <?php echo  number_format ($Total ,2);?>  </td>
    </tr>

    </tbody>
</table>

<table style="table-layout: fixed;" width="100%" border="1">
    <tr>
        <td width="24%" class="lefts dll-wow">
            <div style=" font-size: 10px; margin-left: 10px; font-weight:bold;">
                <div><strong>Resumen por Clasificador : </strong> </div>
                @foreach($ReturnData["OSAbsClasf"] as $key=>$ReqDll)
                    {{ $ReqDll->sfrub . ' | ' . $ReqDll->Clasf }}  = {{ $ReqDll->Total }}<br>
                @endforeach
            </div>
            <div style="margin-left: 10px"><strong>Total de Items :<?php echo --$Item;?> </strong> </div>
        </td>
        <td width="56%" class="lefts dll-wow"  valign="top">
            <label  class="labels"> OBSV :</label> <label style="font-size: 13px;">{{  $ReturnData["OS"][0]->osObsv  }} </label>
        </td>
        <td width="" class="rights dll-wow"  valign="center" style="font-size:10px;  font-weight:bold;">
            Elb:{{  $ReturnData["OS"][0]->osUsrID  }} <br> Imp: {{$ReturnData["Usr"] }}<br>
        </td>
    </tr>
</table>
</body>
</html>

<?php
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {

                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO  $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN  $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " CON  $xdecimales/100 Nuevos Soles "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

// END FUNCTION
?>