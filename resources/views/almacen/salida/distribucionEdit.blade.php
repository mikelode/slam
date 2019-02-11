<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading alm-panel-heading" style="overflow: hidden">
                <div class="col-sm-7" style="float: left;">
                    <div class="alm-title" style="padding: 0; font-size: 20px;">
                        <i class="glyphicon glyphicon-share"></i>
                        EDITAR PECOSA NRO: <b style="font-size: 30px">{{ substr($proceso[0]->psal_pecosa,4) }}</b>
                    </div>

                    {{--<div class="input-group" style="width: 200px;">
                        <input type="text" class="form-control" placeholder="O.C." id="autoFindOc">
                        <span class="input-group-btn">
                            <button class="btn btn-primary">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>--}}
                </div>
                <div class="pull-right">

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default alm-panel">
                    <div class="panel-heading alm-panel-heading">
                        DATOS DE LA GI
                    </div>
                    <div class="panel-body alm-panel-body">
                        <p style="margin: 0 0 4px"><label class="control-label">GI: </label></p>
                        <p>{{ $giu[0]->ing_giu }}</p>
                        <p style="margin: 0 0 4px"><label class="control-label">OC: </label></p>
                        <p>{{ $giu[0]->oc_cod }}</p>
                        <p style="margin: 0 0 4px"><label class="control-label">Fecha Internamiento: </label></p>
                        <p>{{ date("d-m-Y",strtotime($giu[0]->conf_fecha)) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            DATOS PARA LA ATENCIÓN DE BIENES
                        </div>
                        <div class="panel-body alm-panel-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Fecha de Atención</label>
                                    <div class="col-sm-3">
                                        <div class="alm-input-frm">
                                            <a href="#" class="updtGral" data-name="datePs" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="date" data-placement="bottom" data-format="dd-mm-yyyy">
                                                {{ date("d-m-Y",strtotime($proceso[0]->psal_fecha)) }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                {{--<div class="row">--}}
                                    {{--<label class="col-sm-3 control-label">Persona que Despacha</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<div class="alm-input-frm">--}}
                                            {{--<a href="#" class="updtGral" data-name="despachPs" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="text">--}}
                                            {{--{{ $proceso[0]->psal_usu_despachador }}--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="row">--}}
                                    {{--<label class="col-sm-3 control-label">Nombre del Solicitante</label>--}}
                                    {{--<div class="col-sm-2">--}}
                                        {{--<div class="alm-input-frm">--}}
                                            {{--<a href="#" class="updtGral" data-name="solicPs" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="text" data-placement="bottom">--}}
                                                {{--{{ $proceso[0]->psal_dni_solicitante }}--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-7">--}}
                                        {{--<div class="alm-input-frm">--}}
                                            {{--{{ $proceso[0]->psal_solicitante }}--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="row">
                                    <label class="col-sm-3 control-label">Solicito Entregar A:</label>
                                    <div class="col-sm-2">
                                        <div class="alm-input-frm">
                                            <a href="#" class="updtGral" data-name="receptorPs" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="text" data-placement="bottom">
                                                {{ $proceso[0]->psal_receptordni }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="alm-input-frm">
                                            {{ $proceso[0]->psal_receptor }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 control-label">Cargo</label>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="alm-input-frm">
                                            {{ $proceso[0]->psal_solic_cargo }}
                                        </div>
                                    </div>
                                </div>

                               {{--<!----}}
                                {{--<div class="row">--}}
                                    {{--<label class="col-sm-3 control-label">Dependencia y Cargo</label>--}}
                                    {{--<div class="col-sm-2">--}}
                                        {{--<div class="alm-input-frm">{{ $proceso[0]->psal_dependencia_solic }}</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-7">--}}
                                        {{--<div class="alm-input-frm">{{ $proceso[0]->psal_solic_cargo }}</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{---->--}}

                                {{--<!----}}
                                {{----}}
                                 {{--<div class="row">--}}
                                    {{--<label class="col-sm-3 control-label">Solicito Entregar A:</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<div class="alm-input-frm">--}}
                                            {{--<a href="#" class="updtGral" data-name="recepPs" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="text" data-placement="bottom">--}}
                                                {{--{{ $proceso[0]->psal_receptor }}--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                   {{----}}
                                {{--</div>--}}
                                {{---->--}}

                                <div class="row">
                                    <label class="col-sm-3 control-label">Destino</label>
                                    <div class="col-sm-9">
                                        <div class="alm-input-frm">{{ $proceso[0]->psal_destino }}</div>
                                    </div>
                                </div>


                            
                                 <div class="row" style="margin-top: 3px;">
                                    <label class="col-sm-3 control-label">Guia de Remision:</label>
                                    <div class="col-sm-4">
                                        <div class="alm-input-frm">
                                            <a href="#" class="updtGral" data-name="guiarem" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="text" data-placement="bottom">
                                                {{ $proceso[0]->psal_guiarem }}
                                            </a>
                                        </div>
                                    </div>

                                    <label class="col-sm-1 control-label">Factura:</label>
                                    <div class="col-sm-4">
                                        <div class="alm-input-frm">
                                            <a href="#" class="updtGral" data-name="factura" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="text" data-placement="bottom">
                                                {{ $proceso[0]->psal_factura }}
                                            </a>
                                        </div>
                                    </div>
                                   
                                </div>

                               


                                <div class="row" >
                                    <label class="col-sm-3 control-label">Observación</label>
                                    <div class="col-sm-9">
                                        <div class="alm-input-frm">
                                            <a href="#" class="updtGral" data-name="commentPs" data-pk="{{ $proceso[0]->psal_pecosa }}" data-type="textarea">{{ $proceso[0]->psal_observacion }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default alm-panel">
                    <div class="panel-body">
                        <button type="button" class="btn btn-success alm-button" id="btnEditPs">
                            <i class="glyphicon glyphicon-pencil"></i> EDITAR
                        </button>
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary alm-button" onclick="getMenuDistribucion()">
                            <i class="glyphicon glyphicon-log-out"></i> SALIR
                        </button>
                        <br>
                        <br>
                        <a href="#" class="btn btn-danger alm-button" data-toggle="modal" data-target="#rmvPcsModal" data-pcs="{{ $proceso[0]->psal_pecosa }}" data-gi="{{ $giu[0]->ing_giu }}" data-oc="{{ $giu[0]->oc_cod }}">
                            <i class="glyphicon glyphicon-remove"></i> ELIMINAR
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default alm-panel">
                    <div class="panel-heading alm-panel-heading">
                        DETALLE DE BIENES
                    </div>
                    <table class="table table-hover alm-table">
                        <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th>Producto</th>
                                <th>Cant. Contratada</th>
                                <th>Cant. Internada</th>
                                @foreach($pecosas as $ps)
                                    <th class="info">{{ $ps->shortPs }}</th>
                                @endforeach
                                <th>Cant. Distribuida</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <?php $parents = ''; ?>
                        <tbody>
                            @foreach($giu[0]->inventario as $key=>$bn)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $bn->prod_desc }}</td>
                                <td>{{ $bn->prod_cant }}</td>
                                <td>{{ $bn->prod_recep }}</td>
                                @foreach($pecosas as $ipcs => $ps)
                                    @foreach($pecosas as $p)
                                        @foreach($p->productos_distribuidos as $ipatern => $pp)
                                        <?php
                                        if($key == $ipatern) $parents .= $pp->id . ' ';
                                        ?>
                                        @endforeach
                                    @endforeach
                                <td class="info">
                                    <a href="#" class="updtCant" data-name="quantityPs" data-pk="{{ $ps->psal_pecosa.'$'.$bn->prod_cod.'$'.$bn->id.'$'.$ps->productos_distribuidos[$key]->id.'$'.$parents }}" data-type="text">{{ $ps->productos_distribuidos[$key]->psalp_cant_atend }}</a>
                                </td>
                                    <?php $parents = ''; ?>
                                @endforeach
                                <td>{{ $bn->prod_distribuido }}</td>
                                <td>{{ $bn->prod_stock }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>

@include('almacen.salida.deletePecosaBox')

<script>
$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    $('.updtGral').editable({
        disabled: true,
        url: 'update/ps',
        emptytext: 'Vacío',
        params: {_token: token, control:'general'},
        success:function(response){
            alert(response.msg);
            change_to_submenu('distribucion/edit/' + response.ps);
        }
    });

    $('.updtCant').editable({
        disabled: true,
        url: 'update/ps',
        params: {_token: token, control:'quantity'},
        success:function(response){
            alert(response.msg + ' ' + response.ps);
            change_to_submenu('distribucion/edit/' + response.ps);
        },
        error: function(response){
            alert('ERROR ' + response.status + ': Verifique que la cantidad ingresada coincida con la cantidad distribuida y stock ');
        }
    });

    $('#rmvPcsModal').on('shown.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var pcs = button.data('pcs');
        var gi = button.data('gi');
        var oc = button.data('oc');
        var modal = $(this);
        modal.find('.modal-body #rmvPcs').val(pcs);
        modal.find('.modal-body #refGi').val(gi);
        modal.find('.modal-body #refOc').val(oc);
    });

    $('#btnEditPs').click(function (e) {
        e.preventDefault();

        var txt = $(this).text().trim();

        if(txt == 'EDITAR'){
            $(this).attr('class','btn btn-warning alm-button');
            $(this).html('<i class="glyphicon glyphicon-arrow-down"></i> CANCELAR');
        }
        else {
            $(this).attr('class','btn btn-success alm-button');
            $(this).html('<i class="glyphicon glyphicon-pencil"></i> EDITAR');
        }

        $(document).find('.updtGral').editable('toggleDisabled');
        $(document).find('.updtCant').editable('toggleDisabled');
    });
});

function remove_pcs_process(pcs)
{
    var token = $('meta[name="csrf-token"]').attr('content');
    var ok = confirm('Está a punto de eliminar de forma permanente la PECOSA Nro: ' + pcs + ' que corresponde a la orden de compra ({{ $giu[0]->oc_cod }}) y guía de internamiento ({{ $giu[0]->ing_giu }}) en almacén. \n \n ¿ESTÁ SEGURO DE ELIMINAR LA PECOSA SELECCIONADA? \n ');
    if(!ok) return false;
    var data = $('#frm-rmv-pcs').serialize();
    //var data = {_token: token, pcs: pcs};

    $.post('remove/pcs',data,function(response){
        if(response == '200')
        {
            alert('La PECOSA seleccionada fue eliminada correctamente del sistema \n');
            $('#rmvPcsModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            getMenuDistribucion();
        }
    });
}

</script>