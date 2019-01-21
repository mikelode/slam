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
        <form class="form-horizontal" action="internamiento/bienes/{{ $guia->ing_giu }}" id="frmDataInternamiento">
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
                                            <input class="form-control alm-input" type="date" name="intDateReceipt" value="{{ $proceso->pint_fecha }}">
                                        </div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Persona que Entrega</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" name="intDniGiver" placeholder="DNI" value="{{ $proceso->pint_dni_pentrega }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" name="intNameGiver" placeholder="NOMBRE COMPLETO DEL QUE ENTREGA" value="{{ $proceso->pint_pentrega }}">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Persona que Recibe</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" name="intDniReceiver" placeholder="DNI" value="{{ $proceso->pint_dni_receptor }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" name="intNameReceiver" placeholder="NOMBRE COMPLETO DEL QUE RECIBE" value="{{ $proceso->pint_preceptor }}">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Conductor que Traslado</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" name="intDniDriver" placeholder="DNI" value="{{ $proceso->pint_dni_conductor }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" name="intNameDriver" placeholder="NOMBRE COMPLETO DEL CONDUCTOR" value="{{ $proceso->pint_conductor }}">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Observación</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control alm-input" name="intComment">{{ $proceso->pint_observacion }}</textarea>
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
                            <button type="button" class="btn btn-primary" id="saveInternamiento">
                                <i class="glyphicon glyphicon-floppy-save"></i> EDITAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-danger alm-button" onclick="">
                                <i class="glyphicon glyphicon-erase"></i> BORRAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-default alm-button" onclick="change_menu_to('internamiento/close')">
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
                        <table class="table alm-table">
                            <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Cant. Total</th>
                                <th>Und</th>
                                <th>Cant. Recibida</th>
                                <th>Obs.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bienes as $key=>$bn)
                                <tr id="rowProduct{{ $key + 1 }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bn->pintp_desc }}</td>
                                    <td>{{ $bn->pintp_marca }}</td>
                                    <td>
                                        <input type="hidden" id="{{ 'proQ-'.$bn->pintp_cod }}" value="{{ $bn->pintp_cant }}">
                                        {{ $bn->pintp_cant }}
                                    </td>
                                    <td>
                                        <input type="hidden" id="{{ 'stoQ-'.$bn->pintp_cod }}" value="">
                                    </td>
                                    <td>{{ $bn->pintp_umedida }}</td>
                                    <td>
                                            <input type="number" min="0" class="form-control alm-input-table alm-control" style="width: 50px" name="{{ 'intQ-'.$bn->pintp_cod.'-'.$bn->id }}" id="{{ 'intQ-'.$bn->pintp_cod }}" value="{{ $bn->pintp_cantr }}" onclick="this.select();" data-prod="{{ $bn->pintp_cod }}">
                                    </td>
                                    <td>

                                            <input type="text" class="form-control alm-input-table" value="{{ $bn->pintp_observacion }}" name="{{ 'intC-'.$bn->pintp_cod.'-'.$bn->id }}">
                                    <td>
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

        /*var numInput = document.querySelector('input.alm-control');
        numInput.addEventListener('input',function(){
            var num = this.value.match(/^\d+$/);
            if(num === null)
            {
                this.value = '';
            }
        },false);*/

        $('#saveInternamiento').click(function(e){
            e.preventDefault();

            var msg = true;
            var atd = 0;
            $('input.alm-control').each(function(i){

                atd += parseFloat($(this).val());
                var row = $(this).closest('tr');
                var p = $(this).data('prod');
                var result = validar_cantidad(p,'proQ','stoQ','int',row);
                /*  if(!result)
                  {
                      alert('Atención: verifique la cantidad a ser recibida que ha ingresado en el detalle de los bienes');
                      msg = false;
                      return false;
                  }
                  */
            });

            if(!msg) return false;
            if(atd==0)
            {
                alert('No esta registrando ninguna cantidad de bienes ingresados, revise por favor.');
                return false;
            }
            var ok = confirm('¿Esta seguro de registrar el internamiento de los bienes?');
            if(!ok) return false;

            var url = $('#frmDataInternamiento').attr('action');
            var data = $('#frmDataInternamiento').serialize();

            $.post(url, data, function(response){
                alert(response);
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

        $('#almCheckAll').change(function(){
            $('input:checkbox').prop('checked', $(this).prop('checked'));
            $('.fill-receipt').each(function(i){
                fillData(this,'proQ','intQ','stoQ','int');
            });
        });

        $('.fill-receipt').change(function(){
            fillData(this,'proQ','intQ','stoQ','int');
        });

        $('.intDni').inputmask({ mask: "99999999" });

    });

</script>