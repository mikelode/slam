<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="col-md-10">
    <div class="panel with-nav-tabs panel-default alm-panel">
        <div class="panel-heading alm-panel-heading">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-pendientes" data-toggle="tab">
                        BANDEJA DE DOCUMENTOS
                    </a>
                </li>
                <li>
                    <a href="#tab-enviados" data-toggle="tab">ENVIADOS</a>
                </li>
            </ul>
        </div>
        <div class="panel-body alm-panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab-pendientes">
                    <table class="table alm-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Documento</th>
                                <th>Código</th>
                                <th>Fecha Creación</th>
                                <th style="width: 500px;">Glosa</th>
                                <th style="text-align: center;">Elegir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($req as $key=>$item)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>Requerimiento</td>
                                <td>{{ $item->reqID }}</td>
                                <td>{{ $item->reqFecha  }}</td>
                                <td><input type="text" name="{{ $item->reqID }}" class="form-control alm-input-table" placeholder="Escriba la situación actual del documento"></td>
                                <td><input type="checkbox" class="alm-control" name="envDoc[]" value="{{ $item->reqID }}"></td>
                            </tr>
                        @endforeach
                        @foreach($ctz as $key=>$item)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>Cotización</td>
                                <td>{{ $item->ctzID }}</td>
                                <td>{{ $item->ctzFecha  }}</td>
                                <td><input type="text" name="{{ $item->ctzID }}" class="form-control alm-input-table" placeholder="Escriba la situación actual del documento"></td>
                                <td><input type="checkbox" class="alm-control" name="envDoc[]" value="{{ $item->ctzID }}"></td>
                            </tr>
                        @endforeach
                        @foreach($cdr as $key=>$item)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>Cuadro Comparativo</td>
                                <td>{{ $item->cdrID }}</td>
                                <td>{{ $item->cdrFecha  }}</td>
                                <td><input type="text" name="{{ $item->cdrID }}" class="form-control alm-input-table" placeholder="Escriba la situación actual del documento"></td>
                                <td><input type="checkbox" class="alm-control" name="envDoc[]" value="{{ $item->cdrID }}"></td>
                            </tr>
                        @endforeach
                        @foreach($ors as $key=>$item)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>Orden de Servicio</td>
                                <td>{{ $item->orsID }}</td>
                                <td>{{ $item->orsFecha  }}</td>
                                <td><input type="text" name="{{ $item->orsID }}" class="form-control alm-input-table" placeholder="Escriba la situación actual del documento"></td>
                                <td><input type="checkbox" class="alm-control" name="envDoc[]" value="{{ $item->orsID }}"></td>
                            </tr>
                        @endforeach
                        @foreach($orc as $key=>$item)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>Orden de Compra</td>
                                <td>{{ $item->orcID }}</td>
                                <td>{{ $item->orcFecha  }}</td>
                                <td><input type="text" name="{{ $item->orcID }}" class="form-control alm-input-table" placeholder="Escriba la situación actual del documento"></td>
                                <td><input type="checkbox" class="alm-control" name="envDoc[]" value="{{ $item->orcID }}"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="tab-enviados">
                    <table class="table alm-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Documento</th>
                                <th>Código</th>
                                <th>Fecha de Envío</th>
                                <th style="width: 500px;">Glosa</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($enviados as $key=>$item)
                            <tr>
                                <td>{{ $key + 1  }}</td>
                                <td>{{ $item->tlbTypeDoc }}</td>
                                <td>{{ $item->tlbCodDoc  }}</td>
                                <td>{{ $item->tlsFecha }}</td>
                                <td>
                                    <div class="alm-input-frm">
                                    @if($item->tlbTypeDoc == 'REQUERIMIENTO')
                                        @if(!$item->tlbFlagCheck)
                                            <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                                        @else
                                            {{ $item->tlbSituacion.' - Verificado por Logística' }}
                                        @endif
                                    @else
                                        @if(!$item->tlbFlagR)
                                            <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                                        @else
                                            {{ $item->tlbSituacion.' - Verificado por Logística' }}
                                        @endif
                                    @endif
                                    </div>
                                </td>
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
            <a class="btn btn-app" id="btn-send-doc" style="width: 90px;">
                <i class="fa fa-send"></i> ENVIAR
            </a>
            <p></p>
            <a class="btn btn-app" style="width: 90px;" onclick="change_to_submenu('tramite/salida')">
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

});
</script>