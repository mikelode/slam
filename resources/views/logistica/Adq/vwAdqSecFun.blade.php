<div class="container" style="width: 1200px">
<div class="panel panel-default" style="border-radius: 7px;margin-top: -5px;  background: #fdfdfd; border-top-width: 2px; border-top-color: #337ab7;  ">
<div class="panel-body">


     <div class="panel-heading gs-panel-heading"  style=" position: relative;border-radius: 5px; width: 1140px ;  height: 55px; border: 1px solid #cecece ; padding-top: 0px; margin-top: 0px ; margin-bottom:10px; background: #f6f6f6 ;" >

        <table class="gs-table" style="margin-left: 45px ; margin-top: 2px;" >
        <tr valign="center" >
        <TD>
        <img src="img/pestana1.png" width="40px" height="40px" style="margin-right: 10px">
        </TD>
            <td ALIGN="LEFT">
            <span style="font-size: 16px;"> REGISTRO DE SECUENCIAS FUNCIONALES</span>
            </td>

        </tr>
        </table>
    </div>


    <table class="gs-table" style="margin-left: 5px ; margin-top: 2px;" >
    <tr valign="center">
        <td> {!! Form::text('txSecFunAutoDsc', null, array('class' => 'form-control ', 'placeholder'=>'Secuencia Funcional', 'style'=>'width:960px; height:35px ; ','id'=>'txSecFunAutoDsc'    ))  !!} </td>
        <td align="LEFT" width="215px">   <span id="btnSecFunRowNEW" class="btn btn-info" STYLE="WIDTH:150PX;height: 35px; padding-top: 10px; font-weight: bold; margin-left:20px;"> Nuevo Registro</span>     </td>
    </tr>
    </table>

    <div id="divSecFunDll">

    </div>

</div>


<div id = "loadModals" > </div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtn">
<div style="height: 56px"></div>

<div id="divDialog">
<div id="divDialogCont"></div>
</div>

</div></div>



