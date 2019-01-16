<!DOCTYPE html>
<html>
<head>
 <style>
  @page { margin: 20px 35px 100px 35px; padding-bottom:70px;  }

.header {
  height: 245px;
  position: fixed;
  left: 0px;
  top: 0px;
  right: 0px;
  margin-bottom: 50px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.footer {
  position: fixed;
  bottom: -40;
  width: 100%;
  font-size: 10px;
  display: inline-block;
  height: 40;
   
  align: center;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.logo{
  width: 150px;
  float: left;
  display: inline-block;
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
   padding: 5px 2px;
   font-size: 12px;
   background: #e2e2e2;
 }

td.dll {
   border-style:solid;
   border-width:1px;
   border-color:#444444;
   padding: 2px;
   font-size: 10.5px;
   text-align: center;
   font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
   width: 10px;
 }
 td.lefts {
   text-align: left;
   padding-left: 4px;;
}
 td.rights  {
   text-align: right;
   padding-right: 4px;;
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
 border-bottom: 1px  solid #666666;
  padding: 2px;
  padding-right:-10px;
  width: 690px;

}

.pagenum:before {
  content: counter(page);
}

.titulo{
   font-size: 16px;
   border: 3px #444 solid;
   padding: 5px;
   margin: 5px;;
   background: #efefef;
   border-radius: 15px;
   font-family:  Helvetica;
   text-align: center;
   width: 270;
}

.info {
   font-size: 10px;
   border: 2px #999 solid;
   padding: 0px 15px;
   margin: 5px;;
   background: #FEFEFE;
   border-radius: 10px;
   font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
   text-align: center;
}

.labels{
  font-size: 10px;
  font-weight: bold;
}
</style>

<title>Reporte de Cotizacion</title>
</head>

<body style="margin-top: 290px;">

  <div class="header" style="font-size: 11px ; ">
     <table>
       <tr valign="top">
       <td>
              <div class="logo">
                <img src="{{ config('slam.APP_LOGO') }}" width="110px" height="110" style="margin-left: 30px;">
              </div>
       </td>
       <td >

                   <table class="entidad" >
                  
                   <tr><td class="entidadMuni">    {{ config('slam.APP_ENTIDAD') }}  <td></tr>
                   <tr><td class="entidadMuni" style="font-size: 12px;">   RUC:	{{ config('slam.ENTIDAD_RUC') }} </td></tr>
                   <tr><td class="centers"> <div class="titulo entidadMuni"  >   SOLICITUD DE COTIZACION<br>  </div></td></tr>
                   </table>

       </td>
       <td>
            <div class="version" align="right">
                    <table>
                    <tr><td width="75px"></td> <td class="rights"> {{ config('slam.AUTHOR') }}</td></tr>
                    <tr><td width="75px"> <td class="rights"> {{ config('slam.VERSION') }} </td></tr>

                    </table>

                    <div style="margin-left: 10px; margin-top: 5px;" >
                    <div   class="titulo"             style=" border-radius: 8px;width: 140px ; height: 22px; padding: 0px; font-size: 14px ; font-weight: bold;  padding-bottom: 0px; font-family: Helvetica" > Fecha : {{ $ReturnData["Ctz"][0]->ctzFecha }} </div>
                    <div class="titulo" style="width: 130px; font-weight: bold; font-size: 20px; border-color: #555; border-radius: 10px;"  >{{ $ReturnData["Ctz"][0]->ctzCodigo }}</div>
                    </div>

              </div>
        </td>
       </tr>
     </table>

            <div class="info" style="margin-top:-5px;">
            <table >
            <?php if(isset($ReturnData["Req"][0]->reqDepCod))
            {
            ?>
                <tr ><td class="line"> <label class="labels"> DEPENDENCIA :   </label>( {{  $ReturnData["Req"][0]->reqDepCod   }} )  {{  $ReturnData["Req"][0]->reqDepDsc   }}   </td></tr>
            <?php
            }
            else 
            {
            ?>
                 <tr ><td class="line"> <label class="labels"> DEPENDENCIA :   </label>  </td></tr>
            
            <?php
            }
            
            ?>
                <tr ><td class="line"> <label class="labels">  GLOSA :        </label>          {{  $ReturnData["Ctz"][0]->ctzGlosa     }}</td></tr>
                <tr ><td class="line"> <label class="labels">  REFERENCIA :   </label>          {{  $ReturnData["Ctz"][0]->ctzRef     }}</td></tr>
                <tr ><td class="line"> <label class="labels">  LUGAR ENTREGA : </label>          {{  $ReturnData["Ctz"][0]->ctzLugarEnt  }} </td></tr>
           
            <?php if(isset($ReturnData["Req"][0]->reqSecFunCod))
            {
            ?>
                 <tr ><td class="line" style="font-size: 9px;" > <label class="labels">  SEC FUN : </label>      (  {{  $ReturnData["Req"][0]->reqSecFunCod   }}  )  {{  $ReturnData["Req"][0]->reqSecFunDsc   }}           </td>  </tr>
            <?php
           }
            else 
            {
            ?>
                 <tr ><td class="line"> <label class="labels">  SEC FUN  :   </label>  </td></tr>
            <?php
            }
            ?>
            </table>


            </div>
            <div class="info">
            <table>
                <tr > <td width="300" HEIGHT="18"><label class="labels"> RAZON SOCIAL: </label> ____________________________________________________________________ </td> <td ><label class="labels"> RUC : </label>   ____________________ </td>  </tr>
                <tr > <td HEIGHT="13"><label class="labels"> DIRECCION: </label>   ____________________________________________________________________________   </td>    <td ><label class="labels"> TELEFONO: </label>   ____________________</td> </tr>
                <tr > <td HEIGHT="13"><label class="labels"> CUENTA CCI: </label>   ______________________________________________________________  </td>     <td ><label class="labels"> E-MAIL: </label>   ________________ </td> </tr>

            </table>
            </div>

  </div>
 <div class="footer" align="center"  style="font-size: 12px;">   <!-- ** DATOS FIRMAS ****************************************** -->

      <br>  <br>
          <table> <tr STYLE="font-size: 10px;"> <td width="50px">  </td><td align="center"> ------------------------------------- <br> JEFE DE ADQUISICIONES </td> <td width="60px">  </td> <td align="center"> ------------------------------------- <br> COTIZADOR </td>  <td width="60px">  </td> <td align="center">     ----------------------------------------------  <br> SELLO Y FIRMA DEL PROVEEDOR <br>  <img src="img/imgHuella.jpg" width="80px"  height="90px" style="margin-top : -90px; margin-left:250px;"> </td>  </tr>   </table>
          <br>
          <hr style="width: auto; " >
          <span style="font-size: 9px;"> {{ config('slam.ENTIDAD_PIE') }}   -    Página <span class="pagenum"></span></span>

 </div>
 <br>
             <table  style="font-size: 9px; margin-left:5px; width:auto; "  >
             <THEAD>
             <tr>
              <th  class="dll" width="10px" style="background:#bbb;" >Nº</th>
              <th  class="dll" width="40px" style="background:#bbb;">Cant</th>
              <th class="dll" width="25px" style="background:#bbb;">Und</th>
              <th class="dll"  width="395px"  style="background:#bbb;" > Descripcion  </th>
              <th class="dll"  width="75px"  style="background:#bbb;" > Marca </th>
              <th class="dll"  width="65px"  style="background:#bbb;"  > Precio </th>
              <th class="dll"  width="65px" style="background:#bbb;"  > Total </th>
             </tr>
              </THEAD>
              <tbody>
              <?php $Total=0; $Item =1 ;?>
              @foreach($ReturnData["CtzDll"] as $key=>$CtzDll)
              <tr class="dll">
                   <td ALIGN="center" class="dll"><?php echo $Item++ ;?></td>
                   <td ALIGN="center" class="dll">   {{ number_format ( (float)$CtzDll->dllCant  ,2,'.',',' )      }} </td>
                   <td ALIGN="center" class="dll" >  {{ $CtzDll->dllUndAbrv  }}</td>
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px;font-size:10px;" > {{ $CtzDll->dllProdDsc  }} --: {{ $CtzDll->dllProdEspf  }}</td>
                   <td ALIGN="center" class="dll"></td>
                   <td ALIGN="center" class="dll"></td>
                   <td ALIGN="center" class="dll"></td>
              </tr>

              @endforeach
			    @for ($i = 0; $i < 15-$Item ; $i++)
              <tr class="dll">
                                 <td ALIGN="center" class="dll">-</td>
                                 <td ALIGN="center" class="dll"> </td>
                                 <td ALIGN="center" class="dll" ></td>
                                 <td ALIGN="left" class="dll " style="padding-left: 6px;" >  </td>
                                 <td ALIGN="center" class="dll"></td>
                                 <td ALIGN="center" class="dll"></td>
                                 <td ALIGN="center" class="dll"></td>
                            </tr>
            @endfor
                <tr>
                    <td colspan="2" class="dll" style="font-size: 13px; font-weight: bold; border-right: solid white">SON:</td>
                    <td colspan="4" class="dll rights" align="right" style="font-size: 14px; font-weight: bold;" > TOTAL :</td><td class="dll" colspan="1"></td></tr>

               <tr>
                   <td colspan="3" class="dll lefts" >
                    <div style="margin-left: 2px"><strong>Total Items :<?php echo --$Item;?> </strong> </div>
                   </td>

                   <td   colspan="4" class="dll lefts"  valign="top">
                   <table >
                        <tr> <td ><label class="labels"> OBSV :</label> <label style="font-size: 11px;">{{  $ReturnData["Ctz"][0]->ctzObsv  }} </label></td>  </tr>
                    </table>

              </tr>
              <tr>
              <td colspan="6" class="dll" style="text-align: left">

                      * Si por cualquier  causa no esta en condiciones de cotizar. Sirva(n)se Ud(s) firmar y devolver este documento.<br>
                         * Si esta en condiciones de cotizar sirva(n)se Ud(s) firmar este documento y devolverlo en un SOBRE CERRADO.

               </td>
                </td>
                                  <td  class="dll rights"  valign="center" style="font-size: 8px">
                                  Elb:{{  $ReturnData["Ctz"][0]->ctzUsrID  }} <br> Imp: {{$ReturnData["Usr"] }}<br>
                                  </td>
               </tr>
               <tr>
                    <td colspan="7" class="dll" style="text-align: left">
                     * Llenar todos los datos requeridos en este forrnato, caso contrario será descalificada:
                     la cotizacion deberá Incluir todos los tributos, seguros, transportes, inspecciones, pruebas así coma cualquier otro concepto que pueda
                     tener insidencia sobre el costo del bien a contratar de acuerdo a la legislación Vigente.

                     <br>
                     * La ejecucion de la prestacion se realizara previa a la notificacion de la O/C u O/S debidamente con registro SIAF de compromiso; caso contrario NO es valido la prestacion.

                      <p style="margin-bottom: 2px; margin-top:-5px; ;font-size: 10px; font-family: Helvetica, Arial, sans-serif"><strong>PLAZO DE ENTREGA :__________ </strong> &nbsp; <strong>VALIDEZ DE OFERTA :___________</strong> <strong>ACOGIDO A LA LEY 27037:</strong><img src="img/imgHuella.jpg" width="20px"  height="20px" style=""> &nbsp; Fecha de Cotiz: ___/____/20_____    </p>

              </td>
              </tr>

          </tbody>
          </table>


</body>
</html>