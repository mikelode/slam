<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style>
        body{
            font-family: "Courier New", Courier, monospace;
            font-size: 8px;
        }
        </style>
        <script>
        function subst() {
          var vars={};
          var x=document.location.search.substring(1).split('&');
          for (var i in x) {var z=x[i].split('=',2);vars[z[0]] = decodeURI(z[1]);}
          var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
          for (var i in x) {
            var y = document.getElementsByClassName(x[i]);
            for (var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
            /*if(vars['page'] == 1){ // If page is 1, set FakeHeaders display to none
               document.getElementById("FakeHeaders").style.display = 'none';
            }

            if(vars['page'] == 3) { // If page is 3, set FakeHeaders display to none
                document.getElementById("FakeHeaders").style.display = 'none';
            }*/
          }
        }
        </script>
    </head>
    <body onload="subst()">
        <table style="width: 100%;" id="FakeHeaders">
          <tr>
            <th style="text-align:left">{{ config('slam.ENTIDAD_PIE') }}</th>
            <th style="text-align:right">
                Página <span class="page"></span>/<span class="topage"></span>
            </th>
          </tr>
        </table>
    </body>
</html>