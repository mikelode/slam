<div class="modal fade"  id="modalFindPersonaO" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
    <div class="modal-dialog"  >
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel" >
                    <div class="panel-heading gs-panel-heading"  style="background: #444444 ; COLOR:#ffffff;" >
                        <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
                        <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px">
                            <span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  ">
                                BUSQUEDA DE PERSONA
                            </span>
                    </div>
                </div>
                <table style="margin-top: -15px;">
                    <tr>
                        <td>
                            <input id="findDniO" class="form-control gs-input" style="width: 90px; font-weight: bold; font-size: 12px;  "  type="text" placeholder="DNI" >
                        </td>
                        <td width="2px"></td>
                        <td>
                            <input id="findNameO" class="form-control gs-input"  style="margin-left: 5px; width:470px ;font-weight: bold; font-size: 12px; "  type="text" placeholder="Nombre">
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="modal-body" STYLE="OVERFLOW: SCROLL" >
                <table class="table" id="resultPersonasO">

                </table>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){

    $('#findDniO').keypress(function(e){
        if(e.which == 13)
        {
            $("#resultPersonas tr").remove();
            var html = '';
            $.getJSON('findPersona',{'term':$(this).val(), 'tipo':'dni'},function(result){
                $.each(result, function(key, value){
                    $('#resultPersonasO').append('<tr><td>' + value.dni +'</td><td>' + value.fullname + '</td><td><button class="btn btn-info btn-xs" onclick="fillResultSelectedGiver(\'' + value.dni + '\', \'' + value.fullname + '\')">Elegir</button></td></tr>');
                });
            });
        }
    });

    $('#findNameO').keypress(function(e){
        if(e.which == 13)
        {
            $("#resultPersonas tr").remove();
            var html = '';
            $.getJSON('findPersona',{'term':$(this).val(), 'tipo':'fname'},function(result){
                $.each(result, function(key, value){
                    $('#resultPersonasO').append('<tr><td>' + value.dni +'</td><td>' + value.fullname + '</td><td><button class="btn btn-info btn-xs" onclick="fillResultSelectedGiver(\'' + value.dni + '\', \'' + value.fullname + '\')">Elegir</button></td></tr>');
                });
            });
        }
    });
});

</script>