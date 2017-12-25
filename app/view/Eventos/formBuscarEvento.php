<?php
include('././core/tempTop.php');
date_default_timezone_set('America/Montevideo');
 ?>

   <style media="screen">
     #btnImpresora{
       float: right;
       font-size: 2em;
       cursor: pointer;
       padding-top: 20px;
     }
   </style>
   <script type="text/javascript">
       function imprimir() {
         var fecha = document.getElementById("txtFecha").value;
         fecha = validarFecha(fecha);
         document.getElementById("print").innerHTML = "Eventos del día " + fecha;
           if (window.print) {
               window.print();
           } else {
               alert("La función de impresion no esta soportada por su navegador.");
           }
       }


       //Validar la fecha de el form.
       function validarFecha (fecha){
           anio = fecha.substr(0,4);
           dia = fecha.substr(8,11);
           mes = fecha.substr(5,2);
           fecha = dia+"/"+mes+"/"+anio;
           return fecha;
       }

   </script>

    <div id="section">
        <header>
            <h3>Buscar eventos</h3>
            <h3 id="print"></h3>
        </header>
        <article>
            <form class="" action="index.php?controller=Evento&action=buscarEventosXFecha" method="post">
              <div id="form">
                  <label for="txtFecha">Fecha</label>
                  <?php

                      // Funcionalidad para buscar y mantener la fecha de la busqueda
                      $mesMenos1 = date("m") - 1;
                      $min = date("Y"). "-" . $mesMenos1 . "-" . date("d");
                      if($data1 != null){
                        $date = $data1;
                        echo "<input type='date' name='txtFecha' id='txtFecha' min='$min' value='$date'>";
                      }else{
                        $date = date("Y"). "-" . date("m") . "-" . date("d");
                        echo "<input type='date' name='txtFecha' id='txtFecha' min='$min' value='$date'>";
                      }

                  ?>


                  <input type="submit" value="Buscar">
              </div>
            </form>

            <div class="tbl" style='overflow-x: auto;'>


                <?php
                    if($data!=null){

                      echo "<table>
                        <thead>
                            <tr>
                              <th>Cliente</th>
                              <th>Telefono</th>
                              <th>Inicio</th>
                              <th>Fin</th>
                              <th>Chicos</th>
                              <th>Direccion</th>
                              <th>Observaciones</th>
                              <th>Costo</th>
                              <th>Duracion</th>
                              <th>Materiales</th>
                            </tr>
                        </thead>
                        <tbody>";

                        while($fila = $data->fetch_assoc()){

                          echo "<tr>";
                          echo "<td>" . $fila['cliente'] . "</td>";
                          echo "<td>" . $fila['telefono'] . "</td>";
                          echo "<td>" . substr($fila['horaInicio'], 0, -3) . "</td>";
                          echo "<td>" . substr($fila['horaFin'], 0, -3) . "</td>";
                          echo "<td>" . $fila['cantChicos'] . "</td>";
                          echo "<td>" . $fila['direccion'] . "</td>";
                          echo "<td>" . $fila['observaciones'] . "</td>";
                          echo "<td>$ " . $fila['costo'] . "</td>";
                          echo "<td>" . $fila['duracion'] . " Hora/s</td>";

                          //FUNCIONALIDAD PARA IMPRIMIR UN MATERIAL POR RENGLON
                          $mat = "<td style='min-width: 140px;'>";
                          $materiales = explode(",", $fila['materiales']);
                          for($i = 0; $i < Count($materiales);$i++){
                            $mat .= "- " . $materiales[$i] . "<br>";
                          }
                          //$mat .= str_replace(",","<br>",$fila['materiales']);
                          $mat .= "</td>";

                          echo $mat;
                          echo "</tr>";
                        }
                        echo "</tbody>
                      </table>";
                      echo "</div>";
                      echo "<div id='pr'>";
                      echo "<span class='icon-printer' id='btnImpresora' onclick='imprimir();'></span>";
                      echo "</div>";
                      echo "<div style='clear:both;'></div>";
                    }

                ?>

        </article>

      </div>

<?php
  include('././core/tempBottom.php');
 ?>
