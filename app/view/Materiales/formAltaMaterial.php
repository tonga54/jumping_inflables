<!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Jumping Inflables</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="../public/css/print.css" media="print">
     <link rel="stylesheet" href="../public/css/fonts.css">
     <link rel="stylesheet" href="../public/css/style.css">
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

            <footer>

            </footer>
        </div>
  <script type="text/javascript" src="../public/js/jquery-3.2.1.min.js"></script>
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
  </body>
</html>
