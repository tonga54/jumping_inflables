<?php
  date_default_timezone_set('America/Montevideo');
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jumping Inflables</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/fonts.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/choices.min.css?version=3.0.2">
  </head>
  <body>
    <div class="container">
        <header id="header">
            <div class="logo">
                <a href="core/backupBaseDeDatos.php"><span class="icon-checkmark"> </span>Correr Backup</a>
            </div>
        </header>
        <nav>
           <ul>
             <?php include("././core/tempMenu.inc"); ?>
           </ul>
        </nav>
        <section>
          <div class="sectionContainer">
            <div id="section">
                <header>
                    <h2>Estadisticas</h2>
                </header>

                <article>

                  <div class="vertgraph">
                      <h3 style="text-align: center;">Cantidad de materiales solicitados</h3>
                      <ul>
                        <?php
                         //La cantidad de chicos es el 100%;

                        $porcentajeCama = round(($data['cantCama'] * 100) / $data['totalMat'], 2);
                        $porcentajeCastillo = round(($data['cantCastillo'] * 100) / $data['totalMat'], 2);
                        $porcentajeTejo = round(($data['cantTejo'] * 100) / $data['totalMat'], 2);
                        $porcentajeFutbolito = round(($data['cantFutbolito'] * 100) / $data['totalMat'], 2);
                        $porcentajeMusica = round(($data["extras"]['Musica'] * 100) / $data['totalMat'], 2);


                        echo "
                          <li class='cama' style='height: " . $porcentajeCama . "%;'>
                          <span>Cama</span>
                          <span>" . $data['cantCama'] . "</span>
                          <span>" . $porcentajeCama . "%</span>
                          </li>
                          
                          <li class='castillo' style='height: " . $porcentajeCastillo . "%;'>
                          <span>Castillo</span>
                          <span>" . $data['cantCastillo'] . "</span>
                          <span>" . $porcentajeCastillo ."%</span>
                          </li>

                          <li class='tejo' style='height: " . $porcentajeTejo . "%;'>
                          <span>Tejo</span>
                          <span>" . $data['cantTejo'] . "</span>
                          <span>" . $porcentajeTejo ."%</span>
                          </li>

                          <li class='futbolito' style='height: " . $porcentajeFutbolito . "%;'>
                          <span>Futbolito</span>
                          <span>" . $data['cantFutbolito'] . "</span>
                          <span>" . $porcentajeFutbolito ."%</span>
                          </li>

                          <li class='musica' style='height: " . $porcentajeMusica . "%;'>
                          <span>Musica</span>
                          <span>" . $data['extras']['Musica'] . "</span>
                          <span>" . $porcentajeMusica ."%</span>
                          </li>";
                        ?>
                      </ul>
                  </div>

                  <div style="border-top: 1px solid #e2e2e2;
                          padding-top: 20px;">
                    <h3>Grafica sobre la cantidad de veces que se solicita Pop o Algodon de Azucar</h3>
                    <div id="piechart"></div>  
                  </div>




                  <p>Promedio cantidad de chicos:
                    <span><?php echo round($data["promChicos"],0) ?> </span>             
                  </p>

                  <div class="tablas">
                      <div class="tbl">
                        <h3>Dias de mas eventos</h3>
                        <table>
                          <thead>
                              <tr>
                                <th>Dia</th>
                                <th>Cantidad</th>
                              </tr>
                          </thead>
                          <tbody>

                      <?php
                        foreach ($data["dias"] as $key => $value) {
                         echo "<tr> 
                                  <td>" . $key . "</td>
                                  <td>" . $value . "</td>
                                </tr>";
                        }
                      ?>
                            </tbody>
                        </table>
                      </div>

                      <div class="tbl">
                        <h3>Precios mas solicitados</h3>
                        <table>
                          <thead>
                              <tr>
                                <th>Precio</th>
                                <th>Cantidad</th>
                              </tr>
                          </thead>
                          <tbody>

                      <?php
                        foreach ($data["precios"] as $key => $value) {
                         echo "<tr> 
                                  <td>$ " . $key . "</td>
                                  <td>" . $value . "</td>
                                </tr>";
                        }
                      ?>
                            </tbody>
                        </table>
                      </div>

                      <div class="tbl">
                        <h3>Duracion mas elegida</h3>
                        <table>
                          <thead>
                              <tr>
                                <th>Duracion</th>
                                <th>Cantidad</th>
                              </tr>
                          </thead>
                          <tbody>

                      <?php
                        foreach ($data["duracion"] as $key => $value) {
                         echo "<tr> 
                                  <td>" . $key . " hrs</td>
                                  <td>" . $value . "</td>
                                </tr>";
                        }
                      ?>
                            </tbody>
                        </table>
                      </div>
                  </div>

                </article>

                <footer>
                  <?php include("./core/version.inc"); ?>
                </footer>

            </div>
          </div>
        </section>
    </div>

    <style type="text/css">

        #piechart{
          margin: 0 auto !important;
        }

        .tbl{
          overflow-x: auto;
          width: 32.3%; 
          margin-right: 1%;
          display: inline-block;float:left;
        }

        h2{
          border-bottom: 1px solid #e2e2e2;
          padding-bottom: 20px;
        }

        p{
          text-align: center;
          border-top: 1px solid #e2e2e2;
          padding-top: 20px;
          font-size: 18px;
          font-family: "SourceSansPro-Regular";
        }

        p span{
          display: inline-block;
          background-color: red;
          padding: 5px 12px;
          color:white;
          margin-left: 3px;
          border-radius: 5px;
        }

        h3{
          font-family: "SourceSansPro-Regular";
        }

        h4{
          font-family: "SourceSansPro-ExtraLight";
          font-weight: normal;
        }


        .tablas{
          border-top: 1px solid #e2e2e2;
          padding-top: 20px;
        }
      
        article div{
          margin: 0 auto;
          text-align: center;
        }
        
        article span{
          font-family: "SourceSansPro-Regular";
        }

        .vertgraph {
           width: 508px;
           height: 307px;
           position: relative;
           margin: 0 auto;
           margin-top: 50px;
           margin-bottom: 20px;
         }
         .vertgraph ul {
             height: 307px;
             margin: 0;
             padding: 0;
             list-style: none;
         }
         .vertgraph ul li{
             position: absolute;*/
             display: inline-block;
             width: 70px;
             bottom: 0px;
             padding: 0 !important;
             margin: 0 !important;
             text-align: center;
             font-weight: bold;
             color: white;
             line-height: 2.5em;
         }

        .vertgraph ul li span{
          display: block;
        }

        .vertgraph ul li {
          font-family: "SourceSansPro-Regular";
          padding-bottom: 20% !important;
        }

        .vertgraph ul li span{
          display: block;
        }
         
         .vertgraph li.cama { left: 50px; background-color: red; }
         .vertgraph li.castillo { left: 155px; background-color: #009900; }
         .vertgraph li.tejo { left: 255px; background-color: blue; }
         .vertgraph li.futbolito { left: 351px; background-color:  #b800e6; }
         .vertgraph li.musica { left: 445px; background-color: #ff751a; }
    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Pop', <?php echo $data["extras"]['Pop']?>],
          ['Algodon de Azucar', <?php echo $data["extras"]['Algodon de Azucar'] ?>],
        ]);

          // Optional; add a title and set the width and height of the chart
          var options = {'width':800, 'height':400};

          // Display the chart inside the <div> element with id="piechart"
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
    </script>

  </body>
</html>
