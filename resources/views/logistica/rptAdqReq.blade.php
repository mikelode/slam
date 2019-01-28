<!DOCTYPE html>
<html>
<head>
 <style>
  @page { margin: 10px 35px 80px 1cm;}

.header {
  height: 220px;
  position: fixed;
  left: 0px;
  top: 0px;
  right: 0px;
  margin-bottom: 50px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.footer {
  position: fixed;
  bottom: 2.5cm;
  width: 100%;
  font-size: 10px;
  display: inline-block;
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
  padding-bottom: 3px;

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
   font-size: 9px;
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

<title>Requerimiento</title>
</head>

<body style="padding-top: 245px;">

  <div class="header" style="font-size: 11px ; ">
     <table style="margin-top:10px">
       <tr valign="top">
       <td>
              <div class="logo">
                <img src="{{ config('slam.APP_LOGO') }}" width="90px" height="90" style="margin-left: 30px;">
              </div>
       </td>
       <td >

                   <table class="entidad" >
                  
                   <tr><td class="entidadMuni">   {{ config('slam.APP_ENTIDAD') }}  <td></tr>
                   <tr><td class="entidadMuni" style="font-size: 12px;">   RUC:	{{ config('slam.ENTIDAD_RUC') }}< /td></tr>
                   <tr><td class="centers"> <div class="titulo entidadMuni"  >   SOLICITUD DE REQUERIMIENTO  <br> <strong style="font-size: 12px"> ( - {{ $ReturnData["Req"][0]->reqTipoReqDsc  }} - )</strong>    </div></td></tr>
                   </table>

       </td>
       <td>
            <div class="version" align="right">
                    <table>
                    <tr><td width="75px"></td> <td class="rights">{{ config('slam.AUTHOR') }}</td></tr>
                    <tr><td width="75px"> <td class="rights"> {{ config('slam.VERSION') }} </td></tr>

                    </table>

                    <div style="margin-left: 10px; margin-top: 5px;" >
                    <div               style=" background:#fff; border:1px solid #fff; border-radius: 6px;width: 140px ; height: 22px; padding: 0px; font-size: 15px ; font-weight: bold;  padding-bottom: 0px; font-family: Helvetica" > Fecha : {{ $ReturnData["Req"][0]->reqFecha }} </div>
                    <div class="titulo" style="width: 130px; font-weight: bold; font-size: 20px; border-color: #555; border-radius: 10px;"  >{{ $ReturnData["Req"][0]->reqCodigo }}</div>
                    </div>

              </div>
        </td>
       </tr>
     </table>


            <div class="info" style = "margin-top:-15px;">

            <table >
                <tr ><td class="line"> <label class="labels"> DEPENDENCIA : </label> <SPAN > {{  $ReturnData["Req"][0]->reqDepDsc    }} </SPAN> </td></tr>
                <tr ><td class="line"> <label class="labels">  SOLICITANTE : </label>    {{  $ReturnData["Req"][0]->reqSolDsc    }}      </td></tr>
                <tr ><td class="line"> <label class="labels">  GLOSA :       </label>    {{  $ReturnData["Req"][0]->reqGlosa     }}</td></tr>
                <tr ><td class="line"> <label class="labels">  LUGAR ENTREGA : </label>   {{ $ReturnData["Req"][0]->reqLugarEnt  }} </td></tr>
            </table>


            </div>
            <div class="info">
            <table>
                <tr > <td class="line"><label class="labels">  RUBRO : </label>  ( {{ $ReturnData["Req"][0]->reqRubroCod }} ) - {{  $ReturnData["Req"][0]->reqRubroDsc      }} </td>  </tr>
                <tr >
                    <td class="line"><label class="labels">  SEC FUN : </label>
                        @if(substr($ReturnData["Req"][0]->reqSecFunCod,-1) == 'M')
                            @foreach($ReturnData["ReqAbsClasf"] as $key=>$ReqDll)
                                Sec.Fun. ({{ $ReqDll->secfun }}) - Rubro: {{ $ReqDll->rubro }},
                            @endforeach
                        @else
                             {{ '('.$ReturnData["Req"][0]->reqSecFunCod . ') ' }} - {{  $ReturnData["Req"][0]->reqSecFunDsc     }}
                        @endif
                    </td>
                </tr>
            </table>
            </div>

  </div>
 <div class="footer" align="center"  style="font-size: 12px;">   <!-- ** DATOS FIRMAS ****************************************** -->
 <br>
        <?php
        if( $ReturnData["Req"][0]->reqGtoTip=='0')
        {
          ?>
          <table style="table-layout: fixed;" width="100%">
              <tr>
                  <td width="5%"></td>
                  <td width="10%" align="center"> ------------------------------------- <br>  Solicitante</td>
                  <td width="5%">  </td>
                  <td width="10%" align="center"> ------------------------------------- <br> Jefe Inmediato  </td>
                  <td width="5%">  </td>
                  <td width="10%" align="center"> ------------------------------------- <br> Logistica </td>
                  <td width="5%">  </td>
                  <td width="10%" align="center"> ------------------------------------- <br> O.G.A. </td>
                  <td width="5%">  </td>
              </tr>
          </table>
          <br>   <br>        
       <?php
       }
       else
       {
       ?>
          <table style="table-layout: fixed; margin-bottom: 1.25cm;" width="100%">
              <tbody>
                  <tr>
                      <td width="5%">  </td>
                      <td align="center"> ------------------------------------- <br> Residente (Firma)</td>
                      <td width="">  </td>
                      <td align="center"> ------------------------------------- <br> Inspector (Firma)  </td>
                      <td width="">  </td>
                      <td align="center"> ------------------------------------- <br>Gerente de Linea (V°B°)</td>
                      <td width="5%">  </td>
                  </tr>
              </tbody>
          </table>
          <table style="table-layout: fixed;" width="100%">
              <tbody>
                  <tr>
                      <td width="12%">

                      </td>
                      <td width="35%" align="center">
                          ------------------------------------- <br> Logística
                      </td>
                      <td width="6%">

                      </td>
                      <td width="35%" align="center">
                          ------------------------------------- <br> O.G.A.
                      </td>
                      <td width="12%">

                      </td>
                  </tr>
              </tbody>
          </table>
      <?php

      } ?>


          <hr style="width: auto; " >
          <span style="font-size: 9px;"> {{ config('slam.ENTIDAD_PIE') }}  -    Página <span class="pagenum"></span></span>


 </div>



 <table  style="font-size: 9px; margin-left:5px; width:auto; padding-bottom: 150px;" >
             <THEAD>
             <tr>
              <th ALIGN="center" class="dll" width="10px" style="background:#bbb;">Nº</th>
              <th ALIGN="center" class="dll" width="40px" style="background:#bbb;">Cant</th>
              <th ALIGN="center" class="dll" width="20px" style="background:#bbb;">Und</th>
              <th ALIGN="center" class="dll" width="60px" style="background:#bbb;">Clasf.</th>
              <th class="dll"  width="410px"  style="background:#bbb;"> Descripcion  </th>
              <th ALIGN="center" class="dll" width="55px" style="background:#bbb;">Precio</th>
              <th ALIGN="center" class="dll" width="65px" style="background:#bbb;">Total</th>
             </tr>
              </THEAD>
              <tbody>
              <?php $Total=0; $Item =1 ;?>
              @foreach($ReturnData["ReqDll"] as $key=>$ReqDll)
              <tr class="dll">
                   <td ALIGN="center" class="dll"><?php echo $Item++ ;?></td>
                   <td ALIGN="center" class="dll">  {{ $ReqDll->dllCant     }}</td>
                   <td ALIGN="center" class="dll" >  {{ $ReqDll->dllUndAbrv  }}</td>
                   <td ALIGN="center" class="dll">  {{ $ReqDll->dllClasfCod }}</td>
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px;font-size:9px;"  > <?php echo strtoupper ( $ReqDll->dllProdDsc   ." --:". $ReqDll->dllProdEspf)  ?></td>
                   <td ALIGN="right" class="dll rights">   {{ $ReqDll->dllPrecio   }}</td>
                   <td ALIGN="right" class="dll rights">   {{ $ReqDll->dllTotal    }}</td>

              </tr>
               <?php  $Total+=$ReqDll->dllTotal;  ?>
              @endforeach

			   <tr class="dll">
                                 <td ALIGN="center" class="dll" colspan="4"></td>
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  > =============== ================= ============== ==========</td>
                   <td ALIGN="center" class="dll" colspan="2">  </td>

                </tr>

              <?php
              $long = 65 - 1;

              $itext = $long;
              $text = 'NOTA.-' . $ReturnData["Req"][0]->reqObsv;
              $ltext = strlen($text);
              if($ltext < $long){
                  $parrafo[] = $text;
              }
              else{
                  while($itext <= $ltext){

                      $letter = $text[$itext];

                      if($letter == ' '){
                          $text[$itext] = '|';
                      }
                      else{
                          $nxtlet = $text[$itext + 1];

                          if($nxtlet == ' '){
                              $text[$itext + 1] = '|';
                          }
                          else{
                              $prvlet = $text[$itext - 1];
                              $count = 1;

                              while($prvlet != ' '){
                                  $count++;
                                  $prvlet = $text[$itext - $count];
                              }

                              $text[$itext - $count] = '|';

                          }
                      }

                      $itext = $itext + $long;
                  }

                  $parrafo = explode('|', $text);
              }



              ?>
              @foreach($parrafo as $row)
                  <tr class="dll">
                      <td ALIGN="center" class="dll">-</td>
                      <td ALIGN="center" class="dll" >  </td>
                      <td ALIGN="center" class="dll" >  </td>
                      <td ALIGN="center" class="dll" ></td>
                      <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  >{{ $row }}</td>
                      <td ALIGN="center" class="dll" >  </td>
                      <td ALIGN="right" class="dll rights" >  </td>
                  </tr>
              @endforeach
              @for ($i = 0; $i < 20 - $Item - count($parrafo) ; $i++)
              <tr class="dll">
                                 <td ALIGN="center" class="dll">-</td>
                   <td ALIGN="center" class="dll" >  </td>
				   <td ALIGN="center" class="dll" >  </td>
				   <td ALIGN="center" class="dll" >  </td>
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px;"  > </td>
				   <td ALIGN="center" class="dll" >  </td>
                   <td ALIGN="right" class="dll rights" >  </td>

                            </tr>
            @endfor


              <tr><td colspan="7" class="dll rights" align="right" style="font-size: 14px; font-weight: bold;" > TOTAL : <?php echo  number_format ($Total ,2);?>  </td></tr>

               <tr>
               <td colspan="7" class="dll lefts" style="font-size:9px;">
              
               OBSV.:  " El presente  requerimiento   no contempla  fraccionamiento   señalado  en el Art.  20º  de la Ley N° 30225 y el Art.  19 ºdel   D. S.  N° 350-2015-EF  que aprueba  el reglamento  de contrataciones   del estado. Del cual doy fe en mi condición   de Solicitante  y/o supervisor,  sujetándome   a los alcances  de las sanciones administrativas   y penales".
             
               </td>
              </tr>


               <tr>
               <td colspan="4" class="dll lefts" >
               <div style="display: inline-block; font-size: 9px; margin-left: 3px;">
               <div><strong>Resumen por Clasificador : </strong> </div>
                @foreach($ReturnData["ReqAbsClasf"] as $key=>$ReqDll)
                   {{ $ReqDll->sfrub .' | ' . $ReqDll->Clasf }}  = {{ $ReqDll->Total }}<br>
                @endforeach
                </div>
                <div style="margin-left: 10px"><strong>Total de Items :<?php echo --$Item;?> </strong> </div>
               </td>

               <td colspan="2" class="dll lefts"  valign="top">
               <table >
                    <tr> <td ><label class="labels"> OBSV :</label> <label style="font-size: 9px;"> </label></td>  </tr>
              </table>
              </td>
               <td  class="dll rights"  valign="center" style="font-size: 8px">
                Elb:{{  $ReturnData["Req"][0]->reqUsrID  }} <br> Imp: {{$ReturnData["Usr"] }}<br>
               </td>
              </tr>

          </tbody>
  </table>
</body>
</html>