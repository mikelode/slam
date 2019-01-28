<table    id="tbCdr_Dll" class="suggest-element table table-striped gs-table-item gs-table-hover " style="font-size:11px; padding:0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">

<?php
if ($Doc=="Req")
{
    ?>
    <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th width="0px" style="display: none;">Sf</th>
            <th width="0px" style="display: none;">Rb</th>
            <th WIDTH="55px"  align="center"   valign="center">Cant Rq</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="80px"   align="center"   valign="center">Clasificador</th>            
            <th WIDTH="430px" align="left"     valign="center">Descripción</th>
            <th WIDTH="430px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" style="display: none" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" style="display: none" align="center"    valign="center">Precio Rq </th>
            <th WIDTH="80px" style="display: none" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdCdItm"  style="display: none"  >0</td>
            <td name="tdCzItm"  style="display: none"   >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>

            <td name="tdSF" style="display: none;" codID="{{ $nom->dllSecfunID }}">{{ $nom->dllSecfun }}</td>
            <td name="tdRubro" style="display: none;" codID="{{ $nom->dllRubroID }}">{{ $nom->dllRubro }}</td>
           
            <td name="tdCant"  align="center" > {{  $nom->dllCant }}</td>            
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdClasf"   align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  style="display: none" align="center"   > </td>
            <td name="tdPrecio" style="display: none" align="center"> 0 </td>
            <td name="tdTotal"  style="display: none"  align="center"> 0 </td>
            <td BGCOLOR="#d9edf7"> <button id="btnCdrRowEDIT" class="btn btn-default btnCdrRowEDIT " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7"> <button id="btnCdrRowDEL" class="btn btn-danger  btnCdrRowDEL" style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdCdItm"  style="display: none" >1</td>
                    <td name="tdCzItm"  style="display: none" >1</td>
                    <td name="tdRqItm"  style="display: none" >1</td>

                      <td name="tdSF" style="display: none;"></td>
                      <td name="tdRubro" style="display: none;"></td>

                    <td name="tdCant"  align="center" >2</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdClasf"  align="center">3</td>                    
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center" style="display: none">6</td>
                    <td name="tdPrecio" align="center" style="display: none" >7</td>
                    <td name="tdTotal"  align="center" style="display: none">8</td> 
                    <td BGCOLOR="#d9edf7"><button id="btnCdrRowEDIT" class="btn btn-default btnCdrRowEDIT " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnCdrRowDEL" class="btn btn-danger btnCdrRowDEL" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>

<?php
}

else if ($Doc=="Ctz")
{
?>

        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th width="0px" style="display: none;">Sf</th>
            <th width="0px" style="display: none;">Rb</th>
            <th WIDTH="55px"  align="center"   valign="center">Cant</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="80px"   align="center"   valign="center">Clasificador</th>            
            <th WIDTH="430px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="430px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" style="display: none" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" style="display: none" align="center"    valign="center">Precio Ctz</th>
            <th WIDTH="80px" style="display: none" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $key=>$nom)
        <tr >
            <td name="tdCdItm"  style="display: none"  >0</td>
            <td name="tdCzItm"  style="display: none"   >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>

            <td name="tdSF" style="display: none;" codID="{{ $nom->dllSecfunID }}">{{ $nom->dllSecfun }}</td>
            <td name="tdRubro" style="display: none;" codID="{{ $nom->dllRubroID }}">{{ $nom->dllRubro }}</td>
           
            <td name="tdCant"  align="center" > {{  $nom->dllCant }}</td>            
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdClasf"   align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  style="display: none" align="center"   > </td>
            <td name="tdPrecio" style="display: none" align="center"> 0 </td>
            <td name="tdTotal"  style="display: none"  align="center"> 0 </td>
            <td BGCOLOR="#d9edf7"> <button id="btnCdrRowEDIT" class="btn btn-default btnCdrRowEDIT " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7"> <button id="btnCdrRowDEL" class="btn btn-danger  btnCdrRowDEL" style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdCdItm"  style="display: none" >1</td>
                    <td name="tdCzItm"  style="display: none" >1</td>
                    <td name="tdRqItm"  style="display: none" >1</td>

              <td name="tdSF" style="display: none;"></td>
              <td name="tdRubro" style="display: none;"></td>

                    <td name="tdCant"  align="center" >2</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdClasf"  align="center">3</td>                    
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center" style="display: none">6</td>
                    <td name="tdPrecio" align="center" style="display: none" >7</td>
                    <td name="tdTotal"  align="center" style="display: none">8</td> 
                    <td BGCOLOR="#d9edf7"><button id="btnCdrRowEDIT" class="btn btn-default btnCdrRowEDIT " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnCdrRowDEL" class="btn btn-danger btnCdrRowDEL" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>
<?php
}


else if   ($Doc=="Fte")
{
?>

        <thead align="center">
        <tr>
            <th colspan="5"></th>
            <th colspan="5" style="padding: 0px;" id="sthMontoCC">

            </th>
        </tr>
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ROWSPAN="2" ></th>
            <th WIDTH="0px" style="display: none" rowspan="2" ></th>
            <th WIDTH="0px" style="display: none" rowspan="2" ></th>
            <th width="0px" style="display: none;" rowspan="2">Sf</th>
            <th width="0px" style="display: none;" rowspan="2">Rb</th>
            <th WIDTH="55px"  align="center" rowspan="2"  valign="center">Cant Fte</th>
            <th WIDTH="45px"  align="center"  rowspan="2" valign="center">Und</th>
            <th WIDTH="80px"   align="center" rowspan="2"  valign="center">Clasificador</th>
            <th WIDTH="430px" align="left" rowspan="2"  valign="center">Descripcion</th>
            <th WIDTH="430px" align="left" rowspan="2" valign="center">Especificaciones</th>
            <th WIDTH="90px"  align="left" rowspan="2" valign="center">Marca</th>
            <th WIDTH="80px"  align="center" rowspan="2" valign="center">Precio Fte</th>
            <th WIDTH="80px"  align="right" rowspan="2" valign="center">Total</th>
            <th valign="right" rowspan="2" >Editar</th>
            <th align="right" rowspan="2"></th>
        </tr>
        </thead>
        <tbody>
          @foreach($result as $key=>$nom)
        <tr id="{{ 'row'.$key }}">
            <td name="tdCdItm"  style="display: none" fteID="{{  $nom->dllFteID  }}"   >{{ $nom->dllCdItm}}</td>
            <td name="tdCzItm"  style="display: none"   >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>

            <td name="tdSF" style="display: none;" codID="{{ $nom->dllSecfunID }}">{{ $nom->dllSecfun }}</td>
            <td name="tdRubro" style="display: none;" codID="{{ $nom->dllRubroID }}">{{ $nom->dllRubro }}</td>
           
            <td name="tdCant"  align="center" >{{ $nom->dllCant }}</td>
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdClasf"   align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"    >
                <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" autofocus placeholder="Marca" style="width:95px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" value="{{ $nom->dllMarca }}">
            </td>
            <td name="tdPrecio"  align="center">
                <input id="txProdPrecio" name ="txProdPrecio" onblur="fnComputeTotal({{ $key }}, this.value)" class="form-control gs-input" placeholder="Precio" style="width:75px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" value="{{ $nom->dllPrecio }}">
            </td>
            <td name="tdTotal"    align="center">
                <input type="text" class="form-control gs-input dllTotal" value="{{ $nom->dllTotal }}" readonly>
            </td>
            <td BGCOLOR="#d9edf7">
                {{--<button id="btnLogCC_ItemEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button>--}}
            </td>
            <td BGCOLOR="#d9edf7">
                <button id="btnLogCC_ItemSave" class="btn btn-primary " style="width:45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;" data-key="{{ $key }}">Guardar</button>
            </td>
            {{--<td BGCOLOR="#d9edf7" style="display: none" > <button id="btnCdrRowDEL" class="btn btn-danger  " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>--}}
        </tr>
        @endforeach

        </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdCdItm"  style="display: none" >1</td>
                    <td name="tdCzItm"  style="display: none" >1</td>
                    <td name="tdRqItm"  style="display: none" >1</td>

              <td name="tdSF" style="display: none;"></td>
              <td name="tdRubro" style="display: none;"></td>

                    <td name="tdCant"  align="center" >2</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdClasf"  align="center">3</td>                    
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center" ></td>
                    <td name="tdPrecio" align="center" ></td>
                    <td name="tdTotal"  align="center" ></td> 
                    <td BGCOLOR="#d9edf7"><button id="btnLogCC_ItemEDIT" class="btn btn-default " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                     <td BGCOLOR="#d9edf7" style="display: none" > <button id="btnCdrRowDEL" class="btn btn-danger  " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>

<?php
}    
else 
{
?>
        <thead align="center">
        <tr CLASS="gsTh" >
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th WIDTH="0px" style="display: none" ></th>
            <th width="0px" style="display: none;">Sf</th>
            <th width="0px" style="display: none;">Rb</th>
            <th WIDTH="55px"  align="center"   valign="center">Cant.</th>
            <th WIDTH="45px"  align="center"   valign="center">Und</th>
            <th WIDTH="80px"   align="center"   valign="center">Clasificador</th>            
            <th WIDTH="430px" align="left"     valign="center">Descripcion</th>
            <th WIDTH="430px" align="left"     valign="center">Especificaciones</th>
            <th WIDTH="90px" style="display: none" align="left"     valign="center">Marca</th>
            <th WIDTH="80px" style="display: none" align="center"    valign="center">Precio.</th>
            <th WIDTH="80px" style="display: none" align="right"    valign="center">Total</th>
            <th valign="right" >Editar</th>
            <th align="right"></th>
        </tr>
        </thead>
        <tbody>


          @foreach($result as $key=>$nom)
        <tr >
            <td name="tdCdItm"  style="display: none"  >{{ $nom->dllCdItm}}</td>
            <td name="tdCzItm"  style="display: none"   >{{ $nom->dllCzItm }}</td>
            <td name="tdRqItm"  style="display: none"   >{{ $nom->dllRqItm }}</td>

            <td name="tdSF" style="display: none;" codID="{{ $nom->dllSecfunID }}">{{ $nom->dllSecfun }}</td>
            <td name="tdRubro" style="display: none;" codID="{{ $nom->dllRubroID }}">{{ $nom->dllRubro }}</td>
           
            <td name="tdCant"  align="center" > {{  $nom->dllCant }}</td>            
            <td name="tdUnd"  align="center" codID="{{  $nom->dllUndID  }}"  >{{ $nom->dllUndAbrv }} </td>
            <td name="tdClasf"   align="center" codID="{{  $nom->dllClasfID  }}" >{{ $nom->dllClasfCod }} </td>
            <td name="tdProd"  align="left"  codID="{{  $nom->dllProdID  }}"  >{{ $nom->dllProdDsc }}  </td>
            <td name="tdEspf"  align="left"   > {{  $nom->dllProdEspf  }} </td>
            <td name="tdMarca"  style="display: none" align="center"   > </td>
            <td name="tdPrecio" style="display: none" align="center"> 0 </td>
            <td name="tdTotal"  style="display: none"  align="center"> 0 </td>
            <td BGCOLOR="#d9edf7"> <button id="btnCdrRowEDIT" class="btn btn-default btnCdrRowEDIT " style="width:   45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
            <td BGCOLOR="#d9edf7"> <button id="btnCdrRowDEL" class="btn btn-danger  btnCdrRowDEL" style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">X</button> </td>
        </tr>
        @endforeach
          </tbody>
        <tfoot>
          <tr class="fila-Hide">
                    <td name="tdCdItm"  style="display: none" >1</td>
                    <td name="tdCzItm"  style="display: none" >1</td>
                    <td name="tdRqItm"  style="display: none" >1</td>

              <td name="tdSF" style="display: none;"></td>
              <td name="tdRubro" style="display: none;"></td>

                    <td name="tdCant"  align="center" >2</td>
                    <td name="tdUnd"  align="center"  >5</td>
                    <td name="tdClasf"  align="center">3</td>                    
                    <td name="tdProd"  align="left"   >4</td>
                    <td name="tdEspf"  align="left"   >6</td>
                    <td name="tdMarca"  align="center" style="display: none">6</td>
                    <td name="tdPrecio" align="center" style="display: none" >7</td>
                    <td name="tdTotal"  align="center" style="display: none">8</td> 
                    <td BGCOLOR="#d9edf7"><button id="btnCdrRowEDIT" class="btn btn-default btnCdrRowEDIT " style="width:   45Px  ;height: 25px ; padding:0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td>
                    <td BGCOLOR="#d9edf7" ><button id="btnCdrRowDEL" class="btn btn-danger btnCdrRowDEL" style="width: 30px  ;height: 25px ; padding:0; font-size:10px;  " type="button">X</button> </td>
                </tr>

        </tfoot>

<?php
}    

?>

      
        </table>