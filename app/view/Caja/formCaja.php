<?php
  date_default_timezone_set('America/Montevideo');
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Jumping Inflables</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="../public/css/print.css" media="print">
     <link rel="stylesheet" href="../public/css/fonts.css">
     <link rel="stylesheet" href="../public/css/style.css">

    <style media="screen">
      #total{
        float: right;
        color:red;
        font-family: "SourceSansPro-Bold";
        letter-spacing: 1px;
        font-size: 22px;
      }
    </style>

   </head>
   <body>
     <div class="container">
         <header id="header">
             <div class="logo">
                  <a href="index.php?controller=Backup&action=crearBackup"><span class="icon-checkmark"> </span>Correr Backup</a>
             </div>
         </header>
         <nav>
            <ul>
         	     <?php include("././core/tempMenu.php"); ?>
            </ul>
         </nav>
         <section>
           <div class="sectionContainer">
              <div id="section">

                  <header>
                      <h3>Ingresar incidencia en caja</h3>
                      <h3 id="print"></h3>
                  </header>
                  <article>
                      <form class="" action="index.php?controller=Caja&action=altaIncidencia" method="post">
                        <div id="form" onsubmit="return validarFormulario()">
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

                <footer>

                </footer>
          </div>
        </section>
        <script type="text/javascript" src="../public/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../public/js/validaciones.js"></script>
  </body>
</html>
