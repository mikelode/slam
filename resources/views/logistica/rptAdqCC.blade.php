<!DOCTYPE html>
<html>
<head>
 <style>
  @page { margin: 10px 10px 0px 5px; padding-bottom:0px;  }

.header {
  height: 80px;
  position: fixed;
  left: 0px;
  top: 0px;
  right: 0px;
  margin-bottom: 30px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.footer {
  position: fixed;
  bottom: -4;
  width: 100%;
  font-size: 10px;
  display: inline-block;
  height: 2;
background:#ccc;
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
 margin-right: 10px;
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
  font-size: 13px;
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
                <img src="{{ config('slam.APP_LOGO') }}" width="90px" height="90" style="margin-left: 30px;">
              </div>
       </td>
       <td >

                   <table class="entidad" >
                  
                   <tr><td class="entidadMuni">   {{ config('slam.APP_ENTIDAD') }}  <td></tr>
                   <tr><td class="entidadMuni" style="font-size: 12px;">   RUC:	{{ config('slam.ENTIDAD_RUC') }} </td></tr>
                   <tr><td align="center" class="centers"> <div style="width: 700px;"> <div class="titulo entidadMuni"  style="margin-left: 60px;  width: 550px; border-radius: 10px;font-size:20px;font-weight: bold; font-family: Helvetica, Arial , sans-serif ">   CUADRO COMPARATIVO  DE COTIZACIONES  </div></div></td></tr>
                   </table>

       </td>
       <td>
            <div class="version" align="right">
                    <table>
                    <tr><td width="75px"></td> <td class="rights">{{ config('slam.AUTHOR') }}</td></tr>
                    <tr><td width="75px"> <td class="rights"> {{ config('slam.VERSION') }} </td></tr>

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
          <span style="font-size: 9px;"> {{ config('slam.ENTIDAD_PIE') }}  -    Página <span class="pagenum"></span></span>
 </div>

 <h4 style ="margin:0px; padding:0px;margin-left:10px; font-size: 12px;">   {{  $ReturnData["CC"][0]->cdrMotivo   }}</h4>
<div class="info" style="margin-right: 20px; margin-top: -5px;border:0;">
 <table cellpadding="0" cellspacing="0">
<!-- <tr ><td > <label class="labels"> DEPENDENCIA : </label> ( {{  $ReturnData["CCReq"][0]->reqDepCod    }}  ) {{  $ReturnData["CCReq"][0]->reqDepDsc    }}  </td></tr> -->
 <tr ><td> <label class="labels"> SEC FUN : </label>  ( {{  $ReturnData["CCReq"][0]->reqSecFunCod    }}  ) {{  $ReturnData["CCReq"][0]->reqSecFunDsc    }}  </td></tr>
</table>
</div>

 <table style="margin-left: 5px; margin-right: 5px; margin-top: -5px;" width="100%" cellpadding="0" cellspacing="0">
 <thead>
 <tr style="font-size: 12px;">
	 <th style="width: 90px;"> - </th>
	 <th style="width: 280px;" > - </th>
	 <th style="width: 185px;">(a)</th>
	 <th style="width: 185px;">(b)</th>
	 <th style="width: 185px;">(c)</th>
</tr>
 </thead>
 <tbody>
                  
              <tr>
				   <td class="dll " style="font-size: 9px;">REFERENCIA</td>
                   <td align="left"  class="dll " style="align: left; "  >   NRO DE RUC</td>
                   <td align="center" class="dll" style="font-size: 14px;font-weight: bold;">   {{ $ReturnData["CCDll"][0]->ruc1 }}</td>
                   <td align="center" class="dll" style="font-size: 14px;font-weight: bold;">   {{ $ReturnData["CCDll"][0]->ruc2    }}</td>
                   <td align="center" class="dll" style="font-size: 14px;font-weight: bold;">   {{ $ReturnData["CCDll"][0]->ruc3    }}</td>
              </tr>
              <tr >
				   <td style="font-size: 10px ;"> {{$ReturnData["CCReq"][0]->reqCodigo }} / {{$ReturnData["CCReq"][0]->reqCtzCod }} </td>
                   <td align="left" class="dll " style="align: left; ">   RAZON SOCIAL  </td>
                   <td align="center" class="dll " style="font-size: 9px;">   {{ $ReturnData["CCDll"][0]->RSocial1 }}</td>
                   <td align="center" class="dll " style="font-size: 9px;">   {{ $ReturnData["CCDll"][0]->RSocial2 }}</td>
                   <td align="center" class="dll " style="font-size: 9px;">   {{ $ReturnData["CCDll"][0]->RSocial3 }}</td>
              </tr>

              <tr >
					<td ></td>
                    <td align="left" class="dll " style="align: left;" >  PLAZO  .......................... IGV </td>
                    <td align="center" class="dll ">  <table><tr valign="top"><td>Plz :</td><td align="CENTER"  style="  font-size: 10px;">{{ $ReturnData["CCDll"][0]->plz1 }}  / ¿incluye IGV?=<strong> {{ $ReturnData["CCDll"][0]->igv1 }} </strong></td>  </tr></table> </td>
                    <td align="center" class="dll ">  <table><tr valign="top"><td>Plz :</td><td align="CENTER"  style="  font-size: 10px;">{{ $ReturnData["CCDll"][0]->plz2 }}  / ¿incluye IGV?=<strong>{{ $ReturnData["CCDll"][0]->igv2 }} </strong></td>  </tr></table> </td>
                    <td align="center" class="dll ">  <table><tr valign="top"><td>Plz :</td><td align="CENTER"  style="  font-size: 10px;">{{ $ReturnData["CCDll"][0]->plz3 }}  / ¿incluye IGV?=<strong>{{$ReturnData["CCDll"][0]->igv3 }} </strong></td>  </tr></table> </td>
              </tr>
			 
</tbody>
</table>




             <table  style="font-size: 9px; margin-left:5px ;  font-family: Helvetica, Arial, sans-serif; margin-top: 3px;  "  width="100%">
             <thead style="font-size: 7px;   font-family: Arial, sans-serif;">
             <tr style="font-size:10px; height:8px;" height="8px">
              <th align="center" class="dll" width="10px" style="font-size:8px">Nº</th>
              <th align="center" class="dll" width="40px" style="font-size:8px">Cant</th>
              <th align="center" class="dll" width="20px" style="font-size:8px">Und</th>
              <th                class="dll" width="280px" style="font-size:8px"> Descripcion  </th>

              <th align="center" class="dll" width="65px" style="font-size:8px" >Marca(a)</th>
              <th align="center" class="dll" width="45px" style="font-size:8px">Precio(a)</th>
              <th align="center" class="dll" width="55px" style="font-size:8px">Total(a)</th>

              <th align="center" class="dll" width="65px" style="font-size:8px" >Marca(b)</th>
              <th align="center" class="dll" width="45px" style="font-size:8px">Precio(b)</th>
              <th align="center" class="dll" width="55px" style="font-size:8px">Total(b)</th>

              <th align="center" class="dll" width="65px" style="font-size:8px">Marca(c)</th>
              <th align="center" class="dll" width="45px" style="font-size:8px">Precio(c)</th>
              <th align="center" class="dll" width="55px" style="font-size:8px">Total(c)</th>

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
                   <td ALIGN="left" class="dll lefts" style="padding-left: 6px; font-size: 8.5px;" > {{ $CCDll->prdDsc   }}</td>

                   <td ALIGN="center" class="dll rights" style="font-size: 8px;">   {{ $CCDll->marca1   }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->precio1 }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->subTotal1    }}</td>

                   <td ALIGN="right" class="dll rights" style="font-size: 8px;">   {{ $CCDll->marca2   }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->precio2 }}</td>
                   <td ALIGN="right" class="dll rights" style="font-size: 9px;">   {{ $CCDll->subTotal2    }}</td>

                   <td ALIGN="right" class="dll rights" style="font-size: 8px;">   {{ $CCDll->marca3   }}</td>
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
                    <tr> <td ><label class="labels"> </label> <label style="font-size: 11px;"><?php  echo  html_entity_decode (  str_replace  ( "*", "<br><br>",$ReturnData["CC"][0]->cdrObsv )) ?> </label></td>  </tr>
                    </table>
              </td>
               <td colspan="3" class="dll rights"  valign="center" style="font-size: 8px">
               Elb:{{  $ReturnData["CC"][0]->cdrUsrID  }}  -- Imp: {{$ReturnData["Usr"] }}<br>
               </td>
              </tr>
          </tbody>
          </table>
        <BR>
              
		    
         <div style="font-size: 10px;margin-left: 15px;padding-top:0px;"  ><strong>ADJUDICACION : SE LE OTORGA LA BUENA PRO</strong></div>
          <div class="info" style="margin-top:0px;margin-right: 20px;  background: #f2f2f2;font-size:8px;" >
            @foreach($ReturnData["CCAdj"] as $key=>$nom)
                <table  style="font-size: 11px; margin-top: 0px;" width="100%" cellspacing="0px" cellpadding="0">
                <tr> <td width="100px"> RUC  </td>   <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td style="font-weight: bold; font-size: 13px;"  id="tbAdjRuc"  name="tbAdjRuc" >  {{ $nom->fteRuc }} </td> </tr>
                <tr> <td> Razon Social  </td>     <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjRSocial" > {{ $nom->fteRazon }} </td> </tr>
                <tr> <td> Monto  </td>            <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjMonto"> {{ $nom->fteTotal }} </td> </tr>
                <tr> <td> Plazo de Entrega</td>   <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjPlazo" > {{  $ReturnData["CC"][0]->cdrEntrega }} </td> </tr>
               <!-- <tr> <td> Garantia  </td>         <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td id="tbAdjGarantia" >  {{ $nom->fteGarantia }}  </td> </tr>  -->
				<tr> <td> Plazo de Ejecucion </td>         <td WIDTH="20PX" ALIGN="CENTER"> : </td> <td  id="tbAdjLugarEnt" >  {{ $ReturnData["CC"][0]->cdrEjecucion  }}  </td> </tr>
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