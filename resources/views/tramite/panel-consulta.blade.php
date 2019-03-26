@extends('layout-public')

@section('main-content')
<style>
    p
    {
        margin: 0;
        padding: 0 0 10px 0;
        line-height: 20px;
    }
    .span4
    {
        width: 80px;
        float: left;
        margin: 0 8px 10px 8px;
    }

    .phone
    {
        margin-top: 15px;
        background: #fff;
    }
    .tel
    {
        margin-bottom: 10px;
        margin-top: 10px;
        border: 1px solid #9e9e9e;
        border-radius: 0px;
    }
    .num-pad
    {
        padding-left: 15px;
    }


    .num
    {
        border: 1px solid #9e9e9e;
        -webkit-border-radius: 999px;
        border-radius: 999px;
        -moz-border-radius: 999px;
        height: 80px;
        background-color: #fff;
        color: #333;
        cursor: pointer;
    }
    .num:hover
    {
        background-color: #9e9e9e;
        color: #fff;
        transition-property: background-color .2s linear 0s;
        -moz-transition: background-color .2s linear 0s;
        -webkit-transition: background-color .2s linear 0s;
        -o-transition: background-color .2s linear 0s;
    }
    .txt
    {
        font-size: 30px;
        text-align: center;
        margin-top: 15px;
        font-family: 'Lato' , sans-serif;
        color: #333;
    }
    .small
    {
        font-size: 15px;
    }

    .btn
    {
        font-weight: bold;
        -webkit-transition: .1s ease-in background-color;
        -webkit-font-smoothing: antialiased;
        letter-spacing: 1px;
    }
    .btn:hover
    {
        transition-property: background-color .2s linear 0s;
        -moz-transition: background-color .2s linear 0s;
        -webkit-transition: background-color .2s linear 0s;
        -o-transition: background-color .2s linear 0s;
    }
    .spanicons
    {
        width: 72px;
        float: left;
        text-align: center;
        margin-top: 40px;
        color: #9e9e9e;
        font-size: 30px;
        cursor: pointer;
    }
    .spanicons:hover
    {
        color: #3498db;
        transition-property: color .2s linear 0s;
        -moz-transition: color .2s linear 0s;
        -webkit-transition: color .2s linear 0s;
        -o-transition: color .2s linear 0s;
    }
    .active
    {
        color: #3498db;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 phone">
            <div class="row1">
                <div class="col-md-12">
                    <input type="tel" name="name" id="telNumber" class="form-control tel" value="" />
                    <div class="num-pad">
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    1
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    2
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    3
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    4
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    5
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    6
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    7
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    8
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    9
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    *
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    0
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="num">
                                <div class="txt">
                                    #
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="overflow: hidden">
                            <div style="float: left">
                                <h3 style="margin: 0; font-family: verdana, helvetica, arial, sans-serif; color: #0d6aad">
                                    Consultas en Linea <br> Consulta el estado de tus procesos
                                </h3>
                            </div>
                            <div class="pull-right" style="text-align: center">
                                <a href="http://intranet.mdv.net/consulta">
                                    <span style="font-size: 35px; text-align: center;" class="glyphicon glyphicon-home"></span><br>INICIO
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body alm-panel-body">
                            <div class="sub-content">
                                <div class="col-md-3" style="padding-left: 0">
                                    <div class="img-lateral img-rounded">
                                        <img src="{{ asset('css/img/teclado.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <form id="frm-consultar-doc" action="procesos">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="control-label" for="">(*) Elija tipo de documento</label>
                                            <select class="selectpicker" name="searchTipo">
                                                <option value="RQ">REQUERIMIENTO</option>
                                                <option value="CZ">COTIZACIÓN</option>
                                                {{--<option value="CD">Cuadro Comparativo</option>--}}
                                                <option value="OC">ORDEN DE COMPRA</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="">(*) Año de Consulta</label>
                                            <select class="selectpicker" name="searchPeriodo">
                                                <option value="19" selected>2019</option>
                                                <!--<option value="15">2015</option>-->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">(*) Número de Documento - No olvide elegir primero el tipo de documento</label>
                                            <table width="100%">
                                                <tbody>
                                                <tr>
                                                    <td width="5%"></td>
                                                    <td width="35%">
                                                        <table class="alm-teclado" border="1">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%207,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_7" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%208,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_8" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%209,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_9" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%204,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_4" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%205,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_5" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%206,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_6" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%201,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_1" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%202,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_2" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%203,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_3" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:pulsaTecla(%200,%205,document.forms[0].searchDoc);">
                                                                        <input type="text" name="tecla_0" class="tecla" value readonly size="1" tabindex="-1" style="cursor: pointer; color: rgb(0,0,102);" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                    </a>
                                                                </td>
                                                                <td colspan="2" align="center">
                                                                    <a href="javascript:pulsaTecla(%20-1,%205,document.forms[0].searchDoc);" class="tecla" style="color: rgb(0,0,102)" onmouseout="this.style.color='#000066'" onmouseover="this.style.cursor='hand';this.style.color='#FF8533';return true;">
                                                                        Limpiar
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="10%">
                                                    </td>
                                                    <td width="50%">
                                                        <input class="form-control" type="number" id="searchDoc" name="searchDoc" value readonly="readonly" style="text-align: center;">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label label-warning" for="">(*)Datos Obligatorios</label>
                                        </div>
                                        <div class="alm-button-place">
                                            <a href="#" id="btn-consultar-doc">
                                                <img src="{{ asset('img/boton_consultar.png') }}">
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

    generarTeclado();

    $('#btn-consultar-doc').click(function(e){

        e.preventDefault();
        var url = $('#frm-consultar-doc').attr('action');
        var data = $('#frm-consultar-doc').serialize();

        $.post(url,data,function(result){
            $('.sub-content').html(result);
        });

    });
});
</script>

@endsection