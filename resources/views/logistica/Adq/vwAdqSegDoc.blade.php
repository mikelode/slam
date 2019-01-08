
<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading" style="overflow: hidden">
                    <div style="float: left">
<div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 58px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

    <table class="gs-table" style="margin-left: 5px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="440px">
        <span style="font-size: 16px;font-weight:bold;"> SEGUIMIENTO DE ORDENES DE COMPRA Y SERVICIO :</span>
        </td>
        <td width="10"></td>
       
    </tr>
    </table>
</div>

                     
                    </div>
                   
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body alm-panel-body">
                    <div class="sub-content" id="idResult">
                        <div class="col-md-3" style="padding-left: 0">
                            <div class="img-lateral img-rounded">
                                <img src="{{ asset('img/teclado.jpg') }}">
                            </div>
                        </div>
                        <div class="col-md-9" >
                            <form id="frm-consultar-doc" action="procesos">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="control-label" for="">(*) Elija tipo de documento</label>
                                    <select class="form-control" name="searchTipo"  id="searchTipo">
                                        <option value="NA" selected>Seleccionar Tipo</option>
                                      <!--  <option value="RQ">RQ - Requerimiento</option>
                                        <option value="CZ">CZ - Cotización</option>
                                        <option value="CD">CC - Cuadro Comparativo</option>    -->                                    
                                        <option value="OC">OC - Orden de Compra</option>
                                        <option value="OS">OS - Orden de Servicio</option>
                                      <!--  <option value="SF">EXP - Expediente SIAF</option>-->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="">(*) Año de Consulta</label>
                                    <select class="form-control" name="searchPeriodo" id="searchPeriodo">
                                        <option value="2016" selected>2016</option>
                                        <option value="2017" selected>2017</option>
                                        <!--<option value="15">2015</option>-->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">(*) Número de Documento - No olvide elegir primero el tipo de documento</label>
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                
                                              
                                                <td width="10%">
                                                    <input class="form-control" type="number" id="searchDocSeg" name="searchDocSeg" value  style="text-align: left; font-size:25px;font-weight: bold; height: 45px; ">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-warning" for="">(*)Datos Obligatorios</label>
                                </div>
                                <div class="alm-button-place">
                                    <a href="#" id="btn-consultar-doc">
                                        <img src="{{ asset('img/boton_consultar.png') }}">
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1"></div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div id="divDialog">
<div id="divDialogCont">

</div>
</div>