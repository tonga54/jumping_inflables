<?php
include('././core/tempTop.php');
 ?>
  <div id="section">
      <header>
          <h3>Ultimos 5 eventos agendados</h3>
      </header>
      <article>
          <table>
            <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Telefono</th>
                  <th>Fecha</th>
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
            <tbody>
              <?php
                while($fila = $data->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>" . $fila['cliente'] . "</td>";
                  echo "<td>" . $fila['telefono'] . "</td>";
                  $date = new DateTime($fila['fecha']);
                  $date = $date->format('d/m/Y');
                  echo "<td style='min-width:70px;'>" . $date . "</td>";
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
                  $mat .= "</td>";

                  echo $mat;
                  echo "</tr>";
                }

               ?>
           </tbody>
         </table>
      </article>

    <!-- Estadisticas -->
    <div class="stats">
      <header>
          <h3>Meses con mas eventos</h3>
      </header>
      <header>
          <h3>Meses con mayor recaudo</h3>
      </header>
      <article class="art">
          <table>
            <thead>
                <tr>
                  <th>Mes</th>
                  <th>Cantidad de eventos</th>
                </tr>
            </thead>
            <tbody>
              <?php
                while($fila = $data1->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>" . $fila["Fecha"] . "</td>";
                  echo "<td style='width:50%;'>" . $fila["CantidadEventos"] . "</td>";
                  echo "</tr>";
                }
               ?>
           </tbody>
         </table>

       </article>
         <article class="art">
             <table>
               <thead>
                   <tr>
                     <th>Mes</th>
                     <th>Total</th>
                   </tr>
               </thead>
               <tbody>
                 <?php
                   while($fila = $data2->fetch_assoc()){
                     echo "<tr>";
                     echo "<td>" . $fila["Fecha"] . "</td>";
                     echo "<td style='width:50%;'> $" . $fila["Total"] . "</td>";
                     echo "</tr>";
                   }
                  ?>
              </tbody>
            </table>


      </article>
    </div>


<?php
  include('././core/tempBottom.php');
 ?>
