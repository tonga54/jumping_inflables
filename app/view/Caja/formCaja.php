<?php
  include('././core/tempTop.php');
  date_default_timezone_set('America/Montevideo');
 ?>

   <style media="screen">
     #total{
       float: right;
       color:red;
       font-family: "SourceSansPro-Bold";
       letter-spacing: 1px;
       font-size: 22px;
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

       function validarFecha (fecha){
           anio = fecha.substr(0,4);
           dia = fecha.substr(8,11);
           mes = fecha.substr(5,2);
           fecha = dia+"/"+mes+"/"+anio;
           return fecha;
       }

         function validateForm(){
           var mensaje = "ERROR:\n";
           var bandera = true;
           var fecha = document.getElementById("txtFecha").value;
           var nombre = document.getElementById("txtNombre").value;
           var valor = document.getElementById("txtValor").value;


           if(nombre == ""){
             mensaje += "Nombre de la incidencia vacio\n";
             bandera = false;
           }
           if(fecha == ""){
             mensaje += "Fecha vacia\n";
             bandera = false;
           }
           if(valor == ""){
             mensaje += "Importe vacio\n";
             bandera = false;
           }

           if(!bandera){
             alert (mensaje);
           }

           return bandera;

         }

   </script>

  <div id="section">

      <header>
          <h3>Ingresar incidencia en caja</h3>
          <h3 id="print"></h3>
      </header>
      <article>
          <form class="" action="index.php?controller=Caja&action=altaIncidencia" method="post" onsubmit="return validateForm();">
            <div id="form">
                <label for="txtNombre">Nombre incidencia</label>
                <input type="text" name="txtNombre" id="txtNombre">

                <label for="txtFecha">Fecha</label>
                <?php
                  $mes = date('Y-m-d\TH:i');
                ?>
                <input type="datetime-local" name="txtFecha" id="txtFecha" value="<?php echo $mes; ?>">

                <label for="txtValor">Valor</label>
                <input type="number" name="txtValor" id="txtValor">

                <input type="submit" value="Ingresar">
            </div>
          </form>


              <?php

              $fila = $data1->fetch_assoc();
              echo "<h3 id='total'>Total en caja:  $" . $fila['total'] . "</h3>";

                  if($data!=null){
                    echo "<table>
                      <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Valor</th>
                          </tr>
                      </thead>
                      <tbody>";
                      while($fila = $data->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        $date = new DateTime($fila['fecha']);
                        echo "<td>" . $date->format('d/m/Y H:i') . "</td>";
                        echo "<td>$ " . $fila['valor'] . "</td>";
                        // echo "<td>" . $fila['direccion'] . "</td>";
                        echo "</tr>";
                      }
                      echo "</tbody>
                    </table>";
                  }

              ?>


      </article>

    </div>

<?php
  include('././core/tempBottom.php');
 ?>
