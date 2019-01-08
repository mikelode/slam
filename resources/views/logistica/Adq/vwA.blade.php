<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">

<div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 55px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >
{!! Form::open(array('url'=>'','id'=>'FrmRegistrar','autocomplete'=>'off')) !!}
    <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
    <tr valign="center" >
    <TD>
    <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
    </TD>
        <td ALIGN="RIGHT" width="170px">
        <span style="font-size: 16px;"> REQUERIMIENTOS :</span>
        </td>
        <td> {!! Form::text('txAnio', 2015, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:55px; height:40px ; padding:6px;','id'=>'txAnio'  ))  !!}</td>
        <td> {!! Form::text('txNroReq', null, array('class' => 'form-control ', 'placeholder'=>'', 'style'=>'width:70px; height:40px','id'=>'txNroReq'  ))  !!} </td>
        <td> {!! Form::button('Buscar',['class'=>'btn btn-primary','id'=>'btnRegistrar','style'=>'width:70px; height:40px' ]) !!}  </td>
        <td align="right" width="715px">
          {!! Form::button('',['class'=>'btn btn-default','id'=>'btnLogReqNew','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'NUEVO','style'=>'width:45px; height:45px; background: url(img/new2.png) no-repeat; background-position:center;' ]) !!}
          {!! Form::button('',['class'=>'btn btn-default','id'=>'btnLogReqEdit','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'MODIFICAR','style'=>'width:45px; height:45px ;  background: url(img/edit.png) no-repeat; background-position:center;']) !!}
          {!! Form::button('',['class'=>'btn btn-default','id'=>'btnLogReqDel','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'ELIMINAR','style'=>'width:45px; height:45px; background: url(img/delete.png) no-repeat; background-position:center;' ]) !!}
          {!! Form::button('',['class'=>'btn btn-default','id'=>'btnLogReqPrint','data-toggle'=>'tooltip' ,'data-placement'=>'bottom','title'=>'IMPRIMIR','style'=>'width:45px; height:45px; background: url(img/print.png) no-repeat; background-position:center;' ]) !!}
        </td>
    </tr>
    </table>
  {!! Form::close() !!}
</div>

</div></div></div>
