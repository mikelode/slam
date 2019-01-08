<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <style>
            table, tr, td, th, tbody, thead, tfoot{
                page-break-inside: avoid !important;
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
    <body style="border: solid 1px #008000;" onload="subst()">
        <table style="border-bottom: 1px solid pink; width: 100%; margin-bottom:5px;" id="FakeHeaders">
          <tr>
            <th>Your awesome table column header 1</th>
            <th>Column 2</th>
            <th style="text-align:right">
                Page <span class="page"></span>/<span class="topage"></span>
            </th>
          </tr>
          <tr>
              <th>Your awesome table column header 2</th>
              <th>Column 3</th>
              <th style="text-align:right">
                  Page <span class="page"></span>/<span class="topage"></span>
              </th>
            </tr>
        </table>
    </body>
</html>