<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">




 <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 58px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="410px">
        <span style="font-size: 16px;font-weight:bold;"> REPORTE DE ORDENES DE COMPRA Y SERVICIO :</span>
        </td>
        <td width="10"></td>
       
    </tr>
    </table>
</div>

<div class="panel-heading gs-panel-heading"  style=" border-radius: 5px; width: 1140px ;  height: 240px; border: 1px solid #ddd ; padding-top: 0px; margin-top: 0px ; margin-bottom:5px; background: #f9f9f9 ;   " >


              

                <table  class="gs-table">
                        <tr>
                        <td align="right"> {!! Form::label('first_name','AÑO DE EJECUCION :', array('class'=> 'gs-label'))!!}  </td>
                        <td colspan="2">

                            
                                 <div class="btn-group btn-input clearfix" >
                                    <button type="button" id="btnLiqCSAnio" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:140px; height: 40px;font-size: 14px;  ">    <span  id="txRptLiqCSAnio"  data-bind="label">Seleccione</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-RptLiqCSAnio" role="menu" style="font-size: 16px; font-weight:bold;">

                                        <li  psrId="2018"><a href="#">2018</a></li>
                                        <li  psrId="2017"><a href="#">2017</a></li>
                                        <li  psrId="2016"><a href="#">2016</a></li>
                                       <li  psrId="2015"><a href="#">2015</a></li>
                                       <li  psrId="2014"><a href="#">2014</a></li>
                                       <li  psrId="2013"><a href="#">2013</a></li>
                                       <li  psrId="2012"><a href="#">2012</a></li>
                                       <li  psrId="2011"><a href="#">2011</a></li>                                      
                                    </ul>
                                 </div>
                            
                        </td>
                       </tr>
                       <tr>
                        <td align="right"> {!! Form::label('first_name','TIPO DE REPORTE :', array('class'=> 'gs-label'))!!}  </td>
                        <td colspan="2">

                            
                                 <div class="btn-group btn-input clearfix" >
                                    <button type="button" id="btnLiqCSTipo" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" style = "width:140px; height: 40px;font-size: 14px;  ">    <span  id="txRptLiqCSTipo"  data-bind="label">Seleccione</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu menu-RptLiqCSTipo" role="menu" style="font-size: 16px; font-weight:bold;">
                                       <li  psrId="GRL"><a href="#">Reporte General</a></li>
                                       <li  psrId="DLL"><a href="#">Reporte Detallado</a></li>                                       
                                    </ul>
                                 </div>
                            
                        </td>
                       </tr>
                       
                     
                        <tr valign="top">
                    			<td align="right"> {!! Form::label('first_name','SECUENCIA FUNCIONAL :', array('class'=> 'gs-label'))!!}  </td>
                    			<td>{!! Form::text('txLiqCSCodSecFun', null, array('ID'=>'txLiqCSCodSecFun' ,'class' => 'form-control gs-input', 'placeholder'=>'Codigo', 'style'=>' padding:6px;width:140px;height:35px ; padding-left:20px; font-weight:bold;font-size:16px;','maxlength'=>'4'))  !!}</td>
                    			
                        </tr>
                        <tr valign="top">
                          <td align="right"> {!! Form::label('first_name','NOM. PROYECTO :', array('class'=> 'gs-label'))!!}  </td>
                          
                          <td>{!! Form::textarea('txLiqCSSecFun', null, array('ID'=>'txLiqCSSecFun' , 'class' => 'form-control gs-input', 'placeholder'=>'Secuencia Funcional', 'style'=>'width:850px; font-size:13px;padding:7px;' , 'rows'=>'2', 'disabled'=>'true'))  !!}</td>
                        </tr>
                       

                     
                        <tr valign="top">
                          <td align="right">  </td>
                          
                          <td>
                            
                              <table class="gs-table" >           
                                <tr>
                                <td><button class="btn btn-primary" id = "btnLiqCSMostrar" style="HEIGHT:45PX;"> Mostrar ( OC / OS ) </button> </td>
                                <td width="50px"> &nbsp;</td>
                                <td><button class="btn btn-default" style="width:120px; HEIGHT:45PX;" data-dismiss="modal"> Cancelar </button></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                                           
            		 </table>
</div>


<div class="panel panel-default" style="margin-top: 5px" >
<div class="panel-body" id="divTarDll" style="overflow: scroll;   height: 450px;" >
<DIV style ="width:1100px">

             <table id="tbOC_Dll" class="suggest-element table table-striped  gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">
        <thead align="center">
        <tr CLASS="gsTh"  >
           
            <th WIDTH="10px"  align="center"   valign="center">Item</th>
            <th WIDTH="50px"  align="center"   valign="center">Año</th>
            <th WIDTH="80px"  align="center"   valign="center">SecFun</th>
            <th WIDTH="80px" align="left"     valign="center">Expediente</th>

            <th WIDTH="180px" align="left"     valign="center">Compromiso</th>
            <th WIDTH="180px" align="left"     valign="center">Devengado</th>
            <th WIDTH="180px" align="left"     valign="center">Girado</th>
            <th WIDTH="180px" align="left"     valign="center">Razon Social</th>
           

         
            
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

</DIV>
</div>
</div>


</div>
</div>
</div>
<div id = "loadModals" > </div>
<div id="divDialog">
<div id="divDialogCont"></div>
</div>

