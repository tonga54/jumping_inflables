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
    <script src="https://cdn.polyfill.io/v2/polyfill.js?features=es5,fetch,Element.prototype.classList,requestAnimationFrame,Node.insertBefore,Node.firstChild,Object.assign"></script>
    <link rel="stylesheet" href="../public/css/choices.min.css?version=3.0.2">
    <script src="../public/js/choices.min.js?version=2.8.8"></script>

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
                <form class="" action="index.php?controller=Evento&action=editarEventoProceso" onsubmit="return validateForm()" method="post">
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
        <script type="text/javascript">
          function validateForm(){
            var mensaje = "ERROR:\n";
            var bandera = true;
            var cliente = document.getElementById("txtCliente").value;
            var telefono = document.getElementById("txtTelefono").value;
            var fecha = document.getElementById("txtFecha").value;
            var inicio = document.getElementById("txtHoraInicio").value;
            var fin = document.getElementById("txtHoraFin").value;
            var chicos = document.getElementById("txtCantChicos").value;
            var direccion = document.getElementById("txtDireccion").value;
            var observaciones = document.getElementById("txtObservaciones").value;
            var costo = document.getElementById("txtCosto").value;
            var duracion = document.getElementById("txtDuracion").value;


            if(cliente == ""){
              mensaje += "Cliente vacio\n";
              bandera = false;
            }
            if(telefono == ""){
              mensaje += "Telefono vacio\n";
              bandera = false;
            }
            if(isNaN(telefono)){
              mensaje += "Telefono debe ser numerico\n";
              bandera = false;
            }
            if(fecha == ""){
              mensaje += "Fecha vacia\n";
              bandera = false;
            }
            if(inicio == ""){
              mensaje += "Hora de inicio vacia\n";
              bandera = false;
            }
            if(fin == ""){
              mensaje += "Hora de fin vacia\n";
              bandera = false;
            }
            if(chicos == ""){
              mensaje += "Cantidad de chicos vacio\n";
              bandera = false;
            }
            if(Number(chicos) <= 0){
              mensaje += "La cantidad de chicos debe ser mayor a 0\n";
              bandera = false;
            }
            if(isNaN(chicos)){
              mensaje += "Cantidad de chicos debe ser numerico\n";
              bandera = false;
            }
            if(direccion == ""){
              mensaje += "Direccion vacia\n";
              bandera = false;
            }
            if(observaciones == ""){
              mensaje += "Observaciones vacio\n";
              bandera = false;
            }
            if(costo == ""){
              mensaje += "Costo vacio\n";
              bandera = false;
            }
            if(isNaN(costo)){
              mensaje += "El costo debe ser numerico\n";
              bandera = false;
            }
            if(duracion == ""){
              mensaje += "Duracion vacio\n";
              bandera = false;
            }
            if(isNaN(duracion)){
              mensaje += "La duracion debe ser numerico\n";
              bandera = false;
            }
            if(Number(duracion) <= 0){
              mensaje += "La duracion debe ser mayor a 0\n";
              bandera = false;
            }

            if(!bandera){
              alert (mensaje);
            }

            return bandera;

          }
        </script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var textRemove = new Choices(document.getElementById('choices-text-remove-button'), {
              delimiter: ',',
              editItems: true,
              maxItemCount: 5,
              removeItemButton: true,
            });

            var textUniqueVals = new Choices('#choices-text-unique-values', {
              paste: false,
              duplicateItems: false,
              editItems: true,
            });

            var texti18n = new Choices('#choices-text-i18n', {
              paste: false,
              duplicateItems: false,
              editItems: true,
              maxItemCount: 5,
              addItemText: function(value) {
                return 'Appuyez sur Entrée pour ajouter <b>"' + String(value) + '"</b>';
              },
              maxItemText: function(maxItemCount) {
                return String(maxItemCount) + 'valeurs peuvent être ajoutées';
              },
              uniqueItemText: 'Cette valeur est déjà présente',
            });

            var textEmailFilter = new Choices('#choices-text-email-filter', {
              editItems: true,
              regexFilter: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
            }).setValue(['joe@bloggs.com']);

            var textDisabled = new Choices('#choices-text-disabled', {
              addItems: false,
              removeItems: false,
            }).disable();

            var textPrependAppendVal = new Choices('#choices-text-prepend-append-value', {
              prependValue: 'item-',
              appendValue: '-' + Date.now(),
            }).removeActiveItems();

            var textPresetVal = new Choices('#choices-text-preset-values', {
              items: ['Josh Johnson', {
                value: 'joe@bloggs.co.uk',
                label: 'Joe Bloggs',
                customProperties: {
                  description: 'Joe Blogg is such a generic name'
                }
              }],
            });

            var multipleDefault = new Choices(document.getElementById('choices-multiple-groups'));

            var multipleFetch = new Choices('#choices-multiple-remote-fetch', {
              placeholder: true,
              placeholderValue: 'Pick an Strokes record',
              maxItemCount: 5,
            }).ajax(function(callback) {
              fetch('https://api.discogs.com/artists/55980/releases?token=QBRmstCkwXEvCjTclCpumbtNwvVkEzGAdELXyRyW')
                .then(function(response) {
                  response.json().then(function(data) {
                    callback(data.releases, 'title', 'title');
                  });
                })
                .catch(function(error) {
                  console.error(error);
                });
            });

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
              removeItemButton: true,
            });

            /* Use label on event */
            var choicesSelect = new Choices('#choices-multiple-labels', {
              removeItemButton: true,
              choices: [
                { value: 'One', label: 'Label One' },
                { value: 'Two', label: 'Label Two', disabled: true },
                { value: 'Three', label: 'Label Three' },
              ],
            }).setChoices([
              { value: 'Four', label: 'Label Four', disabled: true },
              { value: 'Five', label: 'Label Five' },
              { value: 'Six', label: 'Label Six', selected: true },
            ], 'value', 'label', false);

            choicesSelect.passedElement.addEventListener('addItem', function(event) {
              document.getElementById('message').innerHTML = 'You just added "' + event.detail.label + '"';
            });

            choicesSelect.passedElement.addEventListener('removeItem', function(event) {
              document.getElementById('message').innerHTML = 'You just removed "' + event.detail.label + '"';
            });

            var singleFetch = new Choices('#choices-single-remote-fetch', {
              searchPlaceholderValue: 'Search for an Arctic Monkeys record',
            }).ajax(function(callback) {
              fetch('https://api.discogs.com/artists/391170/releases?token=QBRmstCkwXEvCjTclCpumbtNwvVkEzGAdELXyRyW')
                .then(function(response) {
                  response.json().then(function(data) {
                    callback(data.releases, 'title', 'title');
                    singleFetch.setValueByChoice('Fake Tales Of San Francisco');
                  });
                })
                .catch(function(error) {
                  console.error(error);
                });
            });

            var singleXhrRemove = new Choices('#choices-single-remove-xhr', {
              removeItemButton: true,
              searchPlaceholderValue: 'Search for a Smiths\' record'
            }).ajax(function(callback) {
              var request = new XMLHttpRequest();
              request.open('get', 'https://api.discogs.com/artists/83080/releases?token=QBRmstCkwXEvCjTclCpumbtNwvVkEzGAdELXyRyW', true);
              request.onreadystatechange = function() {
                var status;
                var data;
                if (request.readyState === 4) {
                  status = request.status;
                  if (status === 200) {
                    data = JSON.parse(request.responseText);
                    callback(data.releases, 'title', 'title');
                    singleXhrRemove.setValueByChoice('How Soon Is Now?');
                  } else {
                    console.error(status);
                  }
                }
              }
              request.send();
            });

            var genericExamples = new Choices('[data-trigger]', {
              placeholderValue: 'This is a placeholder set in the config',
              searchPlaceholderValue: 'This is a search placeholder'
            });

            var singleNoSearch = new Choices('#choices-single-no-search', {
              searchEnabled: false,
              removeItemButton: true,
              choices: [
                { value: 'One', label: 'Label One' },
                { value: 'Two', label: 'Label Two', disabled: true },
                { value: 'Three', label: 'Label Three' },
              ],
            }).setChoices([
              { value: 'Four', label: 'Label Four', disabled: true },
              { value: 'Five', label: 'Label Five' },
              { value: 'Six', label: 'Label Six', selected: true },
            ], 'value', 'label', false);

            var singlePresetOpts = new Choices('#choices-single-preset-options', {
              placeholder: true,
            }).setChoices([{
              label: 'Group one',
              id: 1,
              disabled: false,
              choices: [
                { value: 'Child One', label: 'Child One', selected: true },
                { value: 'Child Two', label: 'Child Two', disabled: true },
                { value: 'Child Three', label: 'Child Three' },
              ]
            },
            {
              label: 'Group two',
              id: 2,
              disabled: false,
              choices: [
                { value: 'Child Four', label: 'Child Four', disabled: true },
                { value: 'Child Five', label: 'Child Five' },
                { value: 'Child Six', label: 'Child Six' },
              ]
            }], 'value', 'label');

            var singleSelectedOpt = new Choices('#choices-single-selected-option', {
              searchFields: ['label', 'value', 'customProperties.description'],
              choices: [
                { value: 'One', label: 'Label One', selected: true },
                { value: 'Two', label: 'Label Two', disabled: true },
                {
                  value: 'Three', label: 'Label Three', customProperties: {
                    description: 'This option is fantastic'
                  }
                },
              ],
            }).setValueByChoice('Two');

            var singleNoSorting = new Choices('#choices-single-no-sorting', {
              shouldSort: false,
            });

            var cities = new Choices(document.getElementById('cities'));
            var tubeStations = new Choices(document.getElementById('tube-stations')).disable();

            cities.passedElement.addEventListener('change', function(e) {
              if (e.detail.value === 'London') {
                tubeStations.enable();
              } else {
                tubeStations.disable();
              }
            });

            var customTemplates = new Choices(document.getElementById('choices-single-custom-templates'), {
              callbackOnCreateTemplates: function(strToEl) {
                var classNames = this.config.classNames;
                var itemSelectText = this.config.itemSelectText;
                return {
                  item: function(data) {
                    return strToEl('\
                      <div\
                        class="'+ String(classNames.item) + ' ' + String(data.highlighted ? classNames.highlightedState : classNames.itemSelectable) + '"\
                        data-item\
                        data-id="'+ String(data.id) + '"\
                        data-value="'+ String(data.value) + '"\
                        '+ String(data.active ? 'aria-selected="true"' : '') + '\
                        '+ String(data.disabled ? 'aria-disabled="true"' : '') + '\
                        >\
                        <span style="margin-right:10px;">🎉</span> ' + String(data.label) + '\
                      </div>\
                    ');
                  },
                  choice: function(data) {
                    return strToEl('\
                      <div\
                        class="'+ String(classNames.item) + ' ' + String(classNames.itemChoice) + ' ' + String(data.disabled ? classNames.itemDisabled : classNames.itemSelectable) + '"\
                        data-select-text="'+ String(itemSelectText) + '"\
                        data-choice \
                        '+ String(data.disabled ? 'data-choice-disabled aria-disabled="true"' : 'data-choice-selectable') + '\
                        data-id="'+ String(data.id) + '"\
                        data-value="'+ String(data.value) + '"\
                        '+ String(data.groupId > 0 ? 'role="treeitem"' : 'role="option"') + '\
                        >\
                        <span style="margin-right:10px;">👉🏽</span> ' + String(data.label) + '\
                      </div>\
                    ');
                  },
                };
              }
            });
          });
    </script>

  </body>
</html>
