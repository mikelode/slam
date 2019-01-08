<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default alm-panel">
            <div class="panel-heading alm-panel-heading">
                CONSULTA Y SEGUIMIENTO
            </div>
            <div class="panel-body alm-panel-body">
                <div class="form-horizontal">
                    <div class="form-group alm-form-group">
                        <label class="col-sm-4 control-label" for="segGi">Internamiento</label>
                        <div class="col-sm-8">
                            <input class="form-control alm-input" type="search" id="segGi" placeholder="NUMERO GUIA INTERNAMIENTO">
                        </div>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="col-sm-4 control-label" for="segPs">PECOSA</label>
                        <div class="col-sm-8">
                            <input class="form-control alm-input" type="text" id="segPs" placeholder="NUMERO PECOSA">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="alm-sub-content">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Datos Generales</a></li>
                        <li><a href="#tab-seguimiento" data-toggle="tab">Seguimiento</a></li>
                        <li><a href="#tab-internamiento" data-toggle="tab">Internamiento</a></li>
                        <li><a href="#tab-salida" data-toggle="tab">Salida</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-data">
                            DATOS GENERALES
                        </div>
                        <div class="tab-pane fade in" id="tab-seguimiento">SEGUIMIENTO DE LA OC</div>
                        <div class="tab-pane fade in" id="tab-internamiento">INTERNAMIENTO DE BIENES</div>
                        <div class="tab-pane fade in" id="tab-salida">SALIDA DE BIENES</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){

    $('input#segGi').keypress(function(event){
        if(event.which == 13)
        {
            event.preventDefault();

            var id = $('#segGi').val();
            var year = $('#periodSys').val();

            if(id == '') return;

            $('.alm-sub-content').html('<h3>Cargando...</h3>');
            var url = 'seguimientoGi';
            var data = {'segGi':id,'year':year};

            $.get(url, data, function(result){
                $('.alm-sub-content').html(result);
            });
        }
    });

    $('input#segPs').keypress(function(evt){
        if(evt.which == 13)
        {
            evt.preventDefault();

            var id = $('#segPs').val();
            var year = $('#periodSys').val();

            if(id == '') return;

            $('.alm-sub-content').html('<h3>Cargando...</h3>');
            var url = 'seguimientoPs';
            var data = {'segPs':id,'year':year};

            $.get(url, data, function(result){
                $('.alm-sub-content').html(result);
            });
        }
    });
});

</script>