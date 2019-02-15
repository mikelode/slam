@extends('layout')

@section('main-content')

    <div style="" >
        <div class="container">
            <div class="panel" style="overflow: hidden;">
                <div class="panel-body">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-condensed">
                                <caption>
                                    <h5>LISTA DE REQUERIMIENTOS</h5>
                                </caption>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>REQ</th>
                                    <th>FECHA</th>
                                    <th>SOLICITANTE</th>
                                    <th>DEP</th>
                                    <th>META</th>
                                    <th>GLOSA</th>
                                    <th>VER</th>
                                    <th>PRINT</th>
                                    <th>ESTADO</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ReqData as $i => $req)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $req->reqCodigo }}</td>
                                        <td>{{ $req->reqFecha }}</td>
                                        <td>{{ $req->reqSolID }}</td>
                                        <td>{{ $req->reqDepCod }}</td>
                                        <td>{{ $req->reqSecFunCod }}</td>
                                        <td>{{ $req->reqGlosa }}</td>
                                        <td>
                                            <a href="">
                                                <img src="{{ asset('img/displayx24.png') }}" alt="Ver">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="">
                                                <img src="{{ asset('img/print.png') }}" alt="Print">
                                            </a>
                                        </td>
                                        <td>{{ $req->reqEtapa }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#btnMainLogSiafSeg').click(function(e){
            e.preventDefault();
            var url = 'logistica/vwAdqSegDoc';
            $.get(url,function(data){
                $('.alm-content-wrapper').html(data);

            });
        });
        $('#btnMainLogCS').click(function(e){
            e.preventDefault();
            var url = 'logistica/vwLiqCS';
            $.get(url,function(data){
                $('.alm-content-wrapper').html(data);

            });
        });



    </script>
@endsection