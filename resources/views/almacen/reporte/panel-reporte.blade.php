<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default alm-panel">
                <div class="panel-heading alm-panel-heading">
                    GENERE SU REPORTE DE ALMACEN
                </div>
                <div class="panel-body alm-panel-body">
                    <form class="form-horizontal" id="frmMakeReport" action="{{ asset('reporte') }}" method="post" target="_blank">
                        {!! csrf_field() !!}

                        <div class="col-md-4">
                            <fieldset>
                                <legend>
                                    Datos generales
                                </legend>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-2 control-label" for="repAlmacen">Almacen</label>
                                    <div class="col-sm-10">
                                        <select class="form-control alm-input" name="repAlmacen">
                                            @foreach($almacen as $a)
                                                <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-2 control-label" for="repDateFrom">Desde</label>
                                    <div class="col-sm-10">
                                        <input class="form-control alm-input" type="date" name="repDateFrom">
                                    </div>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-2 control-label" for="repDateTo">Hasta</label>
                                    <div class="col-sm-10">
                                        <input class="form-control alm-input" type="date" name="repDateTo" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                    </div>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-2 control-label" for="repFilter">Por</label>
                                    <div class="col-sm-10">
                                        <select class="form-control alm-input" name="repFilter" id="itemFilter">
                                            <option value="SN" >-- SELECCIONAR --</option>
                                            <option value="SF">SECUENCIA FUNCIONAL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-2 control-label" for="repDetail">Código</label>
                                    <div class="col-sm-10">
                                        <select class="form-control alm-input" name="repDetail" id="itemCode">
                                            <option value="ALL">TODOS</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend>Movimientos en almacén</legend>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-4 control-label" for="repAnalysis">Analizar</label>
                                    <div class="col-sm-8">
                                        <select class="form-control alm-input" name="repAnalysis" id="itemAnalysis">
                                            <option value="NA" >-- SELECCIONAR --</option>
                                            <option value="PCS" >PECOSAS</option>
                                            <option value="IYS">INGRESO Y SALIDA</option>
                                            <option value="NEA">NEAs</option>
                                            <option value="GIU">INTERNAMIENTOS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="text-align: center">
                                    <a class="btn btn-primary" id="btnPrintReport">Vista Previa</a>
                                    <a class="btn btn-danger" href="#" id="pdfExportPreview">PDF</a>
                                    <a class="btn btn-success" href="#" id="xlsExportPreview">EXCEL</a>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend>Conciliación contable</legend>
                                <div class="form-group alm-form-group">
                                    <label class="col-sm-4 control-label" for="repAnalysis">Sub-cuenta</label>
                                    <div class="col-sm-8">
                                        <select class="form-control alm-input" name="nrepSubcta" id="repSubcta">
                                            <option value="ALL" >-- TODOS --</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->pcgAnio . '-' . $cuenta->pcgSubcta }}">{{ $cuenta->pcgSubcta . ' - ' . strtoupper($cuenta->pcgSubctadsc) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="text-align: center">
                                    <a class="btn btn-primary" id="btnPrintReport">Vista Previa</a>
                                    <a class="btn btn-danger" href="#" id="pdfExportPreview">PDF</a>
                                    <a class="btn btn-success" href="#" id="xlsExportPreview">EXCEL</a>
                                </div>
                            </fieldset>
                        </div>







                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>

</div>

<div class="col-md-12">
    <div class="alm-sub-content">
    </div>
</div>

<script>

$(document).ready(function(){

    $('#btnPrintReport').click(function(e){
        e.preventDefault();
        var url = 'reporte/html';
        var data = $('#frmMakeReport').serialize();

        $.post(url, data, function(result){
            $('.alm-sub-content').html(result);
        });
    });

    $('input#repDetail').keypress(function(e){
        if(e.which == 13)
        {
            e.preventDefault();
            var url = 'reporte/html';
            var data = $('#frmMakeReport').serialize();

            $.post(url, data, function(result){
                $('.alm-sub-content').html(result);
            });
        }
    });

    $('#pdfExportPreview').click(function(e){
        e.preventDefault();
        $('#frmMakeReport').attr('action','reporte/pdf');
        $('#frmMakeReport').submit();
    });

    $('#xlsExportPreview').click(function(e){
        e.preventDefault();
        $('#frmMakeReport').attr('action','reporte/xls');
        $('#frmMakeReport').submit();
    });

/*    $('#itemAnalysisss').change(function(e){
        var analysis = $(this).val();
        $.get('getDataFilter',{'analysis':analysis},function(data){
            $('#itemFilter').html('');
            $('#itemFilter').html(data);
            $('#itemCode').html('<option value="ALL">TODOS</option>');
        });
    });*/

    $('#itemFilter').change(function(e){
        var filter = $(this).val();
        if(filter == 'SF')
        {
            $.get('getDataDetail',{'filter':filter},function(data){
                $('#itemCode').html('');
                $('#itemCode').html(data);
            });
        }
        else
        {
            $('#itemCode').html('<option value="ALL">TODOS</option>');
        }
    });

});

</script>