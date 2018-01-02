<?php
  date_default_timezone_set('America/Montevideo');
  $fila = $data->fetch_assoc();
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

    <style media="screen">

      table{
        text-align: center;
      }

      .art{
        width: 45%;
        display: inline-block;
        box-sizing: border-box;

      }

      .stats{
        text-align: center;
      }

      .stats header{
        text-align:center;
        width: 47%;
        display: inline-block;
      }

      #txtId{
        border: 1px solid #0066cc !important;
            background-color: rgb(235, 235, 228) !important;
        color: rgb(84, 84, 84) !important;
        padding: 5px 10px !important;
        border-color: initial !important;
      }

      #txtId{
        cursor: default;
      }
/*
      #txtId:hover {
        border: 1px solid #0099cc !important;
        background-color: #00aacc !important;
        color: #ffffff !important;
        padding: 5px 10px !important;
      }
*/
    </style>


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
               <?php include("././core/tempMenu.php"); ?>
             </ul>
          </nav>
          <section>
          <div class="sectionContainer">

        <div id="section">
            <header>
                <h3>Editar evento</h3>
            </header>
            <article>
                <form class="" action="index.php?controller=Evento&action=editarEventoProceso" method="post">
                  <div id="form">
                      <label for="txtId">Id</label>
                      <input type="text" name="txtId" style='disabled' id="txtId" readonly="true" value="<?php echo $fila['id']; ?>">

                      <label for="txtCliente">Cliente</label>
                      <input type="text" name="txtCliente" id="txtCliente" value="<?php echo $fila['cliente']; ?>">

                      <label for="txtTelefono">Telefono</label>
                      <input type="tel" name="txtTelefono" id="txtTelefono" value="<?php echo $fila['telefono']; ?>">

                      <label for="txtFecha">Fecha</label>
                      <input type="date" name="txtFecha" id="txtFecha" min="<?php $mesMenos1 = date("m") - 1; echo date("Y"). "-" . $mesMenos1 . "-" . date("d"); ?>" value="<?php echo $fila['fecha']; ?>">

                      <label for="txtHoraInicio">Hora inicio</label>
                      <input type="time" name="txtHoraInicio" id="txtHoraInicio" value="<?php echo $fila['horaInicio']; ?>">

                      <label for="txtHoraFin">Hora fin</label>
                      <input type="time" name="txtHoraFin" id="txtHoraFin" value="<?php echo $fila['horaFin']; ?>">

                      <label for="txtCantChicos">Cant chicos</label>
                      <input type="number" name="txtCantChicos" id="txtCantChicos" value="<?php echo $fila['cantChicos']; ?>">

                      <label for="txtDireccion">Direccion</label>
                      <input type="text" name="txtDireccion" id="txtDireccion" value="<?php echo $fila['direccion']; ?>">

                      <label for="txtObservaciones">Observaciones</label>
                      <!-- <input type="text" name="txtObservaciones" id="txtObservaciones"> -->
                      <textarea name="txtObservaciones" id="txtObservaciones" rows="3"><?php echo $fila['observaciones']; ?></textarea>

                      <label for="txtCosto">Costo</label>
                      <input type="number" name="txtCosto" id="txtCosto" value="<?php echo $fila['costo']; ?>">

                      <label for="txtDuracion">Duracion</label>
                      <input type="number" name="txtDuracion" id="txtDuracion" value="<?php echo $fila['duracion']; ?>">

                      <label for="tblMateriales">Materiales actuales</label>
                      <table id="tblMateriales">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php
                          $materiales = explode(",", $fila['materiales']);

                          $mat = "";
                          for($i = 0; $i < Count($materiales);$i++){
                            $mat .= "<tr>";
                            $mat .= "<td>" . $materiales[$i] . "</td>";
                            $mat .= "<tr>";
                          }
                          echo $mat;
                       ?>
                       </tbody>
                     </table>


                      <label for="choices-multiple-remove-button">Editar materiales</label>
                      <select class="form-control" name="slcMateriales[]" id="choices-multiple-remove-button" placeholder="Click aqui para ver los materiales"
                        multiple>
                        <?php
                            while($fila = $data1->fetch_assoc()){
                              echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                            }
                         ?>
                      </select>

                      <input type="submit" value="Editar">
                  </div>
                </form>

              </article>
            </div>
          </div>
        </div>
        <script type="text/javascript" src="../public/js/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.polyfill.io/v2/polyfill.js?features=es5,fetch,Element.prototype.classList,requestAnimationFrame,Node.insertBefore,Node.firstChild,Object.assign"></script>
        <script src="../public/js/choices.min.js?version=2.8.8"></script>
        <script type="text/javascript" src="../public/js/select.js"></script>
        <script type="text/javascript" src="../public/js/validaciones.js"></script>

  </body>
</html>
