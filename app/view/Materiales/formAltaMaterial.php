<?php
include('././core/tempTop.php');
date_default_timezone_set('America/Montevideo');
 ?>

   <script type="text/javascript">
   function validateForm(){

     var bandera = true;
     var material = document.getElementById("txtMaterial").value;

     if(material == ""){
       var mensaje = "ERROR:\n";
       mensaje += "Material vacio\n";
       alert(mensaje);
       bandera = false;
     }
     return bandera;

   }
   </script>

  <div id="section">
      <header>
          <h3>Agregar material</h3>
      </header>
      <article>
          <form class="" action="index.php?controller=Material&action=altaMaterial" onsubmit="return validateForm()" method="post">
            <div id="form">
                <label for="txtMaterial">Material</label>
                <input type="text" name="txtMaterial" id="txtMaterial">
                <input type="submit" value="Agregar">

                <br>
            </div>
          </form>
          <table class="slim-table">
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody>
            <?php
                while($fila = $data->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>" . $fila['nombre'] . "</td>";
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
