<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading" style="overflow: hidden">
                <div class="col-sm-7" style="float: left;">
                    <div class="alm-title">
                        <i class="fa fa-fw fa-cart-plus"></i>
                        INTERNAMIENTO <b>{{ substr($proceso->pint_cpi,-3) }}</b> DE LA GUIA DE INTERNAMIENTO <b>{{ substr($guia->ing_giu,-5) }}</b>
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
        <form class="form-horizontal" action="internamiento/edit/{{ $guia->ing_giu }}/{{ $proceso->pint_cpi }}" id="frmDataUpdateInternamiento">
            {!! csrf_field() !!}
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-2">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            DATOS
                        </div>
                        <div class="panel-body alm-panel-body">
                            <p style="margin: 0 0 4px"><label class="control-label">Guia de Int:</label></p>
                            <p><h5 style="text-align: center">{{ $guia->ing_giu }}</h5></p>
                            <p style="margin: 0 0 4px"><label class="control-label">Orden de Compra:</label></p>
                            <p><h5 style="text-align: center"> {{ $guia->oc_cod }} </h5></p>
                            <p style="margin: 0 0 4px"><label class="control-label">Tipo de Ingreso:</label></p>
                            <p><h5 style="text-align: center"> {{ $guia->tipo_internamiento=='A'?'En Almacen':'En Obra' }} </h5></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-heading alm-panel-heading">
                                DETALLE DE ENTREGA GI:
                            </div>
                            <div class="panel-body alm-panel-body">
                                <div class="col-md-12">
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Fecha de Recepción</label>
                                        <div class="col-sm-3">
                                            <input class="form-control alm-input" type="date" name="updDateReceipt" value="{{ $proceso->pint_fecha }}" readonly>
                                        </div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Persona que Entrega</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" id="updDniGiver" name="updDniGiver" placeholder="DNI" value="{{ $proceso->pint_dni_pentrega }}" data-tipo="giver" readonly>
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="updNameGiver" name="updNameGiver" placeholder="NOMBRE COMPLETO DEL QUE ENTREGA" value="{{ $proceso->pint_pentrega }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Persona que Recibe</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" id="updDniReceiver" name="updDniReceiver" placeholder="DNI" value="{{ $proceso->pint_dni_receptor }}" data-tipo="receipter" readonly>
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="updNameReceiver" name="updNameReceiver" placeholder="NOMBRE COMPLETO DEL QUE RECIBE" value="{{ $proceso->pint_preceptor }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Conductor que Traslado</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" id="updDniDriver" name="updDniDriver" placeholder="DNI" value="{{ $proceso->pint_dni_conductor }}" data-tipo="driver" readonly>
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="updNameDriver" name="updNameDriver" placeholder="NOMBRE COMPLETO DEL CONDUCTOR" value="{{ $proceso->pint_conductor }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Guía de Remisión</label>
                                        <div class="col-sm-9">
                                            <input class="form-control alm-input" name="updGuiaRemision" readonly="readonly" value="{{ $proceso->pint_guiaremision }}">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Observación</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control alm-input" name="updComment" readonly="readonly">{{ $proceso->pint_observacion }}</textarea>
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
                            <button type="button" class="btn btn-primary alm-button" id="editInternamiento">
                                <i class="glyphicon glyphicon-pencil"></i> EDITAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-success alm-button" id="updtInternamiento" style="display: none;">
                                <i class="glyphicon glyphicon-floppy-save"></i> GUARDAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-danger alm-button" onclick="">
                                <i class="glyphicon glyphicon-erase"></i> BORRAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-default alm-button" onclick="change_menu_to('internamiento/period/' + $('#periodSys').val())">
                                <i class="glyphicon glyphicon-remove-sign"></i> SALIR
                            </button>
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
                        <table class="table alm-table" style="table-layout: fixed;" width="100%">
                            <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th width="50%">Producto</th>
                                <th>Marca</th>
                                <th>Cant. Total</th>
                                <th>Und</th>
                                <th>Cant. Recibida</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bienes as $key=>$bn)
                                <tr class="row-product" id="rowProduct{{ $key + 1 }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bn->pintp_desc }}</td>
                                    <td>{{ $bn->pintp_marca }}</td>
                                    <td>
                                        <input type="hidden" id="{{ 'proQ-'.$bn->pintp_cod }}" value="{{ $bn->pintp_cant }}">
                                        {{ $bn->pintp_cant }}
                                    </td>
                                    <td>
                                        <input type="hidden" id="{{ 'stoQ-'.$bn->pintp_cod }}" value="">
                                        {{ $bn->pintp_umedida }}
                                    </td>
                                    <td>
                                        <input readonly type="number" min="0" class="form-control alm-input-table alm-control" style="width: 80px" name="articulos[{{ $bn->id }}]" value="{{ $bn->pintp_cantr }}" onclick="this.select();" data-prod="{{ $bn->pintp_cod }}">
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

    $(document).ready(function(){

        $('#editInternamiento').click(function (e) {
            e.preventDefault();
            $this = $(this);

            if($this.text().trim() == 'EDITAR'){
                $('.alm-input').prop('readonly',false);
                $('.alm-input-table').prop('readonly',false);
                $this.attr('class','btn btn-warning alm-button');
                $this.html('<i class="glyphicon glyphicon-pencil"></i> CANCELAR');
                $('#updtInternamiento').show();
            }
            else{
                $('.alm-input').prop('readonly',true);
                $('.alm-input-table').prop('readonly',true);
                $this.attr('class','btn btn-primary alm-button');
                $this.html('<i class="glyphicon glyphicon-pencil"></i> EDITAR');
                $('#updtInternamiento').hide();
            }
        });

        $('#updtInternamiento').click(function(e){
            e.preventDefault();

            var ok = confirm('¿Esta seguro de guardar los cambios?');
            if(!ok) return false;

            var url = $('#frmDataUpdateInternamiento').attr('action');
            var data = $('#frmDataUpdateInternamiento').serialize();

            $.post(url, data, function(response){
                alert(response.msg);
                getMenuInternamiento();
            }).fail(function(dataError){
                var error = $.parseJSON(dataError.responseText);
                var msg = '';
                $.each(error, function(i,item){
                    msg += item[0] + ' \n';
                    console.log(item);
                });
                alert('Se identificó un ERROR, por favor revise: \n' + msg);
            });

        });

        $('.intDni').inputmask({ mask: "99999999" });

        $("#updDniGiver,#updDniReceiver,#updDniDriver").keydown(function(e){
            if(e.shiftKey){
                e.preventDefault();
            }

            if(e.keyCode == 13){
                $this = $(this);
                var tipo = $this.data('tipo');

                $.get('findIntointernamiento',{'id': $this.val(), 'tipo': tipo}, function (data) {

                    if(data.msgId == 500){
                        alert(data.msg);
                    }
                    else{
                        if(tipo == 'giver'){
                            $('#updNameGiver').val(data.fullname);
                        }
                        else if(tipo == 'receipter'){
                            $('#updNameReceiver').val(data.fullname)
                        }
                        else if(tipo == 'driver'){
                            $('#updNameDriver').val(data.fullname)
                        }
                    }

                })

            }
        });

    });

</script>