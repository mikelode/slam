<!DOCTYPE html>
<html>
<head>
 <style>
  @page { margin: 20px 10px 20px 5px; padding-bottom:65px;  }

.header {
  height: 100px;
  position: fixed;
  left: 0px;
  top: 0px;
  right: 0px;
  margin-bottom: 30px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.footer {
  position: fixed;
  bottom: -5;
  width: 100%;
  font-size: 10px;
  display: inline-block;
  height: 10;

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
   border-color:#666;
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
  border-bottom: 1px #000000 dotted;
  padding: 4px;
  width: 990px;
  padding-bottom: 3px;
}

td.lineB {
  border-bottom: 1px #000000 dashed;
  padding: 4px;
  width: 530px;
  padding-bottom: 3px;
}

.pagenum:before {
  content: counter(page);
}

.titulo{
   font-size: 16px;
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

.ancho{
  width: 470px;
}

</style>

<title>Reporte de Cuadro Comparativo</title>
</head>

<body style="margin-top: 105px;">

  <div class="header" style="font-size: 11px ; ">
     <table>
       <tr valign="top">
       <td>
              <div class="logo">
                <img src="img/logoMDV.png" width="90px" height="90" style="margin-left: 30px;">
              </div>
       </td>
       <td >

                   <table class="entidad" >
                   <tr><td style="font-size: 9px;">   "Año de la consolidación del Mar de Grau"     </td></tr>
                   <tr><td class="entidadMuni">   MUNICIPALIDAD DISTRITAL DE VILCABAMBA  <td></tr>
                   <tr><td class="entidadMuni" style="font-size: 12px;">   RUC:	20170327391 </td></tr>
                   <tr><td align="center" class="centers"> <div style="width: 700px;"> <div class="titulo entidadMuni"  style="margin-left: 60px;  width: 550px; border-radius: 10px;font-size:20px;font-weight: bold; font-family: Helvetica, Arial , sans-serif ">   CUADRO COMPARATIVO  DE COTIZACIONES  </div></div></td></tr>
                   </table>

       </td>
       <td>
            <div class="version" align="right">
                    <table>
                    <tr><td width="75px"></td> <td class="rights"> @copyright M.D.V.</td></tr>
                    <tr><td width="75px"> <td class="rights"> Version : V.2015. </td></tr>

                    </table>

                    <div style="margin-left: 10px; margin-top: 0px;" >
                    <div   class="titulo"             style=" border: 1px #444 solid; border-radius: 8px;width: 130px ; height: 20px; padding-top: 5px; font-size: 14px ;   padding-bottom: 0px; font-family: Helvetica" > Fecha : <strong>{{ $ReturnData["CC"][0]->cdrFecha }} </strong></div>
                    <div class="titulo" style="width: 130px; font-weight: bold; font-size: 18px; border-color: #555; border-radius: 10px;"  >{{ $ReturnData["CC"][0]->cdrCodigo }}</div>
                    </div>

              </div>
        </td>
       </tr>
        </table>

 </div>
 <div class="footer" align="center"  style="font-size: 11px;">   <!-- ** DATOS FIRMAS ****************************************** -->
          <hr style="width: auto; " >
          <span style="font-size: 9px;"> Municipalidad Distrital de Vilcabamba  -    Página <span class="pagenum"></span></span>
 </div>

<div class="info" style="margin-right: 20px; margin-top: -5px;border:0;">
 <table cellpadding="0" cellspacing="0">
 <tr ><td > <label class="labels"> DEPENDENCIA : </label> ( {{  $ReturnData["CCReq"][0]->reqDepCod    }}  ) {{  $ReturnData["CCReq"][0]->reqDepDsc    }}  </td></tr>
 <tr ><td> <label class="labels"> SEC FUN : </label>  ( {{  $ReturnData["CCReq"][0]->reqSecFunCod    }}  ) {{  $ReturnData["CCReq"][0]->reqSecFunDsc    }}  </td></tr>
</table>
</div>

 <table style="margin-left: 5px; margin-right: 5px; margin-top: -5px;" width="100%" cellpadding="0" cellspacing="0">
 <thead>
 <tr style="font-size: 12px;">
 <th style="width: 90px;"> - </th>
 <th style="width: 350px;" > - </th>
 <th style="width: 185px;">(a)</th>
 <th style="width: 185px;">(b)</th>
 <th style="width: 185px;">(c)</th>
</tr>
 </thead>
 <tbody>
            <?php  $Itemmm =1 ;?>
              @foreach($ReturnData["CCDll"] as $key=>$CCDll)
              <?php if ( $Itemmm ==1)
              {?>
              <tr style="background: #f2f2f2;" >
              <td class="dll " style="font-size: 9px;">REFERENCIA</td>
                   <td ALIGN="left"  class="dll " style="align: left; "  >   NRO DE RUC</td>
                   <td ALIGN="center" class="dll" style="font-size: 14px;font-weight: bold;">   {{ $CCDll->ruc1 }}</td>
                   <td ALIGN="center" class="dll" style="font-size: 14px;font-weight: bold;">   {{ $CCDll->ruc2    }}</td>
                   <td ALIGN="center" class="dll" style="font-size: 14px;font-weight: bold;">   {{ $CCDll->ruc3    }}</td>
              </tr>
              <tr class="dll">
             <td style="font-size: 12px ; font-family:  Helvetica, Arial, sans-serif" align="center"> {{$ReturnData["CCReq"][0]->reqCodigo }} <BR> {{$ReturnData["CCReq"][0]->reqCtzCod }} </td>
                   <td ALIGN="left" class="dll " style="align: left; ">   RAZON SOCIAL  </td>
                   <td ALIGN="center" class="dll " style="font-size: 9px;">   {{ $CCDll->RSocial1 }}</td>
                   <td ALIGN="center" class="dll " style="font-size: 9px;">   {{ $CCDll->RSocial2 }}</td>
                   <td ALIGN="center" class="dll " style="font-size: 9px;">   {{ $CCDll->RSocial3 }}</td>
              </tr>

              <tr class="dll">
              <td ></td>

                    <td ALIGN="left" class="dll " style="align: left;" >  PLAZO  .......................... IGV </td>
                    <td ALIGN="center" class="dll ">  <table><tr><td>Plz :</td><td align="CENTER"  style="  font-size: 10px;">{{ $CCDll->plz1 }}  </td> <td > - ¿incluye IGV?= </td> <td align="left"  style="  font-weight: bold; font-size: 11px;"> {{ $CCDll->igv1 }} </td>  </tr></table> </td>
                    <td ALIGN="center" class="dll ">  <table><tr><td>Plz :</td><td align="CENTER"  style="  font-size: 10px;">{{ $CCDll->plz2 }}  </td> <td > - ¿incluye IGV?=</td> <td align="left"  style="  font-weight: bold; font-size: 11px;"> {{ $CCDll->igv2 }} </td>  </tr></table> </td>
                    <td ALIGN="center" class="dll ">  <table><tr><td>Plz :</td><td align="CENTER"  style="  font-size: 10px;">{{ $CCDll->plz3 }}  </td> <td > - ¿incluye IGV?=</td> <td align="left"  style="  font-weight: bold; font-size: 11px;"> {{ $CCDll->igv3 }} </td>  </tr></table> </td>
              </tr>
              <?php }$Itemmm=2;?>
              @endforeach
</tbody>
</table>



             <table  style="font-size: 9px; margin-left:5px ;  font-family: Helvetica, Arial, sans-serif; margin-top: 3px;  "  width="100%">
             <thead style="font-size: 7px;   font-family: Arial, sans-serif;">
             <tr >
              <th ALIGN="center" class="dll" width="10px">Nº</th>
              <th ALIGN="center" class="dll" width="40px">Cant</th>
              <th ALIGN="center" class="dll" width="20px">Und</th>
              <th                class="dll" width="350px"> Descripcion  </th>

              <th ALIGN="center" class="dll" width="65px" >Marca(a)</th>
              <th ALIGN="center" class="dll" width="55px">Precio(a)</th>
              <th ALIGN="center" class="dll" width="55px">Total(a)</th>

              <th ALIGN="center" class="dll" width="65px" >Marca(b)</th>
              <th ALIGN="center" class="dll" width="55px">Precio(b)</th>
              <th ALIGN="center" class="dll" width="55px">Total(b)</th>

              <th ALIGN="center" class="dll" width="65px">Marca(c)</th>
              <th ALIGN="center" class="dll" width="55px">Precio(c)</th>
              <th ALIGN="center" class="dll" width="55px">Total(c)</th>

             </tr>
              </thead>
              <tbody >
              <?php $Total=0; $Item =1 ; $monto1=0; $monto2=0;$monto3=0;  ?>
              @foreach($ReturnData["CCDll"] as $key=>$CCDll)
               <?php  $monto1+= $CCDll->subTotal1; $monto2+= $CCDll->subTotal2; $monto3+= $CCDll->subTotal3;?>
              <tr class="dll">
                   <td ALIGN="center" class="dll" style="font-size: 9px;"><?php echo $Item++ ;?></td>
                   <td ALIGN="center" class="dll" style="font-size: 9px;">  {{ $CCDll->cant     }}</td>
                   <td ALIGN="center" class="dll" style="font-size: 9px;">  {{ $CCDll->und }}</td>
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px; font-size: 9px;" > {{ $CCDll->prdDsc   }}</td>

                   <td ALIGN="center" class="dll rights" style="font-size: 9px;">   {{ $CCDll->marca1   }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->precio1 }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->subTotal1    }}</td>

                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->marca2   }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->precio2 }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->subTotal2    }}</td>

                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->marca3   }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->precio3 }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->subTotal3    }}</td>
              </tr>
              @endforeach

              <tr class="dll">
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px; font-size: 9px;" colspan="4" ></td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;background: #f2f2f2;"  colspan="2"           >   Total :</td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;background: #f2f2f2;font-weight: bold;">   <?php echo  number_format ( $monto1 ,2) ?></td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;background: #f2f2f2;"   colspan="2">   Total :</td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;background: #f2f2f2;font-weight: bold;">   <?php echo  number_format ( $monto2 ,2) ?></td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;background: #f2f2f2;"  colspan="2">   Total :</td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;background: #f2f2f2; font-weight: bold;">   <?php echo  number_format ( $monto3 ,2) ?></td>
              </tr>

               <tr class="dll">
                   <td ALIGN="right" class=" rigths" style="padding-left: 6px; font-size: 9px;" colspan="4" > DETALLES : </td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;" colspan="3" >  {{ $CCDll->obsv1 }} </td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;" colspan="3" >  {{ $CCDll->obsv2 }} </td>
                   <td ALIGN="center" class="dll rights" style="font-size: 9px;" colspan="3" >  {{ $CCDll->obsv3 }} </td>
               </tr>

               <tr>
               <td colspan="3" class="dll lefts"  >  <div style="margin-left: 10px"><strong>N°Items :<?php echo --$Item;?> </strong> </div> </td>
               <td colspan="7" class="dll lefts"  valign="top">
                    <table >
                    <tr> <td ><label class="labels"> OBSV :</label> <label style="font-size: 11px;">{{  $ReturnData["CC"][0]->cdrObsv  }} </label></td>  </tr>
                    </table>
              </td>
               <td colspan="3" class="dll rights"  valign="center" style="font-size: 8px">
               Elb:{{  $ReturnData["CC"][0]->cdrUsrID  }}  -- Imp: {{$ReturnData["Usr"] }}<br>
               </td>
              </tr>
          </tbody>
          </table>
       
		
         <div style="font-size: 12px;margin-left: 15px;padding-top: 5px;"  ><strong>ADJUDICACION : SE LE OTORGA LA BUENA PRO</strong></div>
          <div class="info" style="margin-top:0px;margin-right: 20px;  background: #f2f2f2;">
            @foreach($ReturnData["CCAdj"] as $key=>$nom)
                <table  style="font-size: 11px; margin-top: 0px;" width="100%" cellspacing="0px" cellpadding="0">
                <tr> <td width="90px"> RUC  </td>   <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td style="font-weight: bold; font-size: 13px;"  id="tbAdjRuc"  name="tbAdjRuc" >  {{ $nom->fteRuc }} </td> </tr>
                <tr> <td> Razon Social  </td>     <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjRSocial" > {{ $nom->fteRazon }} </td> </tr>
                <tr> <td> Monto  </td>            <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjMonto"> {{ $nom->fteTotal }} </td> </tr>
                <tr> <td> Plazo de Entrega</td>   <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjPlazo" > {{ $nom->ftePlazo }} </td> </tr>
                <tr> <td> Garantia  </td>         <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjGarantia" >  {{ $nom->fteGarantia }}  </td> </tr>
                <tr> <td> Justificacion </td>         <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjGarantia" >  {{ $ReturnData["CC"][0]->cdrJustf }}  </td> </tr>
                <tr> <td> Lugar de Entrega </td>         <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td  id="tbAdjLugarEnt" >  {{ $ReturnData["CC"][0]->cdrLugarEnt }}  </td> </tr>
                @if ($nom->fteIgv=="RH")
				<tr> <td colspan="2"></td><td  id="tbAdjIGV" > =========== {{ $nom->fteIgv }} =============== </td> </tr>
			    @else 
				<tr> <td colspan="2"></td><td  id="tbAdjIGV" > =========== {{ $nom->fteIgv }} INCLUYE IGV ================= </td> </tr>
			    @endif
                </table>
            @endforeach
          </div>

</body>
</html>