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
                  <h3>Informacion</h3>
                  <h4 style="color:gray;">Sobre el proximo fin de semana</h4>
              </header>
              <article>
                <div id="vertgraph">
                    <ul>
                      <?php
                      //La cantidad de chicos es el 100%;
                      echo"
                        <li class='critical' style='height: " . ($data['pop'] * 100) / $data['chicos'] . "%;'><span>Pop</span>" . $data['pop'] . "</li>
                        <li class='high' style='height: " . ($data['algodon'] * 100) / $data['chicos'] . "%;'><span>Algodon</span>" . $data['algodon'] . "</li>
                        <li class='medium' style='height: " . ($data['chicos'] * 100) / $data['chicos'] . "%;'><span>Chicos</span>" . $data['chicos'] . "</li>
                        ";
                      ?>
                    </ul>

                </div>
              </article>
              <footer>
                <?php include("./core/version.inc"); ?>
              </footer>

            </div>
      </div>




<style type="text/css">
      h4{
        font-family: "SourceSansPro-ExtraLight";
        font-weight: normal;
      }
      #vertgraph {
         width: 508px;
         height: 307px;
         position: relative;
         margin: 0 auto;
         margin-top: 50px;
       }
       #vertgraph ul {
           width: 378px;
           height: 307px;
           margin: 0;
           padding: 0;
       }
       #vertgraph ul li {
           position: absolute;
           width: 60px;
           height: 160px;
           bottom: 34px;
           padding: 0 !important;
           margin: 0 !important;
           text-align: center;
           font-weight: bold;
           color: white;
           line-height: 2.5em;
       }

      #vertgraph ul li span{
        display: block;
      }

      #vertgraph ul li {
        font-family: "SourceSansPro-Regular";
      }
       
       #vertgraph li.critical { left: 130px; background-color: red; }
       #vertgraph li.high { left: 221px; background-color: #009900; }
       #vertgraph li.medium { left: 316px; background-color: blue; }
       #vertgraph li.low { left: 361px; background-color: #009900; }
</style>

  </body>
</html>
