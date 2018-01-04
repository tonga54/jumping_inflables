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
                  <h3>Registrar evento</h3>
              </header>
              <article>
                  <form class="" action="index.php?controller=Evento&action=altaEvento" method="post">
                    <div id="form">
                        <label for="txtCliente">Cliente</label>
                        <input type="text" name="txtCliente" id="txtCliente">

                        <label for="txtTelefono">Telefono</label>
                        <input type="tel" name="txtTelefono" id="txtTelefono" value="09">

                        <label for="txtFecha">Fecha</label>
                        <input type="date" name="txtFecha" id="txtFecha" min="<?php $mesMenos1 = date("m") - 1; echo date("Y"). "-" . $mesMenos1 . "-" . date("d"); ?>" value="<?php echo date("Y"). "-" . date("m") . "-" . date("d"); ?>">

                        <label for="txtHoraInicio">Hora inicio</label>
                        <input type="time" value="14:00" name="txtHoraInicio" id="txtHoraInicio">

                        <label for="txtHoraFin">Hora fin</label>
                        <input type="time" value="16:00" name="txtHoraFin" id="txtHoraFin">

                        <label for="txtCantChicos">Cant chicos</label>
                        <input type="number" name="txtCantChicos" id="txtCantChicos">

                        <label for="txtDireccion">Direccion</label>
                        <input type="text" name="txtDireccion" id="txtDireccion">

                        <label for="txtObservaciones">Observaciones</label>
                        <!-- <input type="text" name="txtObservaciones" id="txtObservaciones"> -->
                        <textarea name="txtObservaciones" id="txtObservaciones" rows="3"></textarea>

                        <label for="txtCosto">Costo</label>
                        <input type="number" name="txtCosto" id="txtCosto">

                        <label for="txtDuracion">Duracion</label>
                        <input type="number" name="txtDuracion" id="txtDuracion">

                        <!-- FORM CON SELECT SIN FRAMEWORK -->
                        <!-- <label for="slcMateriales">Materiales (ctrl + click)</label> -->
                        <!-- <select name="slcMateriales[]" multiple id="slcMateriales"> -->
                          <?php
                            /*  while($fila = $data->fetch_assoc()){
                                echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                              }*/
                           ?>
                        <!-- </select> -->


                        <label for="choices-multiple-remove-button">Materiales</label>
                        <select class="form-control" name="slcMateriales[]" id="choices-multiple-remove-button" placeholder="Click aqui para ver los materiales"
                          multiple>
                          <?php
                              while($fila = $data->fetch_assoc()){
                                echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                              }
                           ?>
                        </select>

                        <input type="submit" value="Registrar">
                    </div>
                  </form>

              </article>
              <footer>
                <?php include("./core/version.inc"); ?>
              </footer>
              
            </div>
      </div>
      <script src="https://cdn.polyfill.io/v2/polyfill.js?features=es5,fetch,Element.prototype.classList,requestAnimationFrame,Node.insertBefore,Node.firstChild,Object.assign"></script>
      <script src="../public/js/choices.min.js?version=2.8.8"></script>
      <script type="text/javascript" src="../public/js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../public/js/select.js"></script>
      <script type="text/javascript" src="../public/js/validaciones.js"></script>

      <script type="text/javascript">
        calcularHora();

        $("#txtHoraFin").change(calcularHora);
        $("#txtHoraInicio").change(calcularHora);

        function calcularHora(){
          var horaInicio = $("#txtHoraInicio").val();
          var horaFin    = $("#txtHoraFin").val();

          horaInicio = Number(horaInicio.substr(0,2));
          horaFin    = Number(horaFin.substr(0,2));

          var result = horaFin - horaInicio;
          $("#txtDuracion").val(result);
        }

      </script>
  </body>
</html>
