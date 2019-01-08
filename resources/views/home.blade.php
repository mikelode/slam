@extends('layout')

@section('main-content')

<p style="color:white;" >


</p>

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
