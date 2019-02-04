<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="panel with-nav-tabs panel-info">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-data" data-toggle="tab">Datos Generales</a></li>
            <li><a href="#tab-seguimiento" data-toggle="tab">Seguimiento</a></li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown">Internamiento<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    @foreach($ingreso as $iCod)
                        <li>
                            <a href="{{ '#tab-'.$iCod->pint_cpi }}" data-toggle="tab">{{ $iCod->pint_cpi }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown">Salida<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    @if(count($salida) == 0)
                        <li>Sin Salida</li>
                    @endif
                    @foreach($salida as $sCod)
                        <li>
                            <a href="{{ '#tab-'.$sCod->psal_pecosa }}" data-toggle="tab">{{ $sCod->psal_pecosa }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-data">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-4">
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label">Orden de Compra </label>:
                            <input class="alm-input-frm" type="text" value="{{ $internamiento->oc_cod }}" disabled>
                        </div>
                        <div class="form-group alm-form-group" style="overflow: hidden;">
                            <label class="control-label alm-label" style="float: left;">Nro Factura </label><span style="float: left;">:</span>
                            <div class="alm-input-frm" style="width: 50%; float: left;">
                                {{ trim($internamiento->ing_factura) }}
                                {{--<a href="#" class="updtField" data-name="editFactura" data-pk="{{ $internamiento->ing_giu }}" data-type="text">--}}
                                    {{--{{ trim($internamiento->ing_factura) }}--}}
                                {{--</a>--}}
                            </div>
                        </div>
                        {{--<div class="form-group alm-form-group">
                            <label class="control-label alm-label">Fecha de Registro</label>:
                            <input class="alm-input-frm" type="text" value="{{ $internamiento->ing_fecha }}" disabled>
                        </div>--}}
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label" style="float: left;">Guía de Remisión </label><span style="float: left;">:</span>
                            <div class="alm-input-frm" style="width: 50%; float: left;">
                                {{ trim($internamiento->ing_guiaremision) }}
                                {{--<a href="#" class="updtField" data-name="editRemision" data-pk="{{ $internamiento->ing_giu }}" data-type="text">--}}
                                    {{----}}
                                {{--</a>--}}
                            </div>
                        </div>

                        {{--<div class="form-group alm-form-group">
                            <label class="control-label alm-label"> Fecha Internamiento </label>:
                            <input class="alm-input-frm" type="text" value="{{ $internamiento->conf_fecha }}" disabled>
                        </div>--}}
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label"> Plazo de Entrega</label>:
                            <input class="alm-input-frm" type="text" value="{{ $internamiento->oc_plazo_dias }}" disabled>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label">Fecha Límite</label>:
                            <input class="alm-input-frm" type="text" value="{{ $internamiento->oc_fecha_limite }}" disabled>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label">Documentos.Ref. </label>:
                            <input class="alm-input-frm" type="text" value="{{ $internamiento->oc_docRef }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label">Proveedor </label>:
                            <textarea class="alm-input-frm" disabled> {{ $internamiento->oc_rucprovee.' - '.$internamiento->oc_proveedor }} </textarea>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label alm-label">Observación</label>:
                            <textarea class="alm-input-frm" disabled>{{ $internamiento->ing_obs }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-heading alm-panel-heading">INVENTARIO ACTUAL</div>
                            <table class="table alm-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PRODUCTO</th>
                                        <th>MARCA</th>
                                        <th>STOCK</th>
                                        <th>UNIDAD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($internamiento->inventario as $key => $sBien)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $sBien->prod_desc }}</td>
                                            <td>{{ $sBien->prod_marca }}</td>
                                            <td>{{ $sBien->prod_stock }}</td>
                                            <td>{{ $sBien->prod_medida }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade in" id="tab-seguimiento">
                <div class="panel panel-default">
                    <div class="panel-heading">SEGUIMIENTO PROCESO</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ORDEN DE COMPRA</th>
                                <th>FECHA OC</th>
                                <th>INTERNAMIENTO</th>
                                <th>FECHA GI</th>
                                <th>DISTRIBUCION</th>
                                <th>FECHA PECOSA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $internamiento->oc_cod }}</td>
                                <td>{{ $internamiento->oc_fecha }}</td>
                                <td>{{ '('.$internamiento->ing_giu.')' }}
                                    @foreach($ingreso as $item)
                                        <p>{{ $item->pint_cpi }}</p>
                                    @endforeach
                                </td>
                                <td>{{ $internamiento->conf_fecha }}
                                    @foreach($ingreso as $item)
                                        <p>{{ $item->pint_fecha }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($salida as $item)
                                        <p>{{ $item->psal_pecosa }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($salida as $item)
                                        <p>{{ $item->psal_fecha }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">SEGUIMIENTO ACTIVIDADES</div>
                    <table class="table alm-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>OPERACION</th>
                                <th>DESCRIPCION</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seguimiento as $key=>$step)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $step->seg_operacion }}</td>
                                    <td>{{ $step->seg_descripcion }}</td>
                                    <td>{{ $step->seg_fecha }}</td>
                                    <td>{{ $step->seg_hora }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @foreach($ingreso as $iCod)
                <div class="tab-pane fade in" id="{{ 'tab-'.$iCod->pint_cpi }}">
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-sm-4">
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Guia de Internamiento</label>:
                                <input class="alm-input-frm" type="text" value="{{ $iCod->cod_giu }}" disabled>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Proceso de Intern.</label>:
                                <input class="alm-input-frm" type="text" value="{{ $iCod->pint_cpi }}" disabled>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label" style="float: left">Fecha de Intern.</label><span style="float: left;">:</span>
                                <div class="alm-input-frm" style="width: 50%; float: left;">
                                    {{ $iCod->pint_fecha }}
                                    {{--<a href="#" class="updtDateField" data-name="editFecIntern" data-pk="{{ $iCod->pint_cpi }}" data-type="date" data-format="dd-mm-yyyy">--}}
                                        {{--{{ $iCod->pint_fecha }}--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Resp. de Entrega</label>:
                                <input type="text" style="width: 300px" class="alm-input-frm" value="{{ $iCod->pint_dni_pentrega.'-'.$iCod->pint_pentrega }}" disabled>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Resp. de Recepción</label>:
                                <input type="text" style="width: 300px" class="alm-input-frm" value="{{ $iCod->pint_dni_receptor.'-'.$iCod->pint_preceptor }}" disabled>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Observación</label>:
                                <input type="text" style="width: 300px" class="alm-input-frm" value="{{ $iCod->pint_observacion }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    DETALLE DE LOS BIENES INGRESADOS
                                </div>
                                <table class="table alm-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>PRODUCTO</th>
                                            <th>MARCA</th>
                                            <th>CANT</th>
                                            <th>RECEP</th>
                                            <th>PRECIO</th>
                                            <th>COSTO</th>
                                            <th>OBS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($iCod->productos_ingresados as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->pintp_desc }}</td>
                                            <td>{{ $item->pintp_marca }}</td>
                                            <td>{{ $item->pintp_cant }}</td>
                                            <td>{{ $item->pintp_cantr }}</td>
                                            <td>{{ $item->pintp_precio }}</td>
                                            <td>{{ $item->pintp_costo }}</td>
                                            <td>{{ $item->pintp_observacion }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($salida as $sCod)
                <div class="tab-pane fade in" id="{{ 'tab-'.$sCod->psal_pecosa }}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Guia de Internamiento</label>:
                                <input class="alm-input-frm" type="text" value="{{ $sCod->ing_giu }}" readonly>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">PECOSA</label>:
                                <input class="alm-input-frm" type="text" value="{{ $sCod->psal_pecosa }}" disabled>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Fecha de Salida</label>:
                                <div class="alm-input-frm" style="width: 149px; display: inline-block">
                                        {{ $sCod->psal_fecha }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Despachador</label>:
                                <div class="alm-input-frm" style="width: 400px; display: inline-block">
                                        {{ $sCod->psal_usu_despachador }}
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Solicitante</label>:
                                <div class="alm-input-frm" style="width: 80px; display: inline-block">
                                        {{ $sCod->psal_dni_solicitante }}
                                </div>
                                <input class="alm-input-frm" style="width: 317px" value="{{ $sCod->psal_solicitante }}">
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Cargo</label>:
                                <div class="alm-input-frm" style="width: 400px; display: inline-block;">{{ $sCod->psal_solic_cargo }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-sm-12">
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Dependencia</label>:
                                <input class="alm-input-frm" type="text" value="{{ $sCod->psal_dependencia_solic }}" disabled>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Destino</label>:
                                <div class="alm-input-frm" style="width: 732px; display: inline-block;">{{ trim($sCod->psal_destino) }}</div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="control-label alm-label">Observación</label>:
                                <div class="alm-input-frm" style="width: 732px; display: inline-block;">{{ $sCod->psal_observacion }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    DETALLE DE BIENES DISTRIBUIDOS
                                </div>
                                <table class="table alm-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>PRODUCTO</th>
                                            <th>MARCA</th>
                                            <th>CANT</th>
                                            <th>ATENDIDO</th>
                                            <th>PRECIO</th>
                                            <th>COSTO</th>
                                            <th>OBS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sCod->productos_distribuidos as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->psalp_desc }}</td>
                                            <td>{{ $item->psalp_marca }}</td>
                                            <td>{{ $item->psalp_cant }}</td>
                                            <td>
                                                    {{ $item->psalp_cant_atend }}
                                            </td>
                                            <td>{{ $item->psalp_precio }}</td>
                                            <td>{{ $item->psalp_costo }}</td>
                                            <td>{{ $item->psalp_observacion }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
/*$('.dateLimit').editable({
        type: 'combodate',
        url: 'refresh/description',
        title: 'Descripción Formato',
        success: function(response){
            alert('Campo actualizado correctamente');
        }
    });*/

    var token = $('meta[name="csrf-token"]').attr('content');

    $('.updtDateField').editable({
        url: 'update/gi',
        mode: 'outline',
        placement: 'right',
        params: {_token: token},
        datepicker:{
            language: 'es',
            weekStart: 1
        }
    });

    $('.updtField').editable({
        url: 'update/gi',
        emptytext: 'Vacío',
        params: {_token: token},
        success:function(response){
            alert(response);
        }
    });

});

</script>