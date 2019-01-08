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


<table style="margin-bottom:-20px">
<tr>
<td>
        <div class="panel panel-default" style="margin-top:5px; margin-left:5px;padding:5px; width: 210px" >
        <table style="margin:5px">
        <tr>
          <td align="left">  <span id="btnPriceFilterNew" class="btn btn-success" STYLE="WIDTH:180PX;height: 40px; padding-top: 10px; font-weight: normal; margin-left:0px;">Añadir Filtro</span>  </td> 
         </tr>
         <tr>
          <td align="left">   <span id="btnPriceClear" class="btn btn-default" STYLE="WIDTH:180PX;height: 40px; padding-top: 10px; font-weight: normal; margin-left:0px; margin-top:5px;"> Limpiar Todo</span>  </td> 
        </tr>
        <tr>
          <td align="left">  
          <span id="btnPriceSearch" class="btn btn-primary" STYLE="WIDTH:180PX;height: 40px; padding-top: 10px; font-weight: normal; margin-left:0px;  margin-top:55px;"> BUSCAR PRECIOS </span>  
          </td>
          </tr>
        </table>
        </div>
</td>
<td>

         <div id="dvPriceFilter" class="panel panel-default"  style="overflow: scroll;   overflow-x: hidden;   height: 200px; width:910px;margin-left:5px; margin-top:5px;" >
         <TABLE class="suggest-element table table-striped gs-table-item gs-table-hover " id="tabPriceFilter" >
          <thead>
             <tr>            
             <th width="100px"  align="center">Codigo</th>
             <th width="700px"  align="left" >Descripcion</th>
             <th width="30px"  align="center">-</th>
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