<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="col-md-10">
    <div class="panel with-nav-tabs panel-default" style="margin-bottom: 10px;">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-pendientes" data-toggle="tab">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                        DOCUMENTOS A RECIBIR
                    </a>
                </li>
                <li>
                    <a href="#tab-recibidos" data-toggle="tab">RECEPCIONADOS - ACEPTADOS</a>
                </li>
            </ul>
            {{--<div class="input-group" style="width: 200px; float: left;">
                <input type="text" class="form-control" placeholder="TRANSACCION" id="boxFindDocument">
                <span class="input-group-btn">
                    <button class="btn btn-primary">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </button>
                </span>
            </div>--}}
        </div>
        <div class="panel-body alm-panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab-pendientes">
                    <table class="table alm-table" id="tblPendientes">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Número de Trámite</th>
                                <th>Fecha de Trámite</th>
                                <th>Enviado por</th>
                                <th style="width: 400px;">Mensaje</th>
                                <th>Elegir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($operaciones as $key=>$item)
                            <tr>
                                <td class="details-control" onclick="documentos_pendientes(this, '{{ $item->topId }}')">
                                </td>
                                <td>{{ $item->topId }}</td>
                                <td>{{ $item->topFecha }}</td>
                                <td>{{ $item->topUsr }}</td>
                                <td>{{ $item->topMensaje }}</td>
                                <td>
                                    <input type="checkbox" class="alm-controlc" name="receiptDoc[]" value="{{ $item->topId }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="tab-recibidos">
                    <table class="table alm-table" id="tblRecibidos">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Número de Trámite</th>
                                <th>Fecha de Trámite</th>
                                <th>Fecha de Recepcion</th>
                                <th style="width: 400px;">Mensaje</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recibidos as $key=>$item)
                            <tr>
                                <td class="details-control" onclick="documentos_recibidos(this, '{{ $item->topId }}')"></td>
                                <td>{{ $item->topId }}</td>
                                <td>{{ $item->topFecha }}</td>
                                <td>{{ $item->tleFecha }}</td>
                                <td>{{ $item->topMensaje }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-body" style="text-align: center">
            <a class="btn btn-app" id="btn-receipt-doc" style="width: 90px;">
                <i class="fa fa-save"></i> RECIBIR
            </a>
            <p></p>
            <a class="btn btn-app" style="width: 90px;" onclick="change_to_submenu('tramite/entrada')">
                <i class="fa fa-refresh"></i> ACTUALIZAR
            </a>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    $('.updtStateTram').editable({
        url: 'update/statetram',
        emptytext: 'No Especificado',
        params: {_token: token},
        success: function(response){
            /*alert('Estado del documento modificado con éxito');*/
        }
    });

    $('#tblPendientes').DataTable({
        "language":{
            "url": "plugins/DataTables/Spanish.json"
        }
    });

    $('#tblRecibidos').DataTable({
        "language":{
            "url": "plugins/DataTables/Spanish.json"
        }
    });
});
</script>