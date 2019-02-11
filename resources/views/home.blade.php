@extends('layout')

@section('main-content')

<div style="color:white;" >

@if(config('slam.APP_MENSAJE') != '')

    <div class="container" style="width: 780px;">
        <div class="panel" style="overflow: hidden;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6" style="text-align: center;">
                        <img src="{{ asset('img/mantenimiento.png') }}" alt="" width="90%">
                    </div>
                    <div class="col-md-6" style="color: darkorange; text-align: center; padding: 5%;">
                        <h3>{{ config('slam.APP_MENSAJE') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif


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
