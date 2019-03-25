<div class="container" style="width: 1200px">
    <div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
        <div class="panel-body">

            <div class="panel panel-default" style="margin-top: 5px; margin-bottom: -5px; " >
                <div class="panel-heading gs-panel-heading"  style="padding: 5px" >
                    <table>
                        <tr align="RIGHT">
                            <TD> <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">  </TD>
                            <td> ::: RECORD DE PROVEEDORES  </td>
                        </tr>
                    </table>
                </div>


                <table style="margin-bottom:-20px" width="100%">
                    <tr>
                        <td>
                            <div class="panel panel-default" style="margin-top:5px; margin-left:5px; margin-right: 5px; padding:5px;" >
                                <form id="frmFindRanking" method="post">
                                    {{ csrf_field() }}
                                    <table style="margin:5px; table-layout: fixed;" width="100%">
                                        <tr>
                                            <td align="left" style="font-weight: bold" width="10%"> RECORD SEGÚN </td>
                                            <td width="1%">:</td>
                                            <td width="20%">
                                                <select name="rnkTipo" id="rnkTipo" class="form-control form-control-sm">
                                                    <option value="oc">Proveedor de Bienes</option>
                                                    <option value="os">Proveedor de Servicios</option>
                                                    <option value="cs">Bienes y Servicios</option>
                                                </select>
                                            </td>
                                            <td align="center" width="10%">
                                                <span id="btnBuildRanking" class="btn btn-primary"> BUSCAR </span>
                                            </td>
                                            <td align="center" width="12%">
                                                <button class="btn btn-success" id = "btnLogRankingExcel"> Exportar ( *.xls)</button>
                                            </td>
                                            <td align="center" width="12%">
                                                {{--<button class="btn btn-danger" id = "btnLogRankingPdf"> Mostrar ( *.pdf)</button>--}}
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <div id="dvPriceFilter" class="panel panel-default"  style="margin-left:5px; padding-top:5px;" >
                                <TABLE class="suggest-element table table-striped gs-table-item gs-table-hover " id="tabPriceFilter" style="table-layout: fixed" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="10%"  align="center">NRO</th>
                                        <th align="left" >RUC</th>
                                        <th width="10%">PROVEEDOR</th>
                                        <th width="8%">DE</th>
                                        <th width="8%"  align="center">MONTO PROVEIDO</th>
                                    </tr>
                                    </thead>
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