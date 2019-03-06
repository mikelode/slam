@extends('layout')

@section('main-content')

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                SINCRONIZACIÓN DE TABLAS
            </div>
            <div class="panel-body">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">

                    </div>
                </div>
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation" class="active"><a href="#secfun" aria-controls="secfun" role="tab" data-toggle="tab">SECUENCIAS FUNCIONALES</a></li>
                    <li role="presentation"><a href="#clasif" aria-controls="clasif" role="tab" data-toggle="tab">CLASIFICADORES</a></li>
                    <li role="presentation"><a href="#expsiaf" aria-controls="expsiaf" role="tab" data-toggle="tab">REGISTROS</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="secfun">
                        <div class="row">
                            <div class="col-md-8" style="text-align: center;"><h4>SECUENCIAS FUNCIONALES</h4></div>
                            <div class="col-md-4">
                                <button class="btn btn-success" id="btnSecfunLog">REGISTRADAS</button>
                                <button class="btn btn-primary" id="btnSecfunSiaf">SIAF</button>
                                <button class="btn btn-warning" id="btnSyncSiaf">SYNCRONIZAR</button>
                            </div>
                        </div>
                        <div class="row">
                            <div id="resultdata">

                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="clasif">
                        <div class="row" style="padding-bottom: 5px;">
                            <div class="col-sm-8" style="text-align: center;">
                                <h4>CLASIFICADORES POR SECUENCIA FUNCIONAL</h4>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-danger" id="btnSyncAllClasif">SYNCRONIZAR TODOS <br> LOS CLASIFICADORES</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="#" id="frmSecfun">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Año</label>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="nanioSecfun" id="anioSecfun">
                                                    <option value="2019" selected>2019</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 5px; padding-bottom: 5px;">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Secuencia Funcional</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" type="number" name="ncodSecfun" id="codSecfun" placeholder="Nro Secuencia Funcional">
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="button" class="btn btn-success" id="btnGetClasif">VER CLASIF</button>
                                                <button type="button" class="btn btn-warning" id="btnSyncSfClasif">SYNCRONIZAR</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="resultdataclasif">

                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="expsiaf">
                        EXPEDIENTE SIAF
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $('#btnSecfunSiaf').click(function(e){
            e.preventDefault();
            var url = 'sync/querysecfun';

            $.ajax({
                xhr: function () {
                    var myXhr = new window.XMLHttpRequest();

                    myXhr.upload.addEventListener("progress", function (ev) {
                        if (ev.lengthComputable) {
                            var prcntComplete = ev.loaded / ev.total;
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"})
                        }
                    }, false);

                    myXhr.addEventListener("progress", function (ev) {
                        if(ev.lengthComputable){
                            var prcntComplete = (ev.loaded / ev.total) * 100;
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"});
                            $('progress').attr({
                                value: ev.loaded,
                                max: ev.total
                            });
                        }
                    }, false);

                    return myXhr;
                },
                url: url,
                type: 'get',
                success: function(response){
                    if(response.msgId == 500){
                        alert(response.msg);
                    }
                    else{
                        $('#resultdata').html(response.view);
                    }
                }
            });
        });
        $('#btnSyncSiaf').click(function(e){
            e.preventDefault();
            var url = 'sync/executesf';
            $.ajax({
                xhr: function () {
                    var myXhr = new window.XMLHttpRequest();

                    myXhr.upload.addEventListener("progress", function (ev) {
                        if (ev.lengthComputable) {
                            var prcntComplete = ev.loaded / ev.total;
                            console.log(prcntComplete);
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"})
                        }
                    }, false);

                    myXhr.addEventListener("progress", function (ev) {
                        if(ev.lengthComputable){
                            var prcntComplete = (ev.loaded / ev.total) * 100;
                            console.log(prcntComplete);
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"});
                            $('progress').attr({
                                value: ev.loaded,
                                max: ev.total
                            });
                        }
                    }, false);

                    return myXhr;
                },
                url: url,
                type: 'post',
                data: {'periodo':2019, 'ejec':'300753'},
                success: function(data){
                    if(data.msgId == 500){
                        alert("Error al sincronizar las secuencias funcionales.\n" + data.msg);
                    }
                    else{
                        if(data.registrados == 0){
                            alert("Las secuencias funcionales ya están actualizadas.\n" + data.msg);
                        }
                        else{
                            alert(data.msg);
                        }
                    }
                }
            });
        });

        $('#btnGetClasif').click(function (e) {
            e.preventDefault();

            var idsf = $('#codSecfun').val();

            if(idsf.trim() == '')
                return;

            var url = 'sync/listclasif';
            var data = $('#frmSecfun').serialize();

            $.post(url, data, function (response) {
                $('#resultdataclasif').html(response);
            });
        });

        $('#btnSyncSfClasif').click(function (e) {
            e.preventDefault();

            var idsf = $('#codSecfun').val();

            if(idsf.trim() == '')
                return;

            var url = 'sync/listsyncclasif';
            var data = $('#frmSecfun').serialize();

            $.ajax({
                xhr: function () {
                    var myXhr = new window.XMLHttpRequest();

                    myXhr.upload.addEventListener("progress", function (ev) {
                        if (ev.lengthComputable) {
                            var prcntComplete = ev.loaded / ev.total;
                            console.log(prcntComplete);
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"})
                        }
                    }, false);

                    myXhr.addEventListener("progress", function (ev) {
                        if(ev.lengthComputable){
                            var prcntComplete = (ev.loaded / ev.total) * 100;
                            console.log(prcntComplete);
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"});
                            $('progress').attr({
                                value: ev.loaded,
                                max: ev.total
                            });
                        }
                    }, false);

                    return myXhr;
                },
                url: url,
                type: 'post',
                data: data,
                success: function(data){
                    console.log(data);
                    if(data.msgId == 500){
                        alert("Error al sincronizar los clasificadores de la secuencia funcional.\n" + data.msg);
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });

        $('#btnSyncAllClasif').click(function (e) {
            e.preventDefault();

            var ok = confirm('¿Está seguro de sincronizar los clasificadores para todas las secuencias funcionales de la entidad?')

            if(!ok)
                return;

            var periodo = $('#periodSys').val();

            $.ajax({
                xhr: function () {
                    var myXhr = new window.XMLHttpRequest();

                    myXhr.upload.addEventListener("progress", function (ev) {
                        if (ev.lengthComputable) {
                            var prcntComplete = ev.loaded / ev.total;
                            console.log(prcntComplete);
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"})
                        }
                    }, false);

                    myXhr.addEventListener("progress", function (ev) {
                        if(ev.lengthComputable){
                            var prcntComplete = (ev.loaded / ev.total) * 100;
                            console.log(prcntComplete);
                            $('div.progress > div.progress-bar').css({ "width": prcntComplete + "%"});
                            $('progress').attr({
                                value: ev.loaded,
                                max: ev.total
                            });
                        }
                    }, false);

                    return myXhr;
                },
                url: 'sync/fullsyncclasif',
                type: 'post',
                data: {'periodo': 2019},
                success: function(data){
                    console.log(data);
                    if(data.msgId == 500){
                        alert("Error al sincronizar los clasificadores de la secuencia funcional.\n" + data.msg);
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });



    </script>
@endsection
