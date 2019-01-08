@extends('layout-public')

@section('main-content')
<style>
    .sombra2 {
        text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
        font-size: 20px;
        font-weight: bold;
        font-family: 'Arial Black';
    }
</style>
<div class="col-md-1"></div>
<div class="col-md-10">
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
                                    <select class="form-control" name="searchTipo">
                                        <option value="NA" selected>Seleccionar Tipo</option>
                                        <option value="RQ">Requerimiento</option>
                                        <option value="CZ">Cotización</option>
                                        <option value="CD">Cuadro Comparativo</option>
                                        <option value="OC">Orden de Compra</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="">(*) Año de Consulta</label>
                                    <select class="form-control" name="searchPeriodo">
                                        <option value="16" selected>2016</option>
                                        <option value="16" selected>2017</option>
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
                                                    <input class="form-control" type="number" id="searchDoc2" name="searchDoc2" value readonly="readonly" style="text-align: center;">
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
<div class="col-md-1"></div>

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