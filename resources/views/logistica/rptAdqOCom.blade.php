<!DOCTYPE html>
<html>
<head>
 <style>

 @page { margin: 40px 25px 190px 35px;  }

.header {
  position: fixed;
  left: 0px;
  top: 0px;
  right: 0px;
  font-family: Arial;
  /*font-family: "Times New Roman";*/
}

.pp > p
{
  margin: 0px;
  
}
.footer {
  position: fixed;
  bottom: -3cm;
  width: 100%;
  font-size: 10px;
  display: inline-block;
  height: 3cm;
  align: center;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.logo{
  width: 100px;
  float: left;
  display: inline-block;
}

.version{
 width: 150px;
 float: right;
 text-align: right;
 font-size: 7px;
}
-hr{height: 0px;border: 1px solid #666;}
table {
 border-collapse: collapse;
 padding: 0px;
 margin: 0px;
}

th.dll {
   border-style:solid;
   border-width:1px;
   border-color:#000000;
   padding: 2px 0px;
   font-size: 11px;
   background: #e2e2e2;
 }

td.dll {
   border-style:solid;
   border-width:1px;
   border-color:#444444;
   padding: 2px 0 2px 0;
   font-size: 11.5px;
   text-align: center;
   font-family:  Arial, sans-serif;
  /*font-family: "Times New Roman"*/
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
  padding-right: 4px;
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
  border-bottom: 1px #000000 dashed;
  padding: 0px;
  width: 690px;
  padding-bottom: 1px;
}

td.lineB {
  border-bottom: 1px #000000 dashed;
  padding: 0px;
  width: 520px;
  padding-bottom: 1px;
}

.pagenum:before {
  content: counter(page);
}

.titulo{
   font-size: 18px;
   border: 3px #444 solid;
   padding: 3px;
   margin: 5px;;
   background: #efefef;
   border-radius: 15px;
   font-family:  Helvetica;
   text-align: center;
   width: 270;
}

.info {
   border: 2px #999 solid;
   padding: 0px 0px 0px 10px;
   /*margin: 0px 0px 0px -5px;*/
   background: #FEFEFE;
   border-radius: 10px;
   font-family: Arial, sans-serif;
}

.labels{
  font-size: 11px;
  font-weight: normal;
    font-weight: bold;
}

.container{
}
</style>

<title>Orden de Servicio</title>
</head>

<body style="padding-top: 257px;">

  <div class="header" style="font-size: 11px ; ">
    <table>
    <tr valign="top">
       <td width="170px">
          <div class="logo">
            <img src="{{ config('slam.APP_LOGO') }}" width="120px" height="85" style="margin-left: 0px;">
          </div>
       </td>
       <td width="440px">
           <table style="border:0px solid #ccc">
              <tr>
              <td align="center">
                  <table class="entidad" style="margin-top:-10px"  >
                   <tr>
                       <td class="entidadMuni" align="center" style="font-size:18px; font-family: Helvetica, Arial , sans-serif ; font-weight: normal">
                       {{ config('slam.APP_ENTIDAD') }}
                       <td>
                   </tr>
                   <tr>
                       <td class="entidadMuni" align="center" style="font-size: 12px;"  align="left" >
                           RUC:  {{ config('slam.ENTIDAD_RUC') }}
                       </td>
                   </tr>
                   <tr>
                       <td align="center" class="centers">
                           <div >
                               <div class="titulo entidadMuni"  style="border-radius: 15px;font-size:18px;font-weight: bold; font-family: Helvetica, Arial , sans-serif ; margin-top:2px; MARGIN-bottom:-10px;">
                                   ORDEN DE COMPRA <br> GUIA DE INTERNAMIENTO
                               </div>
                           </div>
                       </td>
                   </tr>
                   </table>

              </td>
              </tr>
          </table>
       </td>
       <td width="170px">
           <table border="1" cellpadding="5px" style="margin: -15px 0 0 0;">
               <tr>
                   <td align="center">Nro</td>
                   <td align="center">Fecha</td>
               </tr>
               <tr>
                   <td align="center">
                       <div style="font-weight: bold; font-size: 20px; margin-top:-5px;"  >
                       {{ explode('-',$ReturnData["OC"][0]->ocCodigo)[1]  }}
                       </div>
                   </td>
                   <td align="center">
                       {{ $ReturnData["OC"][0]->ocFecha }}
                   </td>
               </tr>
           </table>
           <table style="margin-top: 10px;" cellpadding="4px">
               <tr><td> REG.SIAF:</td><td> .......................  </td> </tr>
               <tr><td> CERTIFIC:</td><td>   .......................  </td></tr>
           </table>
        </td>
  </tr>
  </table>
      <div class="info" style="margin-bottom: 2px;">
          <table style="table-layout: fixed;" width="100%">
              <tr>
                  <td colspan="6">{{  $ReturnData["OC"][0]->ocMotivo   }}</td>
              </tr>
              <tr>
                  <td width="15%"><label class="labels"> RAZON SOCIAL</label>   </td>
                  <td width="1%">:</td>
                  <td style="overflow: hidden;">
                      <label class="labels" style="font-size: 14px; font-weight:bold; white-space: nowrap;">
                          {{  $ReturnData["OC"][0]->ocRazon    }}</label>
                  </td>
                  <td width="5%" align="right">
                      <label class="labels"> RUC </label>
                  </td>
                  <td width="1%">:</td>
                  <td width="15%">
                      <label class="labels" style="font-size: 16px; font-weight:bold;"> {{  $ReturnData["OC"][0]->ocRUC    }}   </label>
                  </td>
              </tr>
              <tr>
                  <td style="font-size:11px; font-weight:normal;">
                      <label class="labels">DIRECCION: </label>    </td>
                  <td>:</td>
                  <td colspan="4" style="white-space: nowrap; overflow: hidden;">{{  $ReturnData["RUC"][0]->Direccion    }} </td>
              </tr>
              <tr>
                  <td style="font-size:11px; font-weight:normal;"><label class="labels">
                          GLOSA</label>     </td>
                  <td>:</td>
                  <td colspan="4">
                      {{  $ReturnData["OC"][0]->ocGlosa    }}
                  </td>
              </tr>
              @if (strlen(  $ReturnData["OC"][0]->ocMotivo ) < 4	)
                  <tr>
                      <td style="border-bottom: solid #0f0f0f"><label class="labels"> LUGAR ENTREGA</label>
                          <strong>   </strong></td>
                      <td style="border-bottom: solid #0f0f0f">:</td>
                      <td style="border-bottom: solid #0f0f0f; white-space: nowrap; overflow: hidden;" colspan="4" >
                          {{  $ReturnData["OC"][0]->ocLugar  }}
                      </td>
                  </tr>
              @endif
              <tr>
                  <td colspan="6"> FACTURAR A NOMBRE DE : <label class="labels"> {{ config('slam.APP_ENTIDAD') }}
                          CON RUC:</label> <strong> {{ config('slam.ENTIDAD_RUC') }} </strong>
                  </td>
              </tr>
          </table>
      </div>
    <div class="info">
        <table width="100%" style="table-layout: fixed;">
            <tr>
                <td width="14.8%">
                    <label class="labels"> DEPENDENCIA </label>
                </td>
                <td width="1%">:</td>
                <td style="white-space: nowrap; overflow: hidden;">( {{  $ReturnData["OC"][0]->ocDepCod    }}  ) {{  $ReturnData["OC"][0]->ocDepDsc    }}</td>
            </tr>
            @if ( $ReturnData["prCant"][0]->Cant  >1 )
            <tr>
                <td STYLE="font-size:11px;">
                    <label class="labels"> SEC FUN </label>
                </td>
                <td>:</td>
                <td style="white-space: nowrap; overflow: hidden;">
                    @foreach($ReturnData["prSecFun"] as $key=>$dll)
                        <b> -  ( SEC. FUN =   {{ $dll->SecFun  }} ) </b>
                    @endforeach
                </td>
            </tr>
            @else
            <tr>
                <td  STYLE="font-size:11px;">
                    <label class="labels"> SEC FUN</label>
                </td>
                <td>:</td>
                <td style="white-space: nowrap; overflow: hidden;">( {{  $ReturnData["OC"][0]->ocSecFunCod    }}  ) {{  $ReturnData["OC"][0]->ocSecFunDsc    }}</td>
            </tr>
            @endif
            <tr>
                <td  STYLE="font-size:11px;">
                    <label class="labels"> RUBRO </label>
                </td>
                <td>:</td>
                <td style="white-space: nowrap;"> ( {{  $ReturnData["OC"][0]->ocRubroCod    }} ) {{  $ReturnData["OC"][0]->ocRubroDsc    }}</td>
            </tr>
            <tr>
                <td  STYLE="font-size:11px;">
                    <label class="labels"> REFERENCIA</label>
                </td>
                <td>:</td>
                <td style="white-space: nowrap;">
                    {{  $ReturnData["OC"][0]->ocRef    }}
                </td>
            </tr>
        </table>
    </div>
 </div>
 <div class="footer" align="center"  style="font-size: 11px; margin-top:0px;">
  <table border="1">
            <thead>
            <tr style="background: #ccc">
                <th width="210px" align="center"> JEFE DE ADQUISICIONES </th>
                <th width="210px"  align="center"> JEFE DE LOGISTICA </th>
                <th width="270px" align="center">    JEFE DE ALMACEN CENTRAL </th>
            </tr>
            </thead>
            <tbody>
            <tr valign="bottom">
                <td height="50px" align="center"> </td>
                <td   align="center"> </td>
                <td align="center">
                    <table>
                    <tr >
                        <td width="15px"> </td>
                        <td  style="height: 40px;"> <strong>RECIBI CONFORME</strong></td>
                        <td >  </td>
                    </tr>
                    <tr>
                        <td width="15px"> </td>
                        <td > ......../........../.............. </td>
                        <td > ............................................. </td></tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="3" style="font-size: 9px;">
             NOTA: Esta Orden es nula sin la firma del Jefe de Abastecimiento; cada Orden de Compra debe tener su guía de Remisión y su factura correpondiente en original y copia, luego remitirlas a la Unidad de Almacén y Abastecimientos. Nos reservamos el derecho de devolver los  Bienes que no estén de acuerdo a nuestras especificaciones, en conformidad  a la Ley 30225 y su Reglamento y las modificatorias.
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
<div class="container">
    <table  style="table-layout: fixed;" width="100%" >
        <thead>
        <tr>
            <th colspan="6" class="dll">ARTÍCULOS</th>
            <th colspan="2" class="dll">PRECIO</th>
        </tr>
        <tr>
            <th ALIGN="center" class="dll" width="3%">Nro</th>
            <th ALIGN="center" class="dll" width="8%">Cant.</th>
            <th ALIGN="center" class="dll" width="6%">Und.</th>
            <th ALIGN="center" class="dll" width="10%">Clasf.</th>
            <th class="dll"  width="380px"  > Descripción  </th>
            <th ALIGN="center"  class="dll" width="10%" >Marca</th>
            <th ALIGN="center" class="dll" width="8%">Unit.</th>
            <th ALIGN="center" class="dll" width="8%">Sub-total</th>
        </tr>
        </thead>
        <tbody>
        <?php  $Total=0; $Item =1 ;?>
        @foreach($ReturnData["OCDll"] as $key=>$OSDll)
            <tr>
                <td ALIGN="center" class="dll"><?php echo $Item++ ;?></td>
                <td ALIGN="center" class="dll" style="font-weight:normal;"> {{ number_format ( (float)$OSDll->dllCant ,2,'.',',' )      }}</td>
                <td ALIGN="center" class="dll" style="font-weight:normal;">  {{ $OSDll->dllUndAbrv  }}</td>
                <td ALIGN="center" class="dll" style="font-weight:normal;" > {{ $OSDll->dllClasfCod }}</td>
                <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  >  <?php echo strtoupper ($OSDll->dllProdDsc )." - ".  strtoupper ($OSDll->dllProdEspf ) ?> </td>
                <td ALIGN="center" class="dll " style="font-weight:normal;">  {{ $OSDll->dllMarca   }}</td>
                <td ALIGN="right" class="dll rights" style="font-weight:normal;" >   <?php  echo floatval( $OSDll->dllPrecio ) ;?>    </td>
                <td ALIGN="right" class="dll rights" style="font-weight:normal;">     <?php echo  number_format ($OSDll->dllTotal,2);?></td>
            </tr>
            <?php  $Condicion=$OSDll->dllTotal;  ?>
            <?php  $Total+=$OSDll->dllTotal;  ?>
        @endforeach

        <tr>
            <td ALIGN="center" class="dll" colspan="4"></td>
            @if ( $ReturnData["prCant"][0]->Cant  >1 )
                <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  >
                    <strong>Resumen General ===============  ============= ========== <strong><BR>
                            @foreach($ReturnData["prSum"] as $key=>$dll)
                                <span style="font-size: 12.5px"> <strong>( SECFUN. - {{ $dll->SecFun }} ) -   {{ $dll->Clasf }}  = S/.  {{ $dll->Total }} </strong></span><br>
                @endforeach
            @else
                <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  > =============== ============= ==========
            @endif
            </td>
            <td ALIGN="center" class="dll" colspan="3">  </td>
        </tr>
        </tbody>
    </table>

    @if($ReturnData["OC"][0]->ocTipoProcID=="009"  &&   $ReturnData["OC"][0]->ocIGV=="SI")

        <table  style="font-size: 9px; margin-top:-13px; table-layout: fixed;" width="100%"  >
            <thead>
            <tr>
                <th ALIGN="center" width="84%">-</th>
                <th ALIGN="center" width="16%">-</th>
            </tr>
            </thead>
            <tbody >
            <tr class="dll">
                <td  class="dll rights" ALIGN="right" >SubTotal :  </td>
                <td   class="dll rights" ALIGN="right" style="font-weight:normal;font-size:12px;" > {{$ReturnData["OC"][0]->ocMonto}}</td>
            </tr>

            <tr class="dll">

                <td  class="dll rights" ALIGN="right"  >Descuento :  </td>
                <td ALIGN="center "  class="dll rights  " style="font-weight:normal;font-size:12px;"> {{ (float) $ReturnData["OC"][0]->ocDescuento }} </td>
            </tr>
            <tr class="dll">

                <td  class="dll rights" ALIGN="right"  >Envio :  </td>
                <td ALIGN="center"  class="dll rights" style="font-weight:normal;font-size:12px;">   {{  $ReturnData["OC"][0]->ocEnvio}} </td>
            </tr>

            <tr class="dll">

                <td  class="dll rights" ALIGN="right"  >IGV(%) :  </td>
                <td ALIGN="center"  class="dll rights" style="font-weight:normal;font-size:12px;">   {{ $ReturnData["OC"][0]->ocTotalIGV}} </td>
            </tr>
            <tbody>
        </table>
        <table  style="font-size: 9px;" width="100%" >
            <tr style="text-align:left;">
                <!-- <td  class="dll"  align="left" style="font-size: 12px; font-weight: bold;text-align:left;" >  </td>-->
                <td   class="dll rights" align="right" style="font-size: 15px; font-weight: bold;" > TOTAL : {{ number_format ( (float)$ReturnData["OC"][0]->ocTotalSuper ,2,'.',',' ) }}     </td>
            </tr>
        </table>

    @endif

    <table style="table-layout: fixed; font-size: 11px;" width="100%">
        @foreach($txtcondicion as $key => $line)
        <tr>
            <td colspan="2" width="8%" style="border-right: solid 1px #444444; border-left: solid 1px #444444;"></td>
            <td colspan="5" style="padding: 0 5px 0 5px;">
                {!! $line !!}
            </td>
            <td width="8%" style="border-right: solid 1px #444444; border-left: solid 1px #444444;"></td>
        </tr>
        @endforeach
    </table>

    {{--<div  style="padding-left:145px; padding-right:10px; font-size:12px; font-family: Helvetica, Arial, sans-serif; font-weight:bold;  border:1px solid #000000;" >--}}
        {{--<br>--}}

    {{--</div>--}}

    @if(  $ReturnData["OC"][0]->ocTipoProcID=="009"  &&   $ReturnData["OC"][0]->ocIGV=="SI")

        <table  style="font-size: 9px; margin-top:-13px; " width="100%" >
            <thead>
            <tr>
                <th ALIGN="center" width="450px">-</th>
                <th ALIGN="center" width="100px">-</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align:left;">
                <td  class="dll"  align="left" style="font-size: 12px; font-weight: bold;text-align:left;" > Son: {{ numtoletras($ReturnData["OC"][0]->ocTotalSuper) }}  </td>
                <td   class="dll rights" align="right" style="font-size: 15px; font-weight: bold;" > TOTAL : {{ number_format ( (float)$ReturnData["OC"][0]->ocTotalSuper ,2,'.',',' ) }}     </td>
            </tr>
            </tbody>
        </TABLE>


    @else
        <table  style="font-size: 9px; margin-top:-13px; " width="100%" >
            <thead>
            <tr>
                <th ALIGN="center" width="450px">-</th>
                <th ALIGN="center" width="100px">-</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align:left;">
                <td  class="dll"  align="left" style="font-size: 12px; font-weight: bold;text-align:left;" > Son: {{ numtoletras($ReturnData["OC"][0]->ocTotalSuper) }}  </td>
                <td   class="dll rights" align="right" style="font-size: 15px; font-weight: bold;" > TOTAL : {{ number_format ( (float)$ReturnData["OC"][0]->ocTotalSuper ,2,'.',',' ) }}     </td>
            </tr>
            </tbody>
        </table>
        <table  style="font-size: 10px;" width="100%" >
            <tr>
                <td class="dll lefts"  >
                    <div style="display: inline-block; font-size: 12px; margin-left: 0px; font-weight:bold;  ">
                        @if ( $ReturnData["prCant"][0]->Cant  <=1 )
                            <div><strong>Resumen por Clasificador: </strong> </div>
                            @foreach($ReturnData["OCAbsClasf"] as $key=>$ReqDll)
                                <span style="font-size: 12px"> {{ $ReqDll->Clasf }}  = {{ $ReqDll->Total }} </span><br>
                            @endforeach
                        @endif
                    </div>

                </td>

                <td  class="dll lefts"  valign="top">
                    <table >
                        <tr> <td ><label class="labels"> OBSV :</label> <label style="font-size: 12px; width: 150px; ">{{  $ReturnData["OC"][0]->ocObsv  }} </label></td>  </tr>
                    </table>
                </td>
                <td class="dll rights"  valign="center" style="font-size:10px;  font-weight:bold; ">
                    Elb:{{  $ReturnData["OC"][0]->ocUsrID  }} <br> Imp: {{$ReturnData["Usr"] }}<br>
                </td>
            </tr>
        </table>

    @endif
</div>
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
                        $xcadena.= " CON  $xdecimales/100 Soles "; //
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