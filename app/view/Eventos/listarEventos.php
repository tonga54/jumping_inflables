<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <tr>
        <th>Cliente</th>
        <th>Direccion</th>
        <th>Observacioens</th>
      </tr>
      <?php

        while($fila = $data->fetch_assoc()){
          echo "<tr>";
          echo "<td>" . $fila['cliente'] . "</td>";
          echo "<td>" . $fila['direccion'] . "</td>";
          echo "<td>" . $fila['observaciones'] . "</td>";
          echo "</tr>";
        }

      ?>

   </table>
  </body>
</html>
