<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">

<div class="panel panel-default" style="margin-top: 5px; margin-bottom: -5px; " >
<div class="panel-heading gs-panel-heading"  style="padding: 5px" > 
 <table>
 <tr align="RIGHT"> 
    <TD> <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">  </TD>
    <td> ::: PRECIOS REFERENCIALES  </td>   
 </tr>
 </table>
</div>


<table style="margin-bottom:-20px" width="100%">
<tr>
<td>
        <div class="panel panel-default" style="margin-top:5px; margin-left:5px; margin-right: 5px; padding:5px;" >
        <table style="margin:5px; table-layout: fixed;" width="100%">
        <tr>
          <td align="left" style="font-weight: bold" width="15%"> NOMBRE DEL PRODUCTO </td>
            <td width="1%">:</td>
            <td>
                <input type="text" class="form-control input-sm">
            </td>
            <td align="center" width="10%" style="font-weight: bold">DOCUMENTO</td>
            <td width="1%">:</td>
            <td>
                <select name="" id="" class="form-control input-sm">
                    <option value="OC">Orden de Compra</option>
                    <option value="CC">Cuadro Comparativo</option>
                    <option value="RQ">Requerimiento</option>
                </select>
            </td>
            <td width="1%"></td>
        </tr>
         <tr>
             <td colspan="6" align="right" style="padding-top: 5px;">
                 <span id="btnPriceClear" class="btn btn-default"> LIMPIAR </span>
                 <span id="btnPriceSearch" class="btn btn-primary"> PRECIOS </span>
             </td>
             <td></td>
        </tr>
        </table>
        </div>
</td>
</tr>
<tr>
<td>

         <div id="dvPriceFilter" class="panel panel-default"  style="overflow: scroll;   overflow-x: hidden;   height: 200px; margin-left:5px; margin-top:5px;" >
         <TABLE class="suggest-element table table-striped gs-table-item gs-table-hover " id="tabPriceFilter" style="table-layout: fixed" width="100%">
          <thead>
             <tr>            
             <th width="10%"  align="center">Codigo</th>
             <th width="55%"  align="left" >Descripcion</th>
             <th width="5%"  align="center">Det</th>
             <th width="10%"  align="center">Precio Mín</th>
             <th width="10%"  align="center">Precio Máx</th>
             <th width="10%"  align="center">Promedio</th>
             </tr>
          </thead>
          <tbody>
              
          </tbody>
          </TABLE>

         </div>
</td>
</tr>
</table>
<div  id ="dvPriceDll" class="panel panel-default" style="margin:5px; padding:10px;">
  

</div>

</div>



</div> <!-- modal -->

<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">


<div id="divDialog">
<div id="divDialogCont"></div>
</div>

</div>
</div>



<script type="text/javascript">




</script>>