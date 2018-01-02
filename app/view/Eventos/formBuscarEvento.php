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
     <link rel="stylesheet" href="../public/css/buscarEvento.css">
     <link rel="stylesheet" type="text/css" href="../public/css/print.css" media="print">

     <style media="screen">
         #sugerirMateriales{
           display: inline-block;
           width: 49%;
         }

         h4{
           text-align: center;
         }

         .matContainer{
           margin:0 auto;
           width: 50%;
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
                      <h3 class="hidden-print">Informacion Eventos</h3>
                      <h3 id="print"></h3>
                  </header>
                  <article>
                    <div id="i">
                      <form class="" action="index.php?controller=Evento&action=buscarEventosXFecha" method="post">
                        <h4>Buscar eventos</h4>
                        <div id="form" class="hidden-print">
                            <label for="txtFecha">Fecha</label>
                            <?php

                                // Funcionalidad para buscar y mantener la fecha de la busqueda
                                $mesMenos1 = date("m") - 1;
                                $min = date("Y"). "-" . $mesMenos1 . "-" . date("d");
                                if($data1 != null){
                                  $date = $data1;
                                  echo "<input class='hidden-print' type='date' name='txtFecha' id='txtFecha' min='$min' value='$date'>";
                                }else{
                                  $date = date("Y-m-d");
                                  echo "<input class='hidden-print' type='date' name='txtFecha' id='txtFecha' min='$min' value='$date'>";
                                }

                            ?>

                            <input type="submit" value="Buscar">
                        </div>
                      </form>

                      <div class="hidden-print" id="sugerirMateriales">
                        <div class="matContainer">


                          <h4>Materiales disponibles</h4>
                          <div class="txt">
                            <label for="txtHoraInicio">Hora Inicio</label>
                            <input type="time" name="txtHoraInicio" id="txtHoraInicio" value="14:00">
                          </div>
                          <div class="txt">
                            <label for="txtHoraFin">Hora Fin</label>
                            <input type="time" name="txtHoraFin" id="txtHoraFin" value="16:00">
                          </div>

                          <input type="button" id="btnEnviar" value="Revisar">
                          </div>
                      </div>

                    </div>

                      <div class="r">

                      </div>

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
                                    echo "<td class='hidden-print'><a href='index.php?controller=Evento&action=editarEvento&idEvento=". $fila['id'] . "'><span class='icon-pencil'></span></a></td>";
                                    echo "<td class='hidden-print'><a class='eliminar' href='index.php?controller=Evento&action=eliminarEvento&idEvento=". $fila['id']. "'><span class='icon-bin'></span></td>";

                                    echo "</tr>";
                                  }

                                  echo "</tbody>
                                </table>";
                                echo "</div>";
                                echo "<div class='hidden-print'>";
                                echo "<span class='icon-printer' id='btnImpresora' onclick='imprimir();'></span>";
                                echo "</div>";
                                echo "<div style='clear:both;'></div>";
                              }

                          ?>

                  </article>

                </div>
                            <!--
                  <div class="tooltip">Hover over me
                    <span class="tooltiptext">Tooltip text</span>
                  </div> -->

          <footer>

          </footer>
      </div>
    <script type="text/javascript" src="../public/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">

       $(".eliminar").click(function(e){
         if(!window.confirm("Seguro que deseas eliminar")){
           e.preventDefault();
         }
       });

       $("#btnEnviar").click(function(){
           var fecha = $("#txtFecha").val();
           var inicio = $("#txtHoraInicio").val();
           var fin    = $("#txtHoraFin").val();
           $.ajax({url: "index.php?controller=Evento&action=sugerirMateriales&fecha=" + fecha + "&inicio=" + inicio + "&fin=" + fin, success: function(result){
               $(".r").html("<h4 style='text-align:center;' class='hidden-print'>Materiales disponibles entre " + inicio + " - " + fin + "</h4>" + result + "<br><br>");
           }});


       });

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
  </body>
</html>
