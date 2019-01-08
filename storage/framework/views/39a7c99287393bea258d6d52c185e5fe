<div class="modal fade"  id="modalFindDependency" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
    <div class="modal-dialog"  >
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel" >
                    <div class="panel-heading gs-panel-heading"  style="background: #444444 ; COLOR:#ffffff;" >
                        <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>
                        <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px">
                            <span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  ">
                                BUSQUEDA DE DEPENDENCIAS
                            </span>
                    </div>
                </div>
                <table style="margin-top: -15px;">
                    <tr>
                        <td>Descripción:</td>
                        <td width="2px"></td>
                        <td>
                            <input id="findNameDep" class="form-control gs-input"  style="margin-left: 5px; width:470px ;font-weight: bold; font-size: 12px; "  type="text" placeholder="Descripción">
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="modal-body" STYLE="OVERFLOW: SCROLL" >
                <table class="table" id="resultDependency">

                </table>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
    $('#findNameDep').keypress(function(e){
        if(e.which == 13)
        {
            $("#resultDependency tr").remove();
            var html = '';
            $.getJSON('findDependency',{'term':$(this).val()},function(result){
                $.each(result, function(key, value){
                    $('#resultDependency').append('<tr><td>' + value.id +'</td><td>' + value.dsc + '</td><td><button class="btn btn-info btn-xs" onclick="fillResultSelectedDep(\'' + value.id + '\',\'' + value.dsc + '\')">Elegir</button></td></tr>');
                });
            });
        }
    });
});

</script>