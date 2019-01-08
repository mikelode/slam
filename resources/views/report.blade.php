@extends('layout')

@section('main-content')

<div class="page">

<form class="form-horizontal" role="form" method="post" action="{{ asset('/reporting') }}">
    {!! csrf_field() !!}
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-primary">Generar</button>
        </div>
    </div>
</form>

</div>