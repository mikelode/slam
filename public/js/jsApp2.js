//   fila = $("#tbProdBienes tr:last").clone(true).removeClass('fila-base');
//   fila.find("td").eq(0).html('0');
//   fila.find("td").eq(0).attr('idT','uuu');
//   fila.children('td').eq(2).children('input').val('valor');

/*
 fila.find("td").eq(0).html( parent.find("td").eq(0).text());
 fila.find("td").eq(1).html( parent.children('td').eq(1).children('input').val());
 fila.find("td").eq(2).removeAttr("codVal");
 fila.find("td").eq(2).attr("codVal","sinval");
 fila.find("td").eq(2).html( parent.children('td').eq(2).children('input').val());
 fila.find("td").eq(2).html( parent.find("td[name=tdClasf]").attr("codVal"));
 fila.find("td").eq(2).html( parent.find("td[name=Clasf]").children('input').val());
 fila.find("td").eq(3).html( parent.children('td').eq(3).children('input').val());
 */

//  $("#loadModals").html(jsFunLoadWait());
// $('#dvWait').css({'width': '400px' , 'height': 'auto' } );
//  $('#dvWait').css({'margin-top': 'top' ,'margin-left': '-200px'});
// $('#dvWait').modal('show');

//        $.post('controller/logGet',datos,function(data){
//    alert(dat a[0].Dsc);
//    bootbox.alert("Proceso Concluido");
// }).fail(function(){      alert('Se produjo un ERROR en la Operacion ');       });
//$('#txDep').val(); $( "#txCodTipoReq" ).focus();


function jsFunGetRowTemplate(tipo, tiposf)
{
    //rowTmp =' <tr id = "rowTemplate" codID="-"  valign="top" class="Base "> ';
    rowTmp='    <td width="1%" name="tdID" style="display: none" > </td> ';

    if(tiposf == '000M'){
        rowTmp += '<td width="3%" name="tdSF" style="padding: 3px 0px;"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="font-size:11px;" codID="NN" type="text"></td>';
        rowTmp += '<td width="3%" name="tdRubro" style="padding: 3px 0px;"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rubro" style="font-size:11px;" codID="NN" type="text"></td>';
    }
    else{
        rowTmp += '<td width="3%" name="tdSF" style="padding: 3px 0px; display: none;"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="font-size:11px;" codID="NN" type="text"></td>';
        rowTmp += '<td width="3%" name="tdRubro" style="padding: 3px 0px; display: none;"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rubro" style="font-size:11px;" codID="NN" type="text"></td>';
    }

    rowTmp+='    <td width="5%" name="tdCant"  style="padding: 3px 0px;" > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="font-size:11px;" codID="NN" type="text"></td> ';
    rowTmp+='    <td width="10%" name="tdClasf" style="padding: 3px 0px;"> <input id="txProdClasf" name="txProdClasf"  class="form-control gs-input autoFindClasf " placeholder="Clasificador" style="font-size:11px;" type="text" codID="NN" ></td> ';
    rowTmp+='    <td width="30%" name="tdProd" style="padding: 3px 0px;" > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="font-size:11px;"codID="NN"  type="text"></td>';
    rowTmp+='    <td width="8%" name="tdUnd"  style="padding: 3px 0px;" > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="font-size:11px;" codID="NN" type="text"></td>';

    if(tipo=="NEW") {
        rowTmp+='    <td width="22%" name="tdEspf"  style="padding: 3px 0px;"> <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="font-size:11px;" ROWS="7"  ></textarea></td>';
        rowTmp+='    <td width="8%" name="tdPrecio" style="padding: 3px 0px;"> <input id="txProdPrecio" name="txProdPrecio" class="form-control gs-input" placeholder="S/. Precio" style="font-size:11px; margin-left:0px;" type="number"> </td>';
        // rowTmp+='    <td width="2%"></td> ';
        rowTmp += '    <td width="5%" style="padding: 3px 0px;" align="center"> <button id="btnLogItemNEW" class="btn btn-primary addRow" style="height: 35px ; padding=0; font-size:10px; padding-left: 3px  " type="button">AÑADIR</button> </td>';
        rowTmp += '    <td width="3%" style="padding: 3px 0px;" align="center"> <button  id="btnLogItemCANCEL" class="btn btn-danger CancelRow" style="height: 35px ; padding=0; font-size:10px;  " type="button">X</button> </td>';
    }
    if(tipo=="EDIT") {
        rowTmp+='    <td width="22%" name="tdEspf"  style="padding: 3px 0px;"> <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="font-size:11px;" ROWS="4"  ></textarea></td>';
        rowTmp+='    <td width="8%" name="tdPrecio" style="padding: 3px 0px;"> <input id="txProdPrecio" name="txProdPrecio" class="form-control gs-input" placeholder="S/. Precio" style="font-size:11px; margin-left:0px;" type="number"> </td>';
        // rowTmp+='    <td></td> ';
        rowTmp += '    <td width="5%" style="padding: 3px 0px;" align="center"> <button id="btnLogItemUPD" class="btn btn-primary updRow" style="height: 35px ; padding=0; font-size:10px; padding-left: 3px;padding-right: 2px;  " type="button">Modificar</button> </td>';
        rowTmp += '    <td width="3%" style="padding: 3px 0px;" align="center"> <button  id="btnLogItemCANCEL" class="btn btn-danger atrasRow" style="height: 35px ; padding=0; font-size:10px; font-size: 9px;  " type="button"><<</button> </td>';
    }
    //rowTmp+=' </tr> ';
    return rowTmp ;

}

/*
function jsFunCtzGetRowEdit()
{  
    rowCtzTmp ='    <td name="tdID" style="display: none" > </td> ';
    rowCtzTmp+='    <td name="tdCant"  > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px;" codID="NN" type="text"></td> ';
    rowCtzTmp+='    <td name="tdUnd"   > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="width:50px; font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td name="tdProd"  > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="width:550px; font-size:11px;"codID="NN"  type="text"></td>';
    rowCtzTmp+='    <td name="tdEspf"  > <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="width:365px; font-size:11px; margin-left:3px; " ROWS="3"   ></textarea></td>';
    rowCtzTmp+= '   <td> <button class="btn btn-primary btnCtzRowUPD" style="width: 70Px  ;height: 25px ; padding:0; margin-left:5px; font-size:11px;  " type="button">Guardar</button> </td>';
    rowCtzTmp+= '   <td> <button   class="btn btn-primary btnCtzRowATRAS" style="width: 30px  ;height: 25px ; padding:0 ; margin-left:5px; font-size:10px;  " type="button"> >>> </button> </td>';
    return rowCtzTmp ;
}*/
function jsFunCtzGetRowTemplate( tipo)
{  
    rowCtzTmp='';
    if(tipo=="ADD") {
    rowCtzTmp='<tr >';
    rowCtzTmp+='    <td width="0%" name="tdCzItm" style="display: none" > 0 </td> ';
    rowCtzTmp+='    <td width="0%" name="tdRqItm" style="display: none" > 0</td> ';
    rowCtzTmp += '<td width="5%" name="tdSF"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp += '<td width="5%" name="tdRubro"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rubro" style="font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td width="10%" name="tdCant"  > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="font-size:11px;" codID="NN" type="text"></td> ';
    rowCtzTmp+='    <td width="10%" name="tdUnd"   > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td width="30%" name="tdProd"  > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="font-size:11px;"codID="NN"  type="text"></td>';
    rowCtzTmp+='    <td width="30%" name="tdEspf"  > <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="font-size:11px;" ROWS="2"   ></textarea></td>';
    rowCtzTmp+= '   <td width="5%"> <button class="btn btn-primary btnCtzRowADD" style="height: 35px ; margin-left:5px; font-size:11px;  " type="button">Añadir</button> </td>';
    rowCtzTmp+= '   <td width="5%"> <button   class="btn btn-primary btnCtzRowCANCEL" style="height: 35px ; margin-left:5px; font-size:10px;  " type="button"> >>> </button> </td>';
    rowCtzTmp+='</tr>';
    }
    else if(tipo=="UPD") {
    rowCtzTmp+='    <td name="tdCzItm" style="display: none" > 0</td> ';
    rowCtzTmp+='    <td name="tdRqItm" style="display: none" >0 </td> ';
    rowCtzTmp += '<td name="tdSF"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp += '<td name="tdRubro"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rubro" style="font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td name="tdCant"  > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="font-size:11px;" codID="NN" type="text"></td> ';
    rowCtzTmp+='    <td name="tdUnd"   > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td name="tdProd"  > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="font-size:11px;"codID="NN"  type="text"></td>';
    rowCtzTmp+='    <td name="tdEspf"  > <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="font-size:11px;" ROWS="3"   ></textarea></td>';
    rowCtzTmp+= '   <td> <button class="btn btn-primary btnCtzRowUPD" style="height: 25px ; margin-left:5px; font-size:11px;  " type="button">Guardar</button> </td>';
    rowCtzTmp+= '   <td> <button   class="btn btn-primary btnCtzRowATRAS" style="height: 25px ; margin-left:5px; font-size:10px;  " type="button"> >>> </button> </td>';
    }
    return rowCtzTmp ;
}

function jsFunCdrGetRowTemplate( tipo)
{  
    rowCtzTmp='';
    if(tipo=="ADD") {
    rowCtzTmp='<tr >';
    rowCtzTmp+='    <td name="tdCdItm" style="display: none" > 0 </td> ';
    rowCtzTmp+='    <td name="tdCzItm" style="display: none" > 0 </td> ';
    rowCtzTmp+='    <td name="tdRqItm" style="display: none" > 0</td> ';
    rowCtzTmp+='    <td name="tdCant"  > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px;" codID="NN" type="text"></td> ';
    rowCtzTmp+='    <td name="tdUnd"   > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="width:50px; font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td name="tdClasf" style="padding: 3px 0px;"> <input id="txProdClasf" name="txProdClasf"  class="form-control gs-input autoFindClasf " placeholder="Clasificador" style="width:80px; font-size:11px;" type="text" codID="NN" ></td> ';
    rowCtzTmp+='    <td name="tdProd"  > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="width:460px; font-size:11px;"codID="NN"  type="text"></td>';
    rowCtzTmp+='    <td name="tdEspf"  > <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="width:365px; font-size:11px; margin-left:3px; " ROWS="2"   ></textarea></td>';
    rowCtzTmp+= '   <td> <button class="btn btn-primary btnCdrRowADD" style="width: 70Px  ;height: 35px ; padding:0; margin-left:5px; font-size:11px;  " type="button">Añadir</button> </td>';
    rowCtzTmp+= '   <td> <button   class="btn btn-primary btnCdrRowCANCEL" style="width: 30px  ;height: 35px ; padding:0 ; margin-left:5px; font-size:10px;  " type="button"> >>> </button> </td>';
    rowCtzTmp+='</tr>';
    }
    else if(tipo=="UPD") {
    rowCtzTmp+='    <td name="tdCdItm" style="display: none" > 0</td> ';
    rowCtzTmp+='    <td name="tdCzItm" style="display: none" > 0</td> ';
    rowCtzTmp+='    <td name="tdRqItm" style="display: none" >0 </td> ';
    rowCtzTmp+='    <td name="tdCant"  > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px;" codID="NN" type="text"></td> ';
    rowCtzTmp+='    <td name="tdUnd"   > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="width:50px; font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td name="tdClasf" style="padding: 3px 0px;"> <input id="txProdClasf" name="txProdClasf"  class="form-control gs-input autoFindClasf " placeholder="Clasificador" style="width:80px; font-size:11px;" type="text" codID="NN" ></td> ';
    rowCtzTmp+='    <td name="tdProd"  > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="width:460px; font-size:11px;"codID="NN"  type="text"></td>';
    rowCtzTmp+='    <td name="tdEspf"  > <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="width:365px; font-size:11px; margin-left:3px; " ROWS="3"   ></textarea></td>';
    rowCtzTmp+= '   <td> <button class="btn btn-primary btnCdrRowUPD" style="width: 70Px  ;height: 25px ; padding:0; margin-left:5px; font-size:11px;  " type="button">Guardar</button> </td>';
    rowCtzTmp+= '   <td> <button   class="btn btn-primary btnCdrRowATRAS" style="width: 30px  ;height: 25px ; padding:0 ; margin-left:5px; font-size:10px;  " type="button"> >>> </button> </td>';
    }
    return rowCtzTmp ;
}

function jsFunFteGetRowTemplate( )
{  


    rowCtzTmp='';
    rowCtzTmp+='    <td name="tdCdItm" style="display: none" > 0</td> ';
    rowCtzTmp+='    <td name="tdCzItm" style="display: none" > 0</td> ';
    rowCtzTmp+='    <td name="tdRqItm" style="display: none" >0 </td> ';
    rowCtzTmp+='    <td name="tdCant"  ></td> ';
    rowCtzTmp+='    <td name="tdUnd"   > </td>';
    rowCtzTmp+='    <td name="tdClasf" ></td> ';
    rowCtzTmp+='    <td name="tdProd"  ></td>';
    rowCtzTmp+='    <td name="tdEspf"  ></td>';
    rowCtzTmp+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:95px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    rowCtzTmp+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:75px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    rowCtzTmp+='    <td name="tdTotal"  align="center">  </td>';
    rowCtzTmp+='    <td BGCOLOR="#d9edf7"><button id="btnLogCC_ItemSave" class="btn btn-primary " style="width:45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">Guardar</button> </td>';
    rowCtzTmp+='    <td BGCOLOR="#d9edf7" ><button id="btnLogCC_ItemCancel" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
  
     
    return rowCtzTmp ;
}


function jsFunOC_EditColumns(tipo)
{
     tmpTds ='';
    if(tipo =="UPD")
    {

    tmpTds ='    <td name="tdOcItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdCdItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdCzItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdRqItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdSF"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';

    tmpTds +='    <td name="tdRubro"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rb" style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';
    tmpTds+='    <td name="tdCant"  align="center"> <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';
     tmpTds+='    <td name="tdSecFun" align="center"> <input id="txProdSecFun" name ="txProdSecFun" class="form-control gs-input" placeholder="SecFun" style="width:60px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdClasf" align="center"> <input id="txProdClasf" name ="txProdClasf" class="form-control gs-input" placeholder="Clasificador" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdUnd"   align="center" > <input id="txProdUnd" name ="txProdUnd" class="form-control gs-input" placeholder="Und" style="width:45px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';

    tmpTds+='    <td name="tdProd"  align="left"  > <input id="txProdProd" name ="txProdProd" class="form-control gs-input" placeholder="Descripcion" style="width:310px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdEspf"  align="left"  > <textarea id="txProdEspf" name ="txProdEspf" class="form-control gs-input" placeholder="Especificaciones" style="width:250px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" rows="3"></textarea>  </td>';
    tmpTds+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:100px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:70px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdEnvio" align="center"> <input id="txProdEnvio" name ="txProdEnvio" class="form-control gs-input" placeholder="Envio" style="width:50px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';

    tmpTds+='    <td name="tdTotal"   align="center"> <input id="txProdTotal" name ="txProdTotal" class="form-control gs-input" placeholder="Total" style="width:50px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" onblur="fnSetUnitario(this)"> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllSAVE" class="btn btn-primary " style="height: 25px; padding-top: 3px" type="button"><i class="glyphicon glyphicon-save"></i></button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnLogOC_dllCANCEL" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
   }
   else
   {
    tmpTds =' <tr> ';
    tmpTds +='    <td name="tdOcItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdCdItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdCzItm"  style="display: none" >0</td> ';
    tmpTds +='    <td name="tdRqItm"  style="display: none" >0</td> ';

   tmpTds +='    <td name="tdSF"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';
   tmpTds +='    <td name="tdRubro"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rb" style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';

    tmpTds+='    <td name="tdCant"  align="center"> <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';

     tmpTds+='    <td name="tdSecFun" align="center"> <input id="txProdSecFun" name ="txProdSecFun" class="form-control gs-input" placeholder="SecFun" style="width:60px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';


    tmpTds+='    <td name="tdClasf" align="center"> <input id="txProdClasf" name ="txProdClasf" class="form-control gs-input" placeholder="Clasificador" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdUnd"   align="center" > <input id="txProdUnd" name ="txProdUnd" class="form-control gs-input" placeholder="Und" style="width:45px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdProd"  align="left"  > <input id="txProdProd" name ="txProdProd" class="form-control gs-input" placeholder="Descripcion" style="width:270px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdEspf"  align="left"  > <textarea id="txProdEspf" name ="txProdEspf" class="form-control gs-input" placeholder="Especificaciones" style="width:250px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" rows="3"></textarea>  </td>';

    tmpTds+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:100px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdEnvio" align="center"> <input id="txProdEnvio" name ="txProdEnvio" class="form-control gs-input" placeholder="Envio" style="width:50px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdTotal"   align="center"> <input id="txProdTotal" name ="txProdTotal" class="form-control gs-input" placeholder="Total" style="width:50px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" onblur="fnSetUnitario(this)"> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7"><button id="btnLogOC_dllADD" class="btn btn-success" style="height: 25px; padding-top: 3px" type="button"><i class="glyphicon glyphicon-save"></i></button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnLogOC_dllCLOSE" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
    tmpTds+='</tr>';

   }

    return tmpTds;
}

function jsFunOS_EditColumns( tipo)
{
     tmpTds ='';
    if(tipo =="UPD")
    {
    tmpTds ='    <td name="tdOsItm"  style="display: none" ></td> ';
    tmpTds +='   <td name="tdCdItm"  style="display: none" ></td> ';
    tmpTds +='   <td name="tdCzItm"  style="display: none" ></td> ';
    tmpTds +='   <td name="tdRqItm"  style="display: none" ></td> ';

        tmpTds +='    <td name="tdSF"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';
        tmpTds +='    <td name="tdRubro"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rb" style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';

    tmpTds+='    <td name="tdCant"  align="center"> <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';

   

    tmpTds+='    <td name="tdClasf" align="center"> <input id="txProdClasf" name ="txProdClasf" class="form-control gs-input" placeholder="Clasificador" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';

    tmpTds+='    <td name="tdUnd"   align="center" > <input id="txProdUnd" name ="txProdUnd" class="form-control gs-input" placeholder="Und" style="width:45px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdProd"  align="left"  > <input id="txProdProd" name ="txProdProd" class="form-control gs-input" placeholder="Descripcion" style="width:350px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdEspf"  align="left"  > <textarea id="txProdEspf" name ="txProdEspf" class="form-control gs-input" placeholder="Especificaciones" style="width:300px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" rows="3"></textarea>  </td>';

    tmpTds+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:90px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdTotal"   align="center">  </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" width="50px"><button id="btnLogOS_dllSAVE" class="btn btn-primary " style="width:45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">Guardar</button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnLogOS_dllCANCEL" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
    }
    else
    {

    tmpTds ='<tr>';
    tmpTds +='    <td name="tdOsItm"  style="display: none" ></td> ';
    tmpTds +='   <td name="tdCdItm"  style="display: none" ></td> ';
    tmpTds +='   <td name="tdCzItm"  style="display: none" ></td> ';
    tmpTds +='   <td name="tdRqItm"  style="display: none" ></td> ';

    tmpTds +='    <td name="tdSF"><input id="txProdSF" name ="txProdSF" class="form-control gs-input" placeholder="S.F." style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';
    tmpTds +='    <td name="tdRubro"><input id="txProdRubro" name ="txProdRubro" class="form-control gs-input" placeholder="Rb" style="width:30px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td> ';

    tmpTds+='    <td name="tdCant"  align="center"> <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';

     


    tmpTds+='    <td name="tdClasf" align="center"> <input id="txProdClasf" name ="txProdClasf" class="form-control gs-input" placeholder="Clasificador" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdUnd"   align="center" > <input id="txProdUnd" name ="txProdUnd" class="form-control gs-input" placeholder="Und" style="width:45px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdProd"  align="left"  > <input id="txProdProd" name ="txProdProd" class="form-control gs-input" placeholder="Descripcion" style="width:350px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdEspf"  align="left"  > <textarea id="txProdEspf" name ="txProdEspf" class="form-control gs-input" placeholder="Especificaciones" style="width:300px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text" rows="3"></textarea>  </td>';

    tmpTds+='    <td name="tdMarca"  align="left"> <input id="txProdMarca" name ="txProdMarca" class="form-control gs-input" placeholder="Marca" style="width:90px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdPrecio" align="center"> <input id="txProdPrecio" name ="txProdPrecio" class="form-control gs-input" placeholder="Precio" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text">  </td>';
    tmpTds+='    <td name="tdTotal"   align="center">  </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" width="50px"><button id="btnLogOS_dllADD" class="btn btn-primary " style="width:45Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">Guardar</button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnLogOS_dllCLOSE" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
    tmpTds+='</tr> ';
    }
    return tmpTds;
}


/*function jsFunCtzGetRowTmp(tipo)
{
   // rowCtzTmp =' <tr id = "rowCtzTmp" codID="-"  valign="top" class="Base "> ';
    rowCtzTmp+='    <td name="tdID" style="display: none" > </td> ';
    rowCtzTmp+='    <td name="tdCant"  > <input id="txProdCant" name ="txProdCant" class="form-control gs-input" placeholder="Cant" style="width:55px; font-size:11px;" codID="NN" type="text"></td> ';
    rowCtzTmp+='    <td name="tdUnd"   > <input id="txProdUnd" name="txProdUnd" class="form-control gs-input" placeholder="Unidad" style="width:50px; font-size:11px;" codID="NN" type="text"></td>';
    rowCtzTmp+='    <td name="tdProd"  > <input id="txProdProd" name="txProdProd" class="form-control gs-input autoProd " placeholder="Bien o Servicio" style="width:550px; font-size:11px;"codID="NN"  type="text"></td>';
    
    rowCtzTmp+='    <td name="tdEspf"  > <textarea id="txProdEspf" name="txProdEspf" class="form-control gs-textarea" placeholder="Especificaciones" style="width:380px; font-size:11px;" ROWS="3"  ></textarea></td>';
    rowCtzTmp+='    <td width="10px"> </td>';
    if(tipo=="NEW") {
        rowCtzTmp += '    <td> <button  class="btn btn-primary btnCtzRowADD" style="width: 60Px  ;height: 25px ; padding=0; font-size:11px;  " type="button">Add</button> </td>';
        rowCtzTmp+='    <td width="5px"> </td>';
        rowCtzTmp += '    <td> <button   class="btn btn-danger btnCtzRowCANCEL" style="width: 30px  ;height: 25px ; padding=0; font-size:10px;  " type="button">X</button> </td>';
    }
    if(tipo=="EDIT") {
        rowCtzTmp += '    <td> <button class="btn btn-primary btnCtzRowUPD" style="width: 70Px  ;height: 25px ; padding=0; font-size:11px;  " type="button">Guardar</button> </td>';
        rowCtzTmp+='    <td width="5px"> </td>';
        rowCtzTmp += '    <td> <button   class="btn btn-danger btnCtzRowCANCEL" style="width: 30px  ;height: 25px ; padding=0; font-size:10px;  " type="button">X</button> </td>';
    }
  //  rowCtzTmp+=' </tr> ';
    return rowCtzTmp ;

}*/




/***************************/



function jsFunSecFun_EditColumns()
{
    tmpTds =''; 
    tmpTds ='    <td name="tdSfItm"  style="display: none" >0</td> ';
    tmpTds+='    <td name="tdSfAnio"  align="center"> <input id="txSfAnio" name ="txSfAnio" disabled="true" class="form-control gs-input" placeholder="Año" style="width:55px; font-size:11px; font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td name="tdSfCod" align="center"> <input id="txSfCod" name ="txSfCod" disabled="true" class="form-control gs-input" placeholder="Codigo" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdSfFin" align="center"> <input id="txSfFin" name ="txSfFin" disabled="true" class="form-control gs-input" placeholder="Finalidad" style="width:80px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"> </td>';
    tmpTds+='    <td name="tdSfDsc"   align="center" > <input id="txSfDsc" name ="txSfDsc" class="form-control gs-input" placeholder="Descripcion" style="width:795px; font-size:11px;font-weight: bold;color:#000;" codID="NN" type="text"></td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" width="50px"><button id="btnSecFunRowSAVE" class="btn btn-primary " style="width:55Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px;  " type="button">Guardar</button> </td>';
    tmpTds+='    <td BGCOLOR="#d9edf7" ><button id="btnSecFunRowCANCEL" class="btn btn-primary " style="width:30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button> </td>';
   return tmpTds ;
}

/*********/

$( document ).on( 'click' ,'#btnSecFunRowEDIT ',function(e) {
    var flg = false;
    trCurrent = $(this).parent().parent();
    trClone = $(this).parent().parent().clone();
    trCloneHtml = trClone.html();
    //alert(trCloneHtml);
    $("#tbSecFunDll tbody tr").each(function (index) {
        var f = $(this).attr("trFocus");
        if(typeof f != "undefined" ){
            if(f=="ACTIVE")   flg= true ;
        }
    }) ;

    if(!flg) {
        $("#tbSecFunDll tfoot tr").each(function() {
            if ($(this).attr("class")=="fila-Hide" && $(this).attr("class")!="gsTh" )
                $(this).html("").append(trCloneHtml);
        });

        trCurrent.html("").append(jsFunSecFun_EditColumns()).css("background","#d9edf7").attr("trFocus","ACTIVE");
        trCurrent.find("td[name=tdSfItm]")   .html( trClone.find("td[name=tdSfItm]").text() );  
        trCurrent.find("td[name=tdSfAnio]")  .find('input[id=txSfAnio]')  .val(trClone .find("td[name=tdSfAnio]").text().trim());
        trCurrent.find("td[name=tdSfCod]")   .find('input[id=txSfCod]')   .val(trClone .find("td[name=tdSfCod]").text()) ;
        trCurrent.find("td[name=tdSfFin]")   .find('input[id=txSfFin]')   .val(trClone .find("td[name=tdSfFin]").text()) ;
        trCurrent.find("td[name=tdSfDsc]")   .find('input[id=txSfDsc]')   .val(trClone .find("td[name=tdSfDsc]").text()) ;            
    }
    else { jsFnDialogBox(400, 160, "WARNING", null, "ADVERTENCIA", "Existe una fila ya esta modificando<br> <strong>Primero tiene que termina el proceso actual</strong>"); }
   
});

$( document ).on( 'click' ,'#btnSecFunRowCANCEL',function(e) {
    filaHide="";   
       $("#tbSecFunDll tfoot tr").each(function () {
           if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
               filaHide = $(this).html();
       });
       $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");
  

});

$( document ).on( 'click' ,'#btnSecFunRowSAVE',function(e) {
    trCurrent = $(this).parent().parent();
    var trClone = $(this).parent().parent().clone();

            varSecFun.secOPE ="UPD";
            varSecFun.secID=trClone.find("td[name=tdSfItm]").html();
            varSecFun.secCod=trClone.find("td[name=tdSfCod]").html();
            varSecFun.secAnio=$(".txVarAnioEjec").val();            
            varSecFun.secNom=trClone.find("td[name=tdSfDsc]").find('input[id=txSfDsc]').val( );
            varSecFun.secFin=trClone.find("td[name=tdSfFin]").find('input[id=txSfFin]').val( );
            varSecFun.UsrID="NN";            
            reqErrores="<p>";  
            /*var tmp = varDep.depNom ;         
            if (  tmp.length> 3) {  reqErrores+=' <br> * Ingrese el Nombre de la Dependencia  '; }          
            reqErrores+="</p>";*/
            if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }

            var datos = {
                varRqs:varSecFun,
                '_token': $('#tokenBtn').val()
            }
            $.ajax({
                type: "post",
                url: "logistica/spLogSetSecFun",
                data: datos,
                beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
                success: function (VR) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();
                    $("#divSecFunDll").html(VR["vwSecFun"]);
                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["Result"][0].Mensaje ));
                    $('#dvAviso').modal('show');
                    
                }
            });
            $("#txSecFunAutoDsc").val("");
});

$( document ).on( 'click' ,'#btnSecFunRowDEL',function(e) {
  trCurrent = $(this).parent().parent();
 
 var msg= confirm("ESTA SEGURO QUE DESEA ELIMINAR EL REGISTRO");
    if(msg)
    {  
            varSecFun.secOPE ="DEL";
            varSecFun.secID=trCurrent.find("td[name=tdSfItm]").html();
            varSecFun.secCod=trCurrent.find("td[name=tdSfCod]").html();
            varSecFun.secAnio=$(".txVarAnioEjec").val();            
            varSecFun.secNom=trCurrent.find("td[name=tdSfDsc]").html();
            varSecFun.secFin=trCurrent.find("td[name=tdSfFin]").html();

            varSecFun.UsrID="NN";            
            var datos = {
                varRqs:varSecFun,
                '_token': $('#tokenBtn').val()
            }
            $.ajax({
                type: "post",
                url: "logistica/spLogSetSecFun",
                data: datos,
                beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
                error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
                success: function (VR) {
                    $("#divDialog").dialog("close");
                    $(".modal-backdrop").remove();
                    $("#divSecFunDll").html(VR["vwSecFun"]);
                    $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["Result"][0].Mensaje ));
                    $('#dvAviso').modal('show');
                    
                }
            });
    }
    $("#txSecFunAutoDsc").val("");
});

 $( document ).on( 'keydown', '#txSecFunAutoDsc', function(event ) {
 var nom = $(this).val();
 if (event.keyCode == 13 || nom.length==1 )
 {
    
     sql =" and (secdsc like '%"+ nom+"%' or secid like '%"+nom+"' )  ";
     $.ajax({
                type: "POST",
                url: "logistica/spLogGetSecFun",
                data: { prAnio:$(".txVarAnioEjec").val(), prQry:sql,'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#divSecFunDll").html( VR); }
            });
 }
});

$( document ).on( 'click','#btnSecFunRowNEW',function(e ) {
        e.preventDefault();
        $("#txSecFunAutoDsc").val("");
        var url = 'logistica/vwSecFunNew';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalSecFun').modal('show');
            $("#txSecFun_Anio" ).val($(".txVarAnioEjec").val());
        });
});

$( document ).on( 'click','#btnDepRowNEW',function(e ) {
    e.preventDefault();
    $("#txDepAutoDsc").val("");
    var url = 'logistica/vwDepNew';
    $.get(url,function(data){
        $("#loadModalsMain").html('');
        $("#loadModalsMain").html(data);
        $('#modalDep').modal('show');
        $("#txDep_Anio").val($(".txVarAnioEjec").val());
    });
});

$(document).on('click','#btnDepRowADD', function(e){

    e.preventDefault();

    if($('#txDep_Dsc').val().trim() == '') return;

    $.ajax({
        type: "post",
        url: "logistica/spLogSetDep",
        data: $('#frmDepAdd').serialize(),
        beforeSend: function () {        $("#dvHeadModal").html( jsFunSetModalHead ("WAIT","ESTA OPERACION PUEDE TARDAR VARIOS MINUTOS","Espere Por Favor. Cargando....!")); },
        error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
        success: function (VR) {
            //   $("#divDialog").dialog("close");
            $("#divDepDll").html(VR["vwDep"]);
            $("#dvHeadModal").html(jsFunSetModalHead("SHOW","RESULTADOS DE LA OPERACION",VR["Result"][0].Mensaje ));
            $("#dvHeadModal").attr("align",'center')

        }
    });
});

$(document).on('click','.btnDepRowEDIT', function (e) {

    var row = $(this).closest('tr');

    row.css("background","#d9edf7").attr("trFocus","ACTIVE");

    $('td', row).each(function(i,el){

        $("#tbDepDll tfoot tr:first").find('td[name=' + $(el).attr('name') + ']').html($(this).html());

        if($(el).hasClass('txEditDep')){
            if($(el).attr('name') == 'tdDepDsc'){
                $(this).html("<input type='text' id='txDepDesc' class='form-control gs-input' style='' value='" + $(this).text() + "' />");
            }
            if($(el).data('ope') == 'edit'){
                $(this).html('<button class="btn btn-success" id="btnDepRowSAVE" style="width: 55Px  ;height: 25px ; padding:0px; padding-left: -10px; font-size:9px; MARGIN-RIGHT:20px; " type="button">GUARDAR</button>');
            }
            if($(el).data('ope') == 'delete'){
                $(this).html('<button  id="btnDepRowCANCEL" class="btn btn-info " style="width: 30px  ;height: 25px ; padding:0px; font-size:10px;  " type="button">< <</button>');
            }
        }
    })

});

$(document).on('click','#btnDepRowSAVE', function(e){

    var row = $(this).closest('tr');

    var datos = {
        'txDep_OPE':"UPD",
        'txDep_Id':row.find("td[name=tdDepItm]").html().trim(),
        'txDep_Anio':row.find("td[name=tdDepAnio]").html().trim(),
        'txDep_Dsc':row.find("td[name=tdDepDsc]").find('input[id=txDepDesc]').val(),
        '_token': $('#tokenBtn').val()
    };

    $.ajax({
        type: "post",
        url: "logistica/spLogSetDep",
        data: datos,
        beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
        error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
        success: function (VR) {
            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#divDepDll").html(VR["vwDep"]);
            $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["Result"][0].Mensaje ));
            $('#dvAviso').modal('show');

        }
    });
});

$( document ).on( 'click' ,'#btnDepRowCANCEL',function(e) {

    filaHide="";
    $("#tbDepDll tfoot tr").each(function () {
        if ($(this).attr("Class") == "fila-Hide" && $(this).attr("Class") != "gsTh")
            filaHide = $(this).html();
    });
    $(this).parent().parent().html("").append(filaHide).removeAttr("style").removeAttr("trFocus");


});

$( document ).on( 'click' ,'.btnDepRowDEL',function(e) {
    row = $(this).closest('tr');

    var msg= confirm("ESTA SEGURO QUE DESEA ELIMINAR EL REGISTRO");
    if(msg)
    {
        var datos = {
            'txDep_OPE':"DEL",
            'txDep_Id':row.find("td[name=tdDepItm]").html().trim(),
            'txDep_Anio':row.find("td[name=tdDepAnio]").html().trim(),
            'txDep_Dsc':row.find("td[name=tdDepDsc]").html().trim(),
            '_token': $('#tokenBtn').val()
        };
        $.ajax({
            type: "post",
            url: "logistica/spLogSetDep",
            data: datos,
            beforeSend: function () {      jsFnDialogBox(0, 0, "LOAD", parent, "PETICION EN PROCESO", "Cargando, Espere un momento...");   },
            error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
            success: function (VR) {
                $("#divDialog").dialog("close");
                $(".modal-backdrop").remove();
                $("#divDepDll").html(VR["vwDep"]);
                $("#loadModals").html(jsFunLoadAviso('RESULTADO DE LA OPERACION',  VR["Result"][0].Mensaje ));
                $('#dvAviso').modal('show');

            }
        });
    }
});

$( document ).on( 'click' ,'#btnSecFunRowADD',function(e) {
 

            varSecFun.secOPE ="ADD";
            varSecFun.secID=$("#txSecFun_Cod").val();
            varSecFun.secAnio=$(".txVarAnioEjec").val();            
            varSecFun.secNom=$("#txSecFun_Dsc").val();
            varSecFun.secCod=$("#txSecFun_Cod").val();
            varSecFun.secFin=$("#txSecFun_Fin").val();
            varSecFun.UsrID="NN";            
            reqErrores="<p>";  
            if(reqErrores.length>10){    $("#loadModals").html( jsFunLoadAviso('VERIFIQUE LOS DATOS DEL PRODUCTO A INGRESAR',reqErrores));  $('#dvAviso').modal('show');   return false; }
             var datos = {
                varRqs:varSecFun,
                '_token': $('#tokenBtn').val()
            }
           
            $.ajax({
                type: "post",
                url: "logistica/spLogSetSecFun",
                data: datos,
                beforeSend: function () {        $("#dvHeadModal").html( jsFunSetModalHead ("WAIT","ESTA OPERACION PUEDE TARDAR VARIOS MINUTOS","Espere Por Favor. Cargando....!")); },
                error: function () {     jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");  },
                success: function (VR) {
                 //   $("#divDialog").dialog("close");          
                    $("#divSecFunDll").html(VR["vwSecFun"]);                    
                    $("#dvHeadModal").html(jsFunSetModalHead("SHOW","RESULTADOS DE LA OPERACION",VR["Result"][0].Mensaje )); 
                    $("#dvHeadModal").attr("align",'center')
                                        
                }
            });
            $("#txSecFunAutoDsc").val("");
            
});



var varSecFun = jQuery.parseJSON('{  ' +
'"secOPE":"0",'+
'"secID":"NN",' +
'"secCod":"NN",' +
'"secAnio":"NN",' +
'"secNom":"NN",' +
'"secFin":"NN",' +
'"UsrID":"0"' +
'}  ' ) ;



/***********************************************************************************/
/***********************************************************************************/

$(document).ready(function(){

    $( document ).on( 'click', '.menu-TipoReq li', function( event ) {

        var $target = $( event.currentTarget );
        $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
        var TipoReq= $target.attr("psrId") ;
        $('#txCodTipoReq').val("");
        $("#txCodTipoReq").attr("tipoReqID",TipoReq);
        $( "#txCodDep" ).focus();
        return false;
    });


    $( document ).on( 'keydown', '#txFCodigo, #txFNombre', function( ) {
        if (event.keyCode == 13)
        {
            var obj = 'NN';
            var tipo = $(this).attr("codID");
            var valor = $(this).val();
            var token = $('#tokenBtn').val();
            obj = $("#modalVentBusqDatos").attr('obj');
            var dataString = {'anio':$(".txVarAnioEjec").val() , 'obj': obj, 'tipo': tipo, 'valor': valor, '_token': token};
            $.ajax({
                cache:false,
                type: "POST",
                url: "logistica/spLogGetDatos",
                data: dataString,
                beforeSend: function () {
                    $('#modalContBusqDatos').html('<h3>Procesando la Consulta....</h3>');
                },
                error: function () {
                    $('#modalContBusqDatos').html('<h3>Error de Consulta </h3>')
                },
                success: function (data) {
                    $('#modalContBusqDatos').html(data);
                }
            });
        }
    });

    $( document ).on( 'keydown','#btnModalAceptar',function(event) {
        $("#dvAviso").css("display","none");
        $('#dvAviso').modal('hide');
    });

    $( document ).on( 'click','.btnItem',function(e) {
        e.preventDefault();
        var item = $(this).parent().parent();
        var obj = $(this).attr("name");
        var id = $(this).attr("codID");
        var cod = item.find("td[name=tdCod]").find('span').find('strong').html();
        var dsc = item.find("td[name=tdDsc]").html();
        if(obj=="CLASF"){ $("#txProdClasf").attr("codID",id);  $("#txProdClasf").val (cod);  }
        else if(obj=="BNS"){ $("#txProdProd").attr("codID",id);  $("#txProdProd").val (dsc);  }
        else if(obj=="UND"){ $("#txProdUnd").attr("codID",id);  $("#txProdUnd").val (cod);  }

        else if(obj=="DEP"){ $("#txCodDep").attr("depID",id);  $("#txDep").val(dsc); $("#txCodDep").val (cod);                  $("#txOC_CodDep").attr("codID",id);  $("#txOC_Dep").val(dsc); $("#txOC_CodDep").val (cod);  }
        else if(obj=="SECFUN"){ $("#txCodSecFun").attr("secFunID",id); $("#txSecFun").val(dsc);  $("#txCodSecFun").val (cod);   $("#txOC_CodSecFun").attr("codID",id); $("#txOC_SecFun").val(dsc);  $("#txOC_CodSecFun").val (cod);  }
        else if(obj=="DNI"){ $("#txDNI").attr("dniID",id);  $("#txDNI").val(cod);  $("#txSolicitante").val (dsc);  }
        else if(obj=="RUBRO"){ $("#txCodRubro").attr("rubroID",id);  $("#txCodRubro").val(cod);  $("#txRubro").val (dsc);       $("#txOC_CodRubro").attr("codID",id);  $("#txOC_CodRubro").val(cod);  $("#txOC_Rubro").val (dsc);}

        else if(obj=="TPROC"){ $("#txOC_CodTipoProc").attr("codID",id);  $("#txOC_CodTipoProc").val(cod);  $("#txOC_TipoProc").val (dsc);      }




    });



});

/*******************************************************************************************************/
/*******************************************************************************************************/

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


function jsFunLoadWait()
{
    $(".modal-backdrop").remove();
    a = '<div id="dvWait" class="modal  fade" style ="text-align:center;"> ';
    a+=' <div class="modal-dialog"   style =" margin-top: 60px; ">';
    a+= '<div class="modal-content" style ="text-align:center; height: 85px;" >';
    a+='  <div class="modal-header" style ="text-align:center;  height: 40px;" >   Municipalidad Distrital de Vilcabamba</div> ';
    a+= '<div class="modal-body" style ="text-align:center; margin-top: -15px;"   > <h4> Cargando...</h4></div> ';
    a+='        ';
    a+='</div></div></div>';
    return a;
}


function  jsFunModalBusqudaDatos (parmTitulo)
{
    $(".modal-backdrop").remove();
    t='';
    t+=' <div class="modal fade"  id="modalVentBusqDatos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >';
    t+=' <div class="modal-dialog"  >';
    t+=' <div class="modal-content">';
    t+='            <div class="modal-header">';
    t+='                    <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #444444 ; COLOR:#ffffff;" >';
    t+='                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>';
    t+='                    <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> ';
    t+=                    parmTitulo ;
    t+='                    : </span>' ;
    t+='                    </div></div>';
    t+= '                   <table style="margin-top: -15px;"><tr><td><input id="txFCodigo" codID="CID" name="txFCodigo" class="form-control gs-input" style="width: 90px; font-weight: bold; font-size: 12px;  "  type="text" placeholder="Codigo" ></td><td WIDTH="2px"></td><td> <input id="txFNombre" codID="DSC" name="txFNombre"   class="form-control gs-input"  style="margin-left: 5px; width:470px ;font-weight: bold; font-size: 12px; "  type="text" placeholder="Nombre"     prsTipoBusq="-" > </td><td></td></tr></table>';
    t+='            </div>';
    t+='            <div class="modal-body"  id="modalContBusqDatos"  STYLE="OVERFLOW: SCROLL" >   </div> ';
    t+=' </div>';
    t+=' </div>';
    t+=' </div> ';
    return t;
}

function jsFunLoadAviso(parmTitulo , parmMensaje)
{
    $(".modal-backdrop").remove();
    a ='<div id="dvAviso" class="modal  fade" style ="text-align:center;" > ';
    a+=' <div class="modal-dialog"   style =" margin-top: 60px; " >';
    a+='<div class="modal-content" style ="text-align:center; height: auto; padding-bottom: 10px;" >';
    a+='  <div class="modal-header" style ="text-align:center;  height: 45px;  " > <h5><strong>'  +parmTitulo+' </strong><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> </h5></div>  ';
    a+='<div class="modal-body" style ="text-align:center; margin-top: -15px; font-size: 12px;"     >  '+parmMensaje+'</div> ';
    a+='<button type="button" class="btn btn-primary " data-dismiss="modal" id="btnModalAceptar">Aceptar</button>';
    a+='        ';
    a+='</div></div></div>';
    return a;
}

function  jsFunModalRuc (parmTitulo)
{
    $(".modal-backdrop").remove();
    t='';
    t+=' <div class="modal fade"  id="modalRUC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >';
    t+=' <div class="modal-dialog"  >';
    t+=' <div class="modal-content">';
    t+='            <div class="modal-header">';
    t+='                    <div class="panel" > <div class="panel-heading gs-panel-heading"  style="background: #444444 ; COLOR:#ffffff;" >';
    t+='                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">:</span></button>';
    t+='                    <img src="img/pestana1.png" width="20px" height="20px" style=" MARGIN-top:-5px; margin-right: 3px"><span style="font-size: 11px;  font-family:  Arial, Helvetica, Verdana  "> ';
    t+=                    parmTitulo ;
    t+='                    : </span>' ;
    t+='                    </div></div>';
    t+='           <div class="panel panel-default" style="border-radius: 5px;padding-left: 10px; padding-top: 10px; ;margin-top: -5px;  background: #FCFCFC; border-top-width: 1px; border-top-color: #E2E2E2;  " id="divRuc">';
    t+='            <table class="gs-table" border="0"> ';
    t+='            <tr><td> <label class="gs-label">RUC:          </label> </td> <td width="100px;">  <input id="txRUC_Ruc" codID="ADD" name="txRUC_Ruc" class="form-control gs-input" style="width: 100px; font-weight: bold; font-size: 12px;  "  type="text" placeholder="RUC" > </td> <td align="left"> <SPAN class="btn btn-primary" id="btnLogRUC_SEARCH" style=" width: 60px;height: 26px; padding-top:6px; padding-left: 6px; font-size: 11px;"> BUSCAR </span><button class="btn btn-warning" id="btnLogRUC_SUNAT" style=" width: 60px;height: 26px; padding-top:6px; padding-left: 12px; font-size: 11px;">SUNAT</button><span id="txMessage"></span></td> </tr>';
    t+='            <tr><td> <label class="gs-label">R.Social:    </label> </td> <td colspan="2"> <input id="txRUC_RSocial" codID="CID" name="txRUC_RSocial" class="form-control gs-input" style="width: 500px;  font-size: 12px;  "  type="text" placeholder="Razon Social" > </td> </tr>';
    t+='            <tr><td> <label class="gs-label">Direccion:    </label> </td> <td colspan="2"> <input id="txRUC_Dir" codID="CID" name="txRUC_Dir" class="form-control gs-input" style="width: 500px;  font-size: 12px;  "  type="text" placeholder="Direccion" > </td> </tr>';
    t+='            <tr><td> <label class="gs-label">Telefono:     </label> </td> <td colspan="2"> <input id="txRUC_Tel" codID="CID" name="txRUC_Tel" class="form-control gs-input" style="width: 200px;  font-size: 12px;  "  type="text" placeholder="Telefono" > </td> </tr>';

    t+='            <tr><td> <label class="gs-label">Contacto:     </label> </td> <td colspan="2"> <input id="txRUC_Contacto" codID="CID" name="txRUC_Contacto" class="form-control gs-input" style="width: 200px;  font-size: 12px;  "  type="text" placeholder="Contacto" > </td> </tr>';
    t+='            <tr><td> <label class="gs-label">E-Mail:     </label> </td> <td colspan="2"> <input id="txRUC_EMail" codID="CID" name="txRUC_EMail" class="form-control gs-input" style="width: 200px;  font-size: 12px;  "  type="text" placeholder="Correo Electronico" > </td> </tr>';
    t+='            <tr><td> <label class="gs-label">Web :     </label> </td> <td colspan="2"> <input id="txRUC_Web" codID="CID" name="txRUC_Web" class="form-control gs-input" style="width: 200px;  font-size: 12px;  "  type="text" placeholder="Pagina Web" > </td> </tr>';
    t+='            <tr><td> <label class="gs-label">Otros:     </label> </td> <td colspan="2"> <input id="txRUC_Otros" codID="CID" name="txRUC_Otros" class="form-control gs-input" style="width: 200px;  font-size: 12px;  "  type="text" placeholder="Otros.." > </td> </tr>';
    t+='            <tr ><td colspan="3" style=" height: 10px;">  </td> </tr>';
    t+='            </table>';
    t+='   </div>';
    t+='            <table>';

    t+='            <tr align="right"><td colspan="3"> <button class="btn btn-primary" id="btnLogRUC_SAVE" style="width: 100px;height: 35px;"> GUARDAR </button> <button class="btn btn-default" id=" " style="width: 80px;height: 35px;" data-dismiss="modal"> Cancelar</button> </td> </tr>';
    t+='            <tr ><td colspan="3" style=" height: 10px;">  </td> </tr>';
    t+='            </table>';

    t+='   </div>';
    t+=' </div>';
    t+=' </div>';
    t+=' </div> ';
    return t;
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}




/***************************************************************/



$( document ).on( 'click','#btnLogCat_New',function(event) {
    $("#txDsc").val('');
    $("#CatDll").html("");
    $("#btnLogCat_Cancel").removeClass("fila-Hide");
    $("#btnLogCat_Save").removeClass("fila-Hide");
    $("#btnLogCat_New").addClass("fila-Hide");

});

$( document ).on( 'click','#btnLogCat_Cancel',function(event) {
    $(".modal-backdrop").remove();
    var token= $('#tokenBtn').val();
    var dataString = {'obj':'BNS','tipo': 'DSC' ,'valor':'','_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetCatalogo",
        data: dataString,
        beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
        error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
        success: function(data) {
            $("#divDialog").dialog("close");
            // $('#dvWait').modal('hide');
            // $('#dvAviso').modal('hide');
            $(".modal-backdrop").remove();
            $("#CatDll").html(data);
            $("#btnLogCat_Cancel").addClass("fila-Hide");
            $("#btnLogCat_Save").addClass("fila-Hide");
            $("#btnLogCat_New").removeClass("fila-Hide");

        }
    });
});


$( document ).on( 'click','#btnLogCat_Save',function(event) {
    $(".modal-backdrop").remove();
    var token= $('#tokenBtn').val();
    var dataString = {'OPE':'ADD','Cod': 'NN' ,'Dsc':$("#txDsc").val(),'_token':token } ;
    $.ajax({
        type: "POST",
        url: "logistica/spLogSetCatalogo",
        data: dataString,
             beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
        //error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>") ;},
        success: function(VR) {
            $("#divDialog").dialog("close");
            $(".modal-backdrop").remove();
            $("#CatDll").html(VR["Bns"]);

            $("#btnLogCat_Cancel").addClass("fila-Hide");
            $("#btnLogCat_Save").addClass("fila-Hide");
            $("#btnLogCat_New").removeClass("fila-Hide");

            $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Mensaje"][0].Mensaje));
            $('#dvAviso').modal('show');
            $("#txDsc").val("")

        }
    });
});

$( document ).on( 'keydown','#txDsc',function(event) {
    if (event.keyCode == 13) {
        $(".modal-backdrop").remove();
        var token = $('#tokenBtn').val();
        var dataString = {'obj': 'BNS', 'tipo': 'DSC', 'valor': $("#txDsc").val(), '_token': token};
        $.ajax({
            type: "POST",
            url: "logistica/spLogGetCatalogo",
            data: dataString,
            beforeSend: function () {
                jsFnDialogBox(0, 0, "LOAD", parent, " PETICION EN PROCESO", "Cargando, Espere un momento...");
            },
            error: function () {
                jsFnDialogBox(400, 145, "WARNING", parent, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>");
            },
            success: function (data) {
                $("#divDialog").dialog("close");
                // $('#dvWait').modal('hide');
                // $('#dvAviso').modal('hide');
                $(".modal-backdrop").remove();
                $("#CatDll").html(data);

            }
        });
    }
});

/******************************************************************************/

$(document).on('click','#btnLogRUC_SAVE',function(e){
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "logistica/spLogSetRuc",
        data:{OPE:$('#txRUC_Ruc').attr("codID"),Ruc:$('#txRUC_Ruc').val(),RSocial:$('#txRUC_RSocial').val(),Dir:$('#txRUC_Dir').val(),Tel:$('#txRUC_Tel').val() ,
            Contacto: $('#txRUC_Contacto').val(),EMail: $('#txRUC_EMail').val(),Web: $('#txRUC_Web').val(),Otros: $('#txRUC_Otros').val(),'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if(VR["Flag"]=="0") {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"][0].Mensaje));
                $('#dvAviso').modal('show');
            }
            else {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"]));
                $('#dvAviso').modal('show');
            }

        }
    });

});

$(document).on('keydown','#txRUC_Ruc',function(e){
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        jsFunGetRuc();
    }
});

$(document).on('click','#btnLogRUC_SEARCH',function(e){
    e.preventDefault();
    jsFunGetRuc();
});

$(document).on('click','#btnLogRUC_SUNAT',function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetRucsunat",
        data:{qry:$('#txRUC_Ruc').val() ,'_token': $('#tokenBtnMain').val()} ,
        beforeSend: function () {  $('#txMessage').html("CONECTANDO A SUNAT. Espere un momento...")  },
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $('#txMessage').html('');
            if (VR.msgId == 200) {
                $("#txRUC_Ruc").val(VR.datos.RUC);
                $("#txRUC_RSocial").val(VR.datos.RazonSocial);
                $("#txRUC_Tel").val('');
                $("#txRUC_Dir").val(VR.datos.Direccion);
                $("#txRUC_Contacto").val('');
                $("#txRUC_EMail").val('');
                $("#txRUC_Web").val('');
                $("#txRUC_Otros").val(VR.datos.Tipo);
                $("#txRUC_Ruc").attr("codID","ADD")

            }
            else
            {
                alert(VR.msg);
                $("#txRUC_RSocial").val("");
                $("#txRUC_Tel").val("");
                $("#txRUC_Dir").val("");
                $("#txRUC_Contacto").val("");
                $("#txRUC_EMail").val("");
                $("#txRUC_Web").val("");
                $("#txRUC_Otros").val("");
                $("#txRUC_Ruc").attr("codID","ADD")
            }
        }
    });
});

function jsFunGetRuc()
{
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetRuc",
        data:{qry:$('#txRUC_Ruc').val() ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if (VR.length > 0) {
                $("#txRUC_Ruc").val(VR[0].RUC);
                $("#txRUC_RSocial").val(VR[0].RSocial);
                $("#txRUC_Tel").val(VR[0].Telefono);
                $("#txRUC_Dir").val(VR[0].Direccion);
                $("#txRUC_Contacto").val(VR[0].Contacto);
                $("#txRUC_EMail").val(VR[0].EMail);
                $("#txRUC_Web").val(VR[0].Web);
                $("#txRUC_Otros").val(VR[0].Otros);
                $("#txRUC_Ruc").attr("codID","UPD")

            }
            else
            {
                $("#txRUC_Ruc").val("");
                $("#txRUC_RSocial").val("");
                $("#txRUC_Tel").val("");
                $("#txRUC_Dir").val("");
                $("#txRUC_Contacto").val("");
                $("#txRUC_EMail").val("");
                $("#txRUC_Web").val("");
                $("#txRUC_Otros").val("");
                $("#txRUC_Ruc").attr("codID","ADD")
            }
        }
    });
}

/*********************************************************************/
$(document).on('click','#btnLogPER_SAVE',function(e){
    e.preventDefault();
    if($('#txPER_DNI').val().length!=8) {    $("#snResult").html(" .:: Verifique el Numero de DNI"); return;  }
    $.ajax({
        type: "POST",
        url: "logistica/spLogSetPers",
        data:{OPE:$('#txPER_DNI').attr("OPE"),DNI:$('#txPER_DNI').val(),APaterno:$('#txPER_APaterno').val(),AMaterno:$('#txPER_AMaterno').val(),Nombres:$('#txPER_Nombres').val() ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if(VR["Flag"]=="0") {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"][0].Mensaje));
                $('#dvAviso').modal('show');
            }
            else {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"]));
                $('#dvAviso').modal('show');
            }

        }
    });

});

$(document).on('keydown','#txPER_DNI',function(e){
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) {
        jsFunGetPers();
    }
});

$(document).on('click','#btnLogPER_SEARCH',function(e){
    e.preventDefault();
    jsFunGetPers();
});

$(document).on('click','#txPER_APaterno,#txPER_AMaterno,#txPER_Nombres',function(e){
    e.preventDefault();
    $("#snResult").html("");
});

function jsFunGetPers()
{
    $("#snResult").html("");
    if($('#txPER_DNI').val().length!=8) {    $("#snResult").html(" .:: Verifique el Numero de DNI"); return;  }
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetPers",
        data:{qry:$('#txPER_DNI').val() ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if (VR.length > 0) {
                $("#txPER_DNI").val(VR[0].DNI);
                $("#txPER_APaterno").val(VR[0].APaterno);
                $("#txPER_AMaterno").val(VR[0].AMaterno);
                $("#txPER_Nombres").val(VR[0].Nombres);
                $("#txPER_DNI").attr("OPE","UPD");
                $("#snResult").html("");
            }
            else
            {
                //$("#txPER_DNI").val("");
                $("#txPER_APaterno").val("");
                $("#txPER_AMaterno").val("");
                $("#txPER_Nombres").val("");
                $("#txPER_DNI").attr("OPE","ADD")
                $("#snResult").html(" .:: No se encontro registrado el DNI");
            }
        }
    });
}

/*************************/
$(document).on('click','#btnLogPSS_SAVE',function(e){
    e.preventDefault();

    if($("#txPSS_Pss11").val() == $("#txPSS_Pss22").val())  {
        $.ajax({
            type: "POST",
            url: "logistica/spLogSetUsrPss",
            data:{ Pass:$("#txPSS_Pss11").val(),'_token': $('#tokenBtnMain').val()} ,
            error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
            success: function (VR) {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"][0].Mensaje));
                $('#dvAviso').modal('show');
            }
        });
    }
    else{
        $(".modal-backdrop").remove();
        $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ", "No se pudo cambiar la contraseña, Vuelva a intentarlo"));
        $('#dvAviso').modal('show');
        //jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "No se pudo actualizar la contraseña <br><strong>VUELVA A INTENTARLO</strong>");
    }

});

$(document).on('click','#btnLogPSS_VAL',function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "logistica/vwPassVal",
        data:{ Pss:$("#txPSS_Pss").val() ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $(".modal-backdrop").remove();
                $("#loadModalsMain").html(VR);
                $('#modalPass').modal('show');

        }
    });
});

/*

$(document).on('click','#btnLogUSR_SAVE',function(e){
    e.preventDefault();
    if($('#txUSR_DNI').val().length!=8) {    $("#snResult").html(" .:: Verifique el Numero de DNI"); return;  }
    $.ajax({
        type: "POST",
        url: "logistica/spLogSetUsr",
        data:{OPE:$('#txUSR_DNI').attr("OPE"),DNI:$('#txUSR_DNI').val(),Pass:$('#txUSR_DNI').val(), Abrv:$('#txUSR_Abrv').val(),Est:$('#txEstado').attr("codID"),FecFin:$('#txUSR_FFin').val(), Perfil:$('#txAcceso').attr("codID") ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if(VR["Flag"]=="0") {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"][0].Mensaje));
                $('#dvAviso').modal('show');
            }
            else {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"]));
                $('#dvAviso').modal('show');
            }

        }
    });

});*/


$(document).on('click','#btnLogUSR_SAVE',function(e) {
    e.preventDefault();
    if($('#txUSR_DNI').val().length!=8) {    $("#snResult").html(" .:: Verifique el Numero de DNI"); return;  }
    $.ajax({
        type: "POST",
        url: "logistica/spLogSetUsr",
        data:{OPE:$('#txUSR_DNI').attr("OPE"),DNI:$('#txUSR_DNI').val(),Pass:$('#txUSR_DNI').val(), Abrv:$('#txUSR_Abrv').val(),Est:$('#txEstado').attr("codID"),FecFin:$('#txUSR_FFin').val(), Perfil:$('#txAcceso').attr("codID") ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if(VR["Flag"]=="0") { 

                    flgDlls = $('#tbPerzDll').html();
                    if ( typeof flgDlls != "undefined" )  
                    {
                        itemRow="";
                        iAdd="";
                        iUpd="";
                        iDel="";
                        iPrint="";
                        var filasDlls = new Array();
                        $('#tbPerzDll tbody tr').each(function (){
                        if ($(this).attr("class")!="tRow")
                        {   
                            rowAUDll = $(this);
                            var fila = new Object(); 
                            itemRow = rowAUDll.find("td[name=tdModDsc]").attr("codID");
                            iAdd="0";
                            iUpd="0";
                            iDel="0";
                            iPrint="0";
                            iShow="0";
                            rowAdd = rowAUDll.find("td[name=tdModAdd]").find('input[type="checkbox"]').html();
                            rowUpd = rowAUDll.find("td[name=tdModUpd]").find('input[type="checkbox"]').html();
                            rowDel = rowAUDll.find("td[name=tdModDel]").find('input[type="checkbox"]').html();
                            rowPrint = rowAUDll.find("td[name=tdModPrint]").find('input[type="checkbox"]').html();
                            rowShow = rowAUDll.find("td[name=tdModShow]").find('input[type="checkbox"]').html();
                           
                            if ( typeof rowAdd != "undefined" )     { if( rowAUDll.find("td[name=tdModAdd]").find('input[type="checkbox"]').is(':checked') ) iAdd='1' ;     }
                            if ( typeof rowUpd != "undefined" )     { if( rowAUDll.find("td[name=tdModUpd]").find('input[type="checkbox"]').is(':checked') ) iUpd='1' ;     }
                            if ( typeof rowDel != "undefined" )     { if( rowAUDll.find("td[name=tdModDel]").find('input[type="checkbox"]').is(':checked') ) iDel='1' ;     }
                            if ( typeof rowPrint != "undefined" )   { if( rowAUDll.find("td[name=tdModPrint]").find('input[type="checkbox"]').is(':checked') ) iPrint='1' ; }
                            if ( typeof rowShow != "undefined" )   { if( rowAUDll.find("td[name=tdModShow]").find('input[type="checkbox"]').is(':checked') ) iShow='1' ; }
                            fila.iRow= itemRow;
                            fila.iAdd= iAdd;
                            fila.iUpd= iUpd;
                            fila.iDel= iDel;
                            fila.iPrint= iPrint;
                            fila.iShow = iShow;
                            filasDlls .push(fila);
                        }                   
                        });

                        
                        var fullData = { 
                        'varCodUser': VR["Result"][0].UsrNo,//$('#txUSR_DNI').attr("usrID"),               
                        'varDll': JSON.parse(JSON.stringify(filasDlls )),
                        '_token': $('#tokenBtnMain').val()
                        }
                        $.ajax({
                                type: "POST",
                                url: "logistica/spLogSetUsrPerz",
                                data: fullData,
                                beforeSend: function () { $("#pnlLogUserPerz").html( "<h2>Cardando.......<h2>");  },
                                error: function () {  $("#pnlLogUserPerz").html( "<h3>Se produjo un Error, Vuelva a Intentarlo..!.......<h3>"); },
                                success: function (VR) {  $("#pnlLogUserPerz").html( "<h4> Actualizacion concluida..! </h4>"); return;  }
                        });
                    }
                    else
                        { alert("NO"); }

                    $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"][0].Mensaje));
                    $('#dvAviso').modal('show');

            }
            else {
                $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  VR["Result"]));
                $('#dvAviso').modal('show');
            }
          }  
        });
});



$(document).on('click','#btnLogAnio_SAVE',function(e){
    e.preventDefault();
           $(".txVarAnioEjec").val($("#txLogAnio").val());
            $(".txVarAnioEje2").val($("#txLogAnio").val());
            $("#periodSys").val($("#txLogAnio").val());          
            $(".alm-content-wrapper").html("");
            $("#loadModalsMain").html( jsFunLoadAviso("RESULTADOS DE LA OPERACION ",  "AÑO DE EJECUCION FUE CAMBIADO"));
            $('#dvAviso').modal('show');    
            
    
});

$(document).on('keydown','#txUSR_DNI',function(e){
    if(event.shiftKey)     {        event.preventDefault();      }
    if(event.keyCode == 13 ) { jsFunGetUsrPers();}
});

$(document).on('click','#btnLogUSR_SEARCH',function(e){
    e.preventDefault();
    jsFunGetUsrPers();
});

$(document).on('click','#txPER_APaterno,#txPER_AMaterno,#txPER_Nombres',function(e){
    e.preventDefault();
    $("#snResult").html("");
});

$( document ).on( 'click', '.menu-Estado li', function( event ) {
    var $target = $( event.currentTarget );

    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    //$('#txTipoEstado').val("");
    $("#txEstado").attr("codID",TipoReq);
    //$( "#txCodDep" ).focus();
    return false;
});



$( document ).on( 'click', '.menu-Acceso li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    //$('#txTipoAcceso').val("");
    $("#txAcceso").attr("codID",TipoReq);
    //$( "#txCodDep" ).focus();
    return false;
});

function jsFunGetUsrPers()
{
    $("#snResult").html("");
    if($('#txUSR_DNI').val().length!=8) {    $("#snResult").html(" .:: Verifique el Numero de DNI"); return;  }
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetUsr",
        data:{qry:$('#txUSR_DNI').val() ,'_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            if (typeof VR["UsrVw"] != "undefined")
            {
                if (VR["UsrVw"].length > 0) {
                    $("#txUSR_DNI").attr("OPE", "UPD")
                    $(".modal-backdrop").remove();
                    $("#loadModalsMain").html(VR["UsrVw"]);
                    $("#modalUsr").modal('show');
                    $('#txEstado').attr("codID",VR["Usr"][0].Est );
                    if(VR["Usr"][0].Est=="1")   $('#txEstado').text("ACTIVO");
                    else    $('#txEstado').text("BAJA");
                    $('#txUSR_Nombres').prop('readOnly', true);
                    $('#txUSR_DNI').attr("maxlength", 8);
                }
            }
            else
            {
                if (typeof VR["Prs"] != "undefined") {
                    if (VR["Prs"].length > 0) {
                        //$("#txPER_DNI").val("");
                        $("#txUSR_Nombres").val(VR["Prs"][0].Completo);
                        $("#txUSR_DNI").attr("OPE", "ADD")
                        $("#snResult").html(" .:: Este usuario  es nuevo");
                        $('#txUSR_Nombres').prop('readOnly', true);
                        $("txUSR_Abrv").focus();
                    }
                    else {
                        //$("#txPER_DNI").val("");
                        $("#txUSR_Nombres").val("");
                        $("#txUSR_DNI").attr("OPE", "ADD")
                        $("#snResult").html(" .:: No se encontro registrado el DNI, Primero registre al personal");
                        $('#txUSR_Nombres').prop('disabled', true);
                        $('#txUSR_Abrv').prop('disabled', true);
                        $('#txUSR_FFin').prop('disabled', true);
                        $('#btnEstado').prop('disabled', true);
                        $('#btnAcceso').prop('disabled', true);
                        $('#btnLogUSR_PERS').prop('disabled', true);
                        $('#btnLogUSR_SAVE').prop('disabled', true);
                    }
                }
                else {
                    //$("#txPER_DNI").val("");
                    $("#txUSR_Nombres").val("");
                    $("#txUSR_DNI").attr("OPE", "ADD")
                    $("#snResult").html(" .:: No se encontro registrado el DNI, Primero registre al personal");
                    $('#txUSR_Nombres').prop('readOnly', true);
                    $('#txUSR_Abrv').prop('disabled', true);
                    $('#txUSR_FFin').prop('disabled', true);
                    $('#btnEstado').prop('disabled', true);
                    $('#btnAcceso').prop('disabled', true);
                    $('#btnLogUSR_PERS').prop('disabled', true);
                    $('#btnLogUSR_SAVE').prop('disabled', true);
                }
                $("txUSR_Abrv").focus();
            }
        }
    });
}




$(document).on('click','#btnLogPriceSearch',function(e){
    e.preventDefault();
  
    $.ajax({
        type: "POST",
        url: "logistica/spLogGetPrice",
        data:{ '_token': $('#tokenBtnMain').val()} ,
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (VR) {
            $(".modal-backdrop").remove();
            $("#loadModalsMain").html(VR);
            $('#modalPrice').modal('show');
        }
    });

   // $( "#divScroll" ).scrollLeft( 300 );
});

$(document).on('click','#btnPriceSearch', function(e){
    e.preventDefault();

    var data = $('#frmFindPrice').serialize() + "&prcAnio=" + $(".txVarAnioEjec").val();

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetPriceProduct",
        data: data,
        beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (response) {
            $("#divDialog").dialog("close");
            if(response.msgId == 500){
                alert(response.msg);
            }
            else{
                $('#dvPriceFilter').html(response.view);
            }
        }
    });
});

function detalle_producto(fila, prodId, prodDoc, prodUnd)
{
    var tr = $(fila).closest('tr');
    var row = $('#tabPriceFilter').DataTable().row(tr);

    if(row.child.isShown()){
        row.child.hide();
        tr.removeClass('shown');
    }
    else{
        $.get('logistica/vwDetailPriceProduct',{'producto': prodId, 'documento': prodDoc, 'anio': $(".txVarAnioEjec").val(), 'unidad': prodUnd}, function(data) {
            row.child(data.view).show();
            tr.addClass('shown');
        });
    }
}

$(document).on('click','#btnBuildRanking',function (e) {
    e.preventDefault();

    var data = $('#frmFindRanking').serialize() + "&rnkAnio=" + $(".txVarAnioEjec").val();

    $.ajax({
        type: "POST",
        url: "logistica/spLogGetRanking",
        data: data,
        beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
        error: function () {  jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); },
        success: function (response) {
            $("#divDialog").dialog("close");
            if(response.msgId == 500){
                alert(response.msg);
            }
            else{
                $('#dvPriceFilter').html(response.view);
            }
        }
    });

});

function detalle_ruc(el, ruc, tipo)
{
    var tr = $(el).closest('tr');

    var row = $('#tabRankingFilter').DataTable().row(tr);

    if(row.child.isShown()){
        row.child.hide();
        tr.removeClass('shown');
    }
    else{
        $.get('logistica/vwDetailRucCS',{'ruc': ruc, 'tipo': tipo, 'anio': $(".txVarAnioEjec").val() }, function(data) {
            row.child(data.view).show();
            tr.addClass('shown');
        });
    }

}

/*
$(document).on('focus','#txReqSgNro',function(){
    //alert("oo");
    $('#txReqSgNro').attr("maxlength", 4);
    $(this).autocomplete({
        source: 'getFindReq',
        minLength: 1,
        focus: function() {


            // prevent value inserted on focus
            return false;
        },
        open: function() {$(this).removeClass('ui-autocomplete-loading')},
        select: function(e, data){
            e.preventDefault();
            $(this).val(data.item.label);
            $(this).attr('codID',data.item.value);

            $('#txReqSgNro').focus();
        }
    });
});
*/

$(document).on('keydown','#txProdSF, #txProdRubro',function (evt) {
   if(evt.shiftKey)     {        evt.preventDefault();      }

   if(evt.keyCode == 13){
       var valor = $(this).val();
       if(valor.length<1) {return;}
       var token = $('#tokenBtn').val();
       var Evento = $(this).attr('name');
       var Flg = false ;

       if(Evento=='txProdSF' )   {  obj='SECFUN'; tipo='COD';  }
       else if(Evento=='txProdRubro'){  obj='RUBRO'; tipo='COD'; }
       else {  $(".modal-backdrop").remove();  obj="NN"; $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encuentra dentro de los parametros establecidos'));  $('#dvAviso').modal('show');   }

       $("#loadModals").html(jsFunLoadWait());
       var dataString = {'anio':$(".txVarAnioEjec").val() ,'obj':obj,'tipo': tipo ,'valor':valor,'_token':$('#tokenBtn').val() } ;

       $.ajax({
           type: "POST",
           url: "logistica/spLogGetDatos",
           data: dataString,
           beforeSend: function () {  jsFnDialogBox(0,0,"LOAD",parent," PETICION EN PROCESO","Cargando, Espere un momento...") ;},
           error: function ()      {  jsFnDialogBox(400,145, "WARNING",parent,"ERROR EN LA PETICION","Se produjo un ERROR en la peticion durante la Peticion. <br><strong>VERIFIQUE LA CONEXION AL SERVIDOR.</strong>") ;},
           success: function(data) {
               $("#divDialog").dialog("close");
               $('#dvWait').modal('hide');
               $('#dvAviso').modal('hide');
               $(".modal-backdrop").remove();
               if( data.length>0 ) {
                   Flg = true;
                   id = data[0].ID;
                   cod = data[0].Cod;
                   dsc = data[0].Dsc;
                   if (id == null)
                   {
                       Flg = false;
                       $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor 1'));  $('#dvAviso').modal('show');
                   }
               }
               else {
                   Flg = false;
                   $("#loadModals").html( jsFunLoadAviso('RESULTADO DE LA CONSULTA','No se encontro ningun registro relacionado con el valor'));  $('#dvAviso').modal('show');
               }

               if(Evento=='txProdSF')
               {
                   if (Flg==false) {
                       $('#txProdSF').attr('codID','NN');
                       $('#txProdSF').val('');
                       $("#txProdSF").focus();
                   }
                   else{
                       $('#txProdSF').attr('codID',id);
                       alert(dsc);
                       $( "#txProdRubro" ).focus();
                   }
               }
               else if(Evento=='txProdRubro')
               {
                   if (Flg==false) {
                       $('#txProdRubro').attr('codID','NN');
                       $('#txProdRubro').val('');
                       $("#txProdRubro").focus();
                   }
                   else {
                       $('#txProdRubro').attr('codID',id);

                       alert(dsc);
                       $( "#txProdCant" ).focus();
                   }
               }
               else {obj="NN";}
           }
       });
   }


});

$(document).on('focus','#txProdClasf',function(){
    //alert("oo");
    $('#txProdClasf').attr("maxlength", 6);
    $(this).autocomplete({
        source: 'getFindClasf',
        minLength: 1,
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        open: function() {$(this).removeClass('ui-autocomplete-loading')},
        select: function(e, data){
            e.preventDefault();
            $(this).val(data.item.label);
            $(this).attr('codID',data.item.value);
           // $(this).attr('codID',data.item.value);
            //$('#txProdProd').focus();
        }
    });
});

$(document).on('focus','#txProdProd',function(){

    $(this).autocomplete({
        source: 'getFindProd',
        minLength: 1,
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        open: function() {$(this).removeClass('ui-autocomplete-loading')},
        select: function(e, data){
            e.preventDefault();
            $(this).val(data.item.label);
            $(this).attr('codID',data.item.value);

            //$('#txProdUnd').focus();
        }
    });
});

$(document).on('focus','#txProdUnd',function(){
    $('#txProdUnd').attr("maxlength",1);
    $(this).autocomplete({
        source: 'getFindUnd',
        minLength: 1,
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        open: function() {$(this).removeClass('ui-autocomplete-loading')},
        select: function(e, data){
            e.preventDefault();
            $(this).val(data.item.abrv);
            $(this).attr('codID',data.item.value);

            //$('#txProdEspf').focus();
        }
    });
});



$(document).on('focus','#txProdSecFun',function(){
    //alert("oo");
    $('#txProdSecFun').attr("maxlength", 4);
    $(this).autocomplete({
        source: 'findSecFun',
        minLength: 1,
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        open: function() {$(this).removeClass('ui-autocomplete-loading')},
        select: function(e, data){
            e.preventDefault();
            $(this).val(data.item.label);
            $(this).attr('codID',data.item.value);
           // $(this).attr('codID',data.item.value);
            //$('#txProdClasf').focus();
        }
    });
});





function jsFunSetModalHead(parmTipo,parmTitulo, parmMsg)
{
    msg ="";
    if(parmTipo=="WAIT")
    {
        msg+= '<div class="modal-header" style ="text-align:center;  height: 45px;  " > <h5><strong>'  +parmTitulo+' </strong><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> </h5></div>  ';
        msg+='<br> <p style="font-size:12px;align:CENTER;" >'+parmMsg+'</p><br>';
       
    }
    else
    {
        msg+= '<div class="modal-header" style ="text-align:center;  height: 45px;  " > <h5><strong>'  +parmTitulo+' </strong><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> </h5></div>  ';
        msg+='<br> <p style="font-size:12px; align:CENTER ;" >'+parmMsg+'</p><br>';
        msg+='<button class="btn btn-primary"  style="width: 130px;height: 40px;" data-dismiss="modal" > Aceptar</button>'
    }
  
   return msg ;
}


/*symva development*/
$.extend($.expr[':'],{
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which === 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var pindex = $canfocus.index(document.activeElement) * 1;
        var index = $canfocus.index(document.activeElement) + 1;
        // alert('act: ' + pindex + ' - next: ' + index);
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

function fnComputeTotal(row, price) {
    var cant = $('#row' + row).find("td[name=tdCant]").html().trim();
    var total = price * cant;
    $('#row' + row).find('.dllTotal').val(total);
}

function fnChangeBtn(BS, btn){

    if(BS == 'BB'){
        btn.find('.btnTxt').html('AGREGAR BIEN');
    }
    else if(BS == 'SS'){
        btn.find('.btnTxt').html('AGREGAR SERVICIO');
    }
    else{
        btn.find('.btnTxt').html('NUEVO ITEM');
    }
}