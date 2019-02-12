<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading" style="overflow: hidden">
                <div class="col-sm-7" style="float: left;">
                    <div class="alm-title">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                        REGISTRAR ENTRADA DE BIENES EN ALMACEN
                    </div>
                </div>
                <div class="pull-right">

                </div>
            </div>
        </div>
        <form class="form-horizontal" action="#" id="frmDataNea">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-10">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            Datos de la Nota de Entrada a Almacén
                        </div>
                        <div class="panel-body alm-panel-body">
                            <div class="form-group alm-form-group">
                                <label class="col-sm-2 control-label">Fecha de Ingreso</label>
                                <div class="col-md-3">
                                    <input class="form-control alm-input" type="date" value="{{ \Carbon\Carbon::now()->toDateString() }}" name="neaDateInput">
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-2 control-label">Tipo de NEA</label>
                                <div class="col-sm-4">
                                    <select class="form-control alm-input" name="neaNeaType">
                                        <option value="NEA-IP" selected>NEA - Ingreso Producción</option>
                                        <option value="NEA-DA">NEA - Devolución a Almacén</option>
                                        <option value="NEA-DI">NEA - Diferencia de Inventario</option>
                                        <option value="NEA-DO">NEA - Donación</option>
                                        <option value="NEA-TE">NEA - Transferencia</option>
                                        <option value="NEA-OT">NEA - Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-2 control-label">Almacén</label>
                                <div class="col-sm-4">
                                    <select class="form-control alm-input" name="neaAlmacen">
                                        @foreach($almacen as $a)
                                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-2 control-label">Persona que Recibe</label>
                                <div class="col-sm-2">
                                    <input class="form-control alm-input neaDni" id="dniReceipt" data-aim="receipt" type="text" name="neaDniReceipt" placeholder="DNI (F2)"/>
                                </div>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" id="nameReceipt" type="text" name="neaNameReceipt" placeholder="NOMBRE DEL QUE RECIBE">
                                </div>
                            </div>
                            {{--<div class="form-group alm-form-group">--}}
                                {{--<label class="col-sm-2 control-label">Persona que Entrega</label>--}}
                                {{--<div class="col-md-2">--}}
                                    {{--<input class="form-control alm-input neaDni" id="dniGiver" data-aim="giver" type="text" name="neaDniGiver" placeholder="DNI (F2)"/>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-7">--}}
                                    {{--<input class="form-control alm-input" id="nameGiver" type="text" name="neaNameGiver" placeholder="NOMBRE DEL QUE ENTREGA">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group alm-form-group">
                                <label class="col-sm-2 control-label">Secuencia Funcional</label>
                                <div class="col-md-2">
                                    <input class="form-control alm-input" type="text" id="secGiver" data-aim="sec" name="neaSecGiver" placeholder="CODIGO (F2)"/>
                                </div>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" type="text" id="dscSecGiver" name="neaDescSecGiver" placeholder="SECUENCIA FUNCIONAL">
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-2 control-label">Observación</label>
                                <div class="col-sm-7">
                                    <textarea  class="form-control" name="neaComment"></textarea>
                                </div>
                            </div>

                            <div class="form-group alm-form-group" style="DISPLAY:NONE;">
                                <label class="col-sm-5 control-label">Anio</label>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" type="text" id="almAnio" name="almAnio"  >
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-body">
                            <button type="button" class="btn btn-primary alm-button" id="btnSaveNea">
                                <i class="glyphicon glyphicon-floppy-save"></i> GUARDAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-primary alm-button" onclick="change_menu_to('internamiento/close')">
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
                            Lista de Bienes
                            <span class="pull-right">
                                <a class="btn btn-success" style="height: 20px; padding-top:0px; margin-top:-3px;" href="#" id="addProduct">+Agregar</a>
                            </span>
                        </div>
                        <table class="table alm-table" id="tableProducts" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 2%">X</th>
                                    <th style="width: 8%">Código</th>
                                    <th style="width: 40%">Producto</th>
                                    <th style="width: 5%">Cantidad</th>
                                    <th style="width: 5%">Unidad</th>
                                    <th style="width: 10%">Marca</th>
                                    <th style="width: 10%">Precio (S/)</th>
                                    <th style="width: 10%">Costo (S/)</th>
                                    <th style="width: 10%">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="net-baseRow">
                                    <td class="net-deleteRow">X</td>
                                    <td><input type="text" style="width: 100%;" class="neaProd" name="neaProd[]" readonly></td>
                                    <td><input type="text" style="width: 100%;" class="autoFindProd" name="neaDesc[]" id="neaDesc"></td>
                                    <td><input type="text" style="width: 100%;" class="neaCant" name="neaCant[]"></td>
                                    <td><input type="text" style="width: 100%;" class="autoFindUnidad" name="neaUnd[]" id="neaUnd"></td>
                                    <td><input type="text" style="width: 100%;" class="neaMarca" name="neaMarca[]"></td>
                                    <td><input type="text" style="width: 100%;" class="neaPrecio" name="neaPrecio[]"></td>
                                    <td><input type="text" style="width: 100%;" class="neaCosto" name="neaCosto[]" readonly></td>
                                    <td><textarea style="width: 100%; height: 20px;" class="neaComment" name="neaProdComment[]"></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </form>
    </div>
</div>

@include('almacen.ingreso.registerNeaProduct')
@include('almacen.salida.findPersonaBox');
@include('almacen.salida.findPersonaBoxO');
@include('almacen.salida.findSecfunBox');

<script>
$(document).ready(function(){
 $("#almAnio").val($('#periodSys').val());
 
    $('#dniReceipt, #dniGiver, #secGiver').keydown(function(e){
        if(e.shiftKey)     {        e.preventDefault();      }
        if (e.keyCode == 113) {
            var tipo = $(this).data('aim');
            if(tipo == 'receipt')
            {
                $('#modalFindPersona').modal('show')
            }
            if(tipo == 'giver')
            {
                $('#modalFindPersonaO').modal('show');
            }
            if(tipo == 'sec')
            {
                $('#modalFindSecfun').modal('show');
            }
        }
    });

    $('#addProduct').click(function(e){
        e.preventDefault();
        add_row_to('F');
    });

    $('#tableProducts').on('click','.net-deleteRow',function(e){
        e.preventDefault();
        var parent = $(this).parents().get(0);
        $(parent).remove();
    });

    $('#addProductModal').on('shown.bs.modal',function(e){
    });

    $('#tableProducts').on('focus','input.autoFindProd',function(){
        $(this).autocomplete({
            source: 'findProd',
            minLength: 2,
            open: function() {$(this).removeClass('ui-autocomplete-loading')},
            select: function(e, data){
                e.preventDefault();
                $(this).val(data.item.label);
                var row = $(this).closest('tr').attr('id');
                $('#' + row + ' input.neaProd').val(data.item.value);
            }
        });
    });

    $('#tableProducts').on('focus','input.autoFindUnidad',function(){
        $(this).autocomplete({
            source: 'findUnidad',
            minLength: 2,
            open: function() {$(this).removeClass('ui-autocomplete-loading')},
            select: function(e, data){
                e.preventDefault();
            }
        });
    });

    $('#tableProducts').on('keypress','.neaPrecio',function(e){
        if(e.which == 13)
        {
            e.preventDefault();
            var row = $(this).closest('tr').attr('id');
            var cant = $('#' + row + ' input.neaCant').val();
            var precio = $(this).val();
            if(cant == 0 || cant == '') return false;
            var costo = parseFloat(cant*precio);
            $('#' + row + ' input.neaCosto').val(costo.toFixed(4));
        }
    });

    /*$(window).keydown(function(event){
        if(event.keyCode == 13)
        {
            event.preventDefault();
            return false;
        }
    });*/

    $('#btnSaveNea').click(function(e){
        e.preventDefault();

        var ok = confirm('¿Esta seguro de registrar la Nota de Entrada?');

        if(ok)
        {
            var url = 'internamiento/nea';
            var data = $('#frmDataNea').serialize();

            $.post(url,data,function(result){
                alert(result.msg);
                if(result.msgId == 200)
                    getMenuDistribucion();
            }).fail(function(dataError){
                var error = $.parseJSON(dataError.responseText);
                var msg = '';
                $.each(error, function(i,item){
                    msg += item[0] + ' \n';
                    console.log(item);
                });
                alert('Error. Revise su conexión al servidor \n' + msg);
            });
        }
    });

    $('.neaDni').inputmask({ mask: "99999999" });
});

function fillResultSelected(dni, fullname)
{
    $('#dniReceipt').val(dni);
    $('#nameReceipt').val(fullname);
    $('#modalFindPersona').modal('hide');
}

function fillResultSelectedGiver(dni, fullname)
{
    $('#dniGiver').val(dni);
    $('#nameGiver').val(fullname);
    $('#modalFindPersonaO').modal('hide');
}

function fillResultSelectedSec(id, dsc)
{
    $('#secGiver').val(id);
    $('#dscSecGiver').val(dsc);
    $('#modalFindSecfun').modal('hide');
}

</script>